<?php
include 'register_db.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT image_data FROM index_slider WHERE id = $id";
    $result = $conn->query($sql);

    if ($result && $row = $result->fetch_assoc()) {
        header("Content-Type: image/jpeg");
        echo $row['image_data'];
        exit;
    }
}
?>
