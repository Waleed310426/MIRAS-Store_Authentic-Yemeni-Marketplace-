<?php
// تحديث صفحات WordPress مباشرة
define('ABSPATH', __DIR__ . '/');
$_SERVER['HTTP_HOST'] = 'miras.local';
$_SERVER['REQUEST_URI'] = '/';
require_once __DIR__ . '/wp-load.php';

// ==========================================
// 1. تحديث صفحة الأسئلة الشائعة (FAQ) - ID=48
// ==========================================
$faqContent = '<!-- wp:heading {"level":1} -->
<h1 class="wp-block-heading">الأسئلة الشائعة</h1>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>نجيب على أكثر الأسئلة شيوعاً حول تجربة التسوق في مِراس</p>
<!-- /wp:paragraph -->

<!-- wp:details -->
<details class="wp-block-details"><summary>كيف يمكنني تتبع طلبي؟</summary>
<!-- wp:paragraph -->
<p>يمكنك تتبع طلبك بسهولة من خلال الدخول إلى حسابك في الموقع، ثم الانتقال إلى قسم "طلباتي". ستجد تفاصيل الطلب وحالة الشحن بشكل محدث لحظياً.</p>
<!-- /wp:paragraph --></details>
<!-- /wp:details -->

<!-- wp:details -->
<details class="wp-block-details"><summary>ما هي طرق الدفع المتاحة؟</summary>
<!-- wp:paragraph -->
<p>نوفر عدة طرق دفع آمنة تشمل: بطاقات الائتمان (Visa / MasterCard)، مدى، والدفع عند الاستلام. جميع معاملاتنا مشفرة ومؤمنة بالكامل.</p>
<!-- /wp:paragraph --></details>
<!-- /wp:details -->

<!-- wp:details -->
<details class="wp-block-details"><summary>كيف أتأكد من أصالة المنتجات؟</summary>
<!-- wp:paragraph -->
<p>كل منتج في مِراس يمر بعملية فحص دقيقة من قبل خبرائنا المتخصصين قبل عرضه للبيع. نرفق شهادة أصالة مع كل قطعة تراثية أو تحفة فنية.</p>
<!-- /wp:paragraph --></details>
<!-- /wp:details -->

<!-- wp:details -->
<details class="wp-block-details"><summary>ما هي سياسة الإرجاع والاستبدال؟</summary>
<!-- wp:paragraph -->
<p>نتيح لك إرجاع أي منتج خلال 14 يوماً من تاريخ الاستلام بشرط أن يكون بحالته الأصلية. تواصل معنا وسنرشدك خلال عملية الإرجاع بسهولة.</p>
<!-- /wp:paragraph --></details>
<!-- /wp:details -->

<!-- wp:details -->
<details class="wp-block-details"><summary>هل تشحنون خارج المملكة العربية السعودية؟</summary>
<!-- wp:paragraph -->
<p>نعم! نشحن إلى جميع دول الخليج العربي والعالم العربي. تكاليف الشحن تختلف حسب الوجهة وتظهر عند إتمام الطلب.</p>
<!-- /wp:paragraph --></details>
<!-- /wp:details -->

<!-- wp:details -->
<details class="wp-block-details"><summary>كيف يمكنني التواصل مع البائع؟</summary>
<!-- wp:paragraph -->
<p>بإمكانك التواصل مباشرة مع البائع من خلال صفحة المنتج، أو التواصل مع فريق دعم مِراس عبر صفحة "تواصل معنا".</p>
<!-- /wp:paragraph --></details>
<!-- /wp:details -->';

$result1 = wp_update_post(['ID' => 48, 'post_content' => $faqContent]);
echo "FAQ page update: " . ($result1 ? "SUCCESS (ID=$result1)" : "FAILED") . "\n";

// ==========================================
// 2. تحديث صفحة من نحن (About) - ID=24
// ==========================================
$aboutContent = '<!-- wp:heading {"level":1} -->
<h1 class="wp-block-heading">من نحن</h1>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>مِراس منصة رقمية متخصصة في بيع المنتجات التراثية والأصيلة من مختلف أنحاء الوطن العربي. نؤمن بأن التراث ليس مجرد ذكرى، بل هو هوية حية تستحق الصون والتقدير.</p>
<!-- /wp:paragraph -->

