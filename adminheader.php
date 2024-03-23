<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="./Asset/css/Header1.css" />
  <link rel="stylesheet" href="./Asset/css/styles.css" />
  <script src="./Asset/js/index.js" async></script>    
</head>
<body>
  <!--Code for NAVBAR (Page-1,step-1)-->
  <div id="head2">
    <header>
      <div class="logo">ARROWGRUB</div>
      <nav>
        <ul>
          <?php
          session_start();
          if(isset($_SESSION['username'])) {
            echo '<li><a href="./adminpage.php">Home</a></li>';
            echo '<li><a href="./absmenu.php">Menus</a></li>';
              echo '<li><div class="adminwel"><h3>Welcome, ' . $_SESSION['username'] . '</h3></div></li>';
              echo '<li><div class="btnclass3"><a href="./logout.php"><button>Logout</button></a></div></li>';
         } 
          ?>
        </ul>
      </nav>
      <label for="nav_check" class="hamburger">
     
      </label>
    </header>
  </div>
</body>
</html>