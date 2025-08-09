

<?php $__env->startSection('content'); ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="container">
        <h2 class="mt-3">Cập Nhật Nhân Viên</h2>

        <form action="<?php echo e(route('doctor.staff.update', $staff->id)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="row">
                <!-- Cột trái -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Họ Tên</label>
                        <input type="text" name="name" class="form-control" required value="<?php echo e(old('name', $staff->user->name ?? '')); ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required value="<?php echo e(old('email', $staff->user->email ?? '')); ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Mật Khẩu (bỏ trống nếu không đổi)</label>
                        <input type="password" name="password" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Giới Tính</label>
                        <select name="gender" class="form-select" required>
                            <option value="Nam" <?php echo e(old('gender', $staff->user->gender) == 'Nam' ? 'selected' : ''); ?>>Nam</option>
                            <option value="Nữ" <?php echo e(old('gender', $staff->user->gender) == 'Nữ' ? 'selected' : ''); ?>>Nữ</option>
                            <option value="Khác" <?php echo e(old('gender', $staff->user->gender) == 'Khác' ? 'selected' : ''); ?>>Khác</option>
                        </select>
                    </div>
                </div>

                <!-- Cột phải -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Chức Vụ</label>
                        <select name="position" class="form-select" required>
                            <option value="Tiếp đón" <?php echo e(old('position', $staff->position) == 'Tiếp đón' ? 'selected' : ''); ?>>Tiếp đón</option>
                            <option value="Cấp thuốc" <?php echo e(old('position', $staff->position) == 'Cấp thuốc' ? 'selected' : ''); ?>>Cấp thuốc</option>
                            <option value="Kế toán" <?php echo e(old('position', $staff->position) == 'Kế toán' ? 'selected' : ''); ?>>Kế toán</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Số Điện Thoại</label>
                        <input type="text" name="phone" class="form-control" value="<?php echo e(old('phone', $staff->phone ?? '')); ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Ngày Sinh</label>
                        <input type="date" name="dob" class="form-control" required value="<?php echo e(old('dob', $staff->user->dob ?? '')); ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Trạng Thái</label>
                        <select name="status" class="form-select" required>
                            <option value="Đang làm việc" <?php echo e(old('status', $staff->status) == 'Đang làm việc' ? 'selected' : ''); ?>>Hoạt động</option>
                            <option value="Tạm nghỉ" <?php echo e(old('status', $staff->status) == 'Tạm nghỉ' ? 'selected' : ''); ?>>Tạm nghỉ</option>
                            <option value="Đã nghỉ việc" <?php echo e(old('status', $staff->status) == 'Đã nghỉ việc' ? 'selected' : ''); ?>>Đã nghỉ việc</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Nút -->
            <div class="d-flex justify-content-between mt-3">
                <button type="submit" class="btn btn-primary">Cập Nhật</button>
                <a href="<?php echo e(route('staff.getList')); ?>" class="btn btn-secondary">Quay lại</a>
            </div>
        </form>
    </div>
</main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('doctor.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\phongkham\resources\views/doctor/pages/staff/edit.blade.php ENDPATH**/ ?>