<!-- wp:image {"align":"wide","sizeSlug":"large","linkDestination":"none"} -->
<figure class="wp-block-image alignwide size-large"><img src="https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=1200&q=80" alt="منتجات تراثية وحرف يدوية مِراس - عسل يمني وتحف أصيلة" /></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">رسالتنا</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>نسعى إلى ربط المنتجين التقليديين بالمستهلكين في كل مكان، مع ضمان الجودة والأصالة في كل قطعة تُعرض على منصتنا. نحن جسر بين الأصالة والحداثة.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">رؤيتنا</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>أن نكون المرجع الأول في العالم العربي لبيع وشراء المنتجات التراثية الأصيلة، محافظين على الموروث الثقافي للأجيال القادمة.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">فريق العمل</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>يقف خلف مِراس فريق متحمس من المتخصصين في التراث والتجارة الإلكترونية.</p>
<!-- /wp:paragraph -->

<!-- wp:columns {"columns":3} -->
<div class="wp-block-columns">
<!-- wp:column -->
<div class="wp-block-column">
<!-- wp:image {"sizeSlug":"thumbnail","linkDestination":"none","align":"center"} -->
<figure class="wp-block-image aligncenter size-thumbnail"><img src="https://ui-avatars.com/api/?name=%D9%88%D9%84%D9%8A%D8%AF+%D8%A7%D9%84%D8%B9%D9%86%D8%B2%D9%8A&background=2d6a4f&color=fff&size=200&bold=true&font-size=0.33" alt="وليد العنزي - المؤسس والرئيس التنفيذي لمنصة مِراس" /></figure>
<!-- /wp:image -->
<!-- wp:heading {"level":4,"textAlign":"center"} -->
<h4 class="wp-block-heading has-text-align-center">وليد العنزي</h4>
<!-- /wp:heading -->
<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">المؤسس والرئيس التنفيذي</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column">
<!-- wp:image {"sizeSlug":"thumbnail","linkDestination":"none","align":"center"} -->
<figure class="wp-block-image aligncenter size-thumbnail"><img src="https://ui-avatars.com/api/?name=%D9%81%D9%87%D8%AF+%D8%A7%D9%84%D8%B3%D8%A7%D9%84%D9%85&background=1b4332&color=fff&size=200&bold=true&font-size=0.33" alt="فهد السالم - مدير العمليات في مِراس" /></figure>
<!-- /wp:image -->
<!-- wp:heading {"level":4,"textAlign":"center"} -->
<h4 class="wp-block-heading has-text-align-center">فهد السالم</h4>
<!-- /wp:heading -->
<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">مدير العمليات</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column">
<!-- wp:image {"sizeSlug":"thumbnail","linkDestination":"none","align":"center"} -->
<figure class="wp-block-image aligncenter size-thumbnail"><img src="https://ui-avatars.com/api/?name=%D9%86%D9%88%D8%B1%D8%A7+%D8%A7%D9%84%D8%A3%D8%AD%D9%85%D8%AF&background=40916c&color=fff&size=200&bold=true&font-size=0.33" alt="نورا الأحمد - مديرة التسويق في مِراس" /></figure>
<!-- /wp:image -->
<!-- wp:heading {"level":4,"textAlign":"center"} -->
<h4 class="wp-block-heading has-text-align-center">نورا الأحمد</h4>
<!-- /wp:heading -->
<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">مديرة التسويق</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:column -->
</div>
<!-- /wp:columns -->';

$result2 = wp_update_post(['ID' => 24, 'post_content' => $aboutContent]);
echo "About page update: " . ($result2 ? "SUCCESS (ID=$result2)" : "FAILED") . "\n";

