<?php
require_once("includes/initialize.php");
?>
<?php if(!$session->is_logged_in()){ redirect_to("login.php");} ?>

<?php 
	$res = array();

	$pan_no = $_POST['pan_no'];
	//$res['msg'] = $pan_no." inside"; echo json_encode($res); exit;
	if(empty($pan_no)){
		$res['msg'] = 'Pan/Vat no Empty';
		echo json_encode($res); exit;
	}
	$profile = Profile::find_by_pan_no($pan_no);
	$res['pan_no'] = $profile->pan_no;
	$res['taxpayer_company'] = $profile->business_name;
	//$res['msg'] = $profile->business_name." inside"; echo json_encode($res); exit;
	$res['taxpayer_name'] = $profile->taxpayer;
	echo json_encode($res);
	exit;
?>