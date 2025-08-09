
<?php $__env->startSection('content'); ?>
<main class="col-md-10 ms-sm-auto px-md-4" style="height: 100vh; overflow: hidden; display: flex; flex-direction: column;">
    <h2 class="my-3 text-center text-primary fw-bold">Khám Lâm Sàng</h2>

    <div style="flex: 1; overflow-y: auto; padding-right: 10px;">
        <form id="examForm" action="<?php echo e(isset($exam) ? route('exam.update', $exam->id) : route('exam.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <?php if(session('error')): ?>
                <div class="alert alert-success"><?php echo e(session('error')); ?></div>
            <?php endif; ?>

            <!-- Thông Tin Bệnh Nhân -->
            <div class="card shadow-sm p-4 mb-4 rounded-4">
                <h4 class="text-dark fw-bold">Thông Tin Bệnh Nhân</h4>
                <div class="row">
                    <input type="text" class="form-control" name="patient_id" value="<?php echo e($exam->medicalBook->patient->id ?? ''); ?>" hidden>
                    <input type="text" class="form-control" name="patient_examDate" value="<?php echo e($exam->exam_date ?? ''); ?>" hidden>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Họ và Tên</label>
                        <input type="text" class="form-control" name="patient_name" value="<?php echo e($exam->medicalBook->patient->name ?? ''); ?>" readonly>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Tuổi</label>
                        <input type="text" class="form-control" name="patient_age" value="<?php echo e($exam->medicalBook->patient->age ?? '0'); ?>" readonly>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">CCCD</label>
                        <input type="text" class="form-control" name="patient_idUser" value="<?php echo e($exam->medicalBook->patient->idUser ?? ''); ?>" readonly>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Giới tính</label>
                        <input type="text" class="form-control" name="patient_gender" value="<?php echo e($exam->medicalBook->patient->gender ?? ''); ?>" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tiền sử bệnh lý</label>
                        <input type="text" name="patient_medicalHistory" class="form-control" value="<?php echo e($exam->medicalBook->medical_history ?? ''); ?>">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Dị ứng</label>
                        <input type="text" name="patient_allergies" class="form-control" value="<?php echo e($exam->medicalBook->allergies ?? ''); ?>">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Tiền sử gia đình</label>
                        <input type="text" name="patient_familyHistory" class="form-control" value="<?php echo e($exam->medicalBook->family_history ?? ''); ?>">
                    </div>
                </div>
            </div>
            <?php if(isset($historyExams)): ?>
                <?php if($historyExams->count()): ?>
                    <div class="card shadow-sm p-4 mb-4 rounded-4">
                        <h4 class="text-dark fw-bold mb-3">🩺 Lịch Sử Bệnh Án</h4>
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered align-middle text-center">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Ngày khám</th>
                                        <th scope="col">Chẩn đoán</th>
                                        <th scope="col">Bác sĩ</th>
                                        <th scope="col">Phòng khám</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $historyExams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $history): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($index + 1); ?></td>
                                            <td><?php echo e(\Carbon\Carbon::parse($history->exam_date)->format('d/m/Y')); ?></td>
                                            <td><?php echo e($history->diagnosis ?? 'Chưa có chẩn đoán'); ?></td>
                                            <td><?php echo e($history->doctor->user->name ?? 'N/A'); ?></td>
                                            <td><?php echo e($history->clinic->name ?? 'N/A'); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
            <div class="card shadow-sm p-4 mb-4 rounded-4">
                <h4 class="text-dark fw-bold">Chỉ Số Sinh Hiệu</h4>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Cân Nặng (kg)</label>
                        <input type="number" name="weight" class="form-control" value="<?php echo e($exam->weight ?? ''); ?>">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Chiều Cao (cm)</label>
                        <input type="number" name="height" class="form-control" value="<?php echo e($exam->height ?? ''); ?>">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">BMI</label>
                        <input type="text" class="form-control" value="<?php echo e($exam->bmi ?? ''); ?>" readonly>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Nhiệt Độ (°C)</label>
                        <input type="number" name="temperature" class="form-control" value="<?php echo e($exam->temperature ?? ''); ?>">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Mạch (lần/phút)</label>
                        <input type="number" name="pulse" class="form-control" value="<?php echo e($exam->pulse ?? ''); ?>">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">SpO2 (%)</label>
                        <input type="number" name="spo2" class="form-control" value="<?php echo e($exam->spo2 ?? ''); ?>">
                    </div>
                </div>
            </div>

            <!-- Chẩn Đoán -->
            <div class="card shadow-sm p-4 mb-4 rounded-4">
                <h4 class="text-dark fw-bold">Chẩn Đoán</h4>
                <div class="mb-3">
                    <label class="form-label">Lý Do Khám</label>
                    <textarea class="form-control" rows="2" disabled><?php echo e($exam->reason ?? ''); ?></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Chẩn đoán</label>
                    <input type="text" name="diagnosis" class="form-control <?php $__errorArgs = ['diagnosis'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('diagnosis', $exam->diagnosis ?? '')); ?>">
                    <?php $__errorArgs = ['diagnosis'];
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
                <div class="mb-3">
                    <label class="form-label">Bệnh Chính</label>
                    <input type="text" name="main_disease" class="form-control <?php $__errorArgs = ['main_disease'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('main_disease', $exam->main_disease ?? '')); ?>">
                    <?php $__errorArgs = ['main_disease'];
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
                <div class="mb-3">
                    <label class="form-label">Bệnh Phụ</label>
                    <input type="text" name="sub_disease" class="form-control <?php $__errorArgs = ['sub_disease'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('sub_disease', $exam->sub_disease ?? '')); ?>">
                    <?php $__errorArgs = ['sub_disease'];
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
                            <option value="cap_toa" <?php echo e(old('treatment', $exam->treatment ?? '') == 'cap_toa' ? 'selected' : ''); ?>>Cấp Toa</option>
                            <option value="can_lam_sang" <?php echo e(old('treatment', $exam->treatment ?? '') == 'can_lam_sang' ? 'selected' : ''); ?>>Yêu Cầu Cận Lâm Sàng</option>
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
                    <div class="col-md-6 mb-3" id="revisit_section" style="display: none;">
                        <label class="form-label">Ngày Tái Khám</label>
                        <input type="date" name="re_exam_date" class="form-control <?php $__errorArgs = ['re_exam_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            value="<?php echo e(old('re_exam_date', $exam->re_exam_date ?? '')); ?>">
                        <?php $__errorArgs = ['re_exam_date'];
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

            <!-- Giao diện chọn thuốc -->
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
                    <button type="button" class="btn btn-primary" onclick="openMedicineModal()">
                        Xem Đơn Thuốc
                    </button>
                </div>
                <?php echo $__env->make('doctor.pages.exam.review', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>

            <!-- Giao diện chọn dịch vụ cận lâm sàng -->
            <div id="lab_section" class="card shadow-sm p-4 mb-4 rounded-4" style="display: none;">
                <h4 class="text-dark fw-bold text-center mb-3">Chỉ Định Cận Lâm Sàng</h4>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="fw-bold">Loại cận lâm sàng</h5>
                            <div class="d-flex flex-wrap justify-content-center gap-3">
                                <!-- Xét nghiệm -->
                                <div class="form-check card p-3 shadow-sm text-center">
                                    <input class="form-check-input test-type" type="checkbox" name="clinical_test_id" value="1" id="service_type_clinical">
                                    <label class="form-check-label fw-bold" for="service_type_clinical">Xét nghiệm</label>
                                </div>
                                <!-- Siêu âm -->
                                <div class="form-check card p-3 shadow-sm text-center">
                                    <input class="form-check-input test-type" type="checkbox" name="ultrasound_id" value="1" id="service_type_ultrasound">
                                    <label class="form-check-label fw-bold" for="service_type_ultrasound">Siêu âm</label>
                                </div>
                                <!-- Chẩn đoán hình ảnh -->
                                <div class="form-check card p-3 shadow-sm text-center">
                                    <input class="form-check-input test-type" type="checkbox" name="imaging_id" value="1" id="service_type_imaging">
                                    <label class="form-check-label fw-bold" for="service_type_imaging">Chẩn đoán hình ảnh</label>
                                </div>
                            </div>
                        </div>
                    </div>
            
                    <!-- Danh sách dịch vụ theo loại -->
                    <div class="row mt-4" id="testOptions" style="display: flex; flex-wrap: wrap; justify-content: center; gap: 20px;">
                        <!-- Xét nghiệm -->
                        <?php if(isset($clinicalTestsByCategory)): ?>
                            <div class="test-group card p-3 shadow-sm mb-3" data-type="clinical_test" style="display: none;flex: 1; min-width: 250px;flex: 1; min-width: 250px;">
                                <h6 class="fw-bold text-center">Xét nghiệm</h6>
                                <?php $__currentLoopData = $clinicalTestsByCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category => $tests): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="fw-bold mt-2"><?php echo e($category); ?></div> <!-- Hiển thị tên loại xét nghiệm -->
                                    <div class="d-flex flex-column align-items-start">
                                        <?php $__currentLoopData = $tests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $test): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="form-check">
                                                <input class="form-check-input clinical-test" type="checkbox" name="clinical_test_id[]" value="<?php echo e($test->id); ?>" id="clinical_test_<?php echo e($test->id); ?>">
                                                <label class="form-check-label" for="clinical_test_<?php echo e($test->id); ?>"><?php echo e($test->name); ?></label>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php endif; ?>
            
                        <!-- Siêu âm -->
                        <?php if(isset($ultrasounds)): ?>
                            <div class="test-group card p-3 shadow-sm mb-3" data-type="ultrasound" style="display: none; flex: 1; min-width: 250px;">
                                <h6 class="fw-bold text-center">Siêu âm</h6>
                                <div class="d-flex flex-column align-items-start">
                                    <?php $__currentLoopData = $ultrasounds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ultrasound): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="form-check">
                                            <input class="form-check-input ultrasound-test" type="checkbox" name="ultrasound_id[]" value="<?php echo e($ultrasound->id); ?>" id="ultrasound_<?php echo e($ultrasound->id); ?>">
                                            <label class="form-check-label" for="ultrasound_<?php echo e($ultrasound->id); ?>"><?php echo e($ultrasound->name); ?></label>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        <?php endif; ?>
            
                        <!-- Chẩn đoán hình ảnh -->
                        <?php if(isset($diagnosticImagings)): ?>
                            <div class="test-group card p-3 shadow-sm mb-3" data-type="imaging" style="display: none; flex: 1; min-width: 250px;">
                                <h6 class="fw-bold text-center">Chẩn đoán hình ảnh</h6>
                                <div class="d-flex flex-column align-items-start">
                                    <?php $__currentLoopData = $diagnosticImagings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $imaging): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="form-check">
                                            <input class="form-check-input imaging-test" type="checkbox" name="imaging_id[]" value="<?php echo e($imaging->id); ?>" id="imaging_<?php echo e($imaging->id); ?>">
                                            <label class="form-check-label" for="imaging_<?php echo e($imaging->id); ?>"><?php echo e($imaging->name); ?></label>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            
                <div class="text-center mt-4">
                    <button type="button" class="btn btn-danger" id="removeSelection">Xóa tất cả</button>
                </div>
            </div>
            
            <div class="text-center mt-3">
                <button type="submit" class="btn btn-success px-4 py-2 shadow-sm">Lưu</button>
                <button class="btn btn-primary px-4 py-2 shadow-sm">Kết Thúc Khám</button>
                <button class="btn btn-danger px-4 py-2 shadow-sm">Hủy Khám</button>
            </div>
        </form>
    </div>
