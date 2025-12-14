<?php
//version 1.1.3
// Gọi các Models cần thiết
require_once './models/Category.php';
require_once './models/User.php';
require_once './models/Course.php';

class AdminController {
    
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