<?php
    require_once 'includes/initialize.php';
    if(isset($_GET['code']))
    {
        $code = $_GET['code'];
        $code_array = explode("/",$code);
        $project = Project::find_by_id($code_array[2]);
        $doc_id = $_GET['doc_id'];
        $files = array(1=>'फायल',2=>'रेजिस्टर',3=>'अन्य');
//        $project_data = Project::find_by_id($id)
 $rooms          = Room::find_by_id($code_array[1]);
$racks          = Rack::find_by_id($code_array[3]);
$rack_parts     = RackPart::find_by_id($code_array[4]);
        
    }
?>
<html>
    <body onload="window.print()">
    <center>
        <h2>नमुना नगरपालिका</h2>
        <h1>नगर कार्यपालिकाको कार्यालय</h1>
        <h2>कलंकी,काठमाडौँ</h2>
</center>
        <u><div class="text-left"> <h3>कागजात प्रकार:&nbsp;<?=$files[$doc_id]?></h3> </div></u>
        <hr>
        <table>
        	<tr>
        		<td style="padding:5px;">दर्ता नं:<td>
        		<td style="padding:5px;"><?=convertedcit($code_array[0])?><td>
        	</tr>
        	<tr>
        		<td style="padding:5px;">परियोजनाको नाम :<td>
        		<td style="padding:5px;"> <?=convertedcit($project->name)?> <td>
        	</tr>
            <tr>
        		<td style="padding:5px;">परियोजना बजेट श्रोत :<td>
        		<td style="padding:5px;"><?php echo Budget_topic::getName($project->budget_topic)?><td>
        	</tr>
            <tr>
        		<td style="padding:5px;">परियोजन किसिम :<td>
        		<td style="padding:5px;"><?php echo Plan_type::getName($project->type)?> <td>
        	</tr>
        	<tr>
        		<td style="padding:5px;"> रूम नं: <td>
        		<td style="padding:5px;"> <?= $rooms->name ?> <td>
        	</tr>
        	<tr>
        		<td style="padding:5px;"> र्याक नं: <td>
        		<td style="padding:5px;"> <?= $racks->name  ?> <td>
        	</tr>
        	<tr>
        		<td style="padding:5px;"> र्याकको खण्ड नं: <td>
        		<td style="padding:5px;"> <?= $rack_parts->name ?> <td>
        	</tr>
        </table>
        <!--<span>दर्ता नं:</span>&nbsp;<?=convertedcit($code_array[0])?><br/>-->
        <!--<span>प्रयोजनको नाम :</span>&nbsp;<?=convertedcit($project->name)?>-->
        <!--<br/>-->
        <!--<span>रूम नं:</span>&nbsp;<?= $rooms->name ?><br/>-->
        <!--<span>र्याक नं:</span>&nbsp;<?= $racks->name  ?><br/>-->
        <!--<span>र्याकको खण्ड नं:</span>&nbsp;<?= $rack_parts->name ?><br/>-->
    </body>
</html>
