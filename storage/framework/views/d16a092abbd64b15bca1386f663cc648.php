

<?php $__env->startSection('content'); ?>
<div class="container">
    <h2>Danh sách thuốc</h2>

    <div class="mb-3 d-flex justify-content-between">
        <div>
            <a href="<?php echo e(route('medicines.create')); ?>" class="btn btn-primary">Thêm Thuốc</a>

            <!-- Nút mở Modal -->
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#importModal">
                Nhập Excel
            </button>
        </div>

        <!-- Form tìm kiếm -->
        <form action="<?php echo e(route('medicines.index')); ?>" method="GET" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Tìm theo tên thuốc..." value="<?php echo e(request('search')); ?>">
            <button type="submit" class="btn btn-outline-primary">Tìm</button>
        </form>
    </div>
    <!-- Modal nhập Excel -->
    <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="importModalLabel">Nhập dữ liệu từ Excel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?php echo e(route('medicines.import')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <input type="file" name="file" accept=".xls,.xlsx" class="form-control" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-success">Tải lên</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success mt-3">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Tên thuốc</th>
                <th>Thành phần</th>
                <th>Nơi sản xuất</th>
                <th>Hàm lượng</th>
                <th>Đơn vị</th>
                <th>Giá</th>
                <th>Tồn kho</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $medicines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $medicine): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($medicine->name); ?></td>
                    <td><?php echo e($medicine->ingredient); ?></td>
                    <td><?php echo e($medicine->manufacturer); ?></td>
                    <td><?php echo e($medicine->dosage); ?></td>
                    <td><?php echo e($medicine->unit); ?></td>
                    <td><?php echo e(number_format($medicine->price, 2)); ?> VNĐ</td>
                    <td><?php echo e($medicine->stock); ?></td>
                    <td>
                        <span class="badge <?php echo e($medicine->status == 'Còn hàng' ? 'bg-success' : 'bg-danger'); ?>">
                            <?php echo e($medicine->status); ?>

                        </span>
                    </td>
                    <td>
                        <a href="<?php echo e(route('medicines.edit', $medicine->id)); ?>" class="btn btn-warning">Sửa</a>
                        <form action="<?php echo e(route('medicines.destroy', $medicine->id)); ?>" method="POST" style="display:inline-block;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    <?php echo e($medicines->links('pagination::bootstrap-5')); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\phongkham\resources\views/admin/layouts/pages/medicines/index.blade.php ENDPATH**/ ?>