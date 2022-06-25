<br><br>
<?php
require_once "functions.php";
session_start();

if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  exit;
}

// query
$transJual = query("SELECT * FROM trans_jual_view");

// detail
if (isset($_GET['d'])) {
  $id = $_GET['nota'];
  $detail = query("SELECT * FROM detail_trans_jual_view WHERE nota = $id ");
}



// $kota = query("SELECT * FROM kota");

// tambah data
// function tambah($data)
// {
//   $conn = koneksi();

//   $nama = htmlspecialchars($data['nama']);
//   $alamat = htmlspecialchars($data['alamat']);
//   $kota = htmlspecialchars($data['kota']);

//   $query = "INSERT INTO supplier VALUES
//             (null,'$nama','$alamat','$kota');";

//   mysqli_query($conn, $query);
//   echo mysqli_error($conn);
//   return mysqli_affected_rows($conn);
// }
// if (isset($_POST['Tambah'])) {
//   if (tambah($_POST) > 0) {
//     echo "<script>
//             alert('data berhasil ditambahkan');
//             document.location.href = 'supplier.php';
//           </script>";
//   } else {
//     echo "data gagal ditambahkan";
//   }
// }

$aksi = "Tambah";
$id = null;
$nama = null;
$alamat = null;
$nm_kt = 'pilih kota';
$id_kt = null;
$a = null;


// pencarian data
if (isset($_POST['cari'])) {
  $barang = cariTransJual($_POST['keyword']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Transaksi Penjualan</title>
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
              <a class="dropdown-item active bg-warning" href="supplier.php">Supplier</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="customer.php">Kustomer</a>
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
      <h1 class="">Tabel Transaksi Penjualan</h1>
      <hr>
    </div>
    <div class="container">
      <div class="row">
        <!-- <div class="col-md-4">
          <h3 class=""><?= $aksi; ?> data</h3> -->

        <!-- form -->
        <!-- <form action="" method="POST">
            <input type="hidden" name="id_suppl" value="<?= $id; ?>">
            <div class="form-group">
              <label for="nama">Nama Supplier</label>
              <input type="text" class="form-control" id="nama" name="nama" required autocomplete="off" value="<?= $nama; ?>" <?= $a; ?>>
            </div>
            <div class="form-group">
              <label for="alamat">Alamat Supplier</label>
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
              <a class="btn btn-dark" href="supplier.php">Batal</a>
            <?php endif ?>

          </form>
        </div> -->
        <div class="col-md ">
          <a class="btn btn-primary mb-2" href="#">Catat Transaksi Baru</a>

          <!-- pencarian -->
          <form action="" method="POST" class=" mx-4 mb-2  d-inline-block ">
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
                  <th>Tanggal</th>
                  <th>Nama Customer</th>
                  <th>Total Bayar</th>
                  <th>Pegawai</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>

                <?php if (empty($transJual)) : ?>
                  <tr>
                    <td colspan="5" class="font-italic text-danger text-center ">
                      Data Penjualan tidak ditemukan
                    </td>
                  </tr>
                <?php endif; ?>
                <?php
                $i = 1;
                foreach ($transJual as $tj) : ?>
                  <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $tj['tgl']; ?></td>
                    <td><?= $tj['nm_cust']; ?></td>
                    <td>Rp.<?= $tj['total_bayar']; ?></td>
                    <td><?= $tj['nm_pegawai']; ?></td>
                    <td>
                      <a class="btn btn-success btn-sm detail" href="?d=1&nota=<?= $tj['nota']; ?>" data-toggle="modal" data-target="#exampleModalCenter">Detail</a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <?php var_dump($detail); ?>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
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
  <script src="../js/scriptTransJual.js"></script>
</body>

</html>