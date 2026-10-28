<?php
/**
 * Front Page Template - MIRAS
 */
get_header();
$imgBase   = content_url('uploads/miras-images/');
$shopUrl   = function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : home_url('/shop/');
$aboutUrl  = home_url('/about/');
$sellerUrl = home_url('/become-seller/');
?>
<?php $sliderImgBase = content_url('miras-slider/'); ?>
<!-- SEO H1 - مخفي بصرياً لكن مرئي لمحركات البحث -->
<h1 class="miras-seo-h1"><?php echo esc_html( get_bloginfo('name') . ' | ' . get_bloginfo('description')); ?></h1>
<!-- ===================== 1. HERO SLIDER ===================== -->
<style>
/* ===== MIRAS CUSTOM HERO SLIDER ===== */
#miras-hero {
  position: relative;
  width: 100%;
  height: 88vh;
  min-height: 560px;
  overflow: hidden;
  background: #0a120d;
  direction: rtl;
}

/* الشرائح */
.miras-slide {
  position: absolute;
  inset: 0;
  opacity: 0;
  transition: opacity 1s ease;
  pointer-events: none;
}
.miras-slide.active {
  opacity: 1;
  pointer-events: auto;
  z-index: 2;
}

/* صورة الخلفية */
.miras-slide-img {
  position: absolute;
  inset: 0;
  background-size: cover;
  background-position: center center;
}

/* طبقة التعتيم - من اليمين */
.miras-slide-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(
    to left,
    rgba(4,10,6,0.95) 0%,
    rgba(4,10,6,0.82) 32%,
    rgba(0,0,0,0.30) 60%,
    transparent 100%
  );
  z-index: 1;
}

/* النص - في اليمين */
.miras-slide-body {
  position: absolute;
  inset: 0;
  display: flex;
  align-items: center;
  justify-content: flex-start;
  padding: 0 6vw;
  z-index: 3;
}
.miras-slide-text {
  max-width: 520px;
  text-align: right;
  direction: rtl;
}

/* Badge */
.miras-slide-badge {
  display: inline-block;
  background: rgba(201,168,76,.2);
  border: 1px solid rgba(201,168,76,.5);
  color: #E8C97A;
  font-size: .88rem;
  font-weight: 700;
  padding: 6px 18px;
  border-radius: 40px;
  margin-bottom: 18px;
  letter-spacing: .04em;
  opacity: 0;
  transform: translateY(20px);
  transition: none;
}

