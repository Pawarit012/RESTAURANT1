<?php 
    session_start();
    require("server.php")

?>


<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>ร้านเปิดทำการ</title>
    <style>

    @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Mozilla+Text:wght@200..700&display=swap');
* {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to right, #f5f5f5 0%, #e0e0e0 50%, #f5f5f5 100%);
           
        }

        
        

        .content {
            display: flex;
            padding: 40px;
            gap: 40px;
            align-items: flex-start;
        }

        .left-section {
            flex: 1;
        }

        .title {
            font-size: 48px;
            font-weight: bold;
            color: #2c2c2c;
            margin-bottom: 50px;
            text-align: left;
        }

        .contact-item {
            display: flex;
            align-items: center;
            margin-bottom: 35px;
            gap: 30px;
        }

        .icon-circle {
            width: 70px;
            height: 70px;
            background: #2c2c2c;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .icon-circle svg {
            width: 40px;
            height: 40px;
            fill: white;
        }

        .contact-text {
            font-size: 32px;
            font-weight: bold;
            color: #2c2c2c;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .colon {
            font-weight: bold;
        }

        .map-section {
            width: 320px;
            flex-shrink: 0;
        }

        .map-container {
            width: 100%;
            height: 280px;
            border: 3px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            position: relative;
        }

        .map-container iframe {
            width: 100%;
            height: 100%;
            border: none;
        }

        /* Placeholder map styling */
        .map-placeholder {
            width: 100%;
            height: 100%;
            background: #e8e8e8;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            color: #666;
        }

        @media (max-width: 768px) {
            .content {
                flex-direction: column;
                padding: 20px;
            }

            .title {
                font-size: 32px;
                margin-bottom: 30px;
            }

            .contact-text {
                font-size: 20px;
            }

            .icon-circle {
                width: 50px;
                height: 50px;
            }

            .icon-circle svg {
                width: 28px;
                height: 28px;
            }

            .map-section {
                width: 100%;
            }
        }


    </style>



</head>
<body>
        <?php include ("nav.php") ?> 
    
        <div class="content">
            <div class="left-section">
                <h1 class="title">ร้านเปิดทำการ: 09.00 - 21.00</h1>
                
                <div class="contact-item">
                    <div class="icon-circle">
                        <svg viewBox="0 0 24 24">
                            <path d="M20.01 15.38c-1.23 0-2.42-.2-3.53-.56-.35-.12-.74-.03-1.01.24l-1.57 1.97c-2.83-1.35-5.48-3.9-6.89-6.83l1.95-1.66c.27-.28.35-.67.24-1.02-.37-1.11-.56-2.3-.56-3.53 0-.54-.45-.99-.99-.99H4.19C3.65 3 3 3.24 3 3.99 3 13.28 10.73 21 20.01 21c.71 0 .99-.63.99-1.18v-3.45c0-.54-.45-.99-.99-.99z"/>
                        </svg>
                    </div>
                    <div class="contact-text">
                        <span class="colon">:</span>
                        <span>เบอร์ xxx-xxx-xxxx</span>
                    </div>
                </div>

                <div class="contact-item">
                    <div class="icon-circle">
                        <svg viewBox="0 0 24 24">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                        </svg>
                    </div>
                    <div class="contact-text">
                        <span class="colon">:</span>
                        <span>__.x1r8 (เจ้าของร้าน)</span>
                    </div>
                </div>

                <div class="contact-item">
                    <div class="icon-circle">
                        <svg viewBox="0 0 24 24">
                            <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                        </svg>
                    </div>
                    <div class="contact-text">
                        <span class="colon">:</span>
                        <span>xxxxxx@gmail.com</span>
                       
                    </div>
                </div>
            </div>

            <div class="map-section">
                <div class="map-container">
                    <div class="map-placeholder">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7368.568362888281!2d100.53594147485519!3d13.714280586673695!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e29f35d9bdff0d%3A0x8ec79fdd80befa7a!2z4Lih4Lir4Liy4Lin4Li04LiX4Lii4Liy4Lil4Lix4Lii4LmA4LiX4LiE4LmC4LiZ4LmC4Lil4Lii4Li14Lij4Liy4LiK4Lih4LiH4LiE4Lil4LiB4Lij4Li44LiH4LmA4LiX4Lie!5e1!3m2!1sth!2sus!4v1760591983685!5m2!1sth!2sus" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>