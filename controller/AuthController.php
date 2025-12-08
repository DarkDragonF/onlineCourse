<?php
require_once "/models/User.php";

class AuthController{
    public function __construct(){
        $this->userModel = new User();
        //Khởi tạo session đăng nhập
        if(session_status() = PHP_SESSION_NONE){
            session_start();
        }
    }
    //Đăng Nhập
    public function login(){
        require "/views/auth/login.php"
    }

    public function handleLogin(){
        if($_SERVER['REQUEST_METHOD'] = 'POST'){
            $email = htmlspecialchars($_POST['email']) ?? '';
            $password = htmlspecialchars($_POST['password']) ?? '';

            $user = $this->userModel->getUserByEmail($email);
            $error = [];
            //validate dữ liệu
            if($user && password_verify($password, $user['password'])){
                //Lưu session
                if(session_status() == PHP_SESSION_NONE){
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_name'] = $user['fullname'];
                    $_SESSION['role'] = $user['role'];
                }
                
                //Xét userRole
                if($user['role'] == 0){
                    header('Location: ...');
                    exit;
                }
                else if($user['role'] == 1){
                    header('Location: ...');
                    exit;
                }
                else if($user['role'] == 2){
                    header('Location: ...');
                    exit;
                }
            }
            else{
                $error = "...";
                //require view của login để nhìn thấy biến $error
                require "/views/auth/login.php";
            }
        }
    }

    //Đăng Ký
    public function register(){
        require '/views/auth/register.php'
    }

    public function handleRegister(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $userName = htmlspecialchars($_POST['username']);
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);
            $fullname = htmlspecialchars($_POST['fullname']);

            $role = 0;
            //validate dữ liệu

            $isCreated = $this->userModel->studentRegister($userName, $email, $password, $fullname);

            if($isCreated){
                header('Location: ....');
            }
            else{
                $error = 'Lỗi!';
            }
        }
    }


}



?>