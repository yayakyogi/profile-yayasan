<?php 
  /* HALAMAN BERITA */
  $pages = GET('pages','');
  $views = GET('views','');

  function berita()
  {
    global $pages;
    global $views;

    if($pages === 'announcement')
    {
      if($views === 'index')
      {
        echo 'Ini halaman index pengumuman
      } // end view index
      
      if($views === 'add')
      {
        echo 'Ini halaman tambah pengumuman
      } // end view tambah pengumuman

      if($views === 'update')
      {
        echo 'ini halaman update pengumuman
      } // end update pengumuman

      if($views === 'delete')
      {
        echo 'Ini halaman delete pengumuman
      } // end view delete pengumuman

    } // end pages news
  } // end function
?>
