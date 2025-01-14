<?php
include 'koneksi.php';

$id_reservasi = $_GET['id_reservasi'];

$delete_sql = "DELETE FROM reservasi WHERE id_reservasi = $id_reservasi";

if ($conn->query($delete_sql) === TRUE) {
    echo "<script>alert('Data berhasil dihapus!'); window.location.href='rooms.php';</script>";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();