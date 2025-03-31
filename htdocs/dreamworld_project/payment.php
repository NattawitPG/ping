<?php
session_start();

// ตรวจสอบว่าเข้าสู่ระบบหรือไม่
if (!isset($_SESSION['Name'])) {
    // หากไม่ได้เข้าสู่ระบบ จะส่งไปที่หน้าเข้าสู่ระบบ
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ชำระเงิน - Dreamworld Thailand</title>
    <link rel="stylesheet" href="styles.css">
    <script>
        function validateForm() {
            // ตรวจสอบหมายเลขบัตรเครดิต
            var cardNumber = document.getElementById("card_number").value;
            if (cardNumber.length !== 13) {
                alert("บัตรเครดิตไม่ถูกต้อง");
                return false;
            }

            // ตรวจสอบ CVV
            var cvv = document.getElementById("cvv").value;
            if (cvv.length !== 3) {
                alert("CVV ต้องมี 3 หลัก");
                return false;
            }

            // ตรวจสอบวันหมดอายุ
            var expirationDate = document.getElementById("expiration_date").value;
            if (!expirationDate) {
                alert("กรุณากรอกวันหมดอายุ");
                return false;
            }

            return true;
        }
    </script>
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
                <li><a href="booking.php">จองบัตร</a></li>
                <li><a href="login.php">ล็อกอิน</a></li>
            </ul>
        </nav>
    </header>

    <!-- Payment Section -->
    <main>
        <section class="payment-section">
            <h2>ชำระเงิน</h2>
            <form action="payment_action.php" method="POST" onsubmit="return validateForm()">
                <label for="card_number">หมายเลขบัตรเครดิต:</label>
                <input type="text" id="card_number" name="card_number" required>

                <label for="expiration_date">วันหมดอายุ:</label>
                <input type="month" id="expiration_date" name="expiration_date" maxlength="2" minlength="2" required>

                <label for="cvv">CVV:</label>
                <input type="text" id="cvv" name="cvv" maxlength="3" minlength="3" required>

                <button type="submit">ชำระเงิน</button>
            </form>
        </section>
    </main>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 Dreamworld Thailand. All rights reserved.</p>
    </footer>
</body>
</html>
