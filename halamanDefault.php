<?php require 'functions.php';
session_start();

if (isset($_POST["daftar"])) {
    if (register($_POST) > 0) {
        echo "
                <script>
                    alert('User Baru Berhasil Ditambahkan');
                </script>
            ";
    } else {
        echo mysqli_error($conn);
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pakar Diagnosa Kucing</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- Kode CSS -->
    <style>
        .login-section {
            background-color: #f8f9fa;
            padding: 50px;
            border-radius: 10px;
        }

        .login-section h2 {
            margin-bottom: 20px;
        }

        /* Style untuk body */
        body {
            background-color: #f8f9fa;
        }

        /* Style untuk navbar */
        .navbar {
            background-color: #007bff;
        }

        .navbar-brand {
            font-weight: bold;
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
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="#">Sistem Pakar Diagnosa Kucing</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="#" id="homeNav">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" id="loginNav">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" id="daftarNav">Daftar</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container" id="home-section">
        <div class="row mt-5">
            <div class="col-md-6">
                <h1>Selamat Datang di Sistem Pakar Diagnosa Kucing <br></h1>
                <p class="text-justify"><br>Sistem ini dapat membantu Anda mendiagnosa masalah kesehatan pada kucing Anda.
                    Dengan bantuan sistem kami yang canggih, Anda dapat dengan mudah menemukan jawaban atas pertanyaan-pertanyaan kesehatan kucing Anda.
                    Dari gejala-gejala ringan hingga serius, kami siap membantu Anda.
                    Tidak perlu khawatir, kami menyediakan panduan langkah demi langkah yang mudah dipahami, serta saran-saran praktis untuk merawat kucing Anda dengan sebaik-baiknya.
                    Jadi, ayo mulai perjalanan kesehatan kucing yang lebih baik bersama kami!<br></p>
                <a href="#" class="btn btn-primary">Mulai Diagnosa</a>
            </div>
            <div class="col-md-6">
                <img src="img\kucing2.jpg" alt="Gambar Kucing" class="img-fluid">
            </div>
        </div>
    </div>

    <div class="container" id="login-section" style="display: none;">
        <div class="row mt-5">
            <div class="col-md-6">
                <h1>Selamat Datang di Sistem Pakar Diagnosa Kucing <br></h1>
                <p class="text-justify"><br>Sistem ini dapat membantu Anda mendiagnosa masalah kesehatan pada kucing Anda.
                    Dengan bantuan sistem kami yang canggih, Anda dapat dengan mudah menemukan jawaban atas pertanyaan-pertanyaan kesehatan kucing Anda.
                    Dari gejala-gejala ringan hingga serius, kami siap membantu Anda.
                    Tidak perlu khawatir, kami menyediakan panduan langkah demi langkah yang mudah dipahami, serta saran-saran praktis untuk merawat kucing Anda dengan sebaik-baiknya.
                    Jadi, ayo mulai perjalanan kesehatan kucing yang lebih baik bersama kami!<br></p>
            </div>
            <div class="col-md-6">
                <div class="login-section">
                    <h2>Login</h2>
                    <form method="post">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" class="form-control" id="username" placeholder="Masukkan username">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan password">
                        </div>
                        <button type="submit" name="login" class="btn btn-primary">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
    if (isset($_POST['login'])) {
        $user = $_POST['username'];
        $pass = $_POST['password'];
        if ($user !== '' && $pass !== '') {
            $s = "SELECT * FROM pemilik_kucing JOIN login ON pemilik_kucing.id_login=login.id_login 
            WHERE username='$user' AND password='$pass'";
            $ad = $conn->query("SELECT * FROM login WHERE username='$user' AND password='$pass' ");
            $admin = $ad->fetch_assoc();
            $sql = mysqli_query($conn, $s);
            $row = mysqli_fetch_assoc($sql);

            if ($admin['level'] == "admin") {
                $_SESSION['admin'] = $admin;
                echo "<script>location.href='halamanAdmin.php'; </script>";
            } elseif ($row['level'] == "user") {
                $_SESSION['user'] = $row;
                $_SESSION['level'] = "user";
                $_SESSION['id_login'] = $row['id_login'];
                echo "<script>location.href='halamanUser.php'; </script>";
            } else {
                echo "<script>alert('Username atau Password Salah.');</script>";
            }
        } else {
            echo "<script>alert('Masukkan Username dan Password.');</script>";
        }
    }
    ?>



    <div class="container" id="daftar-section" style="display: none;">
        <div class="row mt-5">
            <div class="col-md-6">
                <h1>Selamat Datang di Sistem Pakar Diagnosa Kucing <br></h1>
                <p class="text-justify"><br>Sistem ini dapat membantu Anda mendiagnosa masalah kesehatan pada kucing Anda.
                    Dengan bantuan sistem kami yang canggih, Anda dapat dengan mudah menemukan jawaban atas pertanyaan-pertanyaan kesehatan kucing Anda.
                    Dari gejala-gejala ringan hingga serius, kami siap membantu Anda.
                    Tidak perlu khawatir, kami menyediakan panduan langkah demi langkah yang mudah dipahami, serta saran-saran praktis untuk merawat kucing Anda dengan sebaik-baiknya.
                    Jadi, ayo mulai perjalanan kesehatan kucing yang lebih baik bersama kami!<br></p>
            </div>
            <div class="col-md-6">
                <div class="login-section">
                    <h2>Daftar</h2>
                    <form method="post">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" class="form-control" id="username" placeholder="Masukkan username">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan password">
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukkan nama">
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" name="alamat" class="form-control" id="alamat" placeholder="Masukkan alamat">
                        </div>
                        <div class="form-group">
                            <label for="no">No. Telp</label>
                            <input type="text" name="no" class="form-control" id="no" placeholder="Masukkan nomor">
                        </div>
                        <div class="form-group">
                            <label for="level">Level</label>
                            <select name="level" class="form-control" id="role">
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        <button type="submit" name="daftar" class="btn btn-primary">Daftar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script>
        // Deklarasi & Inisialisasi Variabel Untuk Mendapatkan Elemen yang Tersedia
        var homeNav = document.getElementById("homeNav");
        var loginNav = document.getElementById("loginNav");
        var homeSection = document.getElementById("home-section");
        var loginSection = document.getElementById("login-section");
        var daftarSection = document.getElementById("daftar-section");

        // Menambahkan event pada button homeNav
        homeNav.addEventListener("click", function(e) {
            e.preventDefault();
            homeSection.style.display = "block";
            loginSection.style.display = "none";
            daftarSection.style.display = "none";
            loginNav.classList.remove("active");
            homeNav.classList.add("active");
            daftarNav.classList.remove("active");
        });

        loginNav.addEventListener("click", function(e) {
            e.preventDefault();
            homeSection.style.display = "none";
            loginSection.style.display = "block";
            daftarSection.style.display = "none";
            loginNav.classList.add("active");
            homeNav.classList.remove("active");
            daftarNav.classList.remove("active");
        });

        daftarNav.addEventListener("click", function(e) {
            e.preventDefault();
            homeSection.style.display = "none";
            loginSection.style.display = "none";
            daftarSection.style.display = "block";
            loginNav.classList.remove("active");
            daftarNav.classList.add("active");
            homeNav.classList.remove("active");
        });
    </script>
</body>

</html>