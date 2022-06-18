<?php
require_once "functions.php";
session_start();

if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  exit;
}

// query
$barang = query("SELECT * FROM barang");
// var_dump($barang);

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
  <title>Produk</title>
  <link rel="stylesheet" href="../css/bootstrap.css">
</head>

<body class="d-flex flex-column h-100">

  <header>
    <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-warning">
      <a class="navbar-brand" href="index.php">
        <img src="../img/ikan-cupang-comb-tail_169.jpeg" alt="judul" width="30px" class="shadows rounded-circle">
        Toko Ali 2
      </a>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Menu
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#">Produk</a>
              <a class="dropdown-item" href="#">Kota</a>
              <a class="dropdown-item" href="#">Pegawai</a>
              <a class="dropdown-item" href="#">Supplier</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Kustomer</a>
              <a class="dropdown-item" href="#">Transaksi Penjualan</a>
              <a class="dropdown-item" href="#">Retur Penjualan</a>
              <a class="dropdown-item" href="#">Transaksi Pembelian</a>
              <a class="dropdown-item" href="#">Retur Pembelian</a>
            </div>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="#">About <span class="sr-only">(current)</span></a>
          </li>
        </ul>
        <div class="dropdown dropleft">
          <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?= strtoupper($_SESSION['username']); ?>
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="logout.php">Logout</a>
          </div>
        </div>
      </div>
    </nav>
  </header>

  <main role="main" class="flex-shrink-0">

    <div class="jumbotron text-center bg-light " style="margin-top: 60px;">
      <h1 class="">Tabel Produk</h1>
      <hr>
    </div>

    <div class="container">

      <div class="row">
        <div class="col-md-4">
          <h3 class=""><?= $aksi; ?> data</h3>
          <form action="" method="POST">
            <input type="hidden" name="id_brg" value="<?= $id; ?>">
            <div class="form-group">
              <label for="nama">Nama Produk</label>
              <input type="text" class="form-control" id="nama" name="nama" required autocomplete="off" value="<?= $nama; ?>" <?= $a; ?>>
            </div>
            <div class="form-group">
              <label for="harga">Harga Produk</label>
              <input type="number" class="form-control" id="harga" name="harga" required autocomplete="off" value="<?= $harga; ?>" <?= $a; ?> placeholder="Rp.">
            </div>
            <div class="form-group">
              <label for="stok">Stok Produk</label>
              <input type="number" class="form-control" id="stok" name="stok" required autocomplete="off" value="<?= $stok; ?>" <?= $a; ?>>
            </div>
            <button type="reset" class="btn btn-secondary">Reset</button>
            <button type="submit" class="btn btn-primary" name="<?= $aksi; ?>"><?= $aksi; ?></button>
          </form>
        </div>
        <div class="col-md-7">

          <!-- pencarian -->
          <form action="" method="POST" class=" mx-4  d-inline-block ">
            <div class="form-group ">
              <input type="text" class="form-control keyword" name="keyword" placeholder="masukkan keyword pencarian..." autocomplete="off" size="50">
              <button type="submit" name="cari" class="tombol-cari">Cari</button>
            </div>
          </form>

          <!-- tabel -->
          <div class="tabel mb-5">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Produk</th>
                  <th>Harga</th>
                  <th>Stok</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>

                <?php if (empty($barang)) : ?>
                  <tr>
                    <td colspan="5" class="font-italic text-danger text-center ">
                      Data produk tidak ditemukan
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
                      <a class="btn btn-warning btn-sm" href="?u=1&id_brg=<?= $b['id_brg']; ?>">Ubah</a>
                      <a class="btn btn-danger btn-sm" href="?h=1&id_brg=<?= $b['id_brg']; ?>" onclick="return confirm('apakah anda yakin?');">Hapus</a>
                    </td>
                  </tr>
                <?php endforeach; ?>

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </main>

  <footer class="footer mt-auto py-3  bg-light">
    <div class="container text-center ">
      <span class="text-muted ">&copy; 2022 | Toko Ali 2</span>
    </div>
  </footer>

  <script src="../js/jquery-3.6.0.min.js"></script>
  <script src="../js/bootstrap.bundle.js"></script>
  <script src="../js/script.js"></script>
</body>

</html>