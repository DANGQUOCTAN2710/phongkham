
<?php $__env->startSection('content'); ?>

<main class="col-md-10 ms-sm-auto px-md-4" style="height: 100vh; overflow: hidden; display: flex; flex-direction: column;">
    <h2 class="my-3 text-center text-primary fw-bold">Nhập Kết Quả Cận Lâm Sàng</h2>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>
    <?php if(session('error')): ?>
        <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
    <?php endif; ?>

    <div style="flex: 1; overflow-y: auto; padding-right: 10px;">
        <form action="<?php echo e(route('doctor.lab.storeLabResults', ['id' => request()->route('id')])); ?>" 
            method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
    
            <div id="lab_section" class="card shadow-sm p-4 mb-4 rounded-4">
                <h4 class="text-dark fw-bold">Danh Sách Xét Nghiệm</h4>
            
                <?php
                    $hasClinicalTest = $clinicalTestOrderDetails->whereNotNull('clinical_test_id')->isNotEmpty();
                    $hasUltrasound = $clinicalTestOrderDetails->whereNotNull('ultrasound_id')->isNotEmpty();
                    $hasImaging = $clinicalTestOrderDetails->whereNotNull('diagnostic_imaging_id')->isNotEmpty();
                ?>
            
                <?php if($hasClinicalTest): ?>
                    <h5 class="fw-bold text-primary">Xét nghiệm</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Tên xét nghiệm</th>
                                <th>Kết quả</th>
                                <th>Hình ảnh</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $clinicalTestOrderDetails->whereNotNull('clinical_test_id'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($detail->clinicalTest->name); ?></td>
                                    <td>
                                        <textarea name="results[<?php echo e($detail->id); ?>]" class="form-control" required>
                                            <?php echo e(old("results.$detail->id", $detail->result)); ?>

                                        </textarea>
                                    </td>
                                    <td>
                                        <!-- Input cho phép chọn nhiều file -->
                                        <input type="file" name="files[<?php echo e($detail->id); ?>]" accept="image/*, .pdf">
            
            
                                        <?php if(!empty($filePaths[0])): ?>
                                            <div class="mt-2">
                                                <strong>File đã lưu:</strong>
                                                <div class="d-flex flex-wrap">
                                                    <?php $__currentLoopData = $filePaths; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <a href="<?php echo e(asset('storage/' . trim($file))); ?>" target="_blank" class="me-2">
                                                            <img src="<?php echo e(asset('storage/' . trim($file))); ?>" width="100" height="100" class="border rounded">
                                                        </a>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            
                <?php if($hasUltrasound): ?>
                    <h5 class="fw-bold text-primary">Siêu âm</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Tên siêu âm</th>
                                <th>Kết quả</th>
                                <th>Hình ảnh</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $clinicalTestOrderDetails->whereNotNull('ultrasound_id'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($detail->ultrasound->name); ?></td>
                                    <td>
                                        <textarea name="results[<?php echo e($detail->id); ?>]" class="form-control" required>
                                            <?php echo e(old("results.$detail->id", $detail->result)); ?>

                                        </textarea>
                                    </td>
                                    <td>
                                        <input type="file" name="files[<?php echo e($detail->id); ?>]" accept="image/*, .pdf">
            
                                        <?php if(!empty($filePaths[0])): ?>
                                            <div class="mt-2">
                                                <strong>File đã lưu:</strong>
                                                <div class="d-flex flex-wrap">
                                                    <?php $__currentLoopData = $filePaths; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <a href="<?php echo e(asset('storage/' . trim($file))); ?>" target="_blank" class="me-2">
                                                            <img src="<?php echo e(asset('storage/' . trim($file))); ?>" width="100" height="100" class="border rounded">
                                                        </a>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            
                <?php if($hasImaging): ?>
                    <h5 class="fw-bold text-primary">Chẩn đoán hình ảnh</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Tên chẩn đoán hình ảnh</th>
                                <th>Kết quả</th>
                                <th>Hình ảnh</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $clinicalTestOrderDetails->whereNotNull('diagnostic_imaging_id'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($detail->diagnosticImaging->name); ?></td>
                                    <td>
                                        <textarea name="results[<?php echo e($detail->id); ?>]" class="form-control" required>
                                            <?php echo e(old("results.$detail->id", $detail->result)); ?>

                                        </textarea>
                                    </td>
                                    <td>
                                        <input type="file" name="files[<?php echo e($detail->id); ?>]" accept="image/*, .pdf">
            
                                        <?php if(!empty($detail->file)): ?>
                                            <div class="mt-2">
                                                <strong>File đã lưu:</strong>
                                                <div>
                                                    <a href="<?php echo e(asset('storage/' . $detail->file)); ?>" target="_blank">
                                                        <?php if(Str::endsWith($detail->file, ['jpg', 'jpeg', 'png', 'gif'])): ?>
                                                            <img src="<?php echo e(asset('storage/' . $detail->file)); ?>" width="100" height="100" class="border rounded">
                                                        <?php else: ?>
                                                            📄 <span><?php echo e(basename($detail->file)); ?></span>
                                                        <?php endif; ?>
                                                    </a>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
    
            <div class="text-center mt-3">
                <button type="submit" class="btn btn-success px-4 py-2 shadow-sm">Lưu Kết Quả</button>
            </div>
        </form>
    </div>
</main>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('doctor.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\phongkham\resources\views/doctor/pages/lab_exam/index.blade.php ENDPATH**/ ?>