     

    <?php $__env->startSection('title', 'Hồ Sơ Cá Nhân'); ?>

    <?php $__env->startSection('content'); ?>
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card shadow rounded-4 overflow-hidden">
                    <div class="row g-0">
                        <?php if(session('success')): ?>
                            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
                        <?php endif; ?>
                        
                        <?php if(session('error')): ?>
                            <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
                        <?php endif; ?>
                        <!-- Avatar -->
                        <div class="col-md-3 bg-light text-center py-4">
                            <img src="<?php echo e(asset('img/tải xuống.png')); ?>"
                                class="rounded-circle shadow mb-3"
                                alt="Avatar" style="width: 150px; height: 150px; object-fit: cover;">
                            <h5 class="fw-bold"><?php echo e($user->name); ?></h5>
                            <p class="text-muted"><?php echo e(ucfirst($user->role ?? 'Người dùng')); ?></p>
                            <a href="<?php echo e(route('profile.edit', $user->id)); ?>" class="btn btn-outline-primary btn-sm mt-2">
                                <i class="bi bi-pencil-square me-1"></i> Cập nhật thông tin
                            </a>
                            <a href="<?php echo e(route('profile.password.change')); ?>" class="btn btn-outline-success btn-sm mt-2">
                                <i class="bi bi-key me-1"></i> Đổi mật khẩu
                            </a>
                            <?php if(Auth::user()->role === 'doctor' 
                                && Auth::user()->doctor 
                                && Auth::user()->doctor->clinic_id !== null 
                                 && Auth::id() !== optional(Auth::user()->doctor->clinic)->user_id): ?> 
                                
                                <a href="<?php echo e(route('doctor.changeClinic', ['id' => Auth::user()->doctor->id])); ?>" class="btn btn-outline-warning btn-sm mt-2">
                                    <i class="bi bi-arrow-left-right me-1"></i> Xin chuyển phòng khám
                                </a>

                                <form action="<?php echo e(route('doctor.cancelClinic')); ?>" method="POST" class="mt-2">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PUT'); ?> 
                                    <button type="submit" class="btn btn-outline-danger btn-sm" 
                                        onclick="return confirm('Bạn có chắc chắn muốn hủy khám?');">
                                        <i class="bi bi-x-circle me-1"></i> Hủy khám
                                    </button>
                                </form>
                            <?php endif; ?>
                        </div>

                        <div class="col-md-9">
                            <div class="card-body p-5">
                                <h4 class="mb-4 fw-bold text-primary">
                                    <i class="bi bi-person-vcard me-2"></i>Thông Tin Cá Nhân
                                </h4>
                        
                                <div class="mb-3 border-bottom pb-2 d-flex justify-content-between">
                                    <div class="fw-bold text-secondary col-4">Email:</div>
                                    <div class="text-dark col-8 text-end"><?php echo e($user->email); ?></div>
                                </div>
                        
                                <div class="mb-3 border-bottom pb-2 d-flex justify-content-between">
                                    <div class="fw-bold text-secondary col-4">Số điện thoại:</div>
                                    <div class="text-dark col-8 text-end">
                                        <?php echo e($doctor->phone ?? $staff->phone ?? 'Chưa cập nhật'); ?>

                                    </div>
                                </div>
                        
                                <div class="mb-3 border-bottom pb-2 d-flex justify-content-between">
                                    <div class="fw-bold text-secondary col-4">Ngày sinh:</div>
                                    <div class="text-dark col-8 text-end">
                                        <?php echo e(\Carbon\Carbon::parse($user->birthday)->format('d/m/Y') ?? '---'); ?>

                                    </div>
                                </div>
                        
                                <div class="mb-3 border-bottom pb-2 d-flex justify-content-between">
                                    <div class="fw-bold text-secondary col-4">Địa chỉ:</div>
                                    <div class="text-dark col-8 text-end">
                                        <?php echo e($doctor->address ?? $staff->address ?? 'Chưa cập nhật'); ?>

                                    </div>
                                </div>
                        
                                <div class="mb-3 d-flex justify-content-between">
                                    <div class="fw-bold text-secondary col-4">Giới tính:</div>
                                    <div class="text-dark col-8 text-end"><?php echo e($user->gender ?? '---'); ?></div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- row -->
                </div>
            </div>
        </div>

       <div class="mt-4">
            <?php if(Auth::user()->role === 'doctor'): ?>
                <a href="<?php echo e(route('doctor.dashboard')); ?>" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Quay về
                </a>
            <?php elseif(Auth::user()->role === 'staff'): ?>
                <a href="<?php echo e(route('doctor.staff.dashboard')); ?>" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Quay về
                </a>
            <?php endif; ?>
        </div>
    </div>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('doctor.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\phongkham\resources\views/doctor/pages/profile/profile.blade.php ENDPATH**/ ?>