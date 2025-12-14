<?php require_once './views/layouts/header.php'; ?>

<div class="bg-primary text-white py-5 mb-5">
    <div class="container text-center">
        <h1 class="fw-bold">Khám phá các khóa học</h1>
        <p class="lead mb-0">Hơn 500+ khóa học chất lượng đang chờ đón bạn</p>
    </div>
</div>

<div class="container mb-5">
    <div class="row mb-4 align-items-center">
        <div class="col-md-6">
            <h4 class="fw-bold text-secondary">Tất cả khóa học</h4>
        </div>
        <div class="col-md-6">
            <form action="index.php" method="GET" class="d-flex">
                <input type="hidden" name="controller" value="course">
                <input type="hidden" name="action" value="search">
                <input type="text" name="keyword" class="form-control me-2 rounded-pill" placeholder="Tìm tên khóa học...">
                <button type="submit" class="btn btn-outline-primary rounded-pill">Tìm</button>
            </form>
        </div>
    </div>

    <div class="row">
        <?php if (!empty($courses)): ?>
            <?php foreach ($courses as $course): ?>
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="card h-100 shadow-sm border-0" style="border-radius: 15px; overflow: hidden; transition: transform 0.3s;">
                        <?php 
                            $img = !empty($course['image']) ? $course['image'] : 'https://via.placeholder.com/300x200';
                            $imgSrc = (strpos($img, 'http') === 0) ? $img : "assets/$img"; 
                        ?>
                        <div style="height: 180px; overflow: hidden;">
                            <img src="<?= $imgSrc ?>" class="w-100 h-100" style="object-fit: cover;" alt="Course Image">
                        </div>
                        
                        <div class="card-body d-flex flex-column">
                            <div class="mb-2">
                                <span class="badge bg-light text-primary border border-primary-subtle rounded-pill">
                                    <?= htmlspecialchars($course['category_name'] ?? 'Khóa học') ?>
                                </span>
                            </div>

                            <h5 class="card-title text-truncate fw-bold" title="<?= htmlspecialchars($course['title']) ?>">
                                <a href="index.php?controller=course&action=detail&id=<?= $course['id'] ?>" class="text-decoration-none text-dark">
                                    <?= htmlspecialchars($course['title']) ?>
                                </a>
                            </h5>
                            
                            <div class="d-flex align-items-center mb-3">
                                <i class="bi bi-person-circle text-muted me-2"></i>
                                <small class="text-muted"><?= htmlspecialchars($course['instructor_name'] ?? 'Giảng viên') ?></small>
                            </div>

                            <div class="mt-auto pt-3 border-top d-flex justify-content-between align-items-center">
                                <span class="fw-bold text-primary fs-5"><?= number_format($course['price']) ?>đ</span>
                                <a href="index.php?controller=course&action=detail&id=<?= $course['id'] ?>" class="btn btn-sm btn-outline-primary rounded-pill">Xem chi tiết</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center py-5">
                <img src="https://cdn-icons-png.flaticon.com/512/4076/4076432.png" width="80" class="mb-3 opacity-50" alt="Empty">
                <h5 class="text-muted">Chưa có khóa học nào được tìm thấy.</h5>
            </div>
        <?php endif; ?>
    </div>
    
    <div class="d-flex justify-content-center mt-4">
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <li class="page-item disabled"><a class="page-link" href="#">Trước</a></li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">Sau</a></li>
            </ul>
        </nav>
    </div>
</div>

<?php require_once './views/layouts/footer.php'; ?>