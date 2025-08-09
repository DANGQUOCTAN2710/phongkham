

<?php $__env->startSection('content'); ?>
<div class="container">
    <h2 class="mt-3">Quản Lý Phòng Khám</h2>

    <a href="<?php echo e(route('clinics.create')); ?>" class="btn btn-primary mb-3">Thêm Phòng Khám</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Tên Phòng Khám</th>
                <th>Địa Chỉ</th>
                <th>Số Điện Thoại</th>
                <th>Email</th>
                <th>Người Quản Lý</th>
                <th>Trạng Thái</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $clinics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $clinic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>  
                <td><?php echo e($clinic->name); ?></td>
                <td><?php echo e($clinic->address); ?></td>
                <td><?php echo e($clinic->phone); ?></td>
                <td><?php echo e($clinic->email); ?></td>
                <td><?php echo e($clinic->user->name ?? 'Chưa có'); ?></td>
                <td>
                    <span class="badge bg-<?php echo e($clinic->status == 'Đang hoạt động' ? 'success' : ($clinic->status == 'Chờ duyệt' ? 'warning' : 'danger')); ?>">
                        <?php echo e($clinic->status); ?>

                    </span>
                </td>
                <td>
                    <a href="<?php echo e(route('clinics.edit', $clinic->id)); ?>" class="btn btn-warning btn-sm">Sửa</a>
                    <form action="<?php echo e(route('clinics.destroy', $clinic->id)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?');">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <?php echo e($clinics->links('pagination::bootstrap-5')); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\phongkham\resources\views/admin/layouts/pages/clinics/index.blade.php ENDPATH**/ ?>