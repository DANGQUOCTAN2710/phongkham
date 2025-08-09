

<?php $__env->startSection('content'); ?>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <h2 class="mb-3 mt-3">Quản Lý Danh Sách Bệnh Nhân</h2>
        
        <!-- Bộ lọc trạng thái -->
        <form method="GET" class="d-flex align-items-end mb-3 gap-3">
            <div class="flex-fill">
                <label for="filter-status" class="form-label">Lọc theo trạng thái:</label>
                <select id="filter-status" class="form-select w-100">
                    <option value="Tất cả">Tất cả</option>
                    <option value="chờ khám">Chờ khám</option>
                    <option value="chờ CLS">Chờ CLS</option>
                    <option value="đang khám">Đang khám</option>
                    <option value="đã khám">Đã khám</option>
                    <option value="đã CLS">Đã CLS</option>
                </select>
            </div>
            <div class="flex-fill d-flex align-items-end gap-2">
                <div class="flex-fill">
                    <label for="filter-date" class="form-label">Lọc theo ngày:</label>
                    <input type="date" id="filter-date" name="date" class="form-control w-100" value="<?php echo e($dateFilter); ?>">
                </div>
                <button type="submit" class="btn btn-primary mb-1">Lọc</button>
            </div>
        </form>


        <!-- Danh sách bệnh nhân -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Tên bệnh nhân</th>
                    <th>Bác sĩ phụ trách</th>
                    <th>Phòng khám</th>
                    <th>Lý do khám</th>
                    <th>Trạng thái</th>
                    <?php if(Auth::user()->isClinicOwner()): ?>
                        <th>Hành động</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody id="patient-list">
                <?php $__currentLoopData = $medicalRecords; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr data-status="<?php echo e($record->status); ?>">
                        <td><?php echo e($record->medicalBook->patient->name); ?></td>
                        <td><?php echo e($record->doctor->user->name); ?></td>
                        <td><?php echo e($record->clinic->name ?? 'N/A'); ?></td>
                        <td><?php echo e($record->reason); ?></td>
                        <td><?php echo e($record->status); ?></td>
                        <?php if(Auth::user()->isClinicOwner()): ?>
                            <td>
                                <!-- Nút xóa với xác nhận -->
                                <form action="<?php echo e(route('doctor.patient.destroy', $record->id)); ?>" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa bệnh nhân này?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                                </form>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <?php echo e($medicalRecords->links()); ?>

    </main>
    <script>
        document.getElementById('filter-status').addEventListener('change', function() {
            let selectedStatus = this.value;
            let rows = document.querySelectorAll('#patient-list tr');
            
            rows.forEach(row => {
                if (selectedStatus === 'Tất cả' || row.getAttribute('data-status') === selectedStatus) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('doctor.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\phongkham\resources\views/doctor/patient.blade.php ENDPATH**/ ?>