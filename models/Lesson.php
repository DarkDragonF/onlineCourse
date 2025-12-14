<?php
require_once './config/Database.php';

class Lesson {
    private $conn;

    public function __construct() {
        $this->conn = Database::getInstance();
    }

    // Lấy danh sách bài học của khóa học (Sắp xếp theo thứ tự)
    public function getLessonsByCourseId($courseId) {
        $query = "SELECT * FROM lessons WHERE course_id = :course_id ORDER BY `order_` ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([':course_id' => $courseId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy chi tiết 1 bài học
    public function getLessonById($lessonId) {
        $query = "SELECT * FROM lessons WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([':id' => $lessonId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Lấy danh sách ID các bài đã học xong của User trong khóa này
    public function getCompletedLessons($studentId, $courseId) {
        $query = "SELECT lesson_id FROM student_lesson_progress 
                  WHERE student_id = :student_id AND course_id = :course_id AND is_completed = 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([':student_id' => $studentId, ':course_id' => $courseId]);
        return $stmt->fetchAll(PDO::FETCH_COLUMN); // Trả về mảng [1, 2, 5...]
    }

    // Đánh dấu hoàn thành bài học
    public function markAsComplete($studentId, $courseId, $lessonId) {
        // Kiểm tra xem đã lưu chưa để tránh trùng lặp
        $check = "SELECT id FROM student_lesson_progress 
                  WHERE student_id = :student_id AND lesson_id = :lesson_id";
        $stmt = $this->conn->prepare($check);
        $stmt->execute([':student_id' => $studentId, ':lesson_id' => $lessonId]);
        
        if ($stmt->rowCount() == 0) {
            // Nếu chưa có thì Insert
            $query = "INSERT INTO student_lesson_progress (student_id, course_id, lesson_id, is_completed) 
                      VALUES (:student_id, :course_id, :lesson_id, 1)";
            $this->conn->prepare($query)->execute([
                ':student_id' => $studentId,
                ':course_id' => $courseId,
                ':lesson_id' => $lessonId
            ]);
            return true; // Mới hoàn thành
        }
        return false; // Đã hoàn thành từ trước
    }

    // Cập nhật % tiến độ tổng vào bảng enrollments
    public function updateCourseProgress($studentId, $courseId) {
        // 1. Đếm tổng số bài học
        $stmt1 = $this->conn->prepare("SELECT COUNT(*) FROM lessons WHERE course_id = ?");
        $stmt1->execute([$courseId]);
        $totalLessons = $stmt1->fetchColumn();

        if ($totalLessons == 0) return;

        // 2. Đếm số bài đã học
        $stmt2 = $this->conn->prepare("SELECT COUNT(*) FROM student_lesson_progress WHERE student_id = ? AND course_id = ? AND is_completed = 1");
        $stmt2->execute([$studentId, $courseId]);
        $completedLessons = $stmt2->fetchColumn();

        // 3. Tính % và Update
        $percent = round(($completedLessons / $totalLessons) * 100);
        
        $update = "UPDATE enrollments SET progress = :progress WHERE student_id = :sid AND course_id = :cid";
        $this->conn->prepare($update)->execute([
            ':progress' => $percent,
            ':sid' => $studentId,
            ':cid' => $courseId
        ]);
    }
}
?>