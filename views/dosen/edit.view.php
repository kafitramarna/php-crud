<?php require './views/partials/header.view.php'; ?>
    <div class="container">
        <form action="/dosen?act=update&id=<?= $dataDosen['id'] ?>" method="POST">
            <div>
                <label for="">Masukkan NIK</label>
                <input type="text" name="nik" value="<?= $dataDosen['nik'] ?>">
            </div>
            <div>
                <label for="">Masukkan Nama Dosen</label>
                <input type="text" name="nama" value="<?= $dataDosen['nama'] ?>">
            </div>
            <div>
                <label for="">Masukkan Gelar Depan :</label>
                <input type="text" name="gelar_depan" value="<?= $dataDosen['gelar_depan'] ?>">
            </div>
            <div>
                <label for="">Masukkan Gelar Belakang:</label>
                <input type="text" name="gelar_belakang" value="<?= $dataDosen['gelar_belakang'] ?>">
            </div>
            <div>
                <label for="">Pilih Program Studi :</label>
                <select name="prodi" id="">
                    <?php foreach($dataProdi as $prodi): ?>
                        <option value="<?= $prodi["id"] ?>" <?= $prodi["id"] == $dataDosen["program_studi"] ? "selected" : "" ?>><?= $prodi["prodi"] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit">simpan</button>
        </form>
        <a href="/dosen" class="btn btn-danger">Kembali</a>
    </div>
</body>
<?php require './views/partials/footer.view.php'; ?>