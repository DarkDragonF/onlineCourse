<?php
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
        require "./views/auth/login.php";
    }

    public function handleLogin(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');

            $errors = [];

            //validate
            if(empty($email)){
                $errors[] = "Vui lòng nhập email!";
            } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errors[] = "Định dạng email không hợp lệ!";
            }

            if(empty($password)){
                $errors[] = "Vui lòng nhập mật khẩu!";
            }
            
            if(!empty($errors)){
                require "./views/auth/login.php";
                return;
            }

            $user = $this->userModel->getUserByEmail($email);

            if($user && password_verify($password, $user['password'])){
                // Lưu session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['fullname'];
                $_SESSION['role'] = $user['role'];
                
                switch ($user['role']) {
                    //check sau khi merge
                    case 0:
                        header('Location: index.php?controller=student&action=dashboard');
                        break;
                    case 1: 
                        header('Location: index.php?controller=instructor&action=dashboard');
                        break;
                    case 2:
                        header('Location: index.php?controller=admin&action=dashboard');
                        break;
                    default:
                        header('Location: index.php');
                }
                exit; 
            } else {
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
            $password = $_POST['password'] ?? ''; 
            $fullname = trim($_POST['fullname'] ?? '');

            $role = 0;

            $errors = [];

            // Username
            if (empty($userName)) {
                $errors[] = "Tên đăng nhập không được để trống.";
            } else if (strlen($userName) < 4) {
                $errors[] = "Tên đăng nhập phải có ít nhất 4 ký tự.";
            } 
            $existingUser = $this->userModel->getUserByUsername($userName);
            if ($existingUser) {
                $errors[] = "Tên đăng nhập '$userName' đã có người sử dụng. Vui lòng chọn tên khác!";
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

            if (!empty($errors)) {
                require './views/auth/register.php';
                return; 
            }

            $isCreated = $this->userModel->studentRegister($userName, $email, $password, $fullname, $role);

            if($isCreated){
                //thêm sau khi merge
                header('...');
                exit;
            } else {
                $errors[] = 'Lỗi hệ thống, không thể tạo tài khoản lúc này!';
                require './views/auth/register.php';
            }
        }
    }
}
?>