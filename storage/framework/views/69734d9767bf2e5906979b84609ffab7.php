

<?php $__env->startSection('content'); ?>
<section id="transfer-clinic" class="appointment-section d-flex justify-content-center align-items-center bg-light"
    style="min-height: calc(100vh - 140px);">
    <div class="container" style="max-width: 700px;">
        <div class="card shadow-lg p-4 border-0 rounded-4">
            <h2 class="text-center mb-4 text-primary">🛫 Chuyển Phòng Khám</h2>

            <?php if(session('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo e(session('success')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Đóng"></button>
                </div>
            <?php endif; ?>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">👤 Họ và Tên</label>
                    <input type="text" class="form-control bg-light" value="<?php echo e(Auth::user()->name); ?>" readonly>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">📧 Email</label>
                    <input type="email" class="form-control bg-light" value="<?php echo e(Auth::user()->email); ?>" readonly>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">🏥 Phòng Khám Hiện Tại</label>
                <input type="text" class="form-control bg-light" value="<?php echo e(Auth::user()->doctor->clinic->name ?? 'Chưa có'); ?>" readonly>
            </div>

            <form method="POST" action="<?php echo e(route('doctor.saveChangeClinic')); ?>">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <div class="mb-3">
                    <label for="clinic_id" class="form-label fw-semibold">🔁 Chọn Phòng Khám Muốn Chuyển Đến</label>
                    <select name="clinic_id" id="clinic_id" class="form-select">
                        <option value="">-- Chọn phòng khám --</option>
                        <?php $__currentLoopData = $clinics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $clinic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($clinic->id); ?>"><?php echo e($clinic->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="message" class="form-label fw-semibold">📝 Ghi Chú</label>
                    <textarea name="message" id="message" class="form-control" rows="4" placeholder="Nhập nội dung ghi chú..."><?php echo e(old('message')); ?></textarea>
                </div>
                <div class="mb-4">
                    <a href="<?php echo e(url()->previous()); ?>" class="btn btn-secondary btn-sm">
                        ← Quay lại
                    </a>
                </div>
                <button type="submit" class="btn btn-warning w-100 fw-bold shadow-sm">
                    🚀 Gửi Yêu Cầu Chuyển
                </button>
            </form> 
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('doctor.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\phongkham\resources\views/doctor/pages/profile/changeClinic.blade.php ENDPATH**/ ?>