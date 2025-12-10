<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="container mt-4">
    <h3 class="mb-3">📚 Danh sách khóa học</h3>

    <a href="index.php?controller=course&action=create" class="btn btn-primary mb-3">
        + Thêm khóa học mới
    </a>

    <table class="table table-bordered table-striped">
        <tr class="table-dark">
            <th>ID</th>
            <th>Tiêu đề</th>
            <th>Giảng viên</th>
            <th>Danh mục</th>
            <th>Giá</th>
            <th>Cấp độ</th>
            <th>Ảnh</th>
        </tr>

        <?php foreach($courses as $row): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['title'] ?></td>
            <td><?= $row['instructor_name'] ?></td>
            <td><?= $row['category_name'] ?></td>
            <td><?= $row['price'] ?></td>
            <td><?= $row['level'] ?></td>
            <td><img src="<?= $row['image'] ?>" height="60"></td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
