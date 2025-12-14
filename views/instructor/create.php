<?php include __DIR__ . '/../layouts/header.php'; ?>
<!-- //version 1.2.0 -->
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-bold text-primary mb-0">
                    <i class="fas fa-plus-circle me-2"></i>Thêm khóa học mới
                </h3>
                <a href="index.php?controller=instructor&action=dashboard" class="btn btn-outline-secondary rounded-pill px-4">
                    <i class="fas fa-arrow-left me-2"></i>Quay lại
                </a>
            </div>

            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header bg-primary bg-gradient text-white p-3">
                    <h6 class="mb-0 fw-bold"><i class="fas fa-pen-nib me-2"></i>Nhập thông tin chi tiết</h6>
                </div>
                
                <div class="card-body p-4 bg-white">
                    <form action="index.php?controller=course&action=store" method="POST" enctype="multipart/form-data">

                        <div class="mb-4">
                            <label for="title" class="form-label fw-bold text-dark">Tiêu đề khóa học <span class="text-danger">*</span></label>
                            <input type="text" name="title" id="title" class="form-control form-control-lg bg-light" placeholder="Ví dụ: Lập trình PHP căn bản..." required>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="form-label fw-bold text-dark">Mô tả nội dung <span class="text-danger">*</span></label>
                            <textarea name="description" id="description" rows="5" class="form-control bg-light" placeholder="Nhập mô tả chi tiết về khóa học..." required></textarea>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-4">
                                <label for="instructor_id" class="form-label fw-bold small text-uppercase text-muted">Giảng viên</label>
                                <select name="instructor_id" id="instructor_id" class="form-select" required>
                                    <option value="">-- Chọn giảng viên --</option>
                                    <?php foreach ($instructors as $inst): ?>
                                        <option value="<?= $inst['id'] ?>"><?= htmlspecialchars($inst['fullname']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="category_id" class="form-label fw-bold small text-uppercase text-muted">Danh mục</label>
                                <select name="category_id" id="category_id" class="form-select" required>
                                    <option value="">-- Chọn danh mục --</option>
                                    <?php foreach ($categories as $cat): ?>
                                        <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="level" class="form-label fw-bold small text-uppercase text-muted">Cấp độ</label>
                                <select name="level" id="level" class="form-select" required>
                                    <option value="">-- Chọn cấp độ --</option>
                                    <option value="Beginner">Cơ bản (Beginner)</option>
                                    <option value="Intermediate">Trung bình (Intermediate)</option>
                                    <option value="Advanced">Nâng cao (Advanced)</option>
                                </select>
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label for="price" class="form-label fw-bold text-dark">Học phí</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="fas fa-tag text-muted"></i></span>
                                    <input type="number" name="price" id="price" class="form-control border-start-0 ps-0" min="0" step="1000" value="0" required>
                                    <span class="input-group-text fw-bold">VNĐ</span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="duration_weeks" class="form-label fw-bold text-dark">Thời lượng</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="fas fa-clock text-muted"></i></span>
                                    <input type="number" name="duration_weeks" id="duration_weeks" class="form-control border-start-0 ps-0" min="1" required>
                                    <span class="input-group-text fw-bold">Tuần</span>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="image" class="form-label fw-bold text-dark">Ảnh đại diện khóa học</label>
                            <div class="card bg-light border-dashed p-3 text-center">
                                <input type="file" name="image" id="image" class="form-control mb-2" accept="image/*">
                                <small class="text-muted">Hỗ trợ định dạng: .jpg, .png, .jpeg (Tỉ lệ khuyến nghị 16:9)</small>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 pt-3 border-top">
                            <a href="index.php?controller=instructor&action=dashboard" class="btn btn-light border rounded-pill px-4 fw-bold">
                                Hủy bỏ
                            </a>
                            <button type="submit" class="btn btn-success rounded-pill px-5 fw-bold shadow-sm">
                                <i class="fas fa-save me-2"></i>Lưu khóa học
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* CSS bổ sung để làm đẹp các input */
    .form-control:focus, .form-select:focus {
        border-color: #198754; /* Màu xanh success */
        box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.25);
    }
    .border-dashed {
        border: 2px dashed #dee2e6;
    }
    .bg-gradient {
        background: linear-gradient(45deg, #198754, #20c997); /* Hiệu ứng màu xanh đẹp mắt */
    }
</style>

<?php include __DIR__ . '/../layouts/footer.php'; ?>