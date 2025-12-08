<?php

class Course {

    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    // Lấy danh sách khóa học
    public function all()
    {
        $sql = "SELECT courses.*, users.fullname AS instructor_name, categories.name AS category_name
                FROM courses
                JOIN users ON users.id = courses.instructor_id
                JOIN categories ON categories.id = courses.category_id
                ORDER BY courses.id DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(); // trả về array
    }

    // Tạo khóa học
    public function create($data)
    {
        $sql = "INSERT INTO courses (title, description, instructor_id, category_id, price, duration_weeks, level, image)
                VALUES (:title, :description, :instructor_id, :category_id, :price, :duration_weeks, :level, :image)";

        $stmt = $this->db->prepare($sql);

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
}
?>
