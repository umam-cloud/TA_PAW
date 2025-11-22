<?php 
    require_once('../base.php');
    require_once(BASE_PATH."/database.php");
    if (!isset($_SESSION['login'])) {
        header('location:'.BASE_URL.'/account/login.php');
        exit;
    }

    $id = $_GET['id_buku'];
    if (isset($_POST['delete'])){
        $delete = $_POST['delete'];
        if ($delete == 'hapus') {
            deleteBuku($id);
            header('location:'.BASE_URL.'/admin/daftarbuku.php');
        }elseif ($delete == 'cancel') {
            header('location:'.BASE_URL.'/admin/daftarbuku.php');
        }
    }
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Yakin?</h1>
    <form action="" method="POST">
        <button name="delete" value="hapus">Hapus</button>
        <button name="delete" value="cancel">Cancel</button>
    </form>
    
</body>
</html>