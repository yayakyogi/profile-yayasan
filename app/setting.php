<?php 
/* PAGE SETTING */
$pages = GET('pages','');
$views = GET('views','index');
function setting()
{
  global $conn;
  global $pages;
  global $views;

  // get id from session
  $id = $_SESSION['user_id'];

  if($pages === 'setting')
  {
    $category_name = htmlspecialchars(GET('',''));
    $type_name = htmlspecialchars(GET('',''));
    $name = htmlspecialchars(GET('',''));
    $email = htmlspecialchars(GET('',''));
    $phone = htmlspecialchars(GET('',''));
    $author = htmlspecialchars(GET('',''));

    if($views === 'index')
    {
      // data category
      $query_category = "SELECT * FROM tb_category ORDER BY id DESC";
      $sql_category = mysqli_query($conn,$query_category);

      // data type
      $query_type = "SELECT * FROM tb_type ORDER BY id DESC";
      $sql_type = mysqli_query($conn,$query_type);

      // data information yayasan
      $query_yayasan = "SELECT * FROM tb_information";
      $sql_yayasan = mysqli_query($conn,$query_yayasan);
      $yayasan = mysqli_fetch_assoc($sql_yayasan);

      // data profil user 
      $query = "SELECT * FROM tb_user WHERE id='$id'";
      $sql = mysqli_query($conn,$query);
      $data = mysqli_fetch_assoc($sql);

      echo '
        <div class="card mt-4 mb-5 shadow">
          <div class="card-header bg-white">
            <h1 class="fs-3">Menu Setting</h1>
          </div>
          <div class="card-body">
          
            <!-- row list category and type -->
            <div class="row">
              <!-- col category -->
              <div class="col-sm-6">
                <h6>Kategori</h6>
                <div class="table-responsive-sm">
                  <table class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th class="text-center">&#8470;</th>
                        <th class="text-center">Kategori</th>
                        <th class="text-center">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>';
                    $i = 1;
                    while( $category = mysqli_fetch_assoc($sql_category))
                    {
                      echo '<tr>';
                        echo '<td class="text-center">'.$i++.'</td>';
                        echo  '<td class="text-center">'.$category['category'].'</td>';
                        echo '<td class="text-center">
                          <a class="d-inline-block btn btn-sm btn-warning mb-1" href="?pages='.$pages.'&views=edit&type=category&id='.$category['id'].'"><i class="fas fa-edit"></i> Edit</a> 
                          <a class="d-inline-block btn btn-sm btn-danger mb-1" href="?pages='.$pages.'&views=delete&type=category&id='.$category['id'].'"><i class="fas fa-trash"></i> Hapus</a> 
                        </td>';
                      echo '</tr>';
                    }
                    echo'
                    </tbody>
                  </table><!-- ./table -->
                </div><!-- ./table-responsive" -->
              </div><!-- ./col category -->
              
              <!-- col type -->
              <div class="col-sm-6">
                <h6>Tipe Postingan</h6>
                <div class="table-responsive-sm">
                  <table class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th class="text-center">&#8470;</th>
                        <th class="text-center">Tipe</th>
                        <th class="text-center">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>';
                    $i = 1;
                    while($type = mysqli_fetch_assoc($sql_type))
                    {
                      echo '<tr>';
                        echo '<td class="text-center">'.$i++.'</td>';
                        echo '<td class="text-center">'.$type['type'].'</td>';
                        echo '<td class="text-center">
                          <a class="d-inline-block btn btn-sm btn-warning mb-1" href="?pages='.$pages.'&views=edit&type=type&id='.$type['id'].'"><i class="fas fa-edit"></i> Edit</a> 
                          <a class="d-inline-block btn btn-sm btn-danger mb-1" href="?pages='.$pages.'&views=delete&type=type&id='.$type['id'].'"> <i class="fas fa-trash"></i> Hapus</a> 
                        </td>';
                      echo '</tr>';
                    }
                    echo '
                    </tbody>
                  </table><!-- ./table -->
                </div><!-- ./table-responsive" -->
              </div><!-- end col type -->
            </div><!-- ./list category and type -->

            <!-- row profile -->
            <div class="row mt-2">
              <!-- col profile yayasan -->
              <div class="col-sm-6">
                <h6 style="font-size:1.1rem;">Profil Yayasan</h6>
                <div class="table-responsive-sm">
                  <table class="table" style="border-color:#FFFFFF">
                    <tbody>
                      <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td>'.$yayasan['name'].'</td>
                      </tr>
                      <tr>
                        <td>No Handphone</td>
                        <td>:</td>
                        <td>'.$yayasan['phone'].'</td>
                      </tr>
                      <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td>'.$yayasan['email'].'</td>
                      </tr>
                      <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td>'.$yayasan['address'].'</td>
                      </tr>
                      <tr>
                        <td colspan="3" class="fs-6">Sosial Media</td>
                      </tr>
                      <tr>
                        <td>Facebook</td>
                        <td>:</td>
                        <td>';
                          if($yayasan['facebook_name'] && $yayasan['facebook_link']) echo '<a href="'.$yayasan['facebook_link'].'" target="_blank"  class="text-decoration-none">'.$yayasan['facebook_name'].'</a>';
                          else echo "Kosong";
                  echo '</td>
                      </tr>
                      <tr>
                        <td>Instagram</td>
                        <td>:</td>
                        <td>';
                          if($yayasan['instagram_name'] && $yayasan['instagram_link']) echo '<a href="'.$yayasan['instagram_link'].'" target="_blank" class="text-decoration-none">'.$yayasan['instagram_name'].'</a>';
                          else echo "Kosong";
                  echo '</td>
                      </tr>
                      <tr>
                        <td>YouTube</td>
                        <td>:</td>
                        <td>';
                          if($yayasan['youtube_name'] && $yayasan['youtube_link']) echo '<a href="'.$yayasan['youtube_link'].'" target="_blank" class="text-decoration-none">'.$yayasan['youtube_name'].'</a>';
                          else echo "Kosong";
                  echo '</td>
                      </tr>
                    </tbody>
                  </table><!-- ./table -->
                  <a href="?pages=information&views=edit&id='.$yayasan['id'].'" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Edit</a>
                </div><!-- ./table-responsive" -->
              </div><!-- ./col-profile yayasan -->

              <!-- col profile user -->
              <div class="col-sm-6">
                <h6 style="font-size:1.1rem;">Profil User</h6>
                <div class="table-responsive-sm">
                  <table class="table" style="border-color:#FFFFFF">
                    <tbody>
                       <tr>
                        <td width="20">Foto Profil</td>
                        <td width="10">:</td>
                        <td width="70">
                          <img src="../public/img_profile/'.$data['img'].'" class="rounded-circle" width="100" height="100"/>
                        </td>
                      </tr>
                      <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td>'.$data['name'].'</td>
                      </tr>
                      <tr>
                        <td>No Handphone</td>
                        <td>:</td>
                        <td>'.$data['phone'].'</td>
                      </tr>
                      <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td>'.$data['email'].'</td>
                      </tr>
                    </tbody>
                  </table><!-- ./table -->
                  <a href="?pages=user&views=edit&id='.$id.'" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Edit</a>
                </div><!-- ./table-responsive" -->
              </div><!-- ./col-profile user -->
            </div><!-- ./row profile -->

          </div><!-- ./card-body -->
        </div><!-- ./card -->
      ';
    } // views index

    if($views === 'edit')
    {
      $id = GET('id','');
      $exec = GET('exec','');
      $type = GET('type','');
      $category = GET('category','');
      $row = '';
      $data = '';
      
      if($type === 'category') 
      {
        $data = 'kategori';
        $query = "SELECT * FROM tb_category WHERE id='$id'";
        $sql = mysqli_query($conn,$query);
        $value = mysqli_fetch_assoc($sql);
        $row = $value['category'];
      }
      else if($type === 'type') 
      {
        $data = 'tipe';
        $query = "SELECT * FROM tb_type WHERE id='$id'";
        $sql = mysqli_query($conn,$query);
        $value = mysqli_fetch_assoc($sql);
        $row = $value['type'];
      }

      if($exec && $type)
      {
        if($type === 'category') 
        {
          $query = "UPDATE tb_category SET category='$category' WHERE id='$id'";
          $sql = mysqli_query($conn,$query);
          if(mysqli_affected_rows($conn) > 0)
          {
            GET('exec','');
            echo '<script>window.location="?pages='.$pages.'&views=index"</script>';
          }
        }
        else 
        {
          $query = "UPDATE tb_type SET type='$type' WHERE id='$id'";
          $sql = mysqli_query($conn,$query);
          if(mysqli_affected_rows($conn) > 0)
          {
            GET('exec','');
            echo '<script>window.location="?pages='.$pages.'&views=index"</script>';
          }
        }
      }
      
      echo '
        <div class="card mt-4">
          <div class="card-header bg-white">
            <h1 class="fs-3">Edit '.ucfirst($data).'</h1>
          </div>
          <div class="card-body">
            <form method="POST" action="?pages='.$pages.'&views='.$views.'">
              <input type="hidden" name="exec" value="'.time().'"/>
              <input type="hidden" name="id" value="'.$id.'"/>
              <input type="hidden" name="type" value="'.$type.'"/>
              ';
              formInput('','edit',ucfirst($data).' Baru',$type,'Masukkan data yang baru',$row);
            echo '
              <button type="submit" class="btn btn-success mt-3"><i class="fas fa-save"></i> Simpan</button>
            </form>
          </div><!-- ./card-body -->
        </div><!-- ./card -->
      ';
    } // end views edit

    if($views === 'delete')
    {
      $id = GET('id','');
      $exec = GET('exec','');
      $type = GET('type','');
      $category = GET('category','');
      $row = '';
      $data = '';
      
      if($type === 'category') 
      {
        $data = 'kategori';
        $query = "SELECT * FROM tb_category WHERE id='$id'";
        $sql = mysqli_query($conn,$query);
        $value = mysqli_fetch_assoc($sql);
        $row = $value['category'];
      }
      else if($type === 'type') 
      {
        $data = 'tipe';
        $query = "SELECT * FROM tb_type WHERE id='$id'";
        $sql = mysqli_query($conn,$query);
        $value = mysqli_fetch_assoc($sql);
        $row = $value['type'];
      }

      if($exec && $type)
      {
        if($type === 'category') 
        {
          $query = "DELETE FROM tb_category WHERE id='$id'";
          $sql = mysqli_query($conn,$query);
          if(mysqli_affected_rows($conn) > 0)
          {
            GET('exec','');
            echo '<script>window.location="?pages='.$pages.'&views=index"</script>';
          }
        }
        else 
        {
          $query = "DELETE FROM tb_type WHERE id='$id'";
          $sql = mysqli_query($conn,$query);
          if(mysqli_affected_rows($conn) > 0)
          {
            GET('exec','');
            echo '<script>window.location="?pages='.$pages.'&views=index"</script>';
          }
        }
      }
      
      echo '
        <div class="card mt-4">
          <div class="card-header bg-white">
            <h1 class="fs-3">Edit '.ucfirst($data).'</h1>
          </div>
          <div class="card-body">
            <div class="bg-danger p-2 text-white rounded">Anda yakin ingin menghapus data <span class="fw-bold">'.$row.'</span> ?</div>
            <form method="POST" action="?pages='.$pages.'&views='.$views.'">
              <input type="hidden" name="exec" value="'.time().'"/>
              <input type="hidden" name="id" value="'.$id.'"/>
              <input type="hidden" name="type" value="'.$type.'"/>
              <a href="?pages='.$pages.'&views=index" class="btn btn-light mt-3"><i class="fas fa-ban"></i> Batal</a>
              <button type="submit" class="btn btn-danger mt-3"><i class="fas fa-trash"></i> Hapus</button>
            </form>
          </div><!-- ./card-body -->
        </div><!-- ./card -->
      ';
    } // end views delete
  } // page setting
} // end setting
?>