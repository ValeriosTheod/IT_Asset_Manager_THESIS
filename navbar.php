<div class="nav">
  <input type="checkbox" id="nav-check">
  <div class="nav-header">
    <div class="nav-title">
      <?php
        
        if (isset($_SESSION["username"]))
        {
           echo 'Logged in as ' . $_SESSION["username"] . '!';
        }
      ?>
    </div>
  </div>
  <div class="nav-btn">
    <label for="nav-check">
      <span></span>
      <span></span>
      <span></span>
    </label>
  </div>
  
  <div class="nav-links">
    <a href="loginme.php" target="_self">Logout</a>
  </div>
</div>