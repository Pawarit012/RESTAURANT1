<?php
include 'register_db.php';

if (isset($_POST['upload'])) {
    $title = $_POST['title'];
    $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));

    $sql = "INSERT INTO index_slider (image_data, title) VALUES ('$image', '$title')";
    if ($conn->query($sql)) {
        echo "<p style='color:green;'>อัปโหลดรูปสำเร็จ!</p>";
    } else {
        echo "<p style='color:red;'>เกิดข้อผิดพลาด: " . $conn->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title>อัปโหลดรูปลงฐานข้อมูล</title>
</head>
<body>
  <h2>อัปโหลดรูปภาพลงฐานข้อมูล</h2>
  <form method="POST" enctype="multipart/form-data">
    <label>ชื่อเมนู:</label><br>
    <input type="text" name="title" required><br><br>

    <label>เลือกรูป:</label><br>
    <input type="file" name="image" accept="image/*" required><br><br>

    <button type="submit" name="upload">อัปโหลด</button>
  </form>
</body>
</html>
