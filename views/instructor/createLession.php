<?php 
// Xác định trạng thái hiển thị
$isLessonList = (isset($view_state) && $view_state == 'lesson_list');
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold text-dark mb-1">
            <i class="fas fa-layer-group me-2 text-primary"></i>Quản lý Bài giảng (Lessons)
        </h4>
        <p class="text-muted small mb-0">
            <?= $isLessonList ? 'Đang soạn bài cho khóa: <b class="text-primary">'.htmlspecialchars($course['title']).'</b>' : 'Chọn khóa học để thêm hoặc chỉnh sửa bài giảng' ?>
        </p>
    </div>

    <?php if ($isLessonList): ?>
        <div>
            <a href="index.php?controller=instructor&action=createLession" class="btn btn-outline-secondary rounded-pill me-2">
                <i class="fas fa-arrow-left me-1"></i> Chọn khóa khác
            </a>
            <button type="button" class="btn btn-primary rounded-pill shadow-sm px-4" data-bs-toggle="modal" data-bs-target="#createLessonModal">
                <i class="fas fa-plus me-2"></i> Tạo bài học
            </button>
        </div>
    <?php endif; ?>
</div>

<?php if (!$isLessonList): ?>
    
    <div class="row g-4">
        <?php if (!empty($courses)): ?>
            <?php foreach ($courses as $c): ?>
            <div class="col-md-6 col-lg-4">
                <a href="index.php?controller=instructor&action=createLession&course_id=<?= $c['id'] ?>" class="text-decoration-none">
                    <div class="card card-custom h-100 border-0 bg-white">
                        <div class="card-body p-4 d-flex align-items-center">
                            <?php 
                                $img = !empty($c['image']) ? (strpos($c['image'], 'http')===0 ? $c['image'] : "uploads/".$c['image']) : "https://via.placeholder.com/80"; 
                            ?>
                            <img src="<?= $img ?>" class="rounded me-3 border shadow-sm" width="80" height="60" style="object-fit: cover;">
                            
                            <div class="overflow-hidden">
                                <h6 class="fw-bold text-dark mb-1 text-truncate"><?= htmlspecialchars($c['title']) ?></h6>
                                <div class="d-flex align-items-center small">
                                    <span class="badge bg-primary bg-opacity-10 text-primary me-2">ID: <?= $c['id'] ?></span>
                                    <span class="text-muted"><i class="fas fa-book me-1"></i> Bài học</span>
                                </div>
                            </div>
                            
                            <div class="ms-auto text-muted opacity-50">
                                <i class="fas fa-chevron-right"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center py-5">
                <img src="https://cdn-icons-png.flaticon.com/512/7486/7486754.png" width="80" class="opacity-25 mb-3">
                <p class="text-muted fw-bold">Bạn chưa có khóa học nào.</p>
                <a href="index.php?controller=course&action=create" class="btn btn-sm btn-primary">Tạo khóa học ngay</a>
            </div>
        <?php endif; ?>
    </div>

<?php else: ?>

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-secondary">
                        <tr>
                            <th class="ps-4 py-3">Thứ tự</th>
                            <th class="py-3">Tiêu đề bài học</th>
                            <th class="py-3">Loại nội dung</th>
                            <th class="py-3 text-end pe-4">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($lessons)): ?>
                            <?php foreach ($lessons as $index => $lesson): ?>
                            <tr>
                                <td class="ps-4">
                                    <span class="badge bg-secondary bg-opacity-10 text-secondary rounded-pill px-3">
                                        Bài <?= $lesson['order_'] ?? ($index + 1) ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="fw-bold text-dark"><?= htmlspecialchars($lesson['title']) ?></span>
                                </td>
                                <td>
                                    <?php if (!empty($lesson['video_url'])): ?>
                                        <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-10">
                                            <i class="fab fa-youtube me-1"></i> Video
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-10">
                                            <i class="fas fa-align-left me-1"></i> Tài liệu
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-end pe-4">
                                    <button class="btn btn-sm btn-outline-primary rounded-circle me-1" title="Sửa">
                                        <i class="fas fa-pen"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger rounded-circle" title="Xóa">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center py-5">
                                    <div class="text-muted opacity-75">
                                        <i class="fas fa-folder-open fa-3x mb-3"></i>
                                        <p>Chưa có bài học nào trong khóa này.</p>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="createLessonModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title fw-bold"><i class="fas fa-plus-circle me-2"></i>Thêm bài học mới</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <form action="index.php?controller=instructor&action=createLession" method="POST">
                    <div class="modal-body p-4">
                        <input type="hidden" name="action" value="store_lesson">
                        <input type="hidden" name="course_id" value="<?= $course['id'] ?>">

                        <div class="row mb-3">
                            <div class="col-md-8">
                                <label class="form-label fw-bold">Tiêu đề bài học <span class="text-danger">*</span></label>
                                <input type="text" name="title" class="form-control" required placeholder="Ví dụ: Bài 1 - Giới thiệu tổng quan">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Thứ tự hiển thị</label>
                                <input type="number" name="order" class="form-control" value="<?= count($lessons) + 1 ?>">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Link Video (YouTube/Embed)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="fab fa-youtube text-danger"></i></span>
                                <input type="text" name="video_url" class="form-control" placeholder="https://www.youtube.com/watch?v=...">
                            </div>
                            <div class="form-text small">Để trống nếu đây là bài đọc (Text only).</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Nội dung / Mô tả</label>
                            <textarea name="content" class="form-control" rows="5" placeholder="Nhập nội dung bài học hoặc mô tả video..."></textarea>
                        </div>
                    </div>
                    
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold">Lưu bài học</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php endif; ?>