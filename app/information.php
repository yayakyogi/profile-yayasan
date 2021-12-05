<?php 
  /* PAGE POST */
  $pages = GET('pages','');
  $views = GET('views','index');

  function information()
  {
    global $conn;
    global $pages;
    global $views;

    if($pages === 'information')
    {
      // variable
      $exec = htmlspecialchars(GET('exec',''));
      $name = htmlspecialchars(GET('name',''));
      $email = htmlspecialchars(GET('email',''));
      $phone = htmlspecialchars(GET('phone',''));
      $address = htmlspecialchars(GET('address',''));
      $facebook_name = htmlspecialchars(GET('facebook_name',''));
      $facebook_link = htmlspecialchars(GET('facebook_link',''));
      $instagram_name = htmlspecialchars(GET('instagram_name',''));
      $instagrem_link = htmlspecialchars(GET('instagram_link',''));
      $youtube_name = htmlspecialchars(GET('youtube_name',''));
      $youtube_link = htmlspecialchars(GET('youtube_link',''));

      if($views === 'index')
      {
        $query = "SELECT * FROM tb_information";
        $sql = mysqli_query($conn,$query);
        $data = mysqli_fetch_assoc($sql);
        echo '
          <div class="card mt-4">
            <div class="card-header bg-white">
              <h1 class="fs-3 fw-normal">Informasi Yayasan</h3>
            </div>
            <div class="card-body">
              <h5 class="fw-normal">Profil</h5>
              <!-- name -->
              <div class="row mb-2">
                <div class="col-12 col-md-2">
                  <span class="fw-bold">Nama</span>
                </div>
                <div class="col-12 col-md-10">
                  <span>: '.$data['name'].'</span>
                </div>
              </div>
              
              <!-- address -->
              <div class="row mb-2">
                <div class="col-12 col-md-2">
                  <span class="fw-bold">Alamat</span>
                </div>
                <div class="col-12 col-md-10">
                  <span>: '.$data['address'].'</span>
                </div>
              </div>

               <!-- telephone -->
                <div class="row mb-2">
                  <div class="col-12 col-md-2">
                    <span class="fw-bold">Telepon</span>
                  </div>
                  <div class="col-12 col-md-10">
                    <span>: '.$data['phone'].'</span>
                  </div>
                </div>

                <!-- email -->
                <div class="row mb-2">
                  <div class="col-12 col-md-2">
                    <span class="fw-bold">Email</span>
                  </div>
                  <div class="col-12 col-md-10">
                    <span>: '.$data['email'].'</span>
                  </div>
                </div>

                <!-- social media -->
                <h5 class="fw-normal mt-3">Sosial Media</h5>
                <div class="row mb-2">
                  <div class="col-12 col-md-2">
                    <span class="fw-bold">Facebook</span>
                  </div>
                  <div class="col-12 col-md-10">
                    : ';
                    if($data['facebook_name']) echo '<a href="#" class="text-decoration-none">'.$data['facebook_name'].'</a>';
                    else echo "Kosong";
            echo '</div>
                </div><!-- ./facebook -->

                <div class="row mb-2">
                  <div class="col-12 col-md-2">
                    <span class="fw-bold">Instagram</span>
                  </div>
                  <div class="col-12 col-md-10">
                    : ';
                    if($data['instagram_name']) echo '<a href="#" class="text-decoration-none">'.$data['instagram_name'].'</a>';
                    else echo "Kosong";
            echo '</div>
                </div><!-- ./instagram -->

                <div class="row mb-2">
                  <div class="col-12 col-md-2">
                    <span class="fw-bold">YouTube</span>
                  </div>
                  <div class="col-12 col-md-10">
                    : ';
                    if($data['youtube_name']) echo '<a href="#" class="text-decoration-none">'.$data['youtube_name'].'</a>';
                    else echo "Kosong";
            echo '</div>
                </div><!-- ./youtube -->
              </div><!-- ./card-body -->

              <div class="card-footer bg-white pt-0 pb-3">
                <a href="?pages='.$pages.'&views=add" class="btn btn-sm btn-light px-3 mt-3"><i class="fas fa-plus"></i> Tambah</a>
                <a href="?pages='.$pages.'&views=edit&id='.$data['id'].'" class="btn btn-sm btn-primary px-3 mt-3"><i class="fas fa-edit"></i> Edit</a>
              </div>
          </div><!-- ./card -->
        ';
      } // end of index

      if($views === 'add')
      {
        if($exec && $name && $phone && $address)
        {
          $id = md5(time());
          $query = "INSERT INTO tb_information 
                    VALUES(
                      '$id','$name','$email','$phone','$address',
                      '$facebook_name','$facebook_link',
                      '$instagram_name','$instagrem_link',
                      '$youtube_name','$youtube_link',
                      NOW(),NOW()
                    )";
          $sql = mysqli_query($conn,$query);
          if($sql)
          {
            GET('exec','');
            echo '<script>window.location="?pages='.$pages.'&views=index"</script>';
          }
          else mysqli_error($conn);
        }
        echo '
            <div class="card mt-4">
              <div class="card-header bg-white">
                <h1 class="fs-3 fw-normal">Input Informasi Yayasan</h3>
              </div>
              <div class="card-body pe-5">
                <form method="POST" action="?pages='.$pages.'&views='.$views.'">
                  <input type="hidden" name="exec" value="'.time().'"/>
                  <h5 class="fw-normal">Profil</h5>
                  <div class="row mb-2">
                      <label for="name" class="col-sm-2 col-form-label">Nama Yayasan</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Masukkan nama yayasan">
                      </div>
                  </div><!-- ./name -->

                  <div class="row">
                    <div class="col-12 col-sm-6"> 
                      <div class="row mb-2">
                        <label for="phone" class="col-sm-4 col-form-label">Telepon</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" name="phone" id="phone" placeholder="Masukkan nomor telepon yayasan">
                        </div>
                      </div>
                    </div><!-- ./phone -->

                    <div class="col-12 col-sm-6">    
                      <div class="row mb-2">
                        <label for="email" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                          <input type="email" class="form-control" name="email" id="email" placeholder="Masukkan email yayasan">
                        </div>
                      </div>
                    </div><!-- ./email -->
                  </div>

                  <div class="row mb-2">
                    <label for="address" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" name="address" id="address" placeholder="Masukkan alamat lengkap yayasan"></textarea>
                    </div>
                  </div><!-- ./alamat -->

                  <h5 class="fw-normal mt-4">Sosial Media</h5>
                  <!-- facebook --> 
                  <div class="row">
                    <div class="col-12 col-sm-6"> 
                      <div class="row mb-2">
                        <label for="facebook_name" class="col-sm-4 col-form-label">Nama Facebook</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" name="facebook_name" id="facebook_name" placeholder="Masukkan nama facebook">
                        </div>
                      </div>
                    </div><!-- ./name profile facebook -->

                    <div class="col-12 col-sm-6">    
                      <div class="row mb-2">
                        <label for="facebook_link" class="col-sm-2 col-form-label">Link</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="facebook_link" id="facebook_link" placeholder="Link facebook yayasan">
                        </div>
                      </div>
                    </div><!-- ./link -->
                  </div><!-- ./facebook -->

                   <!-- instagram --> 
                  <div class="row">
                    <div class="col-12 col-sm-6"> 
                      <div class="row mb-2">
                        <label for="instagram_name" class="col-sm-4 col-form-label">Nama Instagram</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" name="instagram_name" id="instagram_name" placeholder="Masukkan nama instagram">
                        </div>
                      </div>
                    </div><!-- ./name profile instagram -->

                    <div class="col-12 col-sm-6">    
                      <div class="row mb-2">
                        <label for="instagram_link" class="col-sm-2 col-form-label">Link</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="instagram_link" id="instagram_link" placeholder="Link instagram yayasan">
                        </div>
                      </div>
                    </div><!-- ./link -->
                  </div><!-- ./instagram -->

                  <!-- youtube -->
                  <div class="row">
                    <div class="col-12 col-sm-6"> 
                      <div class="row mb-2">
                        <label for="youtube_name" class="col-sm-4 col-form-label">Nama YoutTube</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" name="youtube_name" id="youtube_name" placeholder="Masukkan nama youtube">
                        </div>
                      </div>
                    </div><!-- ./name profile youtube -->

                    <div class="col-12 col-sm-6">    
                      <div class="row mb-2">
                        <label for="youtube_link" class="col-sm-2 col-form-label">Link</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="youtube_link" id="youtube_link" placeholder="Link youtube yayasan">
                        </div>
                      </div>
                    </div><!-- ./link -->
                  </div><!-- ./youtube -->

                  <button type="submit" class="btn btn-success mt-3">Simpan</button>
                </form>
              </div><!-- ./card-body -->
            </div><!-- ./card -->
        ';
      } // emd of add

      if($views === 'edit')
      {
        $id = GET('id','');
        if($exec && $id)
        {
          $query_update = "UPDATE tb_information SET 
                          name='$name',email='$email',phone='$phone',address='$address',
                          facebook_name='$facebook_name',facebook_link='$facebook_link',
                          instagram_name='$instagram_name',instagram_link='$instagrem_link',
                          youtube_name='$youtube_name',youtube_link='$youtube_link',
                          updated_at=NOW()
                          WHERE id='$id'
                          ";
          $sql_update = mysqli_query($conn,$query_update);
          if($sql_update)
          {
            GET('exec','');
            echo '<script>window.location="?pages='.$pages.'&views=index"</script>';
          }
        }

        $query_edit = "SELECT * FROM tb_information WHERE id='$id'";
        $sql_edit = mysqli_query($conn,$query_edit);
        $data = mysqli_fetch_assoc($sql_edit);

        echo '
            <div class="card mt-4">
              <div class="card-header bg-white">
                <h1 class="fs-3 fw-normal">Edit Informasi Yayasan</h3>
              </div>
              <div class="card-body pe-5">
                <form method="POST" action="?pages='.$pages.'&views='.$views.'">
                  <input type="hidden" name="exec" value="'.time().'"/>
                  <input type="hidden" name="id" value="'.$data['id'].'"/>
                  <h5 class="fw-normal">Profil</h5>
                  <div class="row mb-2">
                      <label for="name" class="col-sm-2 col-form-label">Nama Yayasan</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Masukkan nama yayasan" value="'.$data['name'].'">
                      </div>
                  </div><!-- ./name -->

                  <div class="row">
                    <div class="col-12 col-sm-6"> 
                      <div class="row mb-2">
                        <label for="telephone" class="col-sm-4 col-form-label">Telepon</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" name="phone" id="telephone" placeholder="Masukkan nomor telepon" value="'.$data['phone'].'">
                        </div>
                      </div>
                    </div><!-- ./phone -->

                    <div class="col-12 col-sm-6">    
                      <div class="row mb-2">
                        <label for="email" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                          <input type="email" class="form-control" name="email" id="email" placeholder="Masukkan email" value="'.$data['email'].'">
                        </div>
                      </div>
                    </div><!-- ./email -->
                  </div>

                  <div class="row mb-2">
                    <label for="address" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" name="address" id="address" placeholder="Masukkan alamat lengkap">'.$data['address'].'</textarea>
                    </div>
                  </div><!-- ./alamat -->

                  <h5 class="fw-normal mt-4">Sosial Media</h5>
                  <!-- facebook --> 
                  <div class="row">
                    <div class="col-12 col-sm-6"> 
                      <div class="row mb-2">
                        <label for="facebook_name" class="col-sm-4 col-form-label">Nama Facebook</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" name="facebook_name" id="facebook_name" placeholder="Masukkan nama facebook" value="'.$data['facebook_name'].'">
                        </div>
                      </div>
                    </div><!-- ./name profile facebook -->

                    <div class="col-12 col-sm-6">    
                      <div class="row mb-2">
                        <label for="facebook_link" class="col-sm-2 col-form-label">Link</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="facebook_link" id="facebook_link" placeholder="Link facebook yayasan" value="'.$data['facebook_link'].'">
                        </div>
                      </div>
                    </div><!-- ./link -->
                  </div><!-- ./facebook -->

                   <!-- instagram --> 
                  <div class="row">
                    <div class="col-12 col-sm-6"> 
                      <div class="row mb-2">
                        <label for="instagram_name" class="col-sm-4 col-form-label">Nama Instagram</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" name="instagram_name" id="instagram_name" placeholder="Masukkan nama instagram" value="'.$data['instagram_name'].'">
                        </div>
                      </div>
                    </div><!-- ./name profile instagram -->

                    <div class="col-12 col-sm-6">    
                      <div class="row mb-2">
                        <label for="instagram_link" class="col-sm-2 col-form-label">Link</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="instagram_link" id="instagram_link" placeholder="Link instagram yayasan" value="'.$data['instagram_link'].'">
                        </div>
                      </div>
                    </div><!-- ./link -->
                  </div><!-- ./instagram -->

                  <!-- youtube -->
                  <div class="row">
                    <div class="col-12 col-sm-6"> 
                      <div class="row mb-2">
                        <label for="youtube_name" class="col-sm-4 col-form-label">Nama YoutTube</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" name="youtube_name" id="youtube_name" placeholder="Masukkan nama youtube" value="'.$data['youtube_name'].'">
                        </div>
                      </div>
                    </div><!-- ./name profile youtube -->

                    <div class="col-12 col-sm-6">    
                      <div class="row mb-2">
                        <label for="youtube_link" class="col-sm-2 col-form-label">Link</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="youtube_link" id="youtube_link" placeholder="Link youtube yayasan" value="'.$data['youtube_link'].'">
                        </div>
                      </div>
                    </div><!-- ./link -->
                  </div><!-- ./youtube -->

                  <button type="submit" class="btn btn-success mt-3">Simpan</button>
                </form>
              </div><!-- ./card-body -->
            </div><!-- ./card -->
        ';
      } // emd of edit
    }// end of pages
  } // end function
?>
