<?php
session_start();

if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  exit;
}

require_once "functions.php";

// query
$barang = query("SELECT * FROM barang");

// tambah data
if (isset($_POST['Tambah'])) {
  if (tambah($_POST) > 0) {
    echo "<script>
            alert('data berhasil ditambahkan');
            document.location.href = 'index.php';
          </script>";
  } else {
    echo "data gagal ditambahkan";
  }
}

// hapus data
if (isset($_GET['h'])) {
  $id = $_GET["id_brg"];

  if (hapus($id) > 0) {
    echo "<script>
            alert('data berhasil dihapus');
            document.location.href = 'index.php';
          </script>";
  } else {
    echo "data gagal dihapus";
  }
}

// ubah data
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
              document.location.href = 'index.php';
            </script>";
    } else {
      echo "data gagal diubah";
    }
  }
}

// pencarian data
if (isset($_POST['cari'])) {


  $barang = cari($_POST['keyword']);
  // var_dump($barang);
  // exit;
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Barang</title>
  <link rel="stylesheet" href="../css/style.css">
</head>

<body>
  <h3 style="text-align: right;">Selamat datang <?= $_SESSION['username']; ?> | <a href="logout.php">logout</a></h3>
  <h1>Tabel Barang</h1>
  <div class="container">
    <div class="form">
      <h3><?= $aksi; ?> data</h3>
      <form action="" method="POST">
        <input type="hidden" name="id_brg" value="<?= $id; ?>">
        <ul>
          <li>
            <label for="nama">
              Nama Barang
              <input type="text" name="nama" required autocomplete="off" value="<?= $nama; ?>" <?= $a; ?>>
            </label>
          </li>
          <li>
            <label for="harga">
              Harga
              <input type="number" name="harga" required placeholder="Rp." value="<?= $harga; ?>">
            </label>
          </li>
          <li>
            <label for="stok">
              Stok
              <input type="number" name="stok" required value="<?= $stok; ?>">
            </label>
          </li>
          <li>
            <button type="submit" name="<?= $aksi; ?>"><?= $aksi; ?></button>
            <button type="reset" name="reset">Reset</button>
          </li>
        </ul>
      </form>
    </div>
    <br><br>
    <form action="" method="POST">
      <input autocomplete="off" type="text" placeholder="masukkan keyword pencarian..." size="40" name="keyword" class="keyword">
      <button type="submit" name="cari" class="tombol-cari">Cari</button>
    </form>
    <br>
    <div class="tabel">
      <table border="1" cellspacing="0" cellpadding="5">
        <tr>
          <th>No</th>
          <th>Nama Barang</th>
          <th>Harga</th>
          <th>Stok</th>
          <th>Aksi</th>
        </tr>

        <?php if (empty($barang)) : ?>
          <tr>
            <td colspan="5">
              <p style="color: red; font-style: italic;">data barang tidak ditemukan</p>
            </td>
          </tr>
        <?php endif ?>

        <?php
        $i = 1;
        foreach ($barang as $b) : ?>
          <tr>
            <td><?= $i++; ?></td>
            <td><?= $b['nm_brg']; ?></td>
            <td>Rp.<?= $b['harga']; ?></td>
            <td><?= $b['stok']; ?></td>
            <td>
              <a href="?u=1&id_brg=<?= $b['id_brg']; ?>">Ubah</a> |
              <a href="?h=1&id_brg=<?= $b['id_brg']; ?>" onclick="return confirm('apakah anda yakin?');">Hapus</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </table>
    </div>
  </div>
  <script src="../js/script.js"></script>
</body>

</html>