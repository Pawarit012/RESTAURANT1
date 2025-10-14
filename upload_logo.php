<?php
include('server.php');

if (isset($_POST['upload'])) {
    // อ่านข้อมูลรูปภาพที่อัปโหลดเข้ามา
    $image = addslashes(file_get_contents($_FILES['logo']['tmp_name']));

    // บันทึกลงฐานข้อมูล
    $sql = "INSERT INTO settings (logo) VALUES ('$image')";
    if (mysqli_query($conn, $sql)) {
        echo "✅ อัปโหลดโลโก้สำเร็จแล้ว!";
    } else {
        echo "❌ เกิดข้อผิดพลาด: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>Upload Logo</title>
</head>
<body>
    <h2>อัปโหลดโลโก้ร้าน</h2>
    <form method="POST" enctype="multipart/form-data">
        <input type="file" name="logo" accept="image/*" required>
        <button type="submit" name="upload">อัปโหลด</button>
    </form>
</body>
</html>
