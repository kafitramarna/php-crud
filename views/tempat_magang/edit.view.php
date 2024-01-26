<?php require './views/partials/header.view.php'; ?>
    <div class="container">
        <form action="/tempat-magang?act=update&id=<?= $dataTempatMagang["id"] ?>" method="POST">
            <div>
                <label for="">Masukkan Nama Tempat</label>
                <input type="text" name="nama_tempat" value="<?= $dataTempatMagang["nama_tempat"] ?>">
            </div>
            <div>
                <label for="">Masukkan Alamat</label>
                <input type="text" name="alamat" value="<?= $dataTempatMagang["alamat"] ?>">
            </div>
            <div>
                <label for="">Masukkan kota/kabupaten :</label>
                <input type="text" name="kota" value="<?= $dataTempatMagang["kota"] ?>">
            </div>
            <div>
                <label for="">Masukkan Provinsi :</label>
                <input type="text" name="provinsi" value="<?= $dataTempatMagang["provinsi"] ?>">
            </div>
            <div>
                <label for="">Masukkan Telepon :</label>
                <input type="text" name="telepon" value="<?= $dataTempatMagang["telepon"] ?>">
            </div>
            <button type="submit">simpan</button>
        </form>
        <a href="/tempat-magang" class="btn btn-danger">Kembali</a>
    </div>
    <?php require './views/partials/footer.view.php'; ?>