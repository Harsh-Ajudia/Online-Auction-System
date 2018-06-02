<?php
ob_start();
//$page='user';
include_once 'includes/db_connect.php';
	$get_messages="SELECT * FROM contact_us";
	$got_messages_result = mysqli_query($mysqli,$get_messages) or die("Error viewing information. Please try again.".mysqli_error($mysqli));
	
	$count_got_messages = mysqli_num_rows($got_messages_result);
	?>
	<div class="p-3 border">
		<h3 class="font-weight-light text-success">Messages</h3>
	<hr/>
	<?php
			if(isset($message)){ echo '<div class="alert alert-success" role="alert">
			  <strong>Note: </strong>
				' .$message. '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	  </button></div>'; }
			?>
	
	<div class="container mt-3">
		<?php 
		if($count_got_messages==0){
			echo '<h4 class="font-weight-light">0 results found for messages</h4>';
		}
		else{
			?>
			<table class="table table-striped">
			  <thead>
				<tr>
				  <th scope="col">Sr. no.</th>
				  <th scope="col">Name</th>
				  <th scope="col">Email</th>
				  <th scope="col">Subject</th>
				  <th scope="col">Message</th>
				  <th scope="col">Date</th>
				</tr>
			  </thead>
			  <tbody>
			  <?php
			  $countMessage = 1;
				while($got_mess = mysqli_fetch_assoc($got_messages_result)){?>
				
				<tr>
				<th scope="row"><?php echo $countMessage;?></th>
				<td><?php echo $got_mess['name'];?></td>
				<td><?php echo $got_mess['email'];?></td>
				<td><?php echo $got_mess['subject'];?></td>
				<td><?php echo $got_mess['message'];?></td>
				<td><?php echo $got_mess['date_contacted'];?></tr>
				</tr>
				<?php
				$countMessage = $countMessage + 1;
				}
				?>
			  </tbody>
			</table>
			
			<?php
		}
		?>
	</div>
	</div>