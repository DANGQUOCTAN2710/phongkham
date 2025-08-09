<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
      <a class="navbar-brand" href="#">
          <img src="<?php echo e(asset('img/unnamed.png')); ?>" alt="Logo Phòng Khám">
          <span>Phòng Khám <br> Gia Đình</span>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav mx-auto"> 
              <li class="nav-item"><a class="nav-link" href="<?php echo e(route('/')); ?>">Trang Chủ</a></li>
              <li class="nav-item"><a class="nav-link" href="#about">Giới Thiệu</a></li>
              <li class="nav-item"><a class="nav-link" href="#features">Tính năng</a></li>
              <li class="nav-item"><a class="nav-link" href="#contact">Liên Hệ</a></li>
              <li class="nav-item"><a class="nav-link" href="#guide">Hướng dẫn</a></li>
              <li class="nav-item"><a class="nav-link" href="<?php echo e(route('user.appointment')); ?>">Đăng ký khám</a></li>
          </ul>
          <!-- Đưa Đăng Nhập sang phải -->
          <ul class="navbar-nav ms-auto">
              <li class="nav-item dropdown">
                    <button class="btn btn-primary " type="button">
                        <a class="dropdown-item" href="<?php echo e(route('login')); ?>">Đăng Nhập</a>
                    </button>
              </li>
          </ul>
      </div>
  </div>
</nav><?php /**PATH C:\xampp\htdocs\phongkham\resources\views/user/layouts/partials/navbar.blade.php ENDPATH**/ ?>