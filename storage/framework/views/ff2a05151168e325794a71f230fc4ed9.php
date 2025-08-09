

<?php $__env->startSection('content'); ?>
<div class="container">
    <h2>Danh sách Đơn Thuốc</h2>

    <form method="GET" class="row g-3 mb-3">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control" placeholder="Tìm theo tên bệnh nhân" value="<?php echo e(request('search')); ?>">
        </div>
        <div class="col-md-4">
            <select name="clinic_id" class="form-select">
                <option value="">-- Lọc theo phòng khám --</option>
                <?php $__currentLoopData = $clinics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $clinic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($clinic->id); ?>" <?php echo e(request('clinic_id') == $clinic->id ? 'selected' : ''); ?>>
                        <?php echo e($clinic->name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="col-md-4">
            <button type="submit" class="btn btn-primary">Lọc</button>
            <a href="<?php echo e(route('prescription')); ?>" class="btn btn-secondary">Đặt lại</a>
        </div>
    </form>

    <table class="table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Bệnh nhân</th>
                <th>Bác sĩ</th>
                <th>Ngày tạo</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $pres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prescription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($prescription->id); ?></td>
                    <td><?php echo e($prescription->medicalRecord->medicalBook->patient->name); ?></td>
                    <td><?php echo e($prescription->doctor->user->name); ?></td>
                    <td><?php echo e($prescription->created_at->format('d/m/Y')); ?></td>
                    <td><?php echo e(number_format($prescription->total_price)); ?> đ</td>
                    <td>
                        <?php if($prescription->status == 'Đã duyệt'): ?>
                            <span class="badge bg-success">Đã duyệt</span>
                        <?php else: ?>
                            <span class="badge bg-warning text-dark">Chưa duyệt</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        
                        <a href="<?php echo e(route('prescription.show', $prescription->id)); ?>" class="btn btn-info btn-sm">
                            Xem chi tiết
                        </a>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    <?php echo e($pres->links('pagination::bootstrap-5')); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\phongkham\resources\views/admin/layouts/pages/prescription/index.blade.php ENDPATH**/ ?>