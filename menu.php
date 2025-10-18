<?php
session_start();





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
	<?php include("nav.php") ?>




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
			<form method="POST" action="payment.php" onsubmit="return checkout()">
				<input type="hidden" id="cartData" name="cartData" value="">



				<!-- ช่องทางการจ่ายเงิน -->
				<div style="margin-top: 20px;">
					<h3>เลือกช่องทางการชำระเงิน</h3>
					<label style="display: flex; align-items: center; margin-bottom: 10px;">
						<input type="radio" name="payment_method" value="prompay" required>
						<span style="margin-left: 8px;">Prompay</span>
						<img src="image.png" alt="Prompay QR" style="width: 200px; height: 250px; margin-left: 10px;">
					</label>

					<label style="display: flex; align-items: center; margin-bottom: 10px;">
						<input type="radio" name="payment_method" value="cash" required>
						<span style="margin-left: 8px;">เงินสด</span>
					</label>
				</div>

				<button class="checkout-btn" name="orders">สั่งซื้อ</button>
			</form>


			<!-- ใน process.php -->

		</div>
	</div>

	<!-- Body -->
	<h4></h4>
	<div class="body">
		<div class="body-box">
			<div class="box1">
				<ul class="mode">
					<li><a href="#">อาหารจานหลัก</a></li>
					<li><a href="#chabu">ชาบูจิ้มจุ่มแจ่วฮ้อน</a></li>
					<li><a href="#ของทานเล่น">ของทานเล่น</a></li>
					<li><a href="#เครื่องดื่ม">เครื่องดื่ม</a></li>
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

				<!-- ชาบูแจ่วฮ้อน -->

				<div class="box-item" id="chabu">
					<div class="img"><img src="PICTURE/จิ้มจุ่มม.jpg" alt="จิ้มจุ่มม"></div>
					<div class="detail">ชื่อเมนู: จิ้มจุ่ม </div>
					<div class="price">ราคา: 90 บาท</div>
					<div class="add-the-cart"><button onclick="addToCart('จิ้มจุ่มม', 90, this)">รับเมนู</button></div>
				</div>

				<div class="box-item">
					<div class="img"><img src="PICTURE/จื้มจุ่มชุด1.jpg" alt="จิ้มจุ่มชุดที่1"></div>
					<div class="detail">ชื่อเมนู: จิ้มจุ่มชุดที่1</div>
					<div class="price">ราคา: 80 บาท</div>
					<div class="add-the-cart"><button onclick="addToCart('จิ้มจุ่มชุดที่1', 80, this)">รับเมนู</button></div>
				</div>

				<div class="box-item">
					<div class="img"><img src="PICTURE/IMG_9682.JPG" alt="จิ้มจุ่มชุดที่2"></div>
					<div class="detail">ชื่อเมนู: จิ้มจุ่มชุดที่2</div>
					<div class="price">ราคา: 20 บาท</div>
					<div class="add-the-cart"><button onclick="addToCart('จิ้มจุ่มชุดที่2', 20, this)">รับเมนู</button></div>
				</div>

				<div class="box-item">
					<div class="img"><img src="PICTURE/IMG_9683.JPG" alt="จิ้มจุ่มชุดที่3"></div>
					<div class="detail">ชื่อเมนู: จิ้มจุ่มชุดที่3</div>
					<div class="price">ราคา: 80 บาท</div>
					<div class="add-the-cart"><button onclick="addToCart('จิ้มจุ่มชุดที่3', 80, this)">รับเมนู</button></div>
				</div>

				<div class="box-item">
					<div class="img"><img src="PICTURE/IMG_9684.JPG" alt="จิ้มจุ่มชุดที่4"></div>
					<div class="detail">ชื่อเมนู: จิ้มจุ่มชุดที่4</div>
					<div class="price">ราคา: 20 บาท</div>
					<div class="add-the-cart"><button onclick="addToCart('จิ้มจุ่มชุดที่4', 20, this)">รับเมนู</button></div>
				</div>

				<div class="box-item">
					<div class="img"><img src="PICTURE/IMG_9685.JPG" alt="จิ้มจุ่มชุดที่5"></div>
					<div class="detail">ชื่อเมนู: จิ้มจุ่มชุดที่5</div>
					<div class="price">ราคา: 80 บาท</div>
					<div class="add-the-cart"><button onclick="addToCart('จิ้มจุ่มชุดที่5', 80, this)">รับเมนู</button></div>
				</div>

				<!-- ของทานเล่น -->

				<div class="box-item" id="ของทานเล่น">
					<div class="img"><img src="Snacks/image copy.png" alt="ไส้กรอกอีสาน"></div>
					<div class="detail">ชื่อเมนู: ไส้กรอกอีสาน</div>
					<div class="price">ราคา: 65 บาท</div>
					<div class="add-the-cart"><button onclick="addToCart('ไส้กรอกอีสาน', 65, this)">รับเมนู</button></div>
				</div>

				<div class="box-item">
					<div class="img"><img src="Snacks/IMG_9689.JPG" alt="เฟรนฟราย"></div>
					<div class="detail">ชื่อเมนู: เฟรนฟราย</div>
					<div class="price">ราคา: 59 บาท</div>
					<div class="add-the-cart"><button onclick="addToCart('เฟรนฟราย', 59, this)">รับเมนู</button></div>
				</div>

				<div class="box-item">
					<div class="img"><img src="Snacks/IMG_9686.JPG" alt="แคปหมู"></div>
					<div class="detail">ชื่อเมนู: แคปหมู</div>
					<div class="price">ราคา: 45 บาท</div>
					<div class="add-the-cart"><button onclick="addToCart('แคปหมู', 45, this)">รับเมนู</button></div>
				</div>

				<div class="box-item">
					<div class="img"><img src="Snacks/IMG_9687.JPG" alt="เอ็นไก่ทอด"></div>
					<div class="detail">ชื่อเมนู: เอ็นไก่ทอด</div>
					<div class="price">ราคา: 70 บาท</div>
					<div class="add-the-cart"><button onclick="addToCart('เอ็นไก่ทอด', 70, this)">รับเมนู</button></div>
				</div>

				<div class="box-item">
					<div class="img"><img src="Snacks/IMG_9688.JPG" alt="ปีกไก่ทอด"></div>
					<div class="detail">ชื่อเมนู: ปีกไก่ทอด</div>
					<div class="price">ราคา: 80 บาท</div>
					<div class="add-the-cart"><button onclick="addToCart('ปีกไก่ทอด', 80, this)">รับเมนู</button></div>
				</div>

				<div class="box-item">
					<div class="img"><img src="Snacks/image.png" alt="แหนมทอด"></div>
					<div class="detail">ชื่อเมนู: แหนมทอด</div>
					<div class="price">ราคา: 65 บาท</div>
					<div class="add-the-cart"><button onclick="addToCart('แหนมทอด', 65, this)">รับเมนู</button></div>
				</div>

				<!-- เครื่องดื่ม -->

				<div class="box-item" id="เครื่องดื่ม">
					<div class="img"><img src="water/โค้ก.png" alt="โค้ก"></div>
					<div class="detail">ชื่อเมนู: โค้ก</div>
					<div class="price">ราคา: 20บาท</div>
					<div class="add-the-cart"><button onclick="addToCart('โค้ก', 20, this)">รับเมนู</button></div>
				</div>

				<div class="box-item">
					<div class="img"><img src="water/ชามะนาว.jpg" alt="ชามะนาว"></div>
					<div class="detail">ชื่อเมนู: ชามะนาว</div>
					<div class="price">ราคา: 80 บาท</div>
					<div class="add-the-cart"><button onclick="addToCart('ชามะนาว', 50, this)">รับเมนู</button></div>
				</div>

				<div class="box-item">
					<div class="img"><img src="water/แดงโซดา.jpg" alt="แดงโซดา"></div>
					<div class="detail">ชื่อเมนู: แดงโซดา</div>
					<div class="price">ราคา: 50 บาท</div>
					<div class="add-the-cart"><button onclick="addToCart('แดงโซดา', 50, this)">รับเมนู</button></div>
				</div>

				<div class="box-item" ">
						<div class=" img"><img src="water/น้ำผึ้งมะนาว.jpg" alt="น้ำผึ้งมะนาว"></div>
				<div class="detail">ชื่อเมนู: น้ำผึ้งมะนาว</div>
				<div class="price">ราคา: 60 บาท</div>
				<div class="add-the-cart"><button onclick="addToCart('น้ำผึ้งมะนาว', 60, this)">รับเมนู</button></div>
			</div>

			<div class="box-item">
				<div class="img"><img src="water/น้ำเปล่า.jpg" alt="น้ำเปล่า"></div>
				<div class="detail">ชื่อเมนู: น้ำเปล่า</div>
				<div class="price">ราคา: 20 บาท</div>
				<div class="add-the-cart"><button onclick="addToCart('น้ำเปล่า', 20, this)">รับเมนู</button></div>
			</div>

			<div class="box-item">
				<div class="img"><img src="water/เป๊ปซี่.png" alt="เป๊ปซี่"></div>
				<div class="detail">ชื่อเมนู: เป๊ปซี่</div>
				<div class="price">ราคา: 30 บาท</div>
				<div class="add-the-cart"><button onclick="addToCart('เป๊ปซี่', 30, this)">รับเมนู</button></div>
			</div>

			<div class="box-item">
				<div class="img"><img src="water/บลูฮาวาย.jpg" alt="บลูฮาวาย"></div>
				<div class="detail">ชื่อเมนู: บลูฮาวาย</div>
				<div class="price">ราคา: 45 บาท</div>
				<div class="add-the-cart"><button onclick="addToCart('บลูฮาวาย', 45, this)">รับเมนู</button></div>
			</div>

			<div class="box-item">
				<div class="img"><img src="water/สตอเบอรี่โซดา.jpg" alt="สตอเบอรี่โซดา"></div>
				<div class="detail">ชื่อเมนู: สตอเบอรี่โซดา</div>
				<div class="price">ราคา: 55 บาท</div>
				<div class="add-the-cart"><button onclick="addToCart('สตอเบอรี่โซดา', 55, this)">รับเมนู</button></div>
			</div>

			<div class="box-item">
				<div class="img"><img src="water/อัญชัน.jpg" alt="อัญชัน"></div>
				<div class="detail">ชื่อเมนู: อัญชัน</div>
				<div class="price">ราคา: 45 บาท</div>
				<div class="add-the-cart"><button onclick="addToCart('อัญชัน', 45, this)">รับเมนู</button></div>
			</div>

		</div>
	</div>

	<script>
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
				return false;
			}

			if (cart.length === 0) {
				alert('กรุณาเลือกสินค้าก่อนสั่งซื้อ');
				return false;
			}

			// แปลง cart เป็น JSON และใส่ใน hidden input
			document.getElementById('cartData').value = JSON.stringify(cart);

			return true; // ให้ form submit ต่อ
		} // ตัวแปรเก็บข้อมูลตระกร้า
	</script>

</body>

</html>