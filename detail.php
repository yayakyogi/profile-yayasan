<?php 
  include "./app/connection.php";
  include "./part/header.php";
  include "./part/navbar.php";
  include "./part/listmenu.php";
  include "./part/footer.php";

  $title = GET('title','');

  if(!$title) 
  {
    header("Location:index.php");
    exit;
  }

  $query = "SELECT * FROM tb_post WHERE title='$title'";
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

?>
<!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/bootstrap-5.0.2/dist/css/bootstrap.min.css"/>
    <meta property="og:image" content="https://al-ghoibi.id/public/img_cover/<?php echo $data['img_cover']?>" />
    <meta property="og:title" content="<?php echo $data['title']?>" />
    <meta property="og:description" content="<?php echo $data['content']?>" />
    <meta property="og:url" content="https://al-ghoibi.id/detail.php?title=<?php echo $data['title']?>" />
    <link rel="stylesheet" href="./public/css/style.css"/>
    <link rel="icon" href="./public/img/logo.png" type="image/icon type">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"crossorigin="anonymous"></script>
    <title>AL GHOIBI</title>
  </head>
<body>
  <?php navbar() ?>
  <!-- content -->
  <section class="news mt-3">
    <div class="content">
      <div class="row g-0">
        <!-- main content -->
        <div class="col-sm-9 pe-2">

          <!-- content-detail -->
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
          <?php if($data['file']){ ?>
            <h5 data-aos="fade-up" data-aos-duration="1300">Lampiran</h5>
            <a class="btn btn-link" data-aos="fade-up" data-aos-duration="1400" href="./public/file/<?php echo $data['file'] ?>"><?php echo $data['file'] ?></a>
          <?php } ?>
          <!-- ./content-detail -->
         
          </br></br>
          <div data-aos="fade-up" data-aos-duration="1300">
              <h5 >Bagikan Artikel</h5>
              <a href="whatsapp://send?text=https://al-ghoibi.id/detail.php?title=<?php echo $title;?>"><img src="https://www.freeiconspng.com/uploads/logo-whatsapp-png-image-2.png" width="50" alt="Logo Whatsapp PNG Image" /></a>
          </div>
          

          <!-- post same -->
          <div class="d-flex justify-content-start align-items-center mt-5 mb-3 px-2" data-aos="fade-up" data-aos-duration="1500">
            <h5 class="me-1 category w-25">Postigan Serupa</h5>
            <hr style="border-color: #545961; background-color: #545961; opacity: 0.2; margin: 0 !important;"/>
          </div>
          <div class="row g-3">
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
                          <a href="detail.php?title=<?php echo urlencode($data['id']) ?>">
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
                <h6><a href="detail.php?title='<?php echo urlencode($data['title']); ?>"><?php echo $data['title'] ?></a></h6>
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