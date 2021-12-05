<?php 
  // function untuk header halaman index
  function headerIndex()
  {
    echo '
      <!DOCTYPE html>
      <html lang="en">
      <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl"
            crossorigin="anonymous"
          /> -->
        <link rel="stylesheet" href="./public/bootstrap-5.0.2/dist/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="./public/css/style.css"/>
        <title>Profil Yayasan</title>
      </head>
    ';
  }

  // function untuk header halaman selain index
  function headerAll()
  {
     echo '
      <!DOCTYPE html>
      <html lang="en">
      <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../public/bootstrap-5.0.2/dist/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="../public/css/sb-admin.css"/>
        <link rel="stylesheet" href="../public/css/style.css"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <title>Profil Yayasan</title>
      </head>
    ';
  }
?>
