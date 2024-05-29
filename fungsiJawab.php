<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

<?php

function answer($kode, $tanggal, $id_kucing)
{
    if ($kode == 'G001') {
        echo "<center><a class='btn btn-primary col-sm-1 mrg btn-lg' href='question.php?kode=G002&tgl=$tanggal&id=$id_kucing'>Ya</a>&nbsp;&nbsp;";
        echo "<a class='btn btn-danger col-sm-1 mrg btn-lg' href='question.php?kode=G005&tgl=$tanggal&id=$id_kucing'>Tidak</a></center>";
    }
    if ($kode == 'G002') {
        echo "<center><a class='btn btn-primary col-sm-1 mrg btn-lg' href='question.php?kode=G003&tgl=$tanggal&id=$id_kucing'>Ya</a>&nbsp;&nbsp;";
        echo "<a class='btn btn-danger col-sm-1 mrg btn-lg' href='question.php?kode=exit'>Tidak</a></center>";
    }

    if ($kode == 'G003') {
        echo "<center><a class='btn btn-primary col-sm-1 mrg btn-lg' href='solusi.php?kode=P01&tgl=$tanggal&id=$id_kucing'>Ya</a>&nbsp;&nbsp;";
        echo "<a class='btn btn-danger col-sm-1 mrg btn-lg' href='question.php?kode=G004&tgl=$tanggal&id=$id_kucing'>Tidak</a></center>";
    }
    if ($kode == 'G004') {
        echo "<center><a class='btn btn-primary col-sm-1 mrg btn-lg' href='solusi.php?kode=P02&tgl=$tanggal&id=$id_kucing''>Ya</a>&nbsp;&nbsp;";
        echo "<a class='btn btn-danger col-sm-1 mrg btn-lg' href='solusi.php?kode=exit'>Tidak</a></center>";
    }
    if ($kode == 'G005') {
        echo "<center><a class='btn btn-primary col-sm-1 mrg btn-lg' href='question.php?kode=G006&tgl=$tanggal&id=$id_kucing'>Ya</a>&nbsp;&nbsp;";
        echo "<a class='btn btn-danger col-sm-1 mrg btn-lg' href='question.php?kode=G015&tgl=$tanggal&id=$id_kucing'>Tidak</a></center>";
    }
    if ($kode == 'G006') {
        echo "<center><a class='btn btn-primary col-sm-1 mrg btn-lg' href='question.php?kode=G007-a&tgl=$tanggal&id=$id_kucing'>Ya</a>&nbsp;&nbsp;";
        echo "<a class='btn btn-danger col-sm-1 mrg btn-lg' href='question.php?kode=G007-b&tgl=$tanggal&id=$id_kucing'>Tidak</a></center>";
    }
    if ($kode == 'G007-a') {
        echo "<center><a class='btn btn-primary col-sm-1 mrg btn-lg' href='question.php?kode=G008-a&tgl=$tanggal&id=$id_kucing'>Ya</a>&nbsp;&nbsp;";
        echo "<a class='btn btn-danger col-sm-1 mrg btn-lg' href='solusi.php?kode=exit'>Tidak</a></center>";
    }
    if ($kode == 'G007-b') {
        echo "<center><a class='btn btn-primary col-sm-1 mrg btn-lg' href='question.php?kode=G008-b&tgl=$tanggal&id=$id_kucing'>Ya</a>&nbsp;&nbsp;";
        echo "<a class='btn btn-danger col-sm-1 mrg btn-lg' href='question.php?kode=G014&tgl=$tanggal&id=$id_kucing'>Tidak</a></center>";
    }
    if ($kode == 'G008-a') {
        echo "<center><a class='btn btn-primary col-sm-1 mrg btn-lg' href='question.php?kode=G009-a&tgl=$tanggal&id=$id_kucing'>Ya</a>&nbsp;&nbsp;";
        echo "<a class='btn btn-danger col-sm-1 mrg btn-lg' href='question.php?kode=G017&tgl=$tanggal&id=$id_kucing'>Tidak</a></center>";
    }
    if ($kode == 'G008-b') {
        echo "<center><a class='btn btn-primary col-sm-1 mrg btn-lg' href='question.php?kode=G009-b&tgl=$tanggal&id=$id_kucing'>Ya</a>&nbsp;&nbsp;";
        echo "<a class='btn btn-danger col-sm-1 mrg btn-lg' href='question.php?kode=G025-b&tgl=$tanggal&id=$id_kucing'>Tidak</a></center>";
    }
    if ($kode == 'G009-a') {
        echo "<center><a class='btn btn-primary col-sm-1 mrg btn-lg' href='question.php?kode=G010-a&tgl=$tanggal&id=$id_kucing'>Ya</a>&nbsp;&nbsp;";
        echo "<a class='btn btn-danger col-sm-1 mrg btn-lg' href='question.php?kode=G017&tgl=$tanggal&id=$id_kucing'>Tidak</a></center>";
    }
    if ($kode == 'G009-b') {
        echo "<center><a class='btn btn-primary col-sm-1 mrg btn-lg' href='question.php?kode=G010-b&tgl=$tanggal&id=$id_kucing'>Ya</a>&nbsp;&nbsp;";
        echo "<a class='btn btn-danger col-sm-1 mrg btn-lg' href='solusi.php?kode=exit'>Tidak</a></center>";
    }
    if ($kode == 'G010-a') {
        echo "<center><a class='btn btn-primary col-sm-1 mrg btn-lg' href='question.php?kode=G025-a&tgl=$tanggal&id=$id_kucing'>Ya</a>&nbsp;&nbsp;";
        echo "<a class='btn btn-danger col-sm-1 mrg btn-lg' href='solusi.php?kode=exit'>Tidak</a></center>";
    }
    if ($kode == 'G010-b') {
        echo "<center><a class='btn btn-primary col-sm-1 mrg btn-lg' href='question.php?kode=G011-b&tgl=$tanggal&id=$id_kucing'>Ya</a>&nbsp;&nbsp;";
        echo "<a class='btn btn-danger col-sm-1 mrg btn-lg' href='solusi.php?kode=exit'>Tidak</a></center>";
    }
    if ($kode == 'G011-b') {
        echo "<center><a class='btn btn-primary col-sm-1 mrg btn-lg' href='question.php?kode=G012-b&tgl=$tanggal&id=$id_kucing'>Ya</a>&nbsp;&nbsp;";
        echo "<a class='btn btn-danger col-sm-1 mrg btn-lg' href='solusi.php?kode=exit'>Tidak</a></center>";
    }
    if ($kode == 'G012-b') {
        echo "<center><a class='btn btn-primary col-sm-1 mrg btn-lg' href='question.php?kode=G013-b&tgl=$tanggal&id=$id_kucing'>Ya</a>&nbsp;&nbsp;";
        echo "<a class='btn btn-danger col-sm-1 mrg btn-lg' href='solusi.php?kode=exit'>Tidak</a></center>";
    }
    if ($kode == 'G013-b') {
        echo "<center><a class='btn btn-primary col-sm-1 mrg btn-lg' href='solusi.php?kode=P04&tgl=$tanggal&id=$id_kucing''>Ya</a>&nbsp;&nbsp;";
        echo "<a class='btn btn-danger col-sm-1 mrg btn-lg' href='solusi.php?kode=exit'>Tidak</a></center>";
    }
    if ($kode == 'G014') {
        echo "<center><a class='btn btn-primary col-sm-1 mrg btn-lg' href='question.php?kode=G015-a&tgl=$tanggal&id=$id_kucing'>Ya</a>&nbsp;&nbsp;";
        echo "<a class='btn btn-danger col-sm-1 mrg btn-lg' href='solusi.php?kode=exit'>Tidak</a></center>";
    }
    if ($kode == 'G015') {
        echo "<center><a class='btn btn-primary col-sm-1 mrg btn-lg' href='question.php?kode=G016&tgl=$tanggal&id=$id_kucing'>Ya</a>&nbsp;&nbsp;";
        echo "<a class='btn btn-danger col-sm-1 mrg btn-lg' href='solusi.php?kode=exit'>Tidak</a></center>";
    }
    if ($kode == 'G015-a') {
        echo "<center><a class='btn btn-primary col-sm-1 mrg btn-lg' href='question.php?kode=G016-a'&tgl=$tanggal&id=$id_kucing>Ya</a>&nbsp;&nbsp;";
        echo "<a class='btn btn-danger col-sm-1 mrg btn-lg' href='solusi.php?kode=exit'>Tidak</a></center>";
    }
    if ($kode == 'G016') {
        echo "<center><a class='btn btn-primary col-sm-1 mrg btn-lg' href='question.php?kode=G019&tgl=$tanggal&id=$id_kucing'>Ya</a>&nbsp;&nbsp;";
        echo "<a class='btn btn-danger col-sm-1 mrg btn-lg' href='solusi.php?kode=exit'>Tidak</a></center>";
    }
    if ($kode == 'G016-a') {
        echo "<center><a class='btn btn-primary col-sm-1 mrg btn-lg' href='solusi.php?kode=P05&tgl=$tanggal&id=$id_kucing''>Ya</a>&nbsp;&nbsp;";
        echo "<a class='btn btn-danger col-sm-1 mrg btn-lg' href='solusi.php?kode=exit'>Tidak</a></center>";
    }
    if ($kode == 'G017') {
        echo "<center><a class='btn btn-primary col-sm-1 mrg btn-lg' href='question.php?kode=G018&tgl=$tanggal&id=$id_kucing'>Ya</a>&nbsp;&nbsp;";
        echo "<a class='btn btn-danger col-sm-1 mrg btn-lg' href='solusi.php?kode=exit'>Tidak</a></center>";
    }
    if ($kode == 'G018') {
        echo "<center><a class='btn btn-primary col-sm-1 mrg btn-lg' href='solusi.php?kode=P06&tgl=$tanggal&id=$id_kucing''>Ya</a>&nbsp;&nbsp;";
        echo "<a class='btn btn-danger col-sm-1 mrg btn-lg' href='solusi.php?kode=exit'>Tidak</a></center>";
    }
    if ($kode == 'G019') {
        echo "<center><a class='btn btn-primary col-sm-1 mrg btn-lg' href='question.php?kode=G020&tgl=$tanggal&id=$id_kucing'>Ya</a>&nbsp;&nbsp;";
        echo "<a class='btn btn-danger col-sm-1 mrg btn-lg' href='solusi.php?kode=exit'>Tidak</a></center>";
    }
    if ($kode == 'G020') {
        echo "<center><a class='btn btn-primary col-sm-1 mrg btn-lg' href='solusi.php?kode=P07&tgl=$tanggal&id=$id_kucing''>Ya</a>&nbsp;&nbsp;";
        echo "<a class='btn btn-danger col-sm-1 mrg btn-lg' href='solusi.php?kode=exit'>Tidak</a></center>";
    }
    if ($kode == 'G021') {
        echo "<center><a class='btn btn-primary col-sm-1 mrg btn-lg' href='question.php?kode=G022&tgl=$tanggal&id=$id_kucing'>Ya</a>&nbsp;&nbsp;";
        echo "<a class='btn btn-danger col-sm-1 mrg btn-lg' href='solusi.php?kode=exit'>Tidak</a></center>";
    }
    if ($kode == 'G022') {
        echo "<center><a class='btn btn-primary col-sm-1 mrg btn-lg' href='question.php?kode=G023&tgl=$tanggal&id=$id_kucing'>Ya</a>&nbsp;&nbsp;";
        echo "<a class='btn btn-danger col-sm-1 mrg btn-lg' href='solusi.php?kode=exit'>Tidak</a></center>";
    }
    if ($kode == 'G023') {
        echo "<center><a class='btn btn-primary col-sm-1 mrg btn-lg' href='question.php?kode=G024&tgl=$tanggal&id=$id_kucing'>Ya</a>&nbsp;&nbsp;";
        echo "<a class='btn btn-danger col-sm-1 mrg btn-lg' href='solusi.php?kode=exit'>Tidak</a></center>";
    }
    if ($kode == 'G024') {
        echo "<center><a class='btn btn-primary col-sm-1 mrg btn-lg' href='solusi.php?kode=P08&tgl=$tanggal&id=$id_kucing''>Ya</a>&nbsp;&nbsp;";
        echo "<a class='btn btn-danger col-sm-1 mrg btn-lg' href='solusi.php?kode=exit'>Tidak</a></center>";
    }
    if ($kode == 'G025-a') {
        echo "<center><a class='btn btn-primary col-sm-1 mrg btn-lg' href='solusi.php?kode=P03&tgl=$tanggal&id=$id_kucing''>Ya</a>&nbsp;&nbsp;";
        echo "<a class='btn btn-danger col-sm-1 mrg btn-lg' href='solusi.php?kode=exit'>Tidak</a></center>";
    }
    if ($kode == 'G025-b') {
        echo "<center><a class='btn btn-primary col-sm-1 mrg btn-lg' href='solusi.php?kode=P09&tgl=$tanggal&id=$id_kucing''>Ya</a>&nbsp;&nbsp;";
        echo "<a class='btn btn-danger col-sm-1 mrg btn-lg' href='solusi.php?kode=exit'>Tidak</a></center>";
    }
}

