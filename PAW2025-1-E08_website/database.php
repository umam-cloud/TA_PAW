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
		':pass' => hash('sha256',$data['password']),
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


function cekAkun(array $data){
    $stmnt = DBH->prepare('SELECT Username FROM pemustaka WHERE Username= :username and Password = :password UNION SELECT Username FROM admin WHERE Username= :username and Password = :password');
    $stmnt->execute([
        ':username' => $data['username'],
        ':password' =>  hash('sha256',$data['password']),
    ]);

    $rows = $stmnt->fetchAll();
    $jumlahBaris = count($rows);
    return $jumlahBaris > 0;
}



function login(array $data){
	$stmnt = DBH->prepare('SELECT id_pemustaka AS id,Username,"pemustaka" AS role FROM pemustaka WHERE Username=:username and Password =:pass UNION SELECT id_admin AS id,Username,"admin" AS role FROM admin WHERE Username=:username and Password =:pass');
	$stmnt->execute([
		':username' => $data['username'],
		':pass' =>  hash('sha256',$data['password']),
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

function addBuku(array $data){
	$stmt = DBH->prepare("INSERT INTO Buku (Judul, Penulis, Penerbit, Tahun_Terbit, Cover) VALUE (:Judul, :Penulis, :Penerbit, :Tahun_Terbit, :Cover)");
	$namaFile = time() . "_" . $_FILES['cover']['name'];
	$tmpFile = $_FILES['cover']['tmp_name'];
	$stmt->execute([
	':Judul' => $data ['judul'],
	':Penulis' => $data ['penulis'],
	':Penerbit' => $data ['penerbit'],
	':Tahun_Terbit' => $data ['tahun_terbit'],
	':Cover' => $namaFile,
	]);

	#menambahkan foto baru
	move_uploaded_file($tmpFile, BASE_PATH."/assets/covbuk/" . $namaFile);
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

function updateCover(int $id){
	#menghapus foto sebelumnya
	$cover = DBH->prepare('SELECT Cover FROM buku WHERE id_buku = :id');
	$cover->execute([
		':id' => $id
	]);
	$buku = $cover->fetch();
	unlink(BASE_PATH."/assets/fotoProfile/".$buku['Profil']);

	#menambahkan foto baru
	$namaFile = time() . "_" . $_FILES['cover']['name'];
	$tmpFile = $_FILES['cover']['tmp_name'];

	move_uploaded_file($tmpFile, BASE_PATH."/assets/covbuk/" . $namaFile);
	$query = DBH->prepare("UPDATE buku SET Cover = :cover WHERE id_buku = :id");
	$query->execute([
		':cover' => $namaFile,
		':id' => $id
	]);
}


// ==== sistem peminjaman ======

function updateStatusBuku(int $id, string $status) {
	$stmnt = DBH->prepare("UPDATE buku SET Status = :status WHERE ID_Buku = :id_buku");
	$stmnt->execute([
		':status' => $status,
		':id_buku' => $id,
	]);
}


function addPeminjam(int $buku, int $pemustaka){
	$stmt = DBH->prepare("INSERT INTO peminjaman (id_buku, id_pemustaka, tgl_pengembalian) VALUE (:id_buku, :id_pemustaka, :tgl_pengembalian)");
	$stmt->execute([
	':id_buku' => $buku,
	':id_pemustaka' => $pemustaka,
	':tgl_pengembalian' => date('Y-m-d', strtotime('+1 day')),
	]);
}

function daftarPeminjaman(){
	$stmnt = DBH->prepare(
	'SELECT 
    peminjaman.id_peminjaman,
	peminjaman.status,
	buku.id_buku,
    buku.Judul AS judul_buku,
    pemustaka.Username AS username_pemustaka,
    peminjaman.tgl_peminjaman,
    peminjaman.tgl_pengembalian
	FROM peminjaman
	INNER JOIN buku 
    ON peminjaman.id_buku = buku.id_buku
	INNER JOIN pemustaka 
    ON peminjaman.id_pemustaka = pemustaka.id_pemustaka
	ORDER BY peminjaman.id_peminjaman desc
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
		'SELECT b.* ,p.*
		 FROM peminjaman AS p
		 INNER JOIN buku AS b 
		 ON b.id_buku = p.id_buku
		 INNER JOIN pemustaka AS ps
		 ON ps.id_pemustaka = p.id_pemustaka
		 WHERE p.id_pemustaka = :id_pemustaka
		 ORDER BY p.id_peminjaman desc
		'
	); 
	$stmnt->execute([':id_pemustaka' => $id_pemustaka]);
	$koleksi = $stmnt->fetchAll();
	return$koleksi;
}


// untuk update stok buku ketika pemustaka meminjam buku dan mengupdate status di daftar peminjaman menjadi Dipinjam
function updateStokBuku(int $id) {
	$stmnt = DBH->prepare("UPDATE buku SET Stok = Stok -1  WHERE id_Buku = :id_buku");
	$stmnt->execute([
		':id_buku' => $id,
	]);
	$stmnt = DBH->prepare("UPDATE peminjaman set status = 'Dipinjam' WHERE id_Buku = :id_buku");
	$stmnt->execute([
		':id_buku' => $id,
	]);
}

// untuk mengupdate status peminjaman menjadi Diproses ketika pemustaka mengklik button kembalikan
function updateStatusPeminjaman(int $id){
	$stmnt = DBH->prepare("UPDATE peminjaman set status = 'Diproses' WHERE id_peminjaman = :id_peminjaman");
	$stmnt->execute([
		':id_peminjaman' => $id,
	]);
}

// untuk fungsi mengembalikan stok buku dan mengubah status di peminjaman menjadi dikembalikan
function updatePeminjaman(int $id, $idBuku){
	$stmnt = DBH->prepare("UPDATE peminjaman set status = 'Dikembalikan' WHERE id_peminjaman = :id_peminjaman");
	$stmnt->execute([
		':id_peminjaman' => $id
	]);

	$stmnt = DBH->prepare("UPDATE buku SET Stok = Stok + 1 WHERE id_buku = :id_buku");
	$stmnt->execute([
		':id_buku' => $idBuku
	]);
}































?>












