<?php
//version 1.2.0
// Gọi các Models cần thiết
require_once './models/Category.php';
require_once './models/User.php';
require_once './models/Course.php';

class AdminController {
    public function __construct() {
        $this->checkAdminAuth();
    }

    // Hàm hỗ trợ render view 
    private function render($view, $data = []) {
        extract($data); // Giải nén mảng data thành biến

        $viewPath = './views/admin/' . $view . '.php'; 
        $viewPath2 = '/views/categories/index.php';

        if (file_exists($viewPath)) {
            require_once './views/layouts/admin_layout.php';
        } else {
            die("Lỗi: Không tìm thấy file view tại: $viewPath");
        }
    }

    private function checkAdminAuth() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['error'] = "Vui lòng đăng nhập để truy cập!";
            header("Location: index.php?controller=auth&action=login");
            exit();
        }
        $userRole = $_SESSION['user_role'] ?? 0;

        if ($userRole != 2) { 
            echo "<div style='text-align:center; margin-top:50px;'>";
            echo "<h1>⛔ Truy cập bị từ chối!</h1>";
            echo "<p>Bạn không có quyền truy cập vào trang quản trị.</p>";
            echo "<a href='index.php'>Quay về trang chủ</a>";
            echo "</div>";
            exit(); 
        }
    }

    // 1. Dashboard
    public function dashboard() {
        $catModel = new Category();
        $userModel = new User(); 
        $courseModel = new Course();
        
        $data['countCat'] = $catModel->count();
        $data['countUser'] = $userModel->count(); 
        $allCourses = $courseModel->getAllCoursesAdmin();
        $data['countCourse'] = count($allCourses);

        $this->render('dashboard', $data);
    }

    // 2. Quản lý Users
    public function listUsers() {
        $userModel = new User();
        $data['users'] = $userModel->getAllUsers(); 
        $this->render('users/index', $data);
    }

    public function toggleUserStatus() {
        if (isset($_GET['id']) && isset($_GET['status'])) {
            $userModel = new User();
            // Logic đảo trạng thái: Nếu đang 1 thì thành 0, ngược lại
            $newStatus = $_GET['status'] == 1 ? 0 : 1;
            
            $userModel->toggleStatus($_GET['id'], $newStatus);
        }
        header("Location: index.php?controller=admin&action=listUsers");
    }

    // 3. Quản lý Danh mục
    public function listCategories() {
        $catModel = new Category();
        $data['categories'] = $catModel->getAll();
        
        // Render file tại: views/admin/categories/index.php
        $this->render('categories/index', $data);
    }

    public function createCategory() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $catModel = new Category();
            if ($catModel->create($_POST['name'], $_POST['description'])) {
                header("Location: index.php?controller=admin&action=listCategories");
                exit();
            }
        }
        $this->render('categories/create');
    }

    public function editCategory() {
        if (!isset($_GET['id'])) {
            header("Location: index.php?controller=admin&action=listCategories");
            exit();
        }

        $id = $_GET['id'];
        $catModel = new Category();
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];
            
            if ($catModel->update($id, $name, $description)) {
                header("Location: index.php?controller=admin&action=listCategories");
                exit();
            }
        }

        $data['category'] = $catModel->getById($id);
        $this->render('categories/edit', $data);
    }

    public function deleteCategory() {
        if (isset($_GET['id'])) {
            $catModel = new Category();
            $catModel->delete($_GET['id']);
        }
        header("Location: index.php?controller=admin&action=listCategories");
    }

    public function listCourses() {
        // if ($_SESSION['user_role'] != 2){
        //     Header('Location: index.php');
        // }

        $courseModel = new Course();
        $data['courses'] = $courseModel->getAllCoursesAdmin();

        $this->render('courses/index', $data);
    }

    public function deleteCourse() {
        if (isset($_GET['id'])) {
            $courseModel = new Course();
            $courseModel->delete($_GET['id']);  
        }
        header("Location: index.php?controller=admin&action=listCourses");
    }
}
?>