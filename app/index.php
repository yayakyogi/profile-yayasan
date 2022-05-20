<?php
  session_start();
  include "../part/header.php";
  include "../components/form.php";
  include "../components/alert.php";
  include "./connection.php";
  include "./post.php";
  include "./dashboard.php";
  include "./information.php";
  include "./user.php";
  include "./setting.php";

  if(!isset($_SESSION['isLoginSuperAdmin']) && !isset($_SESSION['isLoginAdmin']))
  {
    header("Location:login.php?status=403");
    exit;
  }

  if(isset($_GET['status']) == '200' && isset($_GET['message']))
  {
    $status = $_GET['status'];
    $message = $_GET['message'];
    // post alert
    if($status === '200' && $message === 'addpost') echo alert('success','200','Berhasil menambah postingan');
    else if($status === '200' && $message === 'editpost') echo alert('success','200','Berhasil mengubah data');
    else if($status === '200' && $message === 'editimg') echo alert('success','200','Berhasil mengubah gambar header');
    else if($status === '200' && $message === 'editfile') echo alert('success','200','Berhasil mengubah file');
    else if($status === '200' && $message === 'deletepost') echo alert('success','200','Berhasil menghapus data');
    else if($status === '400' && $message === 'formcantempty') echo alert('error','400','Form tidak boleh kosong');
    else if($status === '400' && $message === 'extensionnotallowed') echo alert('error','400','Ektensi tidak diizinkan');
    else if($status === '400' && $message === 'formimgcantempty') echo alert('error','400','Form gambar cover tidak boleh kosong');

    // user alert
    else if($status === '200' && $message === 'adduser') echo alert('success','200','Sukses menambah admin');
    else if($status === '200' && $message === 'edituser') echo alert('success','200','Sukses mengubah data');
    else if($status === '200' && $message === 'editphoto') echo alert('success','200','Sukses mengubah photo profil');
    else if($status === '200' && $message === 'editpass') echo alert('success','200','Sukses mengubah password admin');
    else if($status === '200' && $message === 'deleteuser') echo alert('success','200','Sukses menghapus data admin');
    else if($status === '400' && $message === 'limitedsize') echo alert('error','400','File maksimal harus 2 MB');
    else if($status === '404' && $message === 'datanotfound') echo alert('error','404','Data tidak ditemukan');
    else if($status === '400' && $message === 'passnotmatch') echo alert('error','404','Password tidak sama');
    else if($status === '400' && $message === 'passlength') echo alert('error','404','Password kurang dari 8 karakter');
    else if($status === '400' && $message === 'passconfirm') echo alert('error','404','Password dan password konfirmasi tidak sama');
    else if($status === '400' && $message === 'passchange') echo alert('error','404','Gagal mengubah password');
    else if($status === '400' && $message === 'emailavailable') echo alert('error','404','Email sudah pernah terdaftar sebelumnya');
    
    // category & type alert
    else if($status === '200' && $message === 'editcategory') echo alert('success','200','Sukses mengubah kategori');
    else if($status === '200' && $message === 'edittype') echo alert('success','200','Sukses mengubah tipe');
    else if($status === '200' && $message === 'deletecategory') echo alert('success','200','Sukses menghapus kategori');
    else if($status === '200' && $message === 'deletetype') echo alert('success','200','Sukses menghapus tipe postingan');
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
      <img style="margin-right: 0.75rem;" src="../public/img/logo.png" alt="logo" width="40" height="40"/>
        Al-Ghoibi
    </a>
    <button 
      class="btn d-block d-lg-none btn-link btn-sm order-1 order-lg-0 me-3 me-lg-0 ms-lg-3" 
      id="sidebarToggle" 
      href="#"
    >
      <i class="fas fa-bars"></i>
    </button>
    <div class="d-block w-100">
      <p class="text-white d-none d-sm-block fw-light pe-4 pt-3 small text-end">&copy; Copyright 2021 - Al-Ghoibi</p>
    </div>
  </nav>
  <!-- .content -->
  <div id="layoutSidenav">
    <div id="layoutSidenav_nav">
      <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
          <div class="nav">
            <div class="text-center pt-1 pb-3 sb-profile">
              <img src="../public/img_profile/<?php echo $user_img ?>" class="rounded-circle mb-2" width="100" height="100"/><br/>
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
  <script src="../public/js/ckeditor-full/ckeditor.js"></script>
</body>
