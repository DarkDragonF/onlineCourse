<?php 
require_once './views/layouts/header.php'; 
?>
<!-- //version 1.2.0 -->
<link rel="stylesheet" href="./assets/css/homePage.css">

<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="hero-title">Nâng cao kỹ năng,<br>Mở rộng tương lai</h1>
                <p class="lead mb-4">Truy cập hơn 1000+ khóa học từ các chuyên gia hàng đầu giúp bạn làm chủ công nghệ.</p>
                <a href="#courses-list" class="btn btn-warning-custom">
                    <i class="fas fa-rocket me-2"></i>Xem khóa học ngay
                </a>
            </div>
            <div class="col-md-6 text-center">
                <img src="https://cdn-icons-png.flaticon.com/512/5064/5064943.png"
                     alt="Online Learning Hero" 
                     class="img-fluid" 
                     style="max-height: 450px; filter: drop-shadow(0 10px 15px rgba(0,0,0,0.1));">>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-white border-bottom stats-section reveal">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-3 col-6 mb-3 stat-item">
                <div class="display-6 fw-bold text-primary counter-value" data-target="10000">0</div>
                <div class="text-muted fw-bold">Học viên</div>
            </div>
            <div class="col-md-3 col-6 mb-3 stat-item">
                <div class="display-6 fw-bold text-primary counter-value" data-target="500">0</div>
                <div class="text-muted fw-bold">Khóa học</div>
            </div>
            <div class="col-md-3 col-6 mb-3 stat-item">
                <div class="display-6 fw-bold text-primary counter-value" data-target="200">0</div>
                <div class="text-muted fw-bold">Giảng viên</div>
            </div>
            <div class="col-md-3 col-6 mb-3 stat-item">
                <div class="display-6 fw-bold text-primary">4.9 <i class="fas fa-star text-warning fs-5"></i></div>
                <div class="text-muted fw-bold">Đánh giá</div>
            </div>
        </div>
    </div>
</section>

<section id="courses-list" class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4 reveal">
        <h2 class="fw-bold text-primary border-start border-4 border-primary ps-3">Khóa học mới nhất</h2>
        <a href="index.php?controller=course&action=list" class="btn btn-outline-primary rounded-pill px-4">Xem tất cả <i class="fas fa-arrow-right ms-1"></i></a>
    </div>

    <div class="row">
        <?php if (!empty($newCourses)): ?>
            <?php foreach ($newCourses as $course): ?>
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4 reveal">
                    <div class="card course-card shadow-sm h-100">
                        <?php 
                            $img = !empty($course['image']) ? $course['image'] : 'https://via.placeholder.com/300x200';
                            $imgSrc = (strpos($img, 'http') === 0) ? $img : "assets/$img"; 
                        ?>
                        
                        <div style="overflow: hidden; border-radius: 15px 15px 0 0;">
                            <a href="index.php?controller=course&action=detail&id=<?= $course['id'] ?>">
                                <img src="<?= $imgSrc ?>" class="card-img-top" alt="Course Image">
                            </a>
                        </div>
                        
                        <div class="card-body d-flex flex-column">
                            <span class="badge-category align-self-start">
                                <?= !empty($course['category_name']) ? htmlspecialchars($course['category_name']) : 'Lập trình' ?>
                            </span>
                            
                            <h5 class="card-title text-truncate" title="<?= htmlspecialchars($course['title']) ?>">
                                <a href="index.php?controller=course&action=detail&id=<?= $course['id'] ?>" class="text-decoration-none text-dark">
                                    <?= htmlspecialchars($course['title']) ?>
                                </a>
                            </h5>
                            
                            <div class="d-flex align-items-center mb-2 mt-auto">
                                <img src="https://ui-avatars.com/api/?name=<?= urlencode($course['instructor_name']) ?>&background=random" class="rounded-circle me-2" width="25">
                                <small class="text-muted"><?= htmlspecialchars($course['instructor_name']) ?></small>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-3 border-top pt-3">
                                <div class="price-tag text-primary">
                                    <?= ($course['price'] == 0) ? "Miễn phí" : number_format($course['price']) . "đ" ?>
                                </div>
                                <span class="small text-muted"><i class="fas fa-clock me-1"></i><?= $course['duration_weeks'] ?? 4 ?> tuần</span>
                            </div>
                            
                            <a href="index.php?controller=course&action=detail&id=<?= $course['id'] ?>" class="btn btn-light text-primary fw-bold w-100 mt-3 border hover-primary">
                                Xem chi tiết
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center py-5">
                <img src="https://cdn-icons-png.flaticon.com/512/4076/4076432.png" width="80" class="opacity-50 mb-3">
                <p class="text-muted">Chưa có khóa học nào được cập nhật.</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<script src="./assets/js/homePage.js"></script>

<?php 
require_once './views/layouts/footer.php'; 
?>