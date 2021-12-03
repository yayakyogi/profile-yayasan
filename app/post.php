<?php 
/* PAGE POST */
$pages = GET('pages','');
$views = GET('views','index');

function post()
{
  global $conn;
  global $pages;
  global $views;

  if($pages === 'post')
  {
    // capture all data from form
    $author = htmlspecialchars(GET('author',''));
    $exec = htmlspecialchars(GET('exec',''));
    $type = htmlspecialchars(GET('type',''));
    $category = htmlspecialchars(GET('category',''));
    $title = htmlspecialchars(GET('title',''));
    $content = htmlspecialchars(GET('content',''));
    $modifier = htmlspecialchars(GET('modifier',''));

    if($views === 'index')
    {
      echo '
          <div class="card mt-4">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
              <h4>Daftar Postingan</h4>
              <a class="btn btn-sm btn-success" href="?pages=post&views=add"><i class="fas fa-plus-square"></i> Buat Postingan</a>
            </div>
            <div class="card-body">
              <div class="table-responsive-sm">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th class="text-center">&#8470;</th>
                      <th class="text-center">Tipe</th>
                      <th class="text-center">Kategori</th>
                      <th class="text-center">Judul</th>
                      <th class="text-center">Penulis</th>
                      <th class="text-center">Dibuat</th>
                      <th class="text-center">Diubah</th>
                      <th class="text-center">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>';
                    $query = "SELECT * FROM tb_post ORDER BY created_at DESC";
                    $sql = mysqli_query($conn,$query);
                    $count = mysqli_num_rows($sql);
                    $i = 1;
                    while($row = mysqli_fetch_assoc($sql))
                    { 
                      echo '<tr>';
                        echo '<td class="text-center">'.$i++.'</td>';
                        echo '<td>'.$row['type'].'</td>';
                        echo '<td>'.$row['category'].'</td>';
                        echo '<td>'.$row['title'].'</td>';
                        echo '<td class="text-center">'.$row['author'].'</td>';
                        echo '<td class="text-center">'.date("d M Y, G:i", strtotime($row['created_at'])).'</td>';
                        echo '<td class="text-center">'.date("d M Y, G:i", strtotime($row['updated_at'])).'</td>';
                        echo '<td class="text-center">
                          <a 
                            class="d-inline-block btn btn-sm btn-primary mb-1" 
                            href="?pages='.$pages.'&views=detail&id='.$row['id'].'">
                              <i class="fas fa-eye"></i> Lihat
                          </a> 
                        </td>';
                echo '</tr>';
                    }
            echo '</tbody>
                </table><!-- ./table -->
              </div><!-- ./table-responsive -->
            </div><!-- ./card-body -->     
          </div><!-- ./card -->
      ';  
    } // end view index
    
    if($views === 'add')
    { 
      // check all form
      if($exec && $type && $category && $title && $content)
      {
        $id = md5(time());
        $author = 'Admin'; 
        $img_cover = $_FILES['img_cover']['name'];
        $file = $_FILES['file']['name'];
        $time = time();
        if($img_cover)
        {
          $x = explode('.',$img_cover);
          $ekstensi_img = strtolower(end($x));
          $temp_img = $_FILES['img_cover']['tmp_name'];
          $dir_img = "../public/img_cover/";
          $ekstensi_img_allowed = array('png','jpg','jpeg');
          if(in_array($ekstensi_img,$ekstensi_img_allowed) === true)
          {
            // file not empty?
            if($file)
              {
              $y = explode('.',$file);
              $ekstensi_file = strtolower(end($y));
              $temp_file = $_FILES['file']['tmp_name'];
              $dir_file = "../public/file/";
              $ekstensi_file_allowed = array('pdf','doc','xlx','ppt','docx','pptx','xlsx','jpg','png','jpeg');
              if(in_array($ekstensi_file,$ekstensi_file_allowed) === true)
              {
                $file_name = $time."_".$file;
                $img_name = $time."_".$img_cover;
                move_uploaded_file($temp_img,$dir_img.$img_name);
                move_uploaded_file($temp_file,$dir_file.$file_name);
                $query = "INSERT INTO tb_post VALUES 
                          ('$id','$author','$type','$category','$title','$content','$img_name','$file_name',NOW(),NOW(),'$author')";
                $sql = mysqli_query($conn,$query);
                if($sql)
                {
                  GET('exec','');
                   echo "<script>window.location='index.php?pages=post'</script>";
                }
                else echo $mysqli_error($conn);
              } // ./in_array file
              else echo 'Ektensi tidak diizinkan';
            } // ./file

            // if file empty
            else
            {
              $img_name = $time."_".$img_cover;
              move_uploaded_file($temp_img,$dir_img.$img_name);
              $query = "INSERT INTO tb_post VALUES 
                        ('$id','$author','$type','$category','$title','$content','$img_name',null,NOW(),NOW(),'$author')";
              $sql = mysqli_query($conn,$query);
              if($sql)
              {
                GET('exec','');
                echo "<script>window.location='index.php?pages=post'</script>";
              }
              else echo mysqli_error($conn);
            } 
          } // ./in array img
          else echo 'Ektensi gambar tidak diizinkan';
        }// ./img cover
        else echo 'Img cover tidak boleh kosong';
      } // ./cek all form
      echo '
        <div class="card mt-4">
          <div class="card-header bg-white">
            <h4>Tambah Postingan</h4>
          </div> 
          <div class="card-body">
            <form method="POST" action="?pages='.$pages.'&views='.$views.'" class="form-post" enctype="multipart/form-data">
              <input type="hidden" name="exec" value="'.time().'"/>
              <!-- title -->
              <div class="form-group mb-2">
                <label for="title" class="mb-2 fs-6">Judul Postingan</label>
                <input type="text" name="title" class="form-control" placeholder="Masukkan judul postingan" id="title">
              </div>
              <!-- ./title -->

              <!-- tipe,category,gambar,file -->
              <div class="row mb-3">
                
                <!-- col-type -->
                <div class="col-12 col-sm-3 mb-2">
                  <div class="form-group">
                    <label for="type" class="mb-2">Tipe</label>
                      <select class="form-select" name="type">';
                  echo '<option selected>-Pilih-</option>';
                        $query = "SELECT * FROM tb_type";
                        $sql = mysqli_query($conn,$query);
                        while($row = mysqli_fetch_assoc($sql))
                        {
                          echo '<option value="'.$row['type'].'">'.$row['type'].'</option>';
                        }
              echo '</select>
                  </div>
                </div>
                <!-- ./col-type -->
                
                <!-- col-category -->
                <div class="col-12 col-sm-3 mb-2">
                  <div class="form-group">
                    <label for="category" class="mb-2">Kategori</label>
                       <select class="form-select" name="category">';
                  echo '<option selected>-Pilih-</option>';
                        $query = "SELECT * FROM tb_category";
                        $sql = mysqli_query($conn,$query);
                        while($row = mysqli_fetch_assoc($sql))
                        {
                          echo '<option value="'.$row['category'].'">'.$row['category'].'</option>';
                        }
              echo '</select>
                  </div>
                </div>
                <!-- ./col-category -->

                <!-- col-image -->
                <div class="col-12 col-sm-3 mb-2">
                  <div class="form-group">
                    <label for="image" class="mb-2">Gambar Cover</label>
                    <input class="form-control" type="file" name="img_cover" id="formFile">
                  </div>
                </div>
                <!-- ./col-image -->

                <!-- col-file -->
                <div class="col-12 col-sm-3 mb-2">
                  <div class="form-group">
                    <label for="file" class="mb-2">File/Lampiran</label>
                    <input class="form-control" type="file" name="file" id="formFile">
                  </div>
                </div>
                <!-- ./col-file -->

              </div>
              <!-- ./tipe & category -->
              <div class="form-group">
                <label for="ckeditor" class="mb-2">Keterangan / Isi pengumuman</label> 
                <textarea class="ckeditor" id="ckeditor" name="content"></textarea>   
              </div>
              <button type="submit" class="btn btn-primary mt-3">Simpan</button>
              <a class="btn btn-success mt-3" href="#">Pratinjau</a>  
            </form>  
          </div><!-- ./card-body -->
        </div><!-- ./card -->
      ';
    } // end view add post

    if($views === 'detail')
    {
      $id = GET('id','');
      $query =  "SELECT * FROM tb_post WHERE id='$id'";
      $sql = mysqli_query($conn,$query);
      $data = mysqli_fetch_assoc($sql);
      echo '
        <div class="card mt-4">
          <div class="card-header bg-white">
            <h4>Detail Postingan</h4>
          </div>
          <div class="card-body">
            <a 
              href="?pages='.$pages.'&views=update&id='.$id.'" 
              class="btn btn-sm btn-warning" 
              style="font-size:0.75rem;"
            >
              <i class="fas fa-edit"></i> Edit
            </a>
            <a 
              href="?pages='.$pages.'&views=delete&id='.$id.'" 
              class="btn btn-sm btn-danger" 
              style="font-size:0.75rem;"
            >
              <i class="fas fa-trash"></i> Hapus
            </a>

            <!-- author -->
            <div class="row align-items-center py-2 mt-2">
              <div class="col-12 col-md-2">
                <span class="fw-bold">Penulis</span>
              </div>
              <div class="col-12 col-md-10">
                <span class="fw-normal">: '.$data['author'].'</span>
              </div>
            </div>
            <!-- ./author -->
 
            <!-- title -->
            <div class="row align-items-center py-2">
              <div class="col-12 col-md-2">
                <span class="fw-bold">Judul</span>
              </div>
              <div class="col-12 col-md-10">
                <span class="fw-normal">: '.$data['title'].'</span>
              </div>
            </div>
            <!-- ./title -->

            <!-- datetime -->
            <div class="row align-items-center py-2">
              <div class="col-12 col-md-2">
                <span class="fw-bold">Tanggal Posting</span>
              </div>
              <div class="col-12 col-md-10">
                <span class="fw-normal">: '.date("d M Y, G:i",strtotime($data['created_at'])).' WIB</span>
              </div>
            </div>
            <!-- ./datetime -->
            
            <!-- update_at -->
            <div class="row align-items-center py-2">
              <div class="col-12 col-md-2">
                <span class="fw-bold">Terakhir Diubah</span>
              </div>
              <div class="col-12 col-md-10">
                <span class="fw-normal">: '.date("d M Y, G:i",strtotime($data['updated_at'])).' WIB</span>
              </div>
            </div>
            <!-- ./updated_at -->

            <!-- modifier -->
            <div class="row align-items-center py-2">
              <div class="col-12 col-md-2">
                <span class="fw-bold">Diubah Oleh</span>
              </div>
              <div class="col-12 col-md-10">
                <span class="fw-normal">: '.$data['modifier'].'</span>
              </div>
            </div>
            <!-- ./modifier -->

            <!-- type -->
            <div class="row align-items-center py-2">
              <div class="col-12 col-md-2">
                <span class="fw-bold">Tipe</span>
              </div>
              <div class="col-12 col-md-10">
                <span class="fw-normal">: '.$data['type'].'</span>
              </div>
            </div>
            <!-- ./type -->

            <!-- category -->
            <div class="row align-items-center py-2">
              <div class="col-12 col-md-2">
                <span class="fw-bold">Kategory</span>
              </div>
              <div class="col-12 col-md-10">
                <span class="fw-normal">: '.$data['category'].'</span>
              </div>
            </div>
            <!-- ./category -->
            
            <!-- file -->
            <div class="row align-items-center py-2">
              <div class="col-10 col-md-2">
                <span class="fw-bold">File / Lampiran</span>
              </div>
              <div class="col-12 col-md-10">';
                if($data['file'] == null) echo ': Tidak ada file';
                else echo': <a href="../public/file/'.$data['file'].'">'.$data['file'].'</a>';
        echo '</div>
            </div>
            <!-- ./file -->

            <!-- img_cover -->
            <div class="row align-items-center py-2">
              <div class="col-12 mb-2">
                <span class="fw-bold">Gambar Header</span>
              </div>
              <div class="col-12 w-75"> 
                <img src="../public/img_cover/'.$data['img_cover'].'" alt="'.$data['img_cover'].'" class="rounded img-fluid ms-2"/>
              </div>
            </div>
            <!-- ./img_cover -->    

            <!-- content -->
            <div class="row align-items-center py-2 shadow-sm">
              <div class="col-12">
                <span class="fw-bold">Konten</span>
              </div>
              <div class="col-12 mt-2">
                '.html_entity_decode($data['content']).'
              </div>
            </div>
            <!-- ./content -->
            
         </div><!-- ./card-body -->
        </div><!-- ./card -->
      ';
    } // end view post detail

    if($views === 'update')
    { 
      $id = GET('id','');
      if($exec && $id && $author && $title && $type && $category && $content)
      {
        $query = "UPDATE tb_post SET 
                    title='$title',
                    type='$type',
                    category='$category',
                    content='$content',
                    updated_at=NOW(),
                    modifier='$modifier' 
                  WHERE id='$id'";
        $sql = mysqli_query($conn,$query);
        if(!$sql) echo mysqli_error($conn);
        $rows = mysqli_affected_rows($conn);
        if($rows > 0)
        {
          GET('exec','');
          echo '<script>window.location="?pages='.$pages.'&views=index"</script>';
        }
      } // cek all form
      $query = "SELECT * FROM tb_post where id='$id'";
      $sql = mysqli_query($conn,$query);
      if(!$sql) echo mysqli_error($conn);
      $data = mysqli_fetch_assoc($sql);
      
      echo '
        <div class="card mt-4">
          <div class="card-header bg-white">
            <h4>Edit Postingan</h4>
          </div>
          <div class="card-body">
            <form method="POST" action="?pages='.$pages.'&views='.$views.'">
              <input type="hidden" name="id" value="'.$data['id'].'"/>
              <input type="hidden" name="modifier" value="Yayak"/>
              <input type="hidden" name="exec" value="'.time().'"/>
              <div class="row mb-2">  
                <!-- author -->
                <div class="form-group mb-2 col-12 col-md-6">
                  <label for="author" class="mb-2 fs-6">Penulis</label>
                  <input type="text" name="author" class="form-control" value="'.$data['author'].'" id="author" readonly>
                </div>

                <!-- title -->
                <div class="form-group mb-2 col-12 col-md-6">
                  <label for="author" class="mb-2 fs-6">Judul</label>
                  <input type="text" name="title" class="form-control" value="'.$data['title'].'" id="title">
                </div>
              </div>

              <div class="row"> 
                <!-- type -->
                <div class="form-group mb-2 col-12 col-md-3">
                  <label for="type" class="mb-2 fs-6">Tipe</label>
                  <select name="type" class="form-control">';
                    $query = "SELECT type FROM tb_type";
                    $sql = mysqli_query($conn,$query);
                    while($row = mysqli_fetch_assoc($sql))
                    {
                      if($data['type'] == $row['type'])
                        echo '<option value="'.$row['type'].'" selected>'.$row['type'].'</option>';
                      else 
                        echo '<option value="'.$row['type'].'">'.$row['type'].'</option>';
                    } 
            echo '</select>
                </div>

                <!-- category -->
                <div class="form-group mb-2 col-12 col-md-3">
                  <label for="category" class="mb-2">Kategori</label>
                  <select name="category" class="form-control">';
                    $query = "SELECT category FROM tb_category";
                    $sql = mysqli_query($conn,$query);
                    while($row = mysqli_fetch_assoc($sql))
                    {
                      if($data['category'] == $row['category'])
                        echo '<option value="'.$row['category'].'" selected>'.$row['category'].'</option>';
                      else 
                        echo '<option value="'.$row['category'].'">'.$row['category'].'</option>';
                    } 
          echo '</select>
                </div>

                <!-- image cover -->
                <div class="form-group mb-2 col-2 col-md-3">
                  <div class="row align-items-start">
                    <label for="img_cover" class="col-auto mb-2">Gambar</label>
                    <a href="?pages='.$pages.'&views=updateimg&id='.$id.'" class="col-auto btn btn-sm btn-warning" style="font-size:0.75rem;">
                      <i class="fas fa-edit"></i>
                    </a>
                  </div>
                  <div class="w-50 shadow-sm">
                    <img src="../public/img_cover/'.$data['img_cover'].'" alt="'.$data['img_cover'].'" class="rounded img-fluid"/>
                  </div>
                </div>

                <!-- file -->
                <div class="form-group mb-2 col-2 col-md-3">
                  <div class="row align-items-start">
                    <label for="img_cover" class="col-auto mb-2">File</label>
                    <a href="?pages='.$pages.'&views=updatefile&id='.$id.'" class="btn btn-sm btn-warning col-auto" style="font-size:0.75rem;">
                      <i class="fas fa-edit"></i>
                    </a>
                  </div>
                  <div class="w-100">';
                    if($data['file'] == null) echo '<span>Tidak ada data</span>';
                    else echo '<a href="../public/file/'.$data['file'].'" style="font-size:0.75rem;">'.$data['file'].'</a>';
            echo '</div>
                </div>
              </div>
              <!-- ./row --> 
                
              <!-- content -->
              <div class="form-group">
                <label for="ckeditor" class="mb-2">Keterangan / Isi pengumuman</label> 
                <textarea class="ckeditor" id="ckeditor" name="content">'.$data['content'].'</textarea>   
              </div>

              <button type="submit" class="btn btn-primary mt-3">Simpan</button>  

            </form>
          </div><!-- ./card-body -->
        </div><!-- ./card -->
      ';
    }// end view update data

    if($views == 'updateimg')
    {
      $id = GET('id','');
      
      if($exec && $img_cover)
      {
        $query = "UPDATE tb_post SET img_cover='$img_cover',updated_at=NOW(),modifier='$modifier'";
        $sql = mysqli_query($conn,$query);
        $rows = mysqli_fetch_assoc($sql);
        if($rows > 0)
        {
          GET('exec','');
          echo '<script>window.location=?pages'.$pages.'&views=index></script>'; 
        }
      }

      $query = "SELECT img_cover FROM tb_post WHERE id='$id'";
      $sql = mysqli_query($conn,$query);
      $data = mysqli_fetch_assoc($sql);
      echo '
        <div class="card mt-4">
          <div class="card-header bg-white">
            <h4>Edit Gambar</h4>
          </div>
          <div class="card-body">
            <div class="w-75 mb-3">
              <p>Gambar Header Lama</p>
              <img src="../public/img_cover/'.$data['img_cover'].'" alt="'.$data['img_cover'].'" class="img-fluid"/>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
              <input type="hidden" name="id" value="'.$id.'"/>
              <input type="hidden" name="modifier" value="Yayak"/>
              <input type="hidden" name="exec" value="'.time().'"/>
              <div class="form-group">
                <label for="img_cover" class="mb-2">Unggah Gambar Baru</label>
                <input type="file" class="form-control" id="img_cover"/>
              </div>
              <button type="submit" class="btn btn-lg btn-primary mt-3">Simpan</button>
            </form>
          </div>
        </div>
      ';
    }
  
  } // end pages post
} // end function
?>
