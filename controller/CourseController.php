<?php
require_once "models/Course.php";

class CourseController {

    private $course;
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
        $this->course = new Course($db);
    }

    // Danh sách khóa học
    public function index()
    {
        $courses = $this->course->all();
        include "views/courses/index.php";
    }

    // Form tạo
    public function create()
    {
        // Lấy category
        $categories = $this->db->query("SELECT * FROM categories");

        // Lấy danh sách instructors (role = 1)
        $instructors = $this->db->query("SELECT * FROM users WHERE role = 1");

        include "views/courses/create.php";
    }

    // Lưu khóa học
    public function store()
    {
        // Xử lý ảnh upload
        $image = "";
        if (!empty($_FILES["image"]["name"])) {
            $image = "uploads/" . time() . "_" . $_FILES["image"]["name"];
            move_uploaded_file($_FILES["image"]["tmp_name"], $image);
        }

        $data = [
            "title" => $_POST["title"],
            "description" => $_POST["description"],
            "instructor_id" => $_POST["instructor_id"],
            "category_id" => $_POST["category_id"],
            "price" => $_POST["price"],
            "duration_weeks" => $_POST["duration_weeks"],
            "level" => $_POST["level"],
            "image" => $image,
        ];

        $this->course->create($data);

        header("Location: index.php?controller=course&action=index");
    }
}
?>
