<!DOCTYPE html>
<!-- //version 1.2.0 -->
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập hệ thống</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-image: url('./assets/img/login-bg.png'); 
            
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed; 
            
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
            
        }

        .card-auth {
            border: none;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.3); 
            overflow: hidden;
            background-color: rgba(255, 255, 255, 0.95);
        }

        .card-header-auth {
            background-color: transparent;
            padding-top: 30px;
            border-bottom: none;
            text-align: center;
        }

        .btn-primary-auth {
            background: #4A148C; 
            border: none;
            padding: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary-auth:hover { 
            background: #7B1FA2; 
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(74, 20, 140, 0.3);
        }

        .link-register {
            color: #4A148C;
            font-weight: bold;
            text-decoration: none;
        }
        .link-register:hover {
            color: #7B1FA2;
            text-decoration: underline;
        }
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
                                <span class="input-group-text bg-white border-end-0"><i class="fas fa-envelope text-secondary"></i></span>
                                <input type="email" class="form-control border-start-0 ps-0" name="email" 
                                       placeholder="Nhập email của bạn"
                                       value="<?= isset($email) ? htmlspecialchars($email) : '' ?>" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Mật khẩu</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0"><i class="fas fa-lock text-secondary"></i></span>
                                <input type="password" class="form-control border-start-0 ps-0" name="password" 
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
                                <a href="index.php?controller=auth&action=register" class="link-register">Đăng ký ngay</a>
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