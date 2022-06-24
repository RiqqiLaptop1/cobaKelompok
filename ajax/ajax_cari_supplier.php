<?php
require_once '../php/functions.php';
$supplier = cariSuppl($_GET['keyword']);
?>

<div class="tabel ">
  <table class="table table-striped">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Supplier</th>
        <th>Alamat Supplier</th>
        <th>Kota Supplier</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>

      <?php if (empty($supplier)) : ?>
        <tr>
          <td colspan="5" class="font-italic text-danger text-center ">
            Data supplier tidak ditemukan
          </td>
        </tr>
      <?php endif ?>

      <?php
      $i = 1;
      foreach ($supplier as $s) : ?>
        <tr>
          <td><?= $i++; ?></td>
          <td><?= $s['nm_suppl']; ?></td>
          <td><?= $s['almt_suppl']; ?></td>
          <td><?= $s['nm_kota']; ?></td>
          <td>
            <a class="btn btn-warning btn-sm" href="?u=1&id_suppl=<?= $s['id_suppl']; ?>">Ubah</a>
            <a class="btn btn-danger btn-sm" href="?h=1&id_suppl=<?= $s['id_suppl']; ?>" onclick="return confirm('apakah anda yakin?');">Hapus</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>