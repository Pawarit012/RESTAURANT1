<?php
session_start();

// ตรวจสอบการล็อกอิน
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

// เชื่อมต่อฐานข้อมูล
$servername = "localhost";
$username = "root"; // เปลี่ยนตามของคุณ
$password = ""; // เปลี่ยนตามของคุณ
$dbname = "register_db"; // เปลี่ยนตามชื่อ database ของคุณ

$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// กำหนด charset เป็น utf8
$conn->set_charset("utf8");

// ตรวจสอบว่ามีการส่งข้อมูลมาหรือไม่
if (isset($_POST['orders']) && isset($_POST['cartData'])) {
    
    // รับข้อมูลจาก form
    $cartData = json_decode($_POST['cartData'], true);
    $user_username = $_SESSION['username'];
    
    // ตรวจสอบว่ามีข้อมูลหรือไม่
    if (empty($cartData)) {
        echo "<script>alert('ไม่มีสินค้าในตระกร้า'); window.location.href='menu.php';</script>";
        exit();
    }
    
    // คำนวณยอดรวม
    $totalAmount = 0;
    $totalItems = 0;
    
    foreach ($cartData as $item) {
        $totalAmount += $item['price'] * $item['quantity'];
        $totalItems += $item['quantity'];
    }
    
    // เริ่มต้น Transaction
    $conn->begin_transaction();
    
    try {
        // 1. บันทึกข้อมูลคำสั่งซื้อหลัก
        $sql = "INSERT INTO orders (username, total_amount, total_items, status) 
                VALUES (?, ?, ?, 'pending')";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sdi", $user_username, $totalAmount, $totalItems);
        $stmt->execute();
        
        // ดึง order_id ที่เพิ่งสร้าง
        $order_id = $conn->insert_id;
        $stmt->close();
        
        // 2. บันทึกรายละเอียดสินค้าแต่ละรายการ
        $sql = "INSERT INTO order_items (order_id, product_name, price, quantity, subtotal) 
                VALUES (?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sql);
        
        foreach ($cartData as $item) {
            $product_name = $item['name'];
            $price = $item['price'];
            $quantity = $item['quantity'];
            $subtotal = $price * $quantity;
            
            $stmt->bind_param("isdid", $order_id, $product_name, $price, $quantity, $subtotal);
            $stmt->execute();
        }
        
        $stmt->close();
        
        // Commit Transaction
        $conn->commit();
        
        // บันทึกสำเร็จ
        echo "<!DOCTYPE html>
        <html lang='th'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>สั่งซื้อสำเร็จ</title>
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
                    display: flex;
                    justify-content: center;
                    align-items: center;
                }
                
                .success-container {
                    background: white;
                    padding: 40px;
                    border-radius: 15px;
                    box-shadow: 0 10px 40px rgba(0,0,0,0.2);
                    max-width: 600px;
                    width: 90%;
                }
                
                .success-icon {
                    width: 80px;
                    height: 80px;
                    background: #4CAF50;
                    border-radius: 50%;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    margin: 0 auto 20px;
                    animation: scaleIn 0.5s ease;
                }
                
                .success-icon::after {
                    content: '✓';
                    color: white;
                    font-size: 50px;
                }
                
                @keyframes scaleIn {
                    0% { transform: scale(0); }
                    50% { transform: scale(1.2); }
                    100% { transform: scale(1); }
                }
                
                h1 {
                    text-align: center;
                    color: #333;
                    margin-bottom: 20px;
                }
                
                .order-details {
                    background: #f5f5f5;
                    padding: 20px;
                    border-radius: 10px;
                    margin: 20px 0;
                }
                
                .order-info {
                    margin: 10px 0;
                    display: flex;
                    justify-content: space-between;
                    padding: 10px 0;
                    border-bottom: 1px solid #ddd;
                }
                
                .order-info:last-child {
                    border-bottom: none;
                }
                
                .label {
                    font-weight: 600;
                    color: #555;
                }
                
                .value {
                    color: #333;
                }
                
                .items-list {
                    margin: 15px 0;
                }
                
                .item {
                    padding: 8px 0;
                    border-bottom: 1px dashed #ccc;
                }
                
                .total {
                    font-size: 20px;
                    font-weight: bold;
                    color: #ff6b6b;
                }
                
                .btn-container {
                    display: flex;
                    gap: 15px;
                    margin-top: 30px;
                }
                
                .btn {
                    flex: 1;
                    padding: 15px;
                    border: none;
                    border-radius: 8px;
                    font-size: 16px;
                    font-weight: 600;
                    cursor: pointer;
                    transition: transform 0.2s;
                }
                
                .btn:hover {
                    transform: translateY(-2px);
                }
                
                .btn-primary {
                    background: #667eea;
                    color: white;
                }
                
                .btn-secondary {
                    background: #48bb78;
                    color: white;
                }
            </style>
        </head>
        <body>
            <div class='success-container'>
                <div class='success-icon'></div>
                <h1>สั่งซื้อสำเร็จ!</h1>
                
                <div class='order-details'>
                    <div class='order-info'>
                        <span class='label'>หมายเลขคำสั่งซื้อ:</span>
                        <span class='value'>#" . str_pad($order_id, 6, '0', STR_PAD_LEFT) . "</span>
                    </div>
                    
                    <div class='order-info'>
                        <span class='label'>ชื่อผู้สั่ง:</span>
                        <span class='value'>" . htmlspecialchars($user_username) . "</span>
                    </div>
                    
                    <div class='items-list'>
                        <div class='label' style='margin-bottom: 10px;'>รายการสินค้า:</div>";
        
        foreach ($cartData as $item) {
            echo "<div class='item'>" . htmlspecialchars($item['name']) . " x" . $item['quantity'] . " = " . ($item['price'] * $item['quantity']) . " บาท</div>";
        }
        
        echo "      </div>
                    
                    <div class='order-info'>
                        <span class='label'>จำนวนทั้งหมด:</span>
                        <span class='value'>" . $totalItems . " ชิ้น</span>
                    </div>
                    
                    <div class='order-info'>
                        <span class='label total'>ยอดรวมทั้งหมด:</span>
                        <span class='value total'>" . number_format($totalAmount, 2) . " บาท</span>
                    </div>
                </div>
                
                <div class='btn-container'>
                    <button class='btn btn-primary' onclick=\"window.location.href='menu.php'\">สั่งเพิ่ม</button>
                    <button class='btn btn-secondary' onclick=\"window.location.href='order_history.php'\">ดูประวัติคำสั่งซื้อ</button>
                </div>
            </div>
        </body>
        </html>";
        
    } catch (Exception $e) {
        // Rollback ถ้ามีข้อผิดพลาด
        $conn->rollback();
        echo "<script>alert('เกิดข้อผิดพลาด: " . $e->getMessage() . "'); window.location.href='menu.php';</script>";
    }
    
} else {
    // ถ้าเข้ามาโดยไม่ได้ส่งข้อมูล
    header('Location: menu.php');
    exit();
}

$conn->close();
?>