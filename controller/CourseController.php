<?php
// Giả định file này nằm trong thư mục controllers/
require_once './config/Database.php';
require_once './models/Course.php';

class CourseController {

    private $courseModel;
    private $db; 

    public function __construct() {
        $this->courseModel = new Course();

        $this->db = Database::getInstance(); 
    }

    // =================================================================
    // KHU VỰC CLIENT (Dành cho người xem/học viên)
    // =================================================================

    // 1. Trang chủ
    public function index() {
        $featuredCourses = $this->courseModel->getFeaturedCourses(3); 
        $newCourses = $this->courseModel->getNewCourses(6);        
        require_once './views/home/index.php'; 
    }

    // 2. Chi tiết khóa học
    public function detail() { 
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $course = $this->courseModel->getCourseById($id);

            if (!$course) {
                echo "Khóa học không tồn tại!"; // Hoặc redirect về trang 404
                return;
            }

            require_once './views/course/detail.php'; 
        } else {
            header("Location: index.php");
        }
    }

    // =================================================================
    // KHU VỰC ADMIN (Dành cho quản trị viên)
    // =================================================================

    // 3. Danh sách quản lý
    public function list() {
        $courses = $this->courseModel->getAllCourses();
        require_once "./views/course/list.php"; 
    }

    // 4. Form tạo khóa học mới
    public function create() {
        
        // Lấy danh mục
        $stmtCat = $this->db->prepare("SELECT * FROM categories");
        $stmtCat->execute();
        $categories = $stmtCat->fetchAll(PDO::FETCH_ASSOC);

        // Lấy giảng viên
        $stmtIns = $this->db->prepare("SELECT * FROM users WHERE role = 1");
        $stmtIns->execute();
        $instructors = $stmtIns->fetchAll(PDO::FETCH_ASSOC);

        require_once "./views/course/create.php";
    }

    // 5. Lưu khóa học vào CSDL
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Xử lý upload ảnh
            $image = "";
            if (!empty($_FILES["image"]["name"])) {
                $target_dir = "uploads/";
                // Kiểm tra xem thư mục có tồn tại không, nếu không thì tạo
                if (!file_exists($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }
                
                $target_file = $target_dir . time() . "_" . basename($_FILES["image"]["name"]);
                
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    $image = $target_file;
                }
            }

            // Chuẩn bị dữ liệu
            $data = [
                "title"          => $_POST["title"] ?? '',
                "description"    => $_POST["description"] ?? '',
                "instructor_id"  => $_POST["instructor_id"] ?? 0,
                "category_id"    => $_POST["category_id"] ?? 0,
                "price"          => $_POST["price"] ?? 0,
                "duration_weeks" => $_POST["duration_weeks"] ?? 0,
                "level"          => $_POST["level"] ?? 'Beginner',
                "image"          => $image,
            ];

            // Gọi Model để lưu
            if ($this->courseModel->create($data)) {
                // Redirect về trang danh sách
                header("Location: index.php?controller=course&action=list");
            } else {
                echo "Có lỗi xảy ra khi tạo khóa học.";
            }
        }
    }
}
?>