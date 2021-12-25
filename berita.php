<?php 
  include "./app/connection.php";
  include "./part/header.php";
  include "./part/navbar.php";;
  include "./part/footer.php";

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

  headerIndex();
?>

<body>
  <?php navbar() ?>
  <section class="news mt-3">
    <div class="content">
      <h5 class="mb-4 category" data-aos="fade-up" data-aos-duration="1000">Daftar Berita</h5>
      <div class="row g-3">
        <?php while($data = mysqli_fetch_assoc($sql)){ $i=1; ?>
          <div class="col-sm-3 mb-3">
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
    </div><!-- ./content -->
  </section><!-- ./section -->
  <?php footer() ?>
</body>
<script src="./public/bootstrap-5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>
</html>