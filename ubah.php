<?php
require'function.php';

$id= $_GET['id'];

$r=query("SELECT * FROM tbl_siswa WHERE id='$id'")[0];


if (isset ($_POST ["tekan"])) {

    if (ubah ($_POST) > 0) {
        echo "
        <script>
        alert('data berhasil di ubah');
        document.location.href = 'index.php';
        </script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ubah</title>
</head>
<body>

<h1>form ubah</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $r['id']; ?>">
            <input type="hidden" name="gambarlama" value="<?= $r['gambar']; ?>">
        <ul>
            <li>    
        <label for="nama">Nama : </label>
        <input type="text" name="nama" id="nama" value="<?= $r['nama']; ?>">
        </li>
        <li>
        <label for="nisn">Nisn : </label>
        <input type="text" name="nisn" id="nisn" value="<?= $r['nisn']; ?>">
        </li>
        <li>
        <label for="jurusan">Jurusan : </label>
        <input type="text" name="jurusan" id="jurusan"  value="<?= $r['jurusan']; ?>">
        </li><br><br>
        <li>
        <label for="gambar">Gambar : </label>
        <img src="img/<?= $r['gambar'];?>" width="100"><br>
        <input type="file" name="gambar" id="gambar" value="<?= $r['gambar']; ?>">
        </li>
        <li>
        <button type="submit" name="tekan">kirim</button>
</ul>
</form>
</body>
</html>
