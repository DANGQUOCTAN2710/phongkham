

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h3 class="mb-4 text-primary">Chi tiết đơn thuốc #<?php echo e($prescription->id); ?></h3>

            <div class="row mb-4">
                <div class="col-md-6">
                    <p><strong>Bác sĩ:</strong> <?php echo e($prescription->doctor->user->name); ?></p>
                    <p><strong>Ngày tạo:</strong> <?php echo e($prescription->created_at->format('d/m/Y H:i')); ?></p>
                    <p><strong>Trạng thái:</strong> 
                        <span class="badge bg-<?php echo e($prescription->status == 'Đã gửi' ? 'success' : 'secondary'); ?>">
                            <?php echo e($prescription->status); ?>

                        </span>
                    </p>
                </div>
                <div class="col-md-6">
                    <p><strong>Ghi chú:</strong> <?php echo e($prescription->notes ?? '---'); ?></p>
                    <p><strong>Tổng tiền:</strong> 
                        <span class="text-danger fw-bold"><?php echo e(number_format($prescription->total_price)); ?> đ</span>
                    </p>
                </div>
            </div>

            <h5 class="mb-3">📋 Danh sách thuốc</h5>
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr class="text-center">
                            <th>#</th>
                            <th>Tên thuốc</th>
                            <th>Liều dùng</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $prescription->details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="text-center"><?php echo e($index + 1); ?></td>
                                <td><?php echo e($detail->medicine->name); ?></td>
                                <td><?php echo e($detail->dosage); ?></td>
                                <td class="text-center"><?php echo e($detail->quantity); ?></td>
                                <td class="text-end text-danger"><?php echo e($detail->total_price); ?> đ</td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

            <a href="<?php echo e(route('prescription')); ?>" class="btn btn-secondary mt-3">
                <i class="bi bi-arrow-left"></i> Quay lại danh sách
            </a>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\phongkham\resources\views/admin/layouts/pages/prescription/details.blade.php ENDPATH**/ ?>