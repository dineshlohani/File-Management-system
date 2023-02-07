<?php
require_once("includes/initialize.php");
?>
<?php if(!$session->is_logged_in()){ redirect_to("login.php");} ?>
<?php
	if(isset($_POST['submit']))
	{
            if(!empty($_POST['update_id']))
            {
                $project_data = Project::find_by_id($_POST['update_id']);
            }
            else
            {
                $project_data = new Project;
            }
                unset($_POST['update_id']);
		$project_data->name = $_POST['name'];
		$project_data->type = $_POST['type'];
		$project_data->budget_topic = $_POST['budget_topic'];
		if($project_data->save())
                {
                    $session->message("Entry Successfull");
                    redirect_to("projects_view.php");
                }
	}
        if(isset($_GET['id']))
        {
            $result = Project::find_by_id($_GET['id']);
        }
        else
        {
            $result = Project::setEmptyobjects();
        }
    if(isset($_GET['del_id']))
    {
        $project_detail = Project::find_by_id($_GET['del_id']);
        if($project_detail->delete())
        {
            $session->message("Delete Successfull");
            redirect_to("projects_view.php");
        }
    }
$projects = Project::find_all();
$plan_type = Plan_type::find_all();
$budget_topic = Budget_topic::find_all();
// print_r($budget_topic);
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
                                            <tr>
                                                <th>किसिम छानुहोस</th>
                                                <td>
                                                <select name="type">
                                                    <option>--Select--</option>
                                                        <?php foreach($plan_type as $pt):?>
                                                            <option value="<?=$pt->id?>"><?=$pt->plan_type_name;?></option>
                                                        <?php endforeach;?>
                                                </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>बजेट शिर्षक छान्नुहोस</th>
                                                <td>
                                                <select name="budget_topic">
                                                    <option>--Select--</option>
                                                    <?php foreach ($budget_topic as $bt):?>
                                                        <option value="<?=$bt->id?>"><?=$bt->budget_name?></option>
                                                    <?php endforeach;?>
                                                </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>परियोजनाको नाम </th>
                                                <td><input type="text" name="name" value="<?=$result->name?>"></td>
                                            </tr>
                                            <tr>
                                                <td><input type="hidden" name="update_id" value="<?=$result->id?>"></td>
                                                <td><input type="submit" name="submit" value="सेभ गर्नुहोस"></td>
                                            </tr>
                                        </table>
                                    </form>
                                    <?php if(!empty($projects)){?>
                                    <table>
                                        <tr>
                                            <th class="text-left">क्र.स.</th>
                                            <th class="text-center">परियोजनाको नाम</th>
                                            <th class="text-center">किसिम</th>
                                            <th class="text-center">श्रोत</th>
                                        </tr>
                                        <?php $i=1; foreach($projects as $data){?>
                                        <tr>
                                            <td style="text-center"><?= convertedcit($i)?></td>
                                            <td><?=$data->name?></td>
                                            <td><?php echo Plan_type::getName($data->type);?></td>
                                            <td><?php echo Budget_topic::getName($data->budget_topic)?></td>
                                            <td>
                                                <a href="projects_view.php?id=<?=$data->id?>" class="btn btn-primary">सच्याउनुहोस</a>
                                                <a href="projects_view.php?del_id=<?=$data->id?>" class="btn btn-danger">हटाउनुहोस</a>
                                            </td>
                                        </tr>
                                        <?php $i++;}?>
                                    </table>
                                    <?php }?>
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