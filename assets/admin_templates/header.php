<header>
  <div class="container">
    <h1 class="logo">News outloud</h1>
    <nav>
      <ul class="menu">
        <?php if (isset($_SESSION['username'])): ?>
        <li><a href="index.php">Home</a></li>
        <li><a href="#">Categories</a></li>
        <li><a href="logout.php">Logout</a></li>
        <?php else: ?>
        <li><a href="login.php">Login</a></li>
        <?php endif; ?>
      </ul>

    </nav>
  </div>
</header>
<div class="hd-line"></div>