<?php
session_start();
include('server.php');

// เมื่อกดปุ่มเข้าสู่ระบบ
if (isset($_POST['login_user'])) {
    $username = trim(mysqli_real_escape_string($conn, $_POST['username']));
    $password = trim(mysqli_real_escape_string($conn, $_POST['password']));
    $errors = [];

    if ($username === '') {
        $errors[] = "กรุณากรอกชื่อผู้ใช้";
    }
    if ($password === '') {
        $errors[] = "กรุณากรอกรหัสผ่าน";
    }

    if (empty($errors)) {
        $password = md5($password);
        $query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) === 1) {
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "เข้าสู่ระบบสำเร็จ";
            $_SESSION['user_id'] = $user['id'];
            header('location: index.php');
            exit;
        } else {
            $_SESSION['error'] = "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง";
            header('location: login.php');
            exit;
        }
    } else {
        $_SESSION['error'] = implode("<br>", $errors);
        header('location: login.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>เข้าสู่ระบบ | ลาบญวณชวนมากิน</title>
  <link rel="stylesheet" href="login.css">
</head>
<body>
  <div class="form-container">
    <h2>LOG - IN</h2>

    <!-- ✅ กล่องแจ้งเตือน -->
    <?php if (isset($_SESSION['success'])): ?>
      <div class="success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
      <div class="error"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <form action="login.php" method="post">
      <div class="input-group">
        <input type="text" name="username" placeholder="Username" autocomplete="off">
      </div>
      <div class="input-group">
        <input type="password" name="password" placeholder="Password">
      </div>

      <div class="btn-group">
        <a href="register.php" class="btn link-btn">Create Account</a>
        <button type="submit" class="btn" name="login_user">SIGN - IN</button>
      </div>
    </form>
  </div>
</body>
</html>
