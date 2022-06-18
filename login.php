<?php
session_start();

if (isset($_SESSION['login'])) {
  header("Location: index.php");
  exit;
}

require_once 'functions.php';

// ketika tombol login di tekan
if (isset($_POST['masuk'])) {
  $login = login($_POST);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

  <link rel="stylesheet" href="css/bootstrap.css">

  <title>Login</title>
</head>

<body>
  <br><br><br><br><br>
  <div class="container ">
    <div class="row">
      <div class="col-md-4"></div>
      <div class="col-md-4  card border-dark bg-light mb-3 p-3">
        <div class="text-center">
          <img src="img/ikan-cupang-comb-tail_169.jpeg" class="img-thumbnail rounded-circle" width="100" height="100">
          <h1>Toko Ali 2</h1>
        </div>
        <form action="" method="POST">
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control " id="username" name="username" autofocus required autocomplete="off">
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
            <div class="invalid-feedback"><?= $login['pesan']; ?></div>
          </div>
          <button class="btn btn-primary mx-auto d-block" type="submit" name="masuk">Masuk</button>
        </form>
      </div>
      <div class="col-md-4"></div>
    </div>
  </div>

  <?php if (isset($login['error'])) : ?>
    <script>
      const name = document.getElementById('username').classList.add('is-invalid');
      const password = document.getElementById('password').classList.add('is-invalid');
    </script>
  <?php endif ?>

  <script src="js/jquery-3.6.0.min.js"></script>
  <script src="js/bootstrap.bundle.js"></script>
</body>

</html>