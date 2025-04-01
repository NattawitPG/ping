<?php
// เชื่อมต่อฐานข้อมูล
include 'db_connection.php';

// ดึงข้อมูลจากฐานข้อมูล
$sql = "SELECT * FROM use_of_ride";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ใช้เครื่องเล่น - Dreamworld Thailand</title>
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
                <li><a href="amusement_ride.php">ข้อมูลเครื่องเล่น</a></li>
                <li><a href="employee.php">ข้อมูลพนักงาน</a></li>
                <li><a href="promotion.php">โปรโมชัน</a></li>
                <li><a href="use_of_ride.php">การใช้เครื่องเล่น</a></li>
                <li><a href="index.php">หน้าแรก</a></li>
                <li><a href="logout.php">ออกจากระบบ</a></li>
            </ul>
        </nav>
    </header>

    <!-- Main Content -->
    <main>
     <h2>ข้อมูลการใช้เครื่องเล่น</h2>
            <table>
                <thead>
                    <tr>
                        <th>วันที่</th>
                        <th>เวลา</th>
                        <th>หมายเลขเครื่องเล่น</th>
                        <th>จำนวนผู้ใช้</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['Date']); ?></td>
                            <td><?php echo htmlspecialchars($row['Time']); ?></td>
                            <td><?php echo htmlspecialchars($row['Ride_ID']); ?></td>
                            <td><?php echo htmlspecialchars($row['Num_of_Users']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </section>

        <section class="form-section">
            <h2>กรอกข้อมูลการใช้เครื่องเล่นใหม่</h2>
            <form action="save_use_of_ride.php" method="POST">
                <label for="Date">วันที่:</label>
                <input type="date" id="Date" name="Date" required>

                <label for="Time">เวลา:</label>
                <input type="time" id="Time" name="Time" required>

                <label for="Ride_ID">หมายเลขเครื่องเล่น:</label>
                <input type="number" id="Ride_ID" name="Ride_ID" required>

                <label for="Num_of_Users">จำนวนผู้ใช้:</label>
                <input type="number" id="Num_of_Users" name="Num_of_Users" required>

                <button type="submit">บันทึกข้อมูล</button>
            </form>
        </section>
    </main>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 Dreamworld Thailand. All rights reserved.</p>
    </footer>
</body>
</html>
