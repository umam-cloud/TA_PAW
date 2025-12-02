<?php

function inputan($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
// validasi inputan tidak boleh kosong
function wajib_isi($data){
    return !empty($data);
}

// validasi inputan update buku dan tambah buku penulis
function Alfabet($data){
    $data = inputan($data);
    return preg_match("/^[a-z A-Z .\s]+$/", $data);
}

// validasi nomer telepon dan stok buku 
function Numerik($data){
    return preg_match("/^[0-9]+$/",$data);
}

// validasi email
function Email($data){
    return filter_var($data, FILTER_VALIDATE_EMAIL);
}

// validasi username, judul buku dan penerbit buku
function Alfanumerik($data){
    return preg_match("/^[\w \s]+$/",$data);
}

// validasi alamat
function Alamat($data){
    return preg_match("/^[a-zA-Z0-9\s,\.\/-]{2,100}$/",$data);
}

// validasi password
function Password($data){
    return preg_match('/^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*(),.?":{}|<>]).{8,}$/', $data);
}

// validasi maksimal nomer telepon
function maxtlp($data){
    return strlen($data) == 12 or strlen($data) == 13 ;
}

// validasi minimal username
function minusn($data){
    return strlen($data) >= 3;
}

// validasi tanggal lahir
function tanggal($tahun, $bulan, $tanggal){
    if (!Numerik($tahun) or !Numerik($tahun) or !Numerik($tahun)) {
        return FALSE;
    }else {     
        $tanggal_lahir = mktime(0,0,0, $bulan, $tanggal, $tahun);
        $tahun_skrg = date('Y');
    
        if ($tahun_skrg - $tahun >= 8 and $tahun_skrg - $tahun <= 40){
            return TRUE;
        }else{
            return FALSE;
        }
    }

}

// validasi stok buku
function stok($data){
    return $data <= 5;
}

// validasi tahun terbit buku
function TahunTerbit($data){
    return preg_match("/^[0-9]{4}$/",$data);
}

function validasiGambar($file){
    // Ekstensi yang diizinkan
    $allowedExt  = ['jpg','jpeg','png','webp'];
    // MIME asli yang diizinkan
    $allowedMime = ['image/jpeg','image/png','image/webp'];

    // Ambil data file
    $fileName = $file['name'];
    $tmpFile  = $file['tmp_name'];
    
    // Ambil ekstensi
    $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // Ekstensi tidak valid
    if(!in_array($ext, $allowedExt)){
        return false;
    }

    // Cek MIME asli dari isi file
    $mimeType = mime_content_type($tmpFile);

    if(!in_array($mimeType, $allowedMime)){
        return false;
    }

    return true; // Lolos validasi
}


?>