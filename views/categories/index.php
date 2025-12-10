<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Danh mục Khóa học</h2>
    <a href="index.php?controller=admin&action=createCategory" class="btn btn-primary">
        <i class="fas fa-plus"></i> Thêm mới
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th width="5%">ID</th>
                    <th width="25%">Tên Danh mục</th>
                    <th>Mô tả</th>
                    <th width="15%">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $c): ?>
                <tr>
                    <td><?= $c['id'] ?></td>
                    <td class="fw-bold text-primary"><?= htmlspecialchars($c['name']) ?></td>
                    <td><?= htmlspecialchars($c['description']) ?></td>
                    <td>
                       <a href="index.php?controller=admin&action=editCategory&id=<?= $c['id'] ?>" class="btn btn-sm btn-info text-white"> <i class="fas fa-edit"></i></a>
                        <a href="index.php?controller=admin&action=deleteCategory&id=<?= $c['id'] ?>" 
                           class="btn btn-sm btn-danger" onclick="return confirm('Xóa danh mục này?')">
                           <i class="fas fa-trash"></i>
                        </a>
                        
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>