<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand" href="<?php echo e(route('admin.dashboard')); ?>">
            <i class="fas fa-clinic-medical"></i> Phòng Khám Gia Đình
        </a>

        <!-- Nút toggle trên mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <?php if(auth()->guard()->check()): ?>
                    <!-- Dropdown User -->
                    <li class="nav-item dropdown">
                        <button class="btn btn-light dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user"></i> <?php echo e(Auth::user()->name); ?>

                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li>
                                <form method="POST" action="<?php echo e(route('logout')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="fas fa-sign-out-alt"></i> Đăng Xuất
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                <?php else: ?>
                    <li class="nav-item dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="loginDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            Tài Khoản
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="loginDropdown"> 
                            <li><a class="dropdown-item" href="<?php echo e(route('login')); ?>">Đăng Nhập</a></li>
                            <li><a class="dropdown-item" href="#">Đăng Ký</a></li>
                        </ul>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
<?php /**PATH C:\xampp\htdocs\phongkham\resources\views/admin/layouts/partials/navbar.blade.php ENDPATH**/ ?>