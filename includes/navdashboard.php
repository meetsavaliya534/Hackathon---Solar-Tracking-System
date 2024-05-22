    <nav class="navbar navbar-default navbar-static-top">
      <div class="container">
        <a class="navbar-brand" href="index">Sunray Solar systems</a>
        <ul class="nav navbar-nav">
          <li><a href="index">Home</a></li>
            <?php if($_SESSION['login_user_type'] != 3): ?>
            <?php if($_SESSION['login_user_type'] == 1 || $_SESSION['login_user_type'] == 2): ?>
              <li id="map-open">
              <a href="dashboard">Dashboard</a>
              </li>
              <li>
              <a href="logout.php" class="text-dark"><?php echo $name ?> <i class="fa fa-power-off"></i></a>
              </li>
            <?php endif; ?>
            <?php else: ?>
              <li>
              <a href="logout.php" class="text-dark">Log Out <i class="fa fa-power-off"></i></a>
              </li>
            <?php endif; ?>
        </ul>
      </div>
    </nav>
