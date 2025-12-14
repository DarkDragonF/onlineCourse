<!DOCTYPE html>
<!-- //version 1.2.0 -->
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - EduPro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/adminLayout.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 sidebar p-0">
                <h4 class="text-center mb-4 mt-3 py-2 border-bottom border-secondary">Admin Panel</h4>
                
                <?php $act = $_GET['action'] ?? 'dashboard'; ?>

                <a href="index.php?controller=admin&action=dashboard" class="<?= ($act=='dashboard') ? 'active' : '' ?>">
                    <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                </a>
                
                <a href="index.php?controller=admin&action=listUsers" class="<?= ($act=='listUsers') ? 'active' : '' ?>">
                    <i class="fas fa-users me-2"></i> Quản lý Users
                </a>
                
                <a href="index.php?controller=admin&action=listCategories" class="<?= ($act=='listCategories' || $act=='createCategory' || $act=='editCategory') ? 'active' : '' ?>">
                    <i class="fas fa-list me-2"></i> Quản lý Danh mục
                </a>

                <a href="index.php?controller=admin&action=listCourses" class="<?= ($act=='listCourses') ? 'active' : '' ?>">
                    <i class="fas fa-book me-2"></i> Quản lý Khóa học
                </a>

                <a href="index.php?controller=auth&action=logout" class="mt-5 border-top border-secondary text-warning">
                    <i class="fas fa-sign-out-alt me-2"></i> Đăng Xuất
                </a>
            </div>

            <div class="col-md-10 main-content">
                <?php 
                // Hiển thị nội dung động từ Controller truyền vào
                // Biến $viewPath được định nghĩa trong hàm render() của AdminController
                if (isset($viewPath) && file_exists($viewPath)) {
                    require_once $viewPath;
                } else {
                    echo '<div class="alert alert-danger shadow-sm">';
                    echo '<h4 class="alert-heading"><i class="fas fa-exclamation-triangle"></i> Lỗi View!</h4>';
                    echo '<p>Không tìm thấy file view tương ứng.</p>';
                    echo '<hr>';
                    echo '<p class="mb-0 small">Đường dẫn: <strong>' . ($viewPath ?? 'Chưa định nghĩa') . '</strong></p>';
                    echo '</div>';
                }
                ?> 
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>