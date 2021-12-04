<?php 
  function dashboard()
  {
    global $conn;
    $news_query = "SELECT * FROM tb_post WHERE type='Berita'";
    $news_sql   = mysqli_query($conn,$news_query);
    $news_count = mysqli_num_rows($news_sql);
    $article_query = "SELECT * FROM tb_post WHERE type='Artikel'";
    $article_sql = mysqli_query($conn,$article_query);
    $article_count = mysqli_num_rows($article_sql);
    // Announcement
    $announcement_query = "SELECT * FROM tb_post WHERE type='Pengumuman'";
    $announcement_sql = mysqli_query($conn,$announcement_query);
    $announcement_count = mysqli_num_rows($announcement_sql);
    // Account
    $account_count = 10; 
    echo'
      <h1 class="mt-4 mb-4 fs-3 fw-normal">Dashboard</h1>
      <div class="row">
        <div class="col-xl-3 col-md-6">
          <div class="card mb-4 shadow">
            <div class="card-body border-start border-warning border-3 rounded">
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <span class="text-warning fw-bold">Berita</span></br>
                  <span class="fw-normal fs-4">Total : '.$news_count.'</span>
                </div>
                <div>
                  <i class="fas fa-newspaper fw-bold fs-2" style="color:#DDDFEB;"></i>
                </div>
              </div>
            </div><!-- ./card-body -->   
          </div><!-- ./card -->
        </div><!-- ./col-1 -->
    
        <div class="col-xl-3 col-md-6">
          <div class="card mb-4 shadow">
            <div class="card-body border-start border-success border-3 rounded">
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <span class="text-success fw-bold">Artikel</span></br>
                  <span class="fw-normal fs-4">Total : '.$article_count.'</span>
                </div>
                <div>
                  <i class="fas fa-book-open fw-bold fs-2" style="color:#DDDFEB;"></i>
                </div>
              </div>
            </div><!-- ./card-body -->   
          </div><!-- ./card -->
        </div><!-- ./col-2 -->

        <div class="col-xl-3 col-md-6">
          <div class="card mb-4 shadow">
            <div class="card-body border-start border-info border-3 rounded">
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <span class="text-info fw-bold">Pengumuman</span></br>
                  <span class="fw-normal fs-4">Total : '.$announcement_count.'</span>
                </div>
                <div>
                  <i class="fas fa-bullhorn fw-bold fs-2" style="color:#DDDFEB;"></i>
                </div>
              </div>
            </div><!-- ./card-body -->   
          </div><!-- ./card -->
        </div><!-- ./col-3 -->
  
        <div class="col-xl-3 col-md-6">
          <div class="card mb-4 shadow">
            <div class="card-body border-start border-danger border-3 rounded">
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <span class="text-danger fw-bold">Akun</span></br>
                  <span class="fw-normal fs-4">Total : '.$account_count.'</span>
                </div>
                <div>
                  <i class="fas fa-user-alt fw-bold fs-2" style="color:#DDDFEB;"></i>
                </div>
              </div>
            </div><!-- ./card-body -->   
          </div><!-- ./card -->
        </div><!-- ./col-4 -->
    </div><!--./row -->

    <div class="p-5 mb-4 bg-white rounded-3 shadow border-top border-primary border-5">
      <div class="container-fluid text-center py-3">
        <h1 class="fs-3 fw-bold">Selamat Datang di</h1>
        <h1 class="fs-2 fw-bold">Portal Berita Yayasaku</h1>
        <p class="fs-6">
        Using a series of utilities, you can create this jumbotron, just like the one in previous versions of Bootstrap. Check out the examples below for how you can remix and restyle it to your liking.
        </p>
      </div>
    </div>
    ';  
  }
?>
