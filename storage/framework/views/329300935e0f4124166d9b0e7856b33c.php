

<?php $__env->startSection('content'); ?>
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="dashboard-card text-center p-5 rounded shadow-lg">
        <div class="icon-box mb-3">
            <i class="fas fa-hospital-user"></i>
        </div>
        <h2 class="fw-bold text-uppercase">Hệ Thống Quản Lý Phòng Khám</h2>
        <p class="text-muted">Chào mừng <?php echo e(Auth::user()->name); ?> đến với hệ thống quản lý phòng khám chuyên nghiệp.</p>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\phongkham\resources\views/admin/layouts/pages/dashboard.blade.php ENDPATH**/ ?>