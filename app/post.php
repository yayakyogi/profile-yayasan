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
    $author = htmlspecialchars(GET('author',''));
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
                      <th class="text-center">Judul</th>
                      <th class="text-center">Kategori</th>
                      <th class="text-center">Image</th>
                      <th class="text-center">File</th>
                      <th class="text-center">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>Berita</td>
                      <td>Lorem ipsum dolor sum ipsum amet</td>
                      <td>Tak Berkategori</td>
                      <td><img src="../public/img/img-1.jpg" class="rounded" width="100" height="50"/></td>
                      <td>contoh-file.pdf</d>
                      <td class="text-center">
                        <a class="d-inline-block btn btn-sm btn-primary mb-1" href="#"><i class="fas fa-eye"></i> Lihat</a>
                        <a class="d-inline-block btn btn-sm btn-warning mb-1" href="#"><i class="fas fa-edit"></i> Edit</a>
                        <a class="d-inline-block btn btn-sm btn-danger mb-1" href="#"><i class="fas fa-trash"></i> Hapus</a>
                      </td>
                    </tr>
                  </tbody>
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
      if($exec && $author && $type && $category && $title && $content)
      {
        $img_cover = $_FILES['img_cover']['name'];
        $file = $_FILES['files']['name'];
        $id = md5(time());
        if($img_cover)
        {
          $x = explode('.',$img_cover);
          $ekstensi_img = strtolower(end($x));
          $img_temporary = $_FILES['img_cover']['name'];
          
        }
        //$query = "INSER INTO tb_post VALUES ('$id','$author','$type','$category','$title','$content','$img_cover','$file')";
        //$sql = mysqli_query($conn,$query);
        //if($sql)
        //{
          //GET('exec','');
          //$views = 'index';
          //echo "<script>window.location='?pages=post'</script>";
        //} 
      }
      echo '
        <div class="card mt-4">
          <div class="card-header bg-white">
            <h4>Tambah Postingan</h4>
          </div> 
          <div class="card-body">
            <form method="POST" action="?pages='.$pages.'&views='.$views.'" class="form-post">
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
                    <input class="form-control" type="file" name="image" id="formFile">
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

    if($views === 'update')
    {
      echo 'ini halaman update berita';
    } // end update berita

    if($views === 'delete')
    {
      echo 'Ini halaman delete berita';
    } // end view upate

  } // end pages news
} // end function
?>
