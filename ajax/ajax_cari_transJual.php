<?php
require_once '../php/functions.php';
$transJual = cariTransJual($_GET['keyword']);
?>

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
            <a class="btn btn-success btn-sm" href="?u=1&nota=<?= $tj['nota']; ?>">Detail</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>