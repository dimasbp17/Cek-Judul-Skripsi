<?php

// session
session_start();

// koneksi
$server = "localhost";
$username = "root";
$password = "";
$database_name = "db_cekjudulskripsi";

$koneksi = mysqli_connect($server,$username,$password,$database_name);

// if ($koneksi) {
//     echo "Berhasil";
// }else {
//     echo "gagal";
// }
