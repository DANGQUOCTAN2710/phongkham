<!DOCTYPE html>
<html lang="vi">
<head>
    <?php echo $__env->make('user.layouts.partials.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>
<body class="d-flex flex-column min-vh-100">
    <?php echo $__env->make('user.layouts.partials.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->yieldContent('content'); ?>   
    <!-- Modal Đăng Nhập -->
    <!-- Button Kích Hoạt Modal -->
    <?php echo $__env->make('user.layouts.partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html><?php /**PATH C:\xampp\htdocs\phongkham\resources\views/user/app.blade.php ENDPATH**/ ?>