// ==========================================
// 3. تحديث صفحة تواصل معنا (Contact) - ID=26
// ==========================================
$contactContent = '<!-- wp:heading {"level":1} -->
<h1 class="wp-block-heading">تواصل معنا</h1>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>نحن هنا لمساعدتك! سواء كانت لديك أسئلة حول الطلبات أو المنتجات، فريقنا جاهز للرد عليك.</p>
<!-- /wp:paragraph -->

<!-- wp:columns -->
<div class="wp-block-columns">
<!-- wp:column {"width":"50%"} -->
<div class="wp-block-column" style="flex-basis:50%">
<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">أرسل لنا رسالة</h3>
<!-- /wp:heading -->

<!-- wp:html -->
<div style="background:#f9f9f9;padding:30px;border-radius:12px;direction:rtl;">
  <form method="post" action="" style="display:flex;flex-direction:column;gap:16px;">
    <div>
      <label style="display:block;margin-bottom:6px;font-weight:600;color:#1b4332;">الاسم الكامل *</label>
      <input type="text" name="contact_name" placeholder="أدخل اسمك الكامل" required style="width:100%;padding:12px 16px;border:2px solid #e0e0e0;border-radius:8px;font-size:15px;box-sizing:border-box;font-family:inherit;" />
    </div>
    <div>
      <label style="display:block;margin-bottom:6px;font-weight:600;color:#1b4332;">البريد الإلكتروني *</label>
      <input type="email" name="contact_email" placeholder="example@email.com" required style="width:100%;padding:12px 16px;border:2px solid #e0e0e0;border-radius:8px;font-size:15px;box-sizing:border-box;font-family:inherit;" />
    </div>
    <div>
      <label style="display:block;margin-bottom:6px;font-weight:600;color:#1b4332;">رقم الجوال</label>
      <input type="tel" name="contact_phone" placeholder="+966 5x xxx xxxx" style="width:100%;padding:12px 16px;border:2px solid #e0e0e0;border-radius:8px;font-size:15px;box-sizing:border-box;font-family:inherit;" />
    </div>
    <div>
      <label style="display:block;margin-bottom:6px;font-weight:600;color:#1b4332;">الموضوع</label>
      <select name="contact_subject" style="width:100%;padding:12px 16px;border:2px solid #e0e0e0;border-radius:8px;font-size:15px;box-sizing:border-box;font-family:inherit;">
        <option value="">اختر موضوع الرسالة</option>
        <option value="order">استفسار عن طلب</option>
        <option value="product">استفسار عن منتج</option>
        <option value="seller">طلب الانضمام كبائع</option>
        <option value="other">أخرى</option>
      </select>
    </div>
    <div>
      <label style="display:block;margin-bottom:6px;font-weight:600;color:#1b4332;">رسالتك *</label>
      <textarea name="contact_message" placeholder="اكتب رسالتك هنا..." required rows="5" style="width:100%;padding:12px 16px;border:2px solid #e0e0e0;border-radius:8px;font-size:15px;box-sizing:border-box;font-family:inherit;resize:vertical;"></textarea>
    </div>
    <button type="submit" style="background:linear-gradient(135deg,#2d6a4f,#1b4332);color:#fff;padding:14px 32px;border:none;border-radius:8px;font-size:16px;font-weight:700;cursor:pointer;font-family:inherit;letter-spacing:0.5px;">إرسال الرسالة ←</button>
  </form>
</div>
<!-- /wp:html -->
</div>
<!-- /wp:column -->

<!-- wp:column {"width":"50%"} -->
<div class="wp-block-column" style="flex-basis:50%">
<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">معلومات التواصل</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>📍 <strong>العنوان:</strong> الرياض، المملكة العربية السعودية</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>📧 <strong>البريد الإلكتروني:</strong> info@miras.sa</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>📞 <strong>الهاتف:</strong> 966-11-000-0000+</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>🕐 <strong>ساعات العمل:</strong> السبت – الخميس، 9 صباحاً – 6 مساءً</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">موقعنا على الخريطة</h3>
<!-- /wp:heading -->

