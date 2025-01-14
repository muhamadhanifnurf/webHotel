<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
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
            <h1>Contact Us</h1>
        </div>
        <div class="form-container">
            <form action="send_email.php" method="POST">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" placeholder="Enter your name" required>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>

                <label for="message">Message</label>
                <input type="text" id="message" name="message" placeholder="Enter your message" required></input>

                <button type="submit">Send Message</button>
            </form>
        </div>
    </div>
</body>
</html>