</main>
<script>
    // Hiển thị
    document.addEventListener("DOMContentLoaded", function() {
        let treatmentSelect = document.getElementById("treatment");
        let medicineSection = document.getElementById("medicine_section");
        let labSection = document.getElementById("lab_section");
        let revisitSection = document.getElementById("revisit_section");

        function toggleSections() {
            let treatment = treatmentSelect.value;

            // Ẩn cả hai trước khi hiển thị phần được chọn
            medicineSection.style.display = "none";
            labSection.style.display = "none";
            revisitSection.style.display = "none";

            if (treatment === "cap_toa") {
                medicineSection.style.display = "block";
                revisitSection.style.display = "block"; // Hiển thị ngày tái khám
            } else if (treatment === "can_lam_sang") {
                labSection.style.display = "block";
            }
        }

    // Gọi khi trang load để thiết lập đúng trạng thái ban đầu
        toggleSections();
        
        // Gọi mỗi khi người dùng thay đổi chọn lựa
        treatmentSelect.addEventListener("change", toggleSections);
    });

    document.addEventListener("DOMContentLoaded", function () {
        // Thêm thuốc mới
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

    // Cập nhật danh sách xét nghiệm khi thay đổi loại cận lâm sàng
        document.addEventListener("change", function (event) {
            if (event.target.classList.contains("test-type")) {
                let selectedType = event.target.value;
                let clinicalTestSelect = event.target.closest("tr").querySelector(".clinical-test");

                // Xóa các tùy chọn cũ
                clinicalTestSelect.innerHTML = '<option value="">-- Chọn xét nghiệm --</option>';

                if (selectedType) {
                    let allOptions = document.querySelectorAll("#allClinicalTests option");

                    allOptions.forEach(option => {
                        if (option.getAttribute("data-type") === selectedType) {
                            clinicalTestSelect.appendChild(option.cloneNode(true));
                        }
                    });
                }
            }
        });
    });

