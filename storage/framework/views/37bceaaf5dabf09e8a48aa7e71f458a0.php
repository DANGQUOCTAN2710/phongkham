

<?php $__env->startSection('content'); ?>
<main class="col-md-10 ms-sm-auto px-md-4" style="height: 100vh; overflow: hidden; display: flex; flex-direction: column;">
    <h2 class="my-3 text-center text-primary fw-bold">Thông Tin Bệnh Nhân & Cận Lâm Sàng</h2>

    <div style="flex: 1; overflow-y: auto; padding-right: 10px;">
        
        <div class="card shadow-sm p-4 mb-4 rounded-4">
            <h4 class="text-dark fw-bold">Thông Tin Bệnh Nhân</h4>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <input type="text" class="form-control" name="patient_id" value="<?php echo e($user->medicalRecord->medicalBook->patient->id ?? ''); ?>" hidden>
                        <input type="text" class="form-control" name="patient_diagnosis" value="<?php echo e($user->medicalRecord->diagnosis ?? 'Chưa đặt'); ?>" hidden>
                        <input type="text" class="form-control" name="patient_examDate" value="<?php echo e($user->medicalRecord->exam_date ?? 'N/A'); ?>" hidden>
                        <th>Họ và Tên:</th>
                        <td id="patient_name"><?php echo e($user->medicalRecord->medicalBook->patient->name); ?></td>
                    </tr>
                    <tr>
                        <th>Tuổi:</th>
                        <td id="patient_age"><?php echo e($user->medicalRecord->medicalBook->patient->age ?? '0'); ?></td>
                    </tr>
                    <tr>
                        <th>Giới Tính:</th>
                        <td id="patient_gender"><?php echo e($user->medicalRecord->medicalBook->patient->gender); ?></td>
                    </tr>
                    <tr>
                        <th>Địa Chỉ:</th>
                        <td id="patient_address"><?php echo e($user->medicalRecord->medicalBook->patient->address); ?></td>
                    </tr>
                    <tr>
                        <th>Số Điện Thoại:</th>
                        <td id="patient_phone"><?php echo e($user->medicalRecord->medicalBook->patient->phone); ?></td>
                    </tr>
                    <tr>
                        <th>CCCD:</th>
                        <td id="patient_idUser"><?php echo e($user->medicalRecord->medicalBook->patient->idUser); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>

        
        <div class="card shadow-sm p-4 mb-4 rounded-4">
            <h4 class="text-dark fw-bold">Danh Sách Xét Nghiệm</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Loại xét nghiệm</th>
                        <th>Tên xét nghiệm</th>
                        <th>Kết quả</th>
                        <th>Hình ảnh</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $clinicalTestOrder->details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <?php if($detail->clinicalTest): ?>
                                    <?php echo e($detail->clinicalTest->category); ?>

                                <?php elseif($detail->ultrasound): ?>
                                    <?php echo e('Siêu âm'); ?>

                                <?php elseif($detail->diagnosticImaging): ?>
                                    <?php echo e('Chẩn đoán hình ảnh'); ?>

                                <?php else: ?>
                                    Không có thông tin
                                <?php endif; ?>
                            </td>
                            
                            <td>
                                <?php if($detail->clinicalTest): ?>
                                    <?php echo e($detail->clinicalTest->name); ?>

                                <?php elseif($detail->ultrasound): ?>
                                    <?php echo e($detail->ultrasound->name); ?>

                                <?php elseif($detail->diagnosticImaging): ?>
                                    <?php echo e($detail->diagnosticImaging->name); ?>

                                <?php else: ?>
                                    Không có thông tin
                                <?php endif; ?>
                            </td>
                            
                            <td><?php echo e(optional($detail->testResult)->result ?? 'Chưa có kết quả'); ?></td>
                            <td>
                                <?php if($detail->testResult && $detail->testResult->file): ?>
                                    <?php
                                        $filePath = asset('storage/' . $detail->testResult->file);
                                        $isImage = in_array(pathinfo($filePath, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']);
                                    ?>
                            
                                    <?php if($isImage): ?>
                                        <a href="<?php echo e($filePath); ?>" target="_blank">
                                            <img src="<?php echo e($filePath); ?>" width="100" height="100" class="border rounded">
                                        </a>
                                    <?php else: ?>
                                        <a href="<?php echo e($filePath); ?>" target="_blank">📄 Xem file</a>
                                    <?php endif; ?>
                                <?php else: ?>
                                    Không có file
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>

        
        <div class="card shadow-sm p-4 mb-4 rounded-4">
            <form id="labExamForm" action="<?php echo e(route('doctor.lab.Treatment', $user->medicalRecord->id)); ?>" method="POST">
                <?php echo csrf_field(); ?> 
                <!-- Hướng Xử Lý -->
                <div class="card shadow-sm p-4 mb-4 rounded-4">
                    <h4 class="text-dark fw-bold">Hướng Xử Lý</h4>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Xử Trí</label>
                            <select class="form-control <?php $__errorArgs = ['treatment'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="treatment" id="treatment">
                                <option value="">-- Chọn hướng xử lý --</option>
                                <option value="cap_toa" <?php echo e(old('treatment') == 'cap_toa' ? 'selected' : ''); ?>>Cấp Toa</option>
                                <option value="nhap_vien" <?php echo e(old('treatment') == 'nhap_vien' ? 'selected' : ''); ?>>Nhập Viện</option>
                            </select>
                            <?php $__errorArgs = ['treatment'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
        
                        <!-- Ngày tái khám (ẩn/hiện theo hướng xử lý) -->
                        <div class="col-md-6 mb-3" id="revisit_section" style="display: none;">
                            <label class="form-label">Ngày Tái Khám</label>
                            <input type="date" name="revisit_date_captoa" value="<?php echo e(old('revisit_date_captoa')); ?>" class="form-control <?php $__errorArgs = ['revisit_date_captoa'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                            <?php $__errorArgs = ['revisit_date_captoa'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                </div>
        
                <!-- Đơn Thuốc -->
                <div id="medicine_section" class="card shadow-sm p-4 mb-4 rounded-4">
                    <h4 class="text-dark fw-bold">Đơn Thuốc</h4>
                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th>Thuốc</th>
                                <th>Liều Dùng</th>
                                <th>Số Lượng</th>
                                <th>Thời Điểm Uống</th>
                                <th><button type="button" id="addMedicine" class="btn btn-success">+</button></th>
                            </tr>
                        </thead>
                        <tbody id="medicineList">
                            <tr>
                                <td>
                                    <?php if(isset($medicines)): ?>
                                        <select name="medicine[0][medicine_id]" class="form-control <?php $__errorArgs = ['medicine.0.medicine_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                            <?php $__currentLoopData = $medicines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $medicine): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($medicine->id); ?>"><?php echo e($medicine->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                       
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <input type="text" name="medicine[0][dosage]" class="form-control <?php $__errorArgs = ['medicine.0.dosage'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="VD: 1 viên/lần">
                                    <?php $__errorArgs = ['medicine.0.dosage'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </td>
                                <td>
                                    <input type="number" name="medicine[0][quantity]" class="form-control <?php $__errorArgs = ['medicine.0.quantity'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" min="1" placeholder="Số lượng">
                                    <?php $__errorArgs = ['medicine.0.quantity'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </td>
                                <td>
                                    <div class="d-flex flex-wrap">
                                        <label class="me-2">
                                            <input type="checkbox" name="medicine[0][morning]" value="1"> Sáng
                                        </label>
                                        <label class="me-2">
                                            <input type="checkbox" name="medicine[0][noon]" value="1"> Trưa
                                        </label>
                                        <label class="me-2">
                                            <input type="checkbox" name="medicine[0][evening]" value="1"> Chiều
                                        </label>
                                        <label class="me-2">
                                            <input type="checkbox" name="medicine[0][night]" value="1"> Tối
                                        </label>
                                    </div>
                                </td>
                                <td><button type="button" class="btn btn-danger remove">Xóa</button></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-between mt-3">
                        <button type="button" class="btn btn-primary" onclick="openMedicineModal()">Xem đơn thuốc
                    </div>
                    <?php echo $__env->make('doctor.pages.lab_exam.review', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
        
                <!-- Nút Submit -->
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Lưu Thông Tin</button>
                </div>
        
            </form>
        </div>
    </div>
</main> 
<script>
   document.addEventListener("DOMContentLoaded", function () {
    let treatmentSelect = document.getElementById("treatment");
    let medicineSection = document.getElementById("medicine_section");
    let revisitSection = document.getElementById("revisit_section");

    function toggleSections() {
        let treatment = treatmentSelect.value;

        medicineSection.style.display = "none";
        revisitSection.style.display = "none";

        if (treatment === "cap_toa") {
            medicineSection.style.display = "block";
            revisitSection.style.display = "block";
        }
    }

    // Khởi động
    toggleSections();
    treatmentSelect.addEventListener("change", toggleSections);

    

    let medicineIndex = 1;
    document.getElementById("addMedicine").addEventListener("click", function () {
        let medicineList = document.getElementById("medicineList");
        let newRow = document.createElement("tr");
        newRow.innerHTML = `
            <td>
                <select name="medicine[${medicineIndex}][medicine_id]" class="form-control">
                    ${document.querySelector("select[name='medicine[0][medicine_id]']").innerHTML}
                </select>
            </td>
            <td>
                <input type="text" name="medicine[${medicineIndex}][dosage]" class="form-control" placeholder="VD: 1 viên/lần">
            </td>
            <td>
                <input type="number" name="medicine[${medicineIndex}][quantity]" class="form-control" min="1" placeholder="Số lượng">
            </td>
            <td>
                <div class="d-flex flex-wrap">
                    <label class="me-2">
                        <input type="checkbox" name="medicine[${medicineIndex}][morning]" value="1"> Sáng
                    </label>
                    <label class="me-2">
                        <input type="checkbox" name="medicine[${medicineIndex}][noon]" value="1"> Trưa
                    </label>
                    <label class="me-2">
                        <input type="checkbox" name="medicine[${medicineIndex}][evening]" value="1"> Chiều
                    </label>
                    <label class="me-2">
                        <input type="checkbox" name="medicine[${medicineIndex}][night]" value="1"> Tối
                    </label>
                </div>
            </td>
            <td>
                <button type="button" class="btn btn-danger remove">Xóa</button>
            </td>
        `;
        medicineList.prepend(newRow);
        medicineIndex++;
    });

    // Xóa thuốc
    document.addEventListener("click", function (event) {
            if (event.target.classList.contains("remove")) {
                event.target.closest("tr").remove(); // Xóa hàng chứa nút "Xóa"
            }
    });
});


function populateMedicineModal(patientData) {
    document.getElementById("modal_patient_id").textContent = patientData.id || "";
    document.getElementById("modal_patient_name").textContent = patientData.name || "";
    document.getElementById("modal_patient_age").textContent = patientData.age || "";
    document.getElementById("modal_patient_gender").textContent = patientData.gender || "";
    document.getElementById("modal_exam_date").textContent = patientData.examDate || "";
    document.getElementById("modal_re_exam_date").textContent = patientData.reExamDate || "";
    document.getElementById("modal_diagnosis").textContent = patientData.diagnosis || "";
    
    let medicineListDisplay = document.getElementById("medicineListDisplay");
    medicineListDisplay.innerHTML = ""; // Xóa dữ liệu cũ

    if (patientData.medicines && patientData.medicines.length > 0) {
        patientData.medicines.forEach((medicine, index) => {
            let row = `<tr>
                <td class='text-center'>${index + 1}</td>
                <td>${medicine.name}</td>
                <td>${medicine.dosage}</td>
                <td class='text-center'>${medicine.quantity}</td>
                <td>${medicine.usage}</td>
            </tr>`;
            medicineListDisplay.innerHTML += row;
        });
    } else {
        medicineListDisplay.innerHTML = "<tr><td colspan='5' class='text-center text-muted'>Không có dữ liệu thuốc</td></tr>";
    }
}

// Hàm gọi khi mở modal
function openMedicineModal() {
    let medicines = [];
    document.querySelectorAll("#medicineList tr").forEach((row, index) => {
        let selectElement = row.querySelector("select");
        let dosageInput = row.querySelector("input[name*='dosage']");
        let quantityInput = row.querySelector("input[name*='quantity']");

        if (selectElement && dosageInput && quantityInput) {
            let medicine = {
                name: selectElement.selectedOptions[0].text,
                dosage: dosageInput.value,
                quantity: quantityInput.value,
                usage: Array.from(row.querySelectorAll("input[type='checkbox']:checked"))
                        .map(cb => cb.nextSibling.textContent.trim()).join(", ") || "Không xác định"
            };
            medicines.push(medicine);
        }
    });


    const patientData = {
        id: document.querySelector("input[name='patient_id']")?.value || "N/A",
        diagnosis: document.querySelector("input[name='patient_diagnosis']")?.value || "Chưa đặt",
        name: document.getElementById("patient_name")?.textContent || "N/A",
        age: document.getElementById("patient_age")?.textContent || "N/A",
        gender: document.getElementById("patient_gender")?.textContent || "N/A",
        examDate: document.querySelector("input[name='patient_examDate']")?.value || "N/A",
        reExamDate: document.querySelector("input[name='revisit_date_captoa']")?.value || "N/A",
        medicines: medicines
    };

    // Debug giá trị
    console.log("Patient Data:", patientData);

    populateMedicineModal(patientData);
    let medicineModal = new bootstrap.Modal(document.getElementById('medicineModal'));
    medicineModal.show();
}



function printPrescription() {
    // Lấy dữ liệu từ modal
    const patientId = document.getElementById("modal_patient_id").innerText;
    const patientName = document.getElementById("modal_patient_name").innerText;
    const patientAge = document.getElementById("modal_patient_age").innerText;
    const patientGender = document.getElementById("modal_patient_gender").innerText;
    const examDate = document.getElementById("modal_exam_date").innerText;
    const diagnosis = document.getElementById("modal_diagnosis").innerText;
    const reExamDate = document.getElementById("modal_re_exam_date").innerText;

    // Lấy nội dung modal
    const modalContent = document.querySelector("#medicineModal .data").innerHTML;

    // Tạo cửa sổ in mới
    const printWindow = window.open("", "", "width=900,height=700");

    // Chèn nội dung modal vào cửa sổ in
    printWindow.document.write(`
    <html>
    <head>
        <title>Đơn Thuốc</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
        <style>
            body { font-family: Arial, sans-serif; }
            .container { max-width: 700px; margin: auto; }
            .header, .footer { text-align: center; }
            .info-row { display: flex; justify-content: space-between; }
            .info-col { width: 48%; }
            .table { width: 100%; border-collapse: collapse; margin-top: 10px; }
            .table th, .table td { border: 1px solid black; padding: 8px; text-align: center; }
            .table thead { background-color: #f8f9fa; }
            hr { border: 1px solid #ccc; }
            @media print {
                .btn { display: none; } /* Ẩn nút khi in */
            }
        </style>
    </head>
    <body onload="window.print(); window.close();">
        <div class="container">
            <h5 class="fw-bold text-uppercase text-center" style="font-size: 24px">🩺 ĐƠN THUỐC</h5>
            <hr>
            <div class="header">
                <h4 class="fw-bold">🏥 BỆNH VIỆN XYZ</h4>
                <p>Địa chỉ: 123 Đường ABC, Quận X, TP.HCM</p>
                <p>Hotline: 0123 456 789</p>
                <hr>
            </div>
            <div class="info-row">
                <div class="info-col">
                    <p><strong>Mã bệnh nhân: </strong>BN${patientId}</p>
                    <p><strong>Họ tên:</strong> ${patientName}</p>
                    <p><strong>Tuổi:</strong> ${patientAge}</p>
                </div>
                <div class="info-col">
                    <p><strong>Giới tính:</strong> ${patientGender}</p>
                    <p><strong>Ngày khám:</strong> ${examDate}</p>
                    <p><strong>Chẩn đoán:</strong> ${diagnosis}</p>
                </div>
            </div>
            <hr>

            ${modalContent}
            <hr>
            <div class="text-start mx-auto fw-bold text-danger" style="max-width: 500px;">
                <p>📆 Ngày tái khám: <span class="text-dark">${reExamDate}</span></p>
            </div>

            <div class="text-start mx-auto" style="max-width: 500px;">
                <strong>📌 Ghi chú:</strong>
                <ul>
                    <li>Uống đủ nước, nghỉ ngơi nhiều.</li>
                    <li>Tái khám nếu triệu chứng không giảm sau 5 ngày.</li>
                </ul>
            </div>

            <hr>
        </div>
    </body>
    </html>`);

    // Đóng tài liệu để tải nội dung
    printWindow.document.close();
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('doctor.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\phongkham\resources\views/doctor/pages/lab_exam/index1.blade.php ENDPATH**/ ?>