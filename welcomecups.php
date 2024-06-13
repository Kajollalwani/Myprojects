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
    <title>Muffins</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: url('cupwlcm.png'); /* Background image for the page */
            background-size: cover;
            background-position: center;
        }
        .navbar {
            background-color: rgba(0, 0, 255, 0.1); /* Transparent background */
            height: 40px;
            font-family: cursive;
            margin-bottom:600px;
            

        }
        .popup {
            position: relative;
            width: 80%;
            max-width: 600px;
            background-color: rgba(0, 0, 0, 0.7);
            padding: 20px;
            border-radius: 20px;
            text-align: center;
            color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .popup img {
            width: 100%;
            border-radius: 20px;
        }
        .popup h1 {
            font-size: 2em;
            margin: 20px 0;
        }
        .btn-explore {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
        .btn-explore:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <?php require 'raw/_nav.php' ?>

    <div class="popup">
        <img src="cupwlcm.png" alt="Muffins">
        <h1>Indulge in the Magic of Muffins - Where Every Bite is a Sweet Delight!</h1>
        <a href="cupcakes.php" class="btn-explore">Explore Cupcakes</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
