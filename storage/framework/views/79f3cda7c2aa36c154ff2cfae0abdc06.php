

<?php $__env->startSection('content'); ?>
<div class="container">
    <h2 class="mt-3">Duyệt Đăng Ký Phòng Khám</h2>
    <form method="GET" action="<?php echo e(route('approve.index')); ?>" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" value="<?php echo e(request('search')); ?>" class="form-control" placeholder="Tìm kiếm theo tên bác sĩ...">

            <select name="status" class="form-select ms-2" style="max-width: 200px;">
                <option value="">-- Chọn trạng thái --</option>
                <option value="Chờ duyệt" <?php echo e(request('status') == 'Chờ duyệt' ? 'selected' : ''); ?>>Chờ duyệt</option>
                <option value="Xin chuyển viện" <?php echo e(request('status') == 'Xin chuyển viện' ? 'selected' : ''); ?>>Xin chuyển viện</option>
                <option value="Đã duyệt" <?php echo e(request('status') == 'Đã duyệt' ? 'selected' : ''); ?>>Đã duyệt</option>
                <option value="Bị từ chối" <?php echo e(request('status') == 'Bị từ chối' ? 'selected' : ''); ?>>Bị từ chối</option>
            </select>

            <button type="submit" class="btn btn-primary ms-2">Tìm</button>
        </div>
    </form>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Tên Bác Sĩ</th>
                <th>Phòng Khám Đăng Ký</th>
                <th>Trạng Thái</th>
                <th>Ghi Chú</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $registrationForms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $registrationForm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($registrationForm->doctor->user->name ?? 'Chưa có bác sĩ'); ?></td> <!-- Tên bác sĩ -->
                <td><?php echo e($registrationForm->clinic->name); ?></td> <!-- Tên phòng khám -->
                <td>
                    <span class="badge bg-<?php echo e($registrationForm->status == 'Đã duyệt' ? 'success' : ($registrationForm->status == 'Chờ duyệt' ? 'warning' : 'danger')); ?>">
                        <?php echo e($registrationForm->status); ?>

                    </span>
                </td>
                <td><?php echo e($registrationForm->note ?? 'Không có ghi chú'); ?></td> <!-- Ghi chú -->
                <td>
                    <a href="<?php echo e(route('registrationforms.show', $registrationForm->id)); ?>" class="btn btn-info btn-sm" title="Xem chi tiết">
                        <i class="bi bi-eye-fill fs-5 text-dark"></i>
                    </a>

                    
                    <?php if(in_array($registrationForm->status, ['Chờ duyệt', 'Xin chuyển viện'])): ?>
                        <form action="<?php echo e(route('registrationforms.approve', $registrationForm->id)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn duyệt yêu cầu này?');">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-success btn-sm">Duyệt</button>
                        </form>

                        <form action="<?php echo e(route('registrationforms.reject', $registrationForm->id)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn từ chối yêu cầu này?');">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-danger btn-sm">Từ chối</button>
                        </form>
                    <?php elseif($registrationForm->status == 'Đã duyệt'): ?>
                        <span class="text-success">Đã duyệt</span>
                    <?php elseif($registrationForm->status == 'Bị từ chối'): ?>
                        <span class="text-danger">Từ chối!</span>
                    <?php endif; ?>
                </td>


            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <?php echo e($registrationForms->links('pagination::bootstrap-5')); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\phongkham\resources\views/admin/layouts/pages/approve/index.blade.php ENDPATH**/ ?>