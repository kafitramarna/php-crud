<?php require './views/partials/header.view.php'; ?>
<div class="container">    
<?php if ($_SESSION['role'] == 'admin'): ?>
    <a href="/?act=tambah" class="btn btn-primary">tambah data magang</a>
    <form action="" method="GET" class="mt-3">
        <label for="">filter prodi:</label>
        <select name="prodi" id="">
            <option value="">--pilih prodi--</option>
            <?php foreach($dataProdi as $prodi): ?>
                <option value="<?= $prodi["id"] ?>" <?= isset($_GET['prodi']) && $prodi["id"] == $_GET['prodi'] ? "selected" : ""?>><?= $prodi["prodi"] ?></option>
            <?php endforeach; ?>
        </select>
        <br>
        <label for="">filter tempat magang:</label>
        <select name="tempatMagang" id="">
            <option value="">--pilih tempat magang--</option>
            <?php foreach($dataTempatMagang as $tempatMagang): ?>
                <option value="<?= $tempatMagang["id"] ?>" <?= isset($_GET['tempatMagang']) && $tempatMagang["id"] == $_GET['tempatMagang'] ? "selected" : ""?>><?= $tempatMagang["nama_tempat"] ?></option>
            <?php endforeach; ?>
        </select>
        <br>
        <label for="">filter dosen pembimbing:</label>
        <select name="dosenPembimbing" id="">
            <option value="">--pilih dosen pembimbing--</option>
            <?php foreach($dataDosen as $dosen): ?>
                <option value="<?= $dosen["id"] ?>" <?= isset($_GET['dosenPembimbing']) && $dosen["id"] == $_GET['dosenPembimbing'] ? "selected" : ""?>><?= $dosen["gelar_depan"]?> <?= $dosen["nama"] ?>, <?= $dosen["gelar_belakang"] ?></option>
            <?php endforeach; ?>
        </select>
        <br>
        <label for="">Filter dari tanggal</label>
        <input type="date" name="dari" value="<?= isset($_GET['dari']) ? $_GET['dari'] : "" ?>">
        <br>
        <label for="">Filter sampai tanggal</label>
        <input type="date" name="sampai" value="<?= isset($_GET['sampai']) ? $_GET['sampai'] : "" ?>">
        <br>
        <button type="submit" class="btn btn-primary mt-3">cari</button>
    </form>
<?php endif ?>
<br>
    <?php if(count($listJadwalMagang) > 0): ?>
    <table class="table table-hover table-bordered">
        <thead>
            <th>No</th>
            <th>Nama Mahasiswa</th>
            <th>Program Studi</th>
            <th>Jadwal Magang</th>
            <th>Tempat Magang</th>
            <th>Dosen Pembimbing</th>
            <?php if($_SESSION['role'] == 'admin'): ?>
            <th>Aksi</th>
            <?php endif ?>
        </thead>
        <tbody>
            <?php foreach($listJadwalMagang as $jadwalMagang): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $jadwalMagang['nama']?></td>
                    <td><?= $jadwalMagang['prodi'] ?></td>
                    <td><?= $jadwalMagang['jadwal_mulai_magang'] ?> - <?= $jadwalMagang['jadwal_selesai_magang'] ?></td>
                    <td><?= $jadwalMagang['nama_tempat'] ?></td>
                    <td><?= $jadwalMagang['gelar_depan'] ?> <?= $jadwalMagang['dosen'] ?>, <?= $jadwalMagang['gelar_belakang'] ?></td>
                    <?php if($_SESSION['role'] == 'admin'): ?>
                    <td>
                        <a href="/?act=edit&id=<?= $jadwalMagang['id'] ?>" class="text-decoration-none text-primary">edit</a> 
                        <a href="/?act=delete&id=<?= $jadwalMagang['id']?>" class="text-decoration-none text-danger" onclick="return confirm('yakin?')">delete</a>
                    </td>
                    <?php endif ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
        <p>data not found</p>
    <?php endif ?>
    <?php if($_SESSION['role'] == 'admin'): ?>
    <?php if($totalHalaman > 1): ?>
        <div class="d-flex justify-content-center gap-3">
        <?php if(isset($_GET['halaman'])&&$_GET['halaman']==$totalHalaman):?>
            <a href="/?halaman=<?= $halamanAktif-1  ?><?=isset($_GET['prodi'])&&isset($_GET['tempatMagang'])&&isset($_GET['dosenPembimbing'])&&isset($_GET['dari'])&&isset($_GET['sampai']) ? "&prodi=" . $_GET['prodi'] . "&tempatMagang=" . $_GET['tempatMagang'] . "&dosenPembimbing=" . $_GET['dosenPembimbing'] ."&dari=" . $_GET['dari'] ."&sampai=" . $_GET['sampai']: ""?>"><</a>
        <?php endif; ?>
        <?php for($i = 0;$i<$totalHalaman;$i++) : ?>
            <a href="/?halaman=<?=$i+1?> <?=isset($_GET['prodi'])&&isset($_GET['tempatMagang'])&&isset($_GET['dosenPembimbing'])&&isset($_GET['dari'])&&isset($_GET['sampai']) ? "&prodi=" . $_GET['prodi'] . "&tempatMagang=" . $_GET['tempatMagang'] . "&dosenPembimbing=" . $_GET['dosenPembimbing']."&dari=" . $_GET['dari'] ."&sampai=" . $_GET['sampai'] : ""?>"><?= $i+1 ?></a>
        <?php endfor; ?>
        <?php if(!isset($_GET['halaman'])||$_GET['halaman']==1):?>
            <a href="/?halaman=<?= $halamanAktif+1 ?> <?=isset($_GET['prodi'])&&isset($_GET['tempatMagang'])&&isset($_GET['dosenPembimbing'])&&isset($_GET['dari'])&&isset($_GET['sampai']) ? "&prodi=" . $_GET['prodi'] . "&tempatMagang=" . $_GET['tempatMagang'] . "&dosenPembimbing=" . $_GET['dosenPembimbing']."&dari=" . $_GET['dari'] ."&sampai=" . $_GET['sampai'] : ""?>">></a>
        <?php endif; ?>
    </div>
    <?php endif ?>
    <a href="/?act=print" target="_blank" class="btn btn-success mt-3">download pdf</a>
    <?php endif ?>
    </div>
<?php require './views/partials/footer.view.php'; ?>