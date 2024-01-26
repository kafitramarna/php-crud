<?php
    class Prodi{
        private $prodi;
        public function __construct($prodi){
            $this->prodi = $prodi;
        }
        public static function tampilProdi(){
            $connection = new PDO("mysql:host=localhost;port=3306;dbname=sistem_informasi;user=root;charset=utf8mb4;");
            $listProdi = $connection->query('SELECT * FROM prodi')->fetchAll(PDO::FETCH_ASSOC);
            return $listProdi;
        }
    }