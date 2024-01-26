<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <header class="d-flex justify-content-start py-3 px-3">
        <ul class="nav nav-pills gap-4">
            <li><a href="/logout" class="btn btn-danger" onclick="return confirm('yakin ingin logout?');">logout</a></li>
            <?php if($_SESSION['role'] == 'admin'): ?>
                <li><a href="/" class="nav-item <?= $uri == '/' ? 'nav-link active' : 'nav-link '?>">data magang</a></li>
                <li><a href="/mahasiswa" class="nav-item <?= $uri == '/mahasiswa' ? 'nav-link active' : 'nav-link '?>">data mahasiswa</a></li>
                <li><a href="/dosen" class="nav-item <?= $uri == '/dosen' ? 'nav-link active' : 'nav-link '?>">data dosen</a></li>
                <li><a href="/tempat-magang" class="nav-item <?= $uri == '/tempat-magang' ? 'nav-link active' : 'nav-link '?>">data tempat magang</a></li>
            </ul>
        </header>
    <?php endif ?>