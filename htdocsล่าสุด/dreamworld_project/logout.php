<?php
session_start();
session_unset();  // ลบข้อมูล session
session_destroy(); // ลบ session
header("Location: index.php"); // กลับไปที่หน้าแรก
exit();
?>