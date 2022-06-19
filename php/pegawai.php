<br><br>
<?php
require_once "functions.php";
session_start();

if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  exit;
}

// // query
$pegawai = query("SELECT * FROM pegawai_view");

$kota = query("SELECT * FROM kota");

// // tambah data
function tambah($data)
{
  $conn = koneksi();

  $nama = htmlspecialchars($data['nama']);
  $alamat = htmlspecialchars($data['alamat']);
  $kota = htmlspecialchars($data['kota']);

  $query = "INSERT INTO pegawai VALUES
            (null,'$nama','$alamat','$kota');";

  mysqli_query($conn, $query);
  echo mysqli_error($conn);
  return mysqli_affected_rows($conn);
}
if (isset($_POST['Tambah'])) {
  if (tambah($_POST) > 0) {
    echo "<script>
            alert('data berhasil ditambahkan');
            document.location.href = 'pegawai.php';
          </script>";
  } else {
    echo "data gagal ditambahkan";
  }
}

// // hapus data
function hapus($id)
{
  $conn = koneksi();
  mysqli_query($conn, "DELETE FROM pegawai WHERE id_pegawai = $id") or die(mysqli_error($conn));
  return mysqli_affected_rows($conn);
}
if (isset($_GET['h'])) {
  $id = $_GET["id_pegawai"];

  if (hapus($id) > 0) {
    echo "<script>
            alert('data berhasil dihapus');
            document.location.href = 'pegawai.php';
          </script>";
  } else {
    echo "data gagal dihapus";
  }
}

// // ubah data
function ubah($data)
{
  $conn = koneksi();

  $id = $data['id_pegawai'];
  $nama = htmlspecialchars($data['nama']);
  $alamat = htmlspecialchars($data['alamat']);
  $kota = htmlspecialchars($data['kota']);


  $query = "UPDATE pegawai SET
            nm_pegawai = '$nama',
            almt_pegawai = '$alamat',
            kota_pegawai = '$kota'
            WHERE id_pegawai = $id";

  mysqli_query($conn, $query) or die(mysqli_error($conn));
  return mysqli_affected_rows($conn);
}

$aksi = "Tambah";
$id = null;
$nama = null;
$alamat = null;
$nm_kt = 'pilih kota';
$id_kt = null;
$a = null;

if (isset($_GET['u'])) {

  $id = $_GET['id_pegawai'];
  $aksi = "Ubah";
  $u = query("SELECT * FROM pegawai_view
              WHERE id_pegawai = $id ;");

  $nama = $u['nm_pegawai'];
  $alamat = $u['almt_pegawai'];
  $nm_kt = $u['nm_kota'];
  $id_kt = $u['kota_pegawai'];
  $a = "autofocus";

  if (isset($_POST['Ubah'])) {
    if (ubah($_POST) > 0) {
      echo "<script>
          alert('data berhasil diubah');
          document.location.href = 'pegawai.php';
        </script>";
    } else {
      echo "data gagal diubah";
    }
  }
}

// pencarian data
if (isset($_POST['cari'])) {
  $barang = cariPegawai($_POST['keyword']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pegawai</title>
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
          <li class="nav-item ">
            <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Menu
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item " href="produk.php">Produk</a>
              <a class="dropdown-item " href="kota.php">Kota</a>
              <a class="dropdown-item active bg-warning" href="pegawai.php">Pegawai</a>
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
            <a class="nav-link" href="about.php">About <span class="sr-only">(current)</span></a>
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

    <div class="jumbotron text-center bg-light ">
      <h1 class="">Tabel Pegawai</h1>
      <hr>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <h3 class=""><?= $aksi; ?> data</h3>

          <!-- form -->
          <form action="" method="POST">
            <input type="hidden" name="id_pegawai" value="<?= $id; ?>">
            <div class="form-group">
              <label for="nama">Nama pegawai</label>
              <input type="text" class="form-control" id="nama" name="nama" required autocomplete="off" value="<?= $nama; ?>" <?= $a; ?>>
            </div>
            <div class="form-group">
              <label for="alamat">Alamat Pegawai</label>
              <input type="text" class="form-control" id="alamat" name="alamat" required autocomplete="off" value="<?= $alamat; ?>" <?= $a; ?>>
            </div>
            <div class="form-group">
              <label class="mr-sm-2" for="kota">Kota</label>
              <select class="custom-select mr-sm-2" id="kota" name="kota">
                <option value="<?= $id_kt; ?>"><?= $nm_kt; ?></option>
                <?php
                foreach ($kota as $k) : ?>
                  <option value="<?= $k['kd_kota']; ?>"><?= $k['nm_kota']; ?></option>
                <?php endforeach; ?>
              </select>
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
                  <th>Nama Pegawai</th>
                  <th>Alamat Pegawai</th>
                  <th>Kota Pegawai</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>

                <?php if (empty($pegawai)) : ?>
                  <tr>
                    <td colspan="5" class="font-italic text-danger text-center ">
                      Data pegawai tidak ditemukan
                    </td>
                  </tr>
                <?php endif ?>

                <?php
                $i = 1;
                foreach ($pegawai as $p) : ?>
                  <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $p['nm_pegawai']; ?></td>
                    <td><?= $p['almt_pegawai']; ?></td>
                    <td><?= $p['nm_kota']; ?></td>
                    <td>
                      <a class="btn btn-warning btn-sm" href="?u=1&id_pegawai=<?= $p['id_pegawai']; ?>">Ubah</a>
                      <a class="btn btn-danger btn-sm" href="?h=1&id_pegawai=<?= $p['id_pegawai']; ?>" onclick="return confirm('apakah anda yakin?');">Hapus</a>
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

  <footer class="footer mt-auto py-3  bg-light fixed-bottom">
    <div class="container text-center ">
      <span class="text-muted ">&copy; 2022 | Toko Ali 2</span>
    </div>
  </footer>

  <script src="../js/jquery-3.6.0.min.js"></script>
  <script src="../js/bootstrap.bundle.js"></script>
  <script src="../js/scriptPegawai.js"></script>
</body>

</html>