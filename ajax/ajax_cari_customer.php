<?php
require_once '../php/functions.php';
$customer = cariCust($_GET['keyword']);
?>

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