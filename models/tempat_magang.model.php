<?php
    class TempatMagang{
        private $nama_tempat;
        private $alamat;
        private $kota;
        private $provinsi;
        private $telepon;
        public function __construct($nama_tempat, $alamat, $kota, $provinsi, $telepon){
            $this->nama_tempat = $nama_tempat;
            $this->alamat = $alamat;
            $this->kota = $kota;
            $this->provinsi = $provinsi;
            $this->telepon = $telepon;
        }
        public static function tampilTempatMagang($cari=""): array{
            $connection = new PDO("mysql:host=localhost;port=3306;dbname=sistem_informasi;user=root;charset=utf8mb4;");
            $listTempatMagang = $connection->query('SELECT * FROM tempat_magang WHERE nama_tempat LIKE "%' . $cari . '%"')->fetchAll(PDO::FETCH_ASSOC);
            return $listTempatMagang;
        }
        public static function tampilTempatMagangById($id): array{
            $connection = new PDO("mysql:host=localhost;port=3306;dbname=sistem_informasi;user=root;charset=utf8mb4;");
            $query = $connection->prepare('SELECT * FROM tempat_magang WHERE id = ?');
            $query->execute([$id]);
            $tempatMagang = $query->fetch(PDO::FETCH_ASSOC);
            return $tempatMagang;
        }
        public static function tampilTempatMagangPerPage($awalData, $jumlahData, $cari=""): array{
            $connection = new PDO("mysql:host=localhost;port=3306;dbname=sistem_informasi;user=root;charset=utf8mb4;");
            $listTempatMagang = $connection->query('SELECT * FROM tempat_magang WHERE nama_tempat LIKE "%' . $cari . '%" LIMIT ' . $awalData . ', ' . $jumlahData . ';')->fetchAll(PDO::FETCH_ASSOC);
            return $listTempatMagang;
        }

        public function tambahTempatMagang(): void{
            $connection = new PDO("mysql:host=localhost;port=3306;dbname=sistem_informasi;user=root;charset=utf8mb4;");
            $query = $connection->prepare('INSERT INTO tempat_magang (nama_tempat, alamat, kota, provinsi, telepon) VALUES (?, ?, ?, ?, ?)');
            $query->execute([$this->nama_tempat, $this->alamat, $this->kota, $this->provinsi, $this->telepon]);
        }
        public function editTempatMagang($id): void{
            $connection = new PDO("mysql:host=localhost;port=3306;dbname=sistem_informasi;user=root;charset=utf8mb4;");
            $query = $connection->prepare('UPDATE tempat_magang SET nama_tempat = ?, alamat = ?, kota = ?, provinsi = ?, telepon = ? WHERE id = ?');
            $query->execute([$this->nama_tempat, $this->alamat, $this->kota, $this->provinsi, $this->telepon, $id]);
        }
        public static function hapusTempatMagang($id): void{
            $connection = new PDO("mysql:host=localhost;port=3306;dbname=sistem_informasi;user=root;charset=utf8mb4;");
            $query = $connection->prepare('DELETE FROM tempat_magang WHERE id = ?');
            $query->execute([$id]);
        }
    }