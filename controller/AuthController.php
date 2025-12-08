<?php
// Sửa đường dẫn tương đối (tính từ file index.php ở root)
require_once "./models/User.php";

class AuthController {
    
    private $userModel;

    public function __construct(){
        $this->userModel = new User();
        
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }
    }

    // --- ĐĂNG NHẬP ---
    public function login(){
        // Sửa đường dẫn view
        require "./views/auth/login.php";
    }

    public function handleLogin(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');

            $errors = [];

            // 1. Validate dữ liệu
            if(empty($email)){
                $errors[] = "Vui lòng nhập email!";
            } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errors[] = "Định dạng email không hợp lệ!";
            }

            if(empty($password)){
                $errors[] = "Vui lòng nhập mật khẩu!";
            }
            
            // Nếu có lỗi validate -> Trả về View ngay
            if(!empty($errors)){
                require "./views/auth/login.php";
                return;
            }

            // 2. Kiểm tra thông tin trong DB
            $user = $this->userModel->getUserByEmail($email);

            if($user && password_verify($password, $user['password'])){
                // Lưu session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['fullname'];
                $_SESSION['role'] = $user['role'];
                
                // Điều hướng theo Role
                switch ($user['role']) {
                    case 0: // Student
                        header('Location: index.php?controller=student&action=dashboard');
                        break;
                    case 1: // Instructor (Ví dụ)
                        header('Location: index.php?controller=instructor&action=dashboard');
                        break;
                    case 2: // Admin (Ví dụ)
                        header('Location: index.php?controller=admin&action=dashboard');
                        break;
                    default:
                        header('Location: index.php');
                }
                exit; // Quan trọng: Dừng luồng sau khi redirect
            } else {
                // Sai tài khoản hoặc mật khẩu
                $errors[] = "Email hoặc mật khẩu không chính xác!";
                require "./views/auth/login.php";
            }
        }
    }

    // --- ĐĂNG KÝ ---
    public function register(){
        require './views/auth/register.php';
    }

    public function handleRegister(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $userName = trim($_POST['username'] ?? '');
            $email    = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? ''; // Mật khẩu không nên trim vì khoảng trắng cũng là ký tự
            $fullname = trim($_POST['fullname'] ?? '');

            // Mặc định role = 0 (Student)
            // Bạn không cần biến $role ở đây nếu hàm studentRegister đã mặc định insert role 0

            $errors = [];

            // --- VALIDATE DỮ LIỆU ---

            // Username
            if (empty($userName)) {
                $errors[] = "Tên đăng nhập không được để trống.";
            } else if (strlen($userName) < 4) {
                $errors[] = "Tên đăng nhập phải có ít nhất 4 ký tự.";
            }

            // Email
            if (empty($email)){
                $errors[] = "Vui lòng nhập email!";
            } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Email không hợp lệ!";
            } else {
                // Check trùng email
                if($this->userModel->getUserByEmail($email)){
                    $errors[] = "Email này đã được sử dụng!";
                }
            }

            // Password
            if (empty($password)){
                $errors[] = "Vui lòng nhập mật khẩu!";
            } else if(strlen($password) < 8){
                $errors[] = "Mật khẩu phải có ít nhất 8 ký tự!";
            } elseif (!preg_match("/[a-z]/", $password)){
                $errors[] = "Mật khẩu phải có ít nhất 1 chữ cái thường!";
            } elseif (!preg_match("/[A-Z]/", $password)) {
                $errors[] = "Mật khẩu phải có ít nhất một chữ cái hoa.";
            } elseif (!preg_match("/[0-9]/", $password)) {
                $errors[] = "Mật khẩu phải có ít nhất một chữ số.";
            } elseif (!preg_match("/[!@#$%^&*()\-_=+{};:,<.>]/", $password)) {
                $errors[] = "Mật khẩu phải chứa ít nhất một ký tự đặc biệt.";
            }

            // Fullname
            if (empty($fullname)){
                $errors[] = "Vui lòng nhập họ tên!";
            }

            // --- QUAN TRỌNG: KIỂM TRA LỖI TRƯỚC KHI TẠO ---
            if (!empty($errors)) {
                // Nếu có bất kỳ lỗi nào, require lại view để hiện lỗi và DỪNG hàm lại
                require './views/auth/register.php';
                return; 
            }

            // Nếu không có lỗi -> Gọi Model để tạo User
            // Lưu ý: Password nên được hash trong Model hoặc hash tại đây trước khi truyền đi
            // Giả sử hàm studentRegister của bạn tự hash password nhé.
            $isCreated = $this->userModel->studentRegister($userName, $email, $password, $fullname);

            if($isCreated){
                // Đăng ký thành công -> Chuyển về trang đăng nhập
                header('Location: index.php?controller=auth&action=login');
                exit;
            } else {
                $errors[] = 'Lỗi hệ thống, không thể tạo tài khoản lúc này!';
                require './views/auth/register.php';
            }
        }
    }
}
?>