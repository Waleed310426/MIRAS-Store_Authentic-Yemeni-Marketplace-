<?php
if (!defined('ABSPATH')) exit;
/* ===== MIRAS CUSTOMIZER ===== */
require_once __DIR__ . '/customizer.php';

/* ===== MIRAS THEME SETUP ===== */
function miras_setup() {
    load_theme_textdomain('miras', get_template_directory() . '/languages');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form','comment-form','comment-list','gallery','caption','style','script']);
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
    add_theme_support('custom-logo', ['height'=>60,'width'=>200,'flex-height'=>true,'flex-width'=>true]);
    register_nav_menus(['miras-main-menu'=>__('القائمة الرئيسية','miras'),'miras-footer-menu'=>__('قائمة الفوتر','miras')]);
}
add_action('after_setup_theme','miras_setup');

/* ===== ENQUEUE ASSETS ===== */
function miras_enqueue_scripts() {
    // Fonts
    wp_enqueue_style('miras-fonts', 'https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@300;400;500;600;700&family=Manrope:wght@400;500;600;700;800&family=Noto+Kufi+Arabic:wght@400;500;600;700&display=swap', [], null);
    // Main stylesheet
    wp_enqueue_style('miras-style', get_stylesheet_uri(), ['miras-fonts'], '1.0.0');
    // Main JS
    wp_enqueue_script('miras-main', get_template_directory_uri() . '/assets/js/main.js', ['jquery'], '1.0.0', true);
    // WooCommerce cart fragments
    if (function_exists('WC')) {
        wp_enqueue_script('wc-cart-fragments');
    }
    wp_localize_script('miras-main', 'mirasData', [
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('miras-nonce'),
        'siteUrl' => get_site_url(),
        'cartUrl' => function_exists('wc_get_cart_url') ? wc_get_cart_url() : '#',
        'shopUrl' => function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : '#',
    ]);
}
add_action('wp_enqueue_scripts','miras_enqueue_scripts');

/* ===== WIDGET AREAS ===== */
function miras_widgets_init() {
    register_sidebar(['name'=>'Sidebar','id'=>'sidebar-1','before_widget'=>'<div id="%1$s" class="widget %2$s">','after_widget'=>'</div>','before_title'=>'<h3 class="widget-title">','after_title'=>'</h3>']);
    register_sidebar(['name'=>'Footer Col 1','id'=>'footer-1','before_widget'=>'<div class="widget">','after_widget'=>'</div>','before_title'=>'<h4>','after_title'=>'</h4>']);
}
add_action('widgets_init','miras_widgets_init');

/* ===== WOOCOMMERCE CUSTOMIZATIONS ===== */
// Remove default WC wrappers
remove_action('woocommerce_before_main_content','woocommerce_output_content_wrapper',10);
remove_action('woocommerce_after_main_content','woocommerce_output_content_wrapper_end',10);
add_action('woocommerce_before_main_content','miras_woo_wrapper_start',10);
add_action('woocommerce_after_main_content','miras_woo_wrapper_end',10);
function miras_woo_wrapper_start(){echo '<div class="miras-woo-container miras-container">';}
function miras_woo_wrapper_end(){echo '</div>';}

// Remove WC breadcrumb on homepage
add_filter('woocommerce_show_page_title','__return_true');

// Change WC products per page
add_filter('loop_shop_per_page', function(){ return 12; });

// Change WC columns
add_filter('loop_shop_columns', function(){ return 4; });

// Add verified badge to products
add_action('woocommerce_after_shop_loop_item_title','miras_product_verified_badge',8);
function miras_product_verified_badge(){
    global $product;
    if(get_post_meta($product->get_id(),'_miras_verified',true)){
        echo '<div class="miras-loop-verified"><span class="miras-badge miras-badge-verified">🛡️ بائع موثّق</span></div>';
    }
}

// Region meta to products
add_action('woocommerce_product_meta_end','miras_product_region_meta');
function miras_product_region_meta(){
    global $product;
    $region = get_post_meta($product->get_id(),'_miras_region',true);
    if($region) echo '<div class="miras-product-region">📍 '.$region.'</div>';
    $seller = get_post_meta($product->get_id(),'_miras_seller_name',true);
    if($seller) echo '<div class="miras-product-seller-info">🧑‍🌾 '.$seller.'</div>';
}

/* ===== HELPER FUNCTIONS ===== */
function miras_get_image_url($filename){
    return get_template_directory_uri().'/assets/images/'.$filename;
}

function miras_get_upload_url($filename){
    return content_url('uploads/miras-images/'.$filename);
}

