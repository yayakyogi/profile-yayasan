<?php 
  function formDetail($type='',$label='',$data='')
  {
    echo '
      <div class="row mb-2">
        <div class="col-4 col-sm-2">
          <span class="fw-bold">'.$label.'</span>
        </div>
        <div class="col-8">';
          if($type == 'img') echo '<img src="../public/img_profile/'.$data.'" alt="'.$data.'" class="rounded-circle mb-3" width="100" height="100"/><br/>';
          else echo ' <span>'.$data.'</span>';
        echo '</div>
      </div>
    ';
  } // formDetail

  function formInput($type='',$label='',$name='',$placeholder='',$value='')
  {
    echo '
      <div class="row mb-2">
        <label for="name" class="col-sm-2 col-form-label fw-bold">'.$label.'</label>
        <div class="col-sm-6">';
          if($type === 'file') echo '<input type="file" class="form-control" name="'.$name.'" id="'.$name.'" placeholder="'.$placeholder.'"  autocomplete="off">';
          else if($type === 'edit') echo '<input type="text" class="form-control" name="'.$name.'" id="'.$name.'" placeholder="'.$placeholder.'" value="'.$value.'"  autocomplete="off">';
          else echo '<input type="'.$type.'" class="form-control" name="'.$name.'" id="'.$name.'" placeholder="'.$placeholder.'"  autocomplete="off">';
  echo '</div>
      </div>
    ';  
  } // form input
?>