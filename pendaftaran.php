<?php
include 'service/db.php';
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit();
}

$admin = $_SESSION['admin']; // Ambil nama admin yang sedang login

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $no_telp = $_POST['no_telp'];
    $jenis_kelamin = $_POST['jenis_kelamin'];

    $query = "INSERT INTO anggota (nama_anggota, kelas, no_telp, jenis_kelamin, admin_pendaftar) 
              VALUES ('$nama', '$kelas', '$no_telp', '$jenis_kelamin', '$admin')";

    if ($conn->query($query) === TRUE) {
        echo "<p class='text-success'>Pendaftaran berhasil! Admin: <strong>$admin</strong></p>";
    } else {
        echo "<p class='text-danger'>Error: " . $conn->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Pendaftaran Anggota - Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            width: 100%;
            height: 100vh;
            background: rgb(52, 235, 155);
            background: linear-gradient(180deg, rgba(52, 235, 155, 1) 0%, rgba(41, 168, 121, 1) 100%);
        }
    </style>
</head>

<body class="py-3">
    <div class="container">
        <a href="anggota.php" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>
    <div class="container mt-5 mx-auto p-4 bg-light rounded" style="max-width: 400px;">
        <h3>Form Pendaftaran Anggota</h3>
        <form method="POST">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="mb-3">
                <label for="kelas" class="form-label">Kelas</label>
                <input type="text" class="form-control" id="kelas" name="kelas" required>
            </div>
            <div class="mb-3">
                <label for="no_telp" class="form-label">No Telp</label>
                <input type="text" class="form-control" id="no_telp" name="no_telp" required>
            </div>
            <div class="mb-3">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" name="daftar" value="daftar">Daftar</button>
        </form>
        <p class="mt-3 text-center text-muted mx-auto w-100">Didaftarkan oleh: <strong><?php echo $admin; ?></strong></p>
    </div>
</body>

</html>
