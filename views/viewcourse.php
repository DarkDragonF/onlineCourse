<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduPro - Học trực tuyến</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        /* --- CSS TÙY CHỈNH THEO MẪU EDUPRO --- */
        :root {
            --primary-color: #1a237e; /* Xanh đậm banner */
            --accent-color: #f57c00;  /* Cam nút bấm */
            --text-gray: #6c757d;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }

        /* 1. Navbar */
        .navbar {
            background-color: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            padding: 15px 0;
        }
        .search-bar {
            background-color: #f1f3f5;
            border-radius: 20px;
            padding: 5px 20px;
            width: 400px;
            border: none;
        }

        /* 2. Hero Banner */
        .hero-section {
            background-color: var(--primary-color);
            color: white;
            padding: 80px 0;
            position: relative;
        }
        .hero-title {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 20px;
        }
        .btn-warning-custom {
            background-color: var(--accent-color);
            color: white;
            font-weight: 600;
            padding: 10px 30px;
            border-radius: 5px;
            border: none;
        }
        .btn-outline-custom {
            border: 1px solid white;
            color: white;
            font-weight: 600;
            padding: 10px 30px;
            border-radius: 5px;
            margin-left: 10px;
            background: transparent;
        }

        /* 3. Stats Section */
        .stats-section {
            background: white;
            padding: 40px 0;
            text-align: center;
        }
        .stat-number {
            font-size: 1.8rem;
            font-weight: bold;
            color: var(--primary-color);
        }

        /* 4. Course Card */
        .course-card {
            border: none;
            border-radius: 15px;
            transition: transform 0.3s;
            background: white;
            overflow: hidden;
        }
        .course-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .card-img-top {
            height: 180px;
            object-fit: cover;
        }
        .badge-category {
            font-size: 0.8rem;
            color: var(--primary-color);
            font-weight: 600;
            background-color: #e8eaf6;
            padding: 5px 10px;
            border-radius: 10px;
            display: inline-block;
            margin-bottom: 10px;
        }
        .card-title {
            font-weight: 700;
            font-size: 1.1rem;
            min-height: 50px; /* Để đều nhau */
        }
        .price-tag {
            font-size: 1.1rem;
            font-weight: bold;
            color: #212529;
        }
        .original-price {
            text-decoration: line-through;
            font-size: 0.9rem;
            color: #999;
        }

        /* 5. Footer */
        footer {
            background-color: #1c1f26; /* Màu đen xanh như ảnh */
            color: #aeb4be;
            padding: 60px 0;
        }
        footer h5 {
            color: white;
            margin-bottom: 20px;
        }
        footer a {
            color: #aeb4be;
            text-decoration: none;
            display: block;
            margin-bottom: 10px;
        }
        footer a:hover {
            color: white;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <div class="bg-primary text-white rounded p-1 me-2" style="width: 35px; height: 35px; text-align: center;">E</div>
                <span class="fw-bold text-primary">EduPro</span>
            </a>

            <form class="d-none d-lg-flex mx-auto">
                <div class="input-group">
                    <span class="input-group-text bg-light border-0"><i class="bi bi-search"></i></span>
                    <input type="text" class="form-control bg-light border-0" placeholder="Tìm kiếm khóa học Python, Marketing...">
                </div>
            </form>

            <div class="d-flex align-items-center">
                <a href="#" class="text-dark text-decoration-none me-3">Danh mục</a>
                <img src="https://via.placeholder.com/40" class="rounded-circle" alt="User">
            </div>
        </div>
    </nav>

    <div style="height: 70px;"></div>

    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="hero-title">Nâng cao kỹ năng,<br>Mở rộng tương lai</h1>
                    <p class="lead mb-4">Truy cập hơn 1000+ khóa học từ các chuyên gia hàng đầu. Học mọi lúc, mọi nơi.</p>
                    <a href="#" class="btn btn-warning-custom">Xem khóa học</a>
                    <a href="#" class="btn btn-outline-custom">Dành cho Giảng viên</a>
                </div>
                <div class="col-md-6 text-center">
                    <img src="https://cdn3d.iconscout.com/3d/premium/thumb/online-education-4643033-3850550.png" alt="Hero Image" class="img-fluid" style="max-height: 400px;">
                </div>
            </div>
        </div>
    </section>

    <section class="stats-section border-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-6 mb-3">
                    <div class="stat-number">10k+</div>
                    <div class="text-muted">Học viên</div>
                </div>
                <div class="col-md-3 col-6 mb-3">
                    <div class="stat-number">500+</div>
                    <div class="text-muted">Khóa học</div>
                </div>
                <div class="col-md-3 col-6 mb-3">
                    <div class="stat-number">200+</div>
                    <div class="text-muted">Giảng viên</div>
                </div>
                <div class="col-md-3 col-6 mb-3">
                    <div class="stat-number">4.8/5</div>
                    <div class="text-muted">Đánh giá trung bình</div>
                </div>
            </div>
        </div>
    </section>

    <section class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Khóa học nổi bật</h2>
            <div class="d-none d-md-block">
                <button class="btn btn-primary btn-sm rounded-pill px-3 me-1">Tất cả</button>
                <button class="btn btn-light btn-sm rounded-pill px-3 me-1 border">Lập trình</button>
                <button class="btn btn-light btn-sm rounded-pill px-3 me-1 border">Kinh doanh</button>
                <button class="btn btn-light btn-sm rounded-pill px-3 border">Ngoại ngữ</button>
            </div>
        </div>

        <div class="row">
            <?php foreach ($newCourses as $course): ?>
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="card course-card h-100 shadow-sm">
                        <?php $img = !empty($course['image']) ? $course['image'] : 'https://via.placeholder.com/300x200'; ?>
                        <img src="assets/img/<?= $img ?>" class="card-img-top" alt="...">
                        
                        <div class="card-body">
                            <span class="badge-category">Lập trình Web</span>
                            
                            <h5 class="card-title text-truncate"><?= htmlspecialchars($course['title']) ?></h5>
                            
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-person-circle text-muted me-2"></i>
                                <small class="text-muted"><?= htmlspecialchars($course['instructor_name']) ?></small>
                            </div>

                            <div class="mb-2">
                                <i class="bi bi-star-fill text-warning"></i>
                                <span class="fw-bold small">4.9</span>
                                <small class="text-muted">(120)</small>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-3 border-top pt-3">
                                <div>
                                    <div class="price-tag text-primary"><?= number_format($course['price']) ?>đ</div>
                                </div>
                            </div>
                            
                            <a href="index.php?controller=course&action=show&id=<?= $course['id'] ?>" class="btn btn-light text-primary fw-bold w-100 mt-2" style="background-color: #e3f2fd;">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="text-center mt-4">
            <a href="#" class="btn btn-outline-secondary rounded-pill px-4">Xem tất cả khóa học</a>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-primary text-white rounded p-1 me-2" style="width: 30px; height: 30px; text-align: center;">E</div>
                        <span class="fw-bold text-white h5 m-0">EduPro</span>
                    </div>
                    <p class="small">Nền tảng học tập trực tuyến hàng đầu, kết nối tri thức mọi lúc mọi nơi.</p>
                </div>
                <div class="col-md-2 col-6 mb-4">
                    <h5>Học viên</h5>
                    <a href="#">Tìm khóa học</a>
                    <a href="#">Đăng nhập</a>
                </div>
                <div class="col-md-2 col-6 mb-4">
                    <h5>Giảng viên</h5>
                    <a href="#">Đăng ký dạy học</a>
                    <a href="#">Quy định giảng dạy</a>
                </div>
                <div class="col-md-2 col-6 mb-4">
                    <h5>Quản trị</h5>
                    <a href="#">Cổng Admin</a>
                    <a href="#">Liên hệ hỗ trợ</a>
                </div>
            </div>
            <div class="border-top border-secondary pt-3 mt-3 text-center small">
                &copy; 2025 EduPro. All rights reserved.
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>