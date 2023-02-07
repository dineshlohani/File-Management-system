<?php
require_once("includes/initialize.php");
$mode = User::find_all();
// echo "<pre>";
// print_r($mode);
?>
<?php if(!$session->is_logged_in()){ redirect_to("login.php");} ?>
<?php require_once "menuincludes/header.php"; ?>
							<!-- Banner -->
								<section id="banner">
									<div class="content" style="margin-left: 150px;">
										<center>
											<h3><strong><?=PALIKA_NAME?></strong></h3>
											<h2><strong><?=PALIKA_SUB_NAME?></strong></h2>
											<h3><strong><?=PALIKA_ADD?></strong></h3>
										</center>
									</div>
									<span class="image object" style="margin-right: -349px;">
										<img src="images/logo.PNG" alt="Govt Logo" style="width:150px;">
									</span>
								</section>
								<!-- banner ends -->
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