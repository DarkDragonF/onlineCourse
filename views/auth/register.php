<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký tài khoản</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
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
        }
        .card-header-auth {
            background-color: #fff;
            padding-top: 25px;
            border-bottom: none;
            text-align: center;
        }
        .btn-primary-auth { background: #764ba2; border: none; padding: 10px; font-weight: 600; }
        .btn-primary-auth:hover { background: #5a3780; }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-5">
            <div class="card card-auth">
                <div class="card-header card-header-auth">
                    <h3 class="fw-bold text-dark">Tạo Tài Khoản</h3>
                    <p class="text-muted small">Điền thông tin để tham gia khóa học</p>
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
                                <input type="text" class="form-control" name="username" 
                                       value="<?= isset($userName) ? htmlspecialchars($userName) : '' ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold small">Họ và tên</label>
                                <input type="text" class="form-control" name="fullname" 
                                       value="<?= isset($fullname) ? htmlspecialchars($fullname) : '' ?>" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold small">Email</label>
                            <input type="email" class="form-control" name="email" 
                                   value="<?= isset($email) ? htmlspecialchars($email) : '' ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold small">Mật khẩu</label>
                            <input type="password" class="form-control" name="password" 
                                   placeholder="Tối thiểu 6 ký tự" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold small">Xác nhận mật khẩu</label>
                            <input type="password" class="form-control" name="confirm_password" required>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-primary-auth text-white">
                                ĐĂNG KÝ
                            </button>
                        </div>

                        <div class="text-center mt-3">
                            <p class="small mb-0">Đã có tài khoản? 
                                <a href="index.php?controller=auth&action=login" class="text-decoration-none fw-bold" style="color: #764ba2;">Đăng nhập ngay</a>
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