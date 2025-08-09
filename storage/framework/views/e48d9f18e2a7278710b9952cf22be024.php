

<?php $__env->startSection('content'); ?>
<main class="col-md-10 ms-sm-auto px-md-4">
    <h2 class="my-3 text-center text-primary">Danh Sách Bác Sĩ</h2>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <!-- Tìm kiếm -->
    <div class="card p-3 mb-3">
        <form method="GET" action="">
            <div class="row">
                <div class="col-md-4 mb-2">
                    <input type="text" class="form-control" name="search" placeholder="Nhập tên của bác sĩ..." value="<?php echo e(request()->search); ?>">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Tìm kiếm</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Danh sách bác sĩ -->
    <div class="card p-3">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Mã Bác Sĩ</th>
                    <th>Họ và Tên</th>
                    <th>Email</th>
                    <th>Giới tính</th>
                    <th>Tuổi</th>
                    <th>Vị trí</th>
                    <th>Chuyên Khoa</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $doctors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doctor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($doctor->id); ?></td>
                        <td><?php echo e($doctor->user->name); ?></td>
                        <td><?php echo e($doctor->user->email); ?></td>
                        <td><?php echo e($doctor->user->gender); ?></td>
                        <td><?php echo e($doctor->user->age); ?></td>
                        <td><?php echo e($doctor->type); ?></td>
                        <td><?php echo e($doctor->specialties); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</main>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('doctor.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\phongkham\resources\views/doctor/pages/doctor/list_doctor.blade.php ENDPATH**/ ?>