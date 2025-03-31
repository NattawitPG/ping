<?php
session_start();
include 'db_connection.php';

// ตรวจสอบว่าได้ส่งฟอร์มแล้วหรือไม่
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // ตรวจสอบว่า Name และ Password ถูกตั้งค่าแล้ว
    if (isset($_POST['Name']) && isset($_POST['password'])) {
        $Name = mysqli_real_escape_string($conn, $_POST['Name']); // ป้องกัน SQL Injection
        $password = $_POST['password'];

        // ตรวจสอบข้อมูลในฐานข้อมูล
        $sql = "SELECT * FROM user_account WHERE Name = '$Name'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);

            // ตรวจสอบรหัสผ่านโดยใช้ password_verify
            if (password_verify($password, $user["Password"])) {
                // ตั้งค่า session เมื่อเข้าสู่ระบบสำเร็จ
                $_SESSION['Name'] = $user['Name'];
                $_SESSION['user_id'] = $user['User_ID']; // ใช้ User_ID ในการเก็บข้อมูลของผู้ใช้

                // เปลี่ยนเส้นทางไปที่หน้าแรก
                header("Location: index.php");
                exit();
            } else {
                $error = "ชื่อผู้ใช้งานหรือรหัสผ่านไม่ถูกต้อง";
            }
        } else {
            $error = "ชื่อผู้ใช้งานหรือรหัสผ่านไม่ถูกต้อง";
        }
    } else {
        $error = "กรุณากรอกข้อมูลให้ครบถ้วน";
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เข้าสู่ระบบ - Dreamworld Thailand</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
    <div class="logo">
        <a href="index.php"><img src="https://www.dreamworld.co.th/_nuxt/logo._K9FGnFb.webp" alt="Dreamworld Logo"></a>
    </div>
        <nav>
            <ul>
                <li><a href="index.php">หน้าแรก</a></li>
                <li><a href="register.php">สมัครสมาชิก</a></li>
                <li><a href="login.php">เข้าสู่ระบบ</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="form-section">
            <h2>เข้าสู่ระบบ</h2>
            <form action="login.php" method="POST">
                <label for="Name">ชื่อผู้ใช้งาน:</label>
                <input type="text" id="Name" name="Name" required>

                <label for="password">รหัสผ่าน:</label>
                <input type="password" id="password" name="password" required>

                <button type="submit">เข้าสู่ระบบ</button>
            </form>

            <?php if (isset($error)) { echo "<p style='color: red;'>$error</p>"; } ?>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Dreamworld Thailand. All rights reserved.</p>
    </footer>
</body>
</html>
<?php
// ตัวอย่างการซ่อนข้อความ "Connected successfully"
if (isset($connected) && $connected === true) {
    // ปิดการแสดงผลข้อความ
}
?>