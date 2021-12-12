<?php 
  include "./app/connection.php";
  include "./part/header.php";
  include "./part/navbar.php";
  include "./part/listmenu.php";
  include "./part/footer.php";

  $type = GET('type','');

  if(!$type) 
  {
    header("Location:index.php");
    exit;
  }

  $query = "SELECT * FROM tb_post WHERE type LIKE '%$type%' OR category LIKE '%$type%' OR title LIKE '%$type%'";
  $sql = mysqli_query($conn,$query);
  $count = mysqli_num_rows($sql);

  headerIndex();
?>
<body>
  <?php navbar() ?>
  <!-- search section -->
  <section class="news mt-3">
    <div class="content">
      <div class="row g-0">

        <!-- main content -->
        <div class="col-sm-9 pe-2">
          <h2 class="mb-5" data-aos="fade-up" data-aos-duration="1500">Hasil pencarian '<?php echo $type ?>'</h2>
          <!-- all post find -->
          <div class="d-flex justify-content-start align-items-center mb-3 px-2" data-aos="fade-up" data-aos-duration="1500">
            <h5 class="me-1 category w-25"><?php echo $count ?> Data Ditemukan</h5>
            <hr style="border-color: #545961; background-color: #545961; opacity: 0.2; margin: 0 !important;"/>
          </div>
          <div class="row g-3">
            <?php while($data = mysqli_fetch_assoc($sql)){ ?>
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
        </div><!-- ./col-sm-9 -->
         <!-- all post find -->
        
        <!-- list comment where category same -->
        <div class="col-sm-3">
          <?php listMenu() ?>
        </div><!-- ./col-sm-3 -->
        <!-- ./list comment where category same -->
        
      </div><!-- ./row -->
    </div><!-- ./content -->
  </section><!-- ./section -->
  <!-- ./search section -->
  <?php footer() ?>
</body>
<script src="./public/bootstrap-5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>
</html>