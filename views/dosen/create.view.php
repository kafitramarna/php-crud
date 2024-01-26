<?php require './views/partials/header.view.php'; ?>
    <div class="container">
        <form action="/dosen?act=simpan" method="POST">
            <div>
                <label for="">Masukkan NIK</label>
                <input type="text" name="nik" required>
            </div>
            <div>
                <label for="">Masukkan Nama Dosen</label>
                <input type="text" name="nama" required>
            </div>
            <div>
                <label for="">Masukkan Gelar Depan :</label>
                <input type="text" name="gelar_depan">
            </div>
            <div>
                <label for="">Masukkan Gelar Belakang:</label>
                <input type="text" name="gelar_belakang" required>
            </div>
            <div>
                <label for="">Pilih Program Studi :</label>
                <select name="prodi" id="" required>
                    <?php foreach($dataProdi as $prodi): ?>
                        <option value="<?= $prodi["id"] ?>"><?= $prodi["prodi"] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit">simpan</button>
        </form>
        <a href="/dosen" class="btn btn-danger">Kembali</a>
    </div>
    <?php require './views/partials/footer.view.php'; ?>