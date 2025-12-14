<?php
//version 1.2.0
require_once './models/User.php';

class ProfileController {
    
    public function profile() {
        // 1. Check đăng nhập
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?controller=auth&action=login");
            exit();
        }

        $userId = $_SESSION['user_id'];
        $userModel = new User();
        $message = '';
        $error = '';

        // 2. Xử lý khi bấm nút LƯU (POST)
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $fullname = trim($_POST['fullname']);
            $phone = !empty($_POST['phone']) ? trim($_POST['phone']) : null;
            $bio = !empty($_POST['bio']) ? trim($_POST['bio']) : null;
            $avatarPath = null;

            // Xử lý upload ảnh Avatar
            if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0) {
                $targetDir = "uploads/";
                // Tạo thư mục nếu chưa có
                if (!file_exists($targetDir)) {
                    mkdir($targetDir, 0777, true);
                }

                $fileName = time() . '_' . basename($_FILES["avatar"]["name"]);
                $targetFilePath = $targetDir . $fileName;
                $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
                
                $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
                if (in_array($fileType, $allowTypes)) {
                    if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $targetFilePath)) {
                        $avatarPath = $fileName; 
                    } else {
                        $error = "Lỗi khi tải ảnh lên server.";
                    }
                } else {
                    $error = "Chỉ chấp nhận file ảnh JPG, JPEG, PNG, GIF.";
                }
            }

            if (empty($error)) {
                if ($userModel->updateProfile($userId, $fullname, $phone, $bio, $avatarPath)) {
                    $message = "Cập nhật hồ sơ thành công!";
                    
                    // Cập nhật session ngay lập tức để Header hiển thị đúng
                    $_SESSION['user_fullname'] = $fullname;
                    if ($avatarPath) {
                        $_SESSION['user_avatar'] = "uploads/" . $avatarPath;
                    }
                } else {
                    $error = "Có lỗi xảy ra khi lưu vào Database.";
                }
            }
        }

        // 3. Lấy dữ liệu user hiện tại
        $user = $userModel->getById($userId);
        
        // 4. Gọi View
        require_once './views/profile/index.php';
    }
}
?>