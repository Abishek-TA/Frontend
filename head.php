<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="./Asset/css/Header1.css" />
  <link rel="stylesheet" href="./Asset/css/styles.css" />
  <script src="./Asset/js/index.js" async></script>
</head>
<body>
  <!--Code for NAVBAR (Page-1,step-1)-->
  <div id="head1">
    <header>
      <div class="logo">ARROWGRUB</div>
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
            <a href="tel:9488526319">Contact</a>
          </li>
          <?php
          session_start();
          if(isset($_SESSION['username'])) {
              echo '<li><a href="./orders.php">Orders</a></li>';
              echo '<li><div class="well"><h3>Welcome, ' . $_SESSION['username'] . '</h3></div></li>';
              echo '<li><div class="btnclass3"><a href="./logout.php"><button>Logout</button></a></div></li>';
          } else {
              echo '<div class="btnclass1">
                      <a href="./login.html">
                        <button>Login</button>
                      </a>
                    </div>';
              echo '<div class="btnclass2">
                      <a href="./signup1.html">
                        <button>Signup</button>
                      </a>
                    </div>';
          }
          ?>
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
</html>
