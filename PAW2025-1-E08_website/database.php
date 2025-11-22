<?php
session_start();
require_once('base.php');
require_once(BASE_PATH . '/conn.php');
require_once(BASE_PATH . '/validasi.php');

function getPemustaka(){
	$stmnt = DBH->prepare('SELECT * FROM pemustaka');
	$stmnt->execute();
	$pemustaka = $stmnt->fetchAll();
	return $pemustaka;
}

function getDataPemustaka(int $id){
	$stmnt = DBH->prepare('SELECT * FROM pemustaka WHERE id_pemustaka = :id_pemustaka');
	$stmnt->execute([':id_pemustaka' => $id ]);
	$pemustaka = $stmnt->fetch();
	return $pemustaka;

}

function addUser(array $data){
	$stmnt = DBH->prepare('	INSERT INTO pemustaka (Username, Password, Email, Nomor_Telpon, Jenis_kelamin, Tgl_Lahir, Alamat) 
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

function updateUser(int $id, array $data) {
	$stmnt = DBH->prepare('UPDATE pemustaka SET Username = :username, Email = :email, Alamat = :alamat, Nomor_Telpon = :nomor_telepon WHERE id_pemustaka = :id_user');
	$stmnt->execute([
		':username' => $data['username'],
		':email' => $data['email'],
     	':alamat' => $data['alamat'],
     	':nomor_telepon' => $data['tlp'],
		':id_user'=>$id,
	]);
}

function cekUsernamePemustaka(array $data){
    $stmnt = DBH->prepare('SELECT Username FROM pemustaka WHERE Username= :username UNION SELECT Username FROM admin WHERE Username= :username');
    $stmnt->execute([
        ':username' => $data['username']
    ]);

    $rows = $stmnt->fetchAll();
    $jumlahBaris = count($rows);
    return $jumlahBaris > 0;
}



function login(array $data){
	$stmnt = DBH->prepare('SELECT id_pemustaka AS id,Username,"pemustaka" AS role FROM pemustaka WHERE Username=:username and Password =:pass UNION SELECT id_admin AS id,Username,"admin" AS role FROM admin WHERE Username=:username and Password =:pass');
	$stmnt->execute([
		':username' => $data['username'],
		':pass' => $data['password'],
	]);
	$user = $stmnt->fetch();
	$_SESSION['login'] = TRUE;
	$_SESSION['username'] = $user['Username'];
	$_SESSION['id_user'] = $user['id'];
	$_SESSION['role'] = $user['role'];
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
	$buku = $stmnt->fetch();
	return $buku;
}

function deleteBuku(int $id){
	$stmnt = DBH->prepare('DELETE FROM buku WHERE ID_Buku = :id_buku');
	$stmnt->execute([':id_buku' => $id ]);
}


// //  HEY
function addBuku(array $data){
	$stmt = DBH->prepare("INSERT INTO Buku (Judul, Penulis, Penerbit, Tahun_Terbit, Cover) VALUE (:Judul, :Penulis, :Penerbit, :Tahun_Terbit, :Cover)");
	$stmt->execute([
	':Judul' => $data ['judul'],
	':Penulis' => $data ['penulis'],
	':Penerbit' => $data ['penerbit'],
	':Tahun_Terbit' => $data ['tahun_terbit'],
	':Cover' => $data['cover'],
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

function updateStatusBuku(int $id, string $status) {
	$stmnt = DBH->prepare("UPDATE buku SET Status = :status WHERE ID_Buku = :id_buku");
	$stmnt->execute([
		':status' => $status,
		':id_buku' => $id,
	]);
}


function addPeminjam(int $buku, int $pemustaka){
	$stmt = DBH->prepare("INSERT INTO peminjaman (id_buku, id_pemustaka) VALUE (:id_buku, :id_pemustaka)");
	$stmt->execute([
	':id_buku' => $buku,
	':id_pemustaka' => $pemustaka,
	':tgl_pengmbalian' => date('Y-m-d')
	]);
}

function daftarPeminjaman(){
	$stmnt = DBH->prepare(
	'SELECT 
    peminjaman.id_peminjaman,
    buku.Judul AS judul_buku,
    pemustaka.Username AS username_pemustaka,
    peminjaman.tgl_peminjaman,
    peminjaman.tgl_pengembalian
	FROM peminjaman
	INNER JOIN buku 
    ON peminjaman.id_buku = buku.id_buku
	INNER JOIN pemustaka 
    ON peminjaman.id_pemustaka = pemustaka.id_pemustaka
	WHERE buku.Status = "permintaan";
	');
	$stmnt->execute();
	$peminjam = $stmnt->fetchAll();
	return $peminjam;
}

function updateProfile(int $id){
	#menghapus foto sebelumnya
	$profil = DBH->prepare('SELECT Profil FROM pemustaka WHERE id_pemustaka = :id');
	$profil->execute([
		':id' => $id
	]);
	$user = $profil->fetch();
	unlink(BASE_PATH."/assets/fotoProfile/".$user['Profil']);

	#menambahkan foto baru
	$namaFile = time() . "_" . $_FILES['profil']['name'];
	$tmpFile = $_FILES['profil']['tmp_name'];
	$_SESSION['foto_profile'] = $namaFile;

	move_uploaded_file($tmpFile, BASE_PATH."/assets/fotoProfile/" . $namaFile);
	$query = DBH->prepare("UPDATE pemustaka SET Profil = :profil WHERE id_pemustaka = :id");
	$query->execute([
		':profil' => $namaFile,
		':id' => $id
	]);
}

function koleksi(){
	$id_pemustaka = $_SESSION['id_user'];
	$stmnt = DBH->prepare(
		'SELECT b.*
		 FROM peminjaman AS p
		 INNER JOIN buku AS b 
		 ON b.id_buku = p.id_buku
		 INNER JOIN pemustaka AS ps
		 ON ps.id_pemustaka = p.id_pemustaka
		 WHERE p.id_pemustaka = :id_pemustaka and b.Status = "dipinjam"
		'
	); 
	$stmnt->execute([':id_pemustaka' => $id_pemustaka]);
	$koleksi = $stmnt->fetchAll();
	return$koleksi;
}































?>












