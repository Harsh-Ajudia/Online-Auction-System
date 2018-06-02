<li class="nav-item">
							<button type="button" class="btn btn-outline-primary mr-2" data-toggle="modal" id="popupbutton" data-target="#exampleModalCenter">
							  Login/Signup
							</button>
							<!-- Sign in/ Sign up -->
							<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
							  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
								<div class="modal-content">
								  <div class="modal-header">
									<h5 class="modal-title" id="exampleModalLongTitle">Welcome to Auction</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									  <span aria-hidden="true">&times;</span>
									</button>
								  </div>
								  <div class="modal-body">
											<ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
											  <li class="nav-item">
												<a class="nav-link active" id="login-tab" data-toggle="tab" href="#login" role="tab" aria-controls="login" aria-selected="true">Login</a>
											  </li>
											  <li class="nav-item">
												<a class="nav-link" id="signup-tab" data-toggle="tab" href="#signup" role="tab" aria-controls="signup" aria-selected="false">Sign Up</a>
											  </li>
											</ul>
											<div class="tab-content" id="myTabContent">
											  <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
													<div class="row p-4">
														<div class="col-md-6 text-center">
															<h6 class="text-center mb-sm-4">Get start with your Bidding</h6>
															<p>Get your wishlist and recommendations</p>
															<?php if(isset($error_msg_login)){ echo '<div class="alert alert-danger" role="alert">
																			  <strong>Note: </strong>
																				' .$error_msg_login. '</div>'; } ?>
														</div>
														<div class="col-md-6">
															<form name="login_form" method="POST">
															  <div class="form-group">
																<label for="exampleInputEmail1">Mobile number/Email address</label>
																<input type="email" name="userlogin" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email...">
															  </div>
															  <div class="form-group">
																<label for="exampleInputPassword1">Password</label>
																<input type="password" name="passlogin" class="form-control" id="exampleInputPassword1" placeholder="Password">
															  </div>
															  <div class="form-check">
																<input type="checkbox" class="mt-sm-1 form-check-input" id="exampleCheck1">
																<label class="form-check-label" for="exampleCheck1">Remember me</label>
															  </div>
															  <button type="submit" name="loginbutton" class="btn btn-primary btn-block mt-sm-3">Submit</button>
															</form>
														</div>
													</div>
											  </div>
											  <div class="tab-pane fade" id="signup" role="tabpanel" aria-labelledby="signup-tab">
													<div class="tab-content" id="myTabContent">
													  <div class="tab-pane fade show active" id="step1" role="tabpanel" aria-labelledby="step1-tab">
															<div class="row p-3">
																<div class="col-sm-6">
																<div class="alert alert-info" role="alert">
																  <strong>Note: </strong>
																	<p>After entering an email we will send you an OTP for account confirmation which is required.<br/>
																</div>
																</div>
																<div class="col-sm-6">
																		<form method="POST" name="signup1">
																		  <div class="form-group">
																			
																				<?php if(isset($error_msg)){ echo '<div class="alert alert-danger" role="alert">
																			  <strong>Note: </strong>
																				' .$error_msg. '</div>'; } ?>																		
																			<label for="emailsignup">Email address</label>
																			<input name="emailforsignup" type="email" class="form-control" id="emailsignup" aria-describedby="emailHelp" placeholder="Enter email" required> 
																			<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
																		  </div>
																		  
																		  <button type="submit" name="signstep1" class="text-center btn btn-primary">Proceed <i class="fas fa-angle-right mr-3 fa-lg"></i></button>
																		</form>
																		<?php if(isset($script)){ echo $script; } ?>
																		<h6 class="mt-1">Existing User? Log in<a class="btn text-primary btn-link" onclick="$('#login-tab').trigger('click')">here</a></h6>
																</div>
															</div>
														</div>
													 </div>
											  </div>
											</div>
								  </div>
								  <div class="modal-footer">
									C
								  </div>
								</div>
							  </div>
							</div>
						  </li>
