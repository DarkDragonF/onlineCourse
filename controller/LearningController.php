<?php
//version 1.2.0
require_once './models/Course.php';
require_once './models/Lesson.php';
require_once './models/Enrollment.php';

class LearningController {
    
    // Trang vào học
    public function index() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        
        if (!isset($_SESSION['user_id']) || !isset($_GET['course_id'])) {
            header("Location: index.php");
            exit();
        }

        $studentId = $_SESSION['user_id'];
        $courseId = $_GET['course_id'];

        // 1. Kiểm tra xem có mua khóa học chưa?
        $enrollmentModel = new Enrollment();
        if (!$enrollmentModel->isEnrolled($studentId, $courseId)) {
            die("Bạn chưa đăng ký khóa học này!");
        }

        // 2. Lấy thông tin khóa học và danh sách bài học
        $courseModel = new Course();
        $course = $courseModel->getCourseById($courseId);
        
        $lessonModel = new Lesson();
        $lessons = $lessonModel->getLessonsByCourseId($courseId);
        
        // 3. Lấy danh sách ID các bài đã hoàn thành
        $completedLessonIds = $lessonModel->getCompletedLessons($studentId, $courseId);

        // 4. Xác định bài học đang xem (Mặc định là bài đầu tiên)
        $currentLesson = null;
        if (isset($_GET['lesson_id'])) {
            // Nếu user chọn bài cụ thể
            foreach ($lessons as $l) {
                if ($l['id'] == $_GET['lesson_id']) {
                    $currentLesson = $l;
                    break;
                }
            }
        } else {
            // Mặc định: Tìm bài đầu tiên CHƯA hoàn thành để cho user học tiếp
            foreach ($lessons as $l) {
                if (!in_array($l['id'], $completedLessonIds)) {
                    $currentLesson = $l;
                    break;
                }
            }
            // Nếu học xong hết rồi thì lấy bài cuối cùng hoặc bài đầu
            if (!$currentLesson && count($lessons) > 0) {
                $currentLesson = $lessons[0];
            }
        }

        // 5. Tính toán % tiến độ
        $totalLessons = count($lessons);
        $totalCompleted = count($completedLessonIds);
        $progressPercent = ($totalLessons > 0) ? round(($totalCompleted / $totalLessons) * 100) : 0;

        require_once './views/learning/index.php';
    }

    // Xử lý khi bấm nút "Hoàn thành bài học"
    public function complete() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $studentId = $_SESSION['user_id'];
            $courseId = $_POST['course_id'];
            $lessonId = $_POST['lesson_id'];

            $lessonModel = new Lesson();
            // Đánh dấu xong
            $isNew = $lessonModel->markAsComplete($studentId, $courseId, $lessonId);
            
            // Cập nhật % tổng
            if ($isNew) {
                $lessonModel->updateCourseProgress($studentId, $courseId);
            }

            // Chuyển sang bài tiếp theo (nếu có)
            // Logic đơn giản: Quay lại trang learning, controller sẽ tự detect bài tiếp theo
            header("Location: index.php?controller=learning&action=index&course_id=$courseId");
        }
    }
}
?>