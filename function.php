<?php
$koneksi =mysqli_connect('localhost','root','','sekolahkuu');

function query($query)
{
    global $koneksi;
    $hasil = mysqli_query($koneksi, $query);
    $kotakbesar = [];
    while ($kotakkecil = mysqli_fetch_assoc($hasil)) {
        $kotakbesar [] = $kotakkecil;
    }
    return $kotakbesar;
}

function tambah($POST){
    global $koneksi;

    $nama = $POST['nama'];
    $nisn = $POST['nisn'];
    $jurusan = $POST['jurusan'];

    $gambar = upload();
    if(!$gambar) {
        return false;
    }

    $sql = "INSERT INTO tbl_siswa VALUES (
    '','$nama','$nisn','$jurusan','$gambar'
    )";

    mysqli_query ($koneksi, $sql);
    
    return mysqli_affected_rows ($koneksi);  
}


    function hapus($id) {
    global $koneksi;
    mysqli_query ($koneksi, "DELETE FROM tbl_siswa WHERE id = $id");

    return mysqli_affected_rows($koneksi);
}
    function upload(){
        $namafile=$_FILES["gambar"]["name"];
        $ukuranfile=$_FILES["gambar"]["size"];
        $error=$_FILES["gambar"]["error"];
        $tmpName=$_FILES["gambar"]["tmp_name"];

        if ($error === 4){
            echo " 
            <script>
            alert('pilih gambar bang');
            </script>";
            return false;
        }

        $ekstensiValid = ['jpg','png','jpeg'];
        $ekstensigambar = explode(".",$namafile);
        $ekstensigambar = strtolower (end($ekstensigambar));

        if(!in_array($ekstensigambar, $ekstensiValid)) {
            echo "
            <script>
                alert('file yang diupload bukan gambar');
            </script> ";
            return false;    
        }
        if ( $ukuranfile > 2000000) {
            echo " 
            <script>
                alert('maaf,ukuran gambar terlalu besar');
            </script> ";
            return false;
        }
        $namafilebaru = uniqid();
        $namafilebaru .= '.';
        $namafilebaru .= $ekstensigambar;

        move_uploaded_file ($tmpName, 'img/'.$namafilebaru);
        return $namafilebaru;
    }

    function ubah ($post) {
        global $koneksi;

        $id = htmlspecialchars($post["id"]);
        $nama = htmlspecialchars($post["nama"]);
        $nisn = htmlspecialchars($post["nisn"]);
        $jurusan = htmlspecialchars($post["jurusan"]);
        $gambarlama = htmlspecialchars($post["gambarlama"]);

        if ( $_FILES ["gambar"]["error"] === 4){
            $gambar = $gambarlama;
        } else {
            $gambar = upload();
        }

        $sql = "UPDATE tbl_siswa SET
        nama = 'nama',
        nisn = 'nisn',
        jurusan = 'jurusan',
        gambar = 'gambar'
        
        WHERE id='$id'";

        mysqli_query($koneksi,$sql);
        return mysqli_affected_rows($koneksi);

    }
