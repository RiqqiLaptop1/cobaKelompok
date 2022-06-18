<?php
session_start();

if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  exit;
}

define('BASEURL', 'http://localhost/WEB/CobaKelompok');


require_once 'view/header.php';

if (isset($_GET['produk'])) {
  require_once 'models/produk.php';
  require_once 'view/main.php';
} elseif (isset($_GET['about'])) {
  require_once 'view/about.php';
} else {
  $_GET['menu'] = true;
  require_once 'view/dashboard.php';
}

require_once 'view/footer.php';
