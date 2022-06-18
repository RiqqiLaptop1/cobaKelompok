<?php

function koneksi()
{
  // koneksi ke database
  return mysqli_connect('localhost', 'root', '', 'toko_ali_2');
}

function query($query)
{
  $conn = koneksi();

  // query isi tabel
  $result = mysqli_query($conn, $query);

  // jika hanya ada satu data
  if (mysqli_num_rows($result) == 1) {
    return mysqli_fetch_assoc($result);
  }

  // ubah data ke array
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}

// login
function login($data)
{
  $conn = koneksi();
  $username = htmlspecialchars($data['username']);
  $password = htmlspecialchars($data['password']);

  if ($username === "owner" && $password === "rahasia") {
    $_SESSION['login'] = true;
    $_SESSION['username'] = $username;

    // var_dump($_SESSION);
    header("Location: index.php");
    exit;
  }
  return [
    'error' => true,
    'pesan' => 'username / password salah !'
  ];
}

// pencarian produk
function cariProduk($keyword)
{
  $conn = koneksi();
  $query = "SELECT * FROM barang
            WHERE nm_brg LIKE '%$keyword%' OR
                  harga LIKE '%$keyword%' OR
                  stok LIKE '%$keyword%'";

  $result = mysqli_query($conn, $query);
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}


// pencarian produk
function cariKota($keyword)
{
  $conn = koneksi();
  $query = "SELECT * FROM kota
            WHERE nm_kota LIKE '%$keyword%' OR
                  provinsi LIKE '%$keyword%'";

  $result = mysqli_query($conn, $query);
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}
