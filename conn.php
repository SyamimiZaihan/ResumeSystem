<?php
// Sambungan ke pangkalan data
$servername = "localhost"; // Ganti dengan nama server MySQL anda
$username = "root";        // Ganti dengan nama pengguna MySQL anda
$password = "";            // Ganti dengan kata laluan MySQL anda
$dbname = "resume_system";     // Nama pangkalan data anda

// Buat sambungan
$conn = new mysqli($servername, $username, $password, $dbname);

// Semak sambungan
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
