<?php 
// views/enrollment/checkout.php
// Gọi Header (Lưu ý đường dẫn phải chuẩn tính từ file index.php)
if (file_exists('./views/layouts/header.php')) {
    include_once './views/layouts/header.php';
} else {
    // Fallback nếu cấu trúc thư mục khác
    echo "<h1>Lỗi: Không tìm thấy Header</h1>";
}
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3 border-bottom">
                    <h4 class="mb-0 fw-bold text-primary">
                        <i class="fas fa-shopping-cart me-2"></i>Xác nhận đăng ký khóa học
                    </h4>
                </div>

                <div class="card-body p-4">
                    
                    <div class="d-flex align-items-center mb-4 pb-4 border-bottom">
                        <img src="<?= htmlspecialchars($course['image'] ?? 'assets/img/default.jpg') ?>" 
                             class="rounded me-3 shadow-sm" 
                             style="width: 120px; height: 80px; object-fit: cover;">
                        
                        <div>
                            <h5 class="fw-bold mb-1"><?= htmlspecialchars($course['title']) ?></h5>
                            <p class="text-muted mb-0 small">
                                <i class="fas fa-chalkboard-teacher me-1"></i> 
                                Giảng viên: <strong><?= htmlspecialchars($course['instructor_name']) ?></strong>
                            </p>
                        </div>

                        <div class="ms-auto text-end">
                            <small class="text-muted d-block">Thành tiền:</small>
                            <h4 class="text-danger fw-bold mb-0">
                                <?= number_format($course['price'], 0, ',', '.') ?>đ
                            </h4>
                        </div>
                    </div>

                    <form action="index.php?controller=enrollment&action=process" method="POST">
                        
                        <input type="hidden" name="course_id" value="<?= $course['id'] ?>">
                        <input type="hidden" name="price" value="<?= $course['price'] ?>">

                        <div class="mb-4">
                            <label class="form-label fw-bold mb-2">Chọn phương thức thanh toán:</label>
                            <div class="border rounded p-3 bg-light">
                                
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="payment_method" id="momo" value="momo" checked>
                                    <label class="form-check-label d-flex align-items-center cursor-pointer" for="momo">
                                        <i class="fas fa-wallet text-danger me-2 fs-5"></i>
                                        <span>Ví điện tử Momo (Demo)</span>
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_method" id="bank" value="bank">
                                    <label class="form-check-label d-flex align-items-center cursor-pointer" for="bank">
                                        <i class="fas fa-university text-primary me-2 fs-5"></i>
                                        <span>Chuyển khoản Ngân hàng (Demo)</span>
                                    </label>
                                </div>

                            </div>
                        </div>

                       

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-warning btn-lg fw-bold text-dark shadow-sm">
                                <i class="fas fa-lock me-2"></i> THANH TOÁN & VÀO HỌC NGAY
                            </button>
                            <a href="index.php?controller=course&action=detail&id=<?= $course['id'] ?>" class="btn btn-link text-muted mt-2">
                                <i class="fas fa-arrow-left me-1"></i> Quay lại chi tiết khóa học
                            </a>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<?php 
// Gọi Footer
if (file_exists('./views/layouts/footer.php')) {
    include_once './views/layouts/footer.php';
} 
?>