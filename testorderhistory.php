<?php
session_start();

// ตรวจสอบการล็อกอิน
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
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

$user_username = $_SESSION['username'];

// ดึงข้อมูลคำสั่งซื้อทั้งหมดของผู้ใช้ (แก้ไข: ใช้ created_at แทน order_date)
$sql = "SELECT * FROM orders WHERE username = ? ORDER BY created_at DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user_username);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ประวัติคำสั่งซื้อ</title>
    <link rel="stylesheet" href="order_history.css">
    
</head>
<body>
    <div class="container">
        <a href="menu.php" class="back-btn">← กลับไปหน้าเมนู</a>
        
        <h1>📜 ประวัติคำสั่งซื้อของคุณ</h1>
        <?php echo "<h1>username: " . $_SESSION['username'] . "</h1>";?>

        <div class="orders-container">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($order = $result->fetch_assoc()): ?>
                    <div class="order-card">
                        <div class="order-header">
                            <div class="order-id">คำสั่งซื้อ #<?php echo str_pad($order['order_id'], 6, '0', STR_PAD_LEFT); ?></div>
                            <div class="order-status status-<?php echo $order['status']; ?>">
                                <?php 
                                $status_text = [
                                    'pending' => 'รอดำเนินการ',
                                    'confirmed' => 'ยืนยันแล้ว',
                                    'completed' => 'เสร็จสิ้น',
                                    'cancelled' => 'ยกเลิก'
                                ];
                                echo isset($status_text[$order['status']]) ? $status_text[$order['status']] : 'ไม่ทราบสถานะ';
                                ?>
                            </div>
                        </div>

                        <div class="order-date">
                            📅 วันที่สั่ง: <?php echo date('d/m/Y H:i น.', strtotime($order['created_at'])); ?>
                        </div>

                        <div class="order-items">
                            <strong>รายการสินค้า:</strong>
                            <?php
                            // ดึงรายการสินค้าของคำสั่งซื้อนี้
                            $order_id = $order['order_id'];
                            $items_sql = "SELECT * FROM order_items WHERE order_id = ?";
                            $items_stmt = $conn->prepare($items_sql);
                            $items_stmt->bind_param("i", $order_id);
                            $items_stmt->execute();
                            $items_result = $items_stmt->get_result();

                            while ($item = $items_result->fetch_assoc()):
                            ?>
                                <div class="item-row">
                                    <span><?php echo htmlspecialchars($item['product_name']); ?> x<?php echo $item['quantity']; ?></span>
                                    <span><?php echo number_format($item['subtotal'], 2); ?> บาท</span>
                                </div>
                            <?php 
                            endwhile;
                            $items_stmt->close();
                            ?>
                        </div>

                        <div class="order-summary">
                            <div class="summary-row">
                                <span>จำนวนสินค้า:</span>
                                <span><?php echo $order['total_items']; ?> ชิ้น</span>
                            </div>
                            <div class="order-total">
                                <span>💰 ยอดรวมทั้งหมด:</span>
                                <span><?php echo number_format($order['total_amount'], 2); ?> บาท</span>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="no-orders">
                    <div class="no-orders-icon">🛒</div>
                    <h2>ยังไม่มีประวัติคำสั่งซื้อ</h2>
                    <p>เมื่อคุณสั่งซื้อสินค้า ประวัติจะแสดงที่นี่</p>
                    <a href="menu.php" class="shop-now-btn">เริ่มสั่งอาหารเลย!</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>