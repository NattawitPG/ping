<?php
session_start();
include 'db_connection.php';

// ตรวจสอบการล็อกอิน
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// เพิ่มข้อมูลลูกค้า
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_customer'])) {
    $Name = $_POST['Name'];
    $Gender = $_POST['Gender'];
    $Date_of_Birth = $_POST['Date_of_Birth'];
    $User_ID = $_SESSION['user_id']; // ใช้ User_ID จาก session

    // SQL เพื่อเพิ่มข้อมูลลูกค้า
    $sql = "INSERT INTO customer (Name, Gender, Date_of_Birth, User_ID)
            VALUES ('$Name', '$Gender', '$Date_of_Birth', '$User_ID')";

    if (mysqli_query($conn, $sql)) {
        $success = "เพิ่มข้อมูลลูกค้าสำเร็จ!";
    } else {
        $error = "เกิดข้อผิดพลาดในการเพิ่มข้อมูลลูกค้า: " . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูลลูกค้า</title>
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
                <li><a href="logout.php">ออกจากระบบ</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h2>เพิ่มข้อมูลลูกค้า</h2>

        <!-- แสดงข้อความแจ้งเตือน -->
        <?php if (isset($success)): ?>
            <p style="color: green;"><?php echo $success; ?></p>
        <?php elseif (isset($error)): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>

        <!-- ฟอร์มเพิ่มข้อมูลลูกค้า -->
        <form action="customer.php" method="POST">
            <label for="Name">ชื่อ:</label>
            <input type="text" name="Name" required><br>

            <label for="Gender">เพศ:</label>
            <select name="Gender" required>
                <option value="Male">ชาย</option>
                <option value="Female">หญิง</option>
                <option value="Other">อื่นๆ</option>
            </select><br>

            <label for="Date_of_Birth">วันเกิด:</label>
            <input type="date" name="Date_of_Birth" required><br>

            <button type="submit" name="add_customer">เพิ่มลูกค้า</button>
        </form>
    </main>

    <footer>
        <p>&copy; 2025 Dreamworld Thailand. All rights reserved.</p>
    </footer>
</body>
</html>
