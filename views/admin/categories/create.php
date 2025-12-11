<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Thêm Danh mục Mới</h4>
    </div>
    <div class="card-body">
        <form action="" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label fw-bold">Tên Danh mục <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Ví dụ: Lập trình Python" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label fw-bold">Mô tả</label>
                <textarea class="form-control" id="description" name="description" rows="4" placeholder="Mô tả ngắn về danh mục này..."></textarea>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save me-1"></i> Lưu lại
                </button>
                <a href="index.php?controller=admin&action=listCategories" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Quay lại
                </a>
            </div>
        </form>
    </div>
</div>