<?php
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
  $loggedin=true;
}
else{
  $loggedin=false;
}
?>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="/homeproj">Homemadeium Bakes</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/homeproj/welcome.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/homeproj/cakes.php">Cakes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/homeproj/welcomecups.php">Cupcakes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/homeproj/contact.php">Contact Us</a>
        </li>
        <?php if(!$loggedin): ?>
        <li class="nav-item">
          <a class="nav-link" href="/homeproj/login.php">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/homeproj/signup.php">Signup</a>
        </li>
        <?php endif; ?>
        <?php if($loggedin): ?>
        <li class="nav-item">
          <a class="nav-link" href="/homeproj/logout.php">Logout</a>
        </li>
        <?php endif; ?>
      </ul>
      <div class="d-flex">
        <a href="/homeproj/profile.php" class="nav-link"> 
          <div style="width: 30px; height: 30px; background-color: black; border-radius: 50%; margin-right: 10px;"></div>
        </a>
        <!-- <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form> -->
      </div>
    </div>
  </div>
</nav>
