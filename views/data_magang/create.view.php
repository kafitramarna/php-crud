<?php require './views/partials/header.view.php'; ?>
<div class="container">
    <form action="/?act=simpan" method="POST">
        <div>
            <p>Nama Mahasiswa :</p>
            <select name="namaMahasiswa" id="" required>
                <?php foreach($dataMahasiswa as $mahasiswa):?>
                    <option value="<?=$mahasiswa["id"]?>"><?=$mahasiswa["nama"]?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <p>Jadwal Mulai Magang:</p>
            <input type="date" name="jadwalMulaiMagang" id="" required>
        </div>
        <div>
            <p>Jadwal Selesai Magang:</p>
            <input type="date" name="jadwalSelesaiMagang" id="" required>
        </div>
        <div>
            <p>Tempat Magang :</p>
            <select name="namaTempat" id="" required>
                <?php foreach($dataTempatMagang as $tempatMagang):?>
                    <option value="<?=$tempatMagang["id"]?>"><?=$tempatMagang["nama_tempat"]?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <p>Dosen Pembimbing :</p>
            <select name="namaDosen" id="" required>
                <?php foreach($dataDosen as $dosen):?>
                    <option value="<?=$dosen["id"]?>"><?=$dosen["nama"]?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary mt-3">simpan</button>
    </form>
    <a href="/" class="btn btn-danger">Kembali</a>
    </div>
    <?php require './views/partials/footer.view.php'; ?>