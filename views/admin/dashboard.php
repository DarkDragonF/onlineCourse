<!-- //version 1.2.0 -->
<h2 class="mb-4">Tổng quan hệ thống</h2>

<div class="row">
    <div class="col-md-4">
        <a href="index.php?controller=admin&action=listUsers" 
           style="text-decoration: none; display: block; cursor: pointer;">
            
            <div class="card bg-primary text-white mb-3 shadow h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title text-white">USERS</h5>
                            <h2 class="display-4 fw-bold text-white"><?= $countUser ?></h2>
                        </div>
                        <i class="fas fa-users fa-4x opacity-25 text-white"></i>
                    </div>
                    <div class="mt-3 border-top pt-2 text-white">
                        Bấm để quản lý <i class="fas fa-arrow-right float-end"></i>
                    </div>
                </div>
            </div>

        </a>
    </div>

    <div class="col-md-4">
        <a href="index.php?controller=admin&action=listCategories" 
           style="text-decoration: none; display: block; cursor: pointer;">
            
            <div class="card bg-success text-white mb-3 shadow h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title text-white">DANH MỤC</h5>
                            <h2 class="display-4 fw-bold text-white"><?= $countCat ?></h2>
                        </div>
                        <i class="fas fa-folder fa-4x opacity-25 text-white"></i>
                    </div>
                    <div class="mt-3 border-top pt-2 text-white">
                        Bấm để quản lý <i class="fas fa-arrow-right float-end"></i>
                    </div>
                </div>
            </div>

        </a>
    </div>
</div>