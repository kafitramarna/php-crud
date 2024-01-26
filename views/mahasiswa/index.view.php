<?php require './views/partials/header.view.php'; ?>
<div class="container">
    <form action="" method="get">
        <input type="text" placeholder="cari nama/nim mahasiswa" name="cari">
        <button type="submit">cari</button>
    </form>
    <a href="/mahasiswa?act=tambah" class="btn btn-primary mt-3">tambah mahasiswa</a>
    <table class="table table-hover table-bordered mt-3">
        <thead>
            <th>No</th>
            <th>NIM</th>
            <th>Nama Mahasiswa</th>
            <th>Program Studi</th>
            <th>Semester</th>
            <th>Aksi</th>
        </thead>
        <tbody>
            <?php foreach ($listMahasiswa as $mahasiswa) : ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $mahasiswa['nim'] ?></td>
                    <td><?= $mahasiswa['nama'] ?></td>
                    <td><?= $mahasiswa['prodi'] ?></td>
                    <td><?= $mahasiswa['semester'] ?></td>
                    <td>
                        <a href="/mahasiswa?act=edit&id=<?= $mahasiswa['id'] ?>" class="text-decoration-none text-primary">edit</a>
                        <a href="/mahasiswa?act=delete&id=<?= $mahasiswa['id'] ?>" class="text-decoration-none text-danger" onclick="return confirm('yakin?')">delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php if ($totalHalaman > 1) : ?>
        <div class="d-flex justify-content-center gap-3">
            <?php if (isset($_GET['halaman']) && $_GET['halaman'] == $totalHalaman) : ?>
                <a href="/mahasiswa?halaman=<?= $halamanAktif - 1  ?><?=isset($_GET['cari']) ? '&cari='.$_GET['cari'] : ''?>"><</a>
                    <?php endif; ?>
                    <?php for ($i = 0; $i < $totalHalaman; $i++) : ?>
                        <a href="/mahasiswa?halaman=<?= $i + 1 ?><?=isset($_GET['cari']) ? '&cari='.$_GET['cari'] : ''?>"><?= $i + 1 ?></a>
                    <?php endfor; ?>
                    <?php if (!isset($_GET['halaman']) || $_GET['halaman'] == 1) : ?>
                        <a href="/mahasiswa?halaman=<?= $halamanAktif + 1 ?> <?=isset($_GET['cari']) ? '&cari='.$_GET['cari'] : ''?>">></a>
                    <?php endif; ?>
        </div>
    <?php endif ?>
    <a href="/mahasiswa?act=print"target="_blank" class="btn btn-success mt-3">download pdf</a>
</div>
<?php require './views/partials/footer.view.php'; ?>