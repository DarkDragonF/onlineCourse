<?php
//version 1.2.0
require_once './models/Course.php';
require_once './models/Enrollment.php';

class HomeController {

    // =================================================================
    // 1. TRANG CHỦ (LANDING PAGE)
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
    // 2. DASHBOARD
    // =================================================================
    public function dashboard() {
        // 1. Kiểm tra đăng nhập
        if (session_status() === PHP_SESSION_NONE) session_start();
        
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?controller=auth&action=login");
            exit();
        }
        // -------------------------------------------------------------
        // 2. LẤY ROLE ĐỂ PHÂN LUỒNG
        // -------------------------------------------------------------
        $role = $_SESSION['user_role'] ?? 0;

        // TRƯỜNG HỢP: ADMIN (Role = 2)
        if ($role == 2) {
            header("Location: index.php?controller=admin&action=dashboard");
            exit();
        }

        // -------------------------------------------------------------
        // TRƯỜNG HỢP: HỌC VIÊN (Role = 0)
        // -------------------------------------------------------------

        // Lấy ID user hiện tại
        $studentId = $_SESSION['user_id'];

        // Gọi Model Enrollment để lấy dữ liệu thật
        $enrollmentModel = new Enrollment();
        
        // Lấy danh sách khóa học kèm tiến độ
        $myCourses = $enrollmentModel->getMyCourses($studentId); 

        $totalEnrolled = $enrollmentModel->countEnrolled($studentId);
        
        // Tính toán số chứng chỉ hoặc khóa đã xong
        $completed = 0;
        if (!empty($myCourses)) {
            foreach ($myCourses as $c) {
                if ($c['progress'] == 100) $completed++;
            }
        }

        // Đóng gói dữ liệu thống kê
        $stats = [
            'enrolled' => $totalEnrolled,
            'completed' => $completed,
            'certificates' => $completed 
        ];

        // 3. Gọi View Dashboard của Học viên
        // Đảm bảo file view tồn tại
        if (file_exists('./views/student/studentdashboard.php')) {
            require_once './views/student/studentdashboard.php';
        } else {
            require_once './views/student/dashboard.php';
        }
    }
}
?>