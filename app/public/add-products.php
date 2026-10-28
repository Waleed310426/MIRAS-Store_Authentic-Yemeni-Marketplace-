<?php
/**
 * سكريبت إنشاء منتجات WooCommerce من الصور المرفوعة
 * تشغيل مرة واحدة فقط ثم احذف الملف
 */

$secret = isset($_GET['secret']) ? $_GET['secret'] : '';
if ($secret !== 'miras2026') {
    die('<h2 style="color:red;font-family:Arial;">خطأ: مفتاح الأمان غير صحيح<br>أضف ?secret=miras2026 لتشغيل السكريبت</h2>');
}

require_once(dirname(__FILE__) . '/wp-load.php');

if (!function_exists('wc_get_product')) {
    die('<h2 style="color:red;">WooCommerce غير مفعل!</h2>');
}

echo '<!DOCTYPE html><html dir="rtl"><head><meta charset="UTF-8"><title>إضافة منتجات مراس</title><style>body{font-family:Arial,sans-serif;max-width:900px;margin:30px auto;background:#f5f5f5;padding:20px}.card{background:#fff;border-radius:12px;padding:20px;margin:15px 0;box-shadow:0 2px 8px rgba(0,0,0,.1)}.success{color:#27ae60}.error{color:#e74c3c}.info{color:#2980b9}h1{color:#1a1a2e;text-align:center}img{max-width:80px;border-radius:8px;vertical-align:middle;margin-left:10px}</style></head><body>';
echo '<h1>🛍️ إنشاء المنتجات من الصور | MIRAS</h1>';

$categories_map = [
    'luban-samn' => 'اللبان والسمن',
    'bakhoor-atoor' => 'بخور و عطور',
    'yemeni-agriculture' => 'منتجات زراعية يمنية',
];

global $wpdb;
$total_products = 0;

foreach ($categories_map as $slug => $cat_name) {
    echo '<div class="card">';
    echo "<h3>📂 القسم: $cat_name</h3>";
    
    // Get the category ID
    $term = get_term_by('slug', $slug, 'product_cat');
    if (!$term) {
        echo "<p class='error'>❌ لم يتم العثور على القسم: $slug</p></div>";
        continue;
    }
    
    // Find attachments that are inside the folder for this category
    // The previous script uploaded to 'miras-categories/{$cat_name}/{$filename}'
    // Note: $cat_name might have been sanitized in the previous script. Let's check how it was sanitized.
    $sanitized_cat_name = sanitize_title($cat_name);
    
    // Query attachments in this subdirectory
    $attachments = $wpdb->get_results("
        SELECT post_id, meta_value FROM $wpdb->postmeta 
        WHERE meta_key = '_wp_attached_file' 
        AND meta_value LIKE '%miras-categories/$sanitized_cat_name/%'
    ");
    
    if (empty($attachments)) {
        echo "<p class='info'>لا توجد صور في هذا القسم ($sanitized_cat_name).</p>";
    } else {
        echo "<ul>";
        foreach ($attachments as $att) {
            $attach_id = $att->post_id;
            $file_path = $att->meta_value;
            $filename = basename($file_path);
            
            // Generate product title from filename
            $title = str_replace(['.png', '.jpg', '.jpeg', '.webp'], '', $filename);
            // Remove common prefixes like 'yemeni_dairy_01_' or '01_'
            $title = preg_replace('/^([0-9]{2}_|yemeni_[a-z]+_[0-9]{2}_)/i', '', $title);
            $title = str_replace('_', ' ', $title);
            $title = ucwords($title);
            
            // Check if product already exists with this image to avoid duplicates
            $existing_product = $wpdb->get_var($wpdb->prepare("
                SELECT post_id FROM $wpdb->postmeta 
                WHERE meta_key = '_thumbnail_id' AND meta_value = %d
            ", $attach_id));
            
            if ($existing_product) {
                echo "<li style='color:#666'>ℹ️ المنتج موجود مسبقاً: $title (ID: $existing_product)</li>";
                continue;
            }
            
            // Create Product
            $product = new WC_Product_Simple();
            $product->set_name($title);
            $product->set_status('publish');
            $product->set_catalog_visibility('visible');
            $product->set_price(rand(10, 50) * 100); // Random price between 1000 and 5000
            $product->set_regular_price($product->get_price());
            $product->set_category_ids([$term->term_id]);
            $product->set_image_id($attach_id);
            $product->set_manage_stock(true);
            $product->set_stock_quantity(rand(5, 50));
            
            $product_id = $product->save();
            
            if ($product_id) {
                $img_url = wp_get_attachment_image_url($attach_id, 'thumbnail');
                echo "<li class='success' style='margin-bottom:8px;'>
                        <img src='$img_url' alt='$title'>
                        ✅ تم إنشاء المنتج: <strong>$title</strong> (ID: $product_id)
                      </li>";
                $total_products++;
            } else {
                echo "<li class='error'>❌ فشل إنشاء المنتج: $title</li>";
            }
        }
        echo "</ul>";
    }
    echo "</div>";
}

echo '<div class="card" style="border:2px solid #27ae60">';
echo '<h3 class="success">🎉 اكتملت العملية!</h3>';
echo '<p>✅ إجمالي المنتجات المنشأة: ' . $total_products . '</p>';
echo '<a href="' . home_url('/shop/') . '" target="_blank" style="background:#8e44ad;color:#fff;padding:10px 20px;border-radius:6px;text-decoration:none">🛒 الذهاب إلى المتجر</a>';
echo '</div>';
echo '<div class="card" style="background:#fff3cd">';
echo '<p>⚠️ <strong>احذف هذا الملف فور الانتهاء!</strong></p>';
echo '</div>';
echo '</body></html>';