/* العنوان */
.miras-slide-title {
  font-size: clamp(2rem,4.5vw,3.6rem);
  font-weight: 900;
  color: #fff;
  line-height: 1.25;
  margin: 0 0 14px;
  opacity: 0;
  transform: translateY(24px);
  transition: none;
}
.miras-slide-title span { color: #C9A84C; display: block; }

/* الوصف */
.miras-slide-desc {
  font-size: clamp(.9rem,1.4vw,1.05rem);
  color: rgba(245,237,216,.85);
  line-height: 1.8;
  margin: 0 0 30px;
  opacity: 0;
  transform: translateY(18px);
  transition: none;
}

/* الأزرار */
.miras-slide-btns {
  display: flex;
  gap: 12px;
  justify-content: flex-end;
  flex-wrap: wrap;
  opacity: 0;
  transform: translateY(14px);
  transition: none;
}
.miras-slide-btns a.btn-gold {
  padding: 13px 28px;
  background: linear-gradient(135deg,#C9A84C,#E8C97A);
  color: #0a120d;
  font-weight: 800;
  font-size: .93rem;
  border-radius: 8px;
  text-decoration: none;
  box-shadow: 0 6px 24px rgba(201,168,76,.4);
  transition: transform .2s, box-shadow .2s;
}
.miras-slide-btns a.btn-gold:hover { transform:translateY(-3px); box-shadow:0 10px 32px rgba(201,168,76,.55); }
.miras-slide-btns a.btn-ghost {
  padding: 12px 22px;
  border: 1.5px solid rgba(255,255,255,.45);
  color: #fff;
  font-weight: 600;
  font-size: .93rem;
  border-radius: 8px;
  text-decoration: none;
  transition: border-color .2s, background .2s;
}
.miras-slide-btns a.btn-ghost:hover { border-color:#C9A84C; background:rgba(201,168,76,.12); }

/* تأثير الدخول عند الشريحة النشطة */
.miras-slide.active .miras-slide-badge {
  animation: msUp 0.6s ease 0.2s forwards;
}
.miras-slide.active .miras-slide-title {
  animation: msUp 0.6s ease 0.38s forwards;
}
.miras-slide.active .miras-slide-desc {
  animation: msUp 0.6s ease 0.54s forwards;
}
.miras-slide.active .miras-slide-btns {
  animation: msUp 0.6s ease 0.7s forwards;
}
@keyframes msUp {
  to { opacity: 1; transform: translateY(0); }
}

/* نقاط التمرير */
#miras-dots {
  position: absolute;
  bottom: 28px;
  left: 50%;
  transform: translateX(-50%);
  z-index: 10;
  display: flex;
  gap: 8px;
  align-items: center;
}
.miras-dot {
  width: 10px;
  height: 10px;
  border-radius: 50%;
  background: rgba(255,255,255,.45);
  cursor: pointer;
  transition: all .3s;
  border: none;
  padding: 0;
}
.miras-dot.active {
  background: #C9A84C;
  width: 28px;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(201,168,76,.7);
}

/* أزرار السابق/التالي */
.miras-slider-nav {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  z-index: 10;
  width: 46px;
  height: 46px;
  border-radius: 50%;
  background: rgba(201,168,76,.15);
  border: 1.5px solid rgba(201,168,76,.45);
  color: #C9A84C;
  font-size: 20px;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: background .2s;
  line-height: 1;
}
.miras-slider-nav:hover { background: rgba(201,168,76,.35); }
#miras-prev { right: 20px; }
#miras-next { left: 20px; }

/* شريط التقدم */
#miras-progress-wrap {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  height: 3px;
  background: rgba(255,255,255,.08);
  z-index: 10;
}
#miras-progress-bar {
  height: 100%;
  width: 0;
  background: linear-gradient(90deg,#C9A84C,#E8C97A);
}

/* موبايل */
@media(max-width: 768px) {
  .miras-slide-body { justify-content:center; align-items:flex-end; padding:0 20px 90px; }
  .miras-slide-text { text-align:center; max-width:100%; }
  .miras-slide-btns { justify-content:center; }
  .miras-slide-overlay { background:linear-gradient(to top,rgba(0,0,0,.92) 0%,rgba(0,0,0,.45) 55%,transparent 100%); }
}
</style>

<section id="miras-hero">

  <!-- شريحة 1: القهوة -->
  <div class="miras-slide active">
    <div class="miras-slide-img" style="background-image:url('<?php echo $sliderImgBase; ?>coffee.jpg')"></div>
    <div class="miras-slide-overlay"></div>
    <div class="miras-slide-body">
      <div class="miras-slide-text">
        <span class="miras-slide-badge">☕ بن يمني فاخر</span>
        <h2 class="miras-slide-title">مذاق العراقة<span>والمزاج الأصيل</span></h2>
        <p class="miras-slide-desc">بن يمني أصيل مزروع في أعالي جبال اليمن.<br>نكهة غنية تأخذك في رحلة عبر الزمن.</p>
        <div class="miras-slide-btns">
          <a href="<?php echo esc_url(add_query_arg('product_cat','coffee',$shopUrl)); ?>" class="btn-gold">تسوق البن</a>
          <a href="<?php echo esc_url($aboutUrl); ?>" class="btn-ghost">اعرف المزيد</a>
        </div>
      </div>
    </div>
  </div>

  <!-- شريحة 2: العسل -->
  <div class="miras-slide">
    <div class="miras-slide-img" style="background-image:url('<?php echo $sliderImgBase; ?>honey.jpg')"></div>
    <div class="miras-slide-overlay"></div>
    <div class="miras-slide-body">
      <div class="miras-slide-text">
        <span class="miras-slide-badge">🍯 عسل يمني أصيل</span>
        <h2 class="miras-slide-title">من أجود المناحل<span>اليمنية الأصيلة</span></h2>
        <p class="miras-slide-desc">عسل طبيعي 100% من مناحل يمنية موثوقة.<br>جودة لا تُضاهى وأصالة لا مثيل لها.</p>
        <div class="miras-slide-btns">
          <a href="<?php echo esc_url(add_query_arg('product_cat','honey',$shopUrl)); ?>" class="btn-gold">تسوق العسل</a>
          <a href="<?php echo esc_url($aboutUrl); ?>" class="btn-ghost">اعرف المزيد</a>
        </div>
      </div>
    </div>
  </div>

  <!-- شريحة 3: الجنبية -->
  <div class="miras-slide">
    <div class="miras-slide-img" style="background-image:url('<?php echo $sliderImgBase; ?>jambiya.jpg')"></div>
    <div class="miras-slide-overlay"></div>
    <div class="miras-slide-body">
      <div class="miras-slide-text">
        <span class="miras-slide-badge">🗡️ تراث يمني عريق</span>
        <h2 class="miras-slide-title">رمز الهوية<span>والفخر اليمني</span></h2>
        <p class="miras-slide-desc">جنابي يمنية صُنعت ببراعة وإتقان،<br>تحمل حكاية تاريخ وأصالة تتوارثها الأجيال.</p>
        <div class="miras-slide-btns">
          <a href="<?php echo esc_url(add_query_arg('product_cat','heritage',$shopUrl)); ?>" class="btn-gold">تسوق الجنابي</a>
          <a href="<?php echo esc_url($aboutUrl); ?>" class="btn-ghost">اعرف المزيد</a>
        </div>
      </div>
    </div>
  </div>

  <!-- شريحة 4: العقيق -->
  <div class="miras-slide">
    <div class="miras-slide-img" style="background-image:url('<?php echo $sliderImgBase; ?>agate.jpg')"></div>
    <div class="miras-slide-overlay"></div>
    <div class="miras-slide-body">
      <div class="miras-slide-text">
        <span class="miras-slide-badge">💍 عقيق يمني نادر</span>
        <h2 class="miras-slide-title">سحر الطبيعة<span>وجمال لا يبهت</span></h2>
        <p class="miras-slide-desc">أحجار عقيق يمني طبيعية 100%، مصقولة بعناية<br>لتزين إطلالتك بلمسة من الفخامة والرقي.</p>
        <div class="miras-slide-btns">
          <a href="<?php echo esc_url(add_query_arg('product_cat','agate',$shopUrl)); ?>" class="btn-gold">تسوق العقيق</a>
          <a href="<?php echo esc_url($aboutUrl); ?>" class="btn-ghost">اعرف المزيد</a>
        </div>
      </div>
    </div>
  </div>

  <!-- نقاط التمرير -->
  <div id="miras-dots">
    <button class="miras-dot active" data-i="0"></button>
    <button class="miras-dot" data-i="1"></button>
    <button class="miras-dot" data-i="2"></button>
    <button class="miras-dot" data-i="3"></button>
  </div>

  <!-- أزرار التنقل -->
  <button id="miras-prev" class="miras-slider-nav" aria-label="السابق">&#8250;</button>
  <button id="miras-next" class="miras-slider-nav" aria-label="التالي">&#8249;</button>

  <!-- شريط التقدم -->
  <div id="miras-progress-wrap"><div id="miras-progress-bar"></div></div>

</section>

<script>
(function() {
  var slides = document.querySelectorAll('.miras-slide');
  var dots   = document.querySelectorAll('.miras-dot');
  var bar    = document.getElementById('miras-progress-bar');
  var DELAY  = 5000;
  var current = 0;
  var timer, barTimer;

  function resetAnim(slide) {
    var els = slide.querySelectorAll('.miras-slide-badge, .miras-slide-title, .miras-slide-desc, .miras-slide-btns');
    for (var i = 0; i < els.length; i++) {
      els[i].style.animation = 'none';
      els[i].offsetHeight; /* reflow */
      els[i].style.animation = '';
    }
  }

  function goTo(n) {
    slides[current].classList.remove('active');
    dots[current].classList.remove('active');
    current = (n + slides.length) % slides.length;
    slides[current].classList.add('active');
    dots[current].classList.add('active');
    resetAnim(slides[current]);
    startProgress();
  }

  function startProgress() {
    if (!bar) return;
    clearTimeout(barTimer);
    bar.style.transition = 'none';
    bar.style.width = '0%';
    barTimer = setTimeout(function() {
      bar.style.transition = 'width ' + DELAY + 'ms linear';
      bar.style.width = '100%';
    }, 30);
  }

  function startAuto() {
    clearInterval(timer);
    timer = setInterval(function() { goTo(current + 1); }, DELAY);
  }

  /* نقاط التمرير */
  for (var d = 0; d < dots.length; d++) {
    (function(idx) {
      dots[idx].addEventListener('click', function() {
        goTo(idx);
        startAuto();
      });
    })(d);
  }

  /* أزرار التنقل */
  var prevBtn = document.getElementById('miras-prev');
  var nextBtn = document.getElementById('miras-next');
  if (prevBtn) prevBtn.addEventListener('click', function() { goTo(current - 1); startAuto(); });
  if (nextBtn) nextBtn.addEventListener('click', function() { goTo(current + 1); startAuto(); });

  /* إيقاف التشغيل التلقائي عند hover */
  var hero = document.getElementById('miras-hero');
  if (hero) {
    hero.addEventListener('mouseenter', function() { clearInterval(timer); });
    hero.addEventListener('mouseleave', function() { startAuto(); });
  }

  /* البداية */
  startProgress();
  startAuto();
})();
</script>

<!-- ===================== 2. CATEGORIES CAROUSEL ===================== -->
<?php
$feature_cats = [
  ['name'=>'عسل يمني',       'desc'=>'عسل طبيعي 100% من مناحل يمنية اصيلة.',        'image'=>'hero-honey.jpg',      'slug'=>'honey',             'icon'=>'🍯'],
  ['name'=>'البن اليمني',    'desc'=>'بن يمني فاخر من اعلى الجبال وانقى المصادر.',  'image'=>'hero-coffee.jpg',     'slug'=>'coffee',            'icon'=>'☕'],
  ['name'=>'تراث وحرف',      'desc'=>'منتجات حرفية تحمل روح اليمن وتراثه.',         'image'=>'cat-heritage.jpg',    'slug'=>'heritage',          'icon'=>'🏺'],
  ['name'=>'بخور وعطور',     'desc'=>'روائح عبقة من التراث اليمني الاصيل.',         'image'=>'cat-bakhoor.jpg',     'slug'=>'bakhoor-atoor',     'icon'=>'🕌'],
  ['name'=>'صناديق الهدايا', 'desc'=>'مجموعات مختارة بعناية للمناسبات الجميلة.',    'image'=>'gift-boxes.jpg',      'slug'=>'gifts',             'icon'=>'🎁'],
  ['name'=>'اللبان والسمن',  'desc'=>'جودة واصالة يمنية لا تضاهى.',                 'image'=>'cat-luban.jpg',       'slug'=>'luban-samn',        'icon'=>'🪔'],
  ['name'=>'منتجات زراعية',  'desc'=>'محاصيل وخيرات يمنية طازجة ومعبأة.',           'image'=>'cat-agriculture.jpg', 'slug'=>'yemeni-agriculture','icon'=>'🌾'],
  ['name'=>'مكسرات وفواكه',  'desc'=>'مكسرات وفواكه مجففة من اجود المناطق.',        'image'=>'cat-nuts.jpg',        'slug'=>'nuts',              'icon'=>'🥜'],
  ['name'=>'بهارات وتوابل',  'desc'=>'بهارات يمنية اصيلة تضيف نكهة لا مثيل لها.',  'image'=>'cat-spices.jpg',      'slug'=>'spices',            'icon'=>'🌶️'],
];
?>
<style>
/* ===== CATEGORIES SECTION ===== */
.miras-cats-section { padding: 60px 0 40px; background: var(--miras-ivory); }

.miras-cats-outer {
  position: relative;
  padding: 0 52px;
}

/* الكاروسيل - الحاوية الخارجية */
.miras-cats-viewport {
  overflow: hidden;
  width: 100%;
}

/* الشريط المتحرك */
.miras-cats-track {
  display: flex;
  flex-direction: row;
  gap: 18px;
  transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
  will-change: transform;
  direction: rtl;
}

/* كل بطاقة */
.miras-cat-item {
  flex: 0 0 calc(25% - 14px);
  min-width: 0;
}

/* البطاقة نفسها */
.miras-cat-card {
  display: block;
  position: relative;
  height: 240px;
  border-radius: 16px;
  overflow: hidden;
  text-decoration: none;
  background: #0F2A23;
  box-shadow: 0 4px 18px rgba(0,0,0,0.12);
  transition: transform 0.32s ease, box-shadow 0.32s ease;
}
.miras-cat-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 14px 35px rgba(0,0,0,0.22);
}
.miras-cat-card img {
  width: 100%; height: 100%;
  object-fit: cover; display: block;
  transition: transform 0.5s ease;
}
.miras-cat-card:hover img { transform: scale(1.07); }
.miras-cat-card-overlay {
  position: absolute; inset: 0;
  background: linear-gradient(to top, rgba(10,28,20,0.90) 0%, rgba(10,28,20,0.20) 55%, transparent 100%);
}
.miras-cat-card-body {
  position: absolute; bottom: 0; right: 0; left: 0;
  padding: 16px 14px 14px;
  display: flex; flex-direction: column; gap: 3px;
}
.miras-cat-card-icon { font-size: 20px; line-height: 1; margin-bottom: 2px; }
.miras-cat-card-name {
  font-size: 15px; font-weight: 700;
  color: #fff; margin: 0; line-height: 1.3;
}
.miras-cat-card-cta {
  font-size: 12px; color: var(--miras-gold);
  font-weight: 600; margin-top: 3px;
}

