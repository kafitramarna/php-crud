<?php
if (!isset($_SESSION['username'])) {
    header('location: /login');
}
require './models/dosen.model.php';
require './models/mahasiswa.model.php';
require './models/tempat_magang.model.php';
require './models/jadwal_magang.model.php';
require './models/prodi.model.php';
require './fpdf/fpdf.php';
function handleTambah(): void
{
    $dataMahasiswa = Mahasiswa::tampilMahasiswa();
    $dataTempatMagang = TempatMagang::tampilTempatMagang();
    $dataDosen = Dosen::tampilDosen();
    require './views/data_magang/create.view.php';
}
function handleSimpan(): void
{
    if (isset($_POST)) {
        $data = $_POST;
        $tambahData = new JadwalMagang($data['namaMahasiswa'], $data['jadwalMulaiMagang'], $data['jadwalSelesaiMagang'], $data['namaTempat'], $data['namaDosen']);
        $tambahData->tambahJadwalMagang();
        header('location: /');
    }
}
function handleEdit(): void
{
    $dataJadwalMagang = JadwalMagang::tampilJadwalMagangById($_GET['id']);
    $dataTempatMagang = TempatMagang::tampilTempatMagang();
    $dataDosen = Dosen::tampilDosen();
    require './views/data_magang/edit.view.php';
}
function handleUpdate(): void
{
    if (isset($_POST)) {
        $data = $_POST;
        $updateData = new JadwalMagang($_GET['id'], $data['jadwalMulaiMagang'], $data['jadwalSelesaiMagang'], $data['namaTempat'], $data['namaDosen']);
        $updateData->editJadwalMagang($_GET['id']);
        header('location: /');
    }
}
function handleDelete(): void
{
    JadwalMagang::hapusJadwalMagang($_GET['id']);
    header('location: /');
}
function handlePrint(): void
{
    $listJadwalMagang = JadwalMagang::tampilJadwalMagang();
    $pdf = new FPDF();
    $pdf->AddPage('L');
    $pdf->SetFont('Times', '', 20);
    $pdf->Cell(0, 20, 'DATA JADWAL MAGANG', 0, 0, 'C');
    $pdf->SetFont('Times', '', 14, 'B');
    $pdf->Ln(20);
    $pdf->Cell(10, 10, 'No', 1, 0, 'C');
    $pdf->Cell(45, 10, 'Nama Mahasiswa', 1, 0, 'C');
    $pdf->Cell(45, 10, 'Program Studi', 1, 0, 'C');
    $pdf->Cell(60, 10, 'Jadwal Magang', 1, 0, 'C');
    $pdf->Cell(45, 10, 'Tempat Magang', 1, 0, 'C');
    $pdf->Cell(0, 10, 'Dosen Pembimbing', 1, 0, 'C');
    $pdf->SetFont('Times', '', 10);
    for ($i = 0; $i < count($listJadwalMagang); $i++) {
        $pdf->Ln(10);
        $pdf->Cell(10, 10, $i + 1, 1, 0, 'C');
        $pdf->Cell(45, 10, $listJadwalMagang[$i]['nama'], 1, 0, 'C');
        $pdf->Cell(45, 10, $listJadwalMagang[$i]['prodi'], 1, 0, 'C');
        $pdf->Cell(60, 10, $listJadwalMagang[$i]['jadwal_mulai_magang'] . ' - ' . $listJadwalMagang[$i]['jadwal_selesai_magang'], 1, 0, 'C');
        $pdf->Cell(45, 10, $listJadwalMagang[$i]['nama_tempat'], 1, 0, 'C');
        $pdf->Cell(0, 10, $listJadwalMagang[$i]['gelar_depan'] . ' ' . $listJadwalMagang[$i]['dosen'] . ', ' . $listJadwalMagang[$i]['gelar_belakang'], 1, 0, 'C');
    }
    $pdf->Output("data jadwal magang.pdf", "I");
}
if ($_SESSION['role'] == 'admin' && isset($_GET['act'])) {
    switch ($_GET['act']) {
        case 'tambah':
            handleTambah();
            break;
        case 'simpan':
            handleSimpan();
            break;
        case 'edit':
            handleEdit();
            break;
        case 'update':
            handleUpdate();
            break;
        case 'delete':
            handleDelete();
            break;
        case 'print':
            handlePrint();
            break;
    }
} else {
    if ($_SESSION['role'] == 'admin') {
        $dataProdi = Prodi::tampilProdi();
        $dataTempatMagang = TempatMagang::tampilTempatMagang();
        $dataDosen = Dosen::tampilDosen();
        $jumlahDataPerhalaman = 3;
        $jumlahData = count(
            JadwalMagang::tampilJadwalMagang(
                isset($_GET['prodi']) ? $_GET['prodi'] : '',
                isset($_GET['tempatMagang']) ? $_GET['tempatMagang'] : '',
                isset($_GET['dosenPembimbing']) ? $_GET['dosenPembimbing'] : '',
                isset($_GET['dari']) ? $_GET['dari'] : '',
                isset($_GET['sampai']) ? $_GET['sampai'] : ''
            )
        );
        $totalHalaman = ceil($jumlahData / $jumlahDataPerhalaman);
        $halamanAktif = (isset($_GET['halaman'])) ? $_GET['halaman'] : 1;
        $awalData = ($halamanAktif - 1) * $jumlahDataPerhalaman;
        $listJadwalMagang = JadwalMagang::tampilJadwalMagangPerHalaman(
            $awalData,
            $jumlahDataPerhalaman,
            isset($_GET['prodi']) ? $_GET['prodi'] : '',
            isset($_GET['tempatMagang']) ? $_GET['tempatMagang'] : '',
            isset($_GET['dosenPembimbing']) ? $_GET['dosenPembimbing'] : '',
            isset($_GET['dari']) ? $_GET['dari'] : '',
            isset($_GET['sampai']) ? $_GET['sampai'] : ''
        );
    } elseif ($_SESSION['role'] == 'dosen') {
        $listJadwalMagang = JadwalMagang::tampilJadwalMagangByDosen($_SESSION['username']);
    } elseif ($_SESSION['role'] == 'mahasiswa') {
        $listJadwalMagang = JadwalMagang::tampilJadwalMagangByMahasiswa($_SESSION['username']);
    }
    $no = isset($_GET['halaman']) ? (($_GET['halaman'] - 1) * $jumlahDataPerhalaman) + 1 : 1;
    require './views/data_magang/index.view.php';
}
