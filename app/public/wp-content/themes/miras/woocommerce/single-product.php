<?php
/**
 * Single Product Template
 */
get_header();
$imgBase = content_url('uploads/miras-images/');
?>
<div style="margin-top:76px; background:var(--miras-ivory); min-height:60vh;">
  <div class="miras-container" style="padding:60px 24px;">
    <?php while(have_posts()): the_post(); global $product; ?>
    <div class="woocommerce-product-breadcrumb" style="margin-bottom:24px;">
      <a href="<?php echo home_url(); ?>" style="color:var(--miras-primary);">الرئيسية</a>
      <span style="margin:0 8px;color:var(--miras-charcoal-light);">/</span>
      <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>" style="color:var(--miras-primary);">المتجر</a>
      <span style="margin:0 8px;color:var(--miras-charcoal-light);">/</span>
      <span style="color:var(--miras-charcoal-light);"><?php the_title(); ?></span>
    </div>

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:60px;align-items:start;background:#fff;border-radius:var(--radius-xl);padding:40px;box-shadow:var(--shadow-md);">
      <!-- Product Image -->
      <div>
        <?php
        $thumbUrl = get_the_post_thumbnail_url(get_the_ID(),'large');
        if(!$thumbUrl){
            $terms=wp_get_post_terms(get_the_ID(),'product_cat');
            $c_slug=$terms&&!is_wp_error($terms)?$terms[0]->slug:'';
            if(strpos($c_slug,'honey')!==false || strpos(urldecode($c_slug),'عسل')!==false)$thumbUrl=$imgBase.'honey-section.jpg';
            elseif(strpos($c_slug,'coffee')!==false || strpos(urldecode($c_slug),'بن')!==false)$thumbUrl=$imgBase.'coffee-section.jpg';
            elseif(strpos($c_slug,'heritage')!==false || strpos(urldecode($c_slug),'تراث')!==false)$thumbUrl=$imgBase.'heritage-crafts.jpg';
            elseif(strpos($c_slug,'gift')!==false || strpos(urldecode($c_slug),'هدايا')!==false)$thumbUrl=$imgBase.'gift-boxes.jpg';
            else $thumbUrl=$imgBase.'food-products.jpg';
        }
        ?>
        <div style="border-radius:var(--radius-xl);overflow:hidden;aspect-ratio:1;background:var(--miras-ivory);position:relative;">
          <img src="<?php echo esc_url($thumbUrl); ?>" alt="<?php the_title_attribute(); ?>" style="width:100%;height:100%;object-fit:cover;">
          <?php if($product->is_on_sale()): ?>
          <span style="position:absolute;top:20px;right:20px;background:#e74c3c;color:#fff;padding:4px 12px;border-radius:20px;font-weight:bold;font-size:14px;">تخفيض!</span>
          <?php endif; ?>
        </div>
      </div>

      <!-- Product Info -->
      <div>
        <div style="display:inline-flex;align-items:center;gap:6px;padding:6px 14px;background:var(--miras-secondary-green-light);color:var(--miras-primary);border-radius:var(--radius-full);font-size:12px;font-weight:600;margin-bottom:16px;">
          بائع موثق من مِراس 🛡️
        </div>

        <h1 style="font-size:28px;font-weight:800;color:var(--miras-charcoal);margin-bottom:16px;line-height:1.3;"><?php the_title(); ?></h1>

        <!-- Rating -->
        <div style="display:flex;align-items:center;gap:8px;margin-bottom:20px;">
          <div style="color:var(--miras-gold);font-size:18px;">⭐⭐⭐⭐⭐</div>
          <span style="font-size:13px;color:var(--miras-charcoal-light);">(<?php echo $product->get_review_count() ?: 5; ?> تقييمات)</span>
        </div>

        <!-- Price -->
        <div class="miras-single-price-wrap" style="font-size:32px;font-weight:800;color:var(--miras-primary);margin-bottom:24px;font-family:'Manrope',sans-serif;">
          <?php echo $product->get_price_html(); ?>
        </div>

        <!-- Short Description -->
        <?php if($product->get_short_description()): ?>
        <div style="font-size:15px;line-height:1.8;color:var(--miras-charcoal-light);margin-bottom:28px;padding:20px;background:var(--miras-ivory);border-radius:var(--radius-md);">
          <?php echo $product->get_short_description(); ?>
        </div>
        <?php else: ?>
        <div style="font-size:15px;line-height:1.8;color:var(--miras-charcoal-light);margin-bottom:28px;padding:20px;background:var(--miras-ivory);border-radius:var(--radius-md);">
          منتج يمني أصيل، يتميز بجودته العالية ومطابقته لأعلى المعايير. تم تغليفه بعناية لضمان وصوله إليك بأفضل صورة ممكنة.
        </div>
        <?php endif; ?>

        <!-- Add to Cart (Includes Variations) -->
        <div class="miras-add-to-cart-wrapper">
            <?php woocommerce_template_single_add_to_cart(); ?>
        </div>

        <!-- Product Meta -->
        <div style="margin-top:28px;padding:20px;background:var(--miras-secondary-green-light);border-radius:var(--radius-lg);">
          <?php
          $region = get_post_meta(get_the_ID(),'_miras_region',true) ?: 'صنعاء - اليمن';
          $seller = get_post_meta(get_the_ID(),'_miras_seller_name',true) ?: 'متاجر مِراس الموثوقة';
          $sku = $product->get_sku();
          ?>
          <div style="font-size:13px;margin-bottom:8px;">📍 <strong>المنطقة:</strong> <?php echo esc_html($region); ?></div>
          <div style="font-size:13px;margin-bottom:8px;">🏪 <strong>البائع:</strong> <?php echo esc_html($seller); ?></div>
          <?php if($sku): ?><div style="font-size:13px;margin-bottom:8px;">🔖 <strong>رمز المنتج:</strong> <?php echo esc_html($sku); ?></div><?php endif; ?>
          <div style="font-size:13px;margin-top:8px;">🚚 <strong>الشحن المتوقع:</strong> 2 إلى 4 أيام عمل</div>
        </div>

        <!-- Trust Badges -->
        <div style="display:flex;gap:16px;margin-top:20px;flex-wrap:wrap;">
          <div style="display:flex;align-items:center;gap:6px;font-size:12px;color:var(--miras-charcoal-light);">🛡️ دفع آمن</div>
          <div style="display:flex;align-items:center;gap:6px;font-size:12px;color:var(--miras-charcoal-light);">🔄 استرجاع مجاني</div>
          <div style="display:flex;align-items:center;gap:6px;font-size:12px;color:var(--miras-charcoal-light);">🇾🇪 منتج يمني 100%</div>
        </div>
      </div>
    </div>

    <!-- Description Tabs -->
    <div style="margin-top:40px;background:#fff;border-radius:var(--radius-xl);padding:40px;box-shadow:var(--shadow-sm);">
      <?php woocommerce_output_product_data_tabs(); ?>
    </div>

    <!-- Related Products -->
    <div style="margin-top:60px;">
      <?php
      $related = wc_get_related_products(get_the_ID(), 4);
      if($related):
      ?>
      <h2 style="font-size:24px;font-weight:700;color:var(--miras-charcoal);margin-bottom:32px;text-align:center;">منتجات أخرى قد تعجبك</h2>
      <div class="miras-products-grid">
        <?php foreach($related as $ri => $rel_id):
          $rel = wc_get_product($rel_id);
          if(!$rel) continue;
          $relImg = get_the_post_thumbnail_url($rel_id,'woocommerce_thumbnail');
          if(!$relImg){
                $terms=wp_get_post_terms($rel_id,'product_cat');
                $c_slug=$terms&&!is_wp_error($terms)?$terms[0]->slug:'';
                if(strpos($c_slug,'honey')!==false || strpos(urldecode($c_slug),'عسل')!==false)$relImg=$imgBase.'honey-section.jpg';
                elseif(strpos($c_slug,'coffee')!==false || strpos(urldecode($c_slug),'بن')!==false)$relImg=$imgBase.'coffee-section.jpg';
                elseif(strpos($c_slug,'heritage')!==false || strpos(urldecode($c_slug),'تراث')!==false)$relImg=$imgBase.'heritage-crafts.jpg';
                elseif(strpos($c_slug,'gift')!==false || strpos(urldecode($c_slug),'هدايا')!==false)$relImg=$imgBase.'gift-boxes.jpg';
                else $relImg=$imgBase.'food-products.jpg';
          }
        ?>
        <div class="miras-product-card">
          <a href="<?php echo esc_url(get_permalink($rel_id)); ?>" class="miras-product-image-wrap">
            <img src="<?php echo esc_url($relImg); ?>" alt="<?php echo esc_attr($rel->get_name()); ?>" loading="lazy">
          </a>
          <div class="miras-product-body">
            <a href="<?php echo esc_url(get_permalink($rel_id)); ?>"><h3 class="miras-product-name"><?php echo esc_html($rel->get_name()); ?></h3></a>
            <div class="miras-product-footer">
              <span class="miras-price-current"><?php echo $rel->get_price_html(); ?></span>
              <a href="<?php echo esc_url($rel->add_to_cart_url()); ?>" class="miras-add-to-cart ajax_add_to_cart add_to_cart_button" data-product_id="<?php echo $rel_id; ?>" rel="nofollow">+</a>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>
    </div>

    <?php endwhile; ?>
  </div>
