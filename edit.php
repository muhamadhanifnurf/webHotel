<?php
include 'koneksi.php'; 

$id_reservasi = $_GET['id_reservasi'];

$sql = "SELECT r.id_reservasi, g.nama, rm.nomor, rm.tipe_kamar, r.status_reservasi, rm.lantai
        FROM reservasi r
        JOIN guest g ON r.id_tamu = g.id_tamu
        JOIN room rm ON r.id_kamar = rm.id_kamar
        WHERE r.id_reservasi = $id_reservasi";

$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_tamu = $_POST['name'];
    $nomor_kamar = $_POST['room_number'];
    $tipe_kamar = $_POST['room_type'];
    $status_reservasi = $_POST['status'];
    $lantai = $_POST['floor_number'];

    $update_sql = "UPDATE reservasi r
                   JOIN guest g ON r.id_tamu = g.id_tamu
                   JOIN room rm ON r.id_kamar = rm.id_kamar
                   SET g.nama = '$nama_tamu', rm.nomor = '$nomor_kamar', rm.tipe_kamar = '$tipe_kamar', r.status_reservasi = '$status_reservasi', rm.lantai = '$lantai'
                   WHERE r.id_reservasi = $id_reservasi";
    
    if ($conn->query($update_sql) === TRUE) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location.href='rooms.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Reservation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
            display: flex;
        }
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
        .content {
            margin-left: 270px;
            padding: 2em;
            flex-grow: 1;
        }
        .header {
            text-align: center;
            margin-bottom: 2em;
        }
        .form-container {
            background-color: white;
            padding: 2em;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
        }
        .form-container form {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5em;
        }
        .form-container label {
            font-weight: bold;
        }
        .form-container input, .form-container select {
            width: calc(100% - 1.6em);
            padding: 0.8em;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1em;
        }
        .form-container button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 1em 1.5em;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
            width: 100%;
        }
        .form-container button:hover {
            background-color: #45a049;
        }
        .room-description {
            margin-top: 1em;
            padding: 1em;
            background-color: #f9f9f9;
            border-radius: 5px;
            border: 1px solid #ccc;
            display: none;
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
            <h1>Edit Reservation</h1>
        </div>

        <div class="form-container">
            <form id="reservation-form" action="edit.php?id_reservasi=<?php echo $id_reservasi; ?>" method="POST">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($row['nama']); ?>" required>

                <label for="room_number">Room Number</label>
                <select id="room_number" name="room_number" required>
                    <?php for ($i = 1; $i <= 15; $i++): ?>
                        <option value="<?php echo $i; ?>" <?php echo ($row['nomor'] == $i) ? 'selected' : ''; ?>><?php echo $i; ?></option>
                    <?php endfor; ?>
                </select>

                <label for="floor_number">Floor Number</label>
                <select id="floor_number" name="floor_number" required>
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <option value="<?php echo $i; ?>" <?php echo ($row['lantai'] == $i) ? 'selected' : ''; ?>><?php echo $i; ?></option>
                    <?php endfor; ?>
                </select>

                <label for="room_type">Room Type</label>
                <select id="room_type" name="room_type" required>
                    <option value="single" <?php echo ($row['tipe_kamar'] == 'single') ? 'selected' : ''; ?>>Single</option>
                    <option value="double" <?php echo ($row['tipe_kamar'] == 'double') ? 'selected' : ''; ?>>Double</option>
                    <option value="suite" <?php echo ($row['tipe_kamar'] == 'suite') ? 'selected' : ''; ?>>Suite</option>
                </select>

                <label for="status">Reservation Status</label>
                <select id="status" name="status" required>
                    <option value="confirmed" <?php echo ($row['status_reservasi'] == 'confirmed') ? 'selected' : ''; ?>>Confirmed</option>
                    <option value="pending" <?php echo ($row['status_reservasi'] == 'pending') ? 'selected' : ''; ?>>Pending</option>
                    <option value="cancelled" <?php echo ($row['status_reservasi'] == 'cancelled') ? 'selected' : ''; ?>>Cancelled</option>
                </select>

                <button type="submit">Save Changes</button>
            </form>
        </div>
    </div>

</body>
</html>

<?php
$conn->close();
?>
