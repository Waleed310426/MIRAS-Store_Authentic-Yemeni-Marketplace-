<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
<link rel="profile" href="https://gmpg.org/xfn/11">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- ====== SEARCH OVERLAY ====== -->
<div id="miras-search-overlay" class="miras-search-overlay">
  <div class="miras-search-overlay-backdrop" id="miras-search-backdrop"></div>
  <div class="miras-search-panel">
    <div class="miras-search-panel-header">
      <div class="miras-search-logo-small">
        <span class="miras-search-logo-text">مِراس</span>
        <span class="miras-search-logo-sub">ابحث في منتجاتنا اليمنية الأصيلة</span>
      </div>
      <button class="miras-search-close" id="miras-search-close" aria-label="إغلاق">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
      </button>
    </div>
    <div class="miras-search-input-wrapper">
      <?php if (shortcode_exists('fibosearch') || shortcode_exists('wcas-search-form')): ?>
        <?php echo do_shortcode('[fibosearch]'); ?>
      <?php else: ?>
        <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="miras-search-form-fallback">
          <input type="search" class="miras-search-input-native" placeholder="ابحث عن عسل، بن يمني، بهارات..." value="<?php echo get_search_query(); ?>" name="s" autocomplete="off" />
          <input type="hidden" name="post_type" value="product" />
          <button type="submit" class="miras-search-btn-submit">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
          </button>
        </form>
      <?php endif; ?>
    </div>
    <div class="miras-search-quick-links">
      <span class="miras-search-quick-label">تصفح الأقسام بسرعة</span>
      <div class="miras-search-cats">
        <?php $cats = get_terms(['taxonomy'=>'product_cat','hide_empty'=>true,'number'=>8,'parent'=>0]);
        if(!is_wp_error($cats)) foreach($cats as $cat):
          $icon='🛍️';
          if(str_contains($cat->slug,'honey'))$icon='🍯';
          elseif(str_contains($cat->slug,'coffee'))$icon='☕';
          elseif(str_contains($cat->slug,'nuts'))$icon='🥜';
          elseif(str_contains($cat->slug,'spice'))$icon='🌶️';
          elseif(str_contains($cat->slug,'heritage')||str_contains($cat->slug,'craft'))$icon='🏺';
          elseif(str_contains($cat->slug,'gift'))$icon='🎁';
        ?>
          <a href="<?php echo esc_url(get_term_link($cat)); ?>" class="miras-search-cat-chip"><?php echo $icon.' '.esc_html($cat->name); ?></a>
        <?php endforeach; ?>
      </div>
    </div>
    <div class="miras-search-trending">
      <span class="miras-search-trending-label">عمليات بحث شائعة</span>
      <div class="miras-search-trends">
        <button class="miras-trend-tag" onclick="mirasSearchFill('عسل سدر')">عسل سدر</button>
        <button class="miras-trend-tag" onclick="mirasSearchFill('بن حرازي')">بن حرازي</button>
        <button class="miras-trend-tag" onclick="mirasSearchFill('حوائج يمني')">حوائج يمني</button>
        <button class="miras-trend-tag" onclick="mirasSearchFill('زبيب حرازي')">زبيب حرازي</button>
        <button class="miras-trend-tag" onclick="mirasSearchFill('هدية يمنية')">هدية يمنية</button>
        <button class="miras-trend-tag" onclick="mirasSearchFill('خنجر يمني')">خنجر يمني</button>
      </div>
    </div>
  </div>
</div>

<header id="miras-header">
  <div class="miras-header-inner">

    <a href="<?php echo esc_url(home_url('/')); ?>" class="miras-logo">
      <span class="miras-logo-circle-wrapper"><img src="<?php echo miras_get_upload_url('miras-logo.png'); ?>" alt="<?php bloginfo('name'); ?>"></span>
      <div class="miras-logo-text">
        <span class="miras-logo-ar">مِراس</span>
        <span class="miras-logo-en">MIRAS</span>
      </div>
    </a>

    <nav class="miras-nav" id="miras-nav" id="miras-nav">
      <ul>
        <li <?php echo is_front_page() ? 'class="current-menu-item"' : ''; ?>>
          <a href="<?php echo esc_url(home_url('/')); ?>">الرئيسية</a>
        </li>
        <li <?php echo (is_shop()||is_product_category()) ? 'class="current-menu-item"' : ''; ?>>
          <a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>">الأقسام</a>
        </li>
        <li <?php echo is_page('about') ? 'class="current-menu-item"' : ''; ?>>
          <a href="<?php echo esc_url(home_url('/about/')); ?>">من نحن</a>
        </li>
        <li <?php echo get_the_ID()==28 ? 'class="current-menu-item"' : ''; ?>>
          <a href="<?php echo esc_url(get_permalink(28)); ?>">كن بائعاً</a>
        </li>
        <li <?php echo get_the_ID()==29 ? 'class="current-menu-item"' : ''; ?>>
          <a href="<?php echo esc_url(get_permalink(29)); ?>">تواصل معنا</a>
        </li>
      </ul>
    </nav>

    <div class="miras-header-actions">

      <!-- ===== THEME TOGGLE ===== -->
      <button id="miras-header-theme-toggle" class="miras-header-theme-toggle" type="button" aria-label="????? ?????">
        <div class="miras-toggle-track">
          <span class="miras-toggle-icon miras-icon-moon"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-top:2px"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path></svg></span>
          <span class="miras-toggle-icon miras-icon-sun"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-top:2px"><circle cx="12" cy="12" r="5"></circle><line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line><line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line></svg></span>
          <div class="miras-toggle-thumb"></div>
        </div>
      </button>
      
      <!-- ===== SEARCH BAR TRIGGER ===== -->
      <button id="miras-search-trigger" class="miras-search-bar-trigger" type="button" aria-label="بحث عن منتجك">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
        <span class="miras-search-bar-text">ابحث عن منتجك...</span>
        
      </button>

      <?php if (function_exists('WC')): ?>
      <a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="miras-cart-icon" title="السلة">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
        <?php $count = WC()->cart ? WC()->cart->get_cart_contents_count() : 0; ?>
        <span class="miras-cart-count" id="miras-cart-count"><?php echo $count; ?></span>
      </a>
      <?php endif; ?>

      <?php if (is_user_logged_in()): ?>
        <a href="<?php echo esc_url(wc_get_page_permalink('myaccount')); ?>" class="miras-btn-outline-light">👤 حسابي</a>
      <?php else: ?>
        <a href="<?php echo esc_url(wc_get_page_permalink('myaccount')); ?>" class="miras-btn-outline-light">تسجيل الدخول</a>
      <?php endif; ?>

      <a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>" class="miras-btn-gold">تسوق الآن</a>

      <button class="miras-menu-toggle" id="miras-menu-toggle" aria-label="القائمة">
        <span></span><span></span><span></span>
      </button>
    </div>

  </div>
</header>
<main id="primary" class="site-main">
