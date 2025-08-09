

<?php $__env->startSection('content'); ?>
<div class="container">
    <h2>Danh sách Bệnh Nhân</h2>
    <a href="<?php echo e(route('patients.create')); ?>" class="btn btn-primary mb-3">
        <i class="fas fa-user-plus"></i> Thêm Bệnh Nhân
    </a>

    <!-- Bộ lọc theo phòng khám -->
    <form method="GET" action="<?php echo e(route('patients.index')); ?>" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <select name="clinic_id" class="form-control" onchange="this.form.submit()">
                    <option value="">Tất cả phòng khám</option>
                        <?php $__currentLoopData = $clinics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $clinic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($clinic->id); ?>" <?php echo e(request('clinic_id') == $clinic->id ? 'selected' : ''); ?>>
                                <?php echo e($clinic->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                </select>
            </div>
            <div class="col-md-4">
                <input type="text" name="search" value="<?php echo e(request('search')); ?>" class="form-control"
                    placeholder="Tìm theo tên hoặc CCCD...">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-secondary w-100">Lọc</button>
            </div>
        </div>
    </form>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Họ Tên</th>
                <th>Số Điện Thoại</th>
                <th>CCCD</th>
                <th>Địa chỉ</th>
                <th>Phòng Khám</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $patients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($patient->name); ?></td>
                    <td><?php echo e($patient->phone); ?></td>
                    <td><?php echo e($patient->idUser); ?></td>
                    <td><?php echo e($patient->address); ?></td>
                    <td>
                       <?php echo e($patient->medicalBook->clinic->name ?? 'Chưa có phòng khám'); ?>

                    </td>
                    <td>
                        <a href="<?php echo e(route('patients.show', $patient->id)); ?>" class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i> Xem
                        </a>
                        <form action="<?php echo e(route('patients.destroy', $patient->id)); ?>" method="POST" style="display:inline-block;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
        <?php echo e($patients->links()); ?>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\phongkham\resources\views/admin/layouts/pages/patients/index.blade.php ENDPATH**/ ?>