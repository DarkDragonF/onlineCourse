<?php
//version 1.1.1
// Gọi file cấu hình DB.
require_once './config/Database.php';

class Course {
    private $conn;
    private $table_name = "courses";

    public function __construct() {
        $this->conn = Database::getInstance();
    }

    // ================================================================
    // PHẦN 1: QUẢN TRỊ (ADMIN/INSTRUCTOR) - THÊM SỬA XÓA
    // ================================================================

    // Tạo khóa học mới
    public function create($data) {
        $query = "INSERT INTO " . $this->table_name . " 
                  (title, description, instructor_id, category_id, price, duration_weeks, level, image)
                  VALUES (:title, :description, :instructor_id, :category_id, :price, :duration_weeks, :level, :image)";

        $stmt = $this->conn->prepare($query);

        // Làm sạch dữ liệu đầu vào (cơ bản)
        $data['title'] = htmlspecialchars(strip_tags($data['title']));
        // $data['description'] thường không dùng strip_tags nếu dùng CKEditor, nhưng cần cẩn thận XSS

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

    // 1. Lấy danh sách khóa học MỚI NHẤT
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

    // 2. Lấy khóa học NỔI BẬT
    public function getFeaturedCourses($limit = 3) {
        $query = "SELECT c.*, u.fullname as instructor_name 
                  FROM " . $this->table_name . " c
                  LEFT JOIN users u ON c.instructor_id = u.id
                  -- Có thể thêm điều kiện WHERE level = 'Advanced' hoặc is_featured = 1
                  ORDER BY c.price DESC 
                  LIMIT :limit"; 
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 3. Lấy TẤT CẢ khóa học (Kèm tên giảng viên và danh mục)
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