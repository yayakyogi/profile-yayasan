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

  // get data headline
  $query_headline = "SELECT * FROM tb_post ORDER BY created_at DESC LIMIT 0, 1";
  $sql_headline = mysqli_query($conn,$query_headline);

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
              <div class="'.($i === 1 ? 'carousel-item active' : 'carousel-item ').'" data-bs-interval="2000">
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

  <!-- section all post -->
  <section class="news">
    <div class="content">
      <div class="row">
        <div class="col-sm-8">
          <div class="d-flex justify-content-start align-items-center my-3" data-aos="fade-up" data-aos-duration="1500">
            <h5 class="me-1 category w-25" data-aos="fade-up" data-aos-duration="1000">Semua Postingan</h5>
            <hr style="border-color: #545961; width:75%; background-color: #545961; opacity: 0.2; margin: 0 !important;" data-aos="fade-up" data-aos-duration="1100"/>
          </div>
          <div class="row g-3">
            <?php while($data = mysqli_fetch_assoc($sql)){ $i=1; ?>
              <div class="col-sm-4 mb-3">
                <div class="card shadow-sm rounded overflow-hidden" style="height: 300px;" data-aos="fade-up" data-aos-duration="1200">
                  <div class="card-body p-0">
                    <div class="w-100">
                      <img src="./public/img_cover/<?php echo $data['img_cover'] ?>" class="w-100" style="height:150px"/>
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
        </div><!-- ./col-sm-8 -->

        <div class="col-sm-4">
          <div class="d-flex justify-content-start align-items-center mt-3 mb-2" data-aos="fade-up" data-aos-duration="1500">
            <h5 class="me-1 category w-25" data-aos="fade-up" data-aos-duration="1000">Linimasa</h5>
            <hr style="border-color: #545961; width:75%; background-color: #545961; opacity: 0.2; margin: 0 !important;" data-aos="fade-up" data-aos-duration="1100"/>
          </div>
          <h6 data-aos="fade-up" data-aos-duration="1750">Facebook</h6>
          <div class="container-iframe" data-aos="fade-up" data-aos-duration="1750">
            <iframe 
              class="responsive-iframe"
              src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Ffacebook&tabs=timeline&width=340&height=500&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="340" height="500" style="border:none;overflow:hidden" 
              scrolling="no" 
              frameborder="0" 
              allowfullscreen="true" 
              allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share">
            </iframe>
          </div>
          <h6 class="my-3" data-aos="fade-up" data-aos-duration="1750">YouTube</h6>
          <div class="container-iframe mb-5" data-aos="fade-up" data-aos-duration="2000">
            <iframe class="responsive-iframe" src="https://www.youtube.com/embed/8fho3489C8A"></iframe>
          </div>
        </div><!-- ./col-sm-4 -->
      </div><!-- ./row -->
    </div><!-- ./content -->
  </section><!-- ./section -->
  <!-- ./section all post -->

<?php footer() ?>
</body>
<script src="./public/bootstrap-5.0.2/dist/js/bootstrap.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>
</html>