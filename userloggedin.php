<div class="btn-group mb-1">
  <button type="button" class="btn btn-outline-primary"><?php echo $_SESSION["nameloggedin"]?></button>
  <button type="button" class="btn btn-outline-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <span class="sr-only">Toggle Dropdown</span>
  </button>
  <div class="dropdown-menu dropdown-menu-right">
	<a class="nav-link" href="Profile.php"><i class="fas fa-user-circle mr-3 fa-lg"></i>Profile</a>
	<a class="nav-link" href="Cart.php"><i class="fas fa-shopping-cart mr-3 fa-lg"></i>Cart</a>
	<a class="nav-link" href="includes/logout.php"><i class="fas fa-sign-out-alt mr-3 fa-lg"></i>Logout</a>
  </div>
</div>