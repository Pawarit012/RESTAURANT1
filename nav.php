<?php

session_start();
require("server.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>nav</title>
    <link rel="stylesheet" href="nav.css">
</head>


<body>
    <nav>
        <div class="container">
            <div class="nav-con">
                <div class="logo">
                    <img src="PICTURE/file_0000000019f461f790a1c4885f29f07c-removebg-preview.png" alt="ลาบญวนชวนมากิน" width="100px">
                </div>
                <ul class="menu">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="menu.php">Menu</a></li>
                    <li><a href="contact.php">Contact</a></li>

                    <?php if (!isset($_SESSION["username"])): ?>
                        <li><a href="login.php">LOG-In</a></li>
                    <?php else: ?>
                        <li><a href="logout.php">Logout</a></li>
                        <li><a href="order_history.php">ประวัติคำสั่งซื้อ</a></li>
                    <?php endif; ?>

                    <?php $current_page = basename($_SERVER['PHP_SELF'])?>
                    <?php if ($current_page == 'menu.php') : ?>
                        <li class="cart-icon" onclick="toggleCart()">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
								<path d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.08-.14.12-.31.12-.48 0-.55-.45-1-1-1H5.21l-.94-2H1zm16 16c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z"/>
							</svg>
							<span class="cart-badge" id="cartBadge">0</span>
						</li>
                     <?php endif; ?>
                   


                </ul>
            </div>
        </div>
    </nav>
</body>

</html>