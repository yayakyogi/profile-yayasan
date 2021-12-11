<?php 
  include "./app/connection.php";
  include "./part/header.php";
  include "./part/navbar.php";
  include "./part/listmenu.php";
  include "./part/footer.php";

  headerIndex();
  // get data post for caraousel
  $query_carousel = "SELECT * FROM tb_post ORDER BY created_at DESC LIMIT 0,5";
  $sql_carousel = mysqli_query($conn,$query_carousel);

  // get data for news header
  $query_news = "SELECT * FROM tb_post LIMIT 0, 4";
  $sql_news = mysqli_query($conn,$query_news);

  // get data headline
  $query_headline = "SELECT * FROM tb_post ORDER BY created_at DESC LIMIT 0, 1";
  $sql_headline = mysqli_query($conn,$query_headline);

  // get data post news
  $query_type_news = "SELECT * FROM tb_post WHERE type='Berita' ORDER BY created_at DESC LIMIT 1, 4";
  $sql_type_news = mysqli_query($conn,$query_type_news);

  // get data post article
  $query_type_article = "SELECT * FROM tb_post WHERE type='Artikel'";
  $sql_type_articel = mysqli_query($conn,$query_type_news);

  // get data post announcement
  $query_type_announcement = "SELECT * FROM tb_post WHERE type='Pengumuman'";
  $sql_type_announcement = mysqli_query($conn,$query_type_announcement);

  // get data from tb_type
  $query_type = "SELECT * FROM tb_type";
  $sql_type = mysqli_query($conn,$query_type);

  // get data from tb_category
  $query_category = "SELECT * FROM tb_category";
  $sql_category = mysqli_query($conn,$query_category);

  // pagination
  $limit = 7;
  $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
  $page_start = ($page > 1) ? ($page * $limit) - $limit : 0;
  $prev = $page - 1;
  $next = $page + 1;
  $data = mysqli_query($conn,"SELECT * FROM tb_post");
  $count = mysqli_num_rows($data);
  $total_page = ceil($count / $limit);
  $query = "SELECT * FROM tb_post ORDER BY created_at DESC LIMIT $page_start,$limit";
  $sql = mysqli_query($conn,$query);
  $i = $page_start+1;
  
