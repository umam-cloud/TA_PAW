<?php

function inputan($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}


function Alfabet($data){
    return preg_match("/^[\w \s]$/", $data);
}

function Numerik($data){
    return preg_match("/^[0-9]$/",$data);
}

function Alfanumerik($data){
    return preg_match("/^[\w .\s,-]$/",$data);
}

// HEYYYY

function Password($data){
    return preg_match('/^[\w .\s- * # @]+$/', $data);
}

function maxtlp($data){
    return strlen($data) <= 12;
}

function minusn($data){
    return str$data >= 3;
}


function tanggal($data){
    return checkdate(m,d,y)
}

?>