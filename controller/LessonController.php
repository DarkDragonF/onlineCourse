// File: controller/LessonController.php
<?php
// Giả định file này nằm trong thư mục controller/

// Tái sử dụng cấu hình DB
require_once './config/Database.php';
// Sử dụng các Model cần thiết
require_once './models/Lesson.php'; 
require_once './models/Course.php'; 
require_once './models/User.php'; // Nếu cần kiểm tra quyền Instructor

class LessonController {

    private $lessonModel;
    private $courseModel;
    private $db; 

    public function __construct() {
        $this->lessonModel = new Lesson();
        $this->courseModel = new Course();
        $this->db = Database::getInstance(); //
    }

    // =================================================================
    // KHU VỰC ADMIN (Giáo viên quản lý bài học)
    // =================================================================

    /**
     * 1. Danh sách bài học của một khóa học cụ thể
     * URL: index.php?controller=lesson&action=list&course_id=X
     */
    public function list() {
        if (!isset($_GET['course_id'])) {
            header("Location: index.php?controller=course&action=list");
            return;
        }

        $course_id = (int)$_GET['course_id'];
        $course = $this->courseModel->getCourseById($course_id); //
        
        if (!$course) {
            die("Lỗi: Khóa học không tồn tại.");
        }

        $lessons = $this->lessonModel->getLessonsByCourse($course_id);
        
        // Truyền $lessons và $course sang View
        require_once "./views/lessons/list.php"; 
    }

    /**
     * 2. Hiển thị Form tạo bài học mới
     * URL: index.php?controller=lesson&action=create&course_id=X
     */
    public function create() {
        if (!isset($_GET['course_id'])) {
            header("Location: index.php?controller=course&action=list");
            return;
        }

        $course_id = (int)$_GET['course_id'];
        $course = $this->courseModel->getCourseById($course_id); 

        if (!$course) {
            die("Lỗi: Khóa học không tồn tại.");
        }

        // Truyền $course sang View 
        require_once "./views/lessons/create.php"; 
    }

    /**
     * 3. Xử lý và Lưu bài học vào CSDL (POST request)
     */
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['course_id'])) {
            $course_id = (int)$_POST['course_id'];
            
            // Chuẩn bị dữ liệu theo thiết kế CSDL
            $data = [
                "title"         => $_POST["title"] ?? '',
                "content"       => $_POST["content"] ?? '',
                "video_url"     => $_POST["video_url"] ?? null, // Thêm video_url
                "course_id"     => $course_id,
                "lesson_order"  => (int)$_POST["lesson_order"] ?? 0, // Dùng lesson_order
            ];

            // Gọi Model để lưu
            if ($this->lessonModel->create($data)) {
                // Redirect về trang danh sách bài học của khóa học đó
                header("Location: index.php?controller=lesson&action=list&course_id=" . $course_id);
                exit; 
            } else {
                echo "Có lỗi xảy ra khi tạo bài học.";
            }
        } else {
             header("Location: index.php?controller=course&action=list");
             exit;
        }
    }
}
?>