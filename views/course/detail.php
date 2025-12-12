<?php include_once './views/layouts/header.php'; ?>

<div class="bg-dark text-white py-5" style="background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('assets/img/banner-bg.jpg'); background-size: cover; background-position: center;">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php" class="text-warning text-decoration-none">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="index.php?controller=course&action=list" class="text-warning text-decoration-none">Khóa học</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page"><?= htmlspecialchars($course['title']) ?></li>
                    </ol>
                </nav>
                
                <h1 class="display-5 fw-bold"><?= htmlspecialchars($course['title']) ?></h1>
                <p class="lead"><?= htmlspecialchars(substr($course['description'], 0, 150)) ?>...</p>
                
                <div class="d-flex align-items-center mt-4">
                    <div class="me-4">
                        <i class="fas fa-chalkboard-teacher text-warning me-2"></i>
                        Giảng viên: <strong><?= htmlspecialchars($course['instructor_name']) ?></strong>
                    </div>
                    <div class="me-4">
                        <i class="fas fa-folder text-warning me-2"></i>
                        Danh mục: <strong><?= htmlspecialchars($course['category_name']) ?></strong>
                    </div>
                    <div>
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star-half-alt text-warning"></i>
                        <span class="ms-1">(4.8 sao)</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container py-5">
    <div class="row">
        <div class="col-lg-8">
            
            <div class="card shadow-sm mb-4 border-0">
                <div class="card-body p-4">
                    <h3 class="mb-4">Mô tả khóa học</h3>
                    <div class="course-description text-secondary" style="line-height: 1.8;">
                        <?= nl2br(htmlspecialchars($course['description'])) ?>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm mb-4 border-0">
                <div class="card-body p-4">
                    <h3 class="mb-4">Bạn sẽ học được gì?</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Hiểu rõ tư duy lập trình căn bản</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Xây dựng dự án thực tế</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Làm chủ công cụ & kỹ thuật mới nhất</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Kỹ năng làm việc nhóm & Git</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

             <div class="card shadow-sm mb-4 border-0">
                <div class="card-body p-4">
                    <h3 class="mb-3">Thông tin giảng viên</h3>
                    <div class="d-flex align-items-center">
                        <img src="https://ui-avatars.com/api/?name=<?= urlencode($course['instructor_name']) ?>&background=random" class="rounded-circle me-3" width="80" height="80">
                        <div>
                            <h5 class="fw-bold mb-1"><?= htmlspecialchars($course['instructor_name']) ?></h5>
                            <p class="text-muted mb-0">Senior Developer & Instructor tại EduPro</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-lg-4">
            <div class="card shadow border-0 sticky-top" style="top: 90px; z-index: 10;">
                <div class="position-relative">
                    <?php 
                        $imgSrc = !empty($course['image']) ? $course['image'] : 'assets/img/default-course.jpg';
                    ?>
                    <img src="<?= htmlspecialchars($imgSrc) ?>" class="card-img-top" alt="<?= htmlspecialchars($course['title']) ?>">
                    <div class="position-absolute top-50 start-50 translate-middle">
                        <div class="bg-white rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; cursor: pointer;">
                            <i class="fas fa-play text-primary fs-4 ps-1"></i>
                        </div>
                    </div>
                </div>
                
                <div class="card-body p-4">
                    <h2 class="fw-bold text-danger mb-3 text-center">
                        <?= number_format($course['price'], 0, ',', '.') ?>đ
                    </h2>

                    <div class="d-grid gap-2 mb-3">
                        <a href="index.php?controller=enrollment&action=register&course_id=<?= $course['id'] ?>" class="btn btn-primary btn-lg fw-bold">
                            ĐĂNG KÝ HỌC NGAY
                        </a>
                        <button class="btn btn-outline-secondary">Thêm vào giỏ hàng</button>
                    </div>

                    <ul class="list-group list-group-flush small">
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <span><i class="bi bi-clock me-2"></i>Thời lượng</span>
                            <strong><?= $course['duration_weeks'] ?> tuần</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <span><i class="bi bi-bar-chart me-2"></i>Cấp độ</span>
                            <strong><?= htmlspecialchars($course['level']) ?></strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <span><i class="bi bi-film me-2"></i>Bài giảng</span>
                            <strong>Full HD</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <span><i class="bi bi-infinity me-2"></i>Truy cập</span>
                            <strong>Trọn đời</strong>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once './views/layouts/footer.php'; ?>