<?php  
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Website</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color:rgb(255, 255, 255);
            color: #333;
        }
        .header {
            background-color:rgb(0, 92, 3);
            color: white;
            text-align: center;
            padding: 1em 0;
        }
        .container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            padding: 2em;
        }
        .feature-box {
            background-color: #F4F4F4;
            border: 1px solid #ddd;
            border-radius: 8px;
            width: 250px;
            margin: 1em;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            padding: 1.5em;
        }
        .feature-box h3 {
            margin: 0.5em 0;
        }
        .feature-box p {
            font-size: 0.9em;
            color: #666;
        }
        .feature-box button {
            background-color:rgb(74, 207, 78);
            color: white;
            border: none;
            padding: 0.7em 1.2em;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
        }
        .feature-box button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Welcome to Our Hotel</h1>
        <p>Kenyamanan Anda Prioritas Kami</p>
    </div>

    <div class="container">
        <!-- Reservation Feature -->
        <div class="feature-box">
            <h3>Reservation</h3>
            <p>Pesan Sekarang dan nikmati pengalaman hotel yang tak terlupakan.</p>
            <button onclick="location.href='reservation.php'">Reservasi Sekarang</button>
        </div>

        <!-- Room List Feature -->
        <div class="feature-box">
            <h3>Room List</h3>
            <p>Eksplor variasi ruangan yang sedang trend.</p>
            <button onclick="location.href='rooms.php'">Eksplor Ruangan</button>
        </div>

        <!-- Contact Feature -->
        <div class="feature-box">
            <h3>Contact</h3>
            <p>Hubungi kami jika anda perlu bantuan lebih lanjut.</p>
            <button onclick="location.href='contact.php'">Kontak Kami</button>
        </div>
    </div>
</body>
</html>
