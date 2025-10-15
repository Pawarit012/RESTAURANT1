<?php
session_start();

// ถ้ายังไม่ได้ล็อกอิน

?>


<!DOCTYPE html>
<html lang="th">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Menu</title>
	

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

.cart-items {
    flex: 1;
    overflow-y: auto;
    padding: 20px;
}

.cart-item {
    display: flex;
    gap: 15px;
    margin-bottom: 20px;
    padding-bottom: 20px;
    border-bottom: 1px solid #eee;
}

.cart-item-img {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 8px;
}

.cart-item-details {
    flex: 1;
}

.cart-item-name {
    font-weight: 600;
    margin-bottom: 5px;
}

.cart-item-price {
    color: #f09126;
    font-weight: 500;
}

.cart-item-remove {
    background-color: #ff4444;
    color: white;
    border: none;
    padding: 5px 10px;
    border-radius: 4px;
    cursor: pointer;
    font-size: 12px;
    margin-top: 5px;
}

.cart-summary {
    padding: 20px;
    border-top: 2px solid #eee;
    background-color: #f9f9f9;
}

.cart-summary-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 10px;
}

.cart-total {
    font-size: 20px;
    font-weight: bold;
    color: #ff6b6b;
}

.checkout-btn {
    width: 100%;
    padding: 15px;
    background-color: #ff6b6b;
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    margin-top: 15px;
}

.checkout-btn:hover {
    background-color: #ff5252;
}

.empty-cart {
    text-align: center;
    padding: 40px 20px;
    color: #999;
}

/* Overlay */
.overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: none;
    z-index: 999;
}

.overlay.active {
    display: block;
}

/* Body */
h4 {
    text-align: center;
    margin: 30px 0;
    font-size: 28px;
    color: #333;
}

.body {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px 40px;
}

.body-box {
    display: flex;
    gap: 30px;
}

