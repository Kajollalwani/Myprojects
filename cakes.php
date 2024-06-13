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
    <title>Cake Slideshow</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            overflow-x: hidden;
            background-image: url('slides.jpg'); /* Background image for each slide */
        }
        .navbar {
            background-color: rgba(0, 0, 255, 0.1); /* Transparent background */
            height: 40px;
            font-family: cursive;
        }
        .slideshow-container {
            position: relative;
            max-width: 1000px;
            margin: auto;
            padding: 20px;
            height: 600px; /* Fixed height for the container */
        }
        .slide {
            display: none;
            position: relative;
            text-align: center;
            color: white;
            border-radius: 20px; /* Rounded corners for slides */
            overflow: hidden;
            background-size: cover;
            background-position: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Optional: Add shadow for better appearance */
            height: 100%; /* Make slide fill the container */
        }
        .slide img {
            width: 100%;
            height: 100%;
            object-fit: cover; /* Ensure image covers the slide area */
            border-radius: 20px; /* Rounded corners for images */
        }
        .slide-content {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            background-color: rgba(0, 0, 0, 0.5);
            padding: 10px;
            border-radius: 10px;
        }
        .slide-content h3, .slide-content p, .slide-content .btn {
            margin: 5px 0;
        }
        .btn-book {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-book:hover {
            background-color: #0056b3;
        }
        .prev, .next {
            cursor: pointer;
            position: absolute;
            top: 50%;
            width: auto;
            padding: 16px;
            margin-top: -22px;
            color: white;
            font-weight: bold;
            font-size: 18px;
            transition: 0.3s ease;
            border-radius: 0 3px 3px 0;
            user-select: none;
        }
        .next {
            right: 0;
            border-radius: 3px 0 0 3px;
        }
        .prev:hover, .next:hover {
            background-color: rgba(0, 0, 0, 0.8);
        }
        .dot-container {
            text-align: center;
            padding: 20px;
            background: rgba(0, 0, 0, 0.5);
            border-radius: 10px;
        }
        .dot {
            cursor: pointer;
            height: 15px;
            width: 15px;
            margin: 0 2px;
            background-color: #bbb;
            border-radius: 50%;
            display: inline-block;
            transition: background-color 0.0s ease;
        }
        .active, .dot:hover {
            background-color: #717171;
        }
        .fade {
            animation-name: fade;
            animation-duration: 1.5s;
        }
        @keyframes fade {
            from {opacity: .4}
            to {opacity: 1}
        }
    </style>
</head>
<body>
    <?php require 'raw/_nav.php' ?>

    <div class="slideshow-container">
        <!-- Slides -->
        <?php 
        $cakes = [
            ["name" => "Chocolate Cake", "image" => "1.jpg", "rating" => 4.5, "rate" => "$20"],
            ["name" => "Zym Theme Cake", "image" => "7.jpg", "rating" => 4.0, "rate" => "$18"],
            ["name" => "Strawberry Cake", "image" => "cake.jpg", "rating" => 4.2, "rate" => "$19"],
            ["name" => "Mocha Cake", "image" => "4.jpg", "rating" => 4.3, "rate" => "$21"],
            ["name" => "Pineapple Cake", "image" => "2.jpg", "rating" => 4.1, "rate" => "$18"],
            ["name" => "Rasmalai Cake", "image" => "3.jpg", "rating" => 4.5, "rate" => "$22"],
            ["name" => "Donuts", "image" => "5.jpg", "rating" => 4.4, "rate" => "$15"],
            ["name" => "Chocolate Truffle Cake", "image" => "6.jpg", "rating" => 4.7, "rate" => "$25"],
        ];
        foreach ($cakes as $index => $cake) {
            echo '<div class="slide fade">';
            echo '<img src="'.$cake["image"].'" alt="'.$cake["name"].'">';
            echo '<div class="slide-content">';
            echo '<h3>'.$cake["name"].'</h3>';
            echo '<p>Rating: '.$cake["rating"].' stars</p>';
            echo '<p>Rate: '.$cake["rate"].'</p>';
            echo '<a href="welcome.php" class="btn btn-book">Book Now</a>';
            echo '</div>';
            echo '</div>';
        }
        ?>
        <!-- Navigation buttons -->
        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
    </div>
    <br>
    <div class="dot-container">
        <?php for ($i = 1; $i <= count($cakes); $i++) {
            echo '<span class="dot" onclick="currentSlide('.$i.')"></span>';
        } ?>
    </div>

    <script>
        let slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            let i;
            let slides = document.getElementsByClassName("slide");
            let dots = document.getElementsByClassName("dot");
            if (n > slides.length) {slideIndex = 1}
            if (n < 1) {slideIndex = slides.length}
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex-1].style.display = "block";
            dots[slideIndex-1].className += " active";
        }

        function autoShowSlides() {
            plusSlides(1);
            setTimeout(autoShowSlides, 2000); // Change slide every 10 seconds
        }

        // Initial call to start the automatic slideshow
        autoShowSlides();
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