function kesimpulan($penyakit)
{
    $conn = mysqli_connect("localhost", "root", "", "sp_kucing");
    $sql = "SELECT * from penyakit JOIN penyakit_gejala ON penyakit.id_penyakit=penyakit_gejala.id_penyakit
    JOIN gejala ON gejala.id_gejala=penyakit_gejala.id_gejala WHERE penyakit.nama_penyakit='$penyakit'";
    $data = mysqli_query($conn, $sql);
    // echo $data;
    echo "<div class='col-md-6 d-flex justify-content-center align-items-center'>";
    echo "<div class='card-body'>";
    echo "<h5 class='card-title'>Hasil diagnososis</h5>";
    echo "<div>";
    while ($row = mysqli_fetch_assoc($data)) {
        echo '<p>- ' . $row['deskripsi'] . '</p>';
    }
    echo "</div>";
    echo "</div>";
    echo "</div>";
}

function solusi($kode)
{
    if ($kode == 'P01') {
        $penyakit = "Scabies";
        kesimpulan($penyakit);
    }
    if ($kode == 'P02') {
        $penyakit = "EktoParasit";
        kesimpulan($penyakit);
    }
    if ($kode == 'P03') {
        $penyakit = "EndoParasit";
        kesimpulan($penyakit);
    }
    if ($kode == 'P04') {
        $penyakit = "Babesiosis";
        kesimpulan($penyakit);
    }
    if ($kode == 'P05') {
        $penyakit = "Suspect Calicivirus";
        kesimpulan($penyakit);
    }
    if ($kode == 'P06') {
        $penyakit = "Suspect Panleukopenia";
        kesimpulan($penyakit);
    }
    if ($kode == 'P07') {
        $penyakit = "Suspect Clamydia";
        kesimpulan($penyakit);
    }
    if ($kode == 'P08') {
        $penyakit = "Stomatitis";
        kesimpulan($penyakit);
    }
    if ($kode == 'P09') {
        $penyakit = "Helminthiasis";
        kesimpulan($penyakit);
    }
    if ($kode == 'exit') {
        $penyakit = "exit";
        kesimpulan($penyakit);
    }
}


?>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>