function miras_render_stars($rating = 5, $count = 0){
    $out = '<div class="miras-product-rating"><div class="miras-stars">';
    for($i=1;$i<=5;$i++){
        $out .= '<span class="miras-star'.($i>$rating?' empty':'').'">★</span>';
    }
    $out .= '</div>';
    if($count) $out .= '<span class="miras-rating-count">('.$count.')</span>';
    $out .= '</div>';
    return $out;
}

/* ===== AFTER SETUP: Create WooCommerce pages & cats ===== */
add_action('init','miras_maybe_setup_store',20);
function miras_maybe_setup_store(){
    if(get_option('miras_store_setup_done')) return;
    // We set it up via WP-CLI instead
}

/* ===== RTL Support ===== */
add_action('wp_head','miras_rtl_meta');
function miras_rtl_meta(){
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">';
}

/* ===== Custom excerpt length ===== */
add_filter('excerpt_length',function(){ return 20; });

/* ===== Remove Hello Elementor styles we will override ===== */
add_action('wp_enqueue_scripts','miras_dequeue_parent_styles',20);
function miras_dequeue_parent_styles(){ /* keep parent styles for elementor compatibility */ }

/* ===== Add body class for RTL ===== */
add_filter('body_class','miras_body_class');
function miras_body_class($classes){
    $classes[] = 'miras-theme';
    $classes[] = 'rtl';
    return $classes;
}

/* ===== TRANSLATE WOOCOMMERCE SORTING OPTIONS ===== */
add_filter( 'woocommerce_catalog_orderby', 'miras_rename_sorting_options' );
function miras_rename_sorting_options( $options ) {
    $options['menu_order'] = 'الترتيب الافتراضي';
    $options['popularity'] = 'ترتيب حسب الشهرة';
    $options['rating']     = 'ترتيب حسب التقييم';
    $options['date']       = 'ترتيب حسب الأحدث';
    $options['price']      = 'ترتيب حسب السعر: من الأقل للأعلى';
    $options['price-desc'] = 'ترتيب حسب السعر: من الأعلى للأقل';
    return $options;
}

// Search overlay inline JS
add_action('wp_footer', 'miras_print_search_js', 99);
function miras_print_search_js() {
    $js = <<<'JSEOF'
<script id="miras-search-js">
(function(){
  var ov=document.getElementById('miras-search-overlay');
  var tr=document.getElementById('miras-search-trigger');
  var cl=document.getElementById('miras-search-close');
  var bk=document.getElementById('miras-search-backdrop');
  if(!ov||!tr){return;}
  function inp(){return ov.querySelector('input[type="search"],input.dgwt-wcas-search-input,.miras-search-input-native');}
  function open(){
    ov.classList.add('is-open');
    document.body.classList.add('miras-search-open');
    setTimeout(function(){var i=inp();if(i)i.focus();},220);
  }
  function close(){
    ov.classList.remove('is-open');
    document.body.classList.remove('miras-search-open');
  }
  tr.addEventListener('click',open);
  if(cl)cl.addEventListener('click',close);
  if(bk)bk.addEventListener('click',close);
  document.addEventListener('keydown',function(e){
    if(e.key==='Escape'&&ov.classList.contains('is-open')){close();}
  });
  window.mirasSearchFill=function(t){
    var i=inp();
    if(i){i.value=t;i.dispatchEvent(new Event('input'));i.dispatchEvent(new KeyboardEvent('keyup'));i.focus();}
  };
})();
</script>
JSEOF;
    echo $js;
}

// FiboSearch Arabic Localization
add_filter('dgwt/wcas/labels', function($labels) {
    $labels['search_placeholder'] = 'ابحث عن منتجك اليمني الأصيل...';
    $labels['show_all_results']   = 'عرض جميع النتائج';
    $labels['no_results']         = 'عذراً، لم نجد نتائج لـ';
    $labels['search_submit']      = 'بحث';
    $labels['details_price']      = 'السعر:';
    $labels['details_sku']        = 'رمز المنتج:';
    return $labels;
});

// Mobile nav toggle
add_action('wp_footer', 'miras_mobile_nav_js', 100);
function miras_mobile_nav_js() {
    echo '<script id="miras-mobile-nav-js">
(function(){
  var toggle = document.getElementById("miras-menu-toggle");
  var nav = document.getElementById("miras-nav");
  if(!toggle || !nav) return;
  toggle.addEventListener("click", function(){
    nav.classList.toggle("is-open");
    toggle.classList.toggle("is-active");
  });
  // Close menu on link click
  nav.querySelectorAll("a").forEach(function(link){
    link.addEventListener("click", function(){
      nav.classList.remove("is-open");
      toggle.classList.remove("is-active");
    });
  });
})();
</script>';
}

