<?php
require_once './models/Course.php';
require_once './models/Enrollment.php';
//version 1.2.0
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
            
            if ($enrollmentModel->create($userId, $courseId, $price)) {
                echo "<script>alert('Đăng ký thành công! Chào mừng bạn vào học.'); window.location.href='index.php?controller=course&action=mycourses';</script>";
            } else {
                echo "Lỗi hệ thống, vui lòng thử lại.";
            }
        }
    }

    public function getStudentsByInstructor($instructorId) {
        $query = "SELECT 
                    e.enrolled_at, e.progress,
                    u.fullname as student_name, u.email as student_email, u.avatar as student_avatar,
                    c.title as course_title
                  FROM enrollments e
                  JOIN courses c ON e.course_id = c.id
                  JOIN users u ON e.student_id = u.id
                  WHERE c.instructor_id = :instructor_id
                  ORDER BY e.enrolled_at DESC";

        $stmt = $this->conn->prepare($query); 
        $stmt->bindParam(':instructor_id', $instructorId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>