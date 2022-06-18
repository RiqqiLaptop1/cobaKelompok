<main role="main" class="flex-shrink-0">

  <div class="jumbotron text-center bg-light " style="margin-top: 60px;">
    <h1 class="">Tabel Produk</h1>
    <hr>
  </div>

  <div class="container">

    <div class="row">
      <div class="col-md-4">
        <h3 class=""><?= $aksi; ?> data</h3>
        <form action="" method="POST">
          <input type="hidden" name="id_brg" value="<?= $id; ?>">
          <div class="form-group">
            <label for="nama">Nama Produk</label>
            <input type="text" class="form-control" id="nama" name="nama" required autocomplete="off" value="<?= $nama; ?>" <?= $a; ?>>
          </div>
          <div class="form-group">
            <label for="harga">Harga Produk</label>
            <input type="number" class="form-control" id="harga" name="harga" required autocomplete="off" value="<?= $harga; ?>" <?= $a; ?> placeholder="Rp.">
          </div>
          <div class="form-group">
            <label for="stok">Stok Produk</label>
            <input type="number" class="form-control" id="stok" name="stok" required autocomplete="off" value="<?= $stok; ?>" <?= $a; ?>>
          </div>
          <button type="reset" class="btn btn-secondary">Reset</button>
          <button type="submit" class="btn btn-primary" name="<?= $aksi; ?>"><?= $aksi; ?></button>
        </form>
      </div>
      <div class="col-md-7">

        <!-- pencarian -->
        <form action="" method="POST" class=" mx-4  d-inline-block ">
          <div class="form-group ">
            <input type="text" class="form-control keyword" name="keyword" placeholder="masukkan keyword pencarian..." autocomplete="off" size="50">
            <button type="submit" name="cari" class="tombol-cari">Cari</button>
          </div>
        </form>

        <!-- tabel -->
        <div class="tabel mb-5">
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
                    <a class="btn btn-warning btn-sm" href="?u=1&id_brg=<?= $b['id_brg']; ?>">Ubah</a>
                    <a class="btn btn-danger btn-sm" href="?h=1&id_brg=<?= $b['id_brg']; ?>" onclick="return confirm('apakah anda yakin?');">Hapus</a>
                  </td>
                </tr>
              <?php endforeach; ?>

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</main>