// ======= SCROLL TO TOP + UI EXTRAS =======
add_action('wp_footer', 'miras_ui_extras', 98);
function miras_ui_extras() {
    echo '
<!-- Scroll to Top -->
<button id="miras-scroll-top" aria-label="?????? ??????" title="?????? ??????">
  <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
    <path d="M18 15l-6-6-6 6"/>
  </svg>
</button>

<style>
/* ===== SCROLL TO TOP BUTTON ===== */
#miras-scroll-top {
  position: fixed;
  bottom: 28px;
  right: 28px;
  width: 50px;
  height: 50px;
  border-radius: 50%;
  background: var(--miras-gold, #c79a45);
  color: #fff;
  border: none;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0 4px 20px rgba(199,154,69,0.45);
  z-index: 9000;
  opacity: 0;
  transform: translateY(20px);
  transition: opacity 0.35s ease, transform 0.35s ease, background 0.2s ease;
  pointer-events: none;
}
#miras-scroll-top.is-visible {
  opacity: 1;
  transform: translateY(0);
  pointer-events: all;
}
#miras-scroll-top:hover {
  background: #b8892f;
  box-shadow: 0 6px 28px rgba(199,154,69,0.6);
  transform: translateY(-3px);
}
#miras-scroll-top svg { pointer-events: none; }

