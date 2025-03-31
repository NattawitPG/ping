<?php include 'db_connection.php'; ?>

<form action="process_register.php" method="POST">
    <label>ชื่อ:</label>
    <input type="text" name="name" required>

    <label>Email:</label>
    <input type="email" name="email" required>

    <label>Password:</label>
    <input type="password" name="password" required>

    <button type="submit">สมัครสมาชิก</button>
</form>
