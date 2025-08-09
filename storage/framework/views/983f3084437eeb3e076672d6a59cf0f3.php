

<?php $__env->startSection('content'); ?>
        <section id="appointment" class="appointment-section d-flex justify-content-center align-items-center"
        style="min-height: calc(100vh - 140px);"  >
        <div class="container">
            <h2 class="row text-center">Đăng ký khám</h2>
            <?php if(session('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo e(session('success')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Đóng"></button>
                </div>
            <?php endif; ?>
            <div class="row justify-content-center mb-5"><!-- center hàng -->
                <div class="col-md-6"><!-- column width tùy ý -->
                  <form method="GET" action="<?php echo e(route('doctor.search')); ?>">
                    <div class="input-group">
                      <input
                        type="text"
                        name="query"
                        class="form-control"
                        placeholder="Nhập Email..."
                        style="height: 61px;"
                      >
                      <button class="btn btn-outline-primary" type="submit">
                        Tìm Kiếm
                      </button>
                    </div>
                  </form>
                </div>
            </div>
            <?php if(isset($data)): ?>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Họ và Tên</label>
                        <input type="text" class="form-control" value="<?php echo e($data->user->name ?? ''); ?>" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" value="<?php echo e($data->user->email ?? ''); ?>" readonly>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Giới Tính</label>
                        <input type="text" class="form-control" value="<?php echo e($data->user->gender ?? ''); ?>" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tuổi</label>
                        <input type="number" class="form-control" value="<?php echo e($data->user->age ?? ''); ?>" readonly>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Chuyên Khoa</label>
                    <input type="text" class="form-control" value="<?php echo e($data->specialties ?? ''); ?>" readonly>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Loại Bác Sĩ</label>
                    <input type="text" class="form-control" value="<?php echo e($data->type ?? ''); ?>" readonly>
                </div>
                <div class="form-container">
                    <form method="POST" action="<?php echo e(route('doctor.regis')); ?>">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="doctor_id" value="<?php echo e($data->id); ?>">
                        <div class="mb-3">
                            <div class="mb-3">
                                <label for="clinic_id" class="form-label">Chọn Phòng Khám</label>
                                <select name="clinic_id" id="clinic_id" class="form-select">
                                  <option value="">-- Chọn phòng khám --</option>
                                  <?php $__currentLoopData = $clinics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $clinic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option 
                                      value="<?php echo e($clinic->id); ?>" 
                                      <?php echo e(old('clinic_id') == $clinic->id ? 'selected' : ''); ?>

                                    >
                                      <?php echo e($clinic->name); ?>

                                    </option>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                              </div>
                            </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Ghi Chú</label>
                            <textarea name="message" id="message" class="form-control" rows="4"><?php echo e(old('message')); ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 mb-5">Xác Nhận Đăng Ký</button>
                    </form>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\phongkham\resources\views/user/layouts/pages/appointment.blade.php ENDPATH**/ ?>