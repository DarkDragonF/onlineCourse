<div class="row g-4 mb-4">
    <div class="col-md-6 col-lg-4">
        <div class="card card-custom h-100 border-start border-4 border-primary">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted text-uppercase mb-1">Khóa học của tôi</h6>
                        <h2 class="fw-bold mb-0 text-dark"><?= $total_courses ?></h2>
                    </div>
                    <div class="bg-primary bg-opacity-10 p-3 rounded-circle text-primary">
                        <i class="fas fa-book fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-4">
        <div class="card card-custom h-100 border-start border-4 border-success">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted text-uppercase mb-1">Tổng học viên</h6>
                        <h2 class="fw-bold mb-0 text-dark"><?= $total_students ?></h2>
                    </div>
                    <div class="bg-success bg-opacity-10 p-3 rounded-circle text-success">
                        <i class="fas fa-users fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 col-lg-4">
        <div class="card card-custom h-100 bg-gradient-primary text-white" style="background: #4e73df;">
            <div class="card-body d-flex flex-column justify-content-center align-items-center text-center">
                <h5 class="fw-bold">Tạo khóa học mới?</h5>
                <p class="small opacity-75">Bắt đầu chia sẻ kiến thức ngay hôm nay.</p>
                <a href="index.php?controller=course&action=create" class="btn btn-light text-primary rounded-pill fw-bold px-4">
                    <i class="fas fa-plus me-1"></i> Thêm ngay
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card card-custom mb-4">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 fw-bold text-primary"><i class="fas fa-user-clock me-2"></i>Học viên mới đăng ký</h6>
        <a href="index.php?controller=instructor&action=students" class="btn btn-sm btn-outline-primary rounded-pill">Xem tất cả</a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Học viên</th>
                        <th>Khóa học</th>
                        <th>Ngày đăng ký</th>
                        <th>Tiến độ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($recent_students)): ?>
                        <?php foreach($recent_students as $s): ?>
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    <img src="<?= $s['student_avatar'] ?? 'https://via.placeholder.com/30' ?>" class="rounded-circle me-2" width="30" height="30">
                                    <span class="fw-bold text-dark"><?= htmlspecialchars($s['student_name']) ?></span>
                                </div>
                            </td>
                            <td><?= htmlspecialchars($s['course_title']) ?></td>
                            <td><?= date('d/m/Y', strtotime($s['enrolled_date'])) ?></td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="progress flex-grow-1 me-2" style="height: 6px;">
                                        <div class="progress-bar bg-info" style="width: <?= $s['progress'] ?>%"></div>
                                    </div>
                                    <span class="small text-muted fw-bold"><?= $s['progress'] ?>%</span>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="4" class="text-center py-3 text-muted">Chưa có học viên nào.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>