<?php
// version 1.1.2
require_once './models/Course.php';
require_once './models/Enrollment.php';

class HomeController {

    // =================================================================
    // 1. TRANG CHỦ 
    // =================================================================
    public function index() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        
        if (isset($_SESSION['user_id'])) {
            header("Location: index.php?controller=home&action=dashboard");
            exit();
        }
        
        $courseModel = new Course();
        $newCourses = $courseModel->getNewCourses(8);

        require_once './views/home/index.php';
    }

    // =================================================================
    // 2. DASHBOARD HỌC VIÊN 
    // =================================================================
    public function dashboard() {
        // 1. Kiểm tra đăng nhập
        if (session_status() === PHP_SESSION_NONE) session_start();
        
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?controller=auth&action=login");
            exit();
        }

        // Lấy ID user hiện tại
        $studentId = $_SESSION['user_id'];

        // 2. Gọi Model Enrollment để lấy dữ liệu thật
        $enrollmentModel = new Enrollment();
        
        // Lấy danh sách khóa học kèm tiến độ
        $myCourses = $enrollmentModel->getMyCourses($studentId); 

        $totalEnrolled = $enrollmentModel->countEnrolled($studentId);
        
        // (Tùy chọn) Tính toán số chứng chỉ hoặc khóa đã xong
        $completed = 0;
        foreach ($myCourses as $c) {
            if ($c['progress'] == 100) $completed++;
        }

        // Đóng gói dữ liệu thống kê
        $stats = [
            'enrolled' => $totalEnrolled,
            'completed' => $completed,
            'certificates' => $completed 
        ];

        // 3. Gọi View
        require_once './views/student/studentdashboard.php';
    }
}
?>