<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "db_dok";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}

// Inisialisasi variabel
$judul = $kode = $upload_status = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cover = $_FILES['cover']['name'];
    $judul = $_POST['judul'];
    $kode = $_POST['kode'];

    // Upload gambar ke server (jika diperlukan)
    if (!empty($cover)) {
        $target_directory = "../upload/cover/"; // Folder untuk menyimpan gambar
        $cvr_filename = $kode.'_cvr'.'.png';
        $target_file = $target_directory . basename($cvr_filename);
        if (move_uploaded_file($_FILES["cover"]["tmp_name"], $target_file)) {
            // Gambar berhasil diunggah, Anda dapat menyimpan informasi ini ke database.
        } else {
            echo "Gagal mengunggah gambar.";
        }
    }

    // Simpan data ke database
    $sql = "INSERT INTO judul_dok (cover, judul, kode) VALUES ('$cvr_filename', '$judul', '$kode')";
    if ($conn->query($sql) === TRUE) {
        // Data berhasil disimpan ke database
        // Redirect ke halaman Form Tutorial dengan kode artikel
        header("Location: form_tutorial.php?kode=" . urlencode($kode));
    } else {
        echo "Gagal menyimpan data ke database: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Form Pembuatan Dokumentasi/Tutorial</title>
    <link rel="stylesheet" type="text/css" href="../style/home_admin.css">
</head>
<body>
    <header>
        <h1>Form Pembuatan Dokumentasi/Tutorial</h1>
    </header>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <div class="upload-status"><?php echo $upload_status; ?></div>
        <input type="file" name="cover" accept="image/*">
        <input type="text" name="judul" placeholder="Judul Artikel" value="<?php echo $judul; ?>">
        <input type="text" name="kode" placeholder="Kode Artikel" value="<?php echo $kode; ?>">
        <input type="submit" name="lanjutkan" value="Lanjutkan">
    </form>
</body>
</html>
