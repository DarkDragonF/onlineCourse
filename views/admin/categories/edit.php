<div class="card shadow-sm">
    <div class="card-header bg-warning text-dark">
        <h4 class="mb-0"><i class="fas fa-edit me-2"></i>Chỉnh sửa Danh mục</h4>
    </div>
    <div class="card-body">
        <form action="" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label fw-bold">Tên Danh mục <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="name" name="name" 
                       value="<?= htmlspecialchars($category['name']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label fw-bold">Mô tả</label>
                <textarea class="form-control" id="description" name="description" rows="4"><?= htmlspecialchars($category['description']) ?></textarea>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Cập nhật
                </button>
                <a href="index.php?controller=admin&action=listCategories" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Hủy bỏ
                </a>
            </div>
        </form>
    </div>
</div>