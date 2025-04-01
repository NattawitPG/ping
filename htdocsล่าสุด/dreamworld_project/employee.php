<?php
session_start();
include 'db_connection.php';

// ตรวจสอบการล็อกอิน
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// เพิ่มข้อมูลพนักงาน
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_employee'])) {
    $Name = $_POST['Name'];
    $Salary = $_POST['Salary'];
    $Department = $_POST['Department'];
    $Position = $_POST['Position'];
    $Ride_ID = $_POST['Ride_ID'];

    // ตรวจสอบว่า Ride_ID ที่ป้อนมีอยู่ในตาราง amusement_ride หรือไม่
    $check_ride_query = "SELECT * FROM amusement_ride WHERE Ride_ID = '$Ride_ID'";
    $ride_result = mysqli_query($conn, $check_ride_query);

    if (mysqli_num_rows($ride_result) > 0) {
        // SQL เพื่อเพิ่มข้อมูล
        $sql = "INSERT INTO employee (Name, Salary, Department, Position, Ride_ID)
                VALUES ('$Name', '$Salary', '$Department', '$Position', '$Ride_ID')";

        if (mysqli_query($conn, $sql)) {
            $success = "เพิ่มข้อมูลพนักงานสำเร็จ!";
        } else {
            $error = "เกิดข้อผิดพลาดในการเพิ่มข้อมูล: " . mysqli_error($conn);
        }
    } else {
        $error = "ไม่พบ Ride_ID นี้ในตาราง amusement_ride";
    }
}

// ดึงข้อมูลพนักงานทั้งหมด
$sql_get_employees = "SELECT * FROM employee";
$result = mysqli_query($conn, $sql_get_employees);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูลพนักงาน</title>
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
        <h2>ข้อมูลพนักงาน</h2>

        <!-- แสดงข้อความแจ้งเตือน -->
        <?php if (isset($success)): ?>
            <p style="color: green;"><?php echo $success; ?></p>
        <?php elseif (isset($error)): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>

        <!-- ตารางข้อมูลพนักงาน -->
        <table border="1">
            <thead>
                <tr>
                    <th>รหัสพนักงาน</th>
                    <th>ชื่อ</th>
                    <th>เงินเดือน</th>
                    <th>แผนก</th>
                    <th>ตำแหน่ง</th>
                    <th>รหัสเครื่องเล่น</th>
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

        <!-- ฟอร์มเพิ่มข้อมูลพนักงาน -->
        <h2>เพิ่มข้อมูลพนักงานใหม่</h2>
        <form action="employee.php" method="POST">
            <label for="Name">ชื่อพนักงาน:</label>
            <input type="text" name="Name" required><br>

            <label for="Salary">เงินเดือน:</label>
            <input type="text" name="Salary" required><br>

            <label for="Department">แผนก:</label>
            <input type="text" name="Department" required><br>

            <label for="Position">ตำแหน่ง:</label>
            <input type="text" name="Position" required><br>

            <label for="Ride_ID">รหัสอุปกรณ์:</label>
            <input type="text" name="Ride_ID" required><br>

            <button type="submit" name="add_employee">เพิ่มพนักงาน</button>
        </form>
    </main>

    <footer>
        <p>&copy; 2025 Dreamworld Thailand. All rights reserved.</p>
    </footer>
</body>
</html>
