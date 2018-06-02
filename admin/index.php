<?php
ob_start();
include_once('header.php');
/*Home page*/
$page='homepage';
if($_SESSION['isadminloggedin']==1){

?>
<nav class="navbar navbar-dark bg-dark text-right">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#left-bar" aria-controls="left-bar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  </nav>


<div class="container-fluid">
	<div class="row leftRow">
		<div class="col-md-2 bg-dark leftSide" id="left-bar">
			<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
			  <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-dashboard" role="tab" aria-controls="v-pills-home" aria-selected="true"><i class="fas fa-tachometer-alt mr-sm-2 fa-lg"></i>Dashboard</a>
			  
			  <!--a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false"><i class="fas fa-user-circle mr-sm-2 fa-lg"></i>Profile</a-->
			  
			  <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-pages" role="tab" aria-controls="v-pills-profile" aria-selected="false"><i class="fas fa-file-alt mr-sm-2 fa-lg"></i>Pages</a>
			  
			  <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-users" role="tab" aria-controls="v-pills-profile" aria-selected="false"><i class="fas fa-users mr-sm-2 fa-lg"></i>Users</a>
			  
			  <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-category" role="tab" aria-controls="v-pills-profile" aria-selected="false"><i class="fas fa-object-ungroup mr-sm-2 fa-lg"></i>Category</a>
			  
			  <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false"><i class="fas fa-envelope mr-sm-2 fa-lg"></i>Messages</a>
			  
			  <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false"><i class="fas fa-cogs mr-sm-2 fa-lg"></i>Settings</a>
			</div>
		</div>
		<div class="col-md-10">
			<div class="container">
				<div class="tab-content" id="v-pills-tabContent">
				  <div class="tab-pane fade show active" id="v-pills-dashboard" role="tabpanel" aria-labelledby="v-pills-home-tab">
					<?php include_once('dashboard.php');?>
				  </div>
				  <!--div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
					<?php //include_once('Profile.php');?>
				  </div-->
				  <div class="tab-pane fade show" id="v-pills-pages" role="tabpanel" aria-labelledby="v-pills-profile-tab">
					<?php include_once('pages.php');?>
				  </div>
				  <div class="tab-pane fade show" id="v-pills-users" role="tabpanel" aria-labelledby="v-pills-profile-tab">
					<h1 class="text-center font-weight-light">Users</h1>
					<?php include_once('users.php');?>
				  </div>
				  <div class="tab-pane fade show" id="v-pills-category" role="tabpanel" aria-labelledby="v-pills-profile-tab">
					<?php include_once('category.php');?>
				  </div>
				  <div class="tab-pane fade show" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
					<?php include_once('messages.php');?>
				  </div>
				  <div class="tab-pane fade show" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
					<?php include_once('settings.php');?>
				  </div>
				</div>
			</div>
		</div>
		
	</div>
</div>

<?php
include_once('footer.php');
}
else{
	header('Location: login.php');
}
?>
