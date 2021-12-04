<?php 
  /* PAGE POST */
  $pages = GET('pages','');
  $views = GET('views','index');

  function information()
  {
    global $conn;
    global $pages;
    global $views;

    if($pages === 'information')
    {
      if($views === 'index')
      {
        echo '
          <div class="card mt-4">
            <div class="card-header bg-white">
              <h1 class="fs-3 fw-normal">Informasi Yayasan</h3>
            </div>
            <div class="card-body">
              <h5 class="fw-normal">Profil</h5>
              <!-- name -->
              <div class="row mb-2">
                <div class="col-12 col-md-2">
                  <span class="fw-bold">Nama</span>
                </div>
                <div class="col-12 col-md-10">
                  <span>: Yayasanku</span>
                </div>
              </div>
              
              <!-- address -->
              <div class="row mb-2">
                <div class="col-12 col-md-2">
                  <span class="fw-bold">Alamat</span>
                </div>
                <div class="col-12 col-md-10">
                  <span>: Ds Bolorejo Kecamanatan Kauman</span>
                </div>
              </div>

               <!-- telephone -->
              <div class="row mb-2">
                <div class="col-12 col-md-2">
                  <span class="fw-bold">Telepon</span>
                </div>
                <div class="col-12 col-md-10">
                  <span>: 0822 1111 2222</span>
                </div>
              </div>

              <!-- address -->
              <div class="row mb-2">
                <div class="col-12 col-md-2">
                  <span class="fw-bold">Email</span>
                </div>
                <div class="col-12 col-md-10">
                  <span>: yayasanku@gmail.com</span>
                </div>
              </div>

              <!-- social media -->
              <h5 class="fw-normal mt-3">Sosial Media</h5>
              <div class="row mb-2">
                <div class="col-12 col-md-2">
                  <span class="fw-bold">Facebook</span>
                </div>
                <div class="col-12 col-md-10">
                  : <a href="" class="text-decoration-none">Yayasanku</a>
                </div>
              </div>
              <div class="row mb-2">
                <div class="col-12 col-md-2">
                  <span class="fw-bold">Instagram</span>
                </div>
                <div class="col-12 col-md-10">
                  : <a href="" class="text-decoration-none">Yaysanku_22</a>
                </div>
              </div>

            </div><!-- ./card-body -->
          </div><!-- ./card -->
        ';
      } // end of index
    }// end of pages
  } // end function
?>
