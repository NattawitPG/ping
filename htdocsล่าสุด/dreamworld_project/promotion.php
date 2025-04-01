<?php
session_start();
include 'db_connection.php';

// ตรวจสอบการล็อกอิน
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// เพิ่มข้อมูลโปรโมชั่น
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_promotion'])) {
    $Name_promotion = $_POST['Name_promotion'];
    $Discount_Amount = $_POST['Discount_Amount'];
    $Promo_Condition = $_POST['Promo_Condition'];
    $Note = $_POST['Note'];
    $Promo_Start_Date = $_POST['Promo_Start_Date'];
    $Promo_End_Date = $_POST['Promo_End_Date'];

    // SQL เพื่อเพิ่มข้อมูลโปรโมชั่น
    $sql = "INSERT INTO promotion (Name_promotion, Discount_Amount, Promo_Condition, Note, Promo_Start_Date, Promo_End_Date)
            VALUES ('$Name_promotion', '$Discount_Amount', '$Promo_Condition', '$Note', '$Promo_Start_Date', '$Promo_End_Date')";

    if (mysqli_query($conn, $sql)) {
        $success = "เพิ่มโปรโมชั่นสำเร็จ!";
    } else {
        $error = "เกิดข้อผิดพลาดในการเพิ่มโปรโมชั่น: " . mysqli_error($conn);
    }
}

// ดึงข้อมูลโปรโมชั่นทั้งหมด
$sql_get_promotions = "SELECT * FROM promotion";
$result = mysqli_query($conn, $sql_get_promotions);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูลโปรโมชั่น</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="logo">
            <a href="index.php"><img src="https://www.dreamworld.co.th/_nuxt/logo._K9FGnFb.webp" alt="Dreamworld Logo"></a>
        </div>
        <nav>
            <ul>
                <li><a href="amusement_ride.php">ข้อมูลเครื่องเล่น</a></li>
                <li><a href="employee.php">ข้อมูลพนักงาน</a></li>
                <li><a href="promotion.php">โปรโมชัน</a></li>
                <li><a href="use_of_ride.php">การใช้เครื่องเล่น</a></li>
                <li><a href="index.php">หน้าแรก</a></li>
                <li><a href="logout.php">ออกจากระบบ</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h2>ข้อมูลโปรโมชั่น</h2>

        <!-- แสดงข้อความแจ้งเตือน -->
        <?php if (isset($success)): ?>
            <p style="color: green;"><?php echo $success; ?></p>
        <?php elseif (isset($error)): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>

        <!-- ตารางข้อมูลโปรโมชั่น -->
        <table border="1">
            <thead>
                <tr>
                    <th>รหัสโปรโมชั่น</th>
                    <th>ชื่อโปรโมชั่น</th>
                    <th>จำนวนส่วนลด</th>
                    <th>เงื่อนไขโปรโมชั่น</th>
                    <th>หมายเหตุ</th>
                    <th>วันที่เริ่มโปรโมชั่น</th>
                    <th>วันที่สิ้นสุดโปรโมชั่น</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo $row['Promotion_ID']; ?></td>
                        <td><?php echo $row['Name_promotion']; ?></td>
                        <td><?php echo $row['Discount_Amount']; ?></td>
                        <td><?php echo $row['Promo_Condition']; ?></td>
                        <td><?php echo $row['Note']; ?></td>
                        <td><?php echo $row['Promo_Start_Date']; ?></td>
                        <td><?php echo $row['Promo_End_Date']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <!-- ฟอร์มเพิ่มข้อมูลโปรโมชั่น -->
        <h2>เพิ่มข้อมูลโปรโมชั่นใหม่</h2>
        <form action="promotion.php" method="POST">
            <label for="Name_promotion">ชื่อโปรโมชั่น:</label>
            <input type="text" name="Name_promotion" required><br>

            <label for="Discount_Amount">จำนวนส่วนลด:</label>
            <input type="text" name="Discount_Amount" required><br>

            <label for="Promo_Condition">เงื่อนไขโปรโมชั่น:</label>
            <textarea name="Promo_Condition" required></textarea><br>

            <label for="Note">หมายเหตุ:</label>
            <textarea name="Note"></textarea><br>

            <label for="Promo_Start_Date">วันที่เริ่มโปรโมชั่น:</label>
            <input type="date" name="Promo_Start_Date" required><br>

            <label for="Promo_End_Date">วันที่สิ้นสุดโปรโมชั่น:</label>
            <input type="date" name="Promo_End_Date" required><br>

            <button type="submit" name="add_promotion">เพิ่มโปรโมชั่น</button>
        </form>
    </main>

    <footer>
        <p>&copy; 2025 Dreamworld Thailand. All rights reserved.</p>
    </footer>
</body>
</html>
