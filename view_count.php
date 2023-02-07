<?php
require_once("includes/initialize.php");
?>
<?php if(!$session->is_logged_in()){ redirect_to("login.php");} ?>
<?php
	if(isset($_GET['submit']))
	{
		if($_GET['doc_id']==1)
		{
			$data = new Filefile();
		}
		if($_GET['doc_id']==2)
		{
			$data = new Fileregister();
		}
		if($_GET['doc_id']==3)
		{
			$data = new Fileother();
		}
		$data->savePostData($_POST, "create");	
		$session->message("Entry Successful");
		redirect_to("new_entry.php");
	}
$fiscals = Fiscalyear::find_all();
$parent_topics = Topic::find_all();
$array = array(); 
foreach($parent_topics as $topic)
{
	if($topic->id==1)
	{
		$array[$topic->id]= Filefile::count_all();
	}
	elseif($topic->id==2)
	{
		$array[$topic->id] = Fileregister::count_all();
	}	
	else
	{
		$array[$topic->id] =  Fileother::count_all();
	}
	
}
?>

<?php require_once "menuincludes/header.php"; ?>

							<!-- Banner -->
					

							<!-- Section -->
								<section>
									<header class="major">
										</header>
                                    <div class="irdform">
                                    <h4><?=$message?></h4>
                                    <?php foreach($array as $key => $value): 
											$topic_selected = Topic::find_by_id($key);
									?>
                                    	<div>
                                        	<span><h3><?=$topic_selected->name?> : <?=$value?></h3></span>
                                        </div>
                                    <?php endforeach; ?>
                                    <h2> जम्मा: <?=array_sum($array)?></h2>
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