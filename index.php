<?php
// index.php - File chạy chính (Router)

// 1. Gọi file Controller
// Lưu ý: Đường dẫn phải chính xác từ vị trí file index.php này đi vào thư mục controller
if (file_exists('./controller/CourseController.php')) {
    require_once './controller/CourseController.php';
} else {
    die("Lỗi: Không tìm thấy file Controller tại './controller/CourseController.php'");
}

// 2. Khởi tạo Controller
$controller = new CourseController();

// 3. Lấy 'action' từ URL (mặc định là 'index')
// Ví dụ: http://localhost/project/index.php?action=show&id=5
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

// 4. Điều hướng (Switch case)
switch ($action) {
    case 'index':
        // Gọi hàm index() để hiển thị trang chủ/danh sách
        $controller->index();
        break;

    case 'show':
        // Gọi hàm show() để xem chi tiết
        $controller->show();
        break;

    default:
        // Mặc định về trang chủ
        $controller->index();
        break;
}
?>