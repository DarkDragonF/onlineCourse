<h2 class="mb-4">Quản lý Người dùng</h2>
<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Tên đăng nhập</th>
                    <th>Email</th>
                    <th>Vai trò</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $u): ?>
                <tr>
                    <td><?= $u['id'] ?></td>
                    <td><strong><?= htmlspecialchars($u['username']) ?></strong></td>
                    <td><?= htmlspecialchars($u['email']) ?></td>
                    <td>
                        <?php 
                            if($u['role'] == 2) echo '<span class="badge bg-danger">Admin</span>';
                            elseif($u['role'] == 1) echo '<span class="badge bg-primary">Giảng viên</span>';
                            else echo '<span class="badge bg-secondary">Học viên</span>';
                        ?>
                    </td>
                    <td>
                        <?php if($u['status'] == 1): ?>
                            <span class="badge bg-success">Hoạt động</span>
                        <?php else: ?>
                            <span class="badge bg-secondary">Đã khóa</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if($u['role'] != 2): // Không khóa Admin ?>
                            <?php if($u['status'] == 1): ?>
                                <a href="index.php?controller=admin&action=toggleUserStatus&id=<?= $u['id'] ?>&status=1" 
                                   class="btn btn-sm btn-outline-danger" onclick="return confirm('Khóa tài khoản này?')">
                                   <i class="fas fa-lock"></i> Khóa
                                </a>
                            <?php else: ?>
                                <a href="index.php?controller=admin&action=toggleUserStatus&id=<?= $u['id'] ?>&status=0" 
                                   class="btn btn-sm btn-outline-success">
                                   <i class="fas fa-unlock"></i> Mở
                                </a>
                            <?php endif; ?>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>