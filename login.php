<?php require_once('includes/defines.php');require_once('includes/initialize.php');
        
            if (isset($_POST['submit']))
            {
                $username = $database->escape_value($_POST['username']);
                $password = $database->escape_value($_POST['password']);

                $found_user = User::authenticate_for_user($username, $password);
                
                if ($found_user)
                {
                    $session->login($found_user);	
                    redirect_to('index.php');
                }
                else
                {
                    $message = "Username or password did not match";		
                }
                
            }
        ?>
            <?php require_once "menuincludes/header.php"; ?>

							<!-- Banner -->
								<section id="banner">
									<div class="content">
										<header>
											<h1> </h1>
											<p></p>
										</header>
										
									</div>

								</section>

							<!-- Section -->
								<section>
									
                                    <div class="irdform loginpage">
                                    <form action="<?=htmlentities($_SERVER['PHP_SELF'])?>" method="post">
<!--                                    <table class="table">-->
                                        <label for=" Username">Username</label>
                                        <input type="text" name="username" required>
                                        <label for="password">Password</label>
                                        <input type="password" name="password" required />
                                        <br>
                                        <br>
                                        <input class="btn btn-lg btn-primary btn-block" type="submit" name="submit" value="Sign In" />
			 
<!--
                                          <tr>
                                            <td>Username</td>
                                            <td></td>
                                          </tr>
                                          <tr>
                                            <td>Password</td>
                                            <td></td>
                                          </tr>
                                          <tr>
                                          	<td>&nbsp;</td>
                                          	<td></td>
                                          </tr>
			
										</table>
-->
		  							</form>
                                    </div>
									
								</section>

							

						</div>
					</div>

				<!-- sidebar starts -->
					<?php require_once("menuincludes/sidebar.php"); ?>
				<!-- sidebar ends -->
			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>