<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "sp_kucing");
if (isset($_GET['kode'])) {
    $kode = $_GET['kode'];
} ?>
<form action="halamanUser.php" method="get">
    <?php include "fungsiJawab.php";
    solusi($kode);
    $id_login = $_SESSION['id_login'];
    $tanggal = date("Y-m-d");
    // echo $tanggal;
    $sqli = "SELECT * from penyakit WHERE id_penyakit='$kode'";
    $dataa = mysqli_query($conn, $sqli);
    $row = mysqli_fetch_assoc($dataa);
    $qq = $conn->query("SELECT * FROM kucing WHERE id_pemilik IN (SELECT id_pemilik FROM pemilik_kucing WHERE id_login = '$id_login')");
    $ss = $conn->query("SELECT * FROM resep WHERE id_penyakit = '$kode'");
    $pp = $conn->query("SELECT r.*, o.nama_obat FROM resep r JOIN obat o ON r.id_obat = o.id_obat WHERE r.id_penyakit = '$kode'");
    $resep = mysqli_fetch_assoc($ss);
    $obat = mysqli_fetch_assoc($pp);
    $kucing = $qq->fetch_assoc();
    // echo $kucing['id_kucing'];
    if ($kode == "exit" || $row['nama_penyakit'] == "exit") {
        echo "<center><p><strong style='color:red'>" . "PENYAKIT TIDAK DITEMUKAN" . " !</strong></p></center><hr>";
    } else {
        echo "<div class='col-md-6 d-flex justify-content-center align-items-center'>";
        echo "<div class='card mb-4'";
        echo "<div class='card-body'>";
        echo "<div>";
        echo "<p>Kucing anda kemungkinan mengalamai penyakit : <strong style='color:green'>" . $row['nama_penyakit'] . "</strong></p><br>";
        echo "<p>Penaganan yang dapat dilakukan melalui obat : <br><strong style='color:blue'>" . $obat['nama_obat'] . "  " . $resep['dosis'] . "</strong></p>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</div>";

        $sql = $conn->query("INSERT INTO diagnosa VALUES (NULL, '" . $_GET['id'] . "', '$resep[id_resep]', '" . $_GET['tgl'] . "') ");
        $id = mysqli_insert_id($conn);
    }
    ?>
    <input type="hidden" name="id" value="<?= $id ?>">
    <div class="col-md-6 d-flex justify-content-center align-items-center">
        <div class="card-body">
            <div class="card-body text-center">
                <button class="btn btn-primary" type="submit">
                    Kembali ke halaman utama
                </button>
            </div>
        </div>
    </div>
</form>