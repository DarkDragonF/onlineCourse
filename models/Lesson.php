// File: models/Lesson.php
<?php
// Tái sử dụng file cấu hình Database đã có
require_once './config/Database.php'; 

class Lesson {
    private $conn;
    // Tên bảng lessons. Giả định tên bảng là lessons
    private $table_name = "lessons"; 

    public function __construct() {
        // Lấy kết nối PDO
        $this->conn = Database::getInstance(); //
    }

    // ================================================================
    // PHẦN 1: TẠO/THÊM BÀI HỌC
    // ================================================================

    /**
     * Tạo bài học mới cho một khóa học, bao gồm video_url và thứ tự.
     */
    public function create($data) {
        // Chú ý: Cột 'order' là từ khóa trong SQL nên cần dùng dấu backtick (`)
        $query = "INSERT INTO " . $this->table_name . " 
                  (course_id, title, content, video_url, `order`)
                  VALUES (:course_id, :title, :content, :video_url, :lesson_order)";

        $stmt = $this->conn->prepare($query);

        // Làm sạch dữ liệu đầu vào (Giống Course.php)
        $data['title'] = htmlspecialchars(strip_tags($data['title']));

        return $stmt->execute([
            ':course_id'   => $data['course_id'],
            ':title'       => $data['title'],
            ':content'     => $data['content'],
            ':video_url'   => $data['video_url'] ?? null,
            // Sử dụng lesson_order từ POST để map vào cột `order` trong DB
            ':lesson_order'=> $data['lesson_order'] ?? 0, 
        ]);
    }

    // ================================================================
    // PHẦN 2: LẤY DỮ LIỆU
    // ================================================================

    /**
     * Lấy tất cả bài học thuộc một khóa học, sắp xếp theo cột `order`.
     */
    public function getLessonsByCourse($course_id) {
        $query = "SELECT * FROM " . $this->table_name . " 
                  WHERE course_id = :course_id
                  ORDER BY `order` ASC, id ASC"; 

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':course_id', $course_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>