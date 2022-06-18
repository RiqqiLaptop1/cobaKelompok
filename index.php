<?php
session_start();

if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  exit;
}

define('BASEURL', 'http://localhost/WEB/CobaKelompok');


require_once 'view/header.php';
require_once 'view/dashboard.php';
require_once 'view/footer.php';
