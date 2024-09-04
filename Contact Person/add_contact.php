<?php
include 'db.php';

$nama = $_POST['nama'];
$nim = $_POST['nim'];
$kelas = $_POST['kelas'];
$email = $_POST['email'];
$telepon = $_POST['telepon'];
$gender = $_POST['gender'];

$sql = "INSERT INTO kontak (nama, nim, kelas, email, telepon, gender) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssss", $nama, $nim, $kelas, $email, $telepon, $gender);

if ($stmt->execute()) {
    header("Location: index.php");
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
