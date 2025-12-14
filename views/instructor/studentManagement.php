<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold text-dark">Danh sách Học viên & Tiến độ</h4>
    <button class="btn btn-outline-secondary btn-sm"><i class="fas fa-download me-1"></i> Xuất báo cáo</button>
</div>

<div class="card card-custom border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-secondary">
                    <tr>
                        <th class="ps-4 py-3">Thông tin Học viên</th>
                        <th class="py-3">Khóa học đang học</th>
                        <th class="py-3">Ngày tham gia</th>
                        <th class="py-3 text-center">Tiến độ học tập</th>
                        <th class="py-3 text-end pe-4">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($students)): ?>
                        <?php foreach($students as $s): ?>
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    <?php 
                                        $avatar = !empty($s['student_avatar']) ? "uploads/".$s['student_avatar'] : "https://via.placeholder.com/40"; 
                                    ?>
                                    <img src="<?= $avatar ?>" class="rounded-circle me-3 shadow-sm" width="40" height="40" style="object-fit: cover;">
                                    <div>
                                        <div class="fw-bold text-dark"><?= htmlspecialchars($s['student_name']) ?></div>
                                        <div class="small text-muted"><?= htmlspecialchars($s['student_email']) ?></div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border">
                                    <?= htmlspecialchars($s['course_title']) ?>
                                </span>
                            </td>
                            <td><?= date('d/m/Y', strtotime($s['enrolled_date'])) ?></td>
                            <td style="width: 25%;">
                                <div class="d-flex align-items-center justify-content-center">
                                    <div class="progress flex-grow-1 shadow-sm" style="height: 8px; border-radius: 10px;">
                                        <?php 
                                            $color = $s['progress'] == 100 ? 'success' : ($s['progress'] > 50 ? 'primary' : 'warning');
                                        ?>
                                        <div class="progress-bar bg-<?= $color ?>" role="progressbar" style="width: <?= $s['progress'] ?>%"></div>
                                    </div>
                                    <span class="ms-2 fw-bold text-<?= $color ?>"><?= $s['progress'] ?>%</span>
                                </div>
                            </td>
                            <td class="text-end pe-4">
                                <a href="#" class="btn btn-sm btn-outline-primary" title="Gửi email nhắc nhở">
                                    <i class="fas fa-envelope"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="5" class="text-center py-5">Chưa có dữ liệu học viên.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>