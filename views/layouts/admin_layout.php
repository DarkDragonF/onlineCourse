<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - EduPro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { background-color: #f8f9fa; }
        .sidebar {
            min-height: 100vh;
            background-color: #343a40;
            color: white;
            padding-top: 20px;
        }
        .sidebar a {
            color: #adb5bd;
            text-decoration: none;
            padding: 12px 20px;
            display: block;
            border-left: 3px solid transparent;
        }
        .sidebar a:hover, .sidebar a.active {
            background-color: #495057;
            color: white;
            border-left-color: #0d6efd;
        }
        .main-content { padding: 20px; }
        .card-stat { border: none; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 sidebar">
                <h4 class="text-center mb-4">Admin Panel</h4>
                
                <?php $act = $_GET['action'] ?? 'dashboard'; ?>

                <a href="index.php?controller=admin&action=dashboard" class="<?= ($act=='dashboard') ? 'active' : '' ?>">
                    <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                </a>
                <a href="index.php?controller=admin&action=listUsers" class="<?= ($act=='listUsers') ? 'active' : '' ?>">
                    <i class="fas fa-users me-2"></i> Quản lý Users
                </a>
                <a href="index.php?controller=admin&action=listCategories" class="<?= ($act=='listCategories') ? 'active' : '' ?>">
                    <i class="fas fa-list me-2"></i> Quản lý Danh mục
                </a>
                <a href="index.php?controller=course&action=list" class="<?= ($_GET['controller']=='course') ? 'active' : '' ?>">
                    <i class="fas fa-book me-2"></i> Quản lý Khóa học
                </a>

                <a href="index.php" class="mt-5 border-top border-secondary">
                    <i class="fas fa-sign-out-alt me-2"></i> Quay về Trang chủ
                </a>
            </div>

            <div class="col-md-10 main-content">
                <?php 
                // SỬA LỖI Ở ĐÂY:
                // 1. Dùng đúng tên biến $viewPath (khớp với Controller)
                // 2. Kiểm tra file tồn tại để tránh lỗi Fatal Error
                if (isset($viewPath) && file_exists($viewPath)) {
                    require_once $viewPath;
                } else {
                    echo '<div class="alert alert-danger">Lỗi: Không tìm thấy View. <br> Đường dẫn: ' . ($viewPath ?? 'Chưa định nghĩa') . '</div>';
                }
                ?> 
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>