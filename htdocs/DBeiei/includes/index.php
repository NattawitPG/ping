<?php include('db_connection.php'); ?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dream World Clone</title>
    <link rel="stylesheet" href="assets/style.css">  <!-- ตรวจสอบให้แน่ใจว่า path ของไฟล์ style.css ถูกต้อง -->
</head>
<body>
    <header>
        <nav class="navbar">  <!-- เพิ่ม class navbar ที่นี่ -->
            <ul>
                <li><a href="index.php">หน้าแรก</a></li>
                <li><a href="rides.php">เครื่องเล่น</a></li>
                <li><a href="booking.php">จองตั๋ว</a></li>
                <li><a href="contact.php">ติดต่อเรา</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="logout.php">ออกจากระบบ</a></li>
                <?php else: ?>
                    <li><a href="login.php">เข้าสู่ระบบ</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <section>
        <h1>ยินดีต้อนรับสู่ Dream World</h1>
        <h2>สนุกที่สุดในประเทศไทย!</h2>
        <p>มาสนุกไปกับเครื่องเล่นสุดมันส์และโปรโมชันพิเศษ</p>
    </section>
</body>
</html>
