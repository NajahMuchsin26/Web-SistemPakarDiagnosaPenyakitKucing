<!DOCTYPE html>
<html lang="en">

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
                    <a class="nav-link" id="pemilikNav" href="#">Pemilik</a>
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
                        User
                    </a>
                    <div class="dropdown-menu" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <div id="diagnosa-section" class="container mt-4">
        <!-- <h1>Diagnosa</h1> -->
        <br>
        <?php
        include('functions.php');
        $kode = 'G001';
        // session_start();
        // echo "<p>Hai, ".$_SESSION['nama']." (".$_SESSION['umur']." th)</p>";
        $tanggal = $_GET["tgl"];
        $id = $_GET["id"];

        if (isset($_GET['kode'])) {
            $kode = $_GET['kode'];
        }

        $sql = "SELECT * from gejala WHERE id_gejala='$kode'";
        $data = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($data);
        ?>

        <!-- <label for="exampleFormControlInput1"> -->
        <div class="container">
            <div class="row" style="background-color: red;">
                <div class="form-control" style="border: 0;">
                    <h4 class="text-center"><?= "Apakah " . $row['nama_gejala'] . "?" ?></h4>
                </div>
            </div>
        </div>
        <!-- </label> -->

        <br>
        <?php
        include "fungsiJawab.php";
        answer($kode, $tanggal, $id);
        ?>

    </div>
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <!-- Kode JS -->
    <script>
        // Deklarasi & Inisialisasi Variabel Untuk Mendapatkan Elemen yang Tersedia
        var homeNav = document.getElementById("homeNav");
        var pemilikNav = document.getElementById("pemilikNav");
        var kucingNav = document.getElementById("kucingNav");
        var diagnosaNav = document.getElementById("diagnosaNav");
        var hasilDiagnosaNav = document.getElementById("hasilDiagnosaNav")
        var homeSection = document.getElementById("home-section");
        var pemilikSection = document.getElementById("pemilik-section");
        var kucingSection = document.getElementById("kucing-section");
        var diagnosaSection = document.getElementById("diagnosa-section");
        var hasilDiagnosaSection = document.getElementById("hasilDiagnosa-section")

        // Menambahkan event pada button homeNav
        homeNav.addEventListener("click", function(e) {
            e.preventDefault();
            homeSection.style.display = "block";
            pemilikSection.style.display = "none";
            kucingSection.style.display = "none";
            diagnosaSection.style.display = "none";
            hasilDiagnosaSection.style.display = "none";
            homeNav.classList.add("active");
            pemilikNav.classList.remove("active");
            kucingNav.classList.remove("active");
            diagnosaNav.classList.remove("active");
            hasilDiagnosaNav.classList.remove("active");
        });

        // Menambahkan event pada button pemilikNav
        pemilikNav.addEventListener("click", function(e) {
            e.preventDefault();
            pemilikSection.style.display = "block";
            homeSection.style.display = "none";
            kucingSection.style.display = "none";
            diagnosaSection.style.display = "none";
            hasilDiagnosaSection.style.display = "none";
            pemilikNav.classList.add("active");
            homeNav.classList.remove("active");
            kucingNav.classList.remove("active");
            diagnosaNav.classList.remove("active");
            hasilDiagnosaNav.classList.remove("active");
        });

        // Menambahkan event pada button kucingNav
        kucingNav.addEventListener("click", function(e) {
            e.preventDefault();
            kucingSection.style.display = "block";
            pemilikSection.style.display = "none";
            homeSection.style.display = "none";
            diagnosaSection.style.display = "none";
            hasilDiagnosaSection.style.display = "none";
            kucingNav.classList.add("active");
            pemilikNav.classList.remove("active");
            homeNav.classList.remove("active");
            hasilDiagnosaNav.classList.remove("active");
            diagnosaNav.classList.remove("active");
        });

        // Menambahkan event pada button diagnosaNav
        diagnosaNav.addEventListener("click", function(e) {
            e.preventDefault();
            diagnosaSection.style.display = "block";
            pemilikSection.style.display = "none";
            kucingSection.style.display = "none";
            homeSection.style.display = "none";
            hasilDiagnosaSection.style.display = "none";
            diagnosaNav.classList.add("active");
            pemilikNav.classList.remove("active");
            kucingNav.classList.remove("active");
            homeNav.classList.remove("active");
            hasilDiagnosaNav.classList.remove("active");
        });

        // Menambahkan event pada button hasilDiagnosaNav
        hasilDiagnosaNav.addEventListener("click", function(e) {
            e.preventDefault();
            hasilDiagnosaSection.style.display = "block";
            diagnosaSection.style.display = "none";
            pemilikSection.style.display = "none";
            kucingSection.style.display = "none";
            homeSection.style.display = "none";
            hasilDiagnosaNav.classList.add("active");
            diagnosaNav.classList.remove("active");
            pemilikNav.classList.remove("active");
            kucingNav.classList.remove("active");
            homeNav.classList.remove("active");
        });
    </script>
</body>

</html>