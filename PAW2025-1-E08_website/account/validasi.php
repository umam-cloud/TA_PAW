<?php

function inputan($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

function wajib_isi($data){
    return !empty($data);
}
function Alfabet($data){
    $data = inputan($data);
    return preg_match("/^[a-z A-Z \s]+$/", $data);
}

function Numerik($data){
    return preg_match("/^[0-9]+$/",$data);
}

function Email($data){
    return filter_var($data, FILTER_VALIDATE_EMAIL);
}

function Alfanumerik($data){
    return preg_match("/^[\w \s.,-]+$/",$data);
}

function Alamat($data){
    return preg_match("/^[\w .\s]+$/",$data);
}

function Password($data){
    return preg_match('/^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*(),.?":{}|<>]).{8,}$/', $data);
}

function maxtlp($data){
    return strlen($data) == 12 or strlen($data) == 13 ;
}

function minusn($data){
    return strlen($data) >= 3;
}


function tanggal($tahun, $bulan, $tanggal){
    $tanggal_lahir = mktime(0,0,0, $bulan, $tanggal, $tahun);
    $tahun_skrg = date('Y');

    if ($tahun_skrg - $tahun >= 8){
        return TRUE;
    }else{
        return FALSE;
    }
}

?>