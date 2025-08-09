

<?php $__env->startSection('content'); ?>
<!-- Main content -->
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div id="staff-section" class="section">
        <h3 class="mb-3 text-center text-primary">Quản Lý Nhân Viên</h3> 
        <form action="" method="GET" class="row g-3 mb-4">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Nhập tên hoặc SĐT nhân viên" value="<?php echo e(request('search')); ?>">
            </div>
            <div class="col-md-auto">
                <button type="submit" class="btn btn-primary">Tìm Kiếm</button>
            </div>
            <div class="col-md-auto">
                <a href="<?php echo e(route('doctor.staff.create')); ?>" class="btn btn-success">Thêm Nhân Viên</a>
            </div>
        </form>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Họ Tên</th>
                    <th>Email</th>
                    <th>Số điện thoại</th>
                    <th>Vị trí</th>
                    <th>Trạng thái</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php if(isset($staffs)): ?>
                    <?php $__currentLoopData = $staffs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($staff->user->name ?? '---'); ?></td>
                            <td><?php echo e($staff->user->email ?? '---'); ?></td>
                            <td><?php echo e($staff->phone ?? '---'); ?></td>
                            <td><?php echo e($staff->position ?? '---'); ?></td>
                            <td>
                                <?php if($staff->status === 'Đang làm việc'): ?>
                                    <span class="badge bg-success text-dark">Hoạt động</span>
                                <?php else: ?>
                                    <span class="badge bg-danger text-dark">Không hoạt động</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="<?php echo e(route('doctor.staff.edit', $staff->id)); ?>" class="btn btn-warning btn-sm">Sửa</a>
                                <form action="<?php echo e(route('doctor.staff.destroy', $staff->id)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('doctor.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\phongkham\resources\views/doctor/pages/staff/index.blade.php ENDPATH**/ ?>