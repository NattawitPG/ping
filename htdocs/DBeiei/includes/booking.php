<?php include 'db_connection.php'; ?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>จองตั๋ว | Dream World</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<h1>จองตั๋ว</h1>

<form action="process_booking.php" method="POST">
    <label>ชื่อ:</label>
    <input type="text" name="name" required>

    <label>จำนวนตั๋ว:</label>
    <input type="number" name="tickets" required>

    <button type="submit">จอง</button>
</form>

</body>
</html>
