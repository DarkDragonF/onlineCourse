<?php require_once './views/layouts/header.php'; ?>
<!-- version 1.1.3 -->
<style>
    body { background-color: #f5f7fa; }
    .dashboard-sidebar { background: white; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.04); overflow: hidden; }
    .user-card-header { background: linear-gradient(135deg, var(--primary-color), #283593); padding: 30px 20px; text-align: center; color: white; }
    .user-avatar-lg { width: 100px; height: 100px; border-radius: 50%; border: 4px solid rgba(255,255,255,0.2); object-fit: cover; margin-bottom: 10px; }
    .menu-link { padding: 12px 20px; display: flex; align-items: center; color: #555; text-decoration: none; transition: 0.2s; border-left: 3px solid transparent; font-weight: 500; }
    .menu-link:hover, .menu-link.active { background-color: #eef2ff; color: var(--primary-color); border-left-color: var(--primary-color); }
    .stat-box { background: white; border-radius: 12px; padding: 20px; display: flex; align-items: center; box-shadow: 0 2px 6px rgba(0,0,0,0.02); height: 100%; }
    .stat-icon-wrapper { width: 50px; height: 50px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin-right: 15px; }
    .course-progress-card { background: white; border-radius: 12px; padding: 20px; margin-bottom: 20px; border: 1px solid #eee; transition: transform 0.2s, box-shadow 0.2s; }
    .course-progress-card:hover { transform: translateY(-3px); box-shadow: 0 5px 15px rgba(0,0,0,0.08); }
    .course-thumb-small { width: 140px; height: 90px; object-fit: cover; border-radius: 8px; }
    .progress-height { height: 8px; border-radius: 4px; }
</style>

<div class="container py-5">
    <div class="row">
        
        <div class="col-lg-3 mb-4">
            <div class="dashboard-sidebar">
                <div class="user-card-header">
                    <img src="<?= $_SESSION['user_avatar'] ?? 'https://via.placeholder.com/150' ?>" class="user-avatar-lg" alt="Avatar">
                    <h5 class="fw-bold mb-0"><?= htmlspecialchars($_SESSION['user_fullname'] ?? 'Học viên') ?></h5>
                    <small class="opacity-75">Học viên EduPro</small>
                </div>
                <div class="py-2">
                    <a href="index.php?controller=home&action=dashboard" class="menu-link active">
                        <i class="bi bi-grid-fill me-2"></i> Tổng quan
                    </a>
                    <a href="#" class="menu-link">
                        <i class="bi bi-journal-album me-2"></i> Khóa học của tôi
                    </a>
                    <a href="#" class="menu-link">
                        <i class="bi bi-gear me-2"></i> Cài đặt tài khoản
                    </a>
                </div>
            </div>
        </div>

        <div class="col-lg-9">
            
            <div class="row mb-4">
                <div class="col-md-4 mb-2">
                    <div class="stat-box">
                        <div class="stat-icon-wrapper bg-primary bg-opacity-10 text-primary"><i class="bi bi-book"></i></div>
                        <div><h3 class="fw-bold mb-0"><?= $stats['enrolled'] ?></h3><div class="text-muted small">Đang học</div></div>
                    </div>
                </div>
                <div class="col-md-4 mb-2">
                    <div class="stat-box">
                        <div class="stat-icon-wrapper bg-success bg-opacity-10 text-success"><i class="bi bi-check-circle"></i></div>
                        <div><h3 class="fw-bold mb-0"><?= $stats['completed'] ?></h3><div class="text-muted small">Hoàn thành</div></div>
                    </div>
                </div>
                <div class="col-md-4 mb-2">
                    <div class="stat-box">
                        <div class="stat-icon-wrapper bg-warning bg-opacity-10 text-warning"><i class="bi bi-trophy"></i></div>
                        <div><h3 class="fw-bold mb-0"><?= $stats['certificates'] ?></h3><div class="text-muted small">Chứng chỉ</div></div>
                    </div>
                </div>
            </div>

            <h4 class="fw-bold text-dark mb-3">Khóa học của tôi</h4>

            <?php if (!empty($myCourses)): ?>
                <?php foreach ($myCourses as $course): ?>
                    <div class="course-progress-card">
                        <div class="row align-items-center">
                            <div class="col-md-3 mb-3 mb-md-0">
                                <?php 
                                    $img = !empty($course['image']) ? $course['image'] : 'https://via.placeholder.com/300x200';
                                    $imgSrc = (strpos($img, 'http') === 0) ? $img : "uploads/$img"; 
                                ?>
                                <img src="<?= $imgSrc ?>" class="course-thumb-small w-100" alt="Course Img">
                            </div>
                            
                            <div class="col-md-6 mb-3 mb-md-0">
                                <h5 class="fw-bold mb-1">
                                    <a href="index.php?controller=course&action=detail&id=<?= $course['course_id'] ?>" class="text-decoration-none text-dark">
                                        <?= htmlspecialchars($course['title']) ?>
                                    </a>
                                </h5>
                                <p class="text-muted small mb-2">
                                    Giảng viên: <strong><?= htmlspecialchars($course['instructor_name'] ?? 'EduPro') ?></strong>
                                </p>
                                
                                <div class="d-flex align-items-center mt-2">
                                    <div class="progress flex-grow-1 me-3 progress-height bg-light border">
                                        <div class="progress-bar bg-success" role="progressbar" 
                                             style="width: <?= $course['progress'] ?>%" 
                                             aria-valuenow="<?= $course['progress'] ?>" aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                    <span class="fw-bold text-success small"><?= $course['progress'] ?>%</span>
                                </div>
                            </div>

                            <div class="col-md-3 text-md-end">
                                <?php if ($course['progress'] == 0): ?>
                                    <a href="index.php?controller=learning&action=index&course_id=<?= $course['course_id'] ?>" class="btn btn-outline-primary rounded-pill w-100">Bắt đầu</a>
                                <?php elseif ($course['progress'] == 100): ?>
                                    <a href="#" class="btn btn-outline-success rounded-pill w-100"><i class="bi bi-award"></i> Chứng chỉ</a>
                                <?php else: ?>
                                    <a href="index.php?controller=learning&action=index&course_id=<?= $course['course_id'] ?>" class="btn btn-primary rounded-pill w-100">Tiếp tục</a>
                                    <div class="text-muted small mt-2">
                                        <i class="bi bi-calendar3"></i> <?= date('d/m/Y', strtotime($course['enrolled_date'])) ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="text-center py-5 bg-white rounded-3 shadow-sm border">
                    <img src="https://cdn-icons-png.flaticon.com/512/2763/2763444.png" width="80" class="mb-3 opacity-50" alt="Empty">
                    <h5 class="text-muted">Bạn chưa đăng ký khóa học nào.</h5>
                    <a href="index.php?controller=course&action=list" class="btn btn-primary px-4 rounded-pill mt-2">Khám phá ngay</a>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>

<?php require_once './views/layouts/footer.php'; ?>