<?php
    session_start();
    $uri = parse_url($_SERVER['REQUEST_URI'])['path'];
    $routes =[
        '/' => 'controllers/index.php',
        '/mahasiswa' => 'controllers/mahasiswa.php',
        '/dosen' => 'controllers/dosen.php',
        '/tempat-magang' => 'controllers/tempat_magang.php',
        '/login' => 'controllers/login.php',
        '/logout' => 'controllers/logout.php'
    ];
    if (array_key_exists($uri, $routes)) {
        require $routes[$uri];
    }
?>