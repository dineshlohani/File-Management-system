<?php 
    require_once("includes/initialize.php");
    $id = $_POST['name'];
    $project_name = Project::find_by_id($id);
    $project_type = Plan_type::getName($project_name->type);
    // print_r($project_type);
    $project_budget_name = Budget_topic::getName($project_name->budget_topic);
    $data = array(
        'project_name' => $project_name,
        'project_type' => $project_type,
        'project_budget_name' => $project_budget_name
    );
    // print_r($project_budget_name);
    echo json_encode($data);
?>