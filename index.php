<?php
// 1. BẬT BÁO LỖI (Để không bị màn hình trắng)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 2. Khởi tạo Session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 3. Kết nối Database
require_once './config/Database.php';

// 4. Lấy tham số từ URL
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'home';
$action     = isset($_GET['action']) ? $_GET['action'] : 'index';

// 5. Chuẩn hóa tên Class 
$controllerName = ucfirst(strtolower($controller)) . 'Controller';

// 6. ĐƯỜNG DẪN FILE 
$controllerPath = "./controller/" . $controllerName . ".php";

if (file_exists($controllerPath)) {
    require_once $controllerPath;

    if (class_exists($controllerName)) {
        $object = new $controllerName();

        if (method_exists($object, $action)) {
            $object->$action();
        } else {
            die("Lỗi: Không tìm thấy action '<b>$action</b>' trong Controller '<b>$controllerName</b>'.");
        }
    } else {
        die("Lỗi: File '$controllerPath' có tồn tại, nhưng không tìm thấy class '<b>$controllerName</b>' bên trong. Hãy kiểm tra tên class.");
    }
} else {
    die("Lỗi 404: Không tìm thấy file Controller tại: <b>$controllerPath</b>");
}
?>