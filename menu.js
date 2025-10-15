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

		// ฟังก์ชันสั่งซื้อ
		function checkout() {
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
			
			// ล้างตระกร้า
			cart = [];
			updateCart();
			toggleCart();
		}

		// เรียกใช้ updateCart เมื่อโหลดหน้าเว็บ
		updateCart();