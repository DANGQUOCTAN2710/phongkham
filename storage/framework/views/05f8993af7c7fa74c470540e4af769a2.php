<nav class="navbar navbar-expand-lg navbar-light bg-primary">
    <div class="container-fluid">
        <?php if(Auth::user()->role === 'doctor'): ?>
            <a class="navbar-brand" href="<?php echo e(route('doctor.dashboard')); ?>" style="color:#fff">
                <img src="<?php echo e(asset('img/053a8e80-20f3-4d0e-94a0-bf153fb6a3e6.webp')); ?>" alt="Logo" width="30" height="30" class="d-inline-block align-top">    Xin chào Bác Sĩ, đây là <?php echo e($clinicName  ?? ''); ?>

            </a>
        <?php elseif(Auth::user()->role === 'staff'): ?>
            <a class="navbar-brand" href="<?php echo e(route('doctor.staff.dashboard')); ?>" style="color:#fff">
                <img src="<?php echo e(asset('img/053a8e80-20f3-4d0e-94a0-bf153fb6a3e6.webp')); ?>" alt="Logo" width="30" height="30" class="d-inline-block align-top">    Xin chào bạn, đây là <?php echo e($clinicName  ?? ''); ?>

            </a>
        <?php endif; ?>
        
        <div class="ms-auto">
            <div class="dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color:#fff;">
                    <?php echo e(Auth::user()->name); ?>

                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li>
                        <a class="dropdown-item" href="<?php echo e(route('profile')); ?>">Profile</a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form action="<?php echo e(route('logout')); ?>" method="POST" class="d-inline">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="dropdown-item">Đăng xuất</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<?php /**PATH C:\xampp\htdocs\phongkham\resources\views/doctor/layouts/navbar.blade.php ENDPATH**/ ?>