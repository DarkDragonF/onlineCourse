<?php
// Nạp Model Course để sử dụng
require_once './Models/Course.php';

class CourseController {
    
    // 1. Hàm hiển thị Trang chủ (Danh sách khóa học)
    public function index() {
        // Khởi tạo Model
        $courseModel = new Course();
        
        // Lấy dữ liệu từ Model
        // Lấy 3 khóa nổi bật cho Slider
        $featuredCourses = $courseModel->getFeaturedCourses(3); 
        // Lấy 6 khóa mới nhất cho danh sách
        $newCourses = $courseModel->getNewCourses(6);       
        
        // Gọi View và truyền dữ liệu sang
        // (Biến $featuredCourses và $newCourses sẽ dùng được bên trong file view này)
        require_once './views/viewcourse.php';
    }

    // 2. Hàm hiển thị Chi tiết khóa học (Dùng cho trang Detail sau này)
    public function show() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            
            $courseModel = new Course();
            $course = $courseModel->getCourseById($id);

            // Nếu không tìm thấy khóa học thì báo lỗi hoặc về trang chủ
            if (!$course) {
                echo "Khóa học không tồn tại!";
                return;
            }

            // Gọi View chi tiết (Chúng ta sẽ tạo file này ở bước sau)
            require_once './views/course/detail.php';
        } else {
            // Nếu không có ID thì quay về trang chủ
            header("Location: index.php");
        }
    }
}
?>