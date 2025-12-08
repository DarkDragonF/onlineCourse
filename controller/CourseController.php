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

?>