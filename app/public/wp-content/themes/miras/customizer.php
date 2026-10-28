<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * MIRAS Theme - WordPress Customizer
 */
function miras_customizer_register( $wp_customize ) {

    /* PANEL */
    $wp_customize->add_panel( 'miras_panel', array(
        'title'       => '🏛️ إعدادات مِراس',
        'description' => 'تحكم كامل بجميع إعدادات ثيم مِراس',
        'priority'    => 30,
    ) );

    /* ── SECTION 1: هوية الموقع ── */
    $wp_customize->add_section( 'miras_identity_section', array(
        'title'    => '🏷️ هوية الموقع',
        'panel'    => 'miras_panel',
        'priority' => 10,
    ) );
    $wp_customize->add_setting( 'miras_site_name_ar', array( 'default' => 'مِراس', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'miras_site_name_ar', array( 'label' => 'اسم الموقع بالعربية', 'section' => 'miras_identity_section', 'type' => 'text' ) );
    $wp_customize->add_setting( 'miras_site_name_en', array( 'default' => 'MIRAS', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'miras_site_name_en', array( 'label' => 'اسم الموقع بالإنجليزية', 'section' => 'miras_identity_section', 'type' => 'text' ) );
    $wp_customize->add_setting( 'miras_site_tagline', array( 'default' => 'منصة التراث العربي الأصيل', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'miras_site_tagline', array( 'label' => 'شعار/وصف الموقع', 'section' => 'miras_identity_section', 'type' => 'text' ) );

    /* ── SECTION 2: الألوان ── */
    $wp_customize->add_section( 'miras_colors_section', array(
        'title'    => '🎨 ألوان مِراس',
        'panel'    => 'miras_panel',
        'priority' => 20,
    ) );
    $colors = array(
        'miras_color_primary'      => array( 'default' => '#173F35', 'label' => 'اللون الأخضر الرئيسي', 'desc' => 'لون الهيدر والأزرار والفوتر' ),
        'miras_color_primary_dark' => array( 'default' => '#0F2A23', 'label' => 'الأخضر الداكن', 'desc' => 'لون الخلفيات الداكنة' ),
        'miras_color_gold'         => array( 'default' => '#C79A45', 'label' => 'اللون الذهبي', 'desc' => 'لون الأسعار والعناصر المميزة' ),
        'miras_color_ivory'        => array( 'default' => '#F7F3EA', 'label' => 'لون الخلفية الكريمية', 'desc' => 'لون خلفية أقسام المنتجات' ),
        'miras_color_charcoal'     => array( 'default' => '#202522', 'label' => 'لون النص الداكن', 'desc' => 'اللون الرئيسي للنصوص' ),
    );
    foreach ( $colors as $id => $data ) {
        $wp_customize->add_setting( $id, array( 'default' => $data['default'], 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'postMessage' ) );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $id, array( 'label' => $data['label'], 'description' => $data['desc'], 'section' => 'miras_colors_section' ) ) );
    }

    /* ── SECTION 3: الخطوط ── */
    $wp_customize->add_section( 'miras_typography_section', array(
        'title'    => '✍️ الخطوط والمقاسات',
        'panel'    => 'miras_panel',
        'priority' => 30,
    ) );
    $wp_customize->add_setting( 'miras_arabic_font', array( 'default' => 'IBM Plex Sans Arabic', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh' ) );
    $wp_customize->add_control( 'miras_arabic_font', array(
        'label' => 'الخط العربي', 'section' => 'miras_typography_section', 'type' => 'select',
        'choices' => array(
            'IBM Plex Sans Arabic' => 'IBM Plex Sans Arabic (الافتراضي)',
            'Noto Kufi Arabic'     => 'Noto Kufi Arabic',
            'Tajawal'              => 'Tajawal',
            'Cairo'                => 'Cairo',
            'Almarai'              => 'Almarai',
            'Rubik'                => 'Rubik',
        ),
    ) );
    $wp_customize->add_setting( 'miras_h1_size', array( 'default' => '3.5rem', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'miras_h1_size', array( 'label' => 'حجم العنوان H1', 'description' => 'مثال: 3.5rem أو 56px', 'section' => 'miras_typography_section', 'type' => 'text' ) );
    $wp_customize->add_setting( 'miras_h2_size', array( 'default' => '2.2rem', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'miras_h2_size', array( 'label' => 'حجم عناوين الأقسام H2', 'description' => 'مثال: 2.2rem أو 36px', 'section' => 'miras_typography_section', 'type' => 'text' ) );
    $wp_customize->add_setting( 'miras_body_size', array( 'default' => '1rem', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'miras_body_size', array( 'label' => 'حجم النص العام', 'description' => 'مثال: 1rem أو 16px', 'section' => 'miras_typography_section', 'type' => 'text' ) );

    /* ── SECTION 4: الهيدر ── */
    $wp_customize->add_section( 'miras_header_section', array(
        'title'    => '📌 إعدادات الهيدر',
        'panel'    => 'miras_panel',
        'priority' => 40,
    ) );
    $wp_customize->add_setting( 'miras_header_shop_btn', array( 'default' => 'تسوق الآن', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'miras_header_shop_btn', array( 'label' => 'نص زر التسوق', 'section' => 'miras_header_section', 'type' => 'text' ) );
    $wp_customize->add_setting( 'miras_header_login_btn', array( 'default' => 'تسجيل الدخول', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'miras_header_login_btn', array( 'label' => 'نص زر تسجيل الدخول', 'section' => 'miras_header_section', 'type' => 'text' ) );
    $wp_customize->add_setting( 'miras_search_placeholder', array( 'default' => 'ابحث عن منتجك...', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'miras_search_placeholder', array( 'label' => 'نص حقل البحث', 'section' => 'miras_header_section', 'type' => 'text' ) );
    $wp_customize->add_setting( 'miras_show_topbar', array( 'default' => true, 'sanitize_callback' => 'miras_sanitize_checkbox', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'miras_show_topbar', array( 'label' => 'إظهار شريط الإعلانات في الأعلى', 'section' => 'miras_header_section', 'type' => 'checkbox' ) );

    /* ── SECTION 5: الهيرو ── */
    $wp_customize->add_section( 'miras_hero_section', array(
        'title'    => '🏠 قسم الهيرو',
        'panel'    => 'miras_panel',
        'priority' => 50,
    ) );
    $wp_customize->add_setting( 'miras_hero_title', array( 'default' => 'رمز الهوية والفخر اليمني', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'miras_hero_title', array( 'label' => 'العنوان الرئيسي', 'section' => 'miras_hero_section', 'type' => 'text' ) );
    $wp_customize->add_setting( 'miras_hero_subtitle', array( 'default' => 'جانبي يمنية صُنعت ببراعة وإتقان', 'sanitize_callback' => 'sanitize_textarea_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'miras_hero_subtitle', array( 'label' => 'النص التوضيحي', 'section' => 'miras_hero_section', 'type' => 'textarea' ) );
    $wp_customize->add_setting( 'miras_hero_btn_shop', array( 'default' => 'تسوق الآن', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'miras_hero_btn_shop', array( 'label' => 'نص زر التسوق', 'section' => 'miras_hero_section', 'type' => 'text' ) );
    $wp_customize->add_setting( 'miras_hero_btn_more', array( 'default' => 'اعرف المزيد', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'miras_hero_btn_more', array( 'label' => 'نص زر اعرف المزيد', 'section' => 'miras_hero_section', 'type' => 'text' ) );

    /* ── SECTION 6: التواصل الاجتماعي ── */
    $wp_customize->add_section( 'miras_social_section', array(
        'title'    => '📱 التواصل الاجتماعي',
        'panel'    => 'miras_panel',
        'priority' => 60,
    ) );
    $socials = array(
        'instagram' => array( 'label' => 'إنستغرام', 'ph' => 'https://instagram.com/username' ),
        'twitter'   => array( 'label' => 'تويتر / إكس', 'ph' => 'https://x.com/username' ),
        'whatsapp'  => array( 'label' => 'واتساب', 'ph' => 'https://wa.me/9671234567' ),
        'tiktok'    => array( 'label' => 'تيك توك', 'ph' => 'https://tiktok.com/@username' ),
        'youtube'   => array( 'label' => 'يوتيوب', 'ph' => 'https://youtube.com/channel/' ),
        'facebook'  => array( 'label' => 'فيسبوك', 'ph' => 'https://facebook.com/page' ),
        'snapchat'  => array( 'label' => 'سناب شات', 'ph' => 'https://snapchat.com/add/username' ),
        'telegram'  => array( 'label' => 'تيليغرام', 'ph' => 'https://t.me/username' ),
    );
    foreach ( $socials as $key => $data ) {
        $wp_customize->add_setting( 'miras_social_' . $key, array( 'default' => '', 'sanitize_callback' => 'esc_url_raw', 'transport' => 'refresh' ) );
        $wp_customize->add_control( 'miras_social_' . $key, array( 'label' => $data['label'], 'description' => $data['ph'], 'section' => 'miras_social_section', 'type' => 'url' ) );
    }

    /* ── SECTION 7: الفوتر ── */
    $wp_customize->add_section( 'miras_footer_section', array(
        'title'    => '📄 إعدادات الفوتر',
        'panel'    => 'miras_panel',
        'priority' => 70,
    ) );
    $wp_customize->add_setting( 'miras_footer_description', array( 'default' => 'منصة التراث العربي الأصيل - تسوق المنتجات اليمنية الأصيلة من مصادرها المعتمدة.', 'sanitize_callback' => 'sanitize_textarea_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'miras_footer_description', array( 'label' => 'وصف الموقع في الفوتر', 'section' => 'miras_footer_section', 'type' => 'textarea' ) );
    $wp_customize->add_setting( 'miras_footer_copyright', array( 'default' => '© ' . gmdate('Y') . ' مِراس | MIRAS - جميع الحقوق محفوظة', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'miras_footer_copyright', array( 'label' => 'نص حقوق النشر', 'section' => 'miras_footer_section', 'type' => 'text' ) );
    $wp_customize->add_setting( 'miras_footer_email', array( 'default' => '', 'sanitize_callback' => 'sanitize_email', 'transport' => 'refresh' ) );
    $wp_customize->add_control( 'miras_footer_email', array( 'label' => 'البريد الإلكتروني للتواصل', 'section' => 'miras_footer_section', 'type' => 'email' ) );
    $wp_customize->add_setting( 'miras_footer_phone', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh' ) );
    $wp_customize->add_control( 'miras_footer_phone', array( 'label' => 'رقم الهاتف / واتساب', 'section' => 'miras_footer_section', 'type' => 'text' ) );
    $wp_customize->add_setting( 'miras_footer_address', array( 'default' => 'اليمن', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh' ) );
    $wp_customize->add_control( 'miras_footer_address', array( 'label' => 'العنوان / الموقع', 'section' => 'miras_footer_section', 'type' => 'text' ) );

    /* ── SECTION 8: إعدادات المتجر ── */
    $wp_customize->add_section( 'miras_woo_section', array(
        'title'    => '🛍️ إعدادات المتجر',
        'panel'    => 'miras_panel',
        'priority' => 80,
    ) );
    $wp_customize->add_setting( 'miras_products_per_page', array( 'default' => '12', 'sanitize_callback' => 'absint', 'transport' => 'refresh' ) );
    $wp_customize->add_control( 'miras_products_per_page', array( 'label' => 'عدد المنتجات في كل صفحة', 'section' => 'miras_woo_section', 'type' => 'number', 'input_attrs' => array( 'min' => 4, 'max' => 48, 'step' => 4 ) ) );
    $wp_customize->add_setting( 'miras_products_columns', array( 'default' => '4', 'sanitize_callback' => 'absint', 'transport' => 'refresh' ) );
    $wp_customize->add_control( 'miras_products_columns', array(
        'label' => 'عدد أعمدة المنتجات', 'section' => 'miras_woo_section', 'type' => 'select',
        'choices' => array( '2' => '2 أعمدة', '3' => '3 أعمدة', '4' => '4 أعمدة (الافتراضي)', '5' => '5 أعمدة' ),
    ) );
    $wp_customize->add_setting( 'miras_show_badges', array( 'default' => true, 'sanitize_callback' => 'miras_sanitize_checkbox', 'transport' => 'refresh' ) );
    $wp_customize->add_control( 'miras_show_badges', array( 'label' => 'إظهار بادجات المنتجات (جديد، مميز، تخفيض)', 'section' => 'miras_woo_section', 'type' => 'checkbox' ) );

    /* ── SECTION 9: إعدادات متقدمة ── */
    $wp_customize->add_section( 'miras_advanced_section', array(
        'title'    => '⚙️ إعدادات متقدمة',
        'panel'    => 'miras_panel',
        'priority' => 90,
    ) );
    $wp_customize->add_setting( 'miras_border_radius', array( 'default' => '16px', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'miras_border_radius', array( 'label' => 'حجم الحواف الدائرية للبطاقات', 'description' => 'مثال: 16px أو 1rem', 'section' => 'miras_advanced_section', 'type' => 'text' ) );
    $wp_customize->add_setting( 'miras_enable_animations', array( 'default' => true, 'sanitize_callback' => 'miras_sanitize_checkbox', 'transport' => 'refresh' ) );
    $wp_customize->add_control( 'miras_enable_animations', array( 'label' => 'تفعيل تأثيرات الحركة', 'section' => 'miras_advanced_section', 'type' => 'checkbox' ) );
    $wp_customize->add_setting( 'miras_dark_mode_default', array( 'default' => false, 'sanitize_callback' => 'miras_sanitize_checkbox', 'transport' => 'refresh' ) );
    $wp_customize->add_control( 'miras_dark_mode_default', array( 'label' => 'تفعيل الوضع الداكن افتراضياً', 'section' => 'miras_advanced_section', 'type' => 'checkbox' ) );
    $wp_customize->add_setting( 'miras_custom_css_extra', array( 'default' => '', 'sanitize_callback' => 'wp_strip_all_tags', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'miras_custom_css_extra', array( 'label' => 'CSS مخصص إضافي', 'description' => 'أضف كود CSS مخصص (بدون &lt;style&gt;)', 'section' => 'miras_advanced_section', 'type' => 'textarea' ) );
}
add_action( 'customize_register', 'miras_customizer_register' );

/* ── Sanitize Checkbox ── */
function miras_sanitize_checkbox( $input ) {
    return ( $input === true || $input === 'on' || $input === '1' || $input === 1 ) ? true : false;
}

/* ── إخراج CSS المتغيرات ── */
function miras_customizer_css_output() {
    $primary      = get_theme_mod( 'miras_color_primary', '#173F35' );
    $primary_dark = get_theme_mod( 'miras_color_primary_dark', '#0F2A23' );
    $gold         = get_theme_mod( 'miras_color_gold', '#C79A45' );
    $ivory        = get_theme_mod( 'miras_color_ivory', '#F7F3EA' );
    $charcoal     = get_theme_mod( 'miras_color_charcoal', '#202522' );
    $h1_size      = get_theme_mod( 'miras_h1_size', '3.5rem' );
    $h2_size      = get_theme_mod( 'miras_h2_size', '2.2rem' );
    $body_size    = get_theme_mod( 'miras_body_size', '1rem' );
    $radius       = get_theme_mod( 'miras_border_radius', '16px' );
    $custom_css   = get_theme_mod( 'miras_custom_css_extra', '' );

    echo '<style id="miras-customizer-css">
:root {
    --miras-primary:      ' . esc_attr( $primary ) . ';
    --miras-primary-dark: ' . esc_attr( $primary_dark ) . ';
    --miras-gold:         ' . esc_attr( $gold ) . ';
    --miras-ivory:        ' . esc_attr( $ivory ) . ';
    --miras-charcoal:     ' . esc_attr( $charcoal ) . ';
    --miras-card-radius:  ' . esc_attr( $radius ) . ';
}
h1 { font-size: ' . esc_attr( $h1_size ) . ' !important; }
h2 { font-size: ' . esc_attr( $h2_size ) . ' !important; }
body { font-size: ' . esc_attr( $body_size ) . '; }
' . wp_strip_all_tags( $custom_css ) . '
</style>';
}
add_action( 'wp_head', 'miras_customizer_css_output', 99 );

/* ── Live Preview - Inline JS ── */
function miras_customizer_live_preview_inline() {
    if ( ! is_customize_preview() ) return;
    ?>
    <script>
    ( function( $, api ) {

        var root = document.documentElement;

        /* Helper: lighten/darken a hex color */
        function hexToRgb(hex) {
            var r = parseInt(hex.slice(1,3),16), g = parseInt(hex.slice(3,5),16), b = parseInt(hex.slice(5,7),16);
            return [r,g,b];
        }
        function adjustColor(hex, amount) {
            var rgb = hexToRgb(hex);
            return '#' + rgb.map(function(c){ return Math.max(0,Math.min(255,c+amount)).toString(16).padStart(2,'0'); }).join('');
        }

        /* ── اللون الأخضر الرئيسي ── */
        /* يشمل: الهيدر، الأزرار، الفوتر، وكل خلفية خضراء */
        api( 'miras_color_primary', function( value ) {
            value.bind( function( newval ) {
                root.style.setProperty( '--miras-primary', newval );
                root.style.setProperty( '--miras-primary-light', adjustColor(newval, 20) );
                root.style.setProperty( '--miras-secondary-green', adjustColor(newval, 60) );
                root.style.setProperty( '--miras-secondary-green-light', adjustColor(newval, 120) );

                /* Header has hardcoded rgba - override directly */
                var header = document.getElementById('miras-header');
                if (header) {
                    header.style.background = newval;
                    header.style.setProperty('background', newval, 'important');
                }
                /* Also handle scrolled state via inline style injection */
                var hStyle = document.getElementById('miras-header-color-override');
                if (!hStyle) { hStyle = document.createElement('style'); hStyle.id = 'miras-header-color-override'; document.head.appendChild(hStyle); }
                hStyle.textContent = '#miras-header { background: ' + newval + ' !important; } #miras-header.scrolled { background: ' + adjustColor(newval, -10) + ' !important; }';

                /* Footer uses --miras-charcoal but logically follows primary for store theme */
                var fStyle = document.getElementById('miras-footer-color-override');
                if (!fStyle) { fStyle = document.createElement('style'); fStyle.id = 'miras-footer-color-override'; document.head.appendChild(fStyle); }
                fStyle.textContent = '#miras-footer { background: ' + adjustColor(newval, -15) + ' !important; }';
            });
        });

        /* ── الأخضر الداكن ── */
        /* يشمل: الخلفيات الداكنة */
        api( 'miras_color_primary_dark', function( value ) {
            value.bind( function( newval ) {
                root.style.setProperty( '--miras-primary-dark', newval );
            });
        });

        /* ── اللون الذهبي ── */
        /* يشمل: الأسعار، الأزرار الذهبية، الشعار، العناصر المميزة */
        api( 'miras_color_gold', function( value ) {
            value.bind( function( newval ) {
                root.style.setProperty( '--miras-gold', newval );
                root.style.setProperty( '--miras-gold-dark', adjustColor(newval, -20) );
                root.style.setProperty( '--miras-gold-light', adjustColor(newval, 40) );
            });
        });

        /* ── لون الخلفية الكريمية ── */
        /* يشمل: خلفية أقسام المنتجات، الأقسام الفاتحة */
        api( 'miras_color_ivory', function( value ) {
            value.bind( function( newval ) {
                root.style.setProperty( '--miras-ivory', newval );
                root.style.setProperty( '--miras-ivory-dark', adjustColor(newval, -15) );
            });
        });

        /* ── لون النص الداكن ── */
        /* يشمل: كل النصوص الرئيسية */
        api( 'miras_color_charcoal', function( value ) {
            value.bind( function( newval ) {
                root.style.setProperty( '--miras-charcoal', newval );
                root.style.setProperty( '--miras-charcoal-light', adjustColor(newval, 30) );
            });
        });

        /* ── حجم الخطوط ── */
        api( 'miras_h1_size', function( value ) {
            value.bind( function( newval ) {
                var s = document.getElementById('miras-typo-live') || (function(){ var el=document.createElement('style'); el.id='miras-typo-live'; document.head.appendChild(el); return el; })();
                s.textContent = 'h1{font-size:'+newval+' !important}';
            });
        });
        api( 'miras_h2_size', function( value ) {
            value.bind( function( newval ) {
                var s = document.getElementById('miras-typo-h2-live') || (function(){ var el=document.createElement('style'); el.id='miras-typo-h2-live'; document.head.appendChild(el); return el; })();
                s.textContent = 'h2{font-size:'+newval+' !important}';
            });
        });
        api( 'miras_body_size', function( value ) {
            value.bind( function( newval ) {
                root.style.fontSize = newval;
            });
        });

        /* ── الحواف الدائرية ── */
        api( 'miras_border_radius', function( value ) {
            value.bind( function( newval ) {
                root.style.setProperty( '--miras-card-radius', newval );
            });
        });

    })( jQuery, wp.customize );
    </script>
    <?php
}
add_action( 'wp_footer', 'miras_customizer_live_preview_inline', 999 );

/* ── Helper Function ── */
function miras_get_option( $key, $default = '' ) {
    return get_theme_mod( $key, $default );
}