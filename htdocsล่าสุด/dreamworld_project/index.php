<?php
echo '<link rel="stylesheet" href="css/styles.css">';
?>

<?php
ob_start();
include 'login.php';
$content = ob_get_clean();
$user = $_SESSION['Name'] ?? null;
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dreamworld Thailand</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Header -->
    <header>
    <div class="logo">
    <a href="index.php"><img src="https://www.dreamworld.co.th/_nuxt/logo._K9FGnFb.webp" alt="Dreamworld Logo"></a>
    </div>
        <nav>
            <ul>
                <li><a href="index.php">หน้าแรก</a></li>
                <li><a href="booking.php">จองตั๋ว</a></li>
                <li><a href=".php">เครื่องเล่น</a></li>

                <!-- ตรวจสอบว่าเข้าสู่ระบบหรือยัง -->
                <?php if ($user): ?>
                    <li><a href="logout.php">ออกจากระบบ</a></li>
                <?php else: ?>
                    <li><a href="login.php">เข้าสู่ระบบ</a></li>
                <?php endif; ?>

                <li><a href="register.php">สมัครสมาชิก</a></li>
            </ul>
        </nav>
    </header>

    <!-- Main Content -->
    <main>
        <section class="hero">
            <h1>ยินดีต้อนรับสู่ Dreamworld Thailand</h1>
            <?php if ($user): ?>
                <h2>สวัสดี, <?php echo htmlspecialchars($user); ?>!</h2>
            <?php endif; ?>
            <p>ความสนุกสุดขีดรอคุณอยู่ที่นี่!</p>
            <a href="booking.php" class="btn">จองตั๋วตอนนี้</a>
        </section>

        <section class="features">
            <h2>สิ่งที่คุณจะพบที่ Dreamworld</h2>
            <div class="feature">
                <h3>เครื่องเล่นสุดมันส์</h3>
                <p>เพลิดเพลินไปกับเครื่องเล่นสุดตื่นเต้นที่ Dreamworld</p>
            </div>
            <div class="feature">
                <h3>กิจกรรมพิเศษ</h3>
                <p>ร่วมสนุกกับกิจกรรมต่าง ๆ ที่จะทำให้คุณประทับใจ</p>
            </div>
            <div class="feature">
                <h3>โปรโมชั่นสุดพิเศษ</h3>
                <p>รับสิทธิพิเศษมากมายเมื่อจองตั๋วล่วงหน้า</p>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 Dreamworld Thailand. All rights reserved.</p>
    </footer>
</body>
</html>
