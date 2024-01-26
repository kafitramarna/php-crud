<?php 
    class JadwalMagang{
        private $id_mahasiswa;
        private $waktu_mulai;
        private $waktu_selesai;
        private $id_tempat_magang;
        private $id_dosen;
        public function __construct($id_mahasiswa, $waktu_mulai, $waktu_selesai,$id_tempat_magang,$id_dosen){
            $this->id_mahasiswa = $id_mahasiswa;
            $this->waktu_mulai = $waktu_mulai;
            $this->waktu_selesai = $waktu_selesai;
            $this->id_tempat_magang = $id_tempat_magang;
            $this->id_dosen = $id_dosen;
        }
        public static function tampilJadwalMagang($filterProdi="", $filterTempatMagang="", $filterDosenPembimbing="", $filterWaktuMulai="", $filterWaktuSelesai="") : array{
            $connection = new PDO("mysql:host=localhost;port=3306;dbname=sistem_informasi;user=root;charset=utf8mb4;");
            $query = 'SELECT 
            jadwal_magang.id, 
            mahasiswa.nama,
            mahasiswa.program_studi,
            prodi.prodi, 
            tempat_magang.nama_tempat, 
            DATE_FORMAT(jadwal_magang.jadwal_mulai_magang, "%d-%M-%Y") AS jadwal_mulai_magang,
            DATE_FORMAT(jadwal_magang.jadwal_selesai_magang, "%d-%M-%Y") AS jadwal_selesai_magang,
            dosen_pembimbing.nama AS dosen,
            dosen_pembimbing.id AS dosen_id,
            dosen_pembimbing.gelar_depan,
            dosen_pembimbing.gelar_belakang
            FROM jadwal_magang 
            INNER JOIN mahasiswa ON jadwal_magang.mahasiswa_id = mahasiswa.id 
            INNER JOIN prodi ON mahasiswa.program_studi = prodi.id 
            INNER JOIN tempat_magang ON jadwal_magang.id_tempat_magang = tempat_magang.id 
            INNER JOIN dosen_pembimbing ON jadwal_magang.id_dosen = dosen_pembimbing.id';
            if ($filterProdi != "") {
                $query .= ' WHERE prodi.id = ' . $filterProdi;
            }
            if ($filterTempatMagang != "") {
                $query .= (strpos($query, 'WHERE') !== false) ? ' AND ' : ' WHERE ';
                $query .= ' tempat_magang.id = ' . $filterTempatMagang;
            }
            if ($filterDosenPembimbing != "") {
                $query .= (strpos($query, 'WHERE') !== false) ? ' AND ' : ' WHERE ';
                $query .= ' dosen_pembimbing.id = ' . $filterDosenPembimbing;
            }
            if($filterWaktuMulai != ""){
                $query .= (strpos($query, 'WHERE') !== false) ? ' AND ' : ' WHERE ';
                $query .= ' jadwal_magang.jadwal_mulai_magang >= "' . $filterWaktuMulai . '"';
            }
            if($filterWaktuSelesai != ""){
                $query .= (strpos($query, 'WHERE') !== false) ? ' AND ' : ' WHERE ';
                $query .= ' jadwal_magang.jadwal_selesai_magang <= "' . $filterWaktuSelesai . '"';
            }
            $listJadwalMagang = $connection->query($query.' ORDER BY jadwal_magang.id')->fetchAll(PDO::FETCH_ASSOC);
            return $listJadwalMagang;
        }
        public static function tampilJadwalMagangPerHalaman($awalData, $jumlahData, $filterProdi="", $filterTempatMagang="", $filterDosenPembimbing="", $filterWaktuMulai="", $filterWaktuSelesai="") : array{
            $connection = new PDO("mysql:host=localhost;port=3306;dbname=sistem_informasi;user=root;charset=utf8mb4;");
            $query = 'SELECT 
            jadwal_magang.id, 
            mahasiswa.nama,
            mahasiswa.program_studi,
            prodi.prodi, 
            tempat_magang.nama_tempat, 
            DATE_FORMAT(jadwal_magang.jadwal_mulai_magang, "%d-%M-%Y") AS jadwal_mulai_magang,
            DATE_FORMAT(jadwal_magang.jadwal_selesai_magang, "%d-%M-%Y") AS jadwal_selesai_magang,
            dosen_pembimbing.nama AS dosen,
            dosen_pembimbing.id AS dosen_id,
            dosen_pembimbing.gelar_depan,
            dosen_pembimbing.gelar_belakang
            FROM jadwal_magang 
            INNER JOIN mahasiswa ON jadwal_magang.mahasiswa_id = mahasiswa.id 
            INNER JOIN prodi ON mahasiswa.program_studi = prodi.id 
            INNER JOIN tempat_magang ON jadwal_magang.id_tempat_magang = tempat_magang.id 
            INNER JOIN dosen_pembimbing ON jadwal_magang.id_dosen = dosen_pembimbing.id';
            if ($filterProdi != "") {
                $query .= ' WHERE prodi.id = ' . $filterProdi;
            }
            if ($filterTempatMagang != "") {
                $query .= (strpos($query, 'WHERE') !== false) ? ' AND ' : ' WHERE ';
                $query .= ' tempat_magang.id = ' . $filterTempatMagang;
            }
            if ($filterDosenPembimbing != "") {
                $query .= (strpos($query, 'WHERE') !== false) ? ' AND ' : ' WHERE ';
                $query .= ' dosen_pembimbing.id = ' . $filterDosenPembimbing;
            }
            if($filterWaktuMulai != ""){
                $query .= (strpos($query, 'WHERE') !== false) ? ' AND ' : ' WHERE ';
                $query .= ' jadwal_magang.jadwal_mulai_magang >= "' . $filterWaktuMulai . '"';
            }
            if($filterWaktuSelesai != ""){
                $query .= (strpos($query, 'WHERE') !== false) ? ' AND ' : ' WHERE ';
                $query .= ' jadwal_magang.jadwal_selesai_magang <= "' . $filterWaktuSelesai . '"';
            }
            $listJadwalMagang = $connection->query($query .' ORDER BY jadwal_magang.id'. ' LIMIT ' . $awalData . ', '. $jumlahData)->fetchAll(PDO::FETCH_ASSOC);
            return $listJadwalMagang;
        }
        public static function tampilJadwalMagangByDosen($id): array{
            $connection = new PDO("mysql:host=localhost;port=3306;dbname=sistem_informasi;user=root;charset=utf8mb4;");
            $listJadwalMagang = $connection->query('SELECT 
            jadwal_magang.id,
            mahasiswa.nama,
            mahasiswa.program_studi,
            prodi.prodi,
            jadwal_magang.jadwal_mulai_magang,
            jadwal_magang.jadwal_selesai_magang,
            tempat_magang.nama_tempat,
            dosen_pembimbing.nama AS dosen,
            dosen_pembimbing.gelar_depan,
            dosen_pembimbing.gelar_belakang
            FROM jadwal_magang
            INNER JOIN mahasiswa ON jadwal_magang.mahasiswa_id = mahasiswa.id
            INNER JOIN prodi ON mahasiswa.program_studi = prodi.id
            INNER JOIN tempat_magang ON jadwal_magang.id_tempat_magang = tempat_magang.id
            INNER JOIN dosen_pembimbing ON jadwal_magang.id_dosen = dosen_pembimbing.id
            WHERE dosen_pembimbing.nik = "' . $id . '"
            ORDER BY jadwal_magang.id')->fetchAll(PDO::FETCH_ASSOC);
            return $listJadwalMagang;
        }
        public static function tampilJadwalMagangByMahasiswa($id): array{
            $connection = new PDO("mysql:host=localhost;port=3306;dbname=sistem_informasi;user=root;charset=utf8mb4;");
            $listJadwalMagang = $connection->query('SELECT 
                jadwal_magang.id, 
                mahasiswa.nama,
                mahasiswa.nim,
                mahasiswa.program_studi,
                prodi.prodi, 
                jadwal_magang.jadwal_mulai_magang,
                jadwal_magang.jadwal_selesai_magang,
                tempat_magang.nama_tempat,
                dosen_pembimbing.nama AS dosen,
                dosen_pembimbing.gelar_depan,
                dosen_pembimbing.gelar_belakang 
                FROM jadwal_magang 
                INNER JOIN mahasiswa ON jadwal_magang.mahasiswa_id = mahasiswa.id 
                INNER JOIN prodi ON mahasiswa.program_studi = prodi.id 
                INNER JOIN tempat_magang ON jadwal_magang.id_tempat_magang = tempat_magang.id 
                INNER JOIN dosen_pembimbing ON jadwal_magang.id_dosen = dosen_pembimbing.id 
                WHERE mahasiswa.nim = "' . $id . '"
                ORDER BY jadwal_magang.id')->fetchAll(PDO::FETCH_ASSOC);
            return $listJadwalMagang;
        }

        public static function tampilJadwalMagangById($id): array{
            $connection = new PDO("mysql:host=localhost;port=3306;dbname=sistem_informasi;user=root;charset=utf8mb4;");
            $query = $connection->prepare('SELECT jadwal_magang.*, mahasiswa.nama FROM jadwal_magang INNER JOIN mahasiswa ON jadwal_magang.mahasiswa_id = mahasiswa.id WHERE jadwal_magang.id = ?');
            $query->execute([$id]);
            $dataJadwalMagang = $query->fetch(PDO::FETCH_ASSOC);
            return $dataJadwalMagang;
        }
        public function tambahJadwalMagang(): void{
            $connection = new PDO("mysql:host=localhost;port=3306;dbname=sistem_informasi;user=root;charset=utf8mb4;");
            $query = $connection->prepare('INSERT INTO jadwal_magang (id_tempat_magang, mahasiswa_id, jadwal_mulai_magang, jadwal_selesai_magang, id_dosen) VALUES (?, ?, ?, ?, ?)');
            $query->execute([$this->id_tempat_magang, $this->id_mahasiswa, $this->waktu_mulai, $this->waktu_selesai, $this->id_dosen]);
        }
        public function editJadwalMagang($id): void{
            $connection = new PDO("mysql:host=localhost;port=3306;dbname=sistem_informasi;user=root;charset=utf8mb4;");
            $query = $connection->prepare('UPDATE jadwal_magang SET id_tempat_magang = ?, jadwal_mulai_magang = ?, jadwal_selesai_magang = ?, id_dosen = ? WHERE id = ?');
            $query->execute([$this->id_tempat_magang, $this->waktu_mulai, $this->waktu_selesai, $this->id_dosen, $id]);
        }
        public static function hapusJadwalMagang($id): void{
            $connection = new PDO("mysql:host=localhost;port=3306;dbname=sistem_informasi;user=root;charset=utf8mb4;");
            $query = $connection->prepare('DELETE FROM jadwal_magang WHERE id = ?');
            $query->execute([$id]);
        }
    }    