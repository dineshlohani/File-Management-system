<?php
require_once("includes/initialize.php");
?>
<?php if(!$session->is_logged_in()){ redirect_to("login.php");} ?>
<?php
if(isset($_POST['submit']))
{
	
}
$parent_topics = Topic::find_parent_topic();
?>

<?php require_once "menuincludes/header.php"; ?>

							<!-- Banner -->
					

							<!-- Section -->
								<section>
									<header class="major">
										
									</header>
                                    <div class="irdform">
                                    <h4><?=$message?></h4>
                                    <h3>शिर्षकहरु</h3>
                                    	<table class="table">
                                          <tr>
                                          	<th>&nbsp;</th>
                                            <th>शिर्षक न०</th>
                                            <th>शिर्षकको नाम</th>
                                          </tr>
                                          <?php foreach($parent_topics as $parent): ?>
                                          	<tr>
                                            	<td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                            	<td><strong><?php echo $parent->topic_name; ?></strong></td>
                                                
                                            </tr>
                                            <?php $topics = Topic::find_by_parent_id($parent->id);
												foreach($topics as $topic)
												{
												?>
                                                	<tr>
                                                    	<td>&nbsp;</td>
                                                        <td><?php echo convertedcit($topic->topic_no); ?></td>
                                                        <td><?php echo $topic->topic_name; ?></td>
                                                    </tr>
                                                <?php
												
												}
											 ?>
                                          <?php endforeach; ?>
                                        </table>

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