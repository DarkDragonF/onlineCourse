<?php include __DIR__ . '/../layouts/header.php'; ?>

<h3>➕ Thêm khóa học mới</h3>

<form action="index.php?controller=course&action=store" method="POST" enctype="multipart/form-data" class="mt-3">

    <div class="mb-3">
        <label for="title" class="form-label">Tiêu đề khóa học</label>
        <input type="text" name="title" id="title" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Mô tả</label>
        <textarea name="description" id="description" rows="4" class="form-control" required></textarea>
    </div>

    <div class="mb-3">
        <label for="instructor_id" class="form-label">Giảng viên</label>
        <select name="instructor_id" id="instructor_id" class="form-select" required>
            <option value="">-- Chọn giảng viên --</option>
            <?php foreach ($instructors as $inst): ?>
                <option value="<?= $inst['id'] ?>"><?= htmlspecialchars($inst['fullname']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="category_id" class="form-label">Danh mục</label>
        <select name="category_id" id="category_id" class="form-select" required>
            <option value="">-- Chọn danh mục --</option>
            <?php foreach ($categories as $cat): ?>
                <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="price" class="form-label">Giá (VNĐ)</label>
        <input type="number" name="price" id="price" class="form-control" min="0" step="1000" value="0" required>
    </div>

    <div class="mb-3">
        <label for="duration_weeks" class="form-label">Thời lượng (tuần)</label>
        <input type="number" name="duration_weeks" id="duration_weeks" class="form-control" min="1" required>
    </div>

    <div class="mb-3">
        <label for="level" class="form-label">Cấp độ</label>
        <select name="level" id="level" class="form-select" required>
            <option value="">-- Chọn cấp độ --</option>
            <option value="Beginner">Beginner</option>
            <option value="Intermediate">Intermediate</option>
            <option value="Advanced">Advanced</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="image" class="form-label">Ảnh Thumbnail</label>
        <input type="file" name="image" id="image" class="form-control" accept="image/*">
    </div>

    <button type="submit" class="btn btn-success">Lưu khóa học</button>
    <a href="index.php?controller=course&action=index" class="btn btn-secondary">Hủy</a>

</form>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
