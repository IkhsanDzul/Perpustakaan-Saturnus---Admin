<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lupa Password - Perpustakaan Satoernus</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to bottom right, #34eb9b, #29a879);
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        .contact-container {
            max-width: 400px;
            width: 100%;
            padding: 2rem;
            background: white;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .contact-title {
            font-weight: bold;
            color: #333;
            margin-bottom: 1rem;
        }
        .contact-info {
            margin-bottom: 1rem;
        }
        .btn-whatsapp {
            background-color: #25D366;
            color: white;
            border: none;
        }
        .btn-whatsapp:hover {
            background-color: #1EBE5A;
        }
    </style>
</head>
<body>
    <div class="contact-container">
        <h4 class="contact-title">Lupa Password</h4>
        <p class="contact-info">Jika Anda lupa password, silakan hubungi Kepala Admin Perpustakaan melalui:</p>
        
        <!-- Contact Information -->
        <div class="mb-3">
            <strong>Email:</strong> <a href="mailto:kepalaadmin@perpustakaan.com">kepalaadmin@perpustakaan.com</a>
        </div>
        
        <div class="mb-4">
            <strong>WhatsApp:</strong> <a href="https://wa.me/6281234567890" target="_blank" class="text-decoration-none">+62 812-3456-7890</a>
        </div>
        
        <!-- Back to Login -->
        <a href="index.php" class="btn btn-primary w-100">Kembali ke Login</a>
    </div>
</body>
</html>
