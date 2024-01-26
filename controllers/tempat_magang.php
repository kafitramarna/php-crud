<?php
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header('location: /');
}
require './models/tempat_magang.model.php';
require './fpdf/fpdf.php';
function handleTambah ():void{
    $dataTempatMagang = TempatMagang::tampilTempatMagang();
    require './views/tempat_magang/create.view.php';
}
function handleSimpan(): void{
    if (isset($_POST)) {
        $data = $_POST;
        $tambahData = new TempatMagang($data['nama_tempat'], $data['alamat'],$data['kota'],$data['provinsi'], $data['telepon']);
        $tambahData->tambahTempatMagang();
        header('location: /tempat-magang');
    }
}

function handleEdit(): void{
    $dataTempatMagang = TempatMagang::tampilTempatMagangById($_GET['id']);
    require './views/tempat_magang/edit.view.php';
}

function handleUpdate(): void{
    if (isset($_POST)) {
        $data = $_POST;
        $updateData = new TempatMagang($data['nama_tempat'], $data['alamat'],$data['kota'],$data['provinsi'], $data['telepon']);
        $updateData->editTempatMagang($_GET['id']);
        header('location: /tempat-magang');
    }
}

function handleDelete():void{
    TempatMagang::hapusTempatMagang($_GET['id']);
    header('location: /tempat-magang');
}
function handlePrint():void{
    $listTempatMagang = TempatMagang::tampilTempatMagang();
    $pdf = new FPDF();
    $pdf->AddPage('L');
    $pdf->SetFont('Times', '', 20);
    $pdf->Cell(0, 20, 'DATA TEMPAT MAGANG', 0, 0, 'C');
    $pdf->SetFont('Times', '', 12, 'B');
    $pdf->Ln(20);
    $pdf->Cell(10, 10, 'No', 1, 0, 'C');
    $pdf->Cell(60, 10, 'Nama Tempat', 1, 0, 'C');
    $pdf->Cell(85, 10, 'Alamat', 1, 0, 'C');
    $pdf->Cell(40, 10, 'Kota/Kabupaten', 1, 0, 'C');
    $pdf->Cell(40, 10, 'Provinsi', 1, 0, 'C');
    $pdf->Cell(0, 10, 'Telepon', 1, 0, 'C');
    $pdf->SetFont('Times', '', 12);
    for ($i = 0; $i < count($listTempatMagang); $i++) {
        $pdf->Ln(10);
        $pdf->Cell(10, 10, $i + 1, 1, 0, 'L');
        $pdf->Cell(60, 10, $listTempatMagang[$i]['nama_tempat'], 1, 0, 'L');
        $pdf->Cell(85, 10, $listTempatMagang[$i]['alamat'], 1, 0, 'L');
        $pdf->Cell(40, 10, $listTempatMagang[$i]['kota'], 1, 0, 'L');
        $pdf->Cell(40, 10, $listTempatMagang[$i]['provinsi'], 1, 0, 'L');
        $pdf->Cell(0, 10, $listTempatMagang[$i]['telepon'], 1, 0, 'L');
    }
    $pdf->Output("data tempat magang.pdf", "I");
}
if (isset($_GET['act'])&& $_SESSION['role'] == 'admin') {
    $act = $_GET['act'];
    switch ($act) {
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
    $jumlahDataPerhalaman = 3;
    $jumlahData = count(TempatMagang::tampilTempatMagang(isset($_GET['cari']) ? $_GET['cari'] : ""));
    $totalHalaman = ceil($jumlahData / $jumlahDataPerhalaman);
    $halamanAktif = (isset($_GET['halaman'])) ? $_GET['halaman'] : 1;
    $awalData = ($halamanAktif - 1) * $jumlahDataPerhalaman;
    $listTempatMagang = TempatMagang::tampilTempatMagangPerPage($awalData, $jumlahDataPerhalaman, isset($_GET['cari']) ? $_GET['cari'] : "");
    $no = isset($_GET['halaman']) ? (($_GET['halaman'] - 1) * $jumlahDataPerhalaman) + 1 : 1;
    require './views/tempat_magang/index.view.php';
}
