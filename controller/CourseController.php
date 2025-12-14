<?php
//version 1.2.0
// Gọi các file cấu hình và Model
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
        // Kiểm tra xem trên URL có tham số id không
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            
            // Gọi Model để lấy thông tin khóa học
            $course = $this->courseModel->getCourseById($id);

            // Nếu không tìm thấy khóa học trong CSDL
            if (!$course) {
                echo "Khóa học không tồn tại!"; 
                return;
            }

            // Gọi View hiển thị
            if (file_exists('./views/course/detail.php')) {
                require_once './views/course/detail.php'; 
            } else {
                require_once './views/course/detail.php'; 
            }

        } else {
            // Nếu không có ID thì quay về trang chủ
            header("Location: index.php");
        }
    }

    // 3. Trang "Khóa học của tôi"
    public function mycourses() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?controller=auth&action=login");
            exit();
        }

        $userId = $_SESSION['user_id'];

        if (file_exists('./models/Enrollment.php')) {
            require_once './models/Enrollment.php';
        } else {
            die("Lỗi: Thiếu file models/Enrollment.php");
        }

        $enrollmentModel = new Enrollment();
        $myCourses = $enrollmentModel->getMyCourses($userId);

        require_once './views/course/myCourse.php';
    }

    // 4. Hiển thị khóa học theo danh mục
    public function category() {
        if (isset($_GET['id'])) {
            $catId = $_GET['id'];

            require_once './models/Category.php';
            $categoryModel = new Category();
            
            $categoryName = $categoryModel->getById($catId);

            $courses = $this->courseModel->getCoursesByCategoryId($catId);

            require_once './views/course/category.php';
        } else {
            header("Location: index.php?controller=course&action=list");
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

        // Lấy giảng viên (Role = 1)
        $stmtIns = $this->db->prepare("SELECT * FROM users WHERE role = 1"); 
        $stmtIns->execute();
        $instructors = $stmtIns->fetchAll(PDO::FETCH_ASSOC);

        require_once "./views/instructor/create.php";
    }

    // 5. Lưu khóa học vào CSDL
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Xử lý upload ảnh
            $image = "";
            if (!empty($_FILES["image"]["name"])) {
                $target_dir = "assets/";
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

    public function search() {
        // 1. Lấy từ khóa từ URL (VD: index.php?controller=course&action=search&keyword=php)
        $keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
        
        $courseModel = new Course();
        $courses = [];
        $message = "";

        if (!empty($keyword)) {
            // 2. Gọi Model để tìm kiếm
            $courses = $courseModel->searchCourses($keyword);
            
            if (empty($courses)) {
                $message = "Không tìm thấy khóa học nào phù hợp với từ khóa: <b>" . htmlspecialchars($keyword) . "</b>";
            }
        } else {
            $message = "Vui lòng nhập từ khóa để tìm kiếm.";
        }

        // 3. Trả về View hiển thị kết quả
        // Chúng ta sẽ tạo một file view riêng hoặc tái sử dụng file index
        require_once './views/course/search.php';
    }

} 
?>