<?php include 'db_connection.php'; ?>

<form action="process_login.php" method="POST">
    <label>Email:</label>
    <input type="email" name="email" required>
    
    <label>Password:</label>
    <input type="password" name="password" required>

    <button type="submit">เข้าสู่ระบบ</button>
</form>
