<?php 
  /* PAGE USER */
  $pages = GET('pages','');
  $views = GET('views','index');

  function form($type='',$label='',$data='')
  {
    if($type === 'img')
    {
      echo '
        <div class="row mb-3">
          <div class="col-sm-2">
            <p class="fw-bold">'.$label.'</p>
          </div>
          <div class="col-sm-8">
            <img src="../public/img/'.$data.'" class="rounded-circle" width="100" height="100"/>
          </div>
        </div>
      ';
    }
    else 
    {
      echo '
        <div class="row mb-3">
          <div class="col-sm-2">
            <span class="fw-bold">'.$label.'</span>
          </div>
          <div class="col-sm-8">
            <span>'.$data.'</span>
          </div>
        </div>
      ';
    }
  }
  function user()
  {
    global $conn;
    global $pages;
    global $views;

    if($pages === 'user')
    {
      // get variable
      $name = htmlspecialchars(GET('name',''));
      $email = htmlspecialchars(GET('email',''));
      $password = htmlspecialchars(GET('password',''));
      $role = htmlspecialchars(GET('role',''));
      $author = htmlspecialchars(GET('author',''));

      if($views === 'userdetail')
      {
        echo '
          <div class="card mt-4">
            <div class="card-header bg-white">
              <h1 class="fs-3 fw-normal">Informasi User</h3>
            </div>
            <div class="card-body">';
             form('img','Foto Profil','img-1.jpg'); // img
             form('','Nama','Yayak Yogi Ginantaka'); // name
             form('','Email','yayaktaka@gmail.com'); // email
             form('','No Handphone','08123456789'); // phone
             form('','Role','Admin'); // role
             form('','Tanggal Dibuat','05-12-2021 20:00:02'); // created_at
             form('','Tanggal Diubah','06-12-2021 10:20:19'); // updated_at
             form('','Dibuat oleh','Superadmin'); // author
        echo '<a href="#" class="btn btn-primary mt-3"><i class="fas fa-edit"></i> Edit</a>
            </div><!-- ./card-body -->
          </div><!-- ./card -->
        ';
      } // end views index
    } // end pages user
  } // end function user
?>