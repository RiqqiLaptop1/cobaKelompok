<?php

require_once "functions.php";
session_start();

if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  exit;
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
          <li class="nav-item ">
            <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Menu
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item " href="produk.php">Produk</a>
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
          <li class="nav-item active">
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

  <main class="mt-3">
    <div class="container text-center mt-5 mb-5">
      <h1 class="pt-5">About</h1>
      <div class="row">
        <div class="col-md-4 mb-3">
          <div class="container bg-warning text-dark p-2">
            <img src="../img/riqqi.jpeg" alt="riqqi" width="50%" height="50%" class="img-thumbnail rounded-circle m-3">
            <h5>Muhammad Riqqi Amru</h5>
            <p>Mahasiswa <br> 21.230.0069</p>
            <p>Hobi bersantai. Kerjakan tugas sekarang agar bisa senang-senang kemudian</p>
          </div>
        </div>
        <div class="col-md-4 mb-3">
          <div class="container text-dark p-2" style="background-color:#dc35356b ;">
            <img src="../img/lilis (2).jpeg" alt="lilis" width="50%" height="50%" class="img-thumbnail rounded-circle m-3">
            <h5>Lilis Royani</h5>
            <p>Mahasiswa <br> 21.230.0078</p>
            <p>Tetap berusaha meskipun beban<br>
              follow instagram saya<br>
              <a href="https://www.instagram.com/lilis_jasmee/" target="blank" class="btn btn-outline-danger">@lilis_jasmee</a>
            </p>
          </div>
        </div>
        <div class="col-md-4 mb-3">
          <div class="container bg-dark text-light p-2">
            <img src="../img/ali.jpeg" alt="ali" width="50%" height="50%" class="img-thumbnail rounded-circle m-3">
            <h5>Muhammad Ferdynan Ali Syahbana</h5>
            <p>Mahasiswa<br> 21.230.0079</p>
            <p>Langsung saja susbcribe channel saya <br>
              <a href="https://www.youtube.com/channel/UCLiWPTAubbFjUfbR5AUx7Sw" target="blank" class="btn btn-dark">ALY DAP</a>
              <br> dan follow instagram saya <br>
              <a href="https://www.instagram.com/aly_dap/" target="blank" class="btn btn-dark">@aly_dap</a>
            </p>
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
  <script src="../js/script.js"></script>
</body>

</html>