<?php
require_once './models/Course.php';
require_once './models/Enrollment.php';
//version 1.1.3
class EnrollmentController {
    
    // 1. Hiển thị trang Thanh toán (Checkout)
    public function checkout() {
        // Bắt buộc phải đăng nhập mới được mua
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?controller=auth&action=login");
            exit();
        }

        if (isset($_GET['course_id'])) {
            $courseId = $_GET['course_id'];
            $courseModel = new Course();
            $course = $courseModel->getCourseById($courseId);

            if (!$course) {
                die("Khóa học không tồn tại");
            }

            // Kiểm tra xem đã mua chưa
            $enrollmentModel = new Enrollment();
            if ($enrollmentModel->isEnrolled($_SESSION['user_id'], $courseId)) {
                echo "<script>alert('Bạn đã sở hữu khóa học này rồi!'); window.location.href='index.php?controller=course&action=mycourses';</script>";
                return;
            }

            // Gọi View Checkout
            require_once './views/enrollment/checkout.php';
        } else {
            header("Location: index.php");
        }
    }

    // 2. Xử lý khi bấm nút "Thanh toán ngay"
    public function process() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_id'])) {
            $courseId = $_POST['course_id'];
            $price = $_POST['price'];
            $userId = $_SESSION['user_id'];

            $enrollmentModel = new Enrollment();
            
            // Lưu vào CSDL (Giả lập thanh toán thành công)
            if ($enrollmentModel->create($userId, $courseId, $price)) {
                // Chuyển hướng đến trang "Khóa học của tôi"
                echo "<script>alert('Đăng ký thành công! Chào mừng bạn vào học.'); window.location.href='index.php?controller=course&action=mycourses';</script>";
            } else {
                echo "Lỗi hệ thống, vui lòng thử lại.";
            }
        }
    }
}
?>