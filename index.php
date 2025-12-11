<?php
//version 1.1.1
// 1. Khởi tạo Session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 2. Kết nối Database
require_once './config/Database.php';

// 3. Lấy tham số từ URL
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'home';
$action     = isset($_GET['action']) ? $_GET['action'] : 'index';

// 4. Chuẩn hóa tên Class 
$controllerName = ucfirst(strtolower($controller)) . 'Controller';

// 5. ĐƯỜNG DẪN FILE 
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
