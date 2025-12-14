<?php 
// Giả định layout header.php nằm ở views/layouts/
include __DIR__ . '/../layouts/header.php'; 
?>

<div class="container mt-5">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">
            <i class="fas fa-file-alt me-2"></i> Thêm Bài học mới
        </h3>
        <a href="index.php?controller=lesson&action=list&course_id=<?= $course['id'] ?>" class="btn btn-sm btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Quay lại
        </a>
    </div>

    <div class="alert alert-info py-2" role="alert">
        <strong>Khóa học:</strong> <?= htmlspecialchars($course['title']) ?> (ID: <?= $course['id'] ?>)
    </div>

    <form action="index.php?controller=lesson&action=store" method="POST" class="needs-validation" novalidate>
        
        <input type="hidden" name="course_id" value="<?= $course['id'] ?>">

        <div class="row mb-3">
            <div class="col-md-9">
                <div class="form-group">
                    <label for="title" class="form-label fw-bold">1. Tiêu đề bài học <span class="text-danger">*</span></label>
                    <input type="text" name="title" id="title" class="form-control" placeholder="Ví dụ: Bài 1: Giới thiệu về PHP cơ bản" required>
                    <div class="invalid-feedback">Vui lòng nhập tiêu đề bài học.</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="lesson_order" class="form-label fw-bold">2. Thứ tự <span class="text-danger">*</span></label>
                    <input type="number" name="lesson_order" id="lesson_order" class="form-control" min="0" value="1" required>
                    <div class="form-text">Số thứ tự hiển thị trong khóa học.</div>
                    <div class="invalid-feedback">Vui lòng nhập thứ tự bài học.</div>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label for="video_url" class="form-label fw-bold">3. URL Video <small class="text-muted">(Tùy chọn)</small></label>
            <input type="url" name="video_url" id="video_url" class="form-control" placeholder="Dán liên kết YouTube, Vimeo hoặc Google Drive tại đây.">
            <div class="form-text">Nếu không có video, nội dung bài học sẽ chỉ là văn bản.</div>
        </div>

        <div class="mb-4">
            <label for="content" class="form-label fw-bold">4. Nội dung bài học/Văn bản <span class="text-danger">*</span></label>
            <textarea name="content" id="content" rows="8" class="form-control" required placeholder="Nhập phần giải thích, hướng dẫn, và tóm tắt cho bài học này."></textarea>
            <div class="invalid-feedback">Nội dung bài học không được để trống.</div>
        </div>

        <div class="d-flex justify-content-end">
            <a href="index.php?controller=lesson&action=list&course_id=<?= $course['id'] ?>" class="btn btn-secondary me-2">
                <i class="fas fa-times"></i> Hủy
            </a>
            <button type="submit" class="btn btn-success">
                <i class="fas fa-save"></i> Lưu Bài học
            </button>
        </div>

    </form>
</div>

<script>
    (function () {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>

<?php 
// Giả định layout footer.php nằm ở views/layouts/
include __DIR__ . '/../layouts/footer.php'; 
?>