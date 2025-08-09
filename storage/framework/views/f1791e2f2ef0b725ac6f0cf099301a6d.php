

<?php $__env->startSection('content'); ?>
<main class="col-md-10 ms-sm-auto px-md-4">
    <h2 class="my-3 text-center text-primary">Danh Sách Đơn Thuốc</h2>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <!-- Tìm kiếm -->
    <div class="card p-3 mb-3">
        <form method="GET" action="<?php echo e(route('doctor.list_prescription')); ?>">
            <div class="row">
                <div class="col-md-4 mb-2">
                    <input type="text" class="form-control" name="search" placeholder="Tìm kiếm theo tên, CCCD, SĐT..." value="<?php echo e(request()->search); ?>">
                </div>
                <div class="col-md-3 mb-2">
                    <select name="filter" class="form-select" onchange="this.form.submit()">
                        <option value="">Tất cả</option>
                        <option value="today" <?php echo e(request('filter') == 'today' ? 'selected' : ''); ?>>Hôm nay</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Tìm kiếm</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Danh sách đơn thuốc -->
    <div class="card p-3">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Mã Đơn</th>
                    <th>Tên Bệnh Nhân</th>
                    <th>CCCD</th>
                    <th>Số Điện Thoại</th>
                    <th>Ngày Tạo</th>
                    <th>Tổng Tiền</th>
                    <th>Bác sĩ ra đơn</th>
                    <th>Trạng Thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $prescriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prescription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <input type="text" class="form-control" name="patient_id" value="<?php echo e($prescription->medicalRecord->medicalBook->patient->id ?? ''); ?>" hidden>
                        <input type="text" class="form-control" name="patient_diagnosis" value="<?php echo e($prescription->medicalRecord->diagnosis ?? 'Chưa đặt'); ?>" hidden>
                        <input type="text" class="form-control" name="patient_examDate" value="<?php echo e($prescription->medicalRecord->exam_date ?? 'N/A'); ?>" hidden>
                        <input type="text" class="form-control" name="patient_age" value="<?php echo e($prescription->medicalRecord->medicalBook->patient->age ?? 'N/A'); ?>" hidden>
                        <input type="text" class="form-control" name="patient_gender" value="<?php echo e($prescription->medicalRecord->medicalBook->patient->gender ?? 'N/A'); ?>" hidden>
                        <td><?php echo e($prescription->id); ?></td>
                        <td id="patient_name"><?php echo e(optional($prescription->medicalRecord->medicalBook->patient)->name); ?></td>
                        <td id="patient_idUser"><?php echo e(optional($prescription->medicalRecord->medicalBook->patient)->idUser); ?></td>
                        <td id="patient_phone"><?php echo e(optional($prescription->medicalRecord->medicalBook->patient)->phone); ?></td>
                        <td><?php echo e(\Carbon\Carbon::parse($prescription->created_at)->format('d/m/Y')); ?></td>
                        <td><?php echo e(number_format($prescription->total_price, 0, ',', '.')); ?> đ</td>
                        <td><?php echo e($prescription->doctor->user->name); ?></td>
                        <td>
                            <?php if($prescription->status == 'Đã duyệt'): ?>
                                <span class="text-success">Đã duyệt</span>
                            <?php else: ?>
                                <span class="text-danger">Chưa duyệt</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-center align-middle">
                            <div class="d-flex gap-1 justify-content-center">
                                <a href="javascript:void(0)" 
                                class="btn btn-info btn-lg d-flex align-items-center justify-content-center view-detail"
                                onclick="openMedicineModal('<?php echo e($prescription->id); ?>')"> 
                                    <i class="fas fa-eye"></i>
                                </a>
                                <!-- Nút xác nhận cấp phát thuốc -->
                                <?php if($prescription->status != 'Đã duyệt'): ?>
                                
                                    <form action="<?php echo e(route('prescription.approve', $prescription ->id)); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PUT'); ?>
                                        <button type="submit" class="btn btn-success btn-lg d-flex align-items-center justify-content-center">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </div>
                            <?php echo $__env->make('doctor.pages.prescription.review', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <?php echo e($prescriptions->links('pagination::bootstrap-5')); ?>

    </div>
</main>

<script>
    function populateMedicineModal(patientData) {
        document.getElementById("modal_patient_id").textContent = patientData.id || "";
        document.getElementById("modal_patient_name").textContent = patientData.name || "";
        document.getElementById("modal_patient_age").textContent = patientData.age || "";
        document.getElementById("modal_patient_gender").textContent = patientData.gender || "";
        document.getElementById("modal_exam_date").textContent = patientData.examDate || "";
        document.getElementById("modal_diagnosis").textContent = patientData.diagnosis || "";
        
        let medicineListDisplay = document.getElementById("medicineListDisplay");
        if (medicineListDisplay) {
            medicineListDisplay.innerHTML = ""; // Xóa dữ liệu cũ
        } else {
            console.error("Không tìm thấy phần tử với id='medicineListDisplay'");
        }

        if (patientData.medicines && patientData.medicines.length > 0) {
            patientData.medicines.forEach((medicine, index) => {
                // Lấy giá trị của các checkbox đã được chọn trong trường hợp 'usage' cần phải lấy từ checkbox
                let usage = medicine.usage || "Không xác định"; // Nếu không có usage thì hiển thị "Không xác định"
                let row = `<tr>
                    <td class='text-center'>${index + 1}</td>
                    <td>${medicine.name}</td>
                    <td>${medicine.dosage}</td>
                    <td class='text-center'>${medicine.quantity}</td>
                    <td>${usage}</td>
                </tr>`;
                medicineListDisplay.innerHTML += row;
            });
        } else {
            medicineListDisplay.innerHTML = "<tr><td colspan='5' class='text-center text-muted'>Không có dữ liệu thuốc</td></tr>";
        }
    }

    function openMedicineModal(id) {
        fetch(`/doctor/prescription/${id}`)
            .then(response => response.json())
            .then(result => {
                const medicines = result.data || [];

                function getValue(selector, defaultValue = "N/A") {
                    let element = document.querySelector(selector);
                    return element ? element.value : defaultValue;
                }

                let patientData = {
                    id: getValue("input[name='patient_id']"),
                    name: document.getElementById("patient_name")?.textContent || "N/A",
                    age: getValue("input[name='patient_age']"),
                    gender: getValue("input[name='patient_gender']"),
                    examDate: getValue("input[name='patient_examDate']"),
                    diagnosis: getValue("input[name='patient_diagnosis']", "Chưa có"),
                    medicines: medicines,
                };

                console.log("Patient Data:", patientData);
                populateMedicineModal(patientData);

                let medicineModal = new bootstrap.Modal(document.getElementById('medicineModal'));
                medicineModal.show();
            })
            .catch(error => {
                console.error("Lỗi khi tải thông tin thuốc:", error);
                alert("Không thể tải thông tin thuốc!");
            });
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('doctor.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\phongkham\resources\views/doctor/pages/prescription/list_prescription.blade.php ENDPATH**/ ?>