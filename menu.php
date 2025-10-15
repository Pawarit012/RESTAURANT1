<?php
session_start();

// ถ้ายังไม่ได้ล็อกอิน
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="th">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Menu</title>
	<link rel="stylesheet" href="menu.css">
</head>

<body>
	<!-- Header -->
	<header>
		<nav>
			<div class="container">
				<div class="nav-con">
					<div class="logo">
						<img src="PICTURE/file_0000000019f461f790a1c4885f29f07c-removebg-preview.png" alt="ลาบญวนชวนมากิน" width="100px">
					</div>
					<ul class="menu">
						<li><a href="index.php">Home</a></li>
						<li><a href="#">menu</a></li>
						<li><a href="#">Contact</a></li>
						<li><a href="logout.php">LogOut</a></li>
						<li class="cart-icon" onclick="toggleCart()">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
								<path d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.08-.14.12-.31.12-.48 0-.55-.45-1-1-1H5.21l-.94-2H1zm16 16c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z"/>
							</svg>
							<span class="cart-badge" id="cartBadge">0</span>
						</li>
					</ul>
				</div>
			</div>
		</nav>
	</header>

	<!-- Overlay -->
	<div class="overlay" id="overlay" onclick="toggleCart()"></div>

	<!-- Cart Sidebar -->
	<div class="cart-sidebar" id="cartSidebar">
		<div class="cart-header">
			<h2>ตระกร้าของฉัน</h2>
			<button class="close-cart" onclick="toggleCart()">&times;</button>
		</div>
		<div class="cart-items" id="cartItems">
			<div class="empty-cart">
				<p>ตระกร้าว่างเปล่า</p>
			</div>
		</div>
		<div class="cart-summary">
			<div class="cart-summary-row">
				<span>จำนวนสินค้า:</span>
				<span id="totalItems">0 ชิ้น</span>
			</div>
			<div class="cart-summary-row cart-total">
				<span>ยอดรวม:</span>
				<span id="totalPrice">0 บาท</span>
			</div>
			<button class="checkout-btn" onclick="checkout()">สั่งซื้อ</button>
		</div>
	</div>

	<!-- Body -->
	<h4>อาหารจานหลัก</h4>
	<div class="body">
		<div class="body-box">
			<div class="box1">
				<ul class="mode">
					<li><a href="#">อาหารจานหลัก</a></li>
					<li><a href="#">ชาบูจิ้มจุ่มแจ่วฮ้อน</a></li>
					<li><a href="#">ของทานเล่น</a></li>
					<li><a href="#">เครื่องดื่ม</a></li>
				</ul>
			</div>
			<div class="box2">
				<div class="box-item">
					<div class="img"><img src="PICTURE/ก้อยเนื้อ.jpg" alt="ก้อยเนื้อ"></div>
					<div class="detail">ชื่อเมนู: ก้อยเนื้อ</div>
					<div class="price">ราคา: 90 บาท</div>
					<div class="add-the-cart"><button onclick="addToCart('ก้อยเนื้อ', 90, this)">รับเมนู</button></div>
				</div>
				
				<div class="box-item">
					<div class="img"><img src="PICTURE/ไก่ย่าง.jpg" alt="ไก่ย่าง"></div>
					<div class="detail">ชื่อเมนู: ไก่ย่าง</div>
					<div class="price">ราคา: 80 บาท</div>
					<div class="add-the-cart"><button onclick="addToCart('ไก่ย่าง', 80, this)">รับเมนู</button></div>
				</div>

				<div class="box-item">
					<div class="img"><img src="PICTURE/ข้าวเหนียว.png" alt="ข้าวเหนียว"></div>
					<div class="detail">ชื่อเมนู: ข้าวเหนียว</div>
					<div class="price">ราคา: 20 บาท</div>
					<div class="add-the-cart"><button onclick="addToCart('ข้าวเหนียว', 20, this)">รับเมนู</button></div>
				</div>

				<div class="box-item">
					<div class="img"><img src="PICTURE/คอหมูย่าง.jpg" alt="คอหมูย่าง"></div>
					<div class="detail">ชื่อเมนู: คอหมูย่าง</div>
					<div class="price">ราคา: 90 บาท</div>
					<div class="add-the-cart"><button onclick="addToCart('คอหมูย่าง', 90, this)">รับเมนู</button></div>
				</div>

				<div class="box-item">
					<div class="img"><img src="PICTURE/ตับหวาน.png" alt="ตับหวาน"></div>
					<div class="detail">ชื่อเมนู: ตับหวาน</div>
					<div class="price">ราคา: 100 บาท</div>
					<div class="add-the-cart"><button onclick="addToCart('ตับหวาน', 100, this)">รับเมนู</button></div>
				</div>

				<div class="box-item">
					<div class="img"><img src="PICTURE/น้ำตกหมู.jpg" alt="น้ำตกหมู"></div>
					<div class="detail">ชื่อเมนู: น้ำตกหมู</div>
					<div class="price">ราคา: 80 บาท</div>
					<div class="add-the-cart"><button onclick="addToCart('น้ำตกหมู', 80, this)">รับเมนู</button></div>
				</div>

				<div class="box-item">
					<div class="img"><img src="PICTURE/ลาบหมู.jpg" alt="ลาบหมู"></div>
					<div class="detail">ชื่อเมนู: ลาบหมู</div>
					<div class="price">ราคา: 80 บาท</div>
					<div class="add-the-cart"><button onclick="addToCart('ลาบหมู', 80, this)">รับเมนู</button></div>
				</div>

				<div class="box-item">
					<div class="img"><img src="PICTURE/เสือร้องไห้.png" alt="เสือร้องไห้"></div>
					<div class="detail">ชื่อเมนู: เสือร้องไห้</div>
					<div class="price">ราคา: 175 บาท</div>
					<div class="add-the-cart"><button onclick="addToCart('เสือร้องไห้', 175, this)">รับเมนู</button></div>
				</div>

				<div class="box-item">
					<div class="img"><img src="PICTURE/ไส้ย่าง.jpg" alt="ไส้ย่าง"></div>
					<div class="detail">ชื่อเมนู: ไส้ย่าง</div>
					<div class="price">ราคา: 60 บาท</div>
					<div class="add-the-cart"><button onclick="addToCart('ไส้ย่าง', 60, this)">รับเมนู</button></div>
				</div>
			</div>
		</div>
	</div>

	<script src="menu.js"></script>

	
</body>

</html>