/* أزرار الأسهم */
.miras-cats-arrow {
  position: absolute; top: 50%; transform: translateY(-50%);
  z-index: 10; width: 42px; height: 42px;
  background: #fff; border-radius: 50%; border: none;
  cursor: pointer; box-shadow: 0 4px 14px rgba(0,0,0,0.15);
  display: flex; align-items: center; justify-content: center;
  color: var(--miras-charcoal); transition: all 0.25s ease;
}
.miras-cats-arrow:hover {
  background: var(--miras-gold); color: #fff;
  transform: translateY(-50%) scale(1.1);
}
.miras-cats-arrow:disabled { opacity: 0.3; cursor: default; }
.miras-cats-arrow:disabled:hover {
  background: #fff; color: var(--miras-charcoal);
  transform: translateY(-50%) scale(1);
}
.miras-cats-arrow-prev { right: 0; }
.miras-cats-arrow-next { left: 0; }

/* زر عرض الكل */
.miras-cats-view-all { text-align: center; margin-top: 32px; }
.miras-cats-view-all a {
  display: inline-block; border: 2px solid var(--miras-charcoal); color: var(--miras-charcoal);
  padding: 12px 36px; border-radius: 30px; font-weight: 700; font-size: 15px;
  transition: all 0.3s ease; text-decoration: none;
}
.miras-cats-view-all a:hover { background: var(--miras-charcoal); color: #fff; }

/* Responsive */
@media (max-width: 900px) {
  .miras-cat-item { flex: 0 0 calc(50% - 9px); }
}
@media (max-width: 560px) {
  .miras-cat-item { flex: 0 0 calc(75% - 7px); }
  .miras-cats-outer { padding: 0 44px; }
}
</style>

<section class="miras-cats-section">
  <div class="miras-container">
    <div class="miras-section-header miras-animate-in" style="text-align:center; margin-bottom:36px;">
      <span class="miras-section-tag">أقسام مميزة</span>
      <h2 class="miras-section-title">تسوق حسب فئتك المفضلة</h2>
      <p class="miras-section-desc">مجمع في مكان واحد. اختر من بين افضل المنتجات اليمنية.</p>
    </div>

    <div class="miras-cats-outer" id="mirasCoOuter">
      <!-- زر السابق (يمين في RTL) -->
      <button class="miras-cats-arrow miras-cats-arrow-prev" id="mirasCatPrev" aria-label="السابق">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
      </button>
      <!-- زر التالي (يسار في RTL) -->
      <button class="miras-cats-arrow miras-cats-arrow-next" id="mirasCatNext" aria-label="التالي">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"/></svg>
      </button>

      <div class="miras-cats-viewport" id="mirasCoViewport">
        <div class="miras-cats-track" id="mirasCoTrack">
          <?php foreach($feature_cats as $fc): ?>
          <div class="miras-cat-item">
            <a href="<?php echo esc_url(add_query_arg('product_cat', $fc['slug'], $shopUrl)); ?>" class="miras-cat-card">
              <img src="<?php echo $imgBase . $fc['image']; ?>" alt="<?php echo esc_attr($fc['name']); ?>" loading="lazy">
              <div class="miras-cat-card-overlay"></div>
              <div class="miras-cat-card-body">
                <span class="miras-cat-card-icon"><?php echo $fc['icon']; ?></span>
                <h3 class="miras-cat-card-name"><?php echo $fc['name']; ?></h3>
                <span class="miras-cat-card-link">تسوق القسم &larr;</span>
              </div>
            </a>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
    <div class="miras-cats-view-all">
      <a href="<?php echo esc_url($shopUrl); ?>">عرض كل الاقسام &larr;</a>
    </div>
  </div>
</section>
<script>
(function(){
  var track    = document.getElementById('mirasCoTrack');
  var viewport = document.getElementById('mirasCoViewport');
  var btnPrev  = document.getElementById('mirasCatPrev');
  var btnNext  = document.getElementById('mirasCatNext');
  if (!track || !viewport) return;

  var items      = track.querySelectorAll('.miras-cat-item');
  var total      = items.length;
  var current    = 0;
  var autoTimer  = null;

  /* كم بطاقة تُعرض في كل مرة حسب عرض الشاشة */
  function visibleCount() {
    var w = viewport.offsetWidth;
    if (w >= 900) return 4;
    if (w >= 560) return 2;
    return 1;
  }

  /* حساب عدد الخطوات الممكنة */
  function maxIndex() { return Math.max(0, total - visibleCount()); }

  /* تحريك الشريط */
  function goTo(idx) {
    if (idx < 0) idx = 0;
    if (idx > maxIndex()) idx = maxIndex();
    current = idx;

    /* عرض بطاقة واحدة = عرض viewport / visibleCount - نصف gap */
    var gap       = 18;
    var itemWidth = (viewport.offsetWidth - gap * (visibleCount() - 1)) / visibleCount();
    /* في RTL نتحرك يميناً (موجب) */
    var offset    = current * (itemWidth + gap);
    track.style.transform = 'translateX(' + offset + 'px)';

    btnPrev.disabled = (current === 0);
    btnNext.disabled = (current >= maxIndex());
  }

  btnPrev.addEventListener('click', function(){ resetAuto(); goTo(current - 1); });
  btnNext.addEventListener('click', function(){ resetAuto(); goTo(current + 1); });

  /* تمرير تلقائي */
  function startAuto() {
    autoTimer = setInterval(function(){
      var next = current + 1;
      if (next > maxIndex()) next = 0;
      goTo(next);
    }, 3000);
  }
  function resetAuto() { clearInterval(autoTimer); startAuto(); }

  /* تهيئة */
  goTo(0);
  startAuto();

  /* إعادة الحساب عند تغيير حجم النافذة */
  window.addEventListener('resize', function(){ goTo(current); });
})();
</script>

<!-- ===================== 3. BEST SELLERS ===================== -->
<section class="miras-products-section">
  <div class="miras-container">
    <div class="miras-section-header miras-animate-in">
      <span class="miras-section-tag">⭐ الاكثر مبيعا</span>
      <h2 class="miras-section-title">الاعلى مبيعا هذا الاسبوع</h2>
      <p class="miras-section-desc">منتجات اختارها الاف العملاء وأثبتت جودتها.</p>
    </div>
    <div class="miras-products-grid" style="grid-template-columns:repeat(auto-fit,minmax(260px,1fr)); gap:20px;">
      <?php
      $args = ['post_type'=>'product','posts_per_page'=>8,'orderby'=>'popularity','order'=>'DESC','post_status'=>'publish'];
      $products = new WP_Query($args);
      $imgMap = ['honey-section.jpg','coffee-section.jpg','food-products.jpg','gift-boxes.jpg','heritage-crafts.jpg','discover-regions.jpg','product-story.jpg','verified-seller.jpg'];
      $pi = 0;
      if($products->have_posts()):
        while($products->have_posts()): $products->the_post();
          global $product;
          $imgUrl = get_the_post_thumbnail_url(get_the_ID(),'woocommerce_thumbnail') ?: $imgBase . $imgMap[$pi % count($imgMap)];
          $sales  = get_post_meta(get_the_ID(),'total_sales',true) ?: rand(50,500);
          $price  = strip_tags($product->get_price_html());
          if(!$price) $price = 'السعر عند الطلب';
          $pi++;
      ?>
      <a href="<?php the_permalink(); ?>" class="miras-featured-card miras-animate-in delay-<?php echo ($pi%4)+1; ?>" style="aspect-ratio:4/3; display:block; border-radius:var(--radius-lg);">
        <img src="<?php echo esc_url($imgUrl); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy" style="width:100%;height:100%;object-fit:cover;">
        <div class="miras-featured-overlay"></div>
        <div style="position:absolute;top:12px;right:12px;z-index:3;display:flex;gap:8px;align-items:center;">
          <?php
          $cats = get_the_terms(get_the_ID(),'product_cat');
          $cat_name = ($cats && !is_wp_error($cats)) ? $cats[0]->name : '';
          if($cat_name): ?>
            <span style="background:rgba(23,63,53,.8);backdrop-filter:blur(4px);color:#f7f3ea;font-size:10px;font-weight:700;padding:4px 10px;border-radius:20px;"><?php echo esc_html($cat_name); ?></span>
          <?php endif; ?>
          <?php if(intval($sales) > 200): ?>
            <span class="miras-badge miras-badge-verified" style="font-size:10px;padding:4px 8px;border-radius:20px;">🔥 رائج</span>
          <?php endif; ?>
        </div>
        <div style="display:flex;justify-content:space-between;align-items:flex-end;gap:10px;position:absolute;bottom:0;right:0;left:0;padding:20px;z-index:2;">
          <div style="flex:1;">
            <h3 class="miras-featured-title" style="margin-bottom:6px;font-size:16px;line-height:1.4;color:#fff;text-shadow:0 2px 4px rgba(0,0,0,0.5);"><?php the_title(); ?></h3>
            <p class="miras-featured-desc" style="margin-bottom:0;font-size:12px;color:rgba(255,255,255,0.9);font-weight:500;">🛒 <?php echo $sales; ?> طلب</p>
          </div>
          <div style="color:var(--miras-charcoal);background:var(--miras-gold);padding:6px 12px;border-radius:8px;font-weight:800;font-size:14px;white-space:nowrap;box-shadow:0 4px 10px rgba(0,0,0,0.3);">
            <?php echo $price; ?>
          </div>
        </div>
      </a>
      <?php endwhile; wp_reset_postdata();
      else:
      endif; ?>
    </div>
    <div class="miras-section-view-all">
      <a href="<?php echo esc_url($shopUrl); ?>" class="miras-btn-outline">عرض كل المنتجات &larr;</a>
    </div>
  </div>
</section>

<!-- ===================== 5. PRODUCT STORY ===================== -->
<section class="miras-story-section">
  <div class="miras-story-inner">
    <div class="miras-story-image miras-animate-in">
      <img src="<?php echo $imgBase; ?>product-story.jpg" alt="قصة المنتج">
      <div class="miras-story-image-overlay"></div>
    </div>
    <div class="miras-story-content miras-animate-in delay-1">
      <span class="miras-section-tag">🌿 قصتنا مع الجودة</span>
      <h2 class="miras-section-title">من يد الحرفي إلى بيتك</h2>
      <p class="miras-story-desc">نحن نؤمن بأن المنتج الجيد يبدأ من مصدره. لذا نتعاون مع امهر الحرفيين واصدق المزارعين اليمنيين لنضمن لك جودة لا تضاهى في كل طلب.</p>
      <div class="miras-story-steps">
        <div class="miras-story-step"><div class="miras-story-step-icon">🌿</div><div><div class="miras-story-step-title">الاختيار الدقيق</div><div class="miras-story-step-desc">نختار كل منتج بعناية من مصدره المعتمد.</div></div></div>
        <div class="miras-story-step"><div class="miras-story-step-icon">✅</div><div><div class="miras-story-step-title">فحص الجودة</div><div class="miras-story-step-desc">نفحص كل دفعة للتأكد من الجودة والاصالة.</div></div></div>
        <div class="miras-story-step"><div class="miras-story-step-icon">📦</div><div><div class="miras-story-step-title">التغليف الامن</div><div class="miras-story-step-desc">نغلف المنتجات بعناية لتصل إليك بافضل حال.</div></div></div>
      </div>
      <br>
      <a href="<?php echo esc_url($aboutUrl); ?>" class="miras-btn-outline-light">اعرف قصتنا كاملة</a>
    </div>
  </div>
</section>

<!-- ===================== 6. SELLERS OF THE WEEK ===================== -->
<section class="miras-sellers-section">
  <div class="miras-container">
    <div class="miras-section-header miras-animate-in">
      <span class="miras-section-tag">⭐ بائعو الاسبوع</span>
      <h2 class="miras-section-title">افضل البائعين لهذا الاسبوع</h2>
      <p class="miras-section-desc">بائعون موثوقون اختارهم الاف المتسوقين هذا الاسبوع.</p>
    </div>
    <div class="miras-sellers-grid">
      <?php
      $sellers = [
        ['emoji'=>'🧑‍🌾','name'=>'ابو احمد الحداد','location'=>'صنعاء، اليمن','rating'=>'4.9','orders'=>'+450','products'=>24],
        ['emoji'=>'👨','name'=>'فارس من اليمن السعيد','location'=>'تعز، اليمن','rating'=>'5.0','orders'=>'+620','products'=>18],
        ['emoji'=>'🧕','name'=>'ام خالد العطار','location'=>'حضرموت، اليمن','rating'=>'4.8','orders'=>'+380','products'=>35],
      ];
      foreach($sellers as $si => $seller): ?>
      <div class="miras-seller-card miras-animate-in delay-<?php echo $si+1; ?>">
        <div class="miras-seller-avatar"><?php echo $seller['emoji']; ?></div>
        <h3 class="miras-seller-name"><?php echo $seller['name']; ?></h3>
        <div class="miras-seller-location">📍 <?php echo $seller['location']; ?></div>
        <div class="miras-seller-stats">
          <div class="miras-seller-stat"><span class="miras-seller-stat-val"><?php echo $seller['rating']; ?></span><span class="miras-seller-stat-key">تقييم</span></div>
          <div class="miras-seller-stat"><span class="miras-seller-stat-val"><?php echo $seller['orders']; ?></span><span class="miras-seller-stat-key">طلب</span></div>
          <div class="miras-seller-stat"><span class="miras-seller-stat-val"><?php echo $seller['products']; ?></span><span class="miras-seller-stat-key">منتج</span></div>
        </div>
        <a href="<?php echo esc_url($shopUrl); ?>" class="miras-seller-verified-badge">✅ بائع موثق في مراس</a>
      </div>
      <?php endforeach; ?>
    </div>
    <div class="miras-section-view-all">
      <a href="<?php echo esc_url($sellerUrl); ?>" class="miras-btn-outline-light">كن بائعا معنا</a>
    </div>
  </div>
</section>

<!-- ===================== 7. MIRAS VERIFIED ===================== -->
<section class="miras-verified-section">
  <div class="miras-verified-inner">
    <div class="miras-verified-content miras-animate-in">
      <h2 class="miras-section-title">✅ مراس موثق — لماذا تختارنا؟</h2>
      <p class="miras-verified-desc">نحن لسنا مجرد متجر — نحن منصة تضمن لك الجودة والاصالة في كل منتج تشتريه.</p>
      <div class="miras-verified-features">
        <div class="miras-verified-feature"><div class="miras-verified-feature-icon">🛡️</div><div class="miras-verified-feature-text"><strong>جودة مضمونة</strong><span>نفحص كل منتج قبل عرضه للبيع للتأكد من اصالته.</span></div></div>
        <div class="miras-verified-feature"><div class="miras-verified-feature-icon">🤝</div><div class="miras-verified-feature-text"><strong>بائعون موثوقون</strong><span>نتحقق من هوية كل بائع وجودة منتجاته قبل القبول.</span></div></div>
        <div class="miras-verified-feature"><div class="miras-verified-feature-icon">↩</div><div class="miras-verified-feature-text"><strong>سياسة إرجاع سهلة</strong><span>لا تقلق، إذا لم تكن راضيا سنعيد لك اموالك.</span></div></div>
      </div>
      <br>
      <a href="<?php echo esc_url($sellerUrl); ?>" class="miras-btn-primary">انضم كبائع الآن</a>
    </div>
    <div class="miras-animate-in delay-2">
      <img src="<?php echo $imgBase; ?>verified-seller.jpg" alt="بائع موثق" style="border-radius:var(--radius-xl);box-shadow:var(--shadow-xl);width:100%;">
    </div>
  </div>
</section>

<!-- ===================== 8. ABOUT / BRAND CLOSING ===================== -->
<section class="miras-about-section">
  <div class="miras-about-bg" style="background-image:url('<?php echo $imgBase; ?>brand-closing.jpg')"></div>
  <div class="miras-about-inner miras-animate-in">
    <h2 class="miras-about-tagline">اليمن في قلبنا — الجودة في كل منتج</h2>
    <p class="miras-about-desc">مراس هي منصة يمنية متخصصة في المنتجات الاصيلة. نربط المنتجين اليمنيين بالعالم بكل ثقة واحترافية.</p>
    <div class="miras-about-stats">
      <div class="miras-about-stat"><strong>+500</strong><span>منتج متاح</span></div>
      <div class="miras-about-stat"><strong>50+</strong><span>بائع موثق</span></div>
      <div class="miras-about-stat"><strong>24/7</strong><span>دعم فوري</span></div>
    </div>
    <div style="display:flex;gap:16px;justify-content:center;flex-wrap:wrap;">
      <a href="<?php echo esc_url($shopUrl); ?>" class="miras-btn-primary">ابدأ التسوق الآن</a>
      <a href="<?php echo esc_url($aboutUrl); ?>" class="miras-btn-outline">من نحن</a>
    </div>
  </div>
</section>


<?php get_footer(); ?>
