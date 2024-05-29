<?php
if (isset($_GET['url'])) {
    $url = $_GET['url'];

    // Mendapatkan ekstensi file dari URL gambar
    $file_extension = pathinfo($url, PATHINFO_EXTENSION);

    // Mendefinisikan header berdasarkan tipe file
    header("Content-Type: img/" . $file_extension);
    header("Content-Disposition: attachment; filename=" . basename($url));

    // Mengunduh file gambar menggunakan file_get_contents dan echo
    echo file_get_contents($url);
    exit;
} else {
    echo "URL tidak ditemukan.";
}
