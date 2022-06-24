<br><br>
<?php
require_once "functions.php";
session_start();

if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  exit;
}

// query
$customer = query("SELECT * FROM customer_view");

$kota = query("SELECT * FROM kota");

// tambah data
function tambah($data)
{
  $conn = koneksi();

  $nama = htmlspecialchars($data['nama']);
  $alamat = htmlspecialchars($data['alamat']);
  $kota = htmlspecialchars($data['kota']);

  $query = "INSERT INTO customer VALUES
            (null,'$nama','$alamat','$kota');";

  mysqli_query($conn, $query);
  echo mysqli_error($conn);
  return mysqli_affected_rows($conn);
}
if (isset($_POST['Tambah'])) {
  if (tambah($_POST) > 0) {
    echo "<script>
            alert('data berhasil ditambahkan');
            document.location.href = 'customer.php';
          </script>";
  } else {
    echo "data gagal ditambahkan";
  }
}

// hapus data
function hapus($id)
{
  $conn = koneksi();
  mysqli_query($conn, "DELETE FROM customer WHERE id_cust = $id") or die(mysqli_error($conn));
  return mysqli_affected_rows($conn);
}
if (isset($_GET['h'])) {
  $id = $_GET["id_cust"];

  if (hapus($id) > 0) {
    echo "<script>
            alert('data berhasil dihapus');
            document.location.href = 'customer.php';
          </script>";
  } else {
    echo "data gagal dihapus";
  }
}

// ubah data
function ubah($data)
{
  $conn = koneksi();

  $id = $data['id_cust'];
  $nama = htmlspecialchars($data['nama']);
  $alamat = htmlspecialchars($data['alamat']);
  $kota = htmlspecialchars($data['kota']);


  $query = "UPDATE customer SET
            nm_cust = '$nama',
            almt_cust = '$alamat',
            kota_cust = '$kota'
            WHERE id_cust = $id";

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

  $id = $_GET['id_cust'];
  $aksi = "Ubah";
  $u = query("SELECT * FROM customer_view
              WHERE id_cust = $id ;");

  $nama = $u['nm_cust'];
  $alamat = $u['almt_cust'];
  $nm_kt = $u['nm_kota'];
  $id_kt = $u['kota_cust'];
  $a = "autofocus";

  if (isset($_POST['Ubah'])) {
    if (ubah($_POST) > 0) {
      echo "<script>
          alert('data berhasil diubah');
          document.location.href = 'customer.php';
        </script>";
    } else {
      echo "data gagal diubah";
    }
  }
}

// pencarian data
if (isset($_POST['cari'])) {
  $barang = cariCust($_POST['keyword']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Customer</title>
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
              <a class="dropdown-item " href="pegawai.php">Pegawai</a>
              <a class="dropdown-item" href="supplier.php">Supplier</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item active bg-warning" href="customer.php">Kustomer</a>
              <a class="dropdown-item" href="transJual.php">Transaksi Penjualan</a>
              <a class="dropdown-item" href="returJual.php">Retur Penjualan</a>
              <a class="dropdown-item" href="transBeli.php">Transaksi Pembelian</a>
              <a class="dropdown-item" href="returBeli.php">Retur Pembelian</a>
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
      <h1 class="">Tabel Customer</h1>
      <hr>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <h3 class=""><?= $aksi; ?> data</h3>

          <!-- form -->
          <form action="" method="POST">
            <input type="hidden" name="id_cust" value="<?= $id; ?>">
            <div class="form-group">
              <label for="nama">Nama Customer</label>
              <input type="text" class="form-control" id="nama" name="nama" required autocomplete="off" value="<?= $nama; ?>" <?= $a; ?>>
            </div>
            <div class="form-group">
              <label for="alamat">Alamat Customer</label>
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

            <?php if (isset($_GET['u'])) : ?>
              <a class="btn btn-dark" href="customer.php">Batal</a>
            <?php endif ?>

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
                  <th>Nama Customer</th>
                  <th>Alamat Customer</th>
                  <th>Kota Customer</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>

                <?php if (empty($customer)) : ?>
                  <tr>
                    <td colspan="5" class="font-italic text-danger text-center ">
                      Data customer tidak ditemukan
                    </td>
                  </tr>
                <?php endif ?>

                <?php
                $i = 1;
                foreach ($customer as $c) : ?>
                  <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $c['nm_cust']; ?></td>
                    <td><?= $c['almt_cust']; ?></td>
                    <td><?= $c['nm_kota']; ?></td>
                    <td>
                      <a class="btn btn-warning btn-sm" href="?u=1&id_cust=<?= $c['id_cust']; ?>">Ubah</a>
                      <a class="btn btn-danger btn-sm" href="?h=1&id_cust=<?= $c['id_cust']; ?>" onclick="return confirm('apakah anda yakin?');">Hapus</a>
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
  <script src="../js/scriptCustomer.js"></script>
</body>

</html>