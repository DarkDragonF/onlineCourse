<?php
// version 1.1.4 (Fix variable name mismatch)
require_once 'config/Database.php';

class User {
    // Khai báo biến kết nối là $db (Code cũ của bạn dùng tên này)
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

    // --- ĐÃ SỬA: Dùng $this->db thay vì $this->conn ---
    public function getById($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id LIMIT 1";
        
        // Sửa tại đây: $this->db
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // --- ĐÃ SỬA: Dùng $this->db thay vì $this->conn ---
    public function updateProfile($id, $fullname, $phone, $bio, $avatar) {
        if ($avatar) {
            $query = "UPDATE " . $this->table . " 
                      SET fullname = :fullname, 
                          phone = :phone, 
                          bio = :bio, 
                          avatar = :avatar 
                      WHERE id = :id";
        } 
        else {
            $query = "UPDATE " . $this->table . " 
                      SET fullname = :fullname, 
                          phone = :phone, 
                          bio = :bio 
                      WHERE id = :id";
        }

        // Sửa tại đây: $this->db
        $stmt = $this->db->prepare($query);

        // Gán dữ liệu
        $stmt->bindParam(':fullname', $fullname);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':bio', $bio);
        $stmt->bindParam(':id', $id);
        
        if ($avatar) {
            $stmt->bindParam(':avatar', $avatar);
        }

        return $stmt->execute();
    }

    // ==========================================
    // KHU VỰC DÀNH CHO QUẢN LÝ (ADMIN)
    // ==========================================

    // Lấy tất cả user
    public function getAllUsers() {
        $stmt = $this->db->prepare("SELECT * FROM " . $this->table . " ORDER BY id DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Đổi trạng thái user
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