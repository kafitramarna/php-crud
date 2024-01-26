<?php
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header('location: /');
}
require './models/dosen.model.php';
require './models/prodi.model.php';
require './fpdf/fpdf.php';
function handleTambah () : void{
    $dataDosen = Dosen::tampilDosen();
    $dataProdi = Prodi::tampilProdi();
    require './views/dosen/create.view.php';
}
function handleSimpan() : void{
    if (isset($_POST)) {
        $data = $_POST;
        $tambahData = new Dosen($data['nik'], $data['nama'],$data['gelar_depan'],$data['gelar_belakang'], $data['prodi']);
        $tambahData->tambahDosen();
        header('location: /dosen');
    }
}

function handleEdit() : void{
    $dataDosen = Dosen::tampilDosenById($_GET['id']);
    $dataProdi = Prodi::tampilProdi();
    require './views/dosen/edit.view.php';
}

function handleUpdate() : void{
    if (isset($_POST)) {
        $data = $_POST;
        $updateData = new Dosen($data['nik'], $data['nama'], $data['gelar_depan'], $data['gelar_belakang'], $data['prodi']);
        $updateData->editDosen($_GET['id']);
        header('location: /dosen');
    }
}

function handleDelete() :void{
    Dosen::hapusDosen($_GET['id']);
    header('location: /dosen');
}
function handlePrint(): void{
    $listDosen = Dosen::tampilDosen();
    $pdf = new FPDF();
    $pdf->AddPage('L');
    $pdf->SetFont('Times', '', 20);
    $pdf->Cell(0, 20, 'DATA DOSEN', 0, 0, 'C');
    $pdf->SetFont('Times', '', 12, 'B');
    $pdf->Ln(20);
    $pdf->Cell(10, 10, 'No', 1, 0, 'C');
    $pdf->Cell(60, 10, 'NIK', 1, 0, 'C');
    $pdf->Cell(75, 10, 'Nama Dosen', 1, 0, 'C');
    $pdf->Cell(30, 10, 'Gelar Depan', 1, 0, 'C');
    $pdf->Cell(40, 10, 'Gelar Belakang', 1, 0, 'C');
    $pdf->Cell(0, 10, 'Program Studi', 1, 0, 'C');
    $pdf->SetFont('Times', '', 12);
    for ($i = 0; $i < count($listDosen); $i++) {
        $pdf->Ln(10);
        $pdf->Cell(10, 10, $i + 1, 1, 0, 'C');
        $pdf->Cell(60, 10, $listDosen[$i]['nik'], 1, 0, 'C');
        $pdf->Cell(75, 10, $listDosen[$i]['nama'], 1, 0, 'C');
        $pdf->Cell(30, 10, $listDosen[$i]['gelar_depan'], 1, 0, 'C');
        $pdf->Cell(40, 10, $listDosen[$i]['gelar_belakang'], 1, 0, 'C');
        $pdf->Cell(0, 10, $listDosen[$i]['prodi'], 1, 0, 'C');
    }
    $pdf->Output("data mahasiswa.pdf", "I");
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
    $jumlahData = count(Dosen::tampilDosen(isset($_GET['cari']) ? $_GET['cari'] : ""));
    $totalHalaman = ceil($jumlahData / $jumlahDataPerhalaman);
    $halamanAktif = (isset($_GET['halaman'])) ? $_GET['halaman'] : 1;
    $awalData = ($halamanAktif - 1) * $jumlahDataPerhalaman;
    $listDosen = Dosen::tampilDosenPerPage($awalData, $jumlahDataPerhalaman, isset($_GET['cari']) ? $_GET['cari'] : "");
    $no = isset($_GET['halaman']) ? (($_GET['halaman'] - 1) * $jumlahDataPerhalaman) + 1 : 1;
    require './views/dosen/index.view.php';
}
