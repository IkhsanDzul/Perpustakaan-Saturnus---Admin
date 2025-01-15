<?php
// Include file koneksi database
include 'service/db.php';

if (isset($_GET['id_anggota'])) {
    // Ambil id_anggota dari parameter GET
    $id_anggota = $_GET['id_anggota'];

    // Escape input untuk menghindari SQL Injection
    $id_anggota = mysqli_real_escape_string($conn, $id_anggota);

    // Query untuk menghapus data anggota
    $query = "DELETE FROM anggota WHERE id_anggota = '$id_anggota'";

    // Eksekusi query
    if ($conn->query($query) === TRUE) {
        echo "Data anggota berhasil dihapus.";
        header("Location: anggota.php"); // Redirect ke halaman daftar anggota
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Parameter id_anggota tidak ditemukan.";
}

// Tutup koneksi database
$conn->close();
?>
