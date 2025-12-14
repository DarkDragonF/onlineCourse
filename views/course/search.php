<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="container py-5">
    <div class="row justify-content-center mb-5">
        <div class="col-md-8">
            <form action="index.php" method="GET" class="d-flex shadow-sm rounded-pill overflow-hidden border">
                <input type="hidden" name="controller" value="course">
                <input type="hidden" name="action" value="search">
                
                <input type="text" name="keyword" class="form-control border-0 px-4 py-3" 
                       placeholder="Bạn muốn học gì hôm nay?" 
                       value="<?= isset($keyword) ? htmlspecialchars($keyword) : '' ?>">
                
                <button type="submit" class="btn btn-primary px-4 fw-bold">
                    <i class="fas fa-search me-2"></i>Tìm kiếm
                </button>
            </form>
        </div>
    </div>

    <h4 class="mb-4 fw-bold border-start border-4 border-primary ps-3">
        Kết quả tìm kiếm <?= !empty($keyword) ? "cho: \"".htmlspecialchars($keyword)."\"" : "" ?>
    </h4>

    <?php if (!empty($message) && empty($courses)): ?>
        <div class="alert alert-warning text-center py-5">
            <img src="https://cdn-icons-png.flaticon.com/512/6134/6134065.png" width="80" class="mb-3 opacity-50">
            <h5><?= $message ?></h5>
            <p>Hãy thử tìm với từ khóa khác chung chung hơn.</p>
        </div>
    <?php endif; ?>

    <div class="row g-4">
        <?php foreach ($courses as $course): ?>
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 shadow-sm border-0 hover-effect">
                    <?php 
                        $img = !empty($course['image']) ? (strpos($course['image'], 'http')===0 ? $course['image'] : "assets/".$course['image']) : "https://via.placeholder.com/300x200"; 
                    ?>
                    <a href="index.php?controller=course&action=detail&id=<?= $course['id'] ?>">
                        <img src="<?= $img ?>" class="card-img-top" alt="<?= htmlspecialchars($course['title']) ?>" style="height: 180px; object-fit: cover;">
                    </a>
                    
                    <div class="card-body d-flex flex-column">
                        <div class="mb-2">
                            <span class="badge bg-primary bg-opacity-10 text-primary"><?= $course['level'] ?></span>
                        </div>

                        <h6 class="card-title fw-bold">
                            <a href="index.php?controller=course&action=detail&id=<?= $course['id'] ?>" class="text-decoration-none text-dark">
                                <?= htmlspecialchars($course['title']) ?>
                            </a>
                        </h6>
                        
                        <p class="card-text small text-muted text-truncate">
                            <i class="fas fa-chalkboard-teacher me-1"></i> <?= htmlspecialchars($course['instructor_name']) ?>
                        </p>
                        
                        <div class="mt-auto d-flex justify-content-between align-items-center">
                            <span class="fw-bold text-danger">
                                <?= ($course['price'] == 0) ? "Miễn phí" : number_format($course['price']) . "đ" ?>
                            </span>
                            <a href="index.php?controller=course&action=detail&id=<?= $course['id'] ?>" class="btn btn-sm btn-outline-primary rounded-pill">Chi tiết</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<style>
    .hover-effect { transition: transform 0.3s; }
    .hover-effect:hover { transform: translateY(-5px); }
</style>

<?php include __DIR__ . '/../layouts/footer.php'; ?>