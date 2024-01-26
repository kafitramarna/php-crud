<?php require './views/partials/header.view.php'; ?>
    <div class="container">
        <form action="/mahasiswa?act=simpan" method="POST">
            <div>
                <label for="">Masukkan NIM</label>
                <input type="text" name="nim" required>
            </div>
            <div>
                <label for="">Masukkan Nama Mahasiswa</label>
                <input type="text" name="nama" required>
            </div>
            <div>
                <label for="">Pilih Program Studi :</label>
                <select name="prodi" id="" required>
                    <?php foreach($dataProdi as $prodi): ?>
                        <option value="<?= $prodi["id"] ?>"><?= $prodi["prodi"] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label for="">Masukkan Semester :</label>
                <input type="text" name="semester" required>
            </div>
            <button type="submit">simpan</button>
        </form>
        <a href="/mahasiswa" class="btn btn-danger">Kembali</a>
    </div>
    <?php require './views/partials/footer.view.php'; ?>