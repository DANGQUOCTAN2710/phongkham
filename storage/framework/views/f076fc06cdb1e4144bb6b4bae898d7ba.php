

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h3 class="mb-4">Chi tiết Đăng Ký Phòng Khám</h3>

    <div class="row">
        
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header bg-info text-white">Thông tin Bác sĩ</div>
                <div class="card-body">
                    <p><strong>Họ tên:</strong> <?php echo e($registrationForm->doctor->user->name ?? 'Không xác định'); ?></p>
                    <p><strong>Email:</strong> <?php echo e($registrationForm->doctor->user->email ?? 'Không có'); ?></p>
                    <p><strong>SĐT:</strong> <?php echo e($registrationForm->doctor->phone ?? 'Không có'); ?></p>
                    <p><strong>Địa chỉ:</strong> <?php echo e($registrationForm->doctor->address ?? 'Không có'); ?></p>
                    <p><strong>Giới tính:</strong> <?php echo e($registrationForm->doctor->user->gender ?? 'Không rõ'); ?></p>
                    <p><strong>Ngày sinh:</strong> <?php echo e(\Carbon\Carbon::parse($registrationForm->doctor->user->dob)->format('d/m/Y') ?? 'Không có'); ?></p>
                    <p><strong>Chuyên môn:</strong> <?php echo e($registrationForm->doctor->specialties ?? 'Không có'); ?></p>
                    <p><strong>Vị trí:</strong> <?php echo e($registrationForm->doctor->type ?? 'Không có'); ?></p>
                    <p><strong>Chứng chỉ:</strong> <?php echo e($registrationForm->doctor->license_number ?? 'Không có'); ?></p>
                </div>
            </div>
        </div>

        
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">Thông tin Phòng Khám</div>
                <div class="card-body">
                    <p><strong>Tên phòng khám:</strong> <?php echo e($registrationForm->clinic->name); ?></p>
                    <p><strong>Số lượng bác sĩ theo loại: <i>(Mỗi phòng khám chỉ có <u>5</u> bác sĩ ĐIỀU TRỊ và <u>2</u> bác sĩ CẬN LÂM SÀNG)</i></strong></p>
                    <ul>
                        <?php $__currentLoopData = $doctorCountsByType; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type => $count): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($type); ?>: <?php echo e($count); ?> bác sĩ</li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                    <p><strong>Địa chỉ:</strong> <?php echo e($registrationForm->clinic->address); ?></p>
                    <p><strong>Số điện thoại:</strong> <?php echo e($registrationForm->clinic->phone); ?></p>
                    <hr>
                    <p><strong>Chủ phòng khám:</strong> <?php echo e($registrationForm->clinic->user->name ?? 'Không có'); ?></p>
                    <p><strong>Email chủ phòng khám:</strong> <?php echo e($registrationForm->clinic->user->email ?? 'Không có'); ?></p>
                </div>
            </div>
        </div>
    </div>

    
    <div class="mb-3">
        <p><strong>Trạng thái đăng ký:</strong>
            <span class="badge bg-<?php echo e($registrationForm->status == 'Đã duyệt' ? 'success' : ($registrationForm->status == 'Bị từ chối' ? 'danger' : 'warning')); ?>">
                <?php echo e($registrationForm->status); ?>

            </span>
        </p>
        <p><strong>Ghi chú:</strong> <?php echo e($registrationForm->note ?? 'Không có'); ?></p>
    </div>

    <?php if(in_array($registrationForm->status, ['Chờ duyệt', 'Xin chuyển viện'])): ?>
        <form action="<?php echo e(route('registrationforms.approve', $registrationForm->id)); ?>" method="POST" class="d-inline-block me-2">
            <?php echo csrf_field(); ?>
            <button type="submit" class="btn btn-success">
                <i class="bi bi-check-circle"></i> Duyệt
            </button>
        </form>

        <form action="<?php echo e(route('registrationforms.reject', $registrationForm->id)); ?>" method="POST" class="d-inline-block">
            <?php echo csrf_field(); ?>
            <button type="submit" class="btn btn-danger">
                <i class="bi bi-x-circle"></i> Từ chối
            </button>
        </form>
    <?php endif; ?>

    <a href="<?php echo e(url()->previous()); ?>" class="btn btn-secondary ms-3">
        <i class="bi bi-arrow-left"></i> Quay lại
    </a>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\phongkham\resources\views/admin/layouts/pages/approve/details.blade.php ENDPATH**/ ?>