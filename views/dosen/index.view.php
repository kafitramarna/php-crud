<?php require './views/partials/header.view.php'; ?>
<div class="container">
    <form action="" method="get">
        <input type="text" placeholder="cari nama/nik dosen" name="cari">
        <button type="submit">cari</button>
    </form>
    <a href="/dosen?act=tambah" class="btn btn-primary mt-3">tambah dosen</a>
    <table class="table table-hover table-bordered mt-3">
        <thead>
            <th>No</th>
            <th>NIK</th>
            <th>Nama Dosen</th>
            <th>Gelar Depan</th>
            <th>Gelar Belakang</th>
            <th>Program Studi</th>
            <th>Aksi</th>
        </thead>
        <tbody>
            <?php foreach ($listDosen as $dosen) : ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $dosen['nik'] ?></td>
                    <td><?= $dosen['nama'] ?></td>
                    <td><?= $dosen['gelar_depan'] ?></td>
                    <td><?= $dosen['gelar_belakang'] ?></td>
                    <td><?= $dosen['prodi'] ?></td>
                    <td>
                        <a href="/dosen?act=edit&id=<?= $dosen['id'] ?>" class="text-decoration-none text-primary">edit</a>
                        <a href="/dosen?act=delete&id=<?= $dosen['id'] ?>" class="text-decoration-none text-danger" onclick="return confirm('yakin?')">delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php if ($totalHalaman > 1) : ?>
        <div class="d-flex justify-content-center gap-3">
            <?php if (isset($_GET['halaman']) && $_GET['halaman'] == $totalHalaman) : ?>
                <a href="/dosen?halaman=<?= $halamanAktif - 1  ?><?=isset($_GET['cari']) ? '&cari='.$_GET['cari'] : ''?>">
                    <</a>
                    <?php endif; ?>
                    <?php for ($i = 0; $i < $totalHalaman; $i++) : ?>
                        <a href="/dosen?halaman=<?= $i + 1 ?><?=isset($_GET['cari']) ? '&cari='.$_GET['cari'] : ''?>"><?= $i + 1 ?></a>
                    <?php endfor; ?>
                    <?php if (!isset($_GET['halaman']) || $_GET['halaman'] == 1) : ?>
                        <a href="/dosen?halaman=<?= $halamanAktif + 1 ?><?=isset($_GET['cari']) ? '&cari='.$_GET['cari'] : ''?>">></a>
                    <?php endif; ?>
        </div>
    <?php endif ?>
    <a href="/dosen?act=print"target="_blank" class="btn btn-success mt-3">download pdf</a>
</div>
<?php require './views/partials/footer.view.php'; ?>