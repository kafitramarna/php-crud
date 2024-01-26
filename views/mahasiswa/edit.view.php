<?php require './views/partials/header.view.php'; ?>
    <div class="container">
        <form action="/mahasiswa?act=update&id=<?=$dataMahasiswa['id']?>" method="POST">
            <div>
                <label for="">Masukkan NIM</label>
                <input type="text" name="nim" value="<?= $dataMahasiswa['nim'] ?>">
            </div>
            <div>
                <label for="">Masukkan Nama Mahasiswa</label>
                <input type="text" name="nama" value="<?= $dataMahasiswa['nama'] ?>">
            </div>
            <div>
                <label for="">Pilih Program Studi :</label>
                <select name="prodi" id="">
                    <?php foreach($dataProdi as $prodi): ?>
                        <option value="<?= $prodi["id"] ?>" <?= $prodi["id"] == $dataMahasiswa["program_studi"] ? "selected" : "" ?>><?= $prodi["prodi"] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label for="">Masukkan Semester :</label>
                <input type="text" name="semester" value="<?= $dataMahasiswa['semester'] ?>">
            </div>
            <button type="submit">simpan</button>
        </form>
        <a href="/mahasiswa" class="btn btn-danger">Kembali</a>
    </div>
    <?php require './views/partials/footer.view.php'; ?>