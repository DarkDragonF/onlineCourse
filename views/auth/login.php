<!-- version 1.1.1 -->
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập hệ thống</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/assets/css/auth.css">
    
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
        }
        .card-auth {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            overflow: hidden;
        }
        .card-header-auth {
            background-color: #fff;
            padding-top: 30px;
            border-bottom: none;
            text-align: center;
        }
        .btn-primary-auth {
            background: #764ba2;
            border: none;
            padding: 10px;
            font-weight: 600;
        }
        .btn-primary-auth:hover { background: #5a3780; }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5 col-lg-4">
            <div class="card card-auth">
                <div class="card-header card-header-auth">
                    <h3 class="fw-bold text-dark">Đăng Nhập</h3>
                    <p class="text-muted small">Chào mừng bạn quay trở lại!</p>
                </div>

                <div class="card-body p-4">
                    
                    <?php if (isset($errors) && !empty($errors)): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong><i class="fa-solid fa-triangle-exclamation"></i> Có lỗi xảy ra:</strong>
                            <ul class="mb-0 mt-1 ps-3">
                                <?php foreach ($errors as $err): ?>
                                    <li><?= htmlspecialchars($err) ?></li>
                                <?php endforeach; ?>
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    <form action="index.php?controller=auth&action=handleLogin" method="POST">
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Email</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="fas fa-envelope text-secondary"></i></span>
                                <input type="email" class="form-control" name="email" 
                                       placeholder="Nhap email cua ban"
                                       value="<?= isset($email) ? htmlspecialchars($email) : '' ?>" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Mật khẩu</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="fas fa-lock text-secondary"></i></span>
                                <input type="password" class="form-control" name="password" 
                                       placeholder="••••••••" required>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-primary-auth text-white">
                                ĐĂNG NHẬP
                            </button>
                        </div>

                        <div class="text-center mt-3">
                            <p class="small mb-0">Chưa có tài khoản? 
                                <a href="index.php?controller=auth&action=register" class="text-decoration-none fw-bold" style="color: #764ba2;">Đăng ký ngay</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
