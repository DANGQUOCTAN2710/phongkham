

<?php $__env->startSection('content'); ?>
<!-- Main content -->
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div id="today-section" class="section">
        <h3 class="mb-3 text-center text-primary">Lịch Hẹn Tái Khám Hôm Nay</h3> 
        <form action="<?php echo e(route('doctor.today_schedule')); ?>" method="GET" class="row g-3 mb-4">
            <div class="col-md-4">
                <input type="text" name="cccd" class="form-control" placeholder="Nhập CCCD bệnh nhân" value="<?php echo e(request('cccd')); ?>">
            </div>
            <div class="col-md-auto">
                <button type="submit" class="btn btn-primary">Tìm Kiếm</button>
            </div>
        </form>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Họ Tên</th>
                    <th>CCCD</th>
                    <th>Ngày Hẹn</th>
                    <th>Trạng thái</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $todayAppointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e(($todayAppointments->currentPage() - 1) * $todayAppointments->perPage() + $key + 1); ?></td>
                        <td><?php echo e($appointment->patient->name); ?></td>
                        <td><?php echo e($appointment->patient->idUser); ?></td>
                        <td><?php echo e(\Carbon\Carbon::parse($appointment->revisit_date)->format('d/m/Y')); ?></td>
                        <td>
                            <?php if($appointment->status === 'Chờ tạo phiếu'): ?>
                                <span class="badge bg-warning">Chờ tạo phiếu</span>
                            <?php else: ?>
                                <span class="badge bg-success text-dark">Đã khám</span>
                            <?php endif; ?>
                        </td>
                         <td>
                            <div class="d-flex align-items-center gap-3" style="height: 100%;">
                                <!-- Nút tạo phiếu khám -->
                                <a href="<?php echo e(route('doctor.schedule.create', $appointment->id)); ?>" 
                                   class="btn btn-outline-primary rounded-circle shadow-sm d-flex justify-content-center align-items-center" 
                                   style="width: 44px; height: 44px;" 
                                   title="Tạo phiếu khám">
                                    <i class="bi bi-file-earmark-plus-fill" style="font-size: 20px;"></i>
                                </a>
                        
                                <!-- Nút hủy lịch hẹn -->
                                <form action="<?php echo e(route('schedule.destroy', $appointment->id)); ?>" method="POST" class="d-inline"
                                      onsubmit="return confirm('Bạn có chắc chắn muốn hủy lịch hẹn này?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" 
                                            class="btn btn-outline-danger rounded-circle shadow-sm d-flex justify-content-center align-items-center" 
                                            style="width: 44px; height: 44px;" 
                                            title="Hủy lịch hẹn">
                                        <i class="bi bi-x-circle-fill" style="font-size: 20px;"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <div class="mt-3 d-flex justify-content-center">
            <?php echo e($todayAppointments->links()); ?>

        </div>
    </div>
</main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('doctor.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\phongkham\resources\views/doctor/pages/schedule/today_list.blade.php ENDPATH**/ ?>