</div>

<style>
/* Custom Variation Swatches Styling */
.variations_form .variations { width: 100%; margin-bottom: 20px; }
.variations_form .variations td.label { width: 30%; padding: 10px 0; font-weight: bold; color: var(--miras-charcoal); }
.variations_form .variations td.value { width: 70%; padding: 10px 0; }
.variations_form .variations select { 
    display: none !important; /* Hide original select */
}
.miras-swatch-container {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}
.miras-swatch {
    padding: 8px 16px;
    border: 2px solid #ddd;
    border-radius: 8px;
    cursor: pointer;
    font-weight: 600;
    color: var(--miras-charcoal-light);
    transition: all 0.2s ease;
    background: #fff;
}
.miras-swatch:hover {
    border-color: var(--miras-gold);
    color: var(--miras-gold);
}
.miras-swatch.selected {
    border-color: var(--miras-primary);
    background: var(--miras-primary);
    color: #fff;
}
.woocommerce-variation-price {
    font-size: 24px;
    font-weight: bold;
    color: var(--miras-primary);
    margin-bottom: 15px;
}
.single_variation_wrap {
    background: #f9f9f9;
    padding: 15px;
    border-radius: 8px;
    margin-bottom: 20px;
}
.woocommerce-variation-add-to-cart {
    display: flex;
    gap: 15px;
    align-items: center;
}
.woocommerce-variation-add-to-cart .quantity { margin-right: 0 !important; }
.woocommerce-variation-add-to-cart .single_add_to_cart_button {
    background: var(--miras-gold);
    color: #fff;
    border: none;
    padding: 12px 30px;
    border-radius: 8px;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    flex-grow: 1;
    transition: background 0.3s ease;
}
.woocommerce-variation-add-to-cart .single_add_to_cart_button:hover { background: #d4a017; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Transform selects to custom swatches
    var selects = document.querySelectorAll('.variations_form select');
    selects.forEach(function(select) {
        var container = document.createElement('div');
        container.className = 'miras-swatch-container';
        
        var options = select.querySelectorAll('option');
        options.forEach(function(opt) {
            if (opt.value) {
                var swatch = document.createElement('div');
                swatch.className = 'miras-swatch';
                swatch.textContent = opt.textContent;
                swatch.dataset.value = opt.value;
                
                swatch.addEventListener('click', function() {
                    // Remove selected from siblings
                    container.querySelectorAll('.miras-swatch').forEach(s => s.classList.remove('selected'));
                    // Add selected
                    swatch.classList.add('selected');
                    // Update select and trigger change event for WooCommerce JS
                    select.value = opt.value;
                    var event = new Event('change', { bubbles: true });
                    select.dispatchEvent(event);
                });
                
                container.appendChild(swatch);
            }
        });
        
        select.parentNode.insertBefore(container, select);
    });
});
</script>

<?php get_footer(); ?>
