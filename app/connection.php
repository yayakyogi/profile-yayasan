<?php 
  // buat koneksi ke database
  $host = 'localhost';
  $username = 'root';
  $password = 'ginantaka23';
  $db = 'profile-yayasan';

  $conn = mysqli_connect($host,$username,$password,$db);
  if(!$conn)
  {
    $conn = mysqli_connect($host,$username,$password);
    $query = "CREATE DATABASE IF NOT EXIST $db";
    $sql = mysqli_query($conn,$query);
    $conn = mysqli_connect($host,$username,$password,$db);
  }

  function GET($key,$val){
    $res = isset($_SESSION[$key]) && $_SESSION[$key] != '' ? $_SESSION[$key] : $val;
    $res = isset($_POST[$key]) && $_POST[$key] != '' ? $_POST[$key] : $res;
    $res = isset($_GET[$key]) && $_GET[$key] != '' ? $_GET[$key] : $res;
    return $res; 
  }
?>