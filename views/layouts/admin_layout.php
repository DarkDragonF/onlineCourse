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
                <a href="index.php?controller=admin&action=dashboard" class="<?= ($_GET['action']=='dashboard') ? 'active' : '' ?>">
                    <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                </a>
                <a href="index.php?controller=admin&action=listUsers" class="<?= ($_GET['action']=='listUsers') ? 'active' : '' ?>">
                    <i class="fas fa-users me-2"></i> Quản lý Users
                </a>
                <a href="index.php?controller=admin&action=listCategories" class="<?= ($_GET['action']=='listCategories') ? 'active' : '' ?>">
                    <i class="fas fa-list me-2"></i> Quản lý Danh mục
                </a>
                <a href="index.php" class="mt-5 border-top border-secondary">
                    <i class="fas fa-sign-out-alt me-2"></i> Quay về Trang chủ
                </a>
            </div>

            <div class="col-md-10 main-content">
                <?php require_once $view_path; ?> 
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>