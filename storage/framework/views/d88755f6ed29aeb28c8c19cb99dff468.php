<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thông báo từ Sở Y Tế</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 0;
        }
        .container {
            background-color: #ffffff;
            max-width: 600px;
            margin: 40px auto;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        .header {
            font-size: 24px;
            color: #2c3e50;
            margin-bottom: 20px;
        }
        .content p {
            font-size: 16px;
            color: #333;
            line-height: 1.6;
        }
        .info-box {
            background-color: #f1f1f1;
            padding: 15px;
            border-left: 4px solid #3498db;
            margin: 20px 0;
            border-radius: 5px;
        }
        .footer {
            margin-top: 30px;
            font-size: 14px;
            color: #777;
            text-align: center;
        }
        .password {
            font-weight: bold;
            color: #e74c3c;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">Thông báo duyệt đăng ký khám</div>
        <div class="content">
            <p>Xin chào <strong><?php echo e($data->doctor->user->name); ?></strong>,</p>
        
            <?php if($data->status === 'Đã duyệt'): ?>
                <div class="info-box">
                    <p><strong>Thông tin đăng ký:</strong> <?php echo e($data->note ?? 'Không rõ'); ?></p>
                    <p><strong>Phòng khám:</strong> <?php echo e($data->clinic->name ?? 'Không rõ'); ?></p>
                    <p><strong>Thời gian duyệt:</strong> <?php echo e(\Carbon\Carbon::parse($data->update_at)->format('H:i d/m/Y') ?? 'Chưa xác định'); ?></p>
                </div>
        
                <?php if(!empty($data->password)): ?>
                    <p>Mật khẩu tài khoản đăng nhập của bạn là: <span class="password"><?php echo e($data->password); ?></span></p>
                    <p>Vui lòng thay đổi mật khẩu sau khi đăng nhập lần đầu để đảm bảo bảo mật.</p>
                <?php endif; ?>
        
                <p>Chúc bạn một ngày làm việc hiệu quả.</p>
        
            <?php elseif($data->status === 'Bị từ chối'): ?>
                <div class="info-box" style="border-left-color: #e74c3c;">
                    <p>Rất tiếc, yêu cầu đăng ký khám của bạn đã <strong>bị từ chối</strong>.</p>
                </div>
        
                <p>Nếu có bất kỳ thắc mắc nào, vui lòng liên hệ với Sở Y Tế để được hỗ trợ.</p>
            <?php endif; ?>
        </div>

        <div class="footer">
            Trân trọng,<br>
            <strong>Sở y tế - Hệ thống quản lý khám bệnh</strong>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\phongkham\resources\views/emails/notify.blade.php ENDPATH**/ ?>