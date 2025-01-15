<?php
include 'service/db.php';

if (isset($_GET['id_buku'])) {
    $id_buku = intval($_GET['id_buku']);

    $query = "DELETE FROM buku WHERE id_buku = $id_buku";

    if ($conn->query($query)) {
        header("Location: buku.php?success=1");
    } else {
        // Jika error
        echo "Error: " . $conn->error;
    }
} else {
    header("Location: daftar_buku.php?error=missing_id");
    exit();
}
?>
