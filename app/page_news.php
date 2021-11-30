<?php 
  /* HALAMAN BERITA */
  $pages = GET('pages','');
  $views = GET('views','');

  function berita()
  {
    global $pages;
    global $views;

    if($pages === 'news')
    {
      if($views === 'index')
      {
        echo 'Ini halaman index berita';
      } // end view index
      
      if($views === 'add')
      {
        echo 'Ini halaman tambah berita';
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
