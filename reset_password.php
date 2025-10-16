<?php
session_start();
include('server.php');

// ตรวจสอบว่ามี username ใน session หรือไม่
if (!isset($_SESSION['reset_username'])) {
    header('location: forgot_password.php');
    exit;
}

if (isset($_POST['reset_password'])) {
    $new_password = trim($_POST['new_password']);
    $confirm_password = trim($_POST['confirm_password']);
    $errors = [];

    if ($new_password === '') {
        $errors[] = "กรุณากรอกรหัสผ่านใหม่";
    } elseif (strlen($new_password) < 6) {
        $errors[] = "รหัสผ่านต้องมีอย่างน้อย 6 ตัวอักษร";
    }

    if ($confirm_password === '') {
        $errors[] = "กรุณายืนยันรหัสผ่าน";
    }

    if ($new_password !== $confirm_password) {
        $errors[] = "รหัสผ่านไม่ตรงกัน";
    }

    if (empty($errors)) {
        $username = $_SESSION['reset_username'];
        $password_hash = md5($new_password);
        
        $query = "UPDATE user SET password='$password_hash' WHERE username='$username'";
        
        if (mysqli_query($conn, $query)) {
            unset($_SESSION['reset_username']);
            $_SESSION['success'] = "เปลี่ยนรหัสผ่านสำเร็จ กรุณาเข้าสู่ระบบด้วยรหัสผ่านใหม่";
            header('location: login.php');
            exit;
        } else {
            $_SESSION['error'] = "เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้ง";
        }
    } else {
        $_SESSION['error'] = implode("<br>", $errors);
    }
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ตั้งรหัสผ่านใหม่ | ลาบญวณชวนมากิน</title>
  <link rel="stylesheet" href="login.css">
</head>
<body>
  <div class="form-container">
    <h2>ตั้งรหัสผ่านใหม่</h2>

    <?php if (isset($_SESSION['error'])): ?>
      <div class="error"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <form action="reset_password.php" method="post">
      <p style="text-align: center; margin-bottom: 20px; color: #666;">
        สำหรับ: <strong><?= htmlspecialchars($_SESSION['reset_username']) ?></strong>
      </p>
      
      <div class="input-group">
        <input type="password" name="new_password" placeholder="รหัสผ่านใหม่" required>
      </div>
      
      <div class="input-group">
        <input type="password" name="confirm_password" placeholder="ยืนยันรหัสผ่านใหม่" required>
      </div>

      <div class="btn-group">
        <a href="forgot_password.php" class="btn link-btn">ย้อนกลับ</a>
        <button type="submit" class="btn" name="reset_password">เปลี่ยนรหัสผ่าน</button>
      </div>
    </form>
  </div>
</body>
</html>