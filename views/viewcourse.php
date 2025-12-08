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

   
</body>
</html>