?>
<body>
  <!-- section navbar -->
  <?php navbar() ?>
  <!-- ./section navbar -->

  <!-- section header -->
  <section class="caraousel">
    <div class="row g-3">
      <!-- carousel -->
      <div class="col-sm-6">
        <div id="carouselExampleCaptions" class="carousel slide" data-aos="fade-right" data-aos-duration="2000" data-bs-ride="carousel">
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3" aria-label="Slide 4">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="4" aria-label="Slide 5">
            </button>
          </div>
          <div class="carousel-inner position-relative rounded">
            <?php 
              $i = 0;
              while($data = mysqli_fetch_assoc($sql_carousel))
              {
                $i++;
                echo '
                  <div class="'.($i === 1 ? 'carousel-item active' : 'carousel-item ').'"  data-bs-interval="2000">
                    <img src="./public/img_cover/'.$data['img_cover'].'" class="img-fluid" style="object-fit: cover;object-position: center;" alt="...">
                    <div class="carousel-caption d-block">
                      <a href="detail.php?id='.$data['id'].'">
                        <h5>'.$data['title'].'</h5>
                      </a>
                      <p>BY : <span>'.$data['author'].'</span></p>
                    </div>
                  </div>
                ';
              }
            ?>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>
      <!-- ./carousel -->
      <!-- news -->
      <div class="col-sm-6">
        <div class="row g-3">
          <?php
            while($data = mysqli_fetch_assoc($sql_news))
            {
              echo '
                <div class="col-sm-6" data-aos="fade-left" data-aos-duration="2000">
                  <a href="detail.php?id='.$data['id'].'">
                    <div class="card-news-header shadow rounded">
                      <img src="./public/img_cover/'.$data['img_cover'].'" class="w-100 h-100" style="object-fit: cover;object-position: center;"/>
                      <div class="px-2 caption">
                        <span class="title">'.$data['title'].'</span></br>
                        <span>
                          <i class="fas fa-calendar-alt"></i>
                          '.date("d / m / Y", strtotime($data['created_at'])).'
                        </span>
                        <span class="ms-2">
                          <i class="fas fa-user-edit"></i>
                          '.$data['author'].'
                        </span>
                      </div>
                    </div>
                  </a>
                </div>
              ';
            }
          ?>
        </div><!-- ./row -->
      </div><!-- ./col-sm-6 -->
      <!-- ./news -->
    </div><!-- ./row -->
  </section>
  <!-- ./section header -->

  <!-- section news -->
  <section class="news">
    <div class="content">
      <div class="row g-0">

        <div class="col-sm-9 pe-4">
          <div class="d-flex justify-content-start align-items-center mb-3" data-aos="fade-up" data-aos-duration="1000">
            <h5 class="me-1 category">Berita</h5>
            <hr style="border-color: #545961; background-color: #545961; opacity: 0.2; margin: 0 !important;"/>
          </div>
          <div class="row g-3">
  
            <!-- news main -->
            <div class="col-sm-6" data-aos="fade-up" data-aos-duration="1200">
              <div class="d-block mb-3 shadow-sm">
                <?php 
                  $data = mysqli_fetch_assoc($sql_headline);
                ?>
                <div class="w-100">
                  <img src="./public/img_cover/<?php echo $data['img_cover']?>" class="img-fluid shadow-sm mb-2 rounded"/>
                </div>
                <div class="w-100" style="padding:10px;">
                  <h5>
                    <a href="detail.php?id=<?php echo $data['id'] ?>">
                      <?php echo $data['title']?>
                    </a>
                  </h5>
                  <p class="datetime">
                    <span><i class="fas fa-calendar-alt"></i> <?php echo date("d / m / Y", strtotime($data['created_at']))?></span>
                    <span> <i class="fas fa-user-edit"></i> <?php echo $data['author']?></span>
                  </p>
                  <?php echo substr(html_entity_decode($data['content']),0,200);?>
                  <a href="detail.php?id=<?php echo $data['id'] ?>" class="btn btn-link px-0"><i>Baca Selengkapnya...</i></a>
                </div>
              </div><!-- ./headlines -->
            </div><!-- ./col-sm-6 col-1 -->
            <!-- ./news main -->

            <!-- type post news -->
            <div class="col-sm-6">
              <?php while($data = mysqli_fetch_assoc($sql_type_news)){?>
                <div class="d-flex justify-content-start align-items-start mb-3 shadow-sm rounded" data-aos="fade-up" data-aos-duration="1500" style="height:120px;overflow:hidden">
                  <img src="./public/img_cover/<?php echo $data['img_cover']?>" class="w-50 me-2">
                  <div>
                    <h6><a href="detail.php?id=<?php echo $data['id'] ?>"><?php echo $data['title'] ?></a></h6>
                    <p class="upload">
                      <span><i class="fas fa-calendar-alt"></i> <?php echo date("d / m / Y", strtotime($data['created_at']))?></span>
                      <span> <i class="fas fa-user-edit"></i> <?php echo $data['author']?></span>
                    </p>
                  </div>
                </div><!-- ./d-block -->
              <?php } ?>
            </div><!-- ./col-sm-6 col-2 -->
            <!-- ./type post news -->
          
          </div><!-- ./row col-1 -->
           
          <!-- all post -->
          <div class="d-flex justify-content-start align-items-center my-3" data-aos="fade-up" data-aos-duration="1500">
            <h5 class="me-1 category w-25">Semua Postingan</h5>
            <hr style="border-color: #545961; background-color: #545961; opacity: 0.2; margin: 0 !important;"/>
          </div>
          <div class="row g-3">
            <?php while($data = mysqli_fetch_assoc($sql)){ $i=1; ?>
              <div class="col-sm-3 mb-3">
                <div class="card shadow-sm rounded overflow-hidden" data-aos="fade-up" data-aos-duration="1800">
                  <div class="card-body p-0">
                    <div class="w-100">
                      <img src="./public/img_cover/<?php echo $data['img_cover'] ?>" class="w-100" style="height:120px"/>
                    </div>
                    <div class="p-2">
                      <p class="datetime">
                        <span><i class="fas fa-calendar-alt"></i> <?php echo date("d / m / Y", strtotime($data['created_at']))?></span>
                        <span> <i class="fas fa-user-edit"></i> <?php echo $data['author']?></span>
                      </p>
                      <h6>
                          <a href="detail.php?id=<?php echo $data['id'] ?>">
                            <?php echo $data['title']?>
                          </a>
                      </h6>
                      <small class="text-secondary" style="font-size:0.7rem"><i><?php echo '#'.$data['category'].'  #'.$data['type'];?></i></small>
                    </div><!-- ./p-2 -->
                  </div><!-- ./card-body -->
                </div><!-- ./card -->
              </div><!-- ./col-sm-3 -->
            <?php 
            } 
            if(mysqli_num_rows($sql) <= 0) echo '<p class="lead">Data Kosong</p>'
            ?>
            <?php 
              echo '
              <!-- Pagination -->
              <nav aria-label="Page navigation example">
                <ul class="pagination">
                  <li class="page-item">';
                  // page previous
                  if($page > 1)  
                    echo '<a class="page-link" href="?page='.$prev.'"><span aria-hidden="true">&laquo;</span></a>';
                  else 
                    echo '<li class="page-item disabled"><span class="page-link">&laquo;</span></li>';
                  echo '</li>';
                  // show list page
                  for ($i=1; $i <= $total_page; $i++) { 
                    if($page == $i)
                      echo '<li class="page-item active" aria-current="page"><a class="page-link" href="?page='.$i.'">'.$i.'</a></li>';
                    else 
                      echo '<li class="page-item"><a class="page-link" href="?page='.$i.'">'.$i.'</a></li>';
                  }
                  // page next
                  echo '
                  <li class="page-item">';
                    if($page < $count) 
                      echo '<a class="page-link" href="?page='.$next.'"><span aria-hidden="true">&raquo;</span></a>';
                    else echo '<li class="page-item disabled"><span class="page-link">&raquo;</span></li>';
                  echo '
                  </li>
                </ul><!-- ./pagination -->
              </nav><!-- ./aria label pagination -->
              ';
            ?>
          </div><!-- ./row -->
          <!-- ./all post -->

        </div><!-- ./col-sm-8 -->

        <div class="col-sm-3">
          <?php listMenu() ?>
        </div><!-- ./col-sm-3 -->

      </div><!-- ./row -->
    </div><!-- ./content -->
  </section>
<!-- ./section news -->

<?php footer() ?>

</body>
<script src="./public/bootstrap-5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>
</html>