<?php
// Gọi file cấu hình DB. Hãy chắc chắn đường dẫn và tên file (hoa/thường) là đúng.
require_once './config/Database.php';

class Course {
    private $conn;
    private $table_name = "courses";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection(); 
    }

    // ================================================================
    // PHẦN 1: QUẢN TRỊ (ADMIN/INSTRUCTOR) - THÊM SỬA XÓA
    // ================================================================

    // Tạo khóa học mới (Lấy từ đoạn code 1)
    public function create($data) {
        $query = "INSERT INTO " . $this->table_name . " 
                  (title, description, instructor_id, category_id, price, duration_weeks, level, image)
                  VALUES (:title, :description, :instructor_id, :category_id, :price, :duration_weeks, :level, :image)";

        $stmt = $this->conn->prepare($query);
        $data['title'] = htmlspecialchars(strip_tags($data['title']));

        return $stmt->execute([
            ':title'          => $data['title'],
            ':description'    => $data['description'],
            ':instructor_id'  => $data['instructor_id'],
            ':category_id'    => $data['category_id'],
            ':price'          => $data['price'],
            ':duration_weeks' => $data['duration_weeks'],
            ':level'          => $data['level'],
            ':image'          => $data['image'],
        ]);
    }

    // ================================================================
    // PHẦN 2: HIỂN THỊ (FRONTEND) - LẤY DỮ LIỆU
    // ================================================================

    // 1. Lấy danh sách khóa học MỚI NHẤT (Cho Trang Chủ)
    public function getNewCourses($limit = 6) {
        $query = "SELECT c.*, u.fullname as instructor_name 
                  FROM " . $this->table_name . " c
                  LEFT JOIN users u ON c.instructor_id = u.id
                  ORDER BY c.created_at DESC 
                  LIMIT :limit";

        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 2. Lấy khóa học NỔI BẬT (Cho Slider hoặc mục Hot)
    public function getFeaturedCourses($limit = 3) {
        // Tạm thời lấy các khóa học có level là 'Advanced' hoặc lấy theo ID, tùy logic của bạn
        $query = "SELECT c.*, u.fullname as instructor_name 
                  FROM " . $this->table_name . " c
                  LEFT JOIN users u ON c.instructor_id = u.id
                  LIMIT :limit"; // Có thể thêm WHERE is_featured = 1 nếu bảng có cột đó
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 3. Lấy TẤT CẢ khóa học (Cho trang Danh sách khóa học)
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

    // 4. Lấy CHI TIẾT 1 khóa học theo ID
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

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    // 5. Tìm kiếm khóa học
    public function searchCourses($keyword) {
        $query = "SELECT c.*, u.fullname as instructor_name
                  FROM " . $this->table_name . " c
                  LEFT JOIN users u ON c.instructor_id = u.id
                  WHERE c.title LIKE :keyword OR c.description LIKE :keyword";
                  
        $stmt = $this->conn->prepare($query);
        
        $keyword = "%{$keyword}%";
        $stmt->bindParam(':keyword', $keyword);
        
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>