<!-- wp:html -->
<div style="border-radius:12px;overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,0.1);">
  <iframe 
    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3624.6744736986!2d46.67530371537254!3d24.68773628413015!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e2f03890d489399%3A0x23e0c4d19af5a1e!2sRiyadh!5e0!3m2!1sen!2ssa!4v1629900000000!5m2!1sen!2ssa"
    width="100%" 
    height="280" 
    style="border:0;display:block;" 
    allowfullscreen="" 
    loading="lazy"
    title="خريطة موقع مِراس - الرياض">
  </iframe>
</div>
<!-- /wp:html -->
</div>
<!-- /wp:column -->
</div>
<!-- /wp:columns -->';

$result3 = wp_update_post(['ID' => 26, 'post_content' => $contactContent]);
echo "Contact page update: " . ($result3 ? "SUCCESS (ID=$result3)" : "FAILED") . "\n";

// ==========================================
// 4. تحديث Alt Text للصور التي ليس لها alt
// ==========================================
$imageIds = [116,117,118,119,120,121,122,123,124,125,126,127,128,129];
$altTexts = [
    116 => "صندوق هدايا يمني تراثي فاخر - مِراس",
    117 => "خنجر تراثي يمني أصيل - مِراس",
    118 => "بهارات يمنية أصيلة مزيج فريد - مِراس",
    119 => "صينية مكسرات مشكلة يمنية - مِراس",
    120 => "قهوة حراز اليمنية الفاخرة - مِراس",
    121 => "عسل سدر يمني طبيعي - مِراس",
    122 => "عسل سدر دوعني ملكي 500 جرام - مِراس",
    123 => "عسل سمرة جبلي أصلي 1 كيلو - مِراس",
    124 => "عسل السمرة الجبلي الفاخر 750 جرام - مِراس",
    125 => "عسل الأعشاب اليمنية الطبيعي - مِراس",
    126 => "عسل مانيوكا يمني أصيل - مِراس",
    127 => "عسل الزيزفون اليمني الطبيعي - مِراس",
    128 => "عسل الكينا اليمني الصافي - مِراس",
    129 => "عسل البرسيم اليمني الأصلي - مِراس",
];

$altCount = 0;
foreach ($altTexts as $id => $alt) {
    $existing = get_post_meta($id, '_wp_attachment_image_alt', true);
    if (empty($existing)) {
        update_post_meta($id, '_wp_attachment_image_alt', $alt);
        $altCount++;
    }
}
echo "Alt text added/updated for $altCount images\n";

// ==========================================
// 5. تحديث SEO Meta Descriptions عبر RankMath
// ==========================================
$seoPages = [
    48 => [
        'title' => 'الأسئلة الشائعة | مِراس - إجابات على استفساراتك',
        'description' => 'اعثر على إجابات لأكثر الأسئلة شيوعاً حول التسوق في مِراس، طرق الدفع، الشحن، الإرجاع، وأصالة المنتجات التراثية.',
    ],
    24 => [
        'title' => 'من نحن | مِراس - منصة التراث والمنتجات الأصيلة',
        'description' => 'تعرف على مِراس، المنصة الرائدة في بيع المنتجات التراثية والأصيلة. قصتنا، رسالتنا، ورؤيتنا لصون الموروث العربي.',
    ],
    26 => [
        'title' => 'تواصل معنا | مِراس - نحن هنا لمساعدتك',
        'description' => 'تواصل مع فريق مِراس لأي استفسار حول الطلبات، المنتجات، أو الانضمام كبائع. نرد خلال 24 ساعة.',
    ],
    23 => [
        'title' => 'مِراس | منصة التراث العربي الأصيل - تسوق المنتجات التراثية',
        'description' => 'اكتشف أفضل المنتجات التراثية والأصيلة من العالم العربي في مِراس. عسل يمني، تحف، حرف يدوية وأكثر. جودة مضمونة وشحن سريع.',
    ],
];

foreach ($seoPages as $pageId => $seo) {
    update_post_meta($pageId, 'rank_math_title', $seo['title']);
    update_post_meta($pageId, 'rank_math_description', $seo['description']);
    echo "SEO meta updated for page ID $pageId\n";
}

echo "\n=== ALL DONE ===\n";
