<!DOCTYPE html>
<head>
  <link rel="stylesheet" href="./Asset/css/Header1.css" />
  <link rel="stylesheet" href="./Asset/css/styles.css" />
  <script src="./Asset/js/home.js" async></script>
</head>
<body>
  <!--Code for NAVBAR (Page-1,step-1)-->
  <div id="head2">
    <header>
      <div class="logo">ARROWGRUB</div>
      <input type="checkbox" id="nav_check" hidden />
      <nav>
        <ul>
          <li>
            <a href="./index.html" class="active">Home</a>
          </li>
          <li>
            <a href="./BookT.html">Book table</a>
          </li>
          <li>
            <a href="./about.html">About</a>
          </li>
          <li>
            <a href="./addrest.html">Add restaurant</a>
          </li>
          <div class="btnclass1">
            <?php
            session_start(); // Start the session to access session variables
            if (isset($_SESSION["username"])) { // Check if username is set in the session
            ?>
            <p class="name">
              <span>Welcome <?= $_SESSION["username"]?></span>
            </p>
            <?php
            } else {
              // Username is not set in the session, you may handle this case accordingly
              // For example, redirect the user to the login page
              header("Location: login.html");
              exit(); // Ensure script execution stops after redirection
            }
            ?>
          </div>
          <br>
          <br>
          <br>
          <div class="btnclass2">
            <a href="./logout.php" class="logoutlink">Log Out</a>
            <!-- <a href="./signup1.html"> 
                    <button>Signup</button> 
                  </a> -->
          </div>
        </ul>
      </nav>
      <label for="nav_check" class="hamburger">
        <div></div>
        <div></div>
        <div></div>
      </label>
    </header>
  </div>
</body>
