<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Produk</title>
  <link rel="stylesheet" href="<?= BASEURL; ?>/css/bootstrap.css">
</head>

<body class="d-flex flex-column h-100">

  <header>
    <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-warning">
      <a class="navbar-brand" href="index.php?home=true">
        <img src="<?= BASEURL; ?>/img/ikan-cupang-comb-tail_169.jpeg" alt="judul" width="30px" class="shadows rounded-circle">
        Toko Ali 2
      </a>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item <?php if (isset($_GET['home']))
                                echo 'active ';
                              ?>">
            <a class="nav-link" href="<?= BASEURL; ?>/index.php?home=true">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Menu
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item <?php if (isset($_GET['produk']))
                                        echo 'active bg-warning';
                                      ?>" href="<?= BASEURL; ?>/index.php?produk=true">Produk</a>
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
          <li class="nav-item <?php if (isset($_GET['about']))
                                echo 'active ';
                              ?>">
            <a class="nav-link" href="<?= BASEURL; ?>/index.php?about=true">About <span class="sr-only">(current)</span></a>
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