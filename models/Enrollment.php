<?php
require_once './config/Database.php';

class Enrollment {
    private $conn;
    private $table = 'enrollments'; 

    public function __construct() {
        $this->conn = Database::getInstance();
    }

    // Lấy danh sách khóa học của học viên
    public function getMyCourses($studentId) {
        $query = "SELECT 
                    e.progress, 
                    e.enrolled_date, 
                    e.status,         
                    c.id as course_id,
                    c.title, 
                    c.image, 
                    c.duration_weeks,
                    u.fullname as instructor_name
                  FROM " . $this->table . " e
                  JOIN courses c ON e.course_id = c.id
                  LEFT JOIN users u ON c.instructor_id = u.id
                  WHERE e.student_id = :student_id  
                  ORDER BY e.enrolled_date DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':student_id', $studentId);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Đếm số lượng khóa học đã đăng ký
    public function countEnrolled($studentId) {
        $query = "SELECT COUNT(*) as total FROM " . $this->table . " WHERE student_id = :student_id";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':student_id', $studentId);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'];
    }
}
?>