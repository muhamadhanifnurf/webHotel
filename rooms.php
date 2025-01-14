<?php
include 'koneksi.php';

$sql = "SELECT r.id_reservasi, g.nama, rm.nomor, rm.tipe_kamar, r.status_reservasi, rm.lantai
        FROM reservasi r
        JOIN guest g ON r.id_tamu = g.id_tamu
        JOIN room rm ON r.id_kamar = rm.id_kamar";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kamar</title>
    <style>
        .navbar {
            background-color: rgb(0, 92, 3);
            width: 250px;
            height: 100vh;
            padding: 1em;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            position: fixed;
        }
        .navbar a {
            display: block;
            color: white;
            text-decoration: none;
            margin: 1em 0;
            padding: 0.5em;
            border-radius: 5px;
            text-align: center;
        }
        .navbar a:hover {
            background-color: #45a049;
        }
        h2 {
            color: white;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .content {
            margin-left: 270px;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 2em;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        td button {
            padding: 6px 12px;
            margin: 0 5px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .edit-btn {
            background-color: #4CAF50;
            color: white;
        }
        .delete-btn {
            background-color: #f44336;
            color: white;
        }
        .edit-btn:hover {
            background-color: #45a049;
        }
        .delete-btn:hover {
            background-color: #e53935;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h2>Menu</h2>
        <a href="index.php">Home</a>
        <a href="reservation.php">Reservations</a>
        <a href="rooms.php">List of Rooms</a>
        <a href="contact.php">Contact</a>
    </div>
    <div class="content">
        <div class="header">
            <h1>List Room</h1>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Nama Tamu</th>
                    <th>Nomor Kamar</th>
                    <th>Tipe Kamar</th>
                    <th>Status</th>
                    <th>Lantai</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) { 
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['nomor']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['tipe_kamar']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['status_reservasi']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['lantai']) . "</td>";
                        echo "<td>
                            <a href='edit.php?id_reservasi=" . $row['id_reservasi'] . "'>
                            <button class='edit-btn'>Edit</button>
                            </a>
                            <a href='delete.php?id_reservasi=" . $row['id_reservasi'] . "' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\");'>
                            <button class='delete-btn'>Delete</button>
                            </a>
                            </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Tidak ada data kamar.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
$conn->close(); 
?>
