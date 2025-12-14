<!DOCTYPE html>
<!-- //version 1.2.0 -->
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký tài khoản</title>
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
            padding: 20px 0; /
        }

        .card-auth {
            border: none;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.3);
            background-color: rgba(255, 255, 255, 0.95);
            overflow: hidden;
        }

        .card-header-auth {
            background-color: transparent;
            padding-top: 25px;
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

        .link-login {
            color: #4A148C;
            font-weight: bold;
            text-decoration: none;
        }
        .link-login:hover {
            color: #7B1FA2;
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card card-auth">
                <div class="card-header card-header-auth">
                    <h3 class="fw-bold text-dark">Tạo Tài Khoản</h3>
                    <p class="text-muted small">Điền thông tin để tham gia cộng đồng học tập</p>
                </div>

                <div class="card-body p-4">

                    <?php if (isset($errors) && !empty($errors)): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong><i class="fa-solid fa-triangle-exclamation"></i> Vui lòng kiểm tra:</strong>
                            <ul class="mb-0 mt-1 ps-3">
                                <?php foreach ($errors as $err): ?>
                                    <li><?= htmlspecialchars($err) ?></li>
                                <?php endforeach; ?>
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <form action="index.php?controller=auth&action=handleRegister" method="POST">
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold small">Tên đăng nhập</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0"><i class="fas fa-user text-secondary"></i></span>
                                    <input type="text" class="form-control border-start-0 ps-0" name="username" 
                                           placeholder="VD: user123"
                                           value="<?= isset($userName) ? htmlspecialchars($userName) : '' ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold small">Họ và tên</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0"><i class="fas fa-id-card text-secondary"></i></span>
                                    <input type="text" class="form-control border-start-0 ps-0" name="fullname" 
                                           placeholder="VD: Nguyễn Văn A"
                                           value="<?= isset($fullname) ? htmlspecialchars($fullname) : '' ?>" required>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold small">Email</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0"><i class="fas fa-envelope text-secondary"></i></span>
                                <input type="email" class="form-control border-start-0 ps-0" name="email" 
                                       placeholder="example@email.com"
                                       value="<?= isset($email) ? htmlspecialchars($email) : '' ?>" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold small">Mật khẩu</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0"><i class="fas fa-lock text-secondary"></i></span>
                                    <input type="password" class="form-control border-start-0 ps-0" name="password" 
                                           placeholder="Tối thiểu 6 ký tự" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-bold small">Xác nhận mật khẩu</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0"><i class="fas fa-key text-secondary"></i></span>
                                    <input type="password" class="form-control border-start-0 ps-0" name="confirm_password" 
                                           placeholder="Nhập lại mật khẩu" required>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-primary-auth text-white">
                                ĐĂNG KÝ TÀI KHOẢN
                            </button>
                        </div>

                        <div class="text-center mt-3">
                            <p class="small mb-0">Đã có tài khoản? 
                                <a href="index.php?controller=auth&action=login" class="link-login">Đăng nhập ngay</a>
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