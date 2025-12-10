<?php
require_once __DIR__ . '/../config/Database.php';

class User{
    private $db;
    public function __construct(){
        $this->db = Database::getInstance();
    }
    //Đăng nhập cho học viên(role = 0)
    public function studentRegister($username, $email, $password, $fullname, $role){
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users(username, email, password, fullname, role) VALUES(?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$username, $email, $hashed_password, $fullname, $role]);
    }
    //check đăng nhập bằng email
    public function getUserByEmail($email){
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllUsers(){
        $stmt = $this->db->prepare("SELECT * FROM users");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserByUsername($username){
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


}



?>