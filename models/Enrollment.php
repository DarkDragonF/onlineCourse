<?php
require_once 'config/Database.php';

class Enrollment {
    private $conn;
    private $table = 'enrollments';

    public function __construct() {
        $this->conn = Database::getInstance();
    }

    // Kiểm tra xem user đã mua khóa học này chưa
    public function isEnrolled($userId, $courseId) {
        $query = "SELECT id FROM " . $this->table . " WHERE user_id = :user_id AND course_id = :course_id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([':user_id' => $userId, ':course_id' => $courseId]);
        return $stmt->fetch();
    }

    // Đăng ký học (Lưu thông tin mua)
    public function create($userId, $courseId, $price) {
        $query = "INSERT INTO " . $this->table . " (user_id, course_id, price) VALUES (:user_id, :course_id, :price)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            ':user_id' => $userId,
            ':course_id' => $courseId,
            ':price' => $price
        ]);
    }

    // Lấy danh sách khóa học của 1 user (để hiển thị My Courses sau này)
    public function getCoursesByUserId($userId) {
        $query = "SELECT c.*, e.created_at as enrolled_date, u.fullname as instructor_name 
                  FROM " . $this->table . " e
                  JOIN courses c ON e.course_id = c.id
                  JOIN users u ON c.instructor_id = u.id
                  WHERE e.user_id = :user_id
                  ORDER BY e.created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([':user_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>