<?php


$conn = mysqli_connect("localhost", "root", "", "ikan");

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $wadah = [];
    while ($baju = mysqli_fetch_assoc($result)) {
        $wadah[] = $baju;
    }
    return $wadah;
}

function tambah($data)
{
    global $conn;
    // htmlspecialchars untuk blok tag elemen html

    $nama = htmlspecialchars($data["nama"]);
    $nis = htmlspecialchars($data["nis"]);
    $rombel = htmlspecialchars($data["rombel"]);
    $rayon = htmlspecialchars($data["rayon"]);
    $status = htmlspecialchars($data["status"]);
    $hobi = htmlspecialchars($data["hobi"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $merk_laptop = htmlspecialchars($data["merek"]);
    
    $gambar = upload();
	if( !$gambar ) {
		return false;

		
	}
     
    $query = "INSERT INTO students
            VALUES
            ('',  '$nama', '$nis','$rombel', '$rayon', '$status', '$hobi', '$alamat', '$merk_laptop', '$gambar')
            ";
              
    
   

    // data yang disimpan di $_post masukan ke database

    mysqli_query($conn, $query);

    // yang akan dikembalikan nilai 1 atau -1 untuk menghasilkan pesan
    return mysqli_affected_rows($conn);
}

function upload() {

	$namaFile = $_FILES['gambar']['name'];
	$ukuranFile = $_FILES['gambar']['size'];
	$error = $_FILES['gambar']['error'];
	$tmpName = $_FILES['gambar']['tmp_name'];

	// cek apakah tidak ada gambar yang diupload
	if( $error === 4 ) {
		echo "<script>
				alert('pilih gambar terlebih dahulu!');
                document.location.href= 'tambah.php';
			  </script>";
		return false;
	}

	// cek apakah yang diupload adalah gambar
	$ekstensiGambarValid = ['jpg', 'jpeg', 'png', 'gif'];
	$ekstensiGambar = explode('.', $namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));
	if( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
		echo "<script>
				alert('yang anda upload bukan gambar!');
                document.location.href= 'tambah.php';
			  </script>";
		return false;
	}

	// max 2mb
	if( $ukuranFile > 2000000 ) {
		echo "<script>
				alert('ukuran gambar terlalu besar!');
                document.location.href= 'tambah.php';
			  </script>";
		return false;
	}

	// lolos pengecekan, gambar siap diupload
	// generate nama gambar baru
	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiGambar;

	move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

	return $namaFileBaru;
}



function  hapus($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM students WHERE id = $id");

    return mysqli_affected_rows($conn);
}

function ubah($data)
{

    global $conn;

    $id = $data["id"];
    $nama = htmlspecialchars($data["nama"]);
    $nis = htmlspecialchars($data["nis"]);
    $rombel = htmlspecialchars($data["rombel"]);
    $rayon = htmlspecialchars($data["rayon"]);
    $status = htmlspecialchars($data["status"]);
    $hobi = htmlspecialchars($data["hobi"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $merek = htmlspecialchars($data["merek"]);
	$gambarLama = htmlspecialchars($data["gambarLama"]);
	
	if ($_FILES['gambar']['error'] === 4 ) {
		$gambar= $gambarLama;
	} else{
		$gambar = upload();
	}




    $query = "UPDATE students SET
            
            nama = '$nama',
            nis = '$nis',
            rombel = '$rombel',
            rayon = '$rayon',
            status = '$status',
            hobi = '$hobi',
            alamat = '$alamat',
            merk_laptop = '$merek',
            gambar = '$gambar'

                WHERE id = $id
            
            

            
            ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
function updatef() {

	$namaFile = $_FILES['gambar']['name'];
	$ukuranFile = $_FILES['gambar']['size'];
	$error = $_FILES['gambar']['error'];
	$tmpName = $_FILES['gambar']['tmp_name'];

	// cek apakah tidak ada gambar yang diupload
	if( $error === 4 ) {
		echo "<script>
				alert('pilih gambar terlebih dahulu!');
                document.location.href= 'update.php';
			  </script>";
		return false;
	}

	// cek apakah yang diupload adalah gambar
	$ekstensiGambarValid = ['jpg', 'jpeg', 'png', 'gif'];
	$ekstensiGambar = explode('.', $namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));
	if( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
		echo "<script>
				alert('yang anda upload bukan gambar!');
                document.location.href= 'index.php';
			  </script>";
		return false;
	}

	// max 2mb
	if( $ukuranFile > 2000000 ) {
		echo "<script>
				alert('ukuran gambar terlalu besar!');
                document.location.href= 'index.php';
			  </script>";
		return false;
	}

	// lolos pengecekan, gambar siap diupload
	// generate nama gambar baru
	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiGambar;

	move_uploaded_file($tmpName, 'update/' . $namaFileBaru);

	return $namaFileBaru;
}