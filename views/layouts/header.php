<!-- version 1.1.1 -->
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduPro - Nền tảng học trực tuyến</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/header.css">
</head>
<body>

<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="index.php">
            <i class="bi bi-mortarboard-fill me-2 fs-3 text-warning"></i>
            EduPro
        </a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">
            <form class="d-flex mx-auto my-2 my-lg-0 search-form col-lg-5" action="index.php" method="GET">
                <input type="hidden" name="controller" value="course">
                <input type="hidden" name="action" value="search">
                <input class="form-control search-input w-100" type="search" name="keyword" placeholder="Tìm kiếm khóa học Python, Excel...">
                <button class="btn-search-icon" type="submit"><i class="bi bi-search"></i></button>
            </form>

            <ul class="navbar-nav align-items-center ms-auto">
                <li class="nav-item dropdown me-2"> <a class="nav-link dropdown-toggle fw-bold text-dark" href="#" id="categoryDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-grid me-1"></i> Danh mục
                </a>
                    <ul class="dropdown-menu shadow border-0 mt-2" aria-labelledby="categoryDropdown">
                        <?php
                        // Load danh mục từ Database trực tiếp tại Header
                        if (file_exists('./models/Category.php')) {
                            require_once './models/Category.php';
                            $catModelHeader = new Category();
                            $categoriesHeader = $catModelHeader->getAll();

                            if (!empty($categoriesHeader)) {
                                foreach ($categoriesHeader as $cat) {
                                    echo '<li><a class="dropdown-item" href="index.php?controller=course&action=category&id=' . $cat['id'] . '">' . htmlspecialchars($cat['name']) . '</a></li>';
                                }
                            } else {
                                echo '<li><span class="dropdown-item text-muted">Chưa có danh mục</span></li>';
                            }
                        }
                        ?>
                        <li><hr class="dropdown-divider"></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?controller=course&action=list">Khóa học</a>
                </li>
                <li class="nav-item d-none d-lg-block">
                    <span class="text-muted">|</span>
                </li>

                <?php 
                // Kiểm tra Session User
                if (session_status() === PHP_SESSION_NONE) session_start();
                ?>

                <?php if (empty($_SESSION['user_id'])): ?>
                    <li class="nav-item ms-2">
                        <a href="index.php?controller=auth&action=login" class="btn btn-login nav-link text-center px-4">Đăng nhập</a>
                    </li>
                    <li class="nav-item ms-2 mt-2 mt-lg-0">
                        <a href="index.php?controller=auth&action=register" class="btn btn-register text-center">Đăng ký ngay</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item dropdown ms-lg-3">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                            <span class="me-2 d-none d-lg-block fw-bold text-dark">
                                <?= htmlspecialchars($_SESSION['user_name'] ?? 'User') ?>
                            </span>
                            <img src="<?= $_SESSION['user_avatar'] ?? 'assets/img/default-avatar.png' ?>" class="rounded-circle user-avatar" alt="Avatar">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2">
                            <li><a class="dropdown-item" href="index.php?controller=profile&action=profile"><i class="bi bi-person me-2"></i>Hồ sơ</a></li>
                            <li><a class="dropdown-item" href="index.php?controller=course&action=mycourses"><i class="bi bi-book me-2"></i>Khóa học của tôi</a></li>
                            <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 1): ?>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-primary" href="index.php?controller=admin&action=dashboard"><i class="bi bi-speedometer2 me-2"></i>Trang quản trị</a></li>
                            <?php endif; ?>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="index.php?controller=auth&action=logout"><i class="bi bi-box-arrow-right me-2"></i>Đăng xuất</a></li>
                        </ul>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<div class="main-wrapper">