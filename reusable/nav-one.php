<?php
  if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Start the session if it's not already started
  }
  // Get the current page name
  $current_page = basename($_SERVER['PHP_SELF']);
?>
<header>
  <nav class="navbar navbar-expand-lg position-relative p-0 h-100">
    <div class="container">
      <a class="navbar-brand" href="admin.php"><img src="./assets/images/logo.png" alt="Galleria-Logo" /></a>
      <button class="navbar-toggler p-0" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavBar"
        aria-controls="mainNavBar" aria-expanded="false" aria-label="Toggle navigation">
        <i class="navbar-toggler-icon fa-solid fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="mainNavBar">
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link <?php echo ($current_page == 'admin.php') ? 'active' : ''; ?>" href="admin.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo ($current_page == 'addart.php') ? 'active' : ''; ?>" href="addart.php">Add
              Art</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo ($current_page == 'logout.php') ? 'active' : ''; ?>" href="logout.php">Logout</a>
          </li>
        </ul>
        <div class="user-header d-flex align-items-center">
          <img src="./assets/images/user.png" alt="user-icon" class="order-lg-1">
          <p class="pe-lg-3 ps-3 ps-lg-0 mb-0 order-lg-0"><?php echo htmlspecialchars($_SESSION['name']); ?></p>
        </div>
      </div>
    </div>
  </nav>
</header>