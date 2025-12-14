<?php 
require_once './views/layouts/header.php'; 
?>
<!-- version 1.1.3 -->
<style>
    
</style>
<link rel="stylesheet" href="./assets/css/homePage.css">
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="hero-title">Nâng cao kỹ năng,<br>Mở rộng tương lai</h1>
                <p class="lead mb-4">Truy cập hơn 1000+ khóa học từ các chuyên gia hàng đầu.</p>
                <a href="#courses-list" class="btn btn-warning-custom">Xem khóa học ngay</a>
            </div>
            <div class="col-md-6 text-center">
                <img src="https://cdn3d.iconscout.com/3d/premium/thumb/online-education-4643033-3850550.png" alt="Hero Image" class="img-fluid" style="max-height: 400px;">
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-white border-bottom">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-3 col-6 mb-3">
                <div class="display-6 fw-bold text-primary">10k+</div>
                <div class="text-muted">Học viên</div>
            </div>
            <div class="col-md-3 col-6 mb-3">
                <div class="display-6 fw-bold text-primary">500+</div>
                <div class="text-muted">Khóa học</div>
            </div>
            <div class="col-md-3 col-6 mb-3">
                <div class="display-6 fw-bold text-primary">200+</div>
                <div class="text-muted">Giảng viên</div>
            </div>
            <div class="col-md-3 col-6 mb-3">
                <div class="display-6 fw-bold text-primary">4.9</div>
                <div class="text-muted">Đánh giá</div>
            </div>
        </div>
    </div>
</section>

<section id="courses-list" class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">Khóa học mới nhất</h2>
        <a href="index.php?controller=course&action=list" class="btn btn-outline-primary rounded-pill">Xem tất cả</a>
    </div>

    <div class="row">
        <?php if (!empty($newCourses)): ?>
            <?php foreach ($newCourses as $course): ?>
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="card course-card shadow-sm">
                        <?php 
                            $img = !empty($course['image']) ? $course['image'] : 'https://via.placeholder.com/300x200';
                            $imgSrc = (strpos($img, 'http') === 0) ? $img : "assets/$img"; 
                        ?>
                        
                        <img src="<?= $imgSrc ?>" class="card-img-top" alt="Course Image">
                        
                        <div class="card-body d-flex flex-column">
                            <span class="badge-category align-self-start">Khóa học</span>
                            <h5 class="card-title text-truncate" title="<?= htmlspecialchars($course['title']) ?>">
                                <?= htmlspecialchars($course['title']) ?>
                            </h5>
                            
                            <div class="d-flex align-items-center mb-2 mt-auto">
                                <i class="bi bi-person-circle text-muted me-2"></i>
                                <small class="text-muted"><?= htmlspecialchars($course['instructor_name']) ?></small>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-3 border-top pt-3">
                                <div class="price-tag text-primary"><?= number_format($course['price']) ?>đ</div>
                            </div>
                            
                            <a href="index.php?controller=course&action=detail&id=<?= $course['id'] ?>" class="btn btn-light text-primary fw-bold w-100 mt-2 border">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center py-5">
                <p class="text-muted">Chưa có khóa học nào được cập nhật.</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php 
// 2. GỌI FOOTER (Chứa chân trang, đóng Body, Scripts JS)
require_once './views/layouts/footer.php'; 
?>