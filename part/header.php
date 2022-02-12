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
        <link rel="stylesheet" href="./public/bootstrap-5.0.2/dist/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="./public/css/style.css"/>
        <link rel="icon" href="./public/img/logo.png" type="image/icon type">
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <title>AL GHOIBI</title>
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
         <link rel="icon" href="../public/img/logo.png" type="image/icon type">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <title>AL GHOIBI</title>
      </head>
    ';
  }
?>
