

<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <h2 class="mb-4 text-primary fw-bold">Chi tiết Bệnh nhân: <?php echo e($patient->name); ?></h2>

    <div class="row">
        <!-- Thông tin bệnh nhân -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Thông tin Bệnh nhân</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless mb-0">
                        <tbody>
                            <tr>
                                <th class="text-secondary" style="width: 40%;">Họ tên</th>
                                <td><?php echo e($patient->name); ?></td>
                            </tr>
                            <tr>
                                <th class="text-secondary">Số điện thoại</th>
                                <td><?php echo e($patient->phone); ?></td>
                            </tr>
                            <tr>
                                <th class="text-secondary">CCCD</th>
                                <td><?php echo e($patient->idUser); ?></td>
                            </tr>
                            <tr>
                                <th class="text-secondary">Địa chỉ</th>
                                <td><?php echo e($patient->address); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Sổ bệnh -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Sổ bệnh</h5>
                </div>
                <div class="card-body">
                    <?php if($patient->medicalBook): ?>
                        <table class="table table-borderless mb-0">
                            <tbody>
                                <tr>
                                    <th class="text-secondary" style="width: 40%;">Tiền sử bệnh</th>
                                    <td><?php echo e($patient->medicalBook->medical_history ?? 'Chưa có'); ?></td>
                                </tr>
                                <tr>
                                    <th class="text-secondary">Dị ứng</th>
                                    <td><?php echo e($patient->medicalBook->allergies ?? 'Chưa có'); ?></td>
                                </tr>
                                <tr>
                                    <th class="text-secondary">Tiền sử gia đình</th>
                                    <td><?php echo e($patient->medicalBook->family_history ?? 'Chưa có'); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p class="text-muted fst-italic">Chưa có sổ bệnh.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Danh sách các lần khám -->
    <div class="card shadow-sm">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0">Danh sách các lần khám</h5>
        </div>
        <div class="card-body p-0">
            <?php if($medicalRecords->count() > 0): ?>
                <table class="table table-striped mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Ngày khám</th>
                            <th>Phòng khám</th>
                            <th>Lý do khám</th>
                            <th>Chẩn đoán</th>
                            <th>Bác sĩ</th>
                            <th>Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $medicalRecords; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e(\Carbon\Carbon::parse($record->exam_date)->format('d/m/Y')); ?></td>
                                <td><?php echo e($record->clinic->name ?? 'N/A'); ?></td>
                                <td><?php echo e($record->reason ??  'N/A'); ?></td>
                                <td><?php echo e($record->main_disease ??  'N/A'); ?></td>
                                <td><?php echo e($record->doctor->user->name ?? 'N/A'); ?></td>
                                <td>
                                    <?php
                                        $statusClasses = [
                                            'chờ khám' => 'badge bg-secondary',
                                            'đang khám' => 'badge bg-primary',
                                            'chờ CLS' => 'badge bg-warning text-dark',
                                            'đã CLS' => 'badge bg-info text-dark',
                                            'đã khám' => 'badge bg-success',
                                        ];
                                    ?>
                                    <span class="<?php echo e($statusClasses[$record->status] ?? 'badge bg-light text-dark'); ?>">
                                        <?php echo e($record->status); ?>

                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <div class="mt-3 mx-3">
                    <?php echo e($medicalRecords->links()); ?>

                </div>
            <?php else: ?>
                <p class="m-3 text-muted fst-italic">Chưa có lần khám nào.</p>
            <?php endif; ?>
        </div>
    </div>

    <a href="<?php echo e(route('patients.index')); ?>" class="btn btn-outline-primary mt-3">
        <i class="fas fa-arrow-left me-2"></i> Quay lại danh sách
    </a>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\phongkham\resources\views/admin/layouts/pages/patients/details.blade.php ENDPATH**/ ?>