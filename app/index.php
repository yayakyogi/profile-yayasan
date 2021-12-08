<?php
  session_start();
  include "../part/header.php";
  include "../components/form.php";
  include "./connection.php";
  include "./post.php";
  include "./dashboard.php";
  include "./information.php";
  include "./user.php";
  include "./setting.php";

  if(!isset($_SESSION['isLoginSuperAdmin']) && !isset($_SESSION['isLoginAdmin']))
  {
    header("Location:login.php?message=403");
    exit;
  }

  // get data from session
  $user_id = $_SESSION['user_id'];
  $user_name = $_SESSION['user_name'];

  // get data user
  $query = "SELECT * FROM tb_user WHERE id='$user_id'";
  $sql = mysqli_query($conn,$query);
  $data = mysqli_fetch_assoc($sql);
  $user_name = $data['name'];
  $user_role = $data['role'];
  $user_img = $data['img'];

  headerAll();
  
  $page = GET('pages','index');
  $view = GET('views','index');

  // function utama yang menampung semua halaman admin
  function pages()
  {
    global $page;
    if($page === 'index') dashboard();
    if($page === 'post') post();
    if($page === 'information') information();
    if($page === 'user') user();
    if($page === 'setting') setting();
  }
?>
<body>
  <nav class="sb-topnav position-fixed w-100 navbar navbar-expand navbar-dark bg-dark shadow">
    <a class="navbar-brand ps-3" href="index.html">
      <img style="margin-right: 0.75rem;" src="../public/img/logo.png" alt="logo" width=40 height=40/>
        DASHBOARD
    </a>
    <button 
      class="btn btn-link btn-sm order-1 order-lg-0 me-3 me-lg-0 ms-lg-3" 
      id="sidebarToggle" 
      href="#!"
    >
      <i class="fas fa-bars"></i>
    </button>
    <div class="d-block w-100">
      <p class="text-white d-none d-sm-block fw-light pe-4 pt-3 small text-end">&copy; Copyright 2021 - Yayasanku</p>
    </div>
  </nav>
  <!-- .content -->
  <div id="layoutSidenav">
    <div id="layoutSidenav_nav">
      <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
          <div class="nav">
            <div class="text-center pt-1 pb-3 sb-profile">
              <img src="../public/img_profile/<?php echo $user_img ?>" class="rounded-circle" width="100" height="100"/><br/>
              <span class="small"><?php echo $user_name ?></span>
            </div>
            <a class="nav-link collapsed" href="?">
              <div class="sb-nav-link-icon">
                <i class="fas fa-columns"></i>
              </div>
                Dashboard
              <div class="sb-sidenav-collapse-arrow">
                <i class="fas fa-angle-down"></i>
              </div>
            </a>
              
            <a class="nav-link collapsed" href="?pages=post">
              <div class="sb-nav-link-icon">
                <i class="fas fa-paper-plane"></i>
              </div>
                Postingan
              <div class="sb-sidenav-collapse-arrow">
                <i class="fas fa-angle-down"></i>
              </div>
            </a>
            
            <?php 
              if($user_role === 'SuperAdmin')
              {
                echo '
                 <a class="nav-link collapsed" href="?pages=user">
                  <div class="sb-nav-link-icon">
                    <i class="fas fa-user"></i>
                  </div>
                    Admin
                  <div class="sb-sidenav-collapse-arrow">
                    <i class="fas fa-angle-down"></i>
                  </div>
                </a>
                ';
              }
            ?>
   
            <a class="nav-link collapsed" href="?pages=setting">
              <div class="sb-nav-link-icon">
                <i class="fas fa-cog"></i>
              </div>
                Pengaturan
              <div class="sb-sidenav-collapse-arrow">
                <i class="fas fa-angle-down"></i>
              </div>
            </a>

          </div>
        </div>
        <div class="sb-sidenav-footer">
          <div class="small mb-2">Login sebagai <span class="fw-bold"><?php echo $user_role ?></span></div>
          <a href="?pages=user&views=logout" class="btn btn-sm btn-outline-light" style="font-size:0.7rem;"><i class="fas fa-sign-out-alt"></i> Logout</a> 
        </div>
      </nav>
    </div>
    <!-- ./layout_sidebar-->
    
    <div id="layoutSidenav_content" class="bg-light">
      <main>
        <div class="container-fluid px-md-4 px-2" style="font-family: Poppins, sans-serif">
          <?php pages(); ?>
        </div>
      </main>
    </div>
  
  </div>
  <!-- ./content -->
  <script src="../public/bootstrap-5.0.2/dist/js/bootstrap.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="../public/js/script.js"></script>
  <script src="../public/js/ckeditor-basic/ckeditor.js"></script>
  <script>
    CKEDITOR.config.removePlugins = 'image,forms';
  </script>
</body>
