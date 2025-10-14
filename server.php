<?php
// เปิด session เพื่อให้สามารถเก็บ error ได้
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ตั้งค่าการเชื่อมต่อฐานข้อมูล
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "register_db";

// พยายามเชื่อมต่อฐานข้อมูล
$conn = mysqli_connect($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if (!$conn) {
    // ไม่ต้อง echo หรือ die — เพราะจะทำให้ HTML/PHP พัง
    // ให้เก็บข้อความ error ไว้ใน session แทน
    $_SESSION['error'] = "ไม่สามารถเชื่อมต่อฐานข้อมูลได้: " . mysqli_connect_error();
}
?>
