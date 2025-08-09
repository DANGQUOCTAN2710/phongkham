

<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow rounded-4 overflow-hidden">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Cập Nhật Thông Tin Cá Nhân</h5>
                </div>
                <div class="card-body">
                    <?php if(session('success')): ?>
                        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
                    <?php endif; ?>
                    
                    <form action="<?php echo e(route('profile.update')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="mb-3">
                            <label for="name" class="form-label">Họ và tên</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo e(old('name', $user->name)); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo e(old('email', $user->email)); ?>" required>
                        </div>

                        <!-- Sửa nhãn thành Giới tính -->
                        <div class="mb-3">
                            <label for="gender" class="form-label">Giới tính</label>
                            <input type="text" class="form-control" id="gender" name="gender" value="<?php echo e(old('gender', $user->gender)); ?>">
                        </div>

                        <!-- Thêm trường phone -->
                        <div class="mb-3">
                            <label for="phone" class="form-label">Số điện thoại</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="<?php echo e(old('phone', ($doctor->phone ?? $staff->phone ?? ''))); ?>">
                        </div>

                        <!-- Thêm trường address -->
                        <div class="mb-3">
                            <label for="address" class="form-label">Địa chỉ</label>
                            <input type="text" class="form-control" id="address" name="address" value="<?php echo e(old('address',  ($doctor->address ?? $staff->address ?? ''))); ?>">
                        </div>

                        <div class="mb-3">
                            <label for="birthday" class="form-label">Ngày sinh</label>
                            <input type="date" class="form-control" id="birthday" name="birthday" value="<?php echo e(old('birthday', $user->dob)); ?>">
                        </div>

                        <div class="mb-3">
                            <label for="age" class="form-label">Tuổi</label>
                            <input type="text" class="form-control" id="age" name="age" value="<?php echo e(old('age', $user->age)); ?>" readonly>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="<?php echo e(url()->previous()); ?>" class="btn btn-secondary">Quay về</a>
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('doctor.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\phongkham\resources\views/doctor/pages/profile/edit.blade.php ENDPATH**/ ?>