<?php
require_once("includes/initialize.php");
?>
<?php if(!$session->is_logged_in()){ redirect_to("login.php");} ?>
<?php
	$res = array();
	$parent_topic_id = $_POST['parent_topic_id'];
	//$res['msg']= "here".$parent_topic_id; echo json_encode($res); exit;
	$sub_topics = Topic::find_by_parent_id($parent_topic_id);
	$html = '';
	$html .='<td></td><td><select name="sub_topic_id" required>';
	foreach($sub_topics as $topic)
	{
		$html .= '
				<option value="'.$topic->id.'">'.$topic->topic_name.'</option>
		';
		
		 
	}
	$html .= '</select></td>';
	$res['html']= $html;
	echo json_encode($res); exit;
?>