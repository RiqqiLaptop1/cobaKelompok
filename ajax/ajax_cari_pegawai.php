<?php
require_once '../php/functions.php';
$pegawai = cariPegawai($_GET['keyword']);
?>

<div class="tabel ">
  <table class="table table-striped">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Pegawai</th>
        <th>Alamat Pegawai</th>
        <th>Kota Pegawai</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>

      <?php if (empty($pegawai)) : ?>
        <tr>
          <td colspan="5" class="font-italic text-danger text-center ">
            Data pegawai tidak ditemukan
          </td>
        </tr>
      <?php endif ?>

      <?php
      $i = 1;
      foreach ($pegawai as $p) : ?>
        <tr>
          <td><?= $i++; ?></td>
          <td><?= $p['nm_pegawai']; ?></td>
          <td><?= $p['almt_pegawai']; ?></td>
          <td><?= $p['nm_kota']; ?></td>
          <td>
            <a class="btn btn-warning btn-sm" href="?u=1&id_pegawai=<?= $p['id_pegawai']; ?>">Ubah</a>
            <a class="btn btn-danger btn-sm" href="?h=1&id_pegawai=<?= $p['id_pegawai']; ?>" onclick="return confirm('apakah anda yakin?');">Hapus</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>