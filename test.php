<?php
require_once("includes/initialize.php");
?>
<?php if(!$session->is_logged_in()){ redirect_to("login.php");} ?>
<?php
	//$topic = new Topic();
	//$topic->savePostData($_POST,"create");
	//$session->message("topic created");	
for($i=20; $i<75; $i++)
{
	$fiscal = new Fiscalyear();
	$j = $i +1;
	$fiscal->year = "20".$i.".".$j;
	$fiscal->save();
}
//$parent_topics = Topic::find_parent_topic();
?>

	</body>
</html>