<?php 
  /* HALAMAN BERITA */
  $pages = GET('pages','');
  $views = GET('views','');

  function berita()
  {
    global $pages;
    global $views;

    if($pages === 'article')
    {
      if($views === 'index')
      {
        echo 'Ini halaman index artikel';
      } // end view index
      
      if($views === 'add')
      {
        echo 'Ini halaman tambah article
      } // end view tambah article

      if($views === 'update')
      {
        echo 'ini halaman update article
      } // end update article

      if($views === 'delete')
      {
        echo 'Ini halaman delete article
      } // end view upate

    } // end pages news
  } // end function
?>