.box1 {
    width: 250px;
    background-color: white;
    padding: 20px;
    border-radius: 10px;
    height: fit-content;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.mode {
    list-style: none;
}

.mode li {
    margin-bottom: 15px;
}

.mode a {
    text-decoration: none;
    color: #333;
    font-weight: 500;
    display: block;
    padding: 10px;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.mode a:hover {
    background-color: #fff0f0;
    color: #ff6b6b;
}

.box2 {
    flex: 1;
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 25px;
}

.box-item {
    background-color: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s;
}

.box-item:hover {
    transform: translateY(-5px);
}

.img {
    width: 100%;
    height: 200px;
    overflow: hidden;
}

.img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.detail,
.price {
    padding: 10px 15px;
}

.detail {
    font-weight: 600;
    color: #333;
}

.price {
    color: #ff6b6b;
    font-weight: 500;
}

.add-the-cart {
    padding: 0 15px 15px;
}

.add-the-cart button {
    width: 100%;
    padding: 12px;
    background-color: #df9101;
    color: white;
    border: none;
    border-radius: 6px;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.3s;
}

.add-the-cart button:hover {
    background-color: #ff5252;
}

/* Flying animation */
@keyframes fly-to-cart {
    0% {
        transform: translate(0, 0) scale(1);
        opacity: 1;
    }

    50% {
        transform: translate(var(--fly-x), var(--fly-y)) scale(0.5);
        opacity: 0.8;
    }

    100% {
        transform: translate(var(--fly-x), var(--fly-y)) scale(0.2);
        opacity: 0;
    }
}

.flying-item {
    position: fixed;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    object-fit: cover;
    pointer-events: none;
    z-index: 1001;
    animation: fly-to-cart 0.8s ease-out;
}
	</style>
</head>

<body>
	<!-- Header -->
	<?php include("nav.php")?>
	
							
						
	
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
			<!-- <button class="checkout-btn" name="orders" onclick="checkout()">สั่งซื้อ</button> -->
			 <form method="POST" action="payment.php">
    			<button class="checkout-btn" name="orders" onclick="checkout()" >สั่งซื้อ</button>
			</form>

<!-- ใน process.php -->

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

	<script>
		// ตัวแปรเก็บข้อมูลตระกร้า
		let cart = [];

		// ฟังก์ชันเปิด/ปิดตระกร้า
		function toggleCart() {
			const sidebar = document.getElementById('cartSidebar');
			const overlay = document.getElementById('overlay');
			sidebar.classList.toggle('open');
			overlay.classList.toggle('active');
		}

		// ฟังก์ชันเพิ่มสินค้าลงตระกร้า
		function addToCart(name, price, button) {
			// หารูปภาพของสินค้า
			const img = button.closest('.box-item').querySelector('img');
			
			// สร้างแอนิเมชั่นบินไปยังตระกร้า
			createFlyingAnimation(img);

			// เพิ่มสินค้าลงตระกร้า
			const existingItem = cart.find(item => item.name === name);
			if (existingItem) {
				existingItem.quantity++;
			} else {
				cart.push({
					name: name,
					price: price,
					quantity: 1,
					image: img.src
				});
			}

			// อัพเดทตระกร้า
			updateCart();

			// แอนิเมชั่น badge
			const badge = document.getElementById('cartBadge');
			badge.classList.remove('bounce');
			setTimeout(() => badge.classList.add('bounce'), 10);
		}

		// ฟังก์ชันสร้างแอนิเมชั่นบิน
		function createFlyingAnimation(img) {
			const cartIcon = document.querySelector('.cart-icon');
			const imgRect = img.getBoundingClientRect();
			const cartRect = cartIcon.getBoundingClientRect();

			const flyingItem = document.createElement('img');
			flyingItem.src = img.src;
			flyingItem.className = 'flying-item';
			flyingItem.style.left = imgRect.left + 'px';
			flyingItem.style.top = imgRect.top + 'px';
			
			const deltaX = cartRect.left - imgRect.left;
			const deltaY = cartRect.top - imgRect.top;
			
			flyingItem.style.setProperty('--fly-x', deltaX + 'px');
			flyingItem.style.setProperty('--fly-y', deltaY + 'px');

			document.body.appendChild(flyingItem);

			setTimeout(() => {
				flyingItem.remove();
			}, 800);
		}

		// ฟังก์ชันลบสินค้าจากตระกร้า
		function removeFromCart(name) {
			cart = cart.filter(item => item.name !== name);
			updateCart();
		}

		// ฟังก์ชันอัพเดทตระกร้า
		function updateCart() {
			const cartItems = document.getElementById('cartItems');
			const cartBadge = document.getElementById('cartBadge');
			const totalItems = document.getElementById('totalItems');
			const totalPrice = document.getElementById('totalPrice');

			// คำนวณยอดรวม
			const itemCount = cart.reduce((sum, item) => sum + item.quantity, 0);
			const priceSum = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);

			// อัพเดท badge
			cartBadge.textContent = itemCount;

			// อัพเดทรายการสินค้า
			if (cart.length === 0) {
				cartItems.innerHTML = '<div class="empty-cart"><p>ตระกร้าว่างเปล่า</p></div>';
			} else {
				cartItems.innerHTML = cart.map(item => `
					<div class="cart-item">
						<img src="${item.image}" alt="${item.name}" class="cart-item-img">
						<div class="cart-item-details">
							<div class="cart-item-name">${item.name}</div>
							<div class="cart-item-price">${item.price} บาท × ${item.quantity}</div>
							<button class="cart-item-remove" onclick="removeFromCart('${item.name}')">ลบ</button>
						</div>
					</div>
				`).join('');
			}

			// อัพเดทยอดรวม
			totalItems.textContent = `${itemCount} ชิ้น`;
			totalPrice.textContent = `${priceSum} บาท`;
		}
		    let isLoggedIn = <?php echo isset($_SESSION['username']) ? 'true' : 'false'; ?>;

		// ฟังก์ชันสั่งซื้อ
				function checkout() {
			if (!isLoggedIn) {
				alert('กรุณาล็อกอินก่อนสั่งซื้อ');
				return;
			}

			if (cart.length === 0) {
				alert('กรุณาเลือกสินค้าก่อนสั่งซื้อ');
				return;
			}

			const itemCount = cart.reduce((sum, item) => sum + item.quantity, 0);
			const priceSum = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);

			const orderDetails = cart.map(item => 
				`${item.name} x${item.quantity} = ${item.price * item.quantity} บาท`
			).join('\n');

			alert(`ยืนยันการสั่งซื้อ\n\nรายการสินค้า:\n${orderDetails}\n\nจำนวนทั้งหมด: ${itemCount} ชิ้น\nยอดรวม: ${priceSum} บาท\n\nขอบคุณที่สั่งซื้อค่ะ!`);

			cart = [];
			updateCart();
			toggleCart();
		}


		// เรียกใช้ updateCart เมื่อโหลดหน้าเว็บ
		updateCart();
	</script>
	
</body>

</html>