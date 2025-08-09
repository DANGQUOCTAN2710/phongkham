

<?php $__env->startSection('content'); ?>
<main class="col-md-10 ms-sm-auto px-md-4">
    <h2 class="my-3 text-center text-primary">Danh Sách Bệnh Nhân Khám</h2>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <!-- Tìm kiếm -->
    <div class="card p-3 mb-3">
        <form method="GET" action="<?php echo e(route('doctor.lab')); ?>">
            <div class="d-flex align-items-end gap-3 w-100">
                <div class="flex-grow-1" style="max-width: 300px;">
                    <input type="text" class="form-control" name="search" placeholder="Tìm kiếm theo tên, CCCD, SĐT..." 
                        value="<?php echo e(request('search')); ?>">
                </div>
                <div>
                    <button type="submit" class="btn btn-primary px-4">Tìm kiếm</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Danh sách bệnh nhân chờ cận lâm sàng -->
    <div class="card p-3">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Họ và Tên</th>
                    <th>CCCD</th>
                    <th>Số Điện Thoại</th>
                    <th>Giới tính</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $clinicalTestOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($key->medicalRecord->medicalBook->patient->name); ?></td>
                    <td><?php echo e($key->medicalRecord->medicalBook->patient->idUser); ?></td>
                    <td><?php echo e($key->medicalRecord->medicalBook->patient->phone); ?></td>
                    <td><?php echo e($key->medicalRecord->medicalBook->patient->gender); ?></td>
                    <td><?php echo e($key->status); ?></td>
                    <td class="text-center align-middle">
                        <div class="d-flex gap-2">
                            <!-- Nút Bắt đầu thực hiện cận lâm sàng -->
                            <a href="<?php echo e(route('lab.show1', $key->id)); ?>" class="btn btn-success btn-sm d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; padding: 0;">
                                <i class="fas fa-vials"></i>
                            </a>
                            <!-- Nút Xóa -->
                            <form action="" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-danger btn-sm d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; padding: 0;">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('doctor.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\phongkham\resources\views/doctor/pages/lab_exam/list_lab1.blade.php ENDPATH**/ ?>