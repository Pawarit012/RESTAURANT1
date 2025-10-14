<?php
include('server.php');

$sql = "SELECT logo FROM settings ORDER BY id DESC LIMIT 1";
$result = mysqli_query($conn, $sql);

if ($row = mysqli_fetch_assoc($result)) {
    $imageData = $row['logo'];

    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_buffer($finfo, $imageData);
    finfo_close($finfo);

    header("Content-Type: $mime");
    echo $imageData;
} else {
    http_response_code(404);
    echo "No logo found.";
}
?>
