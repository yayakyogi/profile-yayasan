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
    $exec = htmlspecialchars(GET('exec',''));
    $type = htmlspecialchars(GET('type',''));
    $category = htmlspecialchars(GET('category',''));
    $title = htmlspecialchars(GET('title',''));
    $content = htmlspecialchars(GET('content',''));

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
                      <th class="text-center">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>';
                    $query = "SELECT * FROM tb_post";
                    $sql = mysqli_query($conn,$query);
                    $count = mysqli_num_rows($sql);
                    $i = 1;
                    while($row = mysqli_fetch_assoc($sql))
                    { 
                      echo '<tr>';
                        echo '<td class="text-center">'.$i++.'</td>';
                        echo '<td class="text-center">'.$row['type'].'</td>';
                        echo '<td class="text-center">'.$row['category'].'</td>';
                        echo '<td>'.$row['title'].'</td>';
                        echo '<td class="text-center">'.$row['author'].'</td>';
                        echo '<td class="text-center">'.$row['created_at'].'</td>';
                        echo '<td class="text-center">
                          <a 
                            class="d-inline-block btn btn-sm btn-primary mb-1" 
                            href="?pages='.$pages.'&views=detail&id='.$row['id'].'">
                              <i class="fas fa-eye"></i> Lihat
                          </a>
                          <a
                            class="d-inline-block btn btn-sm btn-warning mb-1"
                            href="?pages=postaction&view=edit&id='.$row['id'].'">
                              <i class="fas fa-eye"></i> Lihat
                          </a>
                          <a
                            class="d-inline-block btn btn-sm btn-danger mb-1"
                            href="?pages=postaction&view=delete&id='.$row['id'].'">
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
      //$id = md5(time());
      //echo 'ID: '.$id;
      //echo 'Author: ',$author;
      //echo 'Type: ',$type;
      //echo 'Category: ',$category;
      //echo 'Title: ',$title;
      //echo 'Content: ',$content;
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
                          ('$id','$author','$type','$category','$title','$content','$img_name','$file_name',NOW(),NOW())";
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

            // if file doesn't upload
            else
            {
              $img_name = $time."_".$img_cover;
              move_uploaded_file($temp_img,$dir_img.$img_name);
              $query = "INSERT INTO tb_post VALUES 
                        ('$id','$author','$type','$category','$title','$content','$img_name',null,NOW(),NOW())";
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
                      <select class="form-select" name="type">
                        <option selected>-Pilih-</option>
                        <option value="Berita">Berita</option>
                        <option value="Artikel">Artikel</option>
                        <option value="Pengumuman">Pengumuman</option>
                      </select>
                  </div>
                </div>
                <!-- ./col-type -->
                
                <!-- col-category -->
                <div class="col-12 col-sm-3 mb-2">
                  <div class="form-group">
                    <label for="category" class="mb-2">Kategori</label>
                      <select class="form-select" name="category">
                        <option selected>-Pilih-</option>
                        <option value="kategori_1">Kategori 1</option>
                        <option value="kategori_2">Kategori 2</option>
                        <option value="kategori_3">Kategori 3</option>
                      </select>
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
    } // end view tambah berita

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

            <!-- author -->
            <div class="row align-items-center py-2 shadow-sm">
              <div class="col-12 col-md-2">
                <span class="fw-bold">Penulis</span>
              </div>
              <div class="col-12 col-md-10">
                <span class="fw-normal">'.$data['author'].'</span>
              </div>
            </div>
            <!-- ./author -->

            <!-- title -->
            <div class="row align-items-center py-2 shadow-sm">
              <div class="col-12 col-md-2">
                <span class="fw-bold">Judul</span>
              </div>
              <div class="col-12 col-md-10">
                <span class="fw-normal">'.$data['title'].'</span>
              </div>
            </div>
            <!-- ./title -->

            <!-- datetime -->
            <div class="row align-items-center py-2 shadow-sm">
              <div class="col-12 col-md-2">
                <span class="fw-bold">Tanggal Posting</span>
              </div>
              <div class="col-12 col-md-10">
                <span class="fw-normal">'.date("d M Y, G:i",strtotime($data['created_at'])).' WIB</span>
              </div>
            </div>
            <!-- ./datetime -->
            
            <!-- type -->
            <div class="row align-items-center py-2 shadow-sm">
              <div class="col-12 col-md-2">
                <span class="fw-bold">Tipe</span>
              </div>
              <div class="col-12 col-md-10">
                <span class="fw-normal">'.$data['type'].'</span>
              </div>
            </div>
            <!-- ./type -->

            <!-- category -->
            <div class="row align-items-center py-2 shadow-sm">
              <div class="col-12 col-md-2">
                <span class="fw-bold">Kategory</span>
              </div>
              <div class="col-12 col-md-10">
                <span class="fw-normal">'.$data['category'].'</span>
              </div>
            </div>
            <!-- ./category -->
            
            <!-- file -->
            <div class="row align-items-center py-2 shadow-sm">
              <div class="col-10 col-md-2">
                <span class="fw-bold">File / Lampiran</span>
              </div>
              <div class="col-12 col-md-10">';
                if($data['file'] == null) echo 'Tidak ada file';
                else echo'<a href="../public/file/'.$data['file'].'" class="btn btn-link">'.$data['file'].'</a>';
        echo '</div>
            </div>
            <!-- ./file -->

            <!-- img_cover -->
            <div class="row align-items-center py-2 shadow-sm">
              <div class="col-12">
                <span class="fw-bold">Gambar Header</span>
              </div>
              <div class="col-12">
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
  
  } // end pages post
} // end function
?>
