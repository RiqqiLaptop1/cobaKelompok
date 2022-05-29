<?php
require_once '../php/functions.php';
$barang = cari($_GET['keyword']);
?>
<div class="tabel">
  <table class="table table-striped">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Produk</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php if (empty($barang)) : ?>
        <tr>
          <td colspan="5" class="font-italic text-danger text-center ">
            Data produk tidak ditemukan
          </td>
        </tr>
      <?php endif ?>

      <?php
      $i = 1;
      foreach ($barang as $b) : ?>
        <tr>
          <td><?= $i++; ?></td>
          <td><?= $b['nm_brg']; ?></td>
          <td>Rp.<?= $b['harga']; ?></td>
          <td><?= $b['stok']; ?></td>
          <td>
            <a href="?u=1&id_brg=<?= $b['id_brg']; ?>" data-toggle="modal" data-target="#exampleModalCenter">Ubah</a> |
            <a href="?h=1&id_brg=<?= $b['id_brg']; ?>" onclick="return confirm('apakah anda yakin?');">Hapus</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>