document.addEventListener("DOMContentLoaded", function () {
    let serviceTypeCheckboxes = document.querySelectorAll(".test-type");
    let testGroups = document.querySelectorAll(".test-group");
    let removeSelectionBtn = document.getElementById("removeSelection");

    const typeMap = {
        "service_type_clinical": "clinical_test",
        "service_type_ultrasound": "ultrasound",
        "service_type_imaging": "imaging"
    };
    // Xử lý khi chọn loại dịch vụ
    serviceTypeCheckboxes.forEach(checkbox => {
        checkbox.addEventListener("change", function () {
            let type = typeMap[this.id]; // Đảm bảo lấy đúng giá trị data-type
            let relatedGroup = document.querySelector(`.test-group[data-type="${type}"]`);

            if (relatedGroup) {
                if (this.checked) {
                    relatedGroup.style.display = "block";
                } else {
                    relatedGroup.style.display = "none";
                    let inputs = relatedGroup.querySelectorAll("input[type='checkbox']");
                    inputs.forEach(input => input.checked = false);
                }
            }
        });
    });

    // Nút xóa tất cả lựa chọn
    removeSelectionBtn.addEventListener("click", function () {
        serviceTypeCheckboxes.forEach(cb => cb.checked = false);
        testGroups.forEach(group => {
            group.style.display = "none";
            let inputs = group.querySelectorAll("input[type='checkbox']");
            inputs.forEach(input => input.checked = false);
        });
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

    function getValue(selector, defaultValue = "N/A") {
        let element = document.querySelector(selector);
        return element ? element.value : defaultValue;
    }

    let patientData = {
        id: getValue("input[name='patient_id']"),
        name: getValue("input[name='patient_name']", "Chưa xác định"),
        idUser: getValue("input[name='patient_idUser']"),
        age: getValue("input[name='patient_age']"),
        gender: getValue("input[name='patient_gender']"),
        examDate: getValue("input[name='patient_examDate']"),
        reExamDate: getValue("input[name='re_exam_date']"),
        diagnosis: getValue("input[name='diagnosis']", "Chưa có"),
        medicines: medicines,
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

<?php echo $__env->make('doctor.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\phongkham\resources\views/doctor/pages/exam/index.blade.php ENDPATH**/ ?>