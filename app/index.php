<?php 
  include "../part/header.php";
  include "./connection.php";
  include "./post.php";
  include "./dashboard.php";

  headerAll();
  
  $page = GET('pages','index');
  $view = GET('views','index');

  // function utama yang menampung semua halaman admin
  function pages()
  {
    global $page;
    if($page === 'index') dashboard();
    if($page === 'post') post();
  }
?>
<body>
  <nav class="sb-topnav position-fixed w-100 navbar navbar-expand navbar-dark bg-dark shadow">
    <a class="navbar-brand ps-3" href="index.html">Yayasanku</a>
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
              <img src="../public/img/img-1.jpg" class="rounded-circle" width="100" height="100"/><br/>
              <span class="small">Yayak Yogi Ginantaka</span>
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
                <i class="fas fa-bullhorn"></i>
              </div>
                Postingan
              <div class="sb-sidenav-collapse-arrow">
                <i class="fas fa-angle-down"></i>
              </div>
            </a>

            <a class="nav-link collapsed" href="#">
              <div class="sb-nav-link-icon">
                <i class="fas fa-building"></i>
              </div>
                Informasi
              <div class="sb-sidenav-collapse-arrow">
                <i class="fas fa-angle-down"></i>
              </div>
            </a>

          </div>
        </div>
        <div style="height:100%"></div>
        <div class="sb-sidenav-footer">
          <div class="small">Login sebagai</div>
          <span class="lead fw-bold">Admin</span>
        </div>
      </nav>
    </div>
    <!-- ./layout_sidebar-->
    
    <div id="layoutSidenav_content" class="bg-light">
      <main>
        <div class="container-fluid px-md-4 px-2">
          <?php pages(); ?>
        </div>
      </main>
    </div>
  
  </div>
  <!-- ./content -->
  <script src="../public/js/script.js"></script>
  <script src="../public/js/ckeditor-basic/ckeditor.js"></script>
</body>
