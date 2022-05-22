<?php
require_once '../php/functions.php';
$barang = cari($_GET['keyword']);
?>

<table border="1" cellspacing="0" cellpadding="5">
  <tr>
    <th>No</th>
    <th>Nama Barang</th>
    <th>Harga</th>
    <th>Stok</th>
    <th>Aksi</th>
  </tr>

  <?php if (empty($barang)) : ?>
    <tr>
      <td colspan="5">
        <p style="color: red; font-style: italic;">data barang tidak ditemukan</p>
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
        <a href="?u=1&id_brg=<?= $b['id_brg']; ?>">Ubah</a> |
        <a href="?h=1&id_brg=<?= $b['id_brg']; ?>" onclick="return confirm('apakah anda yakin?');">Hapus</a>
      </td>
    </tr>
  <?php endforeach; ?>
</table>