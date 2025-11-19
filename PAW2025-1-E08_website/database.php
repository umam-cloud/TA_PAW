<?php
session_start();
require_once('base.php');
require_once(BASE_PATH . '/conn.php');

function getPemustaka(){
	$stmnt = DBH->prepare('SELECT * FROM user WHERE Role = :role');
	$stmnt->execute([
		':role' => 'pemustaka'
	]);
	$pemustaka = $stmnt->fetchAll();
	return $pemustaka;
}

function addUser(array $data){
	$stmnt = DBH->prepare('INSERT INTO user (Username, Password, Email, Nomor_Telpon, Jenis_kelamin, Tgl_Lahir, Alamat) 
	VALUE (:username, :pass, :email, :no_telp, :jenkel, :tgl_lahir, :alamat)');
	$stmnt->execute([
		':username' => $data['username'],
		':pass' => $data['password'],
		':email' => $data['email'],
		':no_telp' => $data['tlp'],
		':jenkel' => $data['jenkel'],
		':tgl_lahir' => $data['ttl'],
		':alamat' => $data['alamat'],
	]);
}

function cekAkun(array $data){
    $stmnt = DBH->prepare('SELECT Username,id_user, Role FROM user WHERE Username = :username');
    $stmnt->execute([
        ':username' => $data['username']
    ]);

    $rows = $stmnt->fetchAll();
    $jumlahBaris = count($rows);
    return $jumlahBaris > 0;
}



function login(array $data){
	$stmnt = DBH->prepare('SELECT Username, id_user, Role FROM user WHERE Username = :username and Password = :pass');
	$stmnt->execute([
		':username' => $data['username'],
		':pass' => $data['password'],
	]);
	$row = $stmnt->fetchAll();
	foreach ($row as $user) {
		$_SESSION['login'] = TRUE;
		$_SESSION['username'] = $user['Username'];
		$_SESSION['role'] = $user['Role'];
		$_SESSION['id_user'] = $user['id_user'];
	}
} 

function getBuku(){
	$stmnt = DBH->prepare('SELECT * FROM buku');
	$stmnt->execute();
	$buku = $stmnt->fetchAll();
	return $buku;
}

function getBukuTerbaru(){
	$stmnt = DBH->prepare('SELECT * FROM buku ORDER BY `Tahun_Terbit` DESC LIMIT 6');
	$stmnt->execute();
	$buku = $stmnt->fetchAll();
	return $buku;
}

function getDataBuku(int $id){
	$stmnt = DBH->prepare('SELECT * FROM buku WHERE id_buku = :id_buku');
	$stmnt->execute([':id_buku' => $id ]);
	$buku = $stmnt->fetchAll();
	return $buku;
}

function deleteBuku(int $id){
	$stmnt = DBH->prepare('DELETE FROM buku WHERE ID_Buku = :id_buku');
	$stmnt->execute([':id_buku' => $id ]);
}


// //  HEY
function addBuku(array $data){
	$stmt = DBH->prepare("INSERT INTO Buku (Judul, Penulis, Penerbit, Tahun_Terbit) VALUE (:Judul, :Penulis, :Penerbit, :Tahun_Terbit)");
	$stmt->execute([
	':Judul' => $data ['judul'],
	':Penulis' => $data ['penulis'],
	':Penerbit' => $data ['penerbit'],
	':Tahun_Terbit' => $data ['tahun_terbit'],
	]);
}

function updateBuku(int $id, array $data) {
	$stmnt = DBH->prepare("UPDATE buku SET Judul = :Judul, Penulis = :Penulis, Penerbit = :Penerbit, Tahun_Terbit = :Tahun_Terbit WHERE ID_Buku = :id_buku");
	$stmnt->execute([
		':Judul' => $data['judul'],
		':Penulis' => $data['penulis'],
     	':Penerbit' => $data['penerbit'],
     	':Tahun_Terbit' => $data['tahun_terbit'],
		':id_buku' => $id,
	]);
}

function requestPinjam(int $id, string $status) {
	$stmnt = DBH->prepare("UPDATE buku SET Status = :status WHERE ID_Buku = :id_buku");
	$stmnt->execute([
		':status' => $status,
		':id_buku' => $id,
	]);
}


































?>












