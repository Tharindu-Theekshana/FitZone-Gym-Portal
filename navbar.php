<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FitZone</title>
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <?php
  session_start();
  $isLoggedIn = isset($_SESSION["user_id"]);
  $isAdmin = isset($_SESSION["role"]) && ($_SESSION["role"] === "admin" || $_SESSION["role"] === "management");
  ?>
  <nav class="navbar">
    <div class="logo">FitZone</div>
    <ul class="navLinks">
      <li><a href="home.php">Home</a></li>
      <li><a href="services.php">Services</a></li>
      <li><a href="membership.php">Membership</a></li>
      <li><a href="register.php">Register</a></li>
      <li><a href="blog.php">Blog</a></li>
      <li><a href="contact.php">Contact Us</a></li>
      <li><a href="about.php">About Us</a></li>
      <?php if ($isLoggedIn): ?>
        <li><a href="profile.php">Profile</a></li>
        <li><a href="login.php" onclick="logoutAlert()">Logout</a></li>
        <?php if ($isAdmin): ?>
          <li><a href="dashboard.php">Dashboard</a></li>
        <?php endif; ?>
      <?php else: ?>
        <li><a href="login.php">Login</a></li>
      <?php endif; ?>

      <li>
        <a href="" onclick="toggleSearch(event)">Search</a>
      </li>
    </ul>
    <div class="searchBar">
      <form action="search.php" method="post">
        <input type="text" placeholder="Search..." name="searchInput" />
        <input type="submit" value="Search" name="searchArticle" />
        <input type="button" onclick="toggleSearch(event)" value="Close" />
      </form>
    </div>
    <div class="menuIcon" onclick="toggleMenu()">
      <img src="images/menu.svg" alt="menu" />
    </div>
  </nav>
  <script>
    const click = false;

    function toggleMenu() {
      const navLinks = document.querySelector(".navLinks");
      navLinks.classList.toggle("active");
    }
    function toggleSearch(event) {
      event.preventDefault();

      const navLinks = document.querySelector(".navLinks");
      const searchBar = document.querySelector(".searchBar");

      if (searchBar.style.display === "flex") {
        searchBar.style.display = "none";
        navLinks.style.display = "flex";
      } else {
        searchBar.style.display = "flex";
        navLinks.style.display = "none";
      }
    }

    function logoutAlert() {
      if (confirm("Do you really want to logout ?")) {
        window.location.href = 'login.php?logout=true';
        alert("Logout successfully.");

      } else {
        alert("Action canceled.");

      }
    }
  </script>
</body>

</html>