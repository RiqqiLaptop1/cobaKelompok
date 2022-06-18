
<?php
require_once "functions.php";

if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  exit;
}

// query
$barang = query("SELECT * FROM barang");

//  tambah data
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

if (isset($_POST['Tambah'])) {
  if (tambah($_POST) > 0) {
    echo "<script>
            alert('data berhasil ditambahkan');
            document.location.href = 'index.php?produk=true';
          </script>";
  } else {
    echo "data gagal ditambahkan";
  }
}

//  hapus data
function hapus($id)
{
  $conn = koneksi();
  mysqli_query($conn, "DELETE FROM barang WHERE id_brg = $id") or die(mysqli_error($conn));
  return mysqli_affected_rows($conn);
}

if (isset($_GET['h'])) {
  $id = $_GET["id_brg"];

  if (hapus($id) > 0) {
    echo "<script>
            alert('data berhasil dihapus');
            document.location.href = 'index.php?produk=true';
          </script>";
  } else {
    echo "data gagal dihapus";
  }
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

$aksi = "Tambah";
$id = null;
$nama = null;
$harga = null;
$stok = null;
$a = null;

if (isset($_GET['u'])) {

  $id = $_GET['id_brg'];
  $aksi = "Ubah";
  $u = query("SELECT * FROM barang WHERE id_brg = $id ");

  $nama = $u['nm_brg'];
  $harga =  $u['harga'];
  $stok = $u['stok'];
  $a = "autofocus";

  if (isset($_POST['Ubah'])) {
    if (ubah($_POST) > 0) {
      echo "<script>
          alert('data berhasil diubah');
          document.location.href = 'index.php?produk=true';
        </script>";
    } else {
      echo "data gagal diubah";
    }
  }
}

// pencarian data
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
if (isset($_POST['cari'])) {
  $barang = cari($_POST['keyword']);
}
