<?php
session_start();
include('server.php');

if (isset($_POST['forgot_password'])) {
    $username = trim(mysqli_real_escape_string($conn, $_POST['username']));

    if ($username === '') {
        $_SESSION['error'] = "กรุณากรอกชื่อผู้ใช้";
    } else {
        // ตรวจสอบว่ามี username นี้ในระบบหรือไม่
        $query = "SELECT * FROM user WHERE username='$username'";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) === 1) {
            // เก็บ username ใน session เพื่อใช้ในขั้นตอนถัดไป
            $_SESSION['reset_username'] = $username;
            $_SESSION['success'] = "พบข้อมูลผู้ใช้ กรุณาตั้งรหัสผ่านใหม่";
            header('location: reset_password.php');
            exit;
        } else {
            $_SESSION['error'] = "ไม่พบชื่อผู้ใช้นี้ในระบบ";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ลืมรหัสผ่าน | ลาบญวณชวนมากิน</title>
  <link rel="stylesheet" href="login.css">
</head>
<body>
  <div class="form-container">
    <h2>ลืมรหัสผ่าน</h2>

    <?php if (isset($_SESSION['success'])): ?>
      <div class="success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
      <div class="error"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <form action="forgot_password.php" method="post">
      <p style="text-align: center; margin-bottom: 20px; color: #666;">
        กรุณากรอกชื่อผู้ใช้ของคุณเพื่อรีเซ็ตรหัสผ่าน
      </p>
      
      <div class="input-group">
        <input type="text" name="username" placeholder="Username" autocomplete="off" required>
      </div>

      <div class="btn-group">
        <a href="login.php" class="btn link-btn">กลับไปเข้าสู่ระบบ</a>
        <button type="submit" class="btn" name="forgot_password">ถัดไป</button>
      </div>
    </form>
  </div>
</body>
</html>