<?php
error_reporting(0);
require 'functions.php';
session_start();
if (!isset($_SESSION['user'])) {
    echo "<script>alert('Login dulu!');
        location.href='halamanDefault.php'; </script>";
}

$id_login = $_SESSION['id_login'];

$pemilik = query("SELECT * FROM pemilik_kucing WHERE id_login = '$id_login'");

$kucing = query("SELECT * FROM kucing WHERE id_pemilik IN (SELECT id_pemilik FROM pemilik_kucing WHERE id_login = '$id_login')");

$diagnosa = query("SELECT * FROM diagnosa WHERE id_kucing IN (SELECT id_kucing FROM kucing WHERE id_pemilik IN ( SELECT id_pemilik FROM pemilik_kucing WHERE id_login = '$id_login'))");

$gejala = query("SELECT * FROM gejala");
// Menambahkan kucing ke dalam database
if (isset($_POST["submitKucing"])) {
    if (tambahKucing($_POST) > 0) {
        echo "
                    <script>
                        alert('KUCING BERHASIL DITAMBAHKAN');
                        window.location.href = 'halamanUser.php';
                    </script>
                ";
    } else {
        echo "
                    <script>
                        alert('KUCING GAGAL DITAMBAHKAN');
                        window.location.href = 'halamanUser.php';
                    </script>
                ";
    }
}

// Mengambil data dari tabel gejala
$gejala2 = query("SELECT * FROM gejala");

// Mengambil data dari tabel penyakit
$penyakit = query("SELECT * FROM penyakit");

// Mengubah data kucing ke dalam database
if (isset($_POST["updateKucing"])) {
    if (editKucing($_POST) > 0) {
        echo "
                    <script>
                        alert('KUCING BERHASIL DIMODIFIKASI');
                        window.location.href = 'halamanUser.php';
                    </script>
                ";
    } else {
        echo "
                    <script>
                        alert('KUCING GAGAL DIMODIFIKASI');
                        window.location.href = 'halamanUser.php';
                    </script>
                ";
    }
}


// Mengubah data pemilik ke dalam database
if (isset($_POST["updatePemilik"])) {
    if (editPemilik($_POST) > 0) {
        echo "
                    <script>
                        alert('DATA PEMILK BERHASIL DIMODIFIKASI');
                        window.location.href = 'halamanUser.php';
                    </script>
                ";
    } else {
        echo "
                    <script>
                        alert('DATA PEMILK GAGAL DIMODIFIKASI');
                        window.location.href = 'halamanUser.php';
                    </script>
                ";
    }
}


// Menghapus data tabel kucing
if (isset($_POST["hapusKucing"])) {
    if (hapusKucing($_POST) > 0) {
        echo "
                <script>
                    alert('KUCING BERHASIL DIHAPUS');
                    window.location.href = 'halamanUser.php';
                </script>
            ";
    } else {
        echo "
                <script>
                    alert('KUCING GAGAL DIHAPUS');
                    window.location.href = 'halamanUser.php';
                </script>
            ";
    }
}

?>
<!DOCTYPE html>
<html>

