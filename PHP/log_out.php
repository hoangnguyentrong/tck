<?php
// Bắt đầu session
session_start();

// Xóa các biến session cụ thể (ví dụ: 'email')
unset($_SESSION['email']);

// Hủy session
session_destroy();

// Điều hướng về trang đăng nhập
include('libs/helper.php');
Helper::redirect(Helper::get_url('../TCK/PHP/log_in.php'));
?>
