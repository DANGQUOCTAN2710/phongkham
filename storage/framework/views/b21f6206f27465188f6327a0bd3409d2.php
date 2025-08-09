

<?php $__env->startSection('content'); ?>
<div class="container">
    <h2>Danh sách Nhân Viên</h2>
    <a href="<?php echo e(route('staffs.create')); ?>" class="btn btn-primary mb-3">
        <i class="fas fa-user-plus"></i> Thêm Nhân Viên
    </a>

    <!-- Bộ lọc theo phòng khám -->
    <form method="GET" action="<?php echo e(route('staffs.index')); ?>" class="mb-3">
        <div class="row">
            <div class="col-md-3">
                <select name="clinic_id" class="form-control" onchange="this.form.submit()">
                    <option value="">Tất cả phòng khám</option>
                    <?php $__currentLoopData = $clinics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $clinic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($clinic->id); ?>" <?php echo e(request('clinic_id') == $clinic->id ? 'selected' : ''); ?>>
                            <?php echo e($clinic->name); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="col-md-3">
                <select name="position" class="form-control" onchange="this.form.submit()">
                    <option value="">Tất cả chức vụ</option>
                    <?php
                        $positions = ['Tiếp đón', 'Cấp thuốc', 'Kế toán'];
                    ?>
                    <?php $__currentLoopData = $positions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $position): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($position); ?>" <?php echo e(request('position') == $position ? 'selected' : ''); ?>>
                            <?php echo e($position); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="col-md-4">
                <input type="text" name="search" value="<?php echo e(request('search')); ?>" class="form-control"
                    placeholder="Tìm theo tên nhân viên..." onchange="this.form.submit()">
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
                <th>SĐT</th>
                <th>Địa chỉ</th>
                <th>Chức Vụ</th>
                <th>Phòng Khám</th>
                <th>Trạng thái</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $staffs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($staff->user->name); ?></td>
                    <td><?php echo e($staff->phone); ?></td>
                    <td><?php echo e($staff->address ?? '-'); ?></td>
                    <td><?php echo e($staff->position); ?></td>
                    <td><?php echo e($staff->clinic->name ?? 'Không có'); ?></td>
                    <td><?php echo e($staff->status); ?></td>
                    <td>
                        <form action="<?php echo e(route('staffs.destroy', $staff->id)); ?>" method="POST" style="display:inline-block;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <?php echo e($staffs->links('pagination::bootstrap-5')); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\phongkham\resources\views/admin/layouts/pages/staffs/index.blade.php ENDPATH**/ ?>