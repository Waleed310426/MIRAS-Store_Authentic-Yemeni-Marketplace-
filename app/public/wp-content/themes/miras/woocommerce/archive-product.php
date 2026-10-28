<?php
/**
 * The Template for displaying product archives
 */
get_header();
$imgBase = content_url('uploads/miras-images/');
?>

<div class="miras-shop-page">
  <!-- Shop Hero Banner -->
  <div class="miras-shop-hero" style="background:var(--miras-primary);padding:80px 24px 50px;text-align:center;position:relative;overflow:hidden;margin-top:76px;">
    <div style="position:absolute;inset:0;background-image:url('<?php echo $imgBase; ?>hero-main.jpg');background-size:cover;background-position:center;opacity:0.15;"></div>
    <div style="position:relative;z-index:1;">
      <?php woocommerce_breadcrumb(); ?>
      <h1 style="font-size:clamp(28px,4vw,48px);font-weight:800;color:var(--miras-ivory);margin-bottom:12px;">
        <?php
        if(is_product_category()) {
          $cat = get_queried_object();
          echo esc_html($cat->name);
        } else {
          echo 'جميع المنتجات اليمنية';
        }
        ?>
      </h1>
      <p style="color:rgba(247,243,234,.7);font-size:16px;">منتجات يمنية أصلية مختارة بعناية</p>
    </div>
  </div>

  <div class="miras-container" style="padding:60px 24px;">
    <div class="miras-shop-layout">
      <!-- Filters Sidebar -->
      <aside class="miras-shop-sidebar">
        <div class="miras-sidebar-card">
          <h3 class="miras-sidebar-title">تصفح الأقسام</h3>
          <?php
          $cats = get_terms(['taxonomy'=>'product_cat','hide_empty'=>false,'parent'=>0,'exclude'=>[get_option('default_product_cat')]]);
          if($cats && !is_wp_error($cats)):
            echo '<ul class="miras-cat-filter-list">';
            echo '<li><a href="'.esc_url(get_permalink(wc_get_page_id('shop'))).'" class="miras-cat-link'.(is_shop()&&!is_product_category()?' active':'').'">';
            echo '🛍️ جميع المنتجات</a></li>';
            foreach($cats as $cat):
              $icons = ['honey'=>'🍯','coffee'=>'☕','nuts'=>'🥜','herbs'=>'🌿','spices'=>'🌶️','farming'=>'🌾','heritage'=>'🏺','gifts'=>'🎁','clothing'=>'👗','beauty'=>'🧴','luban-samn'=>'🥛','bakhoor-atoor'=>'🪔','yemeni-agriculture'=>'🌾'];
              $icon = $icons[$cat->slug] ?? '📦';
              $active = (is_product_category() && get_queried_object()->slug == $cat->slug) ? ' active' : '';
              echo '<li><a href="'.esc_url(get_term_link($cat)).'" class="miras-cat-link'.$active.'">';
              echo $icon.' '.esc_html($cat->name).' <span>('.$cat->count.')</span></a></li>';
            endforeach;
            echo '</ul>';
          endif;
          ?>
        </div>

        <div class="miras-sidebar-card" style="margin-top:20px;">
          <h3 class="miras-sidebar-title">السعر (ريال يمني)</h3>
          <div class="miras-price-filter-custom">
            <form method="get" action="<?php echo esc_url(wc_get_page_permalink('shop')); ?>">
              <div style="display:flex;align-items:center;gap:10px;margin-bottom:15px;">
                <input type="number" name="min_price" placeholder="من (ريال)" value="<?php echo isset($_GET['min_price'])?esc_attr($_GET['min_price']):''; ?>" style="width:100%;padding:8px;border:1px solid #ddd;border-radius:6px;font-family:inherit;">
                <span style="color:#888;">-</span>
                <input type="number" name="max_price" placeholder="إلى (ريال)" value="<?php echo isset($_GET['max_price'])?esc_attr($_GET['max_price']):''; ?>" style="width:100%;padding:8px;border:1px solid #ddd;border-radius:6px;font-family:inherit;">
              </div>
              <button type="submit" class="miras-btn-gold" style="width:100%;padding:8px;border-radius:6px;font-size:14px;">تطبيق الفلتر</button>
            </form>
          </div>
        </div>

        <div class="miras-sidebar-card" style="margin-top:20px;">
          <h3 class="miras-sidebar-title">نوع البائع 🛡️</h3>
          <ul class="miras-cat-filter-list">
            <li><a href="?seller_type=all" class="miras-cat-link <?php echo (!isset($_GET['seller_type']) || $_GET['seller_type']=='all')?'active':''; ?>">جميع البائعين</a></li>
            <li><a href="?seller_type=verified" class="miras-cat-link <?php echo (isset($_GET['seller_type']) && $_GET['seller_type']=='verified')?'active':''; ?>" style="color:#007bff;font-weight:bold;">بائع موثق فقط ✔️</a></li>
          </ul>
        </div>
      </aside>

      <!-- Products Grid -->
      <div class="miras-shop-main">
        <?php if(have_posts()): ?>
        <div class="miras-shop-toolbar">
          <span class="miras-results-count">
            <?php
            global $wp_query;
            echo $wp_query->found_posts . ' نتيجة';
            ?>
          </span>
          <div class="miras-sort-wrap">
            <?php woocommerce_catalog_ordering(); ?>
          </div>
        </div>
        <div class="miras-products-grid miras-shop-grid">
          <?php
          while(have_posts()): the_post();
            global $product;
            $imgUrl = get_the_post_thumbnail_url(get_the_ID(),'woocommerce_thumbnail');
            if(!$imgUrl){
                $terms=wp_get_post_terms(get_the_ID(),'product_cat');
                $c_slug=$terms&&!is_wp_error($terms)?$terms[0]->slug:'';
                if(strpos($c_slug,'honey')!==false || strpos(urldecode($c_slug),'عسل')!==false)$imgUrl=content_url('uploads/miras-images/honey-section.jpg');
                elseif(strpos($c_slug,'coffee')!==false || strpos(urldecode($c_slug),'بن')!==false)$imgUrl=content_url('uploads/miras-images/coffee-section.jpg');
                elseif(strpos($c_slug,'heritage')!==false || strpos(urldecode($c_slug),'تراث')!==false)$imgUrl=content_url('uploads/miras-images/heritage-crafts.jpg');
                elseif(strpos($c_slug,'gift')!==false || strpos(urldecode($c_slug),'هدايا')!==false)$imgUrl=content_url('uploads/miras-images/gift-boxes.jpg');
                else $imgUrl=content_url('uploads/miras-images/food-products.jpg');
            }
          ?>
          <div class="miras-product-card">
            <div class="miras-product-badge">
              <span class="miras-badge miras-badge-verified">بائع موثق 🛡️</span>
              <?php if($product->is_on_sale()): ?><span class="miras-badge miras-badge-sale">تخفيض</span><?php endif; ?>
            </div>
            <a href="<?php the_permalink(); ?>" class="miras-product-image-wrap">
              <img src="<?php echo esc_url($imgUrl); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
            </a>
            <div class="miras-product-body">
              <a href="<?php the_permalink(); ?>"><h3 class="miras-product-name"><?php the_title(); ?></h3></a>
              <div class="miras-product-rating">
                <div class="miras-stars">⭐⭐⭐⭐⭐</div>
              </div>
              <div class="miras-product-footer">
                <div class="miras-product-price">
                  <span class="miras-price-current"><?php echo $product->get_price_html(); ?></span>
                </div>
                <a href="<?php echo esc_url($product->add_to_cart_url()); ?>"
                   class="miras-add-to-cart ajax_add_to_cart add_to_cart_button"
                   data-product_id="<?php echo get_the_ID(); ?>"
                   rel="nofollow">+</a>
              </div>
            </div>
          </div>
          <?php endwhile; ?>
        </div>
        <div class="miras-pagination" style="text-align:center;margin-top:48px;">
          <?php woocommerce_pagination(); ?>
        </div>
        <?php else: ?>
        <div style="text-align:center;padding:80px 20px;background:#fff;border-radius:var(--radius-xl);">
          <div style="font-size:64px;margin-bottom:20px;">🔍</div>
          <h2 style="color:var(--miras-charcoal);margin-bottom:12px;">لا توجد منتجات هنا</h2>
          <p style="color:var(--miras-charcoal-light);">حاول تعديل فلاتر البحث للعثور على ما تبحث عنه.</p>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

<?php get_footer(); ?>
