<?php
// เชื่อมต่อฐานข้อมูล
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // รับข้อมูลจากฟอร์ม
    $Date = $_POST['Date'];
    $Time = $_POST['Time'];
    $Ride_ID = $_POST['Ride_ID'];
    $Num_of_Users = $_POST['Num_of_Users'];

    // เพิ่มข้อมูลลงในฐานข้อมูล
    $sql = "INSERT INTO use_of_ride (Date, Time, Ride_ID, Num_of_Users) VALUES ('$Date', '$Time', '$Ride_ID', '$Num_of_Users')";
    
    if (mysqli_query($conn, $sql)) {
        echo "บันทึกข้อมูลสำเร็จ!";
        header("Location: use_of_ride.php");  // เปลี่ยนเส้นทางกลับไปยังหน้า use_of_ride
    } else {
        echo "เกิดข้อผิดพลาดในการบันทึกข้อมูล: " . mysqli_error($conn);
    }
}
?>
