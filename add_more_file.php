<?php
require_once('includes/initialize.php');
$file_insides   = FileInside::find_all();
// print_r($file_insides);
    $html    = '';
    $html .='<select class="file_inside" name="file_inside[]" required>
            <option value="">---Select---</option>';
            foreach($file_insides as $fi): 
    $html .='<option value="'.$fi->id.'">'.$fi->name.'</option>'; 
            endforeach;
    $html .='<input type="text" name="v_number[]" class="v_number" placeholder="भौचर नं">';
    // print_r($html);
    $res['html'] = $html;
    echo json_encode($res);exit;
?>
