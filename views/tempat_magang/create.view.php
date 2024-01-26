<?php require './views/partials/header.view.php'; ?>
    <div class="container">
        <form action="/tempat-magang?act=simpan" method="POST">
            <div>
                <label for="">Masukkan Nama Tempat</label>
                <input type="text" name="nama_tempat" required>
            </div>
            <div>
                <label for="">Masukkan Alamat</label>
                <input type="text" name="alamat" required>
            </div>
            <div>
                <label for="">Masukkan kota/kabupaten :</label>
                <input type="text" name="kota" required>
            </div>
            <div>
                <label for="">Masukkan Provinsi :</label>
                <input type="text" name="provinsi" required>
            </div>
            <div>
                <label for="">Masukkan Telepon :</label>
                <input type="text" name="telepon" required>
            </div>  
            <button type="submit">simpan</button>
        </form>
        <a href="/tempat-magang" class="btn btn-danger">Kembali</a>
    </div>
    <?php require './views/partials/footer.view.php'; ?>