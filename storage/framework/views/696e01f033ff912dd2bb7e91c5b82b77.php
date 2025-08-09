

<?php $__env->startSection('content'); ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <h2 class="mt-3">Tổng Quan</h2>
    <form method="GET" class="mb-3">
        <label for="date" class="form-label">Chọn ngày:</label>
        <input type="date" id="date" name="date" class="form-control" 
            value="<?php echo e(old('date', $dateFilter ?? now()->toDateString())); ?>" 
            onchange="this.form.submit()">
    </form>
    <p class="text-muted">Tổng số lượt khám: <?php echo e($total_today); ?></p>
    <div class="row">
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Chờ Khám</div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo e($waiting); ?></h5>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-header">Đang Khám</div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo e($examining); ?></h5>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Đã Khám</div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo e($examined); ?></h5>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-danger mb-3">
                <div class="card-header">Cận Lâm Sàng</div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo e($clinical); ?></h5>
                </div>
            </div>
        </div>
    </div>

    <!-- Danh sách tất cả bệnh nhân chờ khám -->
    <h3>Danh Sách Bệnh Nhân</h3>

    <?php if(isset($waitingPatients) && $waitingPatients->count()): ?>
        <div style="max-height: 400px; overflow-y: auto;" class="border rounded p-2">
            <table class="table table-striped mb-0">
                <thead class="table-light sticky-top">
                    <tr>
                        <th>STT</th>
                        <th>Họ Tên</th>
                        <th>Tuổi</th>
                        <th>Trạng Thái</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $waitingPatients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($index + 1); ?></td>
                            <td><?php echo e($record->patient->name); ?></td>
                            <td><?php echo e($record->patient->age); ?></td>
                            <td><?php echo e(ucfirst($record->status)); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p class="text-muted">Không có bệnh nhân nào chờ khám.</p>
    <?php endif; ?>
</main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('doctor.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\phongkham\resources\views/doctor/dashboard.blade.php ENDPATH**/ ?>