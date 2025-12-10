<?php
// SỬA: Đổi './Models/' thành './models/' (chữ m thường) để khớp với thư mục
require_once './models/Course.php';

class CourseController {
    
    // 1. Hàm hiển thị Trang chủ (Danh sách khóa học)
    public function index() {
        // Khởi tạo Model
        $courseModel = new Course();
        
        // Lấy dữ liệu từ Model
        $featuredCourses = $courseModel->getFeaturedCourses(3); 
        $newCourses = $courseModel->getNewCourses(6);       
        
        // Gọi View
        // Lưu ý: Đảm bảo file viewcourse.php nằm đúng trong thư mục views
        if (file_exists('./views/viewcourse.php')) {
            require_once './views/viewcourse.php';
        } else {
            echo "Lỗi: Không tìm thấy file view tại './views/viewcourse.php'";
        }
    }

    // 2. Hàm hiển thị Chi tiết khóa học
    public function show() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            
            $courseModel = new Course();
            $course = $courseModel->getCourseById($id);

            if (!$course) {
                echo "Khóa học không tồn tại!";
                return;
            }

            // Gọi View chi tiết
            if (file_exists('./views/course/detail.php')) {
                require_once './views/course/detail.php';
            } else {
                echo "Chức năng xem chi tiết đang hoàn thiện (Chưa có file view)";
            }
        } else {
            header("Location: index.php");
        }
    }
}
?>