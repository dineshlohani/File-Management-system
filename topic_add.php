<?php
require_once("includes/initialize.php");
?>
<?php if(!$session->is_logged_in()){ redirect_to("login.php");} ?>
<?php
if(isset($_POST['submit']))
{
	$topic = new Topic();
	$topic->savePostData($_POST,"create");
	$session->message("topic created");	
}
//$parent_topics = Topic::find_parent_topic();
?>

<?php require_once "menuincludes/header.php"; ?>

							<!-- Banner -->
					

							<!-- Section -->
								<section>
									<header class="major">
										</header>
                                    <div class="irdform">
                                    <h4><?=$message?></h4>
                                     <form method="post">
                                    	<table class="table">
                                         
                                          </tr>
                                           <tr>
                                            <td>शिर्षक</td>
                                            <td><input type="text" name="name"></td>
                                          </tr>

                                          <tr>
                                            <td>&nbsp;</td>
                                            <td><input type="submit" name="submit" value="सेभ गर्नुहोस"></td>
                                          </tr>
                                        </table>

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