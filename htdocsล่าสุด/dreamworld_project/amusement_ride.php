<?php
session_start();
include 'db_connection.php';

// ตรวจสอบการล็อกอิน
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// เพิ่มข้อมูลเครื่องเล่น
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_ride'])) {
    $Ride_Name = $_POST['Ride_Name'];
    $Date_Purchase = $_POST['Date_Purchase'];
    $Type = $_POST['Type'];
    $Max_Capacity = $_POST['Max_Capacity'];
    $Open_Time = $_POST['Open_Time'];
    $Close_Time = $_POST['Close_Time'];
    $Ride_Condition = $_POST['Ride_Condition'];

    // SQL เพื่อเพิ่มข้อมูลเครื่องเล่น
    $sql = "INSERT INTO amusement_ride (Ride_Name, Date_Purchase, Type, Max_Capacity, Open_Time, Close_Time, Ride_Condition)
            VALUES ('$Ride_Name', '$Date_Purchase', '$Type', '$Max_Capacity', '$Open_Time', '$Close_Time', '$Ride_Condition')";

    if (mysqli_query($conn, $sql)) {
        $success = "เพิ่มข้อมูลเครื่องเล่นสำเร็จ!";
    } else {
        $error = "เกิดข้อผิดพลาดในการเพิ่มข้อมูล: " . mysqli_error($conn);
    }
}

// ดึงข้อมูลเครื่องเล่นทั้งหมด
$sql_get_rides = "SELECT * FROM amusement_ride";
$result = mysqli_query($conn, $sql_get_rides);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูลเครื่องเล่น</title>
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
        <h2>ข้อมูลเครื่องเล่น</h2>

        <!-- แสดงข้อความแจ้งเตือน -->
        <?php if (isset($success)): ?>
            <p style="color: green;"><?php echo $success; ?></p>
        <?php elseif (isset($error)): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>

        <!-- ตารางข้อมูลเครื่องเล่น -->
        <table border="1">
            <thead>
                <tr>
                    <th>รหัสเครื่องเล่น</th>
                    <th>ชื่อเครื่องเล่น</th>
                    <th>วันที่ซื้อ</th>
                    <th>ประเภท</th>
                    <th>ความจุสูงสุด</th>
                    <th>เวลาเปิด</th>
                    <th>เวลาปิด</th>
                    <th>สถานะเครื่องเล่น</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo $row['Ride_ID']; ?></td>
                        <td><?php echo $row['Ride_Name']; ?></td>
                        <td><?php echo $row['Date_Purchase']; ?></td>
                        <td><?php echo $row['Type']; ?></td>
                        <td><?php echo $row['Max_Capacity']; ?></td>
                        <td><?php echo $row['Open_Time']; ?></td>
                        <td><?php echo $row['Close_Time']; ?></td>
                        <td><?php echo $row['Ride_Condition']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <!-- ฟอร์มเพิ่มข้อมูลเครื่องเล่น -->
        <h2>เพิ่มข้อมูลเครื่องเล่นใหม่</h2>
        <form action="amusement_ride.php" method="POST">
            <label for="Ride_Name">ชื่อเครื่องเล่น:</label>
            <input type="text" name="Ride_Name" required><br>

            <label for="Date_Purchase">วันที่ซื้อ:</label>
            <input type="date" name="Date_Purchase" required><br>

            <label for="Type">ประเภท:</label>
            <input type="text" name="Type" required><br>

            <label for="Max_Capacity">ความจุสูงสุด:</label>
            <input type="number" name="Max_Capacity" required><br>

            <label for="Open_Time">เวลาเปิด:</label>
            <input type="time" name="Open_Time" required><br>

            <label for="Close_Time">เวลาปิด:</label>
            <input type="time" name="Close_Time" required><br>

            <label for="Ride_Condition">สถานะเครื่องเล่น:</label>
            <input type="text" name="Ride_Condition" required><br>

            <button type="submit" name="add_ride">เพิ่มเครื่องเล่น</button>
        </form>
    </main>

    <footer>
        <p>&copy; 2025 Dreamworld Thailand. All rights reserved.</p>
    </footer>
</body>
</html>
