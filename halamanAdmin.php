<?php
require 'functions.php';
session_start();
if (!isset($_SESSION['admin'])) {
    echo "<script>alert('Login dulu!');
        location.href='halamanDefault.php'; </script>";
}

// Mengambil data dari tabel gejala
$gejala = query("SELECT * FROM gejala");

// Mengambil data dari tabel penyakit
$penyakit = query("SELECT * FROM penyakit");

// Mengambil data dari tabel obat
$obat = query("SELECT * FROM obat");

// Mengambil data dari tabel resep
$resep = query("SELECT * FROM resep");

// Mengambil data dari tabel resep
$kucing = query("SELECT * FROM kucing");

// Mengambil data dari tabel penyakit_gejala
$penyakit_gejala = query("SELECT penyakit_gejala.id_penyakit, GROUP_CONCAT(penyakit_gejala.id_gejala) AS id_gejala, penyakit.nama_penyakit, GROUP_CONCAT(gejala.nama_gejala SEPARATOR '<br>') AS nama_gejala
                        FROM penyakit_gejala
                        INNER JOIN penyakit ON penyakit_gejala.id_penyakit = penyakit.id_penyakit
                        INNER JOIN gejala ON penyakit_gejala.id_gejala = gejala.id_gejala
                        GROUP BY penyakit_gejala.id_penyakit");

// Menambahkan gejala ke dalam database
if (isset($_POST["submitGejala"])) {
    if (tambahGejala($_POST) > 0) {
        echo "
                <script>
                    alert('GEJALA BERHASIL DITAMBAHKAN');
                    window.location.href = 'halamanAdmin.php';
                </script>
            ";
    } else {
        echo "
                <script>
                    alert('GEJALA GAGAL DITAMBAHKAN');
                    window.location.href = 'halamanAdmin.php';
                </script>
            ";
    }
}

// Menambahkan penyakit ke dalam database
if (isset($_POST["submitPenyakit"])) {
    if (tambahPenyakit($_POST) > 0) {
        echo "
                <script>
                    alert('PENYAKIT BERHASIL DITAMBAHKAN');
                    window.location.href = 'halamanAdmin.php';
                </script>
            ";
    } else {
        echo "
                <script>
                    alert('PENYAKIT GAGAL DITAMBAHKAN');
                    window.location.href = 'halamanAdmin.php';
                </script>
            ";
    }
}

// Menambahkan obat ke dalam database
if (isset($_POST["submitObat"])) {
    if (tambahObat($_POST) > 0) {
        echo "
                <script>
                    alert('OBAT BERHASIL DITAMBAHKAN');
                    window.location.href = 'halamanAdmin.php';
                </script>
            ";
    } else {
        echo "
                <script>
                    alert('OBAT GAGAL DITAMBAHKAN');
                    window.location.href = 'halamanAdmin.php';e');
                    location.reload(false);
                </script>
            ";
    }
}

// Menambahkan resep ke dalam database
if (isset($_POST["submitResep"])) {
    if (tambahResep($_POST) > 0) {
        echo "
                <script>
                    alert('RESEP BERHASIL DITAMBAHKAN');
                    window.location.href = 'halamanAdmin.php';
                </script>
            ";
    } else {
        echo "
                <script>
                    alert('RESEP GAGAL DITAMBAHKAN');
                    window.location.href = 'halamanAdmin.php';
                </script>
            ";
    }
}

// Menambahkan penyakit-gejala ke dalam database
if (isset($_POST["submitPG"])) {
    if (tambahPenyakitGejala($_POST) > 0) {
        echo "
                <script>
                    alert('PENYAKIT-GEJALA BERHASIL DITAMBAHKAN');
                    window.location.href = 'halamanAdmin.php';
                </script>
            ";
    } else {
        echo "
                <script>
                    alert('PENYAKIT-GEJALA GAGAL DITAMBAHKAN');
                    window.location.href = 'halamanAdmin.php';
                </script>
            ";
    }
}

// Mengubah data tabel gejala
if (isset($_POST["updateGejala"])) {
    if (editGejala($_POST) > 0) {
        echo "
            <script>
                alert('GEJALA BERHASIL DIMODIFIKASI');
                window.location.href = 'halamanAdmin.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('GEJALA GAGAL DIMODIFIKASI');
                window.location.href = 'halamanAdmin.php';
            </script>
        ";
    }
}

// Mengubah data tabel penyakit
if (isset($_POST["updatePenyakit"])) {
    if (editPenyakit($_POST) > 0) {
        echo "
            <script>
                alert('PENYAKIT BERHASIL DIMODIFIKASI');
                window.location.href = 'halamanAdmin.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('PENYAKIT GAGAL DIMODIFIKASI');
                window.location.href = 'halamanAdmin.php';
            </script>
        ";
    }
}

// Mengubah data tabel obat
if (isset($_POST["updateObat"])) {
    if (editObat($_POST) > 0) {
        echo "
            <script>
                alert('OBAT BERHASIL DIMODIFIKASI');
                window.location.href = 'halamanAdmin.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('OBAT GAGAL DIMODIFIKASI');
                window.location.href = 'halamanAdmin.php';
            </script>
        ";
    }
}

// Mengubah data tabel resep
if (isset($_POST["updateResep"])) {
    if (editResep($_POST) > 0) {
        echo "
            <script>
                alert('RESEP BERHASIL DIMODIFIKASI');
                window.location.href = 'halamanAdmin.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('RESEP GAGAL DIMODIFIKASI');
                window.location.href = 'halamanAdmin.php';
            </script>
        ";
    }
}


if (isset($_POST["updatePG"])) {
    if (editPenyakitGejala($_POST) > 0) {
        header("location:halamanAdmin.php");
    }
}


// Menghapus data tabel gejala
if (isset($_POST["hapusGejala"])) {
    if (hapusGejala($_POST) > 0) {
        echo "
            <script>
                alert('GEJALA BERHASIL DIHAPUS');
                window.location.href = 'halamanAdmin.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('GEJALA GAGAL DIHAPUS');
                window.location.href = 'halamanAdmin.php';
            </script>
        ";
    }
}

// Menghapus data tabel penyakit
if (isset($_POST["hapusPenyakit"])) {
    if (hapusPenyakit($_POST) > 0) {
        echo "
            <script>
                alert('PENYAKIT BERHASIL DIHAPUS');
                window.location.href = 'halamanAdmin.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('PENYAKIT GAGAL DIHAPUS');
                window.location.href = 'halamanAdmin.php';
            </script>
        ";
    }
}

// Menghapus data tabel obat
if (isset($_POST["hapusObat"])) {
    if (hapusObat($_POST) > 0) {
        echo "
            <script>
                alert('OBAT BERHASIL DIHAPUS');
                window.location.href = 'halamanAdmin.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('OBAT GAGAL DIHAPUS');
                window.location.href = 'halamanAdmin.php';
            </script>
        ";
    }
}

// Menghapus data tabel resep
if (isset($_POST["hapusResep"])) {
    if (hapusResep($_POST) > 0) {
        echo "
            <script>
                alert('RESEP BERHASIL DIHAPUS');
                window.location.href = 'halamanAdmin.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('RESEP GAGAL DIHAPUS');
                window.location.href = 'halamanAdmin.php';
            </script>
        ";
    }
}

// Menghapus data tabel penyakit-gejala
if (isset($_POST["hapusPG"])) {
    $idPenyakit = $_POST["idPenyakit"];
    if (hapusPenyakitGejala($idPenyakit)) {
        echo "
            <script>
                window.location.href = 'halamanAdmin.php';
            </script>
        ";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pakar Diagnosa Penyakit Kucing</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Kode CSS -->
    <style>
        /* Style untuk body */
        body {
            background-color: #f8f9fa;
        }

        /* Style untuk judul h1 dan h3 */
        h1 {
            text-align: center;
            font-size: 30px;
            font-weight: bold;
        }

        h3 {
            text-align: center;
            font-size: 25px;
            margin-bottom: 20px;
        }

        /* Style untuk navbar */
        .navbar {
            background-color: #007bff;
        }

        .navbar-brand {
            font-weight: bold;
        }

        .navbar-nav .nav-link {
            color: #fff;
        }

        .navbar-nav .nav-link:hover {
            color: #fff;
            background-color: rgba(255, 255, 255, 0.1);
        }

        /* Style untuk tabel */
        .table {
            margin-bottom: 20px;
        }

        /* Style untuk modal */
        .modal-title {
            font-weight: bold;
        }

        /* Style untuk footer */
        footer {
            text-align: center;
            padding: 10px;
            background-color: #f8f9fa;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <!-- Nav Bar -->
    <nav class="navbar navbar-expand-sm bg-primary navbar-dark">
        <a class="navbar-brand" href="#">Sistem Pakar Penyakit Kucing</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link active" id="dashboardNav" href="#">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="gejalaNav" href="#">Gejala</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="penyakitNav" href="#">Penyakit</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pgNav" href="#">Penyakit-Gejala</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="obatNav" href="#">Obat</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="resepNav" href="#">Resep</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="adminDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Admin
                    </a>
                    <div class="dropdown-menu" aria-labelledby="adminDropdown">
                        <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Dashboard -->
    <div id="dashboard-section" class="container mt-4">
        <h1>Selamat Datang di</h1>
        <h1>Sistem Pakar Diagnosa Penyakit Kucing</h1>
        <hr>
        <h3>Daftar Data Kucing dan Pemilik</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th style="width: 20px;">No</th>
                    <th style="width: 150px;">Nama Kucing</th>
                    <th style="width: 150px;">Nama Pemilik</th>
                    <th style="width: 160px;">Jenis Kucing</th>
                    <th style="width: 130px;">Umur Kucing</th>
                    <th style="width: 120px;">Berat Badan</th>
                    <th style="width: 120px;">Gambar Kucing</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($kucing as $kc) : ?>
                    <tr>
                        <td><?= $i; ?></td>
                        <td><?= $kc["nama_kucing"]; ?></td>
                        <td>
                            <?php $idPemilik = $kc["id_pemilik"]; ?>
                            <?php $pemilik = query("SELECT * FROM pemilik_kucing WHERE id_pemilik = $idPemilik"); ?>
                            <?php foreach ($pemilik as $pemlk) : ?>
                                <?= $pemlk["nama_pemilik"]; ?>
                            <?php endforeach; ?>
                        </td>
                        <td><?= $kc["jenis_kucing"]; ?></td>
                        <td><?= $kc["umur_kucing"]; ?> tahun</td>
                        <td><?= $kc["berat_badan"]; ?> kg</td>
                        <td><a href="download.php?url=<?= urlencode($kc['gambar']); ?>">Download</a></td>
                    </tr>
                    <?php $i++ ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Gejala -->
    <div id="gejala-section" class="container mt-4" style="display: none;">
        <h1>Daftar Gejala</h1>
        <div class="d-flex justify-content-end mb-2">
            <button class="btn btn-primary" data-toggle="modal" data-target="#tambahGejala">Tambah Gejala</button>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th style="width: 20px;">No</th>
                    <th style="width: 100px;">Nama Gejala</th>
                    <th style="width: 400px">Deskripsi</th>
                    <th style="width: 80px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <!-- Gejala Ditampilkan -->
                <?php $i = 1; ?>
                <?php foreach ($gejala as $gjl) : ?>
                    <tr>
                        <td><?= $i; ?></td>
                        <td><?= $gjl["nama_gejala"]; ?></td>
                        <td><?= $gjl["deskripsi"] ?></td>
                        <td>
                            <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#editGejala<?= $gjl['id_gejala'] ?>" data-id="<?= $gjl["id_gejala"]; ?>">Edit</button>
                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#hapusGejala<?= $gjl['id_gejala'] ?>" data-id="<?= $gjl["id_gejala"]; ?>">Hapus</button>
                        </td>
                    </tr>

                    <!-- Modal Tambah Gejala -->
                    <div class="modal fade" id="tambahGejala" tabindex="-1" role="dialog" aria-labelledby="GejalaModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="GejalaModalLabel">Tambah Gejala</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Form Gejala -->
                                    <form action="" method="post">
                                        <div class="form-group">
                                            <label for="idGejala">ID Gejala</label>
                                            <input type="text" class="form-control" id="idGejala" name="idGejala" placeholder="Masukkan ID Gejala">
                                        </div>
                                        <div class="form-group">
                                            <label for="namaGejala">Nama Gejala</label>
                                            <input type="text" class="form-control" id="namaGejala" name="namaGejala" placeholder="Masukkan Nama Gejala">
                                        </div>
                                        <div class="form-group">
                                            <label for="deskripsiGejala">Deskripsi</label>
                                            <textarea class="form-control" id="deskripsiGejala" name="deskripsiGejala" rows="3" placeholder="Masukkan Deskripsi Gejala"></textarea>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    <button type="submit" name="submitGejala" class="btn btn-primary">Simpan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Modal Edit Gejala -->
                    <div class="modal fade" id="editGejala<?= $gjl['id_gejala'] ?>" tabindex="-1" role="dialog" aria-labelledby="editGejalaLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editGejalaLabel">Edit Gejala</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Form Gejala -->
                                    <form action="" method="POST">
                                        <?php $id = $gjl['id_gejala'] ?>
                                        <?php $gejala2 = query("SELECT * FROM gejala WHERE id_gejala = '$id'"); ?>
                                        <?php foreach ($gejala2 as $g) : ?>
                                            <input type="hidden" name="idGejala" value="<?= $g["id_gejala"]; ?>">
                                            <div class="form-group">
                                                <label for="namaGejalaEdit">Nama Gejala</label>
                                                <input type="text" class="form-control" id="namaGejalaEdit" name="namaGejala" value="<?= $g["nama_gejala"]; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="deskripsiGejalaEdit">Deskripsi</label>
                                                <textarea class="form-control" name="deskripsiGejala" id="deskripsiGejalaEdit" rows="3"><?= $g["deskripsi"]; ?></textarea>
                                            </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary" name="updateGejala">Update</button>
                                </div>
                            <?php endforeach; ?>
                            </form>
                            </div>
                        </div>
                    </div>


                    <!-- Modal Hapus Gejala -->
                    <div class="modal fade" id="hapusGejala<?= $gjl['id_gejala'] ?>" tabindex="-1" role="dialog" aria-labelledby="hapusGejalaLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="hapusGejalaLabel">Hapus Gejala</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Form Gejala -->
                                    <form action="" method="POST">
                                        <?php $id = $gjl['id_gejala'] ?>
                                        <?php $gejala3 = query("SELECT * FROM gejala WHERE id_gejala = '$id'"); ?>
                                        <?php foreach ($gejala3 as $g2) : ?>
                                            <input type="hidden" name="idGejala" value="<?= $g2["id_gejala"]; ?>">
                                            <div class="form-group">
                                                <label>Apakah anda yakin menghapus gejala tersebut? </label>
                                            </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                    <button type="submit" class="btn btn-primary" name="hapusGejala">Iya</button>
                                </div>
                            <?php endforeach; ?>
                            </form>
                            </div>
                        </div>
                    </div>


                    <?php $i++ ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>


    <!-- Penyakit -->
    <div id="penyakit-section" class="container mt-4" style="display: none;">
        <h1>Daftar Penyakit</h1>
        <div class="d-flex justify-content-end mb-2">
            <button class="btn btn-primary" data-toggle="modal" data-target="#tambahPenyakitModal">Tambah Penyakit</button>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th style="width: 20px;">No</th>
                    <th style="width: 100px;">Nama Penyakit</th>
                    <th style="width: 400px;">Deskripsi</th>
                    <th style="width: 80px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($penyakit as $pyk) : ?>
                    <tr>
                        <td><?= $i; ?></td>
                        <td><?= $pyk["nama_penyakit"]; ?></td>
                        <td><?= $pyk["deskripsi"]; ?></td>
                        <td>
                            <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#editPenyakit<?= $pyk['id_penyakit'] ?>" data-id="<?= $pyk["id_penyakit"]; ?>">Edit</button>
                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#hapusPenyakit<?= $pyk['id_penyakit'] ?>" data-id="<?= $pyk["id_penyakit"]; ?>">Hapus</button>
                        </td>
                    </tr>
                    <!-- Modal Tambah Penyakit -->
                    <div class="modal fade" id="tambahPenyakitModal" tabindex="-1" role="dialog" aria-labelledby="tambahPenyakitModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="tambahPenyakitModalLabel">Tambah Penyakit</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Form Penyakit -->
                                    <form action="" method="POST">
                                        <div class="form-group">
                                            <label for="idPenyakit">ID Penyakit</label>
                                            <input type="text" class="form-control" id="idPenyakit" name="idPenyakit" placeholder="Masukkan ID Penyakit">
                                        </div>
                                        <div class="form-group">
                                            <label for="namaPenyakit">Nama Penyakit</label>
                                            <input type="text" class="form-control" id="namaPenyakit" name="namaPenyakit" placeholder="Masukkan Nama Penyakit">
                                        </div>
                                        <div class="form-group">
                                            <label for="deskripsiPenyakit">Deskripsi</label>
                                            <textarea class="form-control" id="deskripsiPenyakit" name="deskripsiPenyakit" rows="3" placeholder="Masukkan Deskripsi Penyakit"></textarea>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary" name="submitPenyakit">Simpan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Edit Penyakit -->
                    <div class="modal fade" id="editPenyakit<?= $pyk['id_penyakit'] ?>" tabindex="-1" role="dialog" aria-labelledby="editPenyakitModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editPenyakitModalLabel">Edit Penyakit</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Form Penyakit -->
                                    <form action="" method="POST">
                                        <?php $id_penyakit = $pyk['id_penyakit'] ?>
                                        <?php $penyakit2 = query("SELECT * FROM penyakit WHERE id_penyakit = '$id_penyakit'"); ?>
                                        <?php foreach ($penyakit2 as $p) : ?>
                                            <input type="hidden" name="idPenyakit" value="<?= $p["id_penyakit"]; ?>">
                                            <div class="form-group">
                                                <label for="namaPenyakit">Nama Penyakit</label>
                                                <input type="text" class="form-control" id="namaPenyakit" name="namaPenyakit" value="<?= $p["nama_penyakit"]; ?>">
                                            </div>
                                            <div class="form-proup">
                                                <label for="deskripsiPenyakit">Deskripsi</label>
                                                <textarea class="form-control" id="deskripsiPenyakit" name="deskripsiPenyakit" rows="3"><?= $p["deskripsi"]; ?></textarea>
                                            </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary" name="updatePenyakit">Update</button>
                                </div>
                            <?php endforeach; ?>
                            </form>
                            </div>
                        </div>
                    </div>


                    <!-- Modal Hapus Penyakit -->
                    <div class="modal fade" id="hapusPenyakit<?= $pyk['id_penyakit'] ?>" tabindex="-1" role="dialog" aria-labelledby="hapusPenyakitLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="hapusPenyakitLabel">Hapus Penyakit</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Form Penyakit -->
                                    <form action="" method="POST">
                                        <?php $id = $pyk['id_penyakit'] ?>
                                        <?php $penyakit3 = query("SELECT * FROM penyakit WHERE id_penyakit = '$id'"); ?>
                                        <?php foreach ($penyakit3 as $p2) : ?>
                                            <input type="hidden" name="idPenyakit" value="<?= $p2["id_penyakit"]; ?>">
                                            <div class="form-group">
                                                <label>Apakah anda yakin menghapus penyakit tersebut? </label>
                                            </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                    <button type="submit" class="btn btn-primary" name="hapusPenyakit">Iya</button>
                                </div>
                            <?php endforeach; ?>
                            </form>
                            </div>
                        </div>
                    </div>


                    <?php $i++ ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Obat -->
    <div id="obat-section" class="container mt-4" style="display: none;">
        <h1>Daftar Obat</h1>
        <div class="d-flex justify-content-end mb-2">
            <button class="btn btn-primary" data-toggle="modal" data-target="#tambahObatModal">Tambah Obat</button>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th style="width: 20px;">No</th>
                    <th style="width: 100px;">Nama Obat</th>
                    <th style="width: 400px;">Deskripsi</th>
                    <th style="width: 80px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($obat as $obt) : ?>
                    <!-- Obat Ditampilkan -->
                    <tr>
                        <td><?= $i; ?></td>
                        <td><?= $obt["nama_obat"]; ?></td>
                        <td><?= $obt["deskripsi"]; ?></td>
                        <td>
                            <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#editObat<?= $obt['id_obat'] ?>" data-id="<?= $obt["id_obat"]; ?>">Edit</button>
                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#hapusObat<?= $obt['id_obat'] ?>" data-id="<?= $obt["id_obat"]; ?>">Hapus</button>
                        </td>
                    </tr>
                    <!-- Modal Tambah Obat -->
                    <div class="modal fade" id="tambahObatModal" tabindex="-1" role="dialog" aria-labelledby="tambahObatModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="tambahObatModalLabel">Tambah Obat</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Form Obat -->
                                    <form action="" method="POST">
                                        <div class="form-group">
                                            <label for="namaObat">ID Obat</label>
                                            <input type="text" class="form-control" id="idObat" name="idObat" placeholder="Masukkan ID Obat">
                                        </div>
                                        <div class="form-group">
                                            <label for="namaObat">Nama Obat</label>
                                            <input type="text" class="form-control" id="namaObat" name="namaObat" placeholder="Masukkan Nama Obat">
                                        </div>
                                        <div class="form-group">
                                            <label for="deskripsiObat">Deskripsi Obat</label>
                                            <textarea class="form-control" id="deskripsiObat" rows="3" name="deskripsiObat" placeholder="Masukkan Deskripsi Obat"></textarea>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary" name="submitObat">Simpan</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Edit Obat -->
                    <div class="modal fade" id="editObat<?= $obt['id_obat'] ?>" tabindex="-1" role="dialog" aria-labelledby="editObatModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editObatModalLabel">Edit Obat</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Form Obat -->
                                    <form action="" method="POST">
                                        <?php $idObat = $obt['id_obat'] ?>
                                        <?php $obat2 = query("SELECT * FROM obat WHERE id_obat = '$idObat'"); ?>
                                        <?php foreach ($obat2 as $o) : ?>
                                            <input type="hidden" name="idObat" value="<?= $o["id_obat"]; ?>">
                                            <div class="form-group">
                                                <label for="namaObat">Nama Obat</label>
                                                <input type="text" class="form-control" id="namaObat" name="namaObat" value="<?= $o["nama_obat"]; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="deskripsiObat">Deskripsi Obat</label>
                                                <textarea class="form-control" id="deskripsiObat" name="deskripsiObat" rows="3"><?= $o["deskripsi"]; ?></textarea>
                                            </div>
                                        <?php endforeach; ?>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary" name="updateObat">Update</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Hapus Obat -->
                    <div class="modal fade" id="hapusObat<?= $obt['id_obat'] ?>" tabindex="-1" role="dialog" aria-labelledby="hapusObatLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="hapusObatLabel">Hapus Obat</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Form Penyakit -->
                                    <form action="" method="POST">
                                        <?php $id = $obt['id_obat'] ?>
                                        <?php $obat3 = query("SELECT * FROM obat WHERE id_obat = '$id'"); ?>
                                        <?php foreach ($obat3 as $o2) : ?>
                                            <input type="hidden" name="idObat" value="<?= $o2["id_obat"]; ?>">
                                            <div class="form-group">
                                                <label>Apakah anda yakin menghapus obat tersebut? </label>
                                            </div>
                                </div>
                            <?php endforeach; ?>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                <button type="submit" class="btn btn-primary" name="hapusObat">Iya</button>
                            </div>
                            </form>
                            </div>
                        </div>
                    </div>


                    <?php $i++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>


    <!-- Resep -->
    <div id="resep-section" class="container mt-4" style="display: none;">
        <h1>Daftar Resep</h1>
        <div class="d-flex justify-content-end mb-2">
            <button class="btn btn-primary" data-toggle="modal" data-target="#tambahResepModal">Tambah Resep</button>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th style="width: 30px;">No</th>
                    <th style="width: 50px;">Nama Penyakit</th>
                    <th style="width: 50px;">Nama Obat</th>
                    <th style="width: 360px;">Dosis</th>
                    <th style="width: 100px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <!-- Resep Ditampilkan -->
                <?php $i = 1; ?>
                <?php foreach ($resep as $rsp) : ?>
                    <tr>
                        <td><?= $i; ?></td>
                        <td>
                            <?php $idPenyakit = $rsp['id_penyakit']; ?>
                            <?php $penyakit5 = query("SELECT * FROM penyakit WHERE id_penyakit = '$idPenyakit'"); ?>
                            <?php foreach ($penyakit5 as $p4) : ?>
                                <?= $p4["nama_penyakit"]; ?>
                            <?php endforeach; ?>
                        </td>
                        <td>
                            <?php $idObat = $rsp["id_obat"]; ?>
                            <?php $obat5 = query("SELECT * FROM obat WHERE id_obat = '$idObat'"); ?>
                            <?php foreach ($obat5 as $o4) : ?>
                                <?= $o4["nama_obat"]; ?>
                            <?php endforeach; ?>
                        </td>
                        <td><?= $rsp["dosis"]; ?></td>
                        <td>
                            <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#editResep<?= $rsp['id_resep']; ?>" data-id="<?= $rsp["id_resep"]; ?>">Edit</button>
                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#hapusResep<?= $rsp['id_resep'] ?>" data-id="<?= $rsp["id_resep"]; ?>">Hapus</button>
                        </td>
                    </tr>

                    <!-- Modal Tambah Resep -->
                    <div class="modal fade" id="tambahResepModal" tabindex="-1" role="dialog" aria-labelledby="tambahResepModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="tambahResepModalLabel">Tambah Resep</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Form Resep -->
                                    <form action="" method="POST">
                                        <div class="form-group">
                                            <label for="idResep">ID Resep</label>
                                            <input type="text" class="form-control" id="idResep" name="idResep" placeholder="Masukkan ID Resep">
                                        </div>
                                        <div class="form-group">
                                            <label for="idPenyakit">ID Penyakit</label>
                                            <select class="form-control" id="idPenyakit" name="idPenyakit">
                                                <?php
                                                // Mengambil data dari tabel 'penyakit' dengan kolom 'id_penyakit' dan 'nama_penyakit'
                                                $penyakit4 = query("SELECT id_penyakit, nama_penyakit FROM penyakit");
                                                foreach ($penyakit4 as $p3) {
                                                    $idPenyakit = $p3['id_penyakit'];
                                                    $namaPenyakit = $p3['nama_penyakit'];
                                                    echo "<option value=\"$idPenyakit\">$namaPenyakit</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="idObat">ID Obat</label>
                                            <select class="form-control" id="idObat" name="idObat">
                                                <?php
                                                // Mengambil data dari tabel 'obat' dengan kolom 'id_obat' dan 'nama_obat'
                                                $obat4 = query("SELECT id_obat, nama_obat FROM obat");
                                                foreach ($obat4 as $o3) {
                                                    $idObat = $o3['id_obat'];
                                                    $namaObat = $o3['nama_obat'];
                                                    echo "<option value=\"$idObat\">$namaObat</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="dosis">Dosis</label>
                                            <input class="form-control" id="dosis" name="dosis" rows="3" placeholder="Dosis"></input>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary" name="submitResep">Simpan</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>


                    <!-- Modal Edit Resep -->
                    <div class="modal fade" id="editResep<?= $rsp['id_resep']; ?>" tabindex="-1" role="dialog" aria-labelledby="editResepModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editResepModalLabel">Edit Resep</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Form Resep -->
                                    <form action="" method="POST">
                                        <?php $idResep = $rsp['id_resep'] ?>
                                        <?php $resep2 = query("SELECT * FROM resep WHERE id_resep = '$idResep'"); ?>
                                        <?php foreach ($resep2 as $r) : ?>
                                            <input type="hidden" name="idResep" value="<?= $r["id_resep"]; ?>">
                                            <div class="form-group">
                                                <label for="namaPenyakit">Nama Penyakit</label>
                                                <select class="form-control" id="idPenyakit" name="idPenyakit">
                                                    <?php
                                                    // Mengambil data dari tabel 'penyakit' dengan kolom 'id_penyakit' dan 'nama_penyakit'
                                                    $penyakit7 = query("SELECT id_penyakit, nama_penyakit FROM penyakit");
                                                    foreach ($penyakit7 as $p5) {
                                                        $idPenyakit = $p5['id_penyakit'];
                                                        $namaPenyakit = $p5['nama_penyakit'];
                                                        $selected = ($idPenyakit == $r['id_penyakit']) ? "selected" : "";
                                                        echo "<option value=\"$idPenyakit\" $selected>$namaPenyakit</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="namaObat">Nama Obat</label>
                                                <select class="form-control" id="idObat" name="idObat">
                                                    <?php
                                                    // Mengambil data dari tabel 'obat' dengan kolom 'id_obat' dan 'nama_obat'
                                                    $obat6 = query("SELECT id_obat, nama_obat FROM obat");
                                                    foreach ($obat6 as $o5) {
                                                        $idObat = $o5['id_obat'];
                                                        $namaObat = $o5['nama_obat'];
                                                        $selected = ($idObat == $r['id_obat']) ? "selected" : "";
                                                        echo "<option value=\"$idObat\" $selected>$namaObat</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="dosis">Dosis</label>
                                                <input class="form-control" id="dosis" name="dosis" rows="3" placeholder="Dosis" value="<?= $r["dosis"]; ?>"></input>
                                            </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary" name="updateResep">Update</button>
                                </div>
                            <?php endforeach; ?>
                            </form>
                            </div>
                        </div>
                    </div>


                    <!-- Modal Hapus Resep -->
                    <div class="modal fade" id="hapusResep<?= $rsp['id_resep'] ?>" tabindex="-1" role="dialog" aria-labelledby="hapusResepLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="hapusResepLabel">Hapus Resep</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Form Penyakit -->
                                    <form action="" method="POST">
                                        <?php $id = $rsp['id_resep'] ?>
                                        <?php $resep3 = query("SELECT * FROM resep WHERE id_resep = '$id'"); ?>
                                        <?php foreach ($resep3 as $r2) : ?>
                                            <input type="hidden" name="idResep" value="<?= $r2["id_resep"]; ?>">
                                            <div class="form-group">
                                                <label>Apakah anda yakin menghapus resep tersebut? </label>
                                            </div>
                                </div>
                            <?php endforeach; ?>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                <button type="submit" class="btn btn-primary" name="hapusResep">Iya</button>
                            </div>
                            </form>
                            </div>
                        </div>
                    </div>


                    <?php $i++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>


    <!-- Penyakit-Gejala -->
    <div id="pg-section" class="container mt-4" style="display: none;">
        <h1>Daftar Penyakit-Gejala</h1>
        <div class="d-flex justify-content-end mb-2">
            <button class="btn btn-primary" data-toggle="modal" data-target="#tambahPGModal" href="#">Tambah Penyakit-Gejala</button>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Penyakit</th>
                    <th>Nama Gejala</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($penyakit_gejala as $pg) : ?>
                    <!-- Penyakit-Gejala Ditampilkan -->
                    <tr>
                        <td><?= $i; ?></td>
                        <td><?= $pg["nama_penyakit"]; ?></td>
                        <td><?= $pg["nama_gejala"]; ?></td>
                        <td>
                            <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#editPGModal<?= $pg['id_penyakit']; ?>" data-id="<?= $pg["id_penyakit"]; ?>">Edit</button>
                            <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#hapusPGModal<?= $pg['id_penyakit']; ?>" data-id="<?= $pg["id_penyakit"]; ?>">Hapus</button>
                        </td>
                    </tr>


                    <!-- Modal Tambah Penyakit-Gejala -->
                    <div class="modal fade" id="tambahPGModal" tabindex="-1" role="dialog" aria-labelledby="tambahPGModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="tambahPGModalLabel">Tambah Penyakit-Gejala</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Form Penyakit Gejala -->
                                    <form action="" method="POST">
                                        <div class="form-group">
                                            <label for="idPenyakit">ID Penyakit</label><br>
                                            <?php
                                            // Mengambil data dari tabel 'penyakit' dengan kolom 'id_penyakit' dan 'nama_penyakit'
                                            $penyakit8 = query("SELECT id_penyakit, nama_penyakit FROM penyakit");
                                            foreach ($penyakit8 as $p6) {
                                                $idPenyakit = $p6['id_penyakit'];
                                                $namaPenyakit = $p6['nama_penyakit'];
                                                echo '<input type="radio" name="idPenyakit" value="' . $idPenyakit . '"> ' . $namaPenyakit . '<br>';
                                            }
                                            ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="idGejala">ID Gejala</label><br>
                                            <?php
                                            // Mengambil data dari tabel 'gejala' dengan kolom 'id_gejala' dan 'nama_gejala'
                                            $gejala4 = query("SELECT id_gejala, nama_gejala FROM gejala");
                                            foreach ($gejala4 as $g3) {
                                                $idGejala = $g3['id_gejala'];
                                                $namaGejala = $g3['nama_gejala'];
                                                echo '<input type="checkbox" name="idGejala[]" value="' . $idGejala . '"> ' . $namaGejala . '<br>';
                                            }
                                            ?>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary" name="submitPG">Simpan</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>


                    <!-- Modal Edit Penyakit-Gejala -->
                    <div class="modal fade" id="editPGModal<?= $pg['id_penyakit']; ?>" tabindex="-1" role="dialog" aria-labelledby="editPGModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editPGModalLabel">Edit Penyakit-Gejala</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Form Penyakit Gejala -->
                                    <form action="" method="POST">
                                        <?php $idPenyakit = $pg['id_penyakit']; ?>
                                        <input type="hidden" name="idPenyakit2" value="<?= $pg["id_penyakit"]; ?>">
                                        <div class="form-group">
                                            <label for="namaPenyakit">Nama Penyakit</label><br>
                                            <?php
                                            // Mengambil data dari tabel 'penyakit' dengan kolom 'id_penyakit' dan 'nama_penyakit'
                                            $penyakit8 = query("SELECT id_penyakit, nama_penyakit FROM penyakit");
                                            foreach ($penyakit8 as $p6) {
                                                $idPenyakit = $p6['id_penyakit'];
                                                $namaPenyakit = $p6['nama_penyakit'];
                                                $checked = ($idPenyakit == $pg['id_penyakit']) ? "checked" : "";
                                                echo '<input type="radio" name="idPenyakit" id="penyakit' . $idPenyakit . '" value="' . $idPenyakit . '" ' . $checked . '> <label for="penyakit' . $idPenyakit . '">' . $namaPenyakit . '</label><br>';
                                            }
                                            ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="namaGejala">Nama Gejala</label><br>
                                            <?php
                                            $gejala4 = query("SELECT id_gejala, nama_gejala FROM gejala");
                                            $selectedGejala = explode(",", $pg['id_gejala']);
                                            foreach ($gejala4 as $g3) {
                                                $idGejala = $g3['id_gejala'];
                                                $namaGejala = $g3['nama_gejala'];
                                                $checked = in_array($idGejala, $selectedGejala) ? "checked" : "";
                                                echo '<input type="checkbox" name="idGejala[]" id="gejala' . $idGejala . '" value="' . $idGejala . '" ' . $checked . '> <label for="gejala' . $idGejala . '">' . $namaGejala . '</label><br>';
                                            }
                                            ?>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary" name="updatePG">Update</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>


                    <!-- Modal Hapus Penyakit-Gejala -->
                    <div class="modal fade" id="hapusPGModal<?= $pg['id_penyakit']; ?>" tabindex="-1" role="dialog" aria-labelledby="hapusPGModal" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="hapusPGModal">Hapus Penyakit Gejala</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Form Penyakit -->
                                    <form action="" method="POST">
                                        <?php $idPenyakit = $pg['id_penyakit']; ?>
                                        <input type="hidden" name="idPenyakit" value="<?= $idPenyakit; ?>">
                                        <div class="form-group">
                                            <label>Apakah Anda yakin menghapus penyakit-gejala ini?</label>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                    <button type="submit" class="btn btn-primary" name="hapusPG">Iya</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>



                    <?php $i++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>





    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>


    <!-- Kode JS -->
    <script>
        // Deklarasi & Inisialisasi Variabel Untuk Mendapatkan Elemen yang Tersedia
        var dashboardNav = document.getElementById("dashboardNav");
        var gejalaNav = document.getElementById("gejalaNav");
        var penyakitNav = document.getElementById("penyakitNav");
        var obatNav = document.getElementById("obatNav");
        var resepNav = document.getElementById("resepNav");
        var pgNav = document.getElementById("pgNav");
        var dashboardSection = document.getElementById("dashboard-section");
        var gejalaSection = document.getElementById("gejala-section");
        var penyakitSection = document.getElementById("penyakit-section");
        var obatSection = document.getElementById("obat-section");
        var resepSection = document.getElementById("resep-section");
        var pgSection = document.getElementById("pg-section");


        // Menambahkan event pada button dashboardNav
        dashboardNav.addEventListener("click", function(e) {
            e.preventDefault();
            dashboardSection.style.display = "block";
            gejalaSection.style.display = "none";
            penyakitSection.style.display = "none";
            obatSection.style.display = "none";
            resepSection.style.display = "none";
            pgSection.style.display = "none";
            dashboardNav.classList.add("active");
            gejalaNav.classList.remove("active");
            penyakitNav.classList.remove("active");
            resepNav.classList.remove("active");
            obatNav.classList.remove("active");
            pgNav.classList.remove("active");
        });

        // Menambahkan event pada button gejalaNav
        gejalaNav.addEventListener("click", function(e) {
            e.preventDefault();
            dashboardSection.style.display = "none";
            penyakitSection.style.display = "none";
            obatSection.style.display = "none";
            resepSection.style.display = "none";
            pgSection.style.display = "none";
            gejalaSection.style.display = "block";
            gejalaNav.classList.add("active");
            dashboardNav.classList.remove("active");
            penyakitNav.classList.remove("active");
            resepNav.classList.remove("active");
            obatNav.classList.remove("active");
            pgNav.classList.remove("active");
        });

        // Menambahkan event pada button penyakitNav
        penyakitNav.addEventListener("click", function(e) {
            e.preventDefault();
            dashboardSection.style.display = "none";
            gejalaSection.style.display = "none";
            obatSection.style.display = "none";
            resepSection.style.display = "none";
            pgSection.style.display = "none";
            penyakitSection.style.display = "block";
            penyakitNav.classList.add("active");
            dashboardNav.classList.remove("active");
            gejalaNav.classList.remove("active");
            resepNav.classList.remove("active");
            obatNav.classList.remove("active");
            pgNav.classList.remove("active");
        });

        // Menambahkan event pada button obatNav
        obatNav.addEventListener("click", function(e) {
            e.preventDefault();
            dashboardSection.style.display = "none";
            gejalaSection.style.display = "none";
            penyakitSection.style.display = "none";
            resepSection.style.display = "none";
            pgSection.style.display = "none";
            obatSection.style.display = "block";
            obatNav.classList.add("active");
            penyakitNav.classList.remove("active");
            dashboardNav.classList.remove("active");
            gejalaNav.classList.remove("active");
            pgNav.classList.remove("active");
            resepNav.classList.remove("active");
        });

        // Menambahkan event pada button resepNav
        resepNav.addEventListener("click", function(e) {
            e.preventDefault();
            dashboardSection.style.display = "none";
            gejalaSection.style.display = "none";
            penyakitSection.style.display = "none";
            pgSection.style.display = "none";
            obatSection.style.display = "none";
            resepSection.style.display = "block";
            resepNav.classList.add("active");
            penyakitNav.classList.remove("active");
            obatNav.classList.remove("active");
            dashboardNav.classList.remove("active");
            gejalaNav.classList.remove("active");
            pgNav.classList.remove("active");
        });

        // Menambahkan event pada button pgNav
        pgNav.addEventListener("click", function(e) {
            e.preventDefault();
            dashboardSection.style.display = "none";
            gejalaSection.style.display = "none";
            penyakitSection.style.display = "none";
            resepSection.style.display = "none";
            obatSection.style.display = "none";
            pgSection.style.display = "block";
            pgNav.classList.add("active");
            resepNav.classList.remove("active");
            penyakitNav.classList.remove("active");
            obatNav.classList.remove("active");
            dashboardNav.classList.remove("active");
            gejalaNav.classList.remove("active");
        });
    </script>

</body>

</html>