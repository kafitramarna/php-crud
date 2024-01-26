<?php
if(!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header('location: /');
}
require './models/mahasiswa.model.php';
require './models/prodi.model.php';
require './fpdf/fpdf.php';
function handleTambah() :void {
    $dataProdi = Prodi::tampilProdi();
    require './views/mahasiswa/create.view.php';
}

function handleSimpan():void {
    if (isset($_POST)) {
        $data = $_POST;
        $tambahData = new Mahasiswa($data['nim'], $data['nama'], $data['prodi'], $data['semester']);
        $tambahData->tambahMahasiswa();
        header('location: /mahasiswa');
    }
}
function handleEdit():void {
    $dataProdi = Prodi::tampilProdi();
    $dataMahasiswa = Mahasiswa::tampilMahasiswaById($_GET['id']);
    require './views/mahasiswa/edit.view.php';
}
function handleUpdate(): void {
    if (isset($_POST)) {
        $data = $_POST;
        $updateData = new Mahasiswa($data['nim'], $data['nama'], $data['prodi'], $data['semester']);
        $updateData->editMahasiswa($_GET['id']);
        header('location: /mahasiswa');
    }
}

function handleDelete(): void {
    Mahasiswa::hapusMahasiswa($_GET['id']);
    header('location: /mahasiswa');
}
function handlePrint(): void{
    $listMahasiswa = Mahasiswa::tampilMahasiswa();
    $pdf = new FPDF();
    $pdf->AddPage('L');
    $pdf->SetFont('Times', '', 20);
    $pdf->Cell(0, 20, 'DATA MAHASISWA', 0, 0, 'C');
    $pdf->SetFont('Times', '', 12, 'B');
    $pdf->Ln(20);
    $pdf->Cell(10, 10, 'No', 1, 0, 'C');
    $pdf->Cell(60, 10, 'NIM', 1, 0, 'C');
    $pdf->Cell(75, 10, 'Nama Mahasiswa', 1, 0, 'C');
    $pdf->Cell(75, 10, 'Program Studi', 1, 0, 'C');
    $pdf->Cell(0, 10, 'Semester', 1, 0, 'C');
    $pdf->SetFont('Times', '', 12);
    for ($i = 0; $i < count($listMahasiswa); $i++) {
        $pdf->Ln(10);
        $pdf->Cell(10, 10, $i + 1, 1, 0, 'C');
        $pdf->Cell(60, 10, $listMahasiswa[$i]['nim'], 1, 0, 'C');
        $pdf->Cell(75, 10, $listMahasiswa[$i]['nama'], 1, 0, 'C');
        $pdf->Cell(75, 10, $listMahasiswa[$i]['prodi'], 1, 0, 'C');
        $pdf->Cell(0, 10, $listMahasiswa[$i]['semester'], 1, 0, 'C');
    }
    $pdf->Output("data mahasiswa.pdf", "I");
}

// Main Logic
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
}
else{
    $jumlahDataPerhalaman = 3;
    $jumlahData = count(Mahasiswa::tampilMahasiswa(isset($_GET['cari']) ? $_GET['cari'] : ""));
    $totalHalaman = ceil($jumlahData / $jumlahDataPerhalaman);
    $halamanAktif = (isset($_GET['halaman'])) ? $_GET['halaman'] : 1;
    $awalData = ($halamanAktif - 1) * $jumlahDataPerhalaman;
    $listMahasiswa = Mahasiswa::tampilMahasiswaPerPage($awalData, $jumlahDataPerhalaman, isset($_GET['cari']) ? $_GET['cari'] : "");
    $no = isset($_GET['halaman']) ? (($_GET['halaman'] - 1) * $jumlahDataPerhalaman) + 1 : 1;
    require './views/mahasiswa/index.view.php';
}