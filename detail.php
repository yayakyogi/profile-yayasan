<?php 
  include "./app/connection.php";
  include "./part/header.php";
  include "./part/navbar.php";
  include "./part/listmenu.php";
  include "./part/footer.php";

  $id = GET('id','');

  if(!$id) 
  {
    header("Location:index.php");
    exit;
  }

  $query = "SELECT * FROM tb_post WHERE id='$id'";
  $sql = mysqli_query($conn,$query);
  $data = mysqli_fetch_assoc($sql);
  
  // show 4 news where type like detail
  $type = $data['type'];
  $query_type = "SELECT * FROM tb_post WHERE type='$type' LIMIT 0, 3";
  $sql_type = mysqli_query($conn,$query_type);
  
  // show 4 news where category like detail
  $category = $data['category'];
  $query_category = "SELECT * FROM tb_post WHERE category='$category'";
  $sql_category = mysqli_query($conn,$query_category);

  headerIndex();
?>

<body>
  <?php navbar() ?>
  <!-- content -->
  <section class="news mt-3">
    <div class="content">
      <div class="row g-0">
        <!-- main content -->
        <div class="col-sm-9 pe-2">

          <!-- content-detail -->
          <div class="px-2">
            <h4 class="mb-4" data-aos="fade-up">Detail Postingan</h2>
            <img src="./public/img_cover/<?php echo $data['img_cover'] ?>" class="img-fluid rounded" data-aos="fade-up" data-aos-duration="1200"/>
            <h1 class="mt-3 fs-2" data-aos="fade-up" data-aos-duration="1300"><?php echo $data['title'] ?></h1>
            <p class="upload px-2" data-aos="fade-up" data-aos-duration="1400">
              <span><i class="fas fa-calendar-alt"></i> <?php echo date("d / m / Y", strtotime($data['created_at']))?></span>
              <span> <i class="fas fa-user-edit"></i> <?php echo $data['author']?></span>
            </p>
            <div data-aos="fade-up" data-aos-duration="1200">
              <?php echo html_entity_decode($data['content'])?>
            </div>
          </div><!-- ./p-2 -->
          <!-- ./content-detail -->
          
          </br>

          <!-- post same -->
          <div class="d-flex justify-content-start align-items-center mt-5 mb-3 px-2" data-aos="fade-up" data-aos-duration="1500">
            <h5 class="me-1 category w-25">Postigan Serupa</h5>
            <hr style="border-color: #545961; background-color: #545961; opacity: 0.2; margin: 0 !important;"/>
          </div>
          <div class="row g-3 px-2">
            <?php while($data = mysqli_fetch_assoc($sql_type)){ ?>
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
            <?php } ?>
          </div><!-- ./row -->
          <!-- ./post same  -->

        </div><!-- ./col-sm-9 -->
        <!-- main content -->
        
        <!-- list comment where category same -->
        <div class="col-sm-3">
          <div class="d-flex justify-content-start align-items-center" data-aos="fade-up" data-aos-duration="1500">
            <h5 class="me-1 category">Kategori Serupa</h5>
          </div>
          <?php while($data = mysqli_fetch_assoc($sql_category)){?>
            <div class="d-flex justify-content-start align-items-start mb-3 shadow-sm rounded overflow-hidden" data-aos="fade-up" data-aos-duration="1500">
              <div class="p-3">
                <h6><a href="detail.php?id=<?php echo $data['id'] ?>"><?php echo $data['title'] ?></a></h6>
                <p class="upload">
                  <span><i class="fas fa-calendar-alt"></i> <?php echo date("d / m / Y", strtotime($data['created_at']))?></span>
                  <span> <i class="fas fa-user-edit"></i> <?php echo $data['author']?></span>
                </p>
                <small class="text-secondary" style="font-size:0.7rem"><i><?php echo '#'.$data['category'].'  #'.$data['type'];?></i></small>
              </div>
            </div><!-- ./d-block -->
          <?php } ?>
          </br>
          <?php listMenu() ?>
        </div><!-- ./col-sm-3 -->
        <!-- ./list comment where category same -->
        
      </div><!-- ./row -->
    </div><!-- ./content -->
  </section><!-- ./section -->
  <!-- ./content -->

  <?php footer() ?>
</body>
<script src="./public/bootstrap-5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>
</html>