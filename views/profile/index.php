<?php require_once './views/layouts/header.php'; ?>

<div class="bg-light py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card border-0 shadow-sm text-center py-4">
                    <div class="card-body">
                        <?php 
                            $avatar = !empty($user['avatar']) ? "uploads/".$user['avatar'] : "https://via.placeholder.com/150";
                        ?>
                        <img src="<?= $avatar ?>" class="rounded-circle mb-3 border" style="width: 150px; height: 150px; object-fit: cover;" alt="Avatar">
                        
                        <h5 class="fw-bold mb-1"><?= htmlspecialchars($user['fullname']) ?></h5>
                        <p class="text-muted mb-3"><?= htmlspecialchars($user['email']) ?></p>
                        
                        <div class="d-grid gap-2 col-10 mx-auto">
                            <a href="index.php?controller=home&action=dashboard" class="btn btn-outline-primary rounded-pill">
                                <i class="bi bi-speedometer2 me-2"></i>Vào Dashboard
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="card border-0 shadow-sm mt-3">
                    <div class="card-header bg-white border-0 fw-bold">
                        <i class="bi bi-trophy text-warning me-2"></i> Thành tích
                    </div>
                    <ul class="list-group list-group-flush small">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Tham gia từ
                            <span class="text-muted">2023</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Trạng thái
                            <span class="badge bg-success">Hoạt động</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="mb-0 fw-bold"><i class="bi bi-person-gear me-2"></i>Chỉnh sửa hồ sơ</h5>
                    </div>
                    <div class="card-body p-4">
                        
                        <?php if (!empty($message)): ?>
                            <div class="alert alert-success alert-dismissible fade show">
                                <i class="bi bi-check-circle me-2"></i> <?= $message ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>
                        
                        <?php if (!empty($error)): ?>
                            <div class="alert alert-danger alert-dismissible fade show">
                                <i class="bi bi-exclamation-triangle me-2"></i> <?= $error ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>

                        <form action="" method="POST" enctype="multipart/form-data">
                            
                            <div class="mb-3">
                                <label class="form-label fw-bold">Ảnh đại diện</label>
                                <input type="file" name="avatar" class="form-control">
                                <div class="form-text">Hỗ trợ định dạng: .jpg, .png, .jpeg</div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Họ và tên</label>
                                    <input type="text" name="fullname" class="form-control" value="<?= htmlspecialchars($user['fullname']) ?>" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Số điện thoại</label>
                                    <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($user['phone'] ?? '') ?>" placeholder="Nhập số điện thoại">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Email (Không thể thay đổi)</label>
                                <input type="email" class="form-control bg-light" value="<?= htmlspecialchars($user['email']) ?>" readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Giới thiệu bản thân / Bio</label>
                                <textarea name="bio" class="form-control" rows="4" placeholder="Chia sẻ đôi chút về bản thân, sở thích, mục tiêu..."><?= htmlspecialchars($user['bio'] ?? '') ?></textarea>
                            </div>

                            <div class="d-flex justify-content-end mt-4">
                                <button type="submit" class="btn btn-primary px-4 rounded-pill">
                                    <i class="bi bi-save me-2"></i>Lưu thay đổi
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once './views/layouts/footer.php'; ?>