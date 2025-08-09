

<?php $__env->startSection('content'); ?>
<main class="col-md-10 ms-sm-auto px-md-4">
    <h2 class="my-3 text-center text-primary">Danh Sách Viện Phí</h2>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <!-- Tìm kiếm -->
    <div class="card p-3 mb-3">
        <form method="GET" action="<?php echo e(route('doctor.fee')); ?>">
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

    <!-- Danh sách viện phí -->
    <div class="card p-3">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Mã BN</th>
                    <th>Họ và Tên</th>
                    <th>CCCD</th>
                    <th>Số Điện Thoại</th>
                    <th>Ngày tạo</th>
                    <th>Phí Thuốc</th>
                    <th>Phí Cận Lâm Sàng</th>
                    <th>Tổng Viện Phí</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $fee_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($fee->id); ?></td>
                        <td><?php echo e(optional($fee->medicalRecord->medicalBook->patient)->name); ?></td>
                        <td><?php echo e(optional($fee->medicalRecord->medicalBook->patient)->idUser); ?></td>
                        <td><?php echo e(optional($fee->medicalRecord->medicalBook->patient)->phone); ?></td>
                        <td><?php echo e($fee->created_at->format('d/m/Y')); ?></td>
                        <td><?php echo e(number_format($fee->medicine_fee, 0, ',', '.')); ?> đ</td>
                        <td><?php echo e(number_format($fee->clinical_fee, 0, ',', '.')); ?> đ</td>
                        <td class="fw-bold"><?php echo e(number_format($fee->total_fee, 0, ',', '.')); ?> đ</td>
                        <td>
                            <?php if($fee->status == 'Đã thanh toán'): ?>
                                <span class="text-success">Đã thanh toán</span>
                            <?php else: ?>
                                <span class="text-warning">Chưa thanh toán</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-center align-middle">
                            <div class="d-flex gap-1 justify-content-center">
                                <!-- Nút Xem chi tiết -->
                                <a href="javascript:void(0)" 
                                class="btn btn-info btn-lg d-flex align-items-center justify-content-center"
                                onclick="openHospitalFeeModal('<?php echo e($fee->id); ?>')">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <?php if($fee->status != 'Đã thanh toán'): ?>
                                    <form action="<?php echo e(route('payment.approve', $fee->id  )); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PUT'); ?> <!-- Hoặc POST tùy vào cách bạn muốn xử lý -->
                                        <button type="submit" class="btn btn-success btn-lg d-flex align-items-center justify-content-center">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </div>
                            <?php echo $__env->make('doctor.pages.hospital_fees.review', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <div class="mt-3 d-flex justify-content-center">
            <?php echo e($fee_list->withQueryString()->links()); ?>

        </div>
    </div>
</main>
<script>

function openHospitalFeeModal(feeId) {
        fetch(`/doctor/fee/${feeId}`)
        .then(response => response.json())
        .then(data => {
            // Cập nhật thông tin bệnh nhân
            document.getElementById('modal_patient_id').textContent = data.patientId;
            document.getElementById('modal_patient_name').textContent = data.patient_name;
            document.getElementById('modal_patient_age').textContent = data.patient_age;
            document.getElementById('modal_patient_idUser').textContent = data.idUser;
            document.getElementById('modal_patient_gender').textContent = data.patient_gender;
            document.getElementById('modal_patient_reason').textContent = data.reason;
            console.log(data);  // Kiểm tra dữ liệu
            if(data.prescription_details.length > 0){
                document.getElementById('hospitalMedicineSection').style.display = 'block';
                if (data.prescription_details) {
                    let medicineListHtml = '';
                    data.prescription_details.forEach((medicine, index) => {
                        medicineListHtml += `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${medicine.medicine.name}</td>
                                <td>${medicine.quantity}</td>
                                <td>${medicine.unit_price}</td>
                                <td>${medicine.total_price}</td>
                            </tr>
                        `;
                    });
                    document.getElementById('hospitalFeeMedicineList').innerHTML = medicineListHtml;
                }
            }
            else{
                document.getElementById('hospitalMedicineSection').style.display = 'none';   
            }
            
            if (
                (data.clinical_tests && data.clinical_tests.length > 0) ||
                (data.ultrasounds && data.ultrasounds.length > 0) ||
                (data.diagnostic_imaging && data.diagnostic_imaging.length > 0)
            ) {
                document.getElementById('hospitalFeeTestSection').style.display = 'block';

                // Hiển thị danh sách xét nghiệm nếu có
                if (data.clinical_tests && data.clinical_tests.length > 0) {
                    let clinicalTestListHtml = '';
                    data.clinical_tests.forEach((test, index) => {
                        clinicalTestListHtml += `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${test.code}</td>
                                <td>${test.category}</td>
                                <td>${test.name}</td>
                                <td>${test.price}</td>
                            </tr>
                        `;
                    });
                    document.getElementById('hospitalFeeClinicalTestsList').innerHTML = clinicalTestListHtml;
                    document.getElementById('modal_total_test').parentElement.style.display = 'block';
                    document.getElementById('hospitalFeeClinicalTestsSection').style.display = 'block';
                } else {
                    document.getElementById('hospitalFeeClinicalTestsSection').style.display = 'none';
                }

                // Hiển thị danh sách siêu âm nếu có
                if (data.ultrasounds && data.ultrasounds.length > 0) {
                    let ultrasoundListHtml = '';
                    data.ultrasounds.forEach((ultrasound, index) => {
                        ultrasoundListHtml += `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${ultrasound.code}</td>
                                 <td>${ultrasound.name}</td>
                                <td>${ultrasound.price}</td>
                            </tr>
                        `;
                    });
                    document.getElementById('hospitalFeeUltrasoundList').innerHTML = ultrasoundListHtml;
                    document.getElementById('hospitalFeeUltrasoundSection').style.display = 'block';
                } else {
                    document.getElementById('hospitalFeeUltrasoundSection').style.display = 'none';
                }

                // Hiển thị danh sách chẩn đoán hình ảnh (X-quang) nếu có
                if (data.diagnostic_imaging && data.diagnostic_imaging.length > 0) {
                    let imagingListHtml = '';
                    data.diagnostic_imaging.forEach((imaging, index) => {
                        imagingListHtml += `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${imaging.code}</td>
                                <td>${imaging.name}</td>
                                <td>${imaging.price}</td>
                            </tr>
                        `;
                    });
                    document.getElementById('hospitalFeeImagingList').innerHTML = imagingListHtml;
                    document.getElementById('hospitalFeeImagingSection').style.display = 'block';
                } else {
                    document.getElementById('hospitalFeeImagingSection').style.display = 'none';
                }

            } else {
                // Không có dịch vụ cận lâm sàng nào
                document.getElementById('hospitalFeeTestSection').style.display = 'none';
            }
            
            // Cập nhật tổng viện phí
            if(data.total_medicine_fee != 0)
            {

                document.getElementById('modal_total_medicine').textContent = data.total_medicine_fee;
            }
            if(data.total_clinical_fee != 0 || data.total_ultrasound_fee != 0  || data.total_diagnostic_imaging_fee != 0){
                document.getElementById('modal_total_test').textContent = data.total_clinical_fee + data.total_ultrasound_fee + data.total_diagnostic_imaging_fee;
            }
            document.getElementById('modal_total_fee').textContent = data.total_fee;
            // Mở modal
            const hospitalFeeModal = new bootstrap.Modal(document.getElementById('hospitalFeeModal'));
            hospitalFeeModal.show();
        })
        .catch(error => console.error('Error fetching patient data:', error));
}

function printHospitalFee() {
    // Lấy nội dung modal viện phí
    const modalContent = document.getElementById('hospitalFeeModal');

    // Mở cửa sổ mới để in
    const printWindow = window.open('', '', 'width=800,height=600');
    
    // Ghi nội dung vào cửa sổ in
    printWindow.document.write('<html><head><title>In Viện Phí</title><style>');
    // Bạn có thể thêm CSS tại đây để tùy chỉnh giao diện in
    printWindow.document.write('body { font-family: Arial, sans-serif; }');
    printWindow.document.write('.modal-content { width: 100%; padding: 20px; }');
    printWindow.document.write('</style></head><body>');
    printWindow.document.write(modalContent.innerHTML); // Thêm nội dung modal vào cửa sổ in
    printWindow.document.write('</body></html>');

    // Đóng tài liệu để chuẩn bị in
    printWindow.document.close();

    // Mở hộp thoại in của trình duyệt
    printWindow.print();
}

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('doctor.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\phongkham\resources\views/doctor/pages/hospital_fees/list.blade.php ENDPATH**/ ?>