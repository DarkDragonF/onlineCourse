<?php
// Nạp file Database
require_once "config/Database.php";

// Kết nối DB
$db = Database::connect();

// Lấy controller và action từ URL
$controllerName = isset($_GET["controller"]) ? $_GET["controller"] : "course";
$actionName     = isset($_GET["action"]) ? $_GET["action"] : "index";

// Chuyển đổi tên controller: course → CourseController
$controllerClass = ucfirst($controllerName) . "Controller";
$controllerFile  = "controller/" . $controllerClass . ".php";

// Kiểm tra file controller có tồn tại không
if (!file_exists($controllerFile)) {
    die("❌ Không tìm thấy controller: $controllerClass");
}

// Nạp file controller
require_once $controllerFile;

// Tạo object controller
$controller = new $controllerClass($db);

// Kiểm tra action có tồn tại trong controller không
if (!method_exists($controller, $actionName)) {
    die("❌ Không tìm thấy action: $actionName trong $controllerClass");
}

// Gọi action
$controller->$actionName();
?>
