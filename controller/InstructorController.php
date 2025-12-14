<?php
//version 1.2.1
require_once './models/Course.php';
require_once './models/Enrollment.php';
require_once './models/Lesson.php';

class InstructorController {
    public function __construct() {
        $this->checkInstructorAuth();
    }
    private function checkInstructorAuth() {
        if (session_status() === PHP_SESSION_NONE) session_start();

        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?controller=auth&action=login");
            exit();
        }

        $userRole = $_SESSION['user_role'] ?? 0;
        
        if ($userRole != 1 && $userRole != 2) {
            header("Location: index.php?controller=course&action=mycourses");
            exit();
        }
    }
    // Hàm kiểm tra quyền Giảng viên (Role = 1)
    private function checkAuth() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 1) {
            header("Location: index.php?controller=auth&action=login");
            exit();
        }
    }

    private function render($view, $data = []) {
        extract($data);
        $viewPath = './views/instructor/' . $view . '.php';
        if (file_exists($viewPath)) {
            require_once './views/layouts/instructor_layout.php';
        } else {
            die("View not found: $viewPath");
        }
    }

    // 1. Dashboard tổng quan
    public function dashboard() {
        $this->checkAuth();
        $instructorId = $_SESSION['user_id'];

        $courseModel = new Course();
        $enrollmentModel = new Enrollment();

        $data['total_courses'] = $courseModel->countByInstructor($instructorId);
        $students = $enrollmentModel->getStudentsByInstructor($instructorId);
        $data['total_students'] = count($students);
        $data['recent_students'] = array_slice($students, 0, 5);

        $this->render('dashboard', $data);
    }

    // 2. Quản lý khóa học (My Courses)
    public function courseManagement() {
        $this->checkAuth();
        $instructorId = $_SESSION['user_id'];
        $courseModel = new Course();
        
        $data['courses'] = $courseModel->getCoursesByInstructor($instructorId);
        $this->render('courseManagement', $data);
    }

    // 3. Theo dõi học viên
    public function studentManagement() {
        $this->checkAuth();
        $instructorId = $_SESSION['user_id'];
        $enrollmentModel = new Enrollment();

        $data['students'] = $enrollmentModel->getStudentsByInstructor($instructorId);
        $this->render('studentManagement', $data);
    }

    public function createLession() {
        $this->checkAuth(); // Kiểm tra đăng nhập
        $instructorId = $_SESSION['user_id'];
        
        // Gọi các Model cần thiết
        // Lưu ý: Nhớ thêm require_once './models/Lesson.php'; ở đầu file Controller nếu chưa có
        $courseModel = new Course();
        $lessonModel = new Lesson();

        // --- XỬ LÝ LƯU BÀI HỌC MỚI (POST) ---
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'store_lesson') {
            $courseId = $_POST['course_id'];
            $title = $_POST['title'];
            $videoUrl = $_POST['video_url'];
            $content = $_POST['content'];
            $order = $_POST['order'] ?? 0;

            // Kiểm tra bảo mật: Khóa học này có phải của GV này không?
            $course = $courseModel->getCourseById($courseId);
            if ($course && $course['instructor_id'] == $instructorId) {
                if ($lessonModel->addLesson($courseId, $title, $videoUrl, $content, $order)) {
                    // Thành công -> Load lại trang danh sách bài học
                    header("Location: index.php?controller=instructor&action=createLession&course_id=$courseId&msg=success");
                    exit();
                }
            } else {
                die("Lỗi: Bạn không có quyền thêm bài học vào khóa này.");
            }
        }

        // --- XỬ LÝ HIỂN THỊ GIAO DIỆN (GET) ---
        $courseId = isset($_GET['course_id']) ? $_GET['course_id'] : null;

        if ($courseId) {
            // TRẠNG THÁI 2: Đã chọn khóa học -> Hiện danh sách bài học
            $currentCourse = $courseModel->getCourseById($courseId);

            // Bảo mật
            if (!$currentCourse || $currentCourse['instructor_id'] != $instructorId) {
                header("Location: index.php?controller=instructor&action=createLession");
                exit();
            }

            $lessons = $lessonModel->getLessonsByCourseId($courseId);
            
            $data = [
                'view_state' => 'lesson_list', // Cờ xác định trạng thái
                'course' => $currentCourse,
                'lessons' => $lessons
            ];
        } else {
            // TRẠNG THÁI 1: Chưa chọn -> Hiện danh sách khóa học
            $courses = $courseModel->getCoursesByInstructor($instructorId);
            $data = [
                'view_state' => 'course_select',
                'courses' => $courses
            ];
        }

        $this->render('createLession', $data);
    }
}
?>