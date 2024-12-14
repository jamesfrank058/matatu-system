
<header>
    <nav class="navbar">
      <div class="container">
        <a id="mylogo" class="navbar-brand" href="home.php">Matatu-SACCOApp</a>
        <ul class="nav-links">
          <li><a href="members.php">Members</a></li>
          <li><a href="matatus.php">Matatus</a></li>
          <li><a href="drivers.php">Drivers</a></li>
          <li><a href="services.php">Services</a></li>
          <?php if (isset($_SESSION['username'])): ?>
                    <li><a href="logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="login.php">Login</a></li>
                <?php endif; ?>
        </ul>
      </div>
    </nav>
  </header>