/* ===== LIGHT MODE OVERRIDES ===== */
body.light-mode {
  --miras-primary: #1a5c47;
  --miras-charcoal: #f0ebe0;
  --miras-ivory: #1a2e25;
  --miras-ivory-dark: #e8e0d0;
  --miras-charcoal-light: #3a5244;
  background-color: #f5f0e8 !important;
  color: #1a2e25 !important;
}
body.light-mode #miras-header {
  background: rgba(245, 240, 232, 0.97) !important;
  border-bottom: 1px solid rgba(26,92,71,0.15) !important;
}
body.light-mode .miras-logo-ar { color: #1a2e25 !important; }
body.light-mode .miras-nav ul li a { color: rgba(26,46,37,0.85) !important; }
body.light-mode .miras-nav ul li a:hover,
body.light-mode .miras-nav ul li.current-menu-item a { color: var(--miras-gold) !important; background: rgba(199,154,69,0.08) !important; }
body.light-mode .miras-search-bar-trigger {
  background: rgba(26,46,37,0.08) !important;
  border-color: rgba(26,46,37,0.3) !important;
  color: #1a2e25 !important;
}
body.light-mode .miras-btn-outline-light {
  background: rgba(26,46,37,0.08) !important;
  border-color: rgba(26,46,37,0.3) !important;
  color: #1a2e25 !important;
}
body.light-mode .miras-cart-icon { color: #1a2e25 !important; border-color: rgba(26,46,37,0.3) !important; }
body.light-mode .miras-menu-toggle span { background: #1a2e25 !important; }
body.light-mode .miras-categories-section { background: #f5f0e8 !important; }
body.light-mode .miras-category-card { background: #fff !important; border-color: rgba(26,92,71,0.12) !important; }
body.light-mode .miras-section-title { color: #1a2e25 !important; }
body.light-mode .miras-section-desc { color: #3a5244 !important; }
body.light-mode .miras-products-section { background: #ede7d8 !important; }
body.light-mode .miras-product-card { background: #fff !important; }
body.light-mode .miras-product-name a { color: #1a2e25 !important; }
body.light-mode #miras-scroll-top { background: #1a5c47 !important; }
body.light-mode #miras-footer { background: #1a2e25 !important; }
</style>

<script id="miras-ui-extras-js">
(function(){
  // ---- SCROLL TO TOP ----
  var btn = document.getElementById("miras-scroll-top");
  if(btn){
    window.addEventListener("scroll", function(){
      if(window.scrollY > 320){ btn.classList.add("is-visible"); }
      else { btn.classList.remove("is-visible"); }
    }, {passive:true});
    btn.addEventListener("click", function(){
      window.scrollTo({top:0, behavior:"smooth"});
    });
  }

  // ---- HEADER THEME TOGGLE ----
  var toggle = document.getElementById("miras-header-theme-toggle");
  var body = document.body;
  if(localStorage.getItem("miras-theme") === "light"){ 
      body.classList.add("light-mode"); 
      if (toggle) toggle.classList.add("is-light");
  }
  
  if(toggle){
    toggle.addEventListener("click", function(){
      body.classList.toggle("light-mode");
      toggle.classList.toggle("is-light");
      localStorage.setItem("miras-theme", body.classList.contains("light-mode") ? "light" : "dark");
    });
  }
})();
</script>
';
}

/* ===== CONTACT FORM HANDLER ===== */
add_action('template_redirect', 'miras_handle_contact_form');
function miras_handle_contact_form() {
    if (is_page('contact-2') && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contact_email']) && isset($_POST['contact_message'])) {
        $name = sanitize_text_field($_POST['contact_name']);
        $email = sanitize_email($_POST['contact_email']);
        $phone = sanitize_text_field($_POST['contact_phone']);
        $subject_choice = sanitize_text_field($_POST['contact_subject']);
        $message_text = sanitize_textarea_field($_POST['contact_message']);

        $to = 'Waleedalansi2023@gmail.com';
        $subject = 'رسالة جديدة من تواصل معنا - مِراس';
        
        $body = "لديك رسالة جديدة من نموذج تواصل معنا:\n\n";
        $body .= "الاسم: $name\n";
        $body .= "البريد الإلكتروني: $email\n";
        $body .= "رقم الجوال: $phone\n";
        $body .= "الموضوع: $subject_choice\n\n";
        $body .= "الرسالة:\n$message_text\n";
        
        $headers = array('Content-Type: text/plain; charset=UTF-8');
        $headers[] = 'Reply-To: ' . $name . ' <' . $email . '>';
        
        wp_mail($to, $subject, $body, $headers);
        
        wp_redirect(add_query_arg('msg', 'success', wp_get_referer()));
        exit;
    }
}

add_filter('the_content', 'miras_contact_form_message');
function miras_contact_form_message($content) {
    if (is_page('contact-2') && isset($_GET['msg']) && $_GET['msg'] === 'success') {
        $msg = '
        <div id="miras-success-msg" style="background:#d4edda; color:#155724; padding:15px; border-radius:8px; margin-bottom:20px; font-weight:bold; border:1px solid #c3e6cb; direction:rtl; transition: opacity 0.5s ease;">
            تم إرسال رسالتك بنجاح! سنتواصل معك قريباً.
        </div>
        <script>
            setTimeout(function() {
                var msgBox = document.getElementById("miras-success-msg");
                if(msgBox) {
                    msgBox.style.opacity = "0";
                    setTimeout(function(){ msgBox.style.display = "none"; }, 500);
                }
            }, 5000);
        </script>';
        return $msg . $content;
    }
    return $content;
}

/* ===== GMAIL SMTP CONFIGURATION (LOCALHOST) ===== */
// لكي يعمل الإرسال من السيرفر المحلي، يجب استخدام SMTP الخاص بجوجل
add_action( 'phpmailer_init', 'miras_configure_smtp' );
function miras_configure_smtp( $phpmailer ) {
    $phpmailer->isSMTP();
    $phpmailer->Host       = 'smtp.gmail.com';
    $phpmailer->SMTPAuth   = true;
    $phpmailer->Port       = 465; // أو 587
    $phpmailer->SMTPSecure = 'ssl'; // أو 'tls'
    $phpmailer->Username   = 'Waleedalansi2023@gmail.com'; // بريدك
    
    // ⚠️ ضع كلمة مرور التطبيقات الخاصة بك بدلاً من النجوم بين علامتي التنصيص
    $phpmailer->Password   = '****************'; 
    
    $phpmailer->From       = 'Waleedalansi2023@gmail.com';
    $phpmailer->FromName   = 'منصة مِراس';
}
/* ===== SEO: FORCE ARABIC LANGUAGE ATTRIBUTES ===== */
add_filter('language_attributes', function($output) {
    return 'lang="ar" dir="rtl"';
});



/* ===== RENAME WOOCOMMERCE SORTING OPTIONS ===== */
add_filter('woocommerce_catalog_orderby', function($options) {
    if (isset($options['relevance'])) { $options['relevance'] = 'الترتيب الافتراضي'; }
    if (isset($options['menu_order'])) { $options['menu_order'] = 'الترتيب الافتراضي'; }
    return $options;
}, 999);

add_filter('gettext', function($translated_text, $text, $domain) {
    if ($text === 'Relevance' || $translated_text === 'الملاءمة' || $translated_text === 'Relevance') {
        return 'الترتيب الافتراضي';
    }
    if ($text === 'Default sorting' || $translated_text === 'ترتيب افتراضي') {
        return 'الترتيب الافتراضي';
    }
    return $translated_text;
}, 999, 3);
