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
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Mozilla+Text:wght@200..700&display=swap');

* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    font-family: montserrat, sans-serif;
}

:root {
    --font-family: montserrat, serif;
}

.container {
    max-width: auto;
    margin: 0 auto;

}

nav {


    height: auto;
}

.nav-con {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #e46e0d;
    text-align: center;

}

.logo {

    align-items: center;
}

.menu {
    display: flex;
    list-style: none;
    justify-content: center;
    align-items: center;
    border-radius: 10px;
    margin: 2rem;
}

.menu li {
    margin: 0 2rem;
    text-decoration: none;
    align-items: center;
    border-radius: 10px;



}

.menu li a {
    list-style: none;
    text-decoration: none;
    color: black;
    border-radius: 10px;
    font-size: larger;
    font-family: var(--font-family);


    background-color: rgb(230, 216, 34);
    padding: .5rem 1rem;

}

/* Cart Icon */
.cart-icon {
    position: relative;
    cursor: pointer;
    padding: 10px;
}

.cart-icon svg {
    width: 30px;
    height: 30px;
    fill: #333;
}

.cart-badge {
    position: absolute;
    top: 0;
    right: 0;
    background-color: #ff6b6b;
    color: white;
    border-radius: 50%;
    width: 22px;
    height: 22px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    font-weight: bold;
}

.cart-badge.bounce {
    animation: bounce 0.5s ease;
}

@keyframes bounce {

    0%,
    100% {
        transform: scale(1);
    }

    50% {
        transform: scale(1.3);
    }
}

/* Cart Sidebar */
.cart-sidebar {
    position: fixed;
    right: -400px;
    top: 0;
    width: 400px;
    height: 100vh;
    background-color: white;
    box-shadow: -2px 0 10px rgba(0, 0, 0, 0.1);
    transition: right 0.3s ease;
    z-index: 1000;
    display: flex;
    flex-direction: column;
}

.cart-sidebar.open {
    right: 0;
}

.cart-header {
    padding: 20px;
    border-bottom: 1px solid #eee;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.cart-header h2 {
    font-size: 24px;
    color: #333;
}

.close-cart {
    background: none;
    border: none;
    font-size: 30px;
    cursor: pointer;
    color: #666;
}
</style>

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
                    <li><a href="#">Contact</a></li>

                    <?php if (!isset($_SESSION["username"])): ?>
                        <li><a href="login.php">LOG-In</a></li>
                    <?php else: ?>
                        <li><a href="logout.php">Logout</a></li>
                        <li><a href="profile">account</a></li>
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