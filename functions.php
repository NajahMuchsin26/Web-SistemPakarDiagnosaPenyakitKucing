<?php
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "sp_kucing");

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function tambahGejala($data)
{
    global $conn;

    $idGejala = htmlspecialchars($data["idGejala"]);
    $namaGejala = htmlspecialchars($data["namaGejala"]);
    $deskripsi = htmlspecialchars($data["deskripsiGejala"]);

    $query = "INSERT INTO gejala
                VALUES
                ('$idGejala', '$namaGejala', '$deskripsi')
                ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function tambahPenyakit($data)
{
    global $conn;

    $idPenyakit = htmlspecialchars($data["idPenyakit"]);
    $namaPenyakit = htmlspecialchars($data["namaPenyakit"]);
    $deskrpsiPenyakit = htmlspecialchars($data["deskripsiPenyakit"]);

    $query = "INSERT INTO penyakit
                VALUES
                ('$idPenyakit', '$namaPenyakit', '$deskrpsiPenyakit')
                ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function tambahObat($data)
{
    global $conn;

    $idObat = htmlspecialchars($data["idObat"]);
    $namaObat = htmlspecialchars($data["namaObat"]);
    $deskrpsiObat = htmlspecialchars($data["deskripsiObat"]);

    $query = "INSERT INTO obat
                VALUES
                ('$idObat', '$namaObat', '$deskrpsiObat')
                ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function tambahResep($data)
{
    global $conn;

    $idResep = htmlspecialchars($data["idResep"]);
    $idPenyakit = htmlspecialchars($data["idPenyakit"]);
    $idObat = htmlspecialchars($data["idObat"]);
    $dosis =  htmlspecialchars($data["dosis"]);

    $query = "INSERT INTO resep
                VALUES
                ('$idResep', '$idPenyakit', '$idObat', '$dosis')
                ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function tambahPenyakitGejala($data)
{
    global $conn;

    $idPenyakit = htmlspecialchars($data["idPenyakit"]);
    $idGejala = $data["idGejala"];

    $affectedRows = 0;

    foreach ($idGejala as $gejala) {
        $query = "INSERT INTO penyakit_gejala VALUES ('', '$idPenyakit', '$gejala')";
        mysqli_query($conn, $query);
        $affectedRows += mysqli_affected_rows($conn);
    }

    return $affectedRows;
}

function tambahKucing($data)
{
    global $conn;
    $namaKucing = htmlspecialchars($data["namaKucing"]);
    $jenisKucing = htmlspecialchars($data["jenisKucing"]);
    $umurKucing = htmlspecialchars($data["umurKucing"]);
    $beratBadan = htmlspecialchars($data["beratBadan"]);
    $idPemilik = htmlspecialchars($data["idPemilik"]);


    // upload gambar
    $gambar = upload();
    if (!$gambar) {
        return false;
    }

    $query = "INSERT INTO kucing 
                VALUES
                (NULL, '$namaKucing', '$jenisKucing', '$umurKucing', '$beratBadan', '$gambar', '$idPemilik')
                ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function editGejala($data)
{
    global $conn;
    $idGejala = htmlspecialchars($data["idGejala"]);
    $namaGejala = htmlspecialchars($data["namaGejala"]);
    $deskripsi = htmlspecialchars($data["deskripsiGejala"]);

    $query = "UPDATE gejala SET 
                nama_gejala = '$namaGejala',
                deskripsi = '$deskripsi'
            WHERE id_gejala = '$idGejala' 
            ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function editPenyakit($data)
{
    global $conn;
    $idPenyakit = htmlspecialchars($data["idPenyakit"]);
    $namaPenyakit = htmlspecialchars($data["namaPenyakit"]);
    $deskripsi = htmlspecialchars($data["deskripsiPenyakit"]);

    $query = "UPDATE penyakit SET 
                nama_penyakit = '$namaPenyakit',
                deskripsi = '$deskripsi'
            WHERE id_penyakit = '$idPenyakit' 
            ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function editObat($data)
{
    global $conn;
    $idObat = htmlspecialchars($data["idObat"]);
    $namaObat = htmlspecialchars($data["namaObat"]);
    $deskripsi = htmlspecialchars($data["deskripsiObat"]);

    $query = "UPDATE obat SET 
                nama_obat = '$namaObat',
                deskripsi = '$deskripsi'
            WHERE id_obat = '$idObat' 
            ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function editResep($data)
{
    global $conn;

    $idResep = htmlspecialchars($data["idResep"]);
    $idPenyakit = htmlspecialchars($data["idPenyakit"]);
    $idObat = htmlspecialchars($data["idObat"]);
    $dosis =  htmlspecialchars($data["dosis"]);

    $query = "UPDATE resep SET 
                id_penyakit = '$idPenyakit',
                id_obat = '$idObat',
                dosis = '$dosis'
            WHERE id_resep = '$idResep' 
            ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}


function editPenyakitGejala($data)
{
    global $conn;
    $affectedRows = 0;

    $idPenyakit = htmlspecialchars($data["idPenyakit2"]);
    $idGejala = $data["idGejala"];

    $deleteQuery = "DELETE FROM penyakit_gejala WHERE id_penyakit = '$idPenyakit'";
    mysqli_query($conn, $deleteQuery);

    // Menambahkan row baru untuk memodifikasi data lama
    $gejalaCount = count($idGejala);
    for ($i = 0; $i < $gejalaCount; $i++) {
        $gejala = $idGejala[$i];
        $query = "INSERT INTO penyakit_gejala VALUES (null, '$idPenyakit', '$gejala')";
        $succes = mysqli_query($conn, $query);
        // $affectedRows += mysqli_affected_rows($conn);
    }

    return $succes;
}


function editKucing($data)
{
    global $conn;

    $idKucing = $data["idKucing"];

    $namaKucing = htmlspecialchars($data["namaKucing"]);
    $jenisKucing = htmlspecialchars($data["jenisKucing"]);
    $umurKucing = htmlspecialchars($data["umurKucing"]);
    $beratBadan = htmlspecialchars($data["beratBadan"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);

    // cek apakah user pilih gambar baru atau tidak
    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }

    $query = "UPDATE kucing SET 
                nama_kucing = '$namaKucing',
                jenis_kucing = '$jenisKucing',
                umur_kucing = '$umurKucing',
                berat_badan = '$beratBadan',
                gambar = '$gambar'

            WHERE id_kucing = $idKucing
                ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}


function editPemilik($data)
{
    global $conn;

    $idPemilik = $data["idPemilik"];

    $nama = htmlspecialchars($data["namaPemilik"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $noTelp = htmlspecialchars($data["noTlp"]);

    $query = "UPDATE pemilik_kucing SET 
                nama_pemilik = '$nama',
                alamat = '$alamat',
                no_telp = '$noTelp'

            WHERE id_pemilik = $idPemilik
                ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}


function hapusGejala($data)
{
    global $conn;

    $id = htmlspecialchars($data["idGejala"]);

    $query = "DELETE FROM gejala WHERE id_gejala = '$id'";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function hapusPenyakit($data)
{
    global $conn;

    $id = htmlspecialchars($data["idPenyakit"]);

    $query = "DELETE FROM penyakit WHERE id_penyakit = '$id'";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function hapusObat($data)
{
    global $conn;

    $id = htmlspecialchars($data["idObat"]);

    $query = "DELETE FROM obat WHERE id_obat = '$id'";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function hapusResep($data)
{
    global $conn;

    $id = htmlspecialchars($data["idResep"]);

    $query = "DELETE FROM resep WHERE id_resep = '$id'";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function hapusPenyakitGejala($idPenyakit)
{
    global $conn;

    // Memulai transaksi
    mysqli_begin_transaction($conn);

    try {
        // Mengapus row yang mengandung id penyakit tertentu
        $deleteQuery = "DELETE FROM penyakit_gejala WHERE id_penyakit = '$idPenyakit'";
        mysqli_query($conn, $deleteQuery);


        // Commit transaksi
        mysqli_commit($conn);

        return true;
    } catch (Exception $e) {
        // rollback transakti
        mysqli_rollback($conn);
        return false;
    }
}

function hapusKucing($data)
{
    global $conn;

    $id = htmlspecialchars($data["idKucing"]);

    $query = "DELETE FROM kucing WHERE id_kucing = '$id'";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function register($data)
{
    global $conn;

    $user = $_POST['username'];
    $pass = $_POST['password'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $no = $_POST['no'];
    $level = $_POST['level'];

    $query_login = "INSERT INTO login VALUES ('$user', '$pass', '$level', NULL)";
    $login = mysqli_query($conn, $query_login);
    $id_login = mysqli_insert_id($conn);

    if ($level == 'user') {
        $query_pelanggan = "INSERT INTO pemilik_kucing (nama_pemilik, alamat, no_telp, id_login) VALUES ('$nama', '$alamat', '$no', '$id_login')";
        $pelanggan = mysqli_query($conn, $query_pelanggan);
        return $login && $pelanggan;
    } else {
        return $login;
    }
}

function upload()
{
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tempName = $_FILES['gambar']['tmp_name'];

    // cek apakah tidak ada gambar yang diupoad
    if ($error === 4) {
        echo "
            <script>
                    alert('pilih gambar terlebih dahulu');
                </script>
        ";
        return false;
    }

    // cek apakah yang diupload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "
            <script>
                    alert('File Gambar Anda Tidak Valid');
                </script>
        ";
        return false;
    }

    // cek jika ukurannya terlalu besar
    if ($ukuranFile > 2000000) {
        echo "
            <script>
                    alert('Ukuran File Gmabar Maksimum 2Mb');
                </script>
        ";
        return false;
    }

    // lolos pengecekan, gambar siap diupload
    // generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;
    move_uploaded_file($tempName, 'img/' . $namaFileBaru);

    return $namaFileBaru;
}
