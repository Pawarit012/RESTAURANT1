<?php
session_start();
?>

<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>สมัครสมาชิก | ลาบญวนชวนมากิน</title>
  <link rel="stylesheet" href="register.css">
</head>
<body>
  <div class="form-container">
    <h2>SIGN - UP</h2>

    <?php if (isset($_SESSION['error'])): ?>
      <div class="error"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <form action="register_db.php" method="post">
      <div class="input-group">
        <input type="text" name="username" placeholder="Username" required>
      </div>

      <div class="input-group">
        <input type="email" name="email" placeholder="Email" required>
      </div>

      <div class="input-group">
        <input type="password" name="password" placeholder="Password" required>
      </div>

      <div class="input-group">
        <input type="tel" name="tel" placeholder="Tel." required>
      </div>

      <div class="btn-group">
  <button type="button" class="btn" onclick="window.location.href='index.php'">Return</button>
  <button type="submit" name="reg_user" class="btn">Confirm</button>
</div>

</div>
    </form>
  </div>
</body>
</html>
