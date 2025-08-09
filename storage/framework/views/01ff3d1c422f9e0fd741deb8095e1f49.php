

<?php $__env->startSection('content'); ?>
    <div class="container">
        <h2>Danh sách bác sĩ</h2>
        <a href="<?php echo e(route('doctors.create')); ?>" class="btn btn-primary mb-3">
            <i class="fas fa-user-plus"></i> Thêm Bác Sĩ
        </a>
        
        <form method="GET" action="<?php echo e(route('doctors.index')); ?>" class="mb-3">
            <div class="row">
                <div class="col-md-3">
                    <select name="clinic_id" class="form-control select2" onchange="this.form.submit()">
                        <option value="">Tất cả phòng khám</option>
                        <?php $__currentLoopData = $clinics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $clinic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($clinic->id); ?>" <?php echo e(request('clinic_id') == $clinic->id ? 'selected' : ''); ?>>
                                <?php echo e($clinic->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="specialization" class="form-control select2" onchange="this.form.submit()">
                        <option value="">Tất cả chuyên môn</option>
                        <?php
                            $specializations = [
                                "Nội khoa", "Ngoại khoa", "Nhi khoa", "Tai - Mũi - Họng",
                                "Răng - Hàm - Mặt", "Ung bướu", "Tim mạch", "Da liễu", 
                                "Chấn thương chỉnh hình", "Hô hấp", "Nội tiết - Đái tháo đường",
                                "Thận - Tiết niệu", "Mắt", "Huyết học"];
                        ?>
                        
                        <?php $__currentLoopData = $specializations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $specialization): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($specialization); ?>" <?php echo e(request('specialization') == $specialization ? 'selected' : ''); ?>>
                                <?php echo e($specialization); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <input type="text" name="search" value="<?php echo e(request('search')); ?>" class="form-control"
                        placeholder="Tìm theo tên bác sĩ..." onchange="this.form.submit()">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-secondary w-100">Lọc</button>
                </div>
            </div>
        </form>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Họ Tên</th>
                    <th>Email</th>
                    <th>SĐT</th>
                    <th>Địa chỉ</th>
                    <th>Chuyên Môn</th>
                    <th>Vị trí</th>
                    <th>Nơi Công Tác</th>
                    <th>Trạng Thái</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $doctors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doctor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($doctor->user->name); ?></td>
                        <td><?php echo e($doctor->user->email); ?></td>
                        <td><?php echo e($doctor->phone ?? '-'); ?></td>
                        <td><?php echo e($doctor->address ?? '-'); ?></td>
                        <td><?php echo e($doctor->specialties); ?></td>
                        <td><?php echo e($doctor->type); ?></td>
                        <?php if($doctor->status == 'Chưa đăng ký'): ?>
                            <td>Trống</td>
                            <td>
                                <span class="badge bg-warning">Chưa đăng ký</span>
                            </td>
                        <?php elseif($doctor->status == 'Bị từ chối'): ?>
                            <td>Trống</td>
                            <td>
                                <span class="badge bg-danger">Bị từ chối</span>
                            </td>
                        <?php elseif($doctor->status == 'Chờ duyệt'): ?>
                            <td>Chờ duyệt</td>
                            <td>
                                <span class="badge bg-warning">Chờ duyệt</span>
                            </td>
                        <?php else: ?>
                            <td><?php echo e($doctor->clinic?->name ?? 'Trống'); ?></td>
                            <td>
                                <span class="badge bg-success">Đã duyệt</span>
                            </td>
                        <?php endif; ?>

                        <td>
                            <a href="<?php echo e(route('doctors.edit', $doctor->id)); ?>" class="btn btn-warning">Sửa</a>
                            <form action="<?php echo e(route('doctors.destroy', $doctor->id)); ?>" method="POST" style="display:inline-block;">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa bác sĩ này?')">Xóa</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    <?php echo e($doctors->links('pagination::bootstrap-5')); ?>

    </div>

<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Chọn một tùy chọn",
            allowClear: true
        });
    });
</script>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Nhúng thư viện Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\phongkham\resources\views/admin/layouts/pages/doctors/index.blade.php ENDPATH**/ ?>