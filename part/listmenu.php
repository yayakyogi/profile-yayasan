<?php 
function listMenu(){ 
  global $conn;
  // get data from tb_type
  $query_type = "SELECT * FROM tb_type";
  $sql_type = mysqli_query($conn,$query_type);
  // get data from tb_category
  $query_category = "SELECT * FROM tb_category";
  $sql_category = mysqli_query($conn,$query_category);
?>
  <!-- list type post -->  
  <div class="card mb-3" data-aos="fade-up" data-aos-duration="1500">
    <div class="card-header">
      <h6 class="me-1 category">Postingan Lainnya</h6>
    </div>
    <div class="card-body p-1">
      <div class="list-group list-group-flush" style="font-family:Poppins,sans-serif;">
        <?php while($data = mysqli_fetch_assoc($sql_type)){ ?>
          <a href="search.php?type=<?php echo $data['type'] ?>" class="list-group-item list-group-item-action py-2"><?php echo $data['type'] ?></a>
        <?php } ?>
      </div>
    </div><!-- ./card-body -->
  </div><!-- ./card -->
  <!-- ./list type post -->

  <!-- list category post -->
  <div class="card my-3" data-aos="fade-up" data-aos-duration="1800">
    <div class="card-header">
      <h6 class="me-1 category">Kategori</h6>
    </div>
    <div class="card-body p-1">
      <div class="list-group list-group-flush" style="font-family:Poppins,sans-serif;">
        <?php while($data = mysqli_fetch_assoc($sql_category)){ ?>
          <a href="search.php?type=<?php echo $data['category'] ?>" class="list-group-item list-group-item-action py-2"><?php echo $data['category'] ?></a>
       <?php } ?>
      </div>
    </div><!-- ./card-body -->
  </div><!-- ./card -->  
  <!-- ./list category post -->
<?php } ?>