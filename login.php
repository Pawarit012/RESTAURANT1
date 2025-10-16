<?php
session_start();
include('server.php');

// ระบบเข้าสู่ระบบ
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
            $user = mysqli_fetch_assoc($result);
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['success'] = "เข้าสู่ระบบสำเร็จ";
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

// ระบบรีเซ็ตรหัสผ่าน
if (isset($_POST['reset_password'])) {
    $reset_username = trim(mysqli_real_escape_string($conn, $_POST['reset_username']));
    $new_password = trim($_POST['new_password']);
    $confirm_password = trim($_POST['confirm_password']);
    $errors = [];

    if ($reset_username === '') {
        $errors[] = "กรุณากรอกชื่อผู้ใช้";
    }
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
        $check_query = "SELECT * FROM user WHERE username='$reset_username'";
        $check_result = mysqli_query($conn, $check_query);

        if ($check_result && mysqli_num_rows($check_result) === 1) {
            $new_password_hash = md5($new_password);
            $update_query = "UPDATE user SET password='$new_password_hash' WHERE username='$reset_username'";
            
            if (mysqli_query($conn, $update_query)) {
                $_SESSION['success'] = "เปลี่ยนรหัสผ่านสำเร็จ! กรุณาเข้าสู่ระบบด้วยรหัสผ่านใหม่";
                header('location: login.php');
                exit;
            } else {
                $_SESSION['error'] = "เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้ง";
            }
        } else {
            $_SESSION['error'] = "ไม่พบชื่อผู้ใช้นี้ในระบบ";
        }
    } else {
        $_SESSION['error'] = implode("<br>", $errors);
    }
    
    $show_modal = true;
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>เข้าสู่ระบบ | ลาบญวณชวนมากิน</title>
  <link rel="stylesheet" href="login.css?v=<?php echo time(); ?>">
  <style>
    /* ปิด Autofill ของ Browser */
    input:-webkit-autofill,
    input:-webkit-autofill:hover,
    input:-webkit-autofill:focus,
    input:-webkit-autofill:active {
      -webkit-box-shadow: 0 0 0 30px white inset !important;
      transition: background-color 5000s ease-in-out 0s;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>LOG - IN</h2>

    <!-- ✅ แบบฟอร์มเข้าสู่ระบบ - เพิ่ม autocomplete="off" -->
    <form action="login.php" method="post" autocomplete="off">
      <?php if (isset($_SESSION['success'])): ?>
        <div class="alert success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
      <?php endif; ?>

      <?php if (isset($_SESSION['error']) && !isset($_POST['reset_password'])): ?>
        <div class="alert error"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
      <?php endif; ?>

      <div class="input-group">
        <input type="text" name="username" placeholder="Username" autocomplete="new-username">
      </div>
      <div class="input-group">
        <input type="password" name="password" placeholder="Password" autocomplete="new-password">
      </div>

      <!-- ลิงก์ลืมรหัสผ่าน -->
      <div class="forgot-link">
        <a href="javascript:void(0);" onclick="openModal()">ลืมรหัสผ่าน?</a>
      </div>

      <div class="btn-group">
        <a href="register.php" class="btn link-btn">Create Account</a>
        <button type="submit" class="btn" name="login_user">SIGN - IN</button>
      </div>
    </form>
  </div>

  <!-- Modal รีเซ็ตรหัสผ่าน -->
  <div id="resetModal" class="modal" <?php if(isset($show_modal)) echo 'style="display:flex;"'; ?>>
    <div class="modal-content">
      <span class="close-btn" onclick="closeModal()">&times;</span>
      <h2>รีเซ็ตรหัสผ่าน</h2>

      <?php if (isset($_SESSION['error']) && isset($_POST['reset_password'])): ?>
        <div class="alert error"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
      <?php endif; ?>

      <form action="login.php" method="post" autocomplete="off">
        <div class="input-group">
          <input type="text" name="reset_username" placeholder="Username" autocomplete="off" required>
        </div>
        <div class="input-group">
          <input type="password" name="new_password" placeholder="รหัสผ่านใหม่ (อย่างน้อย 6 ตัวอักษร)" autocomplete="new-password" required>
        </div>
        <div class="input-group">
          <input type="password" name="confirm_password" placeholder="ยืนยันรหัสผ่านใหม่" autocomplete="new-password" required>
        </div>
        <div class="btn-group">
          <button type="button" class="btn link-btn" onclick="closeModal()">ยกเลิก</button>
          <button type="submit" class="btn" name="reset_password">เปลี่ยนรหัสผ่าน</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    function openModal() {
      document.getElementById('resetModal').style.display = 'flex';
    }

    function closeModal() {
      document.getElementById('resetModal').style.display = 'none';
    }

    window.onclick = function(event) {
      const modal = document.getElementById('resetModal');
      if (event.target === modal) {
        closeModal();
      }
    }

    document.addEventListener('keydown', function(event) {
      if (event.key === 'Escape') {
        closeModal();
      }
    });
  </script>
</body>
</html>