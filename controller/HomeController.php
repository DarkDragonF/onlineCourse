<?php
// Gọi Model Course để lấy dữ liệu
require_once './models/Course.php';

class HomeController {

    public function index() {
        // 1. Khởi tạo Model
        $courseModel = new Course();
        $newCourses = $courseModel->getNewCourses(8);

        require_once './views/home/index.php';
    }
}
?>