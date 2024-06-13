<?php
session_start();
// session is not set or session is not true
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            background-image: url('contactusbg.png'); /* Background image for the page */
            background-size: cover;
            background-position: center;
            display: flex;
            flex-direction: column;
            color: white;
        }
        .contact-container {
            display: flex;
            flex-wrap: wrap;
            width: 80%;
            max-width: 1200px;
            background-color: rgba(0, 0, 0, 0.7); /* Overlay background */
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 20px;
            color: white;
            margin: auto;
            margin-top: 20px;
            height:650px;
        }
        .contact-left {
            flex: 1;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            animation: slideInLeft 1s forwards;
        }
        .contact-left img {
            max-width: 100%;
            border-radius: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .contact-right {
            flex: 2;
            padding: 20px;
            position: relative;
        }
        .feedback-slide {
            display: none;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            text-align: center;
            animation: fadeIn 1s forwards;
        }
        .feedback-slide.active {
            display: block;
        }
        .slide-img {
            max-width: 100%;
            border-radius: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-100%);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
    </style>
</head>
<body>
    <?php include 'raw/_nav.php'; ?>

    <div class="contact-container">
        <div class="contact-left">
            <img src="contact.png" alt="Contact Us">
            <p>Indulge in the Magic of Muffins - Where Every Bite is a Sweet Delight!</p>
        </div>
        <div class="contact-right">
            <!-- <div class="feedback-slide active">
                <img src="review1.png" alt="Cake 1" class="slide-img">
            </div>
            <div class="feedback-slide">
                <img src="review2.png" alt="Cake 2" class="slide-img">
            </div> -->
             <div class="feedback-slide">
                <img src="review3.png" alt="Cake 3" class="slide-img">
            </div> 
            <div class="feedback-slide">
                <img src="review4.png" alt="Cake 3" class="slide-img">
            </div>
            <div class="feedback-slide">
                <img src="review5.png" alt="Cake 3" class="slide-img">
            </div>
            <div class="feedback-slide">
                <img src="review7.png" alt="Cake 3" class="slide-img">
            </div>

            <!-- Add more slides as needed -->
        </div>
    </div>

    <script>
        let currentSlide = 0;
        const slides = document.getElementsByClassName("feedback-slide");

        function showSlides() {
            for (let i = 0; i < slides.length; i++) {
                slides[i].classList.remove("active");
            }
            currentSlide++;
            if (currentSlide > slides.length) { currentSlide = 1 }
            slides[currentSlide - 1].classList.add("active");
            setTimeout(showSlides, 3000); // Change image every 3 seconds
        }

        // Initial call to start the automatic slideshow
        showSlides();
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
