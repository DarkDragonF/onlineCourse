<!DOCTYPE html>
<!-- //version 1.2.0 -->
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructor Portal - EduPro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { background-color: #f3f4f6; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, #4e73df 10%, #224abe 100%); /* Màu xanh tím */
            color: white;
        }
        .sidebar .nav-link { color: rgba(255,255,255,0.8); margin-bottom: 5px; border-radius: 5px; padding: 12px 20px; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            color: #fff; background-color: rgba(255,255,255,0.15); font-weight: bold;
        }
        .main-content { padding: 30px; }
        .card-custom { border: none; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); transition: transform 0.2s; }
        .card-custom:hover { transform: translateY(-3px); }
        .user-avatar { width: 35px; height: 35px; object-fit: cover; border-radius: 50%; }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 sidebar p-3">
                <div class="d-flex align-items-center mb-4 pb-3 border-bottom border-light">
                    <i class="fas fa-chalkboard-teacher fa-2x me-2"></i>
                    <span class="fs-5 fw-bold">Giảng Viên</span>
                </div>
                
                <?php $act = $_GET['action'] ?? 'dashboard'; ?>
                
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="index.php?controller=instructor&action=dashboard" class="nav-link <?= $act=='dashboard'?'active':'' ?>">
                            <i class="fas fa-chart-line me-2"></i> Tổng quan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="index.php?controller=instructor&action=createLession" class="nav-link <?= $act=='courses'?'active':'' ?>">
                            <i class="fas fa-book-open me-2"></i> Quản lý Khóa học
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="index.php?controller=instructor&action=studentManagement" class="nav-link <?= $act=='students'?'active':'' ?>">
                            <i class="fas fa-user-graduate me-2"></i> Học viên & Tiến độ
                        </a>
                    </li>
                </ul>

                <div class="mt-auto pt-5">
                    <!-- <a href="index.php" class="nav-link text-warning"><i class="fas fa-home me-2"></i> Trang chủ</a> -->
                    <a href="index.php?controller=auth&action=logout" class="nav-link text-danger fw-bold"><i class="fas fa-sign-out-alt me-2"></i> Đăng xuất</a>
                </div>
            </div>

            <div class="col-md-10 main-content">
                <div class="d-flex justify-content-between align-items-center mb-4 bg-white p-3 rounded shadow-sm">
                    <h5 class="mb-0 text-secondary">Chào mừng trở lại, <span class="text-primary fw-bold"><?= $_SESSION['user_name'] ?></span>!</h5>
                    <div class="d-flex align-items-center">
                        <span class="badge bg-primary me-2">Instructor</span>
                        <img src="<?= $_SESSION['user_avatar'] ?? './assets/img/default-user.png' ?>" class="user-avatar border">
                    </div>
                </div>

                <?php require_once $viewPath; ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>