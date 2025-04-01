<?php
session_start();
include 'db_connection.php';

// ตรวจสอบว่า admin ได้ล็อกอินหรือไม่
if (!isset($_SESSION['Name']) || $_SESSION['Name'] == "") {
    header('Location: login.php'); // หากไม่ใช่ admin จะกลับไปที่หน้า login
    exit();
}

// ดึงข้อมูลพนักงานจากฐานข้อมูล (หรือตารางที่ต้องการ)
$sql = "SELECT * FROM employee"; // ใช้ SELECT ตามตารางที่ต้องการ
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แดชบอร์ดของ Admin</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>ยินดีต้อนรับ, Admin</h1>
        <nav>
            <ul>
                <li><a href="index.php">หน้าแรก</a></li>
                <li><a href="employee.php">ข้อมูลพนักงาน</a></li>
                <li><a href="logout.php">ออกจากระบบ</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h2>ข้อมูลพนักงาน</h2>
        <table border="1">
            <thead>
                <tr>
                    <th>Employee_ID</th>
                    <th>ชื่อ</th>
                    <th>เงินเดือน</th>
                    <th>แผนก</th>
                    <th>ตำแหน่ง</th>
                    <th>Ride_ID</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo $row['Employee_ID']; ?></td>
                        <td><?php echo $row['Name']; ?></td>
                        <td><?php echo $row['Salary']; ?></td>
                        <td><?php echo $row['Department']; ?></td>
                        <td><?php echo $row['Position']; ?></td>
                        <td><?php echo $row['Ride_ID']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </main>
</body>
</html>
