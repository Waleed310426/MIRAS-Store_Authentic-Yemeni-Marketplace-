<?php
require_once('wp-load.php');

$username = 'waleedalansi';
$new_password = 'lwma773157823';

$user = get_user_by('login', $username);

if ($user) {
    wp_set_password($new_password, $user->ID);
    echo "تم تغيير كلمة المرور للمستخدم '{$username}' بنجاح إلى: <strong>{$new_password}</strong><br>";
    echo "<a href='/wp-login.php'>اضغط هنا لتسجيل الدخول</a>";
} else {
    echo "عذراً، لم يتم العثور على المستخدم '{$username}'.";
}
?>
