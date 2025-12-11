<?php
//version 1.1.0
require_once 'config/Database.php';

class User {
    private $db;
    private $table = 'users';

    public function __construct() {
        $this->db = Database::getInstance();
    }
    // ========================================== 
    // KHU VỰC DÀNH CHO HỌC VIÊN (AUTH & USER)
    // ==========================================
  
    // Đăng nhập cho học viên (role = 0)
    public function studentRegister($username, $email, $password, $fullname, $role) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users(username, email, password, fullname, role) VALUES(?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$username, $email, $hashed_password, $fullname, $role]);
    }

    // Check user bằng email
    public function getUserByEmail($email) {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Check user bằng username
    public function getUserByUsername($username) {
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ==========================================
    // KHU VỰC DÀNH CHO QUẢN LÝ (ADMIN)
    // ==========================================

    // Lấy tất cả user (Có sắp xếp mới nhất)
    public function getAllUsers() {
        $stmt = $this->db->prepare("SELECT * FROM " . $this->table . " ORDER BY id DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Đổi trạng thái user (Active/Inactive)
    public function toggleStatus($id, $status) {
        $stmt = $this->db->prepare("UPDATE " . $this->table . " SET status = :status WHERE id = :id");
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // Đếm tổng số user
    public function count() {
        $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM " . $this->table);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'];
    }
}
?>