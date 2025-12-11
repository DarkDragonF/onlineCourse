<?php
// version 1.1.1
require_once './models/Course.php';

class HomeController {

    // =================================================================
    // 1. TRANG CHỦ 
    // =================================================================
    public function index() {
        $courseModel = new Course();
        
        $newCourses = $courseModel->getNewCourses(8);

        require_once './views/home/index.php';
    }

    // =================================================================
    // 2. DASHBOARD HỌC VIÊN 
    // =================================================================
    public function dashboard() {

        if (session_status() === PHP_SESSION_NONE) session_start();
        
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?controller=auth&action=login");
            exit();
        }

        // 2. Dữ liệu giả lập (Mock Data) - Sau này thay bằng Model Enrollment
        $stats = [
            'enrolled' => 4,
            'completed' => 1,
            'certificates' => 1
        ];

        $myCourses = [
            [
                'id' => 101,
                'title' => 'Lập trình Web Fullstack với PHP & MySQL',
                'instructor_name' => 'Nguyễn Văn A',
                'image' => 'https://files.fullstack.edu.vn/f8-prod/courses/15/62f13d2424a47.png',
                'progress' => 75,
                'last_access' => '2 giờ trước'
            ],
            [
                'id' => 102,
                'title' => 'Javascript Cơ bản đến Nâng cao',
                'instructor_name' => 'Trần Thị B',
                'image' => 'https://files.fullstack.edu.vn/f8-prod/courses/1/6200ad9d8a2d1.png',
                'progress' => 30,
                'last_access' => '1 ngày trước'
            ],
             [
                'id' => 103,
                'title' => 'ReactJS Masterclass 2024',
                'instructor_name' => 'Le C',
                'image' => 'https://files.fullstack.edu.vn/f8-prod/courses/13/13.png',
                'progress' => 0,
                'last_access' => 'Chưa bắt đầu'
            ]
        ];


        if (file_exists('./views/student/dashboard.php')) {
            require_once './views/student/dashboard.php';
        } else {
            echo "Lỗi: Không tìm thấy file view dashboard!";
        }
    }
}
?>