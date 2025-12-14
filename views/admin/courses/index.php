<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold text-secondary">Quản lý Khóa học</h2>
    <a href="index.php?controller=course&action=create" class="btn btn-primary">
        <i class="fas fa-plus"></i> Thêm khóa học
    </a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-bordered table-hover mb-0 align-middle">
                <thead class="table-light text-secondary">
                    <tr>
                        <th width="5%" class="text-center">ID</th>
                        <th width="10%" class="text-center">Hình ảnh</th>
                        <th width="30%">Tên Khóa học</th>
                        <th width="15%">Giảng viên</th>
                        <th width="15%">Danh mục</th>
                        <th width="10%">Học phí</th>
                        <th width="15%" class="text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($courses)): ?>
                        <?php foreach ($courses as $c): ?>
                            <tr>
                                <td class="text-center text-muted">#<?= $c['id'] ?></td>
                                
                                <td class="text-center">
                                    <?php 
                                        $img = !empty($c['image']) ? $c['image'] : 'https://via.placeholder.com/150';
                                        // Kiểm tra nếu link ảnh là http (ảnh mạng) hay ảnh upload
                                        $imgSrc = (strpos($img, 'http') === 0) ? $img : "uploads/$img"; 
                                    ?>
                                    <img src="<?= $imgSrc ?>" alt="Thumb" class="rounded border" style="width: 60px; height: 40px; object-fit: cover;">
                                </td>

                                <td>
                                    <span class="fw-bold text-dark"><?= htmlspecialchars($c['title']) ?></span>
                                    <br>
                                    <small class="text-muted" style="font-size: 0.8rem;">
                                        <?= htmlspecialchars(substr(strip_tags($c['description']), 0, 50)) ?>...
                                    </small>
                                </td>

                                <td>
                                    <i class="fas fa-user-tie text-secondary me-1"></i>
                                    <?= htmlspecialchars($c['instructor_name'] ?? 'Admin') ?>
                                </td>

                                <td>
                                    <span class="badge bg-light text-dark border">
                                        <?= htmlspecialchars($c['category_name'] ?? 'Chưa phân loại') ?>
                                    </span>
                                </td>

                                <td class="fw-bold text-success">
                                    <?= number_format($c['price']) ?>đ
                                </td>

                                <td class="text-center">
                                    <a href="index.php?controller=course&action=detail&id=<?= $c['id'] ?>" class="btn btn-sm btn-outline-secondary" title="Xem">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <a href="index.php?controller=course&action=edit&id=<?= $c['id'] ?>" class="btn btn-sm btn-info text-white" title="Sửa">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <a href="index.php?controller=admin&action=deleteCourse&id=<?= $c['id'] ?>" 
                                       class="btn btn-sm btn-danger" 
                                       onclick="return confirm('Bạn có chắc chắn muốn xóa khóa học này không? Hành động này không thể hoàn tác!')"
                                       title="Xóa">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="fas fa-folder-open fa-3x mb-3 opacity-50"></i>
                                <p>Chưa có khóa học nào trong hệ thống.</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-white py-3">
        <div class="small text-muted">Hiển thị toàn bộ <?= count($courses) ?> khóa học</div>
    </div>
</div>