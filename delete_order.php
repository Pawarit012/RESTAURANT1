<?php
session_start();

// ตรวจสอบการล็อกอิน
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

// ตรวจสอบว่ามี order_id ส่งมาหรือไม่
if (!isset($_POST['order_id'])) {
    header('Location: order_history.php');
    exit();
}

// เชื่อมต่อฐานข้อมูล
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "register_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8");

$order_id = $_POST['order_id'];
$user_username = $_SESSION['username'];

// ตรวจสอบว่าคำสั่งซื้อนี้เป็นของผู้ใช้คนนี้จริงหรือไม่
$check_sql = "SELECT order_id FROM orders WHERE order_id = ? AND username = ?";
$check_stmt = $conn->prepare($check_sql);
$check_stmt->bind_param("is", $order_id, $user_username);
$check_stmt->execute();
$check_result = $check_stmt->get_result();

if ($check_result->num_rows > 0) {
    // เริ่มต้น transaction
    $conn->begin_transaction();
    
    try {
        // ลบรายการสินค้าในคำสั่งซื้อก่อน
        $delete_items_sql = "DELETE FROM order_items WHERE order_id = ?";
        $delete_items_stmt = $conn->prepare($delete_items_sql);
        $delete_items_stmt->bind_param("i", $order_id);
        $delete_items_stmt->execute();
        $delete_items_stmt->close();
        
        // ลบคำสั่งซื้อ
        $delete_order_sql = "DELETE FROM orders WHERE order_id = ?";
        $delete_order_stmt = $conn->prepare($delete_order_sql);
        $delete_order_stmt->bind_param("i", $order_id);
        $delete_order_stmt->execute();
        $delete_order_stmt->close();
        
        // commit transaction
        $conn->commit();
        
        // redirect กลับไปหน้าประวัติพร้อมข้อความสำเร็จ
        header('Location: order_history.php?deleted=success');
        exit();
        
    } catch (Exception $e) {
        // rollback ถ้ามีข้อผิดพลาด
        $conn->rollback();
        header('Location: order_history.php?deleted=error');
        exit();
    }
} else {
    // ถ้าไม่พบคำสั่งซื้อหรือไม่ใช่ของผู้ใช้คนนี้
    header('Location: order_history.php?deleted=unauthorized');
    exit();
}

$check_stmt->close();
$conn->close();
?>