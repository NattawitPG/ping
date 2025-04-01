<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Name = $_POST['Name'];
    
    // ตรวจสอบว่า Email ถูกส่งมาหรือไม่
    if (isset($_POST['Email'])) {
        $Email = $_POST['Email'];
    } else {
        $error = "กรุณากรอกอีเมล";
    }

    if (isset($_POST['Phone'])) {
        $Phone = $_POST['Phone'];
    } else {
        $error = "กรุณากรอกเบอร์";
    }

    // เพิ่มข้อมูล Gender และ Date_of_Birth สำหรับ customer
    if (isset($_POST['Gender'])) {
        $Gender = $_POST['Gender'];
    } else {
        $error = "กรุณากรอกเพศ";
    }

    if (isset($_POST['Date_of_Birth'])) {
        $Date_of_Birth = $_POST['Date_of_Birth'];
    } else {
        $error = "กรุณากรอกวันเกิด";
    }

    $Password = password_hash($_POST['Password'], PASSWORD_DEFAULT); // เข้ารหัสรหัสผ่าน

    // ตรวจสอบว่า Name หรือ Email มีในฐานข้อมูลหรือยัง
    $sql_check = "SELECT * 
              FROM user_account_email uae
              JOIN user_account ua ON uae.User_ID = ua.User_ID
              WHERE uae.Email = '$Email' OR ua.Name = '$Name'";
    $result_check = mysqli_query($conn, $sql_check);

    if (mysqli_num_rows($result_check) > 0) {
        // ถ้าพบว่ามีข้อมูลอยู่แล้ว
        $error = "ชื่อผู้ใช้งานหรืออีเมลนี้ถูกใช้ไปแล้ว";
    } else {
        // เพิ่มข้อมูลผู้ใช้ในฐานข้อมูล
        $sql_user_account = "INSERT INTO user_account (Name, Password) VALUES ('$Name', '$Password')";
        
        if (mysqli_query($conn, $sql_user_account)) {
            // ดึง ID ของผู้ใช้ที่เพิ่มล่าสุด
            $user_id = mysqli_insert_id($conn);

            // เพิ่มข้อมูลในตาราง user_account_email (สำหรับ Email)
            $sql_user_account_email = "INSERT INTO user_account_email (User_ID, Email) VALUES ('$user_id', '$Email')";

            if (mysqli_query($conn, $sql_user_account_email)) {
                // เพิ่มเบอร์โทรศัพท์ในตาราง user_account_phone
                $sql_user_account_phone = "INSERT INTO user_account_phone (User_ID, Phone) VALUES ('$user_id', '$Phone')";

                if (mysqli_query($conn, $sql_user_account_phone)) {
                    // เพิ่มข้อมูลลูกค้าในตาราง customer
                    $sql_customer = "INSERT INTO customer (Name, Gender, Date_of_Birth, User_ID) 
                                     VALUES ('$Name', '$Gender', '$Date_of_Birth', '$user_id')";
                    if (mysqli_query($conn, $sql_customer)) {
                        // ถ้าทุกอย่างสำเร็จ
                        $success = "สมัครสมาชิกสำเร็จ! ตอนนี้คุณสามารถเข้าสู่ระบบได้";
                    } else {
                        // ถ้าผิดพลาดในการเพิ่มข้อมูลใน customer
                        $error = "เกิดข้อผิดพลาดในการสมัครสมาชิก (ข้อมูลลูกค้า): " . mysqli_error($conn);
                    }
                } else {
                    // ถ้าผิดพลาดในการเพิ่มข้อมูลใน user_account_phone
                    $error = "เกิดข้อผิดพลาดในการสมัครสมาชิก (เบอร์โทรศัพท์): " . mysqli_error($conn);
                }
            } else {
                // ถ้าผิดพลาดในการเพิ่มข้อมูลใน user_account_email
                $error = "เกิดข้อผิดพลาดในการสมัครสมาชิก (อีเมล): " . mysqli_error($conn);
            }
        } else {
            // ถ้าผิดพลาดในการเพิ่มข้อมูลใน user_account
            $error = "เกิดข้อผิดพลาดในการสมัครสมาชิก (ชื่อผู้ใช้): " . mysqli_error($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สมัครสมาชิก - Dreamworld Thailand</title>
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
                <li><a href="login.php">ล็อกอิน</a></li>
                <li><a href="register.php">สมัครสมาชิก</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="form-section">
            <h2>สมัครสมาชิก</h2>
            
            <!-- แสดงข้อความแจ้งเตือน -->
            <?php if (isset($success)): ?>
                <p style="color: green;"><?php echo $success; ?></p>
            <?php elseif (isset($error)): ?>
                <p style="color: red;"><?php echo $error; ?></p>
            <?php endif; ?>

            <form action="register.php" method="POST">
                <label for="Name">ชื่อผู้ใช้งาน:</label>
                <input type="text" id="Name" name="Name" required>

                <label for="Email">อีเมล:</label>
                <input type="Email" id="Email" name="Email" required>

                <label for="Password">รหัสผ่าน:</label>
                <input type="Password" id="Password" name="Password" required>

                <label for="Phone">เบอร์:</label>
                <input type="Phone" id="Phone" name="Phone" required>

                <label for="Gender">เพศ:</label>
                <select name="Gender" required>
                    <option value="Male">ชาย</option>
                    <option value="Female">หญิง</option>
                    <option value="Other">อื่นๆ</option>
                </select><br>

                <label for="Date_of_Birth">วันเกิด:</label>
                <input type="date" name="Date_of_Birth" required><br>

                <button type="submit">สมัครสมาชิก</button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Dreamworld Thailand. All rights reserved.</p>
    </footer>
</body>
</html>

