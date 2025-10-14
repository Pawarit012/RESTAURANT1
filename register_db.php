<?php
session_start();
include('server.php');

// เปิดโหมดแสดง error ขณะพัฒนา (ช่วยเช็คถ้ามีปัญหา)
error_reporting(E_ALL);
ini_set('display_errors', 1);

$errors = array();

if (isset($_POST['reg_user'])) {
    // ✅ รับค่าจากฟอร์ม
    $username = trim(mysqli_real_escape_string($conn, $_POST['username']));
    $email = trim(mysqli_real_escape_string($conn, $_POST['email']));
    $password = trim(mysqli_real_escape_string($conn, $_POST['password']));
    $tel = isset($_POST['tel']) ? trim(mysqli_real_escape_string($conn, $_POST['tel'])) : '';

    // ✅ ตรวจสอบค่าว่าง
    if (empty($username)) {
        $errors[] = "กรุณากรอกชื่อผู้ใช้";
    }
    if (empty($email)) {
        $errors[] = "กรุณากรอกอีเมล";
    }
    if (empty($password)) {
        $errors[] = "กรุณากรอกรหัสผ่าน";
    }
    if (empty($tel)) {
        $errors[] = "กรุณากรอกเบอร์โทรศัพท์";
    }

    // ✅ ตรวจสอบชื่อผู้ใช้ / อีเมลซ้ำ
    if (count($errors) === 0) {
        $check_sql = "SELECT * FROM user WHERE username = ? OR email = ? LIMIT 1";
        $stmt = mysqli_prepare($conn, $check_sql);
        mysqli_stmt_bind_param($stmt, "ss", $username, $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result);

        if ($user) {
            if ($user['username'] === $username) {
                $errors[] = "ชื่อผู้ใช้นี้ถูกใช้ไปแล้ว";
            }
            if ($user['email'] === $email) {
                $errors[] = "อีเมลนี้ถูกใช้ไปแล้ว";
            }
        }
    }

    // ✅ ถ้าไม่มี error → เพิ่มผู้ใช้ใหม่
    if (count($errors) === 0) {
        // เข้ารหัสรหัสผ่าน (แนะนำ: ใช้ password_hash() แทน md5 ถ้า PHP >= 7.4)
        $hashed_password = md5($password);

        $insert_sql = "INSERT INTO user (username, email, password, tel) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $insert_sql);
        mysqli_stmt_bind_param($stmt, "ssss", $username, $email, $hashed_password, $tel);

        if (mysqli_stmt_execute($stmt)) {
            // ✅ สมัครสมาชิกสำเร็จ
            $_SESSION['success'] = "สมัครสมาชิกสำเร็จ! กรุณาเข้าสู่ระบบ";
            header('Location: login.php');
            exit();
        } else {
            // ❌ ถ้า INSERT ไม่สำเร็จ
            $_SESSION['error'] = "เกิดข้อผิดพลาดในการบันทึกข้อมูล: " . mysqli_error($conn);
            header('Location: register.php');
            exit();
        }
    } else {
        // ❌ ถ้ามี error ให้เก็บไว้ใน session
        $_SESSION['error'] = implode("<br>", $errors);
        header('Location: register.php');
        exit();
    }
} else {
    // ถ้าเข้าหน้านี้โดยตรงโดยไม่ผ่านฟอร์ม
    header('Location: register.php');
    exit();
}
?>
