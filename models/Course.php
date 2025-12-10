<?php
// Gọi file cấu hình DB để sử dụng kết nối
require_once './config/database.php';

class Course {
    private $conn;
    private $table_name = "courses";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // 1. Lấy danh sách khóa học MỚI NHẤT (Cho Trang Chủ)
    public function getNewCourses($limit = 6) {
        $query = "SELECT c.*, u.fullname as instructor_name 
                  FROM " . $this->table_name . " c
                  LEFT JOIN users u ON c.instructor_id = u.id
                  ORDER BY c.created_at DESC 
                  LIMIT :limit";

        $stmt = $this->conn->prepare($query);
        
        // Gán giá trị cho tham số :limit (phải ép kiểu int cho chuẩn PDO)
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 2. Lấy khóa học NỔI BẬT (Cho Slider hoặc mục Hot)
    public function getFeaturedCourses($limit = 3) {
        // Tạm thời lấy 3 khóa đầu tiên làm nổi bật
        $query = "SELECT * FROM " . $this->table_name . " LIMIT :limit";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 3. Lấy TẤT CẢ khóa học (Cho trang Danh sách khóa học - Features sau này)
    public function getAllCourses() {
        $query = "SELECT c.*, u.fullname as instructor_name, cat.name as category_name
                  FROM " . $this->table_name . " c
                  LEFT JOIN users u ON c.instructor_id = u.id
                  LEFT JOIN categories cat ON c.category_id = cat.id
                  ORDER BY c.created_at DESC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 4. Lấy CHI TIẾT 1 khóa học theo ID (Cho trang Chi tiết khóa học)
    public function getCourseById($id) {
        $query = "SELECT c.*, u.fullname as instructor_name, cat.name as category_name
                  FROM " . $this->table_name . " c
                  LEFT JOIN users u ON c.instructor_id = u.id
                  LEFT JOIN categories cat ON c.category_id = cat.id
                  WHERE c.id = :id
                  LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        // fetch (lấy 1 dòng) thay vì fetchAll
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    // 5. Tìm kiếm khóa học (Cho thanh Search)
    public function searchCourses($keyword) {
        $query = "SELECT c.*, u.fullname as instructor_name
                  FROM " . $this->table_name . " c
                  LEFT JOIN users u ON c.instructor_id = u.id
                  WHERE c.title LIKE :keyword OR c.description LIKE :keyword";
                  
        $stmt = $this->conn->prepare($query);
        
        // Thêm dấu % để tìm kiếm gần đúng
        $keyword = "%{$keyword}%";
        $stmt->bindParam(':keyword', $keyword);
        
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>