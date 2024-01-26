<?php
    class Dosen{
        private $nik;
        private $nama;
        private $gelar_depan;
        private $gelar_belakang;
        private $program_studi;

        public function __construct($nik, $nama, $gelar_depan, $gelar_belakang, $program_studi){
            $this->nik = $nik;
            $this->nama = $nama;
            $this->gelar_depan = $gelar_depan;
            $this->gelar_belakang = $gelar_belakang;
            $this->program_studi = $program_studi;
        }
        public static function tampilDosen($cari="") :array{
            $connection = new PDO("mysql:host=localhost;port=3306;dbname=sistem_informasi;user=root;charset=utf8mb4;");
            $listDosen = $connection->query('SELECT dosen_pembimbing.*, prodi.prodi FROM dosen_pembimbing INNER JOIN prodi ON dosen_pembimbing.program_studi = prodi.id
                WHERE dosen_pembimbing.nik LIKE "%' . $cari . '%" OR dosen_pembimbing.nama LIKE "%' . $cari . '%"
            ;')->fetchAll(PDO::FETCH_ASSOC);
            return $listDosen;
        }
        public static function tampilDosenPerPage($awalData, $jumlahData, $cari=""): array{
            $connection = new PDO("mysql:host=localhost;port=3306;dbname=sistem_informasi;user=root;charset=utf8mb4;");
            $listDosen = $connection->query('SELECT dosen_pembimbing.*, prodi.prodi FROM dosen_pembimbing INNER JOIN prodi ON dosen_pembimbing.program_studi = prodi.id
            WHERE dosen_pembimbing.nik LIKE "%' . $cari . '%" OR dosen_pembimbing.nama LIKE "%' . $cari . '%"
            LIMIT ' . $awalData . ', ' . $jumlahData .';')->fetchAll(PDO::FETCH_ASSOC);
            return $listDosen;
        }
        public static function tampilDosenById($id) :array{
            $connection = new PDO("mysql:host=localhost;port=3306;dbname=sistem_informasi;user=root;charset=utf8mb4;");
            $listDosen = $connection->query('SELECT dosen_pembimbing.*, prodi.prodi FROM dosen_pembimbing INNER JOIN prodi ON dosen_pembimbing.program_studi = prodi.id
            WHERE dosen_pembimbing.id = ' . $id .';')->fetch(PDO::FETCH_ASSOC);
            return $listDosen;
        }
        public function tambahDosen(): void{
            $connection = new PDO("mysql:host=localhost;port=3306;dbname=sistem_informasi;user=root;charset=utf8mb4;");
            $query = $connection->prepare('INSERT INTO dosen_pembimbing (nik, nama, gelar_depan, gelar_belakang, program_studi) VALUES (?, ?, ?, ?, ?)');
            $query->execute([$this->nik, $this->nama, $this->gelar_depan, $this->gelar_belakang, $this->program_studi]);
            $query = $connection->prepare('INSERT INTO akun (username, password,role) VALUES (?, ?, ?)');
            $query->execute([$this->nik, "dosen", "dosen"]);
        }
        public function editDosen($id): void{
            $connection = new PDO("mysql:host=localhost;port=3306;dbname=sistem_informasi;user=root;charset=utf8mb4;");
            $query = $connection->prepare('UPDATE dosen_pembimbing SET nik = ?, nama = ?, gelar_depan = ?, gelar_belakang = ?, program_studi = ? WHERE id = ?');
            $query->execute([$this->nik, $this->nama, $this->gelar_depan, $this->gelar_belakang, $this->program_studi, $id]);
        }
        public static function hapusDosen($id): void{
            $connection = new PDO("mysql:host=localhost;port=3306;dbname=sistem_informasi;user=root;charset=utf8mb4;");
            $query = $connection->prepare('DELETE FROM dosen_pembimbing WHERE id = ?');
            $query->execute([$id]);
        }
    }