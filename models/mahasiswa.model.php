<?php
    class Mahasiswa{
        private $nim;
        private $nama;
        private $program_studi;
        private $semester;

        public function __construct($nim, $nama, $program_studi, $semester){
            $this->nim = $nim;
            $this->nama = $nama;
            $this->program_studi = $program_studi;
            $this->semester = $semester;
        }
        public static function tampilMahasiswa($cari="") :array{
            $connection = new PDO("mysql:host=localhost;port=3306;dbname=sistem_informasi;user=root;charset=utf8mb4;");
            $listMahasiswa = $connection->query('SELECT mahasiswa.*, prodi.prodi FROM mahasiswa INNER JOIN prodi ON mahasiswa.program_studi = prodi.id
                WHERE mahasiswa.nim LIKE "%' . $cari . '%" OR mahasiswa.nama LIKE "%' . $cari . '%";
            ')->fetchAll(PDO::FETCH_ASSOC);
            return $listMahasiswa;
        }
        public static function tampilMahasiswaPerPage($awalData, $jumlahData, $cari="") :array{
            $connection = new PDO("mysql:host=localhost;port=3306;dbname=sistem_informasi;user=root;charset=utf8mb4;");
            $listMahasiswa = $connection->query('SELECT mahasiswa.*, prodi.prodi FROM mahasiswa INNER JOIN prodi ON mahasiswa.program_studi = prodi.id
            WHERE mahasiswa.nim LIKE "%' . $cari . '%" OR mahasiswa.nama LIKE "%' . $cari . '%" LIMIT ' . $awalData . ', ' . $jumlahData . ';')->fetchAll(PDO::FETCH_ASSOC);
            return $listMahasiswa;
        }
        public static function tampilMahasiswaById($id) :array{
            $connection = new PDO("mysql:host=localhost;port=3306;dbname=sistem_informasi;user=root;charset=utf8mb4;");
            $query = $connection->prepare('SELECT mahasiswa.*, prodi.prodi FROM mahasiswa INNER JOIN prodi ON mahasiswa.program_studi = prodi.id WHERE mahasiswa.id = ?');
            $query->execute([$id]);
            return $query->fetch(PDO::FETCH_ASSOC);
        }
        public function tambahMahasiswa() :void{
            $connection = new PDO("mysql:host=localhost;port=3306;dbname=sistem_informasi;user=root;charset=utf8mb4;");
            $query = $connection->prepare('INSERT INTO mahasiswa (nim, nama, program_studi, semester) VALUES (?, ?, ?, ?)');
            $query->execute([$this->nim, $this->nama, $this->program_studi, $this->semester]);
            $query = $connection->prepare('INSERT INTO akun (username,password,role) VALUES (?,?,?)');
            $query->execute([$this->nim, "mahasiswa", "mahasiswa"]);
        }
        public function editMahasiswa($id) :void{
            $connection = new PDO("mysql:host=localhost;port=3306;dbname=sistem_informasi;user=root;charset=utf8mb4;");
            $query = $connection->prepare('UPDATE mahasiswa SET nim = ?, nama = ?, program_studi = ?, semester = ? WHERE id = ?');
            $query->execute([$this->nim, $this->nama, $this->program_studi, $this->semester, $id]);
        }
        public static function hapusMahasiswa($id) :void{
            $connection = new PDO("mysql:host=localhost;port=3306;dbname=sistem_informasi;user=root;charset=utf8mb4;");
            $query = $connection->prepare('DELETE FROM mahasiswa WHERE id = ?');
            $query->execute([$id]);
        }
    }