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

// tambah data
function tambah($data)
{
  $conn = koneksi();

  $nama = htmlspecialchars($data['nama']);
  $harga = htmlspecialchars($data['harga']);
  $stok = htmlspecialchars($data['stok']);

  $query = "INSERT INTO barang VALUES
            (null,'$nama','$harga','$stok');";

  mysqli_query($conn, $query);
  echo mysqli_error($conn);
  return mysqli_affected_rows($conn);
}

// hapus data
function hapus($id)
{
  $conn = koneksi();
  mysqli_query($conn, "DELETE FROM barang WHERE id_brg = $id") or die(mysqli_error($conn));
  return mysqli_affected_rows($conn);
}

// ubah data
function ubah($data)
{
  $conn = koneksi();

  $id = $data['id_brg'];
  $nama = htmlspecialchars($data['nama']);
  $harga = htmlspecialchars($data['harga']);
  $stok = htmlspecialchars($data['stok']);

  $query = "UPDATE barang SET
            nm_brg = '$nama',
            harga = '$harga',
            stok = '$stok'
            WHERE id_brg = $id";

  mysqli_query($conn, $query) or die(mysqli_error($conn));
  return mysqli_affected_rows($conn);
}

// pencarian
function cari($keyword)
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
    header("Location : index.php");
    exit;
  }
  return [
    'error' => true,
    'pesan' => 'username / password salah !'
  ];
}
