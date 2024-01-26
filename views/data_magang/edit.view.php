<?php require './views/partials/header.view.php'; ?>
<div class="container">
    <form action="/?act=update&id=<?=$dataJadwalMagang["id"]?>" method="POST">
        <div>
            <p>Nama Mahasiswa : <?=$dataJadwalMagang["nama"]?></p>
        </div>
        <div>
            <p>Jadwal Mulai Ma gang:</p>
            <input type="date" name="jadwalMulaiMagang" id="" value="<?=$dataJadwalMagang["jadwal_mulai_magang"]?>">
        </div>
        <div>
            <p>Jadwal Selesai Magang:</p>
            <input type="date" name="jadwalSelesaiMagang" id="" value="<?=$dataJadwalMagang["jadwal_selesai_magang"]?>">
        </div>
        <div>
            <p>Tempat Magang :</p>
            <select name="namaTempat" id="">
                <?php foreach($dataTempatMagang as $tempatMagang):?>
                    <option value="<?=$tempatMagang["id"]?>" <?= $dataJadwalMagang["id_tempat_magang"] == $tempatMagang["id"] ? "selected" : "" ?>><?=$tempatMagang["nama_tempat"]?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <p>Dosen Pembimbing :</p>
            <select name="namaDosen" id="">
                <?php foreach($dataDosen as $dosen):?>
                    <option value="<?=$dosen["id"]?>" <?= $dataJadwalMagang["id_dosen"] == $dosen["id"] ? "selected" : "" ?>><?=$dosen["nama"]?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary mt-3">simpan</button>
    </form>
    <a href="/" class="btn btn-danger">Kembali</a>
</div>
    <?php require './views/partials/footer.view.php'; ?>