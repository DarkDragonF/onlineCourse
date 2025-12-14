<?php require_once './views/layouts/header.php'; ?>

<div class="bg-light py-5 mb-5">
    <div class="container">
        <h1 class="fw-bold">Khóa học của tôi</h1>
        <p class="text-muted mb-0">Quản lý tiến độ và tiếp tục học tập.</p>
    </div>
</div>

<div class="container mb-5" style="min-height: 50vh;">
    <?php if (!empty($myCourses)): ?>
        <div class="row">
            <?php foreach ($myCourses as $course): ?>
                <div class="col-lg-6 mb-4">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="row g-0 align-items-center h-100">
                            <div class="col-md-4">
                                <?php 
                                    $img = !empty($course['image']) ? $course['image'] : 'https://via.placeholder.com/300x200';
                                    $imgSrc = (strpos($img, 'http') === 0) ? $img : "uploads/$img"; 
                                ?>
                                <img src="<?= $imgSrc ?>" class="img-fluid rounded-start h-100" style="object-fit: cover; min-height: 150px;" alt="Course">
                            </div>
                            
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold">
                                        <a href="index.php?controller=course&action=detail&id=<?= $course['course_id'] ?>" class="text-decoration-none text-dark">
                                            <?= htmlspecialchars($course['title']) ?>
                                        </a>
                                    </h5>
                                    
                                    <p class="card-text text-muted small mb-2">
                                        <i class="bi bi-person-circle me-1"></i> GV: <?= htmlspecialchars($course['instructor_name']) ?>
                                    </p>

                                    <div class="d-flex align-items-center mb-3">
                                        <div class="progress flex-grow-1 me-2" style="height: 6px;">
                                            <div class="progress-bar bg-success" role="progressbar" 
                                                 style="width: <?= $course['progress'] ?>%" 
                                                 aria-valuenow="<?= $course['progress'] ?>" aria-valuemin="0" aria-valuemax="100">
                                            </div>
                                        </div>
                                        <span class="small fw-bold text-success"><?= $course['progress'] ?>%</span>
                                    </div>

                                    <?php if ($course['progress'] == 100): ?>
                                        <button class="btn btn-sm btn-outline-success rounded-pill"><i class="bi bi-check-circle"></i> Đã hoàn thành</button>
                                    <?php else: ?>
                                        <a href="index.php?controller=learning&action=index&course_id=<?= $course['course_id'] ?>" class="btn btn-sm btn-primary rounded-pill px-3">
                                            <i class="bi bi-play-fill"></i> Vào học ngay
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="text-center py-5 border rounded bg-white shadow-sm">
            <i class="bi bi-journal-x text-muted" style="font-size: 4rem;"></i>
            <h4 class="mt-3">Bạn chưa đăng ký khóa học nào!</h4>
            <p class="text-muted">Hãy tìm kiếm khóa học phù hợp để bắt đầu hành trình của bạn.</p>
            <a href="index.php?controller=course&action=list" class="btn btn-primary rounded-pill px-4 mt-2">Xem danh sách khóa học</a>
        </div>
    <?php endif; ?>
</div>

<?php require_once './views/layouts/footer.php'; ?>