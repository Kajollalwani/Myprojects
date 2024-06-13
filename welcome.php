<?php
session_start();
// session is not set or session is not true
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: login.php");
    exit;
}

// Database connection
$server = "localhost";
$username = "root";
$password = "";
$database = "users";

$conn = mysqli_connect($server, $username, $password, $database);
if (!$conn) {
    die("Error" . mysqli_connect_error());
}

// Initialize order variables
$orderConfirmed = false;
$orderName = '';
$orderCakeType = '';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $address = $_POST['address'];
    $cakeType = $_POST['cakeType'];

    // Prepare SQL insert statement
    $sql = "INSERT INTO orders (name, email, phone, date, time, address, cakeType) 
            VALUES ('$name', '$email', '$phone', '$date', '$time', '$address', '$cakeType')";

    // Execute the insert query
    if (mysqli_query($conn, $sql)) {
        $orderConfirmed = true;
        $orderName = $name;
        $orderCakeType = $cakeType;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>welcome - <?php echo $_SESSION['username'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            overflow-x: hidden; /* Prevent horizontal scrolling */
            display: flex;
            flex-direction: column;
        }
        h6{
          font-size: 30px;
        }
        .navbar {
            z-index: 2;
            background-color: rgba(0, 0, 255, 0.1); /* Transparent background */
            height: 40px;
            font-family: cursive;
        }
        .content {
            flex: 1;
            position: relative;
            z-index: 1;
            color: white;
            padding: 1rem;
        }
        .scrollable-container {
            height: 200vh; /* Adjust the height of the scrollable area */
            overflow-y: auto; /* Enable vertical scrolling */
            position: relative; /* Required for absolute positioning */
        }
        .video-container, .image-container {
            width: 100%;
            height: 140vh; /* Set the height of each container to full viewport height */
            position: relative;
            overflow: hidden;
        }
        .video-container {
            background-color: black; /* Optional: Set a background color for the video container */
        }
        .bg-video, .bg-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .logo-image {
            position: absolute;
            top: 20px; /* Adjust top position as needed */
            right: 70px; /* Adjust right position as needed */
            width: 150px; /* Adjust width as needed */
            z-index: 1; /* Ensure the logo appears above the video */
            margin-top:220px;
            margin-right:40px;
            border-radius:50%;
            animation: logoAnimation 3s infinite alternate; /* Animation effect */
        }
        @keyframes logoAnimation {
            0% {
                transform: scale(2);
            }
            100% {
                transform: scale(1.3);
            }
        }

        
        .form-container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 2rem;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 0.5rem;
            width: 450px; /* Adjusted width */
        }
        .custom-alert {
            position: absolute;
            top: 20px;
            left: 20px;
            padding: 1rem;
            background-color: rgba(0, 0, 0, 0.8);
            color: white;
            border-radius: 0.5rem;
            display: none; /* Initially hidden */
            z-index: 3;
        }
    </style>
</head>
<body>
    <?php require 'raw/_nav.php' ?>

    <div class="scrollable-container">
        <!-- Video element as background -->
        <div class="video-container">
            <video class="bg-video" autoplay loop muted>
                <source src="cake2.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            <img src="homemadeium.jpg" class="logo-image" alt="Logo">
            <!-- Custom alert box positioned within the video container -->
            <div class="custom-alert" id="customAlert"></div>
        </div>
          =
        <!-- Image container -->
        <div class="image-container">
            <img src="formbg.jpg" class="bg-image" alt="alternative_text">
            <div class="form-container">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="mb-3">
                      <h6>BOOK YOUR CAKE</h6>
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="tel" class="form-control" id="phone" name="phone" required>
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" class="form-control" id="date" name="date" required>
                    </div>
                    <script>
                        // Get today's date
                        var today = new Date();

                        // Format today's date as YYYY-MM-DD
                        var dd = String(today.getDate()).padStart(2, '0');
                        var mm = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
                        var yyyy = today.getFullYear();

                        today = yyyy + '-' + mm + '-' + dd;

                        // Set the min attribute of the date input to today's date
                        document.getElementById("date").min = today;
                    </script>
                    <div class="mb-3">
                        <label for="time" class="form-label">Time</label>
                        <input type="time" class="form-control" id="time" name="time" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="cakeType" class="form-label">Choose a cake</label>
                        <select class="form-select" id="cakeType" name="cakeType" required>
                            <option value="chocolate">Chocolate Cake <p>$12</option>
                            <option value="vanilla">Vanilla Cake<p>$10</option>
                            <option value="strawberry">Strawberry Cake<p>$15</option>
                            <option value="mocha">Mocha Cake<p>$13</option>
                            <option value="pineapple">Pineapple Cake<p>$12</option>
                            <option value="rasmalai">Rasmalai Cake<p>$17</option>
                            <option value="donuts">Donuts<p>$15</option>
                            <option value="truffle">Chocolate Truffle Cake<p>$18</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-secondary">Cancel</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Function to show custom alert
        function showCustomAlert(message) {
            var customAlert = document.getElementById("customAlert");
            customAlert.innerText = message;
            customAlert.style.display = "block";
            setTimeout(function() {
                customAlert.style.display = "none";
            }, 50000);
        }

        // Show alert message immediately after login
        <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true && !isset($_SESSION['alert_shown'])): ?>
            alert("Welcome - <?php echo $_SESSION['username'] ?>! Hey, how are you doing? Welcome to Homemadeium Bakes. You are logged in as <?php echo $_SESSION['username'] ?>.");
            showCustomAlert("Welcome - <?php echo $_SESSION['username'] ?>! You are logged in.Welcome to Homemadeium Bakes.Ready to order,eat,and repeat?Let's get started");
            <?php $_SESSION['alert_shown'] = true; ?>
        <?php endif; ?>

        // Show alert message after order is confirmed
        document.addEventListener('DOMContentLoaded', function() {
            <?php if ($orderConfirmed): ?>
                alert("Your order for <?php echo $orderName; ?> has been submitted for <?php echo $orderCakeType; ?>.");
                showCustomAlert("Your order for <?php echo $orderName; ?> has been submitted for <?php echo $orderCakeType; ?>.");
            <?php endif; ?>
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+FA+oEGH5c8ANrCtvkyoTIhoGeylD" crossorigin="anonymous"></script>
</body>
</html>
