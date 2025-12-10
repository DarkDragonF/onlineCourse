<?php
require_once 'models/Category.php';
require_once 'models/User.php';

class AdminController {
    
    // Hàm hỗ trợ render view có layout
    private function render($view, $data = []) {
        extract($data); // Giải nén mảng data thành biến
        $view_path = 'views/admin/' . $view . '.php'; // Đường dẫn file con
        require_once 'views/layouts/admin_layout.php'; // Gọi layout cha
    }

    // 1. Dashboard [cite: 55]
    public function dashboard() {
        $catModel = new Category();
        $userModel = new User();
        
        $data['countCat'] = $catModel->count();
        $data['countUser'] = $userModel->count();
        
        $this->render('dashboard', $data);
    }

    // 2. Quản lý Users [cite: 52, 56]
    public function listUsers() {
        $userModel = new User();
        $data['users'] = $userModel->getAllUsers();
        $this->render('users/index', $data);
    }

    public function toggleUserStatus() {
        if (isset($_GET['id']) && isset($_GET['status'])) {
            $userModel = new User();
            $newStatus = $_GET['status'] == 1 ? 0 : 1;
            $userModel->toggleStatus($_GET['id'], $newStatus);
        }
        header("Location: index.php?controller=admin&action=listUsers");
    }

    // 3. Quản lý Danh mục [cite: 51, 57]
    public function listCategories() {
        $catModel = new Category();
        $data['categories'] = $catModel->getAll();
        $this->render('categories/index', $data);
    }

    public function createCategory() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $catModel = new Category();
            // Xử lý tạo mới
            if ($catModel->create($_POST['name'], $_POST['description'])) {
                // Thành công -> Về trang danh sách
                header("Location: index.php?controller=admin&action=listCategories");
                exit();
            }
        }
        $this->render('categories/create');
    }

    // 2. Chức năng SỬA (Edit)
    public function editCategory() {
        if (!isset($_GET['id'])) {
            header("Location: index.php?controller=admin&action=listCategories");
            exit();
        }

        $id = $_GET['id'];
        $catModel = new Category();
        
        // Xử lý khi bấm nút Lưu (POST)
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];
            
            if ($catModel->update($id, $name, $description)) {
                header("Location: index.php?controller=admin&action=listCategories");
                exit();
            }
        }

        // Lấy dữ liệu cũ để điền vào form (GET)
        $data['category'] = $catModel->getById($id);
        
        // Gọi view sửa
        $this->render('categories/edit', $data);
    }

    public function deleteCategory() {
        if (isset($_GET['id'])) {
            $catModel = new Category();
            $catModel->delete($_GET['id']);
        }
        header("Location: index.php?controller=admin&action=listCategories");
    }
}
?>