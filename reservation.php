<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = htmlspecialchars(trim($_POST['name']));
    $alamat = htmlspecialchars(trim($_POST['address']));
    $no_telp = htmlspecialchars(trim($_POST['phone']));
    $email = htmlspecialchars(trim($_POST['email']));

    $tanggal_checkin = $_POST['checkin'];
    $tanggal_checkout = $_POST['checkout'];
    $jumlah_tamu = intval($_POST['guests']);
    $status_reservasi = htmlspecialchars($_POST['status']);
    $total_biaya = floatval($_POST['total']);

    $tipe_kamar = htmlspecialchars($_POST['room_type']);
    $kapasitas = $jumlah_tamu;
    $nomor = intval($_POST['room_number']);
    $lantai = intval($_POST['floor_number']);

    $conn->begin_transaction();

    try {
        $sql_guest = "INSERT INTO guest (nama, alamat, no_telp, email) VALUES (?, ?, ?, ?)";
        $stmt_guest = $conn->prepare($sql_guest);
        $stmt_guest->bind_param("ssss", $nama, $alamat, $no_telp, $email);
        $stmt_guest->execute();
        $id_tamu = $conn->insert_id; 

        $sql_room = "INSERT INTO room (tipe_kamar, kapasitas, nomor, lantai) VALUES (?, ?, ?, ?)";
        $stmt_room = $conn->prepare($sql_room);
        $stmt_room->bind_param("siii", $tipe_kamar, $kapasitas, $nomor, $lantai);
        $stmt_room->execute();
        $id_kamar = $conn->insert_id; 

        $sql_reservasi = "INSERT INTO reservasi (id_tamu, id_kamar, tanggal_checkin, tanggal_checkout, jumlah_tamu, status_reservasi, total_biaya) 
                          VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt_reservasi = $conn->prepare($sql_reservasi);
        $stmt_reservasi->bind_param("iissisd", $id_tamu, $id_kamar, $tanggal_checkin, $tanggal_checkout, $jumlah_tamu, $status_reservasi, $total_biaya);
        $stmt_reservasi->execute();

        $conn->commit();
        echo "<script>alert('Data berhasil disimpan.'); window.location.href = 'reservation.php';</script>";
    } catch (Exception $e) {
        $conn->rollback();
        echo "<script>alert('Terjadi kesalahan: " . addslashes($e->getMessage()) . "'); window.history.back();</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation</title>
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
        h2{
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
            <h1>Reservation Form</h1>
        </div>

        <div class="form-container">
            <form id="reservation-form" action="" method="POST">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" placeholder="Enter your full name" required>

                <label for="address">Address</label>
                <input type="text" id="address" name="address" placeholder="Enter your address" required>

                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" required>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>

                <label for="checkin">Check-in Date</label>
                <input type="date" id="checkin" name="checkin" required>

                <label for="checkout">Check-out Date</label>
                <input type="date" id="checkout" name="checkout" required>

                <label for="guests">Number of Guests</label>
                <input type="number" id="guests" name="guests" placeholder="Enter number of guests" required>

                <label for="room_number">Room Number</label>
                <select id="room_number" name="room_number" required>
                    <?php for ($i = 1; $i <= 15; $i++): ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php endfor; ?>
                </select>

                <label for="floor_number">Floor Number</label>
                <select id="floor_number" name="floor_number" required>
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php endfor; ?>
                </select>

                <label for="room_type">Room Type</label>
                <select id="room_type" name="room_type" required>
                    <option value="">Select Room Type</option>
                    <option value="single">Single</option>
                    <option value="double">Double</option>
                    <option value="suite">Suite</option>
                </select>

                <div id="room-description" class="room-description">
                    <p id="description-text"></p>
                </div>

                <label for="status">Reservation Status</label>
                <select id="status" name="status">
                    <option value="confirmed">Confirmed</option>
                    <option value="pending">Pending</option>
                    <option value="cancelled">Cancelled</option>
                </select>

                <label for="total">Total Cost</label>
                <input type="number" id="total" name="total" placeholder="Enter total cost" required>

                <button type="submit">Submit Reservasi</button>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('room_type').addEventListener('change', function() {
            var roomType = this.value;
            var descriptionText = document.getElementById('description-text');
            var roomDescription = document.getElementById('room-description');

            if (roomType === 'single') {
                descriptionText.textContent = 'Single bedroom yang cocok untuk liburan dan menikmati suasana alam';
            } else if (roomType === 'double') {
                descriptionText.textContent = 'Double bedroom cocok untuk pasangan yang baru menikah dan yang ingin berbulan madu';
            } else if (roomType === 'suite') {
                descriptionText.textContent = 'Suite room dengan akses premium untuk kafe dan bar';
            } else {
                descriptionText.textContent = '';
            }
            roomDescription.style.display = roomType ? 'block' : 'none';
        });
    </script>
</body>
</html>
