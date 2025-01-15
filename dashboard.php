<?php
include 'service/db.php';

session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit();
}

//Tampilan section akun admin
$sql = "SELECT nama_admin FROM admin WHERE id_admin = 1"; // Sesuaikan ID admin
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $namaAdmin = $row['nama_admin'];
} else {
    $namaAdmin = "Admin";
}


$query = "SELECT COUNT(*) AS total_anggota FROM anggota";
$result = $conn->query($query);
$row = $result->fetch_assoc();
$totalAnggota = $row['total_anggota'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard - Perpustakaan Satoernus</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            width: 100%;
            height: 100vh;
            background: rgb(52, 235, 155);
            background: linear-gradient(180deg, rgba(52, 235, 155, 1) 0%, rgba(41, 168, 121, 1) 100%);
        }

        .dashboard-container {
            max-width: 400px;
            width: 100%;
            padding: 2rem;
            background: white;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .dashboard-title {
            font-weight: bold;
            color: #333;
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .list-group-item {
            font-size: 1.1rem;
            border: none;
            color: #333;
        }

        .list-group-item:hover {
            background-color: #e2f3e9;
            color: #29a879;
        }

        .logout-btn {
            background-color: #ff4d4d;
            color: white;
            margin-top: 1.5rem;
        }

        .logout-btn:hover {
            background-color: #ff3333;
        }
    </style>
</head>

<body>
    <?php include "pages/user.html" ?>
    <div class="dashboard-container mx-auto mt-5">
        <h3 class="dashboard-title">Dashboard Admin</h3>
        <div class="list-group">
            <a href="anggota.php" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                Anggota
                <span class="badge bg-primary rounded-pill">
                    <?php echo $totalAnggota; ?>
                </span>
            </a>
            <a href="buku.php" class="list-group-item list-group-item-action">Buku</a>
            <a href="pendaftaran.php" class="list-group-item list-group-item-action">Pendaftaran Anggota</a>
            <a href="tambah_buku.php" class="list-group-item list-group-item-action">Tambah Buku <span class="badge bg-primary rounded-pill">+</span></a>
        </div>
    </div>
</body>

</html>