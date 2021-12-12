<?php 
  /* PAGE USER */
  $pages = GET('pages','');
  $views = GET('views','index');

  function user()
  {
    global $conn;
    global $pages;
    global $views;

    $user_id = $_SESSION['user_id'];
    $query = "SELECT * FROM tb_user WHERE id='$user_id'";
    $sql = mysqli_query($conn,$query);
    $data = mysqli_fetch_assoc($sql);
    $author = $data['name'];

    if($pages === 'user')
    {
      // get variable
      $exec = htmlspecialchars(GET('exec',''));
      $name = htmlspecialchars(GET('name',''));
      $email = htmlspecialchars(GET('email',''));
      $phone = htmlspecialchars(GET('phone',''));
      $password = htmlspecialchars(GET('password',''));
      $password2 = htmlspecialchars(GET('password2',''));
      $password_old = htmlspecialchars(GET('password_old',''));
      $role = htmlspecialchars(GET('role',''));

      if($views === 'index')
      {
        $query = "SELECT * FROM tb_user WHERE role='Admin' ORDER BY created_at DESC";
        $sql = mysqli_query($conn,$query);
        $count = mysqli_num_rows($sql);
        $i=1;
        echo '
          <div class="card mt-4 shadow">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
              <h1 class="fs-3">Data Admin</h1>
              <a href="?pages='.$pages.'&views=add" class="btn btn-sm btn-success">
                <i class="fas fa-plus"></i> Tambah
              </a>
            </div>
            <div class="card-body">
              <div class="table-responsive-sm">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th class="text-center">&#8470;</th>
                      <th class="text-center">Nama</th>
                      <th class="text-center">Email</th>
                      <th class="text-center">No Handphone</th>
                      <th class="text-center">Foto</th>
                      <th class="text-center">Terakhir Diubah</th>
                      <th class="text-center">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>';
                  while($data = mysqli_fetch_assoc($sql))
                  {
                     echo '<tr>';
                      echo '<td class="text-center">'.$i++.'</td>';
                      echo '<td>'.$data['name'].'</td>';
                      echo '<td>'.$data['email'].'</td>';
                      echo '<td class="text-center">'.$data['phone'].'</td>';
                      echo '<td class="text-center">
                        <img src="../public/img_profile/'.$data['img'].'" class="rounded-circle" width="50" height="50"/>
                      </td>';
                      echo '<td class="text-center">'.date("d M Y, G:i",strtotime($data['updated_at'])).'</td>';
                      echo '<td class="text-center">
                        <a 
                          class="d-inline-block btn btn-sm btn-primary mb-1" 
                          href="?pages='.$pages.'&views=userdetail&id='.$data['id'].'">
                            <i class="fas fa-eye"></i> Detail
                        </a> 
                        <a 
                          class="d-inline-block btn btn-sm btn-warning mb-1" 
                          href="?pages='.$pages.'&views=edit&id='.$data['id'].'">
                            <i class="fas fa-edit"></i> Edit
                        </a> 
                        <a 
                          class="d-inline-block btn btn-sm btn-danger mb-1" 
                          href="?pages='.$pages.'&views=delete&id='.$data['id'].'">
                            <i class="fas fa-trash"></i> Hapus
                        </a> 
                      </td>';
                      echo '</tr>';
                  }
                if($count<=0) echo '<tr><td colspan="7" class="text-center">Data kosong</td></tr>';
                echo '</tbody>
                </table><!-- ./table -->
              </div><!-- ./table-responsive-sm -->
            </div><!-- ./card-body -->
          </div><!-- ./card -->
        ';
      } // end index

      if($views === 'userdetail')
      {
        $id = htmlspecialchars(GET('id',''));
        if($id === '') {
          echo '<script>window.location="?pages=user&views=index&msg=idnull"</script>';
          exit;
        }
        $query = "SELECT * FROM tb_user WHERE id='$id'";
        $sql = mysqli_query($conn,$query);
        $data = mysqli_fetch_assoc($sql);

        echo '
          <div class="card mt-4">
            <div class="card-header bg-white">
              <h1 class="fs-3 fw-normal">Informasi User</h3>
            </div>
            <div class="card-body" style="font-size:0.95rem;">';
             formDetail('img','Foto Profil',$data['img']); // img
             formDetail('','Nama',$data['name']); // name
             formDetail('','Email',$data['email']); // email
             formDetail('','No Handphone',$data['phone']); // phone
             formDetail('','Role',$data['role']); // role
             formDetail('','Tanggal Dibuat',date("d M Y, G:i",strtotime($data['created_at']))); // created_at
             formDetail('','Tanggal Diubah',date("d M Y, G:i",strtotime($data['updated_at']))); // updated_at
             formDetail('','Dibuat oleh',$data['author']); // author
        echo '
            </div><!-- ./card-body -->
            <div class="card-footer">
              <a href="?pages='.$pages.'&views=edit&id='.$id.'" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Edit Profil</a>
            </div>
          </div><!-- ./card -->
        ';
      } // end views userdetail

      if($views === 'add')
      {
        if($exec && $name && $email && $phone && $password && $password2)
        {
          $mail = "SELECT email FROM tb_user WHERE email='$email'";
          $sql = mysqli_query($conn,$mail);
          $count_mail = mysqli_num_rows($sql);
          $id = md5(time());
          $img = $_FILES['img']['name'];
          // email validation
          if($count_mail <= 0)
          {
            // password validation range
            if(strlen($password) >= 8)
            {
              // password validation  
              if($password == $password2)
              {
                $hash_password = password_hash($password,PASSWORD_DEFAULT);
                // check img
                if($img)
                {
                  $x = explode('.',$img);
                  $ektensi = strtolower(end($x));
                  $tmp_img = $_FILES['img']['tmp_name'];
                  $size_img = $_FILES['img']['size'];
                  $dir_img = "../public/img_profile/";
                  $ektensi_allowed = array('png','jpg','jpeg');
                  // validation ektention
                  if(in_array($ektensi,$ektensi_allowed) === true)
                  {
                    // validation size 
                    if($size_img<2044070)
                    {
                      $time = time();
                      $file_name = $time.'_'.$img;
                      move_uploaded_file($tmp_img,$dir_img.$file_name);
                      $query = "INSERT INTO tb_user VALUES ('$id','$name','$email','$phone','$hash_password','$role','$file_name',NOW(),NOW(),'$author')";
                      $sql = mysqli_query($conn,$query);
                      if($sql)
                      {
                        GET('exec','');
                        echo '<script>window.location="?pages='.$pages.'&status=200&message=adduser"</script>';
                      } // cek query
                      else echo mysqli_error($conn);
                    } // validation size
                    else echo '<script>window.location="?pages='.$pages.'&views='.$views.'&status=400&message=limitedsize"</script>';
                  } // validation ektensi
                  else echo '<script>window.location="?pages='.$pages.'&views='.$views.'&status=400&message=extensionnotallowed"</script>';
                }
                else
                {
                  $query = "INSERT INTO tb_user VALUES('$id','$name','$email','$phone','$hash_password','$role','default.png',NOW(),NOW(),'$author')";
                  $sql = mysqli_query($conn,$query);
                  if($sql)
                  {
                    GET('exec','');
                    echo '<script>window.location="?pages='.$pages.'&status=200&message=adduser"</script>';
                  }
                  else echo mysqli_error($conn);
                }
              } // password validation
              else echo '<script>window.location="?pages='.$pages.'&views='.$views.'&status=400&message=passnotmatch"</script>';
            } // password legnth
            else echo '<script>window.location="?pages='.$pages.'&views='.$views.'&status=400&message=passlength"</script>';
          } // validation email
          else echo '<script>window.location="?pages='.$pages.'&views='.$views.'&status=400&message=emailavailable"</script>';
        }

        echo '
          <div class="card mt-4">
            <div class="card-header bg-white">
              <h1 class="fs-3">Tambah User</h1>
            </div>
            <div class="card-body" style="font-size:0.9rem;">
              <form method="POST" action="?pages='.$pages.'&views='.$views.'" enctype="multipart/form-data">
                <input type="hidden" name="exec" value="'.time().'"/>
                <div class="row">
                  <div class="col-md-8">';
                    formInput('add-admin','','Nama','name','Masukkan nama admin','');
                    formInput('add-admin','email','Email','email','Masukkan email','');
                    formInput('add-admin','','No Handphone','phone','Masukkan nomor handphone');
                    formInput('add-admin','password','Password','password','Password minimal 8 karakter','');
                    formInput('add-admin','password','Ulangi Password','password2','Ulangi password lagi','');
                    formInput('add-admin','file','Foto Profil','img','','');
                    echo '
                      <div class="row">
                      <label for="role" class="col-sm-3 fw-bold">Role</label>
                        <div class="col-sm-6">
                          <select class="form-select" name="role">
                            <option value="Admin">Admin</option>
                            <option value="SuperAdmin">SuperAdmin</option>
                          </select>
                        </div>
                      </div>
                    ';
              echo '<button type="submmit" class="btn btn-success mt-3"><i class="fas fa-save"></i> Simpan</button>
                  </div><!-- ./col-md-6 -->
                </div><!-- ./row -->
              </form><!-- ./form -->
            </div><!-- ./card-body -->
          </div><!-- ./card -->
        ';
      } // end add admin

      if($views === 'edit')
      {
        $id = GET('id','');
        $query = "SELECT * FROM tb_user WHERE id='$id'";
        $sql = mysqli_query($conn,$query);
        $data = mysqli_fetch_assoc($sql);
        if(mysqli_num_rows($sql)<=0)
        {
          echo '<script>window.location="?pages=setting"</script>';
          exit;
        }

        if($exec & $id)
        {
          $query = "UPDATE tb_user SET name='$name',email='$email',phone='$phone',updated_at=NOW() WHERE id='$id'";
          $sql = mysqli_query($conn,$query);
          if($sql)
          {
            GET('exec','');
           echo '<script>window.location="?pages=setting&status=200&message=edituser"</script>';
          }
        }

        echo '
          <div class="card mt-4">
            <div class="card-header bg-white">
              <h1 class="fs-3">Edit Data</h1>
            </div>
            <div class="card-body"  style="font-size:0.9rem;">
              <form method="POST" action="?pages='.$pages.'&views='.$views.'">
                <input type="hidden" name="exec" value="'.time().'"/>
                <input type="hidden" name="id" value="'.$data['id'].'"/>
                ';
                formDetail('img','Foto Profil',$data['img']);
          echo '
                <!-- change photo profile -->
                <div class="row mb-3">
                  <div class="col-sm-2 fw-bold"></div>
                  <div class="col-sm-6">
                    <a 
                      href="?pages='.$pages.'&views=editphoto&id='.$data['id'].'" 
                      class="btn btn-sm btn-outline-secondary fw-bold shadow-sm" 
                      style="font-size:0.6rem;"
                    >
                      <i class="fas fa-id-badge me-1"></i> Ganti Foto Profil
                    </a>
                  </div>
                </div>  
              ';
                formInput('edit-admin','edit','Nama','name','Masukkan nama admin',$data['name']);
                formInput('edit-admin','edit','Email','email','Masukkan email admin',$data['email']);
                formInput('edit-admin','edit','No Hadphone','phone','Masukkan nomor HP admin',$data['phone']);
          echo '
                <!-- change password --> 
                <div class="row mt-2 align-items-row mb-4">
                  <div class="col-4 col-sm-2 fw-bold mt-1">Password</div>
                  <div class="col-8 col-sm-6">
                    <a 
                      href="?pages='.$pages.'&views=editpassword&id='.$data['id'].'" 
                      class="btn btn-sm btn-outline-secondary mt-1 fw-bold shadow-sm" 
                      style="font-size:0.6rem;"
                    >
                        <i class="fas fa-unlock-alt me-1"></i> Ganti Password
                    </a>
                  </div>
                </div><!-- ./row -->
                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan</button>
              </form>
            </div><!-- ./card-body -->
          </div><!-- ./card -->
        ';
      } // end edit data admin

      if($views === 'editphoto')
      {
        $id = GET('id','');
        $query = "SELECT img FROM tb_user WHERE id='$id'";
        $sql = mysqli_query($conn,$query);
        if(!$sql) echo '<script>window.location="?pages='.$pages.'&views=index"</script>';
        $data = mysqli_fetch_assoc($sql);

        if($exec && $id)
        {
          $img = $_FILES['img']['name'];
          if($img)
          {
            $x = explode('.',$img);
            $ektensi = strtolower(end($x));
            $tmp_img = $_FILES['img']['tmp_name'];
            $size_img = $_FILES['img']['size'];
            $dir_img = "../public/img_profile/";
            $ektensi_allowed = array('png','jpg','jpeg');
            // validation ektention
            if(in_array($ektensi,$ektensi_allowed) === true)
            {
              // validation size 
              if($size_img<2044070)
              {
                $time = time();
                $file_name = $time.'_'.$img;
                move_uploaded_file($tmp_img,$dir_img.$file_name);
                $query = "UPDATE tb_user SET img='$file_name' WHERE id='$id'";
                $sql = mysqli_query($conn,$query);
                if($sql)
                {
                  GET('exec','');
                  echo '<script>window.location="?pages=setting&status=200&message=editphoto"</script>';
                } // cek query
                else echo mysqli_error($conn);
              } // validation size
              else echo '<script>window.location="?pages='.$pages.'&views='.$views.'&id='.$id.'&status=400&message=limitedsize"</script>';
            } // validation ektensi
            else echo '<script>window.location="?pages='.$pages.'&views='.$views.'&id='.$id.'&status=400&message=extensionnotallowed"</script>';
          } // validation img not found
          else echo '<script>window.location="?pages='.$pages.'&views='.$views.'&id='.$id.'&status=400&message=formcantempty"</script>';
        } // validation  form
        
        echo '
          <div class="card mt-4">
            <div class="card-header bg-white">
              <h1 class="fs-3">Edit Foto Profil</h1>
            </div>
            <div class="card-body">
              <form method="POST" action="?pages='.$pages.'&views='.$views.'" enctype="multipart/form-data">
                <input type="hidden" name="exec" value="'.time().'"/>
                <input type="hidden" name="id" value="'.$id.'"/>
                ';
                  formDetail('img','Foto Profil',$data['img']);
                  formInput('file','Upload Foto Baru','img','','');
              echo'
                <button type="submit" class="btn btn-success mt-2">Simpan</button>
              </form><!-- ./form -->
            </div><!-- ./card-body -->
          </div><!-- ./card -->
        ';
      } // end edit photo

      if($views === 'editpassword')
      {
        $id = GET('id','');
        if($exec && $id)
        {
          if($password && $password2 && $password_old)
          {
            $query = "SELECT * FROM tb_user WHERE id='$id'";
            $sql = mysqli_query($conn,$query);
            if(mysqli_num_rows($sql))
            {
              $data = mysqli_fetch_assoc($sql);
              if(password_verify($password_old,$data['password']))
              {
                if(strlen($password) >= 8 && strlen($password2) >= 8)
                {
                  if($password == $password2)
                  {
                    $password_hash = password_hash($password,PASSWORD_DEFAULT);
                    $query = "UPDATE tb_user SET password='$password_hash' WHERE id='$id'";
                    $sql = mysqli_query($conn,$query);
                    $rows = mysqli_affected_rows($conn);
                    if($rows > 0)
                    {
                      GET('exec','');
                      echo '<script>window.location="?pages=setting&status=200&message=editpass"</script>';
                    }
                    else echo '<script>window.location="?pages='.$pages.'&views='.$views.'&id='.$id.'&status=400&message=passchange"</script>';
                  } // validation password and password validation
                  else echo '<script>window.location="?pages='.$pages.'&views='.$views.'&id='.$id.'&status=400&message=passconfirm"</script>';
                } // verify length password
                else echo '<script>window.location="?pages='.$pages.'&views='.$views.'&id='.$id.'&status=400&message=passlength"</script>';
              } // verify old password
               else echo '<script>window.location="?pages='.$pages.'&views='.$views.'&id='.$id.'&status=400&message=passnotmatch"</script>';
            } // count data
            else echo '<script>window.location="?pages='.$pages.'&views='.$views.'&id='.$id.'&status=404&message=datanotfound"</script>';
          } // validation form
          else echo '<script>window.location="?pages='.$pages.'&views='.$views.'&id='.$id.'&status=400&message=formcantempty"</script>';
        }
        echo '
          <div class="card mt-4">
            <div class="card-header bg-white">
              <h1 class="fs-3">Edit Password</h1>
            </div>
            <div class="card-body">
              <form method="POST" action="?pages='.$pages.'&views='.$views.'">
                <input type="hidden" name="exec" value="'.time().'"/>
                <input type="hidden" name="id" value="'.$id.'"/>
                ';
                formInput('','password','Password Lama','password_old','Masukkan password lama');
                formInput('','password','Password Baru','password','Masukkan password baru');
                formInput('','password','Ulangi Password','password2','Ulangi password baru');
          echo '
                <button type="submit" class="btn btn-success mt-3"><i class="fas fa-save"></i> Simpan</button>
              </form>
            </div>
          </div><!-- ./card -->
        ';
      } // end edit password

      if($views === 'delete')
      {
        $id = GET('id','');
        $query = "SELECT name FROM tb_user WHERE id='$id'";
        $sql = mysqli_query($conn,$query);
        $data = mysqli_fetch_assoc($sql);

        if($exec && $id)
        {
          $query = "DELETE FROM tb_user WHERE id='$id'";
          $sql = mysqli_query($conn,$query);
          if(mysqli_affected_rows($conn) > 0)
          {
            GET('exec','');
            echo '<script>window.location="?pages='.$pages.'&status=200&message=deleteuser"</script>';
          }
          else echo 'Gagal';
        }
        echo '
          <div class="card mt-4">
            <div class="card-header bg-white">
              <h1 class="fs-3">Hapus Data</h1>
            </div>
            <div class="card-body">
              <div class="bg-danger mb-3 p-2 rounded text-white">Apakah anda yakin ingin menghapus data '.$data['name'].' ?</div>
              <form method="POST" action="?pages='.$pages.'&views='.$views.'">
                <input type="hidden" name="exec" value="'.time().'"/>
                <input type="hidden" name="id" value="'.$id.'"/>
                <a href="?pages='.$pages.'&views=index" class="btn btn-light"><i class="fas fa-ban"></i> Batal</a>
                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Hapus</button>
              </form>
            </div><!-- ./card-body -->
          </div><!-- ./card -->
        ';
      } // end delete data

      if($views === 'logout')
      {
        $_SESSION=[];
        session_unset();
        session_destroy();
        $_SESSION['isLoginAdmin'] = false;
        $_SESSION['isLoginSuperAdmin'] = false;
        header("Location:./login.php");
      }
    } // end pages user
  } // end function user
?>