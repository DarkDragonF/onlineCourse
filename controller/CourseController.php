<?php
require_once './config/Database.php';
require_once './models/Course.php';

class CourseController {

    private $courseModel;
    private $db; 

    public function __construct() {
        // 1. Khởi tạo Model Course
        $this->courseModel = new Course();

        // 2. Khởi tạo kết nối DB (để dùng cho các truy vấn phụ như lấy category, instructor)
        $database = new Database();
        $this->db = $database->getConnection(); 
    }

    // =================================================================
    // KHU VỰC CLIENT (Dành cho người xem/học viên)
    // =================================================================

    // 1. Trang chủ: Hiển thị slider và danh sách khóa học mới
    public function index() {
        // Lấy 3 khóa nổi bật
        $featuredCourses = $this->courseModel->getFeaturedCourses(3); 
        // Lấy 6 khóa mới nhất
        $newCourses = $this->courseModel->getNewCourses(6);        
        // Gọi View trang chủ
        // Bạn hãy kiểm tra lại đường dẫn file view này trong thư mục của bạn
        require_once './views/viewcourse.php';
    }

    // 2. Chi tiết khóa học: Xem thông tin cụ thể
    public function detail() { // Đổi tên show -> detail cho rõ nghĩa
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            
            $course = $this->courseModel->getCourseById($id);

            if (!$course) {
                echo "Khóa học không tồn tại!";
                return;
            }

            // Gọi View chi tiết
            require_once './views/courses/detail.php'; // Đã chuẩn hóa đường dẫn
        } else {
            header("Location: index.php");
        }
    }

    // =================================================================
    // KHU VỰC ADMIN (Dành cho quản trị viên)
    // =================================================================

    // 3. Danh sách quản lý (Trước đây là hàm index của snippet 1)
    public function list() {
        // Dùng hàm getAllCourses đã merge ở Model bài trước
        $courses = $this->courseModel->getAllCourses();
        
        // Gọi View admin (đổi tên file view nếu cần để tránh trùng với trang chủ)
        require_once "./views/courses/list.php"; 
    }

    // 4. Form tạo khóa học mới
    public function create() {
        // Truy vấn trực tiếp để lấy danh mục (Categories)
        $stmtCat = $this->db->prepare("SELECT * FROM categories");
        $stmtCat->execute();
        $categories = $stmtCat->fetchAll(PDO::FETCH_ASSOC);

        // Truy vấn trực tiếp lấy giảng viên (Instructors - role = 1)
        $stmtIns = $this->db->prepare("SELECT * FROM users WHERE role = 1");
        $stmtIns->execute();
        $instructors = $stmtIns->fetchAll(PDO::FETCH_ASSOC);

        require_once "./views/courses/create.php";
    }

    // 5. Lưu khóa học vào CSDL
    public function store() {
        // Xử lý upload ảnh
        $image = "";
        if (!empty($_FILES["image"]["name"])) {
            $target_dir = "uploads/";
            // Tạo tên file duy nhất để tránh trùng
            $target_file = $target_dir . time() . "_" . basename($_FILES["image"]["name"]);
            
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $image = $target_file;
            }
        }

        // Chuẩn bị dữ liệu
        $data = [
            "title"          => $_POST["title"],
            "description"    => $_POST["description"],
            "instructor_id"  => $_POST["instructor_id"],
            "category_id"    => $_POST["category_id"],
            "price"          => $_POST["price"],
            "duration_weeks" => $_POST["duration_weeks"],
            "level"          => $_POST["level"],
            "image"          => $image,
        ];

        // Gọi Model để lưu
        if ($this->courseModel->create($data)) {
            // Thành công thì về trang danh sách quản lý
            header("Location: index.php?controller=course&action=list");
        } else {
            echo "Có lỗi xảy ra khi tạo khóa học.";
        }
    }
}
?>