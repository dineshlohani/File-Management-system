<?php
    $res    = [];
    $html   = "<input type='file' name='documents[]' class='form-control documents'>";
    $res['html'] = $html;
    echo json_encode($res);exit;
?>
