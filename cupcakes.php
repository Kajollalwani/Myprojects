
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
    <title>Cupcakes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body, html {
        height: 100%;
        margin: 0;
        background-image: url('cupcakes.png'); /* Background image for the page */
        background-size: cover;
        background-position: center;
    }
    .content {
        padding: 20px;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
    }
    .card {
        position: relative;
        width: 300px;
        margin: 15px;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        opacity: 0;
        transform: translateY(50px);
        animation: fadeInUp 0.5s forwards;
        animation-delay: calc(0.1s * var(--i));
    }
    .card img {
        width: 100%;
        border-radius: 20px;
        transition: transform 0.3s ease;
    }
    .card:hover {
        transform: scale(1.05);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
    }
    .card:hover img {
        transform: scale(1.1);
    }
    .card-content {
        position: absolute;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        background-color: rgba(0, 0, 0, 0.7); /* Slightly darker background for better text visibility */
        padding: 10px;
        border-radius: 10px;
        text-align: center;
        color: white;
        opacity: 1; /* Ensure content is visible */
        transition: opacity 0.3s ease, transform 0.3s ease;
    }
    .card:hover .card-content {
        opacity: 1;
        transform: translateY(0); /* Optional: Add a slight upward transition */
    }
    .btn-book {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
    }
    .btn-book:hover {
        background-color: #0056b3;
    }

    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

</head>
<body>
    <?php include 'raw/_nav.php' ?>

    <div class="content">
        <!-- Cupcake Cards -->
        <?php 
        $cupcakes = [
            ["name" => "Chocalate Cupcake", "image" => "cup1.jpg", "rating" => 5, "rate" => "$5"],
            ["name" => "Chocolate Ganache Cupcake", "image" => "cup4.jpg", "rating" => 4.8, "rate" => "$6"],
            ["name" => "Red Velvet Cupcake", "image" => "cup5.jpg", "rating" => 4.7, "rate" => "$7"],
            ["name" => "Pista Cupcake", "image" => "cup2.jpg", "rating" => 4.9, "rate" => "$5"],
            ["name" => "Strawberry Cupcake", "image" => "cup3.jpg", "rating" => 4.9, "rate" => "$6"],
            ["name" => "Mocha Cupcake", "image" => "cup6.jpg", "rating" => 5, "rate" => "$7"],
            ["name" => "Donuts", "image" => "cup7.jpg", "rating" => 4.8, "rate" => "$6"],
            // ["name" => "Mocha Cupcake", "image" => "cupcake8.jpg", "rating" => 4.7, "rate" => "$7"]

        ];
        foreach ($cupcakes as $index => $cupcake) {
            echo '<div class="card">';
            echo '<img src="'.$cupcake["image"].'" alt="'.$cupcake["name"].'">';
            echo '<div class="card-content">';
            echo '<h3>'.$cupcake["name"].'</h3>';
            echo '<p>Rating: '.$cupcake["rating"].' stars</p>';
            echo '<p>Rate: '.$cupcake["rate"].'</p>';
            echo '<a href="welcome.php" class="btn btn-book">Book Now</a>';
            echo '</div>';
            echo '</div>';
        }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

