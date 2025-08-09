

<?php $__env->startSection('content'); ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="container">
        <h2 class="mt-3">Thêm Nhân Viên</h2>

        <form action="<?php echo e(route('doctor.staff.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="row">
                <!-- Cột trái -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Họ Tên</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Mật Khẩu</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Giới Tính</label>
                        <select name="gender" class="form-select" required>
                            <option value="Nam">Nam</option>
                            <option value="Nữ">Nữ</option>
                            <option value="Khác">Khác</option>
                        </select>
                    </div>
                </div>

                <!-- Cột phải -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Chức Vụ</label>
                        <select name="position" class="form-select" required>
                            <option value="Tiếp đón">Tiếp đón</option>
                            <option value="Cấp thuốc">Cấp thuốc</option>
                            <option value="Kế toán">Kế toán</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Số Điện Thoại</label>
                        <input type="text" name="phone" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Ngày Sinh</label>
                        <input type="date" name="dob" class="form-control" required>
                    </div>
                </div>
            </div>

            <!-- Nút -->
            <div class="d-flex justify-content-between mt-3">
                <button type="submit" class="btn btn-success">Lưu</button>
                <a href="<?php echo e(route('staff.getList')); ?>" class="btn btn-secondary">Quay lại</a>
            </div>
        </form>
    </div>
</main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('doctor.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\phongkham\resources\views/doctor/pages/staff/create.blade.php ENDPATH**/ ?>