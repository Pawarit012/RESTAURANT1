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
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin: 30px 0;
            color: white;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        }

        .back-btn {
            display: inline-block;
            padding: 10px 20px;
            background: white;
            color: #667eea;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 20px;
            font-weight: 600;
            transition: transform 0.2s;
        }

        .back-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        .orders-container {
            display: grid;
            gap: 20px;
        }

        .order-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform 0.2s;
        }

        .order-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.15);
        }

        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 15px;
            margin-bottom: 15px;
        }

        .order-id {
            font-size: 18px;
            font-weight: bold;
            color: #667eea;
        }

        .order-status {
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
        }

        .status-confirmed {
            background: #d1ecf1;
            color: #0c5460;
        }

        .status-completed {
            background: #d4edda;
            color: #155724;
        }

        .status-cancelled {
            background: #f8d7da;
            color: #721c24;
        }

        .order-date {
            color: #666;
            font-size: 14px;
            margin-bottom: 15px;
        }

        .order-items {
            margin: 15px 0;
        }

        .item-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px dashed #e0e0e0;
        }

        .item-row:last-child {
            border-bottom: none;
        }

        .order-summary {
            display: grid;
            gap: 8px;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 2px solid #f0f0f0;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            color: #666;
        }

        .order-total {
            display: flex;
            justify-content: space-between;
            font-size: 20px;
            font-weight: bold;
            color: #ff6b6b;
            margin-top: 10px;
        }

        .no-orders {
            text-align: center;
            padding: 60px 20px;
            background: white;
            border-radius: 10px;
            color: #999;
        }

        .no-orders-icon {
            font-size: 60px;
            margin-bottom: 20px;
        }

        .shop-now-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 30px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: 600;
        }

        .shop-now-btn:hover {
            background: #5568d3;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="menu.php" class="back-btn">← กลับไปหน้าเมนู</a>
        
        <h1>📜 ประวัติคำสั่งซื้อของคุณ</h1>

        <div class="orders-container">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($order = $result->fetch_assoc()): ?>
                    <div class="order-card">
                        <div class="order-header">
                            <div class="order-id">คำสั่งซื้อ #<?php echo str_pad($order['id'], 6, '0', STR_PAD_LEFT); ?></div>
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
                            $order_id = $order['id'];
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