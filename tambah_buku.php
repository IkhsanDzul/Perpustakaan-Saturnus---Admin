<?php
include 'service/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $nama_buku = $_POST['nama_buku'] ?? null;
    $kategori = $_POST['kategori'] ?? null;

    // Validasi input
    if (!$nama_buku || !$kategori) {
        die("Nama buku dan kategori wajib diisi.");
    }

    // Periksa apakah file diunggah
    if (isset($_FILES['cover_buku']) && $_FILES['cover_buku']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['cover_buku']['tmp_name'];
        $fileName = $_FILES['cover_buku']['name'];
        $fileSize = $_FILES['cover_buku']['size'];
        $fileType = $_FILES['cover_buku']['type'];

        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Validasi jenis file
        $allowedfileExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($fileExtension, $allowedfileExtensions)) {
            // Folder tujuan
            $uploadFileDir = 'uploads/';
            if (!is_dir($uploadFileDir)) {
                mkdir($uploadFileDir, 0777, true); // Buat folder jika belum ada
            }
            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
            $dest_path = $uploadFileDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                // Simpan data ke database
                $query = "INSERT INTO buku (nama_buku, kategori, cover_buku) VALUES ('$nama_buku', '$kategori', '$newFileName')";
                if ($conn->query($query)) {
                    header("Location: buku.php?success=1");
                } else {
                    echo "Error: " . $conn->error;
                }
            } else {
                echo "Gagal mengunggah file.";
            }
        } else {
            echo "Jenis file tidak valid. Hanya JPG, JPEG, PNG, dan GIF yang diperbolehkan.";
        }
    } else {
        echo "Tidak ada file yang diunggah.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku</title>
    <!-- Link Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Tambah Buku</h1>
        <form action="tambah_buku.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nama_buku" class="form-label">Judul Buku</label>
                <input type="text" class="form-control" id="nama_buku" name="nama_buku" required>
            </div>
            <div class="mb-3">
                <label for="penulis" class="form-label">Penulis</label>
                <input type="text" class="form-control" id="penulis" name="penulis" required>
            </div>
            <div class="mb-3">
                <label for="penerbit" class="form-label">Penerbit</label>
                <input type="text" class="form-control" id="penerbit" name="penerbit" required>
            </div>
            <div class="mb-3">
                <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
                <input type="number" class="form-control" id="tahun_terbit" name="tahun_terbit" required>
            </div>
            <div class="mb-3">
                <label for="kategori" class="form-label">Kategori</label>
                <input type="text" class="form-control" id="kategori" name="kategori" required>
            </div>
            <div class="mb-3">
                <label for="cover_buku" class="form-label">Cover Buku</label>
                <input type="file" class="form-control" id="cover_buku" name="cover_buku" accept="image/*" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="buku.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>

    <!-- Link Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
