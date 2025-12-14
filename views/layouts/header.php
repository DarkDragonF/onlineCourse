<!DOCTYPE html>
<!-- //version 1.2.0 -->
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduPro - Nền tảng học trực tuyến hàng đầu</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="./assets/css/header.css">
    <?php if(isset($extraCss)) echo '<link rel="stylesheet" href="'.$extraCss.'">'; ?>
</head>
<body>

<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="index.php">
            <div class="bg-primary bg-opacity-10 p-2 rounded-circle me-2 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                <i class="bi bi-mortarboard-fill fs-4 text-primary"></i>
            </div>
            <span>Edu<span class="text-warning">Pro</span></span>
        </a>

        <button class="navbar-toggler shadow-none border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">
            
            <form class="d-flex mx-auto my-3 my-lg-0 search-form col-lg-5" action="index.php" method="GET">
                <input type="hidden" name="controller" value="course">
                <input type="hidden" name="action" value="search">
                <input class="form-control search-input w-100" type="search" name="keyword" placeholder="Tìm khóa học, giảng viên..." required>
                <button class="btn-search-icon" type="submit"><i class="bi bi-search"></i></button>
            </form>

            <ul class="navbar-nav align-items-center ms-auto">
                
                <li class="nav-item dropdown me-2"> 
                    <a class="nav-link dropdown-toggle" href="#" id="categoryDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-grid-3x3-gap-fill me-1"></i> Danh mục
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end mt-2" aria-labelledby="categoryDropdown">
                        <?php
                        if (file_exists('./models/Category.php')) {
                            require_once './models/Category.php';
                            $catModelHeader = new Category();
                            $categoriesHeader = $catModelHeader->getAll();

                            if (!empty($categoriesHeader)) {
                                foreach ($categoriesHeader as $cat) {
                                    echo '<li><a class="dropdown-item" href="index.php?controller=course&action=category&id=' . $cat['id'] . '">' . htmlspecialchars($cat['name']) . '</a></li>';
                                }
                            } else {
                                echo '<li><span class="dropdown-item text-muted small">Đang cập nhật...</span></li>';
                            }
                        }
                        ?>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="index.php?controller=course&action=list">Khóa học</a>
                </li>
                
                <li class="nav-item d-none d-lg-block mx-2">
                    <span class="text-secondary opacity-25">|</span>
                </li>

                <?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>

                <?php if (empty($_SESSION['user_id'])): ?>
                    <li class="nav-item ms-lg-2 mb-2 mb-lg-0">
                        <a href="index.php?controller=auth&action=login" class="btn btn-login w-100">Đăng nhập</a>
                    </li>
                    <li class="nav-item ms-lg-2">
                        <a href="index.php?controller=auth&action=register" class="btn btn-register w-100">Đăng ký</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item dropdown ms-lg-3">
                        <a class="nav-link p-0 d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                            <div class="text-end me-2 d-none d-lg-block line-height-sm">
                                <small class="d-block text-muted" style="font-size: 0.75rem;">Xin chào,</small>
                                <span class="fw-bold text-dark"><?= htmlspecialchars($_SESSION['user_name'] ?? 'User') ?></span>
                            </div>
                            <?php 
                                $avatar = $_SESSION['user_avatar'] ?? './assets/img/default-user.png';
                                //if(strpos($avatar, 'http') === false) $avatar = "uploads/" . $avatar;
                            ?>
                            <img src="<?= $avatar ?>" class="rounded-circle user-avatar" alt="Avatar">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end mt-3">
                            <li><h6 class="dropdown-header">Tài khoản của tôi</h6></li>
                            <li><a class="dropdown-item" href="index.php?controller=profile&action=profile"><i class="bi bi-person-gear me-2"></i>Hồ sơ cá nhân</a></li>
                            <li><a class="dropdown-item" href="index.php?controller=course&action=mycourses"><i class="bi bi-journal-bookmark me-2"></i>Khóa học của tôi</a></li>
                            
                            <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 1): ?>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-primary fw-bold" href="index.php?controller=instructor&action=dashboard"><i class="bi bi-speedometer2 me-2"></i>Trang Giảng viên</a></li>
                            <?php endif; ?>
                            
                            <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 2): ?>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger fw-bold" href="index.php?controller=admin&action=dashboard"><i class="bi bi-shield-lock me-2"></i>Trang Quản trị</a></li>
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