<?php function navbar() { ?>
<!-- section navbar -->
  <section class="h-100 w-100" style="box-sizing: border-box;position: relative; background-color: #fafcff;">
    <div class="header-3-3 container-xxl mx-auto p-0 position-relative" style="font-family: 'Poppins', sans-serif">
      <nav class="navbar navbar-expand-lg navbar-light">
        <a href="?" class="text-decoration-none fs-5 text-dark" data-aos="fade-down" data-aos-duration="1500">
          <img style="margin-right: 0.75rem;" src="./public/img/logo.png" alt="logo" width=50 height=50/>AL-GHOIBI
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="modal" data-bs-target="#targetModal-item" data-aos="fade-down" data-aos-duration="2000">
          <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Menu ketika di layar HP -->
        <div class="modal-item modal fade" id="targetModal-item" tabindex="-1" role="dialog" aria-labelledby="targetModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content bg-white border-0">
              <div class="modal-header border-0" style="padding: 2rem; padding-bottom: 0">
                <a class="modal-title" id="targetModalLabel">
                  <img style="margin-top: 0.5rem" src="./public/img/logo.png" alt="logo" width=50 height=50/>
                </a>
                <button type="button" class="close btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
              </div> <!-- ./modal-header -->
              <div class="modal-body" style="padding: 2rem; padding-top: 0; padding-bottom: 0">
                <ul class="navbar-nav responsive me-auto mt-2 mt-lg-0">
                  <li class="nav-item active position-relative">
                    <a class="nav-link" href="#">Beranda</a>
                  </li>
                  <li class="nav-item position-relative">
                    <a class="nav-link" href="#">Profil Yayasan</a>
                  </li>
                  <li class="nav-item position-relative">
                    <a class="nav-link" href="#">Visi & Misi</a>
                  </li>
                  <li class="nav-item position-relative">
                    <a class="nav-link" href="#">Berita</a>
                  </li>
                  <li class="nav-item position-relative">
                    <a class="nav-link" data-bs-toggle="collapse" href="#collapse" role="button" aria-expanded="false" aria-controls="collapse">
                      <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M5.85 1.69346C3.5304 1.69346 1.65 3.57386 1.65 5.89346C1.65 8.21305 3.5304 10.0935 5.85 10.0935C8.1696 10.0935 10.05 8.21305 10.05 5.89346C10.05 3.57386 8.1696 1.69346 5.85 1.69346ZM0.25 5.89346C0.25 2.80066 2.75721 0.293457 5.85 0.293457C8.94279 0.293457 11.45 2.80066 11.45 5.89346C11.45 8.98625 8.94279 11.4935 5.85 11.4935C2.75721 11.4935 0.25 8.98625 0.25 5.89346Z" fill="#8B9CAF"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M8.85503 8.89848C9.12839 8.62512 9.57161 8.62512 9.84497 8.89848L14.045 13.0985C14.3183 13.3718 14.3183 13.8151 14.045 14.0884C13.7716 14.3618 13.3284 14.3618 13.055 14.0884L8.85503 9.88843C8.58166 9.61506 8.58166 9.17185 8.85503 8.89848Z" fill="#8B9CAF"/>
                      </svg>
                    </a>
                    <form method="POST" action="search.php" class="collapse position-absolute form center-search border-0" id="collapse">
                      <div class="d-flex">
                        <input type="text" name="type" class="rounded-full border-0 focus:outline-none" placeholder="Cari...">
                        <button class="btn" type="button"> 
                          <svg   style="width: 20px; height: 20px"   data-bs-toggle="collapse"   href="#collapse"   role="button"   aria-expanded="false"   aria-controls="collapse"   fill="none"   stroke="#273B56"   viewBox="0 0 24 24"   xmlns="http://www.w3.org/2000/svg" >
                            <path stroke-linecap="round"pathinfo stroke-linejoin="round"pathinfo stroke-width="2"pathinfo d="M6 18L18 6M6 6l12 12"></path>
                          </svg>
                        </button>
                      </div><!-- ./d-flex -->
                    </form><!-- ./form -->
                  </li><!-- ./nav-item -->
                </ul><!-- ./navbar-nav -->
              </div> <!-- ./modal-body -->
              <div class="modal-footer border-0" style="padding: 2rem; padding-top: 0.75rem">
                <button class="btn btn-fill text-white">Tentang Kami</button>
              </div> <!-- ./modal-footter -->
            </div> <!-- ./modal-content -->
          </div> <!-- ./modal-dialog -->
        </div> <!-- ./modal-item -->
            
        <!-- List menu ketika di PC -->
        <div class="collapse navbar-collapse" id="navbarTogglerDemo">
          <ul class="navbar-nav mx-auto mt-2 mt-lg-0" data-aos="fade-down" data-aos-duration="2000">
            <li class="nav-item position-relative">
              <a class="nav-link" href="#">Beranda</a>
            </li>
            <li class="nav-item position-relative">
              <a class="nav-link" href="#">Profil Yayasan</a>
            </li>
             <li class="nav-item position-relative">
               <a class="nav-link" href="#">Visi & Misi</a>
             </li>
             <li class="nav-item position-relative">
               <a class="nav-link" href="#">Berita</a>
             </li>
             <li class="nav-item my-auto">
               <a class="nav-link" data-bs-toggle="collapse" href="#collapse" role="button" aria-expanded="false" aria-controls="collapse"> 
                 <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                   <path fill-rule="evenodd" clip-rule="evenodd" d="M5.85 1.69346C3.5304 1.69346 1.65 3.57386 1.65 5.89346C1.65 8.21305 3.5304 10.0935 5.85 10.0935C8.1696 10.0935 10.05 8.21305 10.05 5.89346C10.05 3.57386 8.1696 1.69346 5.85 1.69346ZM0.25 5.89346C0.25 2.80066 2.75721 0.293457 5.85 0.293457C8.94279 0.293457 11.45 2.80066 11.45 5.89346C11.45 8.98625 8.94279 11.4935 5.85 11.4935C2.75721 11.4935 0.25 8.98625 0.25 5.89346Z" fill="#8B9CAF"/>
                   <path fill-rule="evenodd" clip-rule="evenodd" d="M8.85503 8.89848C9.12839 8.62512 9.57161 8.62512 9.84497 8.89848L14.045 13.0985C14.3183 13.3718 14.3183 13.8151 14.045 14.0884C13.7716 14.3618 13.3284 14.3618 13.055 14.0884L8.85503 9.88843C8.58166 9.61506 8.58166 9.17185 8.85503 8.89848Z" fill="#8B9CAF"/>
                 </svg>
               </a>
               <form method="POST" action="search.php" class="collapse position-absolute form center-search border-0 shadow" id="collapse" style="margin-left:-20px;width: 400px;">
                 <div class="d-flex">
                   <input type="text" name="type" class="rounded-full border-0 focus:outline-none" placeholder="Search"/>
                   <button class="btn" type="button">
                     <svg style="width: 20px; height: 20px" data-bs-toggle="collapse" href="#collapse" role="button" aria-expanded="false" aria-controls="collapse" fill="none" stroke="#273B56" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                     </svg>
                   </button><!-- ./button search -->
                 </div><!-- ./d-flex -->
               </form><!-- ./form -->
             </li><!-- ./nav-item -->
            </ul><!-- ./navbar-nav -->
            <a href="#" class="btn btn-fill text-white" data-aos="fade-down" data-aos-duration="2500">Tentang kami</a>
          </div> <!-- ./navbar-collapse -->
        </nav> <!-- ./nav -->
      </div> <!-- ./header -->
      <div class="hr">
      <hr style="border-color: #f4f4f4; background-color: #f4f4f4; opacity: 1; margin: 0 !important;"/>
    </div>
  </section>
<!-- ./section navbar -->
<?php } ?>