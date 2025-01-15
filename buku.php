<?php
include 'service/db.php';
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit();
}

//Seach query ;)
$searchQuery = "";
if (isset($_GET['search'])) {
    $searchQuery = $_GET['search'];
    $query = "SELECT * FROM buku WHERE nama_buku LIKE '%$searchQuery%' OR kategori LIKE '%$searchQuery%'";
} else {
    $query = "SELECT * FROM buku";
}

$result = $conn->query($query);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .book-card {
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 8px;
            background-color: #f9f9f9;
        }

        .book-card img {
            width: 100%;
            height: auto;
            border-radius: 5px;
        }

        .book-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }
    </style>
</head>

<body>
    <div class="container mt-3">
        <a href="dashboard.php" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>
    <div class="container mt-5">
        <h3 class="text-center">Daftar Buku</h3>
        <form method="GET" action="">
            <div class="d-flex justify-content-center align-items-center mb-3">
                <input type="text" class="form-control w-50" name="search" placeholder="Cari buku..." value="<?php echo htmlspecialchars($searchQuery); ?>">
                <button type="submit" class="btn btn-outline-primary ms-2">Cari</button>
            </div>
        </form>

        <!-- List/Grid Container -->
        <div id="book-container" class="book-grid">
            <?php while ($row = $result->fetch_assoc()) : ?>
                <!-- Card Buku -->
                <div class="book-card" data-bs-toggle="modal" data-bs-target="#modal<?php echo $row['id_buku']; ?>">
                    <img src="uploads/<?php echo $row['cover_buku']; ?>" alt="Cover Buku">
                    <h5 class="mt-2"><?php echo $row['nama_buku']; ?></h5>
                    <p class="book-category"><?php echo $row['kategori']; ?></p>
                    <a href="edit_buku.php?id_buku=<?php echo $row['id_buku']; ?>" class="btn btn-primary">Edit</a>
                    <a href="hapus_buku.php?id_buku=<?php echo $row['id_buku']; ?>" class="btn btn-danger">Hapus</a>
                </div>

                <!-- Modal untuk Buku -->
                <div class="modal fade" id="modal<?php echo $row['id_buku']; ?>" tabindex="-1" aria-labelledby="modalLabel<?php echo $row['id_buku']; ?>" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalLabel<?php echo $row['id_buku']; ?>"><?php echo $row['nama_buku']; ?></h5>
                            </div>
                            <div class="modal-body">
                                <img src="uploads/<?php echo $row['cover_buku']; ?>" class="img-fluid mb-3" alt="Cover Buku">
                                <p><strong>Deskripsi:</strong> <?php echo $row['deskripsi']; ?></p>
                                <p><strong>Penulis:</strong> <?php echo $row['penulis']; ?></p>
                                <p><strong>Penerbit:</strong> <?php echo $row['penerbit']; ?></p>
                                <p><strong>Tahun Terbit:</strong> <?php echo $row['tahun_terbit']; ?></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>