<nav class="col-md-2 d-none d-md-block bg-light sidebar">
    <div class="position-sticky">
        <ul class="nav flex-column">
            <?php if(auth()->user()->role === 'doctor'): ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->routeIs('doctor.dashboard') ? 'active' : ''); ?>" 
                    href="<?php echo e(route('doctor.dashboard')); ?>">
                        <i class="fas fa-tachometer-alt"></i> Tổng quan
                    </a>
                </li>
            <?php elseif(auth()->user()->role === 'staff'): ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->routeIs('doctor.staff.dashboard') ? 'active' : ''); ?>" 
                    href="<?php echo e(route('doctor.staff.dashboard')); ?>">
                        <i class="fas fa-tachometer-alt"></i> Tổng quan
                    </a>
                </li>
            <?php endif; ?>

            <li class="nav-item">
                <a class="nav-link <?php echo e(request()->routeIs('doctor.patient') ? 'active' : ''); ?>" 
                href="<?php echo e(route('doctor.patient')); ?>">
                    <i class="fas fa-users"></i> Danh sách bệnh nhân
                </a>
            </li>

            
            <?php if((Auth::user()->role === 'staff' && Auth::user()->staff->position == 'Tiếp đón') || Auth::user()->isClinicOwner()): ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->routeIs('receive.index') ? 'active' : ''); ?>" 
                    href="<?php echo e(route('receive.index')); ?>">
                        <i class="fas fa-users"></i> Tiếp nhận bệnh nhân
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#labMenu" role="button">
                        <i class="fas fa-calendar-alt"></i>Tái khám<i class="fas fa-chevron-down float-end"></i>
                    </a>
                    <div class="collapse <?php echo e(request()->routeIs('doctor.today_schedule', 'doctor.all_schedule') ? 'show' : ''); ?>" id="labMenu">
                        <ul class="nav flex-column ms-3">
                            <li class="nav-item"><a class="nav-link <?php echo e(request()->routeIs('doctor.today_schedule') ? 'active' : ''); ?>" href="<?php echo e(route('doctor.today_schedule')); ?>"><i class="fas fa-sync-alt"></i>Tái khám hôm nay</a></li>
                            <li class="nav-item"><a class="nav-link <?php echo e(request()->routeIs('doctor.all_schedule') ? 'active' : ''); ?>" href="<?php echo e(route('doctor.all_schedule')); ?>"><i class="fas fa-calendar-check"></i> Quản lý lịch</a></li>
                        </ul>
                    </div>
                </li>
            <?php endif; ?>

            
            <?php if((Auth::user()->role === 'doctor' && Auth::user()->doctor && Auth::user()->doctor->type == 'Điều trị') || Auth::user()->isClinicOwner()): ?>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#examMenu1" role="button">
                        <i class="fas fa-stethoscope"></i> Khám bệnh <i class="fas fa-chevron-down float-end"></i>
                    </a>
                    <div class="collapse <?php echo e(request()->routeIs('doctor.exam_waiting', 'doctor.exam', 'doctor.lab') ? 'show' : ''); ?>" id="examMenu1">
                        <ul class="nav flex-column ms-3">
                            <li class="nav-item">
                                <a class="nav-link <?php echo e(request()->routeIs('doctor.exam_waiting') ? 'active' : ''); ?>" href="<?php echo e(route('doctor.exam_waiting')); ?>">
                                    <i class="fas fa-list"></i> Danh sách khám
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php echo e(request()->routeIs('doctor.exam') ? 'active' : ''); ?>" href="<?php echo e(route('doctor.exam')); ?>">
                                    <i class="fas fa-notes-medical"></i> Lâm sàng
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php echo e(request()->routeIs('doctor.lab') ? 'active' : ''); ?>" href="<?php echo e(route('doctor.lab')); ?>">
                                    <i class="fas fa-notes-medical"></i> Cận lâm sàng
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            <?php endif; ?>

            
            <?php if((Auth::user()->role === 'doctor' && Auth::user()->doctor && Auth::user()->doctor->type == 'Cận lâm sàng') || Auth::user()->isClinicOwner()): ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->routeIs('doctor.lab_waiting') ? 'active' : ''); ?>" 
                        href="<?php echo e(route('doctor.lab_waiting')); ?>">
                            <i class="fas fa-users"></i> Yêu cầu xét nghiệm
                    </a>
                </li>
            <?php endif; ?>
            
            <?php if((Auth::user()->role === 'staff' && Auth::user()->staff->position == 'Kế toán') || Auth::user()->isClinicOwner()): ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('doctor.fee')); ?>">
                        <i class="fas fa-money-bill-wave"></i> Viện phí
                    </a>
                </li>
            <?php endif; ?>
            
            <?php if((Auth::user()->role === 'staff' && Auth::user()->staff->position == 'Cấp thuốc') || Auth::user()->isClinicOwner()): ?>
            <li class="nav-item">
                <a class="nav-link <?php echo e(request()->routeIs('doctor.list_prescription') ? 'active' : ''); ?>" 
                    href="<?php echo e(route('doctor.list_prescription')); ?>">
                        <i class="fas fa-users"></i> Cấp thuốc
                </a>
            </li>
            <?php endif; ?>

            
            <?php if(Auth::user()->isClinicOwner()): ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('staff.getList')); ?>">
                        <i class="fas fa-user-nurse"></i> Quản lý nhân viên
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('doctor.getList')); ?>">
                        <i class="fas fa-user-doctor"></i> Danh sách bác sĩ
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
<?php /**PATH C:\xampp\htdocs\phongkham\resources\views/doctor/layouts/sidebar.blade.php ENDPATH**/ ?>