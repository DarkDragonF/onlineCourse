<?php
// index.php - Router

if (file_exists('./controller/CourseController.php')) {
    require_once './controller/CourseController.php';
} else {
    // Thêm __DIR__ để hiển thị đường dẫn rõ ràng hơn khi lỗi
    die("Lỗi: Không tìm thấy file tại '" . __DIR__ . "/controller/CourseController.php'. Vui lòng kiểm tra lại tên thư mục.");
}

// 2. Khởi tạo
$controller = new CourseController();

// 3. Lấy action
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

// 4. Điều hướng
switch ($action) {
    case 'index':
        $controller->index();
        break;

    case 'show':
        $controller->show();
        break;

    default:
        $controller->index();
        break;
}
?>