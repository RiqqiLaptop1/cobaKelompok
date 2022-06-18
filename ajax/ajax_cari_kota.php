<?php
require_once '../php/functions.php';
$kota = cariKota($_GET['keyword']);
?>

<div class="tabel ">
  <table class="table table-striped">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Kota</th>
        <th>Provinsi</th>
      </tr>
    </thead>
    <tbody>

      <?php if (empty($kota)) : ?>
        <tr>
          <td colspan="5" class="font-italic text-danger text-center ">
            Data Kota tidak ditemukan
          </td>
        </tr>
      <?php endif ?>

      <?php
      $i = 1;
      foreach ($kota as $k) : ?>
        <tr>
          <td><?= $i++; ?></td>
          <td><?= $k['nm_kota']; ?></td>
          <td><?= $k['provinsi']; ?></td>
          <td>
            <a class="btn btn-warning btn-sm" href="?u=1&kd_kota=<?= $k['kd_kota']; ?>">Ubah</a>
            <a class="btn btn-danger btn-sm" href="?h=1&kd_kota=<?= $k['kd_kota']; ?>" onclick="return confirm('apakah anda yakin?');">Hapus</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>