<head>
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
            background-color: rgb(255, 255, 255, 0.1);
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
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-sm bg-primary navbar-dark">
        <a class="navbar-brand" href="#">Sistem Pakar Penyakit Kucing</a>
        <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button> -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link active" id="homeNav" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="kucingNav" href="#">Kucing</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="diagnosaNav" href="#">Diagnosa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="hasilDiagnosaNav" href="#">Hasil Diagnosa</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?= $_SESSION['user']['nama_pemilik'] ?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Home -->
    <div id="home-section" class="container mt-4">
        <h1>Selamat Datang di</h1>
        <h1>Sistem Pakar Diagnosa Penyakit Kucing</h1>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <button class="btn btn-primary" data-toggle="modal" data-target="#dataGejala">Data Gejala</button>
                <button class="btn btn-primary" data-toggle="modal" data-target="#dataPenyakit">Data Penyakit</button>
            </div>
            <div class="col-md-6 text-right">
                <button class="btn btn-primary" data-toggle="modal" data-target="#editPemilik">Edit Data Pemilik</button>
            </div>
        </div>

        <div class="row justify-content-center">
            <?php foreach ($pemilik as $pmk) : ?>
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Pemilik Kucing</h5>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td style="width: 150px;">Nama Pemilik</td>
                                        <td><?= $pmk["nama_pemilik"]; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td><?= $pmk["alamat"] ?></td>
                                    </tr>
                                    <tr>
                                        <td>No Telepon</td>
                                        <td><?= $pmk["no_telp"] ?></td>
                                    </tr>

                                    <!-- Modal Edit Pemilik -->
                                    <div class="modal fade" id="editPemilik" tabindex="-1" role="dialog" aria-labelledby="editPemilikModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editPemilikModalLabel">Edit Pemilik</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Form Kucing -->
                                                    <form action="" method="POST">
                                                        <?php $idPemilik = $pmk['id_pemilik']; ?>
                                                        <?php $pemilik2 = query("SELECT * FROM pemilik_kucing WHERE id_pemilik = '$idPemilik'"); ?>
                                                        <?php foreach ($pemilik2 as $pmk2) : ?>
                                                            <input type="hidden" name="idPemilik" value="<?= $pmk2["id_pemilik"]; ?>">
                                                            <div class="form-group">
                                                                <label for="namaPemilik">Nama Kucing</label>
                                                                <input type="text" class="form-control" id="namaPemilik" name="namaPemilik" value="<?= $pmk2["nama_pemilik"]; ?>" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="alamat">Alamat</label>
                                                                <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $pmk2["alamat"]; ?>" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="noTlp">No.Telpon</label>
                                                                <input type="number" class="form-control" id="noTlp" name="noTlp" value="<?= $pmk2["no_telp"]; ?>" required>
                                                            </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                    <button type="submit" class="btn btn-primary" name="updatePemilik">Update</button>
                                                </div>
                                            <?php endforeach; ?>
                                            </form>
                                            </div>
                                        </div>
                                    </div>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>


    <!-- Modal Data Penyakit -->
    <div class="modal fade" id="dataPenyakit" tabindex="-1" role="dialog" aria-labelledby="dataPenyakitLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dataPenyakitLabel">Data Penyakit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form Kucing -->
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th style="width: 20px;">No</th>
                                <th style="width: 100px;">Nama Penyakit</th>
                                <th style="width: 400px;">Deskripsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($penyakit as $pyk) : ?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?= $pyk["nama_penyakit"]; ?></td>
                                    <td><?= $pyk["deskripsi"]; ?></td>
                                </tr>
                                <?php $i++ ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Data Gejala -->
    <div class="modal fade" id="dataGejala" tabindex="-1" role="dialog" aria-labelledby="dataGejalaLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dataGejalaLabel">Data Gejala</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form Kucing -->
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th style="width: 20px;">No</th>
                                <th style="width: 100px;">Nama Gejala</th>
                                <th style="width: 400px;">Deskripsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($gejala2 as $gjl3) : ?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?= $gjl3["nama_gejala"]; ?></td>
                                    <td><?= $gjl3["deskripsi"]; ?></td>
                                </tr>
                                <?php $i++ ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- Kucing -->
    <div id="kucing-section" class="container mt-4" style="display: none;">
        <h1>Daftar Kucing</h1>
        <div class="d-flex justify-content-end mb-2">
            <button class="btn btn-primary" data-toggle="modal" data-target="#tambahKucingModal">Tambah Kucing</button>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th style="width: 20px;">No</th>
                    <th style="width: 160px;">Foto</th>
                    <th style="width: 150px;">Nama Kucing</th>
                    <th style="width: 160px;">Jenis Kucing</th>
                    <th style="width: 130px;">Umur Kucing</th>
                    <th style="width: 120px;">Berat Badan</th>
                    <th style="width: 140px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($kucing as $kc) : ?>
                    <tr>
                        <td><?= $i; ?></td>
                        <td><img src="img/<?php echo $kc["gambar"]; ?>" width="150" height="100"></td>
                        <td><?= $kc["nama_kucing"]; ?></td>
                        <td><?= $kc["jenis_kucing"]; ?></td>
                        <td><?= $kc["umur_kucing"]; ?> tahun</td>
                        <td><?= $kc["berat_badan"]; ?> kg</td>
                        <td> <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#editKucing<?= $kc['id_kucing'] ?>" data-id="<?= $kc["id_kucing"]; ?>">Edit</button>
                            <button type=" button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#hapusKucing<?= $kc['id_kucing'] ?>" data-id="<?= $kc["id_kucing"]; ?>">Hapus</button>
                        </td>
                    </tr>


                    <!-- Modal Edit Kucing -->
                    <div class="modal fade" id="editKucing<?= $kc['id_kucing'] ?>" tabindex="-1" role="dialog" aria-labelledby="editKucingModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editKucingModalLabel">Edit Kucing</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Form Kucing -->
                                    <form action="" method="POST" enctype="multipart/form-data">
                                        <?php $id_kucing = $kc['id_kucing']; ?>
                                        <?php $kucing2 = query("SELECT * FROM kucing WHERE id_kucing = '$id_kucing'"); ?>
                                        <?php foreach ($kucing2 as $kc2) : ?>
                                            <input type="hidden" name="idKucing" value="<?= $kc2["id_kucing"]; ?>">
                                            <input type="hidden" name="gambarLama" value="<?= $kc2["gambar"]; ?>">
                                            <div class="form-group">
                                                <label for="namaKucing">Nama Kucing</label>
                                                <input type="text" class="form-control" id="namaKucing" name="namaKucing" value="<?= $kc2["nama_kucing"]; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="jenisKucing">Jenis Kucing</label>
                                                <input type="text" class="form-control" id="jenisKucing" name="jenisKucing" value="<?= $kc2["jenis_kucing"]; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="umurKucing">Umur Kucing</label>
                                                <input type="number" class="form-control" id="umurKucing" name="umurKucing" value="<?= $kc2["umur_kucing"]; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="beratBadan">Berat Badan</label>
                                                <input type="number" class="form-control" id="beratBadan" name="beratBadan" value="<?= $kc2["berat_badan"]; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="fotoKucing">Gambar Kucing</label><br>
                                                <img src="img/<?= $kc2['gambar']; ?>" width="50">
                                                <input type="file" id="fotoKucing" name="gambar">
                                            </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary" name="updateKucing">Update</button>
                                </div>
                            <?php endforeach; ?>
                            </form>
                            </div>
                        </div>
                    </div>


                    <!-- Modal Hapus Kucing -->
                    <div class="modal fade" id="hapusKucing<?= $kc['id_kucing'] ?>" tabindex="-1" role="dialog" aria-labelledby="hapusKucingLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="hapusKucingLabel">Hapus Kucing</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Form Penyakit -->
                                    <form action="" method="POST">
                                        <?php $id_kucing = $kc['id_kucing']; ?>
                                        <?php $kucing3 = query("SELECT * FROM kucing WHERE id_kucing = '$id_kucing'"); ?>
                                        <?php foreach ($kucing3 as $kc3) : ?>
                                            <input type="hidden" name="idPenyakit" value="<?= $kc3["id_penyakit"]; ?>">
                                            <div class="form-group">
                                                <label>Apakah anda yakin menghapus kucing tersebut? </label>
                                            </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                    <button type="submit" class="btn btn-primary" name="hapusKucing">Iya</button>
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


    <!-- Modal Tambah Kucing -->
    <div class="modal fade" id="tambahKucingModal" tabindex="-1" role="dialog" aria-labelledby="tambahKucingModalModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahKucingModalLabel">Tambah Kucing</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form Kucing -->
                    <form action="" method="post" enctype="multipart/form-data">
                        <?php foreach ($pemilik as $pmk2) : ?>
                            <input type="hidden" name="idPemilik" value="<?= $pmk2["id_pemilik"]; ?>" required>
                        <?php endforeach; ?>
                        <div class="form-group">
                            <label for="namaKucing">Nama Kucing</label>
                            <input type="text" class="form-control" id="namaKucing" name="namaKucing" placeholder="Masukkan Nama Kucing" required>
                        </div>
                        <div class="form-group">
                            <label for="jenisKucing">Jenis Kucing</label>
                            <input type="text" class="form-control" id="jenisKucing" name="jenisKucing" placeholder="Masukkan Jenis Kucing" required>
                        </div>
                        <div class="form-group">
                            <label for="umurKucing">Umur Kucing</label>
                            <input type="number" class="form-control" id="umurKucing" name="umurKucing" placeholder="Masukkan Umur Kucing" pattern="[0-9]+(\.[0-9]+)?" required>
                        </div>
                        <div class="form-group">
                            <label for="beratBadan">Berat Badan</label>
                            <!-- <input type="number" class="form-control" id="beratBadan" name="beratBadan" placeholder="Masukkan Berat Badan" required> -->
                            <input type="text" class="form-control" id="beratBadan" name="beratBadan" placeholder="Masukkan Berat Badan" pattern="[0-9]+(\.[0-9]+)?" required>
                        </div>
                        <div class="form-group">
                            <label for="fotoKucing">File Foto</label>
                            <input type="file" class="form-control-file" id="fotoKucing" name="gambar">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" name="submitKucing">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Diagnosa -->
    <div id="diagnosa-section" class="container mt-4" style="display: none;">
        <h1>Diagnosa</h1><br>
        <form action="question.php" method="GET">
            <div class="form-group">
                <div class="form-group">
                    <label for="tanggal-diagnosa">Tanggal Diagnosa:</label>
                    <input type="date" class="form-control" name="tgl" required>
                </div>
                <label for="">Pilih Kucing : </label>
                <select name="id" class="form-control">
                    <option value="0">Pilih Kucing..</option>
                    <?php foreach ($kucing as $kc) : ?>
                        <option value="<?= $kc['id_kucing'] ?>"> <?= $kc['nama_kucing'] ?> </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Mulai Diagnosa</button>
            </div>
        </form>
    </div>

    <!-- Hasil Diagnosa -->
    <div id="hasilDiagnosa-section" class="container mt-4" style="display: none;">
        <h1>Riwayat Hasil Diagnosa</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th style="width: 20px;">No</th>
                    <th style="width: 100px;">Tanggal Diagnosa</th>
                    <th style="width: 100px;">Nama Kucing</th>
                    <th style="width: 100px;">Gambar Kucing</th>
                    <th style="width: 100px;">Nama Obat</th>
                    <th style="width: 100px;">Dosis</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($diagnosa as $ds) : ?>
                    <tr>
                        <td><?= $i; ?></td>
                        <td><?= $ds["tanggal_diagnosa"]; ?></td>
                        <td>
                            <?php
                            $id_kucing = $ds["id_kucing"];
                            $query = "SELECT * FROM kucing WHERE id_kucing = '$id_kucing'";
                            $result = mysqli_query($conn, $query);
                            $kucing4 = mysqli_fetch_assoc($result);
                            echo $kucing4["nama_kucing"];
                            ?>
                        </td>
                        <td>
                            <img src="img/<?= $kucing4['gambar']; ?>" width="80">
                        </td>
                        <td>
                            <?php
                            $id_resep = $ds["id_resep"];
                            $query = "SELECT * FROM resep WHERE id_resep = '$id_resep'";
                            $result = mysqli_query($conn, $query);
                            $resep2 = mysqli_fetch_assoc($result);
                            $id_obat = $resep2["id_obat"];
                            $query2 = "SELECT * FROM obat WHERE id_obat = '$id_obat'";
                            $result2 = mysqli_query($conn, $query2);
                            $obat2 = mysqli_fetch_assoc($result2);
                            echo $obat2["nama_obat"];
                            ?>
                        </td>
                        <td>
                            <?php
                            $id_resep = $ds["id_resep"];
                            $query = "SELECT * FROM resep WHERE id_resep = '$id_resep'";
                            $result = mysqli_query($conn, $query);
                            $resep2 = mysqli_fetch_assoc($result);
                            echo $resep2["dosis"];
                            ?>
                        </td>
                    </tr>
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
        var homeNav = document.getElementById("homeNav");
        var kucingNav = document.getElementById("kucingNav");
        var diagnosaNav = document.getElementById("diagnosaNav");
        var hasilDiagnosaNav = document.getElementById("hasilDiagnosaNav")
        var homeSection = document.getElementById("home-section");
        var kucingSection = document.getElementById("kucing-section");
        var diagnosaSection = document.getElementById("diagnosa-section");
        var hasilDiagnosaSection = document.getElementById("hasilDiagnosa-section")

        // Menambahkan event pada button homeNav
        homeNav.addEventListener("click", function(e) {
            e.preventDefault();
            homeSection.style.display = "block";
            kucingSection.style.display = "none";
            diagnosaSection.style.display = "none";
            hasilDiagnosaSection.style.display = "none";
            homeNav.classList.add("active");
            kucingNav.classList.remove("active");
            diagnosaNav.classList.remove("active");
            hasilDiagnosaNav.classList.remove("active");
        });

        // Menambahkan event pada button kucingNav
        kucingNav.addEventListener("click", function(e) {
            e.preventDefault();
            kucingSection.style.display = "block";
            homeSection.style.display = "none";
            diagnosaSection.style.display = "none";
            hasilDiagnosaSection.style.display = "none";
            kucingNav.classList.add("active");
            homeNav.classList.remove("active");
            diagnosaNav.classList.remove("active");
            hasilDiagnosaNav.classList.remove("active");
        });

        // Menambahkan event pada button diagnosaNav
        diagnosaNav.addEventListener("click", function(e) {
            e.preventDefault();
            diagnosaSection.style.display = "block";
            kucingSection.style.display = "none";
            homeSection.style.display = "none";
            hasilDiagnosaSection.style.display = "none";
            diagnosaNav.classList.add("active");
            kucingNav.classList.remove("active");
            homeNav.classList.remove("active");
            hasilDiagnosaNav.classList.remove("active");
        });

        // Menambahkan event pada button hasilDiagnosaNav
        hasilDiagnosaNav.addEventListener("click", function(e) {
            e.preventDefault();
            hasilDiagnosaSection.style.display = "block";
            diagnosaSection.style.display = "none";
            kucingSection.style.display = "none";
            homeSection.style.display = "none";
            hasilDiagnosaNav.classList.add("active");
            diagnosaNav.classList.remove("active");
            kucingNav.classList.remove("active");
            homeNav.classList.remove("active");
        });
    </script>
</body>

</html>