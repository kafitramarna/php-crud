<?php require './views/partials/header.view.php'; ?>
<div class="container">
    <form action="" method="get">
        <input type="text" placeholder="cari nama tempat" name="cari">
        <button type="submit">cari</button>
    </form>
    <a href="/tempat-magang?act=tambah" class="btn btn-primary mt-3">tambah tempat magang</a>
    <table class="table table-hover table-bordered mt-3">
        <thead>
            <th>No</th>
            <th>Nama Tempat</th>
            <th>Alamat</th>
            <th>Kota/Kabupaten</th>
            <th>Provinsi</th>
            <th>Telepon</th>
            <td>aksi</td>
        </thead>
        <tbody>
            <?php foreach($listTempatMagang as $tempatMagang): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $tempatMagang['nama_tempat']?></td>
                    <td><?= $tempatMagang['alamat']?></td>
                    <td><?= $tempatMagang['kota']?></td>
                    <td><?= $tempatMagang['provinsi']?></td>
                    <td><?= $tempatMagang['telepon']?></td>
                    <td class="d-flex gap-3">
                        <a href="/tempat-magang?act=edit&id=<?= $tempatMagang['id'] ?>" class="text-decoration-none text-primary">edit</a> 
                        <a href="/tempat-magang?act=delete&id=<?= $tempatMagang['id'] ?>" class="text-decoration-none text-danger" onclick="return confirm('yakin?')">delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php if ($totalHalaman > 1) : ?>
        <div class="d-flex justify-content-center gap-3">
            <?php if (isset($_GET['halaman']) && $_GET['halaman'] == $totalHalaman) : ?>
                <a href="/tempat-magang?halaman=<?= $halamanAktif - 1  ?><?=isset($_GET['cari']) ? '&cari='.$_GET['cari'] : ''?>">
                    <</a>
                    <?php endif; ?>
                    <?php for ($i = 0; $i < $totalHalaman; $i++) : ?>
                        <a href="/tempat-magang?halaman=<?= $i + 1 ?><?=isset($_GET['cari']) ? '&cari='.$_GET['cari'] : ''?>"><?= $i + 1 ?></a>
                    <?php endfor; ?>
                    <?php if (!isset($_GET['halaman']) || $_GET['halaman'] == 1) : ?>
                        <a href="/tempat-magang?halaman=<?= $halamanAktif + 1 ?><?=isset($_GET['cari']) ? '&cari='.$_GET['cari'] : ''?>">></a>
                    <?php endif; ?>
        </div>
    <?php endif ?>
    <a href="/tempat-magang?act=print"target="_blank" class="btn btn-success mt-3">download pdf</a>
    </div>
</body>
<?php require './views/partials/footer.view.php'; ?>