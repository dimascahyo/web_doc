<?php
session_start();

// Inisialisasi counter
if (!isset($_SESSION['counter'])) {
    $_SESSION['counter'] = 0;
}

// Menggabungkan ke database
$host = "localhost";
$username = "root";
$password = "";
$database = "db_dok";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kode = $_GET['kode'];
    $counter = $_SESSION['counter'] + 1;
    $_SESSION['counter'] = $counter;

    $gambar = $_FILES['gambar'];
    $keterangan = $_POST['keterangan'];

    $nama_gambar = $kode . '-gbr' . $counter . '.png';
    $kode_gambar = $kode . '-gbrket' . $counter . '.png';
    // Upload gambar ke server
    $target_directory = "../upload/dokumentasi/"; // Folder untuk menyimpan gambar
    $target_file = $target_directory . basename($nama_gambar);

    if (move_uploaded_file($gambar['tmp_name'], $target_file)) {
        // Gambar berhasil diunggah
        $kode_ket = $kode . '-ket' . $counter;
        $queryGbr = "INSERT INTO gbr_langkah (kode, nama) VALUES ('$kode_gambar', '$nama_gambar')";
        $queryKet = "INSERT INTO ket_langkah (kode, keterangan) VALUES ('$kode_ket', '$keterangan')";
        
        if ($conn->query($queryGbr) === TRUE && $conn->query($queryKet) === TRUE) {
            // Data berhasil disimpan
            $response = "Data berhasil disimpan.";
        } else {
            $response = "Gagal menyimpan data ke database: " . $conn->error;
        }
    } else {
        $response = "Gagal mengunggah gambar.";
    }
}

if (isset($_POST['selesai'])) {
    // Menghancurkan sesi
    session_destroy();
    $_SESSION['counter'] = 0;
    $counter = 0;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Form Tutorial</title>
    <link rel="stylesheet" type="text/css" href="../style/form_tutorial.css">
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const simpanButton = document.getElementById("simpan");
            const selesaiButton = document.getElementById("selesai");
            const counterElement = document.getElementById("counter");
            const responseElement = document.getElementById("response");
            const gambarInput = document.querySelector("input[name='gambar']");
            const keteranganInput = document.querySelector("textarea[name='keterangan']");

            // Tindakan saat tombol "Simpan" ditekan
            simpanButton.addEventListener("click", function (e) {
                if (!gambarInput.files.length || keteranganInput.value.trim() === "") {
                    // Menampilkan pesan kesalahan jika salah satu input kosong
                    e.preventDefault(); // Mencegah pengiriman form
                    responseElement.textContent = "Harap isi kedua input.";
                } else {
                    // Menampilkan popup sukses dengan counter
                    const counter = counterElement.textContent.split(" ")[1]; // Mendapatkan nilai counter
                    const successMessage = `Langkah ${counter} berhasil dimasukkan.`;
                    alert(successMessage); // Menampilkan popup

                    // Anda juga dapat menambahkan logika lain di sini, seperti mengatur pesan pada responseElement.
                }
            });

            // Tindakan saat tombol "Selesai" ditekan
            selesaiButton.addEventListener("click", function () {
                window.location.href = "index.php"; // Mengarahkan ke halaman index.php
            });
        });
    </script>

</head>
<body>
    <header>
        <h1>Form Tutorial</h1>
        <p id="counter">Langkah ke-<?php echo $_SESSION['counter']; ?></p>
    </header>
    <form action="<?php echo $_SERVER['PHP_SELF'] . '?kode=' . $_GET['kode']; ?>" method="post" enctype="multipart/form-data">
        <div class="form-part">
            <input type="file" name="gambar" accept="image/*">
            <textarea name="keterangan" placeholder="Keterangan"></textarea>
        </div>
        <button type="submit" name="simpan" id="simpan">Simpan</button>
    </form>
    <button id="selesai">Selesai</button>
    <div id="response"><?php echo isset($response) ? $response : ''; ?></div>
</body>
</html>
