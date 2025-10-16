<?php 
    session_start();
    if (!isset($_SESSION['username'])) {
    header("location:login.php") ;
}

?>


<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบจัดการผู้ใช้</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }
        h1 {
            color: #667eea;
            margin-bottom: 30px;
            text-align: center;
        }
        .form-section {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
            font-weight: 600;
        }
        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 10px;
            border: 2px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            transition: border-color 0.3s;
        }
        input[type="text"]:focus,
        input[type="email"]:focus {
            outline: none;
            border-color: #667eea;
        }
        button {
            background: #667eea;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            transition: background 0.3s;
        }
        button:hover {
            background: #5568d3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th {
            background: #667eea;
            color: white;
            padding: 12px;
            text-align: left;
        }
        td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }
        tr:hover {
            background: #f8f9fa;
        }
        .message {
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .delete-btn {
            background: #dc3545;
            padding: 5px 15px;
            font-size: 14px;
        }
        .delete-btn:hover {
            background: #c82333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🗃️ ระบบจัดการข้อมูลผู้ใช้</h1>

        <?php
        // ข้อมูลการเชื่อมต่อ Database
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "WEBDATA";

        $message = "";
        $messageType = "";

        try {
            // เชื่อมต่อ Database
            $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // สร้างตาราง users ถ้ายังไม่มี
            $sql = "CREATE TABLE IF NOT EXISTS users (
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(100) NOT NULL,
                email VARCHAR(100) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )";
            $conn->exec($sql);

            // ถ้ามีการส่งฟอร์มเพิ่มข้อมูล
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
                $name = $_POST['name'];
                $email = $_POST['email'];

                $stmt = $conn->prepare("INSERT INTO users (name, email) VALUES (:name, :email)");
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':email', $email);
                $stmt->execute();

                $message = "เพิ่มข้อมูลสำเร็จ!";
                $messageType = "success";
            }

            // ถ้ามีการลบข้อมูล
            if (isset($_GET['delete'])) {
                $id = $_GET['delete'];
                $stmt = $conn->prepare("DELETE FROM users WHERE id = :id");
                $stmt->bindParam(':id', $id);
                $stmt->execute();

                $message = "ลบข้อมูลสำเร็จ!";
                $messageType = "success";
            }

        } catch(PDOException $e) {
            $message = "เกิดข้อผิดพลาด: " . $e->getMessage();
            $messageType = "error";
        }

        // แสดงข้อความ
        if ($message != "") {
            echo "<div class='message $messageType'>$message</div>";
        }
        ?>

        <!-- ฟอร์มเพิ่มข้อมูล -->
        <div class="form-section">
            <h2>➕ เพิ่มผู้ใช้ใหม่</h2>
            <form method="POST" action="">
                <div class="form-group">
                    <label>ชื่อ:</label>
                    <input type="text" name="name" required placeholder="กรอกชื่อ">
                </div>
                <div class="form-group">
                    <label>อีเมล:</label>
                    <input type="email" name="email" required placeholder="กรอกอีเมล">
                </div>
                <button type="submit" name="add">บันทึกข้อมูล</button>
            </form>
        </div>

        <!-- แสดงรายการข้อมูล -->
        <h2>📋 รายการผู้ใช้ทั้งหมด</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ชื่อ</th>
                    <th>อีเมล</th>
                    <th>วันที่สร้าง</th>
                    <th>จัดการ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                try {
                    // ดึงข้อมูลทั้งหมด
                    $stmt = $conn->prepare("SELECT * FROM users ORDER BY id DESC");
                    $stmt->execute();
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    if (count($result) > 0) {
                        foreach($result as $row) {
                            echo "<tr>";
                            echo "<td>" . $row["id"] . "</td>";
                            echo "<td>" . htmlspecialchars($row["name"]) . "</td>";
                            echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
                            echo "<td>" . $row["created_at"] . "</td>";
                            echo "<td><a href='?delete=" . $row["id"] . "' onclick='return confirm(\"ต้องการลบข้อมูลนี้?\");'><button class='delete-btn'>ลบ</button></a></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5' style='text-align:center;'>ไม่มีข้อมูล</td></tr>";
                    }
                } catch(PDOException $e) {
                    echo "<tr><td colspan='5'>เกิดข้อผิดพลาด: " . $e->getMessage() . "</td></tr>";
                }

                // ปิดการเชื่อมต่อ
                $conn = null;
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>