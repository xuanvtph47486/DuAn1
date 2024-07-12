<?php
session_start();
/**
 * Định nghĩa các url cần thiết sử dụng trong website
 */
$ROOT_URL = "/duanmau-main";
$CONTENT_URL = "$ROOT_URL/content";
$ADMIN_URL = "$ROOT_URL/admin";
$SITE_URL = "$ROOT_URL/site";
$SL_PER_PAGE = 10;

//Định nghĩa đường dẫn chứa ảnh trong upload

$UPLOAD_URL = "../../uploaded";

/**
 * Biến toàn cục cần thiết để chia sẻ giữa controller và view
 */
$VIEW_NAME = 'index.php';
$MESSAGE = '';

// Kiểm tra biến có tồn tại trong $_REQUEST hay ko?
function exist_param($fieldname)
{
    return array_key_exists($fieldname, $_REQUEST);
}

/**
 * Lưu file upload vào thư mục 
 */
function save_file($fieldname, $target_dir)
{
    $file_uploaded = $_FILES[$fieldname];
    $file_name = basename($file_uploaded['name']);
    $target_path = $target_dir . $file_name;
    move_uploaded_file($file_uploaded['tmp_name'], $target_path);
    return $file_name;
}

/**
 * Tạo cookies 
 */
function add_cookie($name, $value, $day)
{
    setcookie($name, $value, time() + (86400 * $day), "/");
}
/**
 * Xóa cookies 
 */

function delete_cookie($name)
{
    add_cookie($name, "", -1);
}

/**
 * ĐỌc giá trị cookie
 */

function get_cookie($name)
{
    return $_COOKIE[$name] ?? '';
}
/**
 * Check login  
 */
function check_login()
{
    global $SITE_URL;
    if (isset($_SESSION['user'])) {
        if ($_SESSION['user']['vai_tro'] == 1) {
            return;
        }
        if (strpos($_SERVER['REQUEST_URI'], '/admin/') == false) {
            return;
        }
    }

    $_SESSION['name_page'] = 'trang_chu';
    header("location: $SITE_URL/tai-khoan/dang-nhap.php");
    die;
}
