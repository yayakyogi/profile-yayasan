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
  <section class="py-5 bg-light">
    <div class="border-color info-footer" data-aos="fade-down" data-aos-duration="1000">
      <div class="mx-auto d-flex flex-column align-items-center justify-content-center footer-info-space gap-4">
        <nav class=" d-flex flex-lg-row flex-column align-items-center justify-content-center">
          <p class="text-secondary" style="margin:0;opacity:0.7">Copyright © 2021 - Yayasan Al-Ghoibi</p>
        </nav>
        <div class="d-flex title-font font-medium align-items-center gap-4">
              <!-- Facebook -->
              <a href="">
                <svg class="social-media-c" width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <circle cx="15" cy="15" r="15" fill="#C7C7C7" />
                  <g clip-path="url(#clip0)">
                    <path
                      d="M17.6648 9.65667H19.1254V7.11267C18.8734 7.078 18.0068 7 16.9974 7C14.8914 7 13.4488 8.32467 13.4488 10.7593V13H11.1248V15.844H13.4488V23H16.2981V15.8447H18.5281L18.8821 13.0007H16.2974V11.0413C16.2981 10.2193 16.5194 9.65667 17.6648 9.65667V9.65667Z"
                      fill="white"
                    />
                  </g>
                  <defs>
                    <clipPath id="clip0">
                      <rect width="16" height="16" fill="white" transform="translate(7 7)"/>
                    </clipPath>
                  </defs>
                </svg>
              </a>
              
              <!-- Youtube -->
              <a href="">
                <svg class="social-media-c" width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <circle cx="15" cy="15" r="15" fill="#C7C7C7" />
                  <g clip-path="url(#clip0)">
                    <path d="M 15 4 C 10.814 4 5.3808594 5.0488281 5.3808594 5.0488281 L 5.3671875 5.0644531 C 3.4606632 5.3693645 2 7.0076245 2 9 L 2 15 L 2 15.001953 L 2 21 L 2 21.001953 A 4 4 0 0 0 5.3769531 24.945312 L 5.3808594 24.951172 C 5.3808594 24.951172 10.814 26.001953 15 26.001953 C 19.186 26.001953 24.619141 24.951172 24.619141 24.951172 L 24.621094 24.949219 A 4 4 0 0 0 28 21.001953 L 28 21 L 28 15.001953 L 28 15 L 28 9 A 4 4 0 0 0 24.623047 5.0546875 L 24.619141 5.0488281 C 24.619141 5.0488281 19.186 4 15 4 z M 12 10.398438 L 20 15 L 12 19.601562 L 12 10.398438 z" fill="white"/>
                  </g>
                  <defs>
                    <clipPath id="clip0">
                      <rect width="16" height="16" fill="white" transform="translate(7 7)"/>
                    </clipPath>
                  </defs>
                </svg>
              </a>

              <!-- IG -->
              <a href="">
                <svg class="social-media-p" width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M17.8711 15C17.8711 16.5857 16.5857 17.8711 15 17.8711C13.4143 17.8711 12.1289 16.5857 12.1289 15C12.1289 13.4143 13.4143 12.1289 15 12.1289C16.5857 12.1289 17.8711 13.4143 17.8711 15Z"
                    fill="#C7C7C7"
                  />
                  <path
                    d="M21.7144 9.92039C21.5764 9.5464 21.3562 9.20789 21.0701 8.93002C20.7923 8.64392 20.454 8.42374 20.0797 8.28572C19.7762 8.16785 19.3203 8.02754 18.4805 7.98932C17.5721 7.94789 17.2997 7.93896 14.9999 7.93896C12.6999 7.93896 12.4275 7.94766 11.5193 7.98909C10.6796 8.02754 10.2234 8.16785 9.92014 8.28572C9.54591 8.42374 9.2074 8.64392 8.92976 8.93002C8.64366 9.20789 8.42348 9.54617 8.28523 9.92039C8.16736 10.2239 8.02705 10.6801 7.98883 11.5198C7.9474 12.428 7.93848 12.7004 7.93848 15.0004C7.93848 17.3002 7.9474 17.5726 7.98883 18.481C8.02705 19.3208 8.16736 19.7767 8.28523 20.0802C8.42348 20.4545 8.64343 20.7927 8.92953 21.0706C9.2074 21.3567 9.54568 21.5769 9.91991 21.7149C10.2234 21.833 10.6796 21.9733 11.5193 22.0115C12.4275 22.053 12.6997 22.0617 14.9997 22.0617C17.3 22.0617 17.5723 22.053 18.4803 22.0115C19.3201 21.9733 19.7762 21.833 20.0797 21.7149C20.8309 21.4251 21.4247 20.8314 21.7144 20.0802C21.8323 19.7767 21.9726 19.3208 22.011 18.481C22.0525 17.5726 22.0612 17.3002 22.0612 15.0004C22.0612 12.7004 22.0525 12.428 22.011 11.5198C21.9728 10.6801 21.8325 10.2239 21.7144 9.92039V9.92039ZM14.9999 19.4231C12.5571 19.4231 10.5768 17.4431 10.5768 15.0002C10.5768 12.5573 12.5571 10.5773 14.9999 10.5773C17.4426 10.5773 19.4229 12.5573 19.4229 15.0002C19.4229 17.4431 17.4426 19.4231 14.9999 19.4231ZM19.5977 11.4361C19.0269 11.4361 18.5641 10.9733 18.5641 10.4024C18.5641 9.83159 19.0269 9.36879 19.5977 9.36879C20.1685 9.36879 20.6313 9.83159 20.6313 10.4024C20.6311 10.9733 20.1685 11.4361 19.5977 11.4361Z"
                    fill="#C7C7C7"
                  />
                  <path
                    d="M15 0C6.717 0 0 6.717 0 15C0 23.283 6.717 30 15 30C23.283 30 30 23.283 30 15C30 6.717 23.283 0 15 0ZM23.5613 18.5511C23.5197 19.468 23.3739 20.094 23.161 20.6419C22.7135 21.7989 21.7989 22.7135 20.6419 23.161C20.0942 23.3739 19.468 23.5194 18.5513 23.5613C17.6328 23.6032 17.3394 23.6133 15.0002 23.6133C12.6608 23.6133 12.3676 23.6032 11.4489 23.5613C10.5322 23.5194 9.90601 23.3739 9.35829 23.161C8.78334 22.9447 8.26286 22.6057 7.83257 22.1674C7.39449 21.7374 7.05551 21.2167 6.83922 20.6419C6.62636 20.0942 6.48056 19.468 6.4389 18.5513C6.39656 17.6326 6.38672 17.3392 6.38672 15C6.38672 12.6608 6.39656 12.3674 6.43867 11.4489C6.48033 10.532 6.6259 9.90601 6.83876 9.35806C7.05505 8.78334 7.39426 8.26263 7.83257 7.83257C8.26263 7.39426 8.78334 7.05528 9.35806 6.83899C9.90601 6.62613 10.532 6.48056 11.4489 6.43867C12.3674 6.39679 12.6608 6.38672 15 6.38672C17.3392 6.38672 17.6326 6.39679 18.5511 6.4389C19.468 6.48056 20.094 6.62613 20.6419 6.83876C21.2167 7.05505 21.7374 7.39426 22.1677 7.83257C22.6057 8.26286 22.9449 8.78334 23.161 9.35806C23.3741 9.90601 23.5197 10.532 23.5616 11.4489C23.6034 12.3674 23.6133 12.6608 23.6133 15C23.6133 17.3392 23.6034 17.6326 23.5613 18.5511V18.5511Z"
                    fill="#C7C7C7"
                  />
                </svg>
              </a>
        </div><!-- ./d-flex -->
      </div><!-- ./d-flex-row -->
    </div><!-- ./info-footer -->
  </section>
</body>
<script src="./public/bootstrap-5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>
</html>