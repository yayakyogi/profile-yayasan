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
  <section class="caraousel mb-3">
    <!-- carousel -->
    <div id="carouselExampleCaptions" class="carousel slide" data-aos="fade-up" data-aos-duration="1500" data-bs-ride="carousel">
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
              <div class="'.($i === 1 ? 'carousel-item active' : 'carousel-item ').'"  data-bs-interval="5000">
                <img src="./public/img_cover/'.$data['img_cover'].'" class="w-100 h-100" style="object-fit: cover;object-position: center;" alt="...">
                <div class="carousel-caption d-block text-start" data-aos="fade-up" data-aos-duration="1800">
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
    <!-- ./carousel -->
  </section>
  <!-- ./section header -->

  <!-- section post and foto -->
  <section class="news">
   <div class="content">
     <div class="d-flex justify-content-start align-items-center mb-4">
       <h5 class="me-1 category w-25" data-aos="fade-up" data-aos-duration="1000">Postingan terbaru</h5>
       <hr style="border-color: #545961; background-color: #545961; opacity: 0.2; margin: 0 !important;" data-aos="fade-up" data-aos-duration="1100"/>
     </div>
     <div class="row g-2">
       <!-- news post -->
       <div class="col-sm-7" data-aos="fade-up" data-aos-duration="1300">
          <div class="row g-3"><!-- headline -->
            <?php 
              $data = mysqli_fetch_assoc($sql_headline);
            ?>
              <div class="col-sm-6">
                <div class="w-100">
                  <img src="./public/img_cover/<?php echo $data['img_cover']?>" class="img-fluid shadow-sm mb-2 rounded"/>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="w-100" style="padding:0 10px 10px 0">
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
              </div><!-- ./col-sm-6 -->
          </div><!-- ./row -->
       </div><!-- ./col-sm-7 col-1 -->
       <!-- ./news post -->
       
       <!-- foto -->
       <div class="col-sm-5" data-aos="fade-up" data-aos-duration="1600">
          <div class="row g-1">
            <?php 
              for ($i=0; $i < 4; $i++) { 
                echo '
                  <div class="col-sm-6">
                    <div class="w-100">
                      <img src="./public/img/img-2.jpg" class="img-fluid rounded"/>
                    </div>
                  </div>
                ';
              }
            ?>
          </div>
       </div><!-- col-sm-5 -->
       <!-- ./foto -->
     </div><!-- .row -->
     <br/>
   </div><!-- ./content -->
  </section><!-- ./section -->
  <!-- ./section post and foto -->

<?php footer() ?>

</body>
<script src="./public/bootstrap-5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>
</html>