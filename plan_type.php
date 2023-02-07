<?php
require_once("includes/initialize.php");
?>
<?php if(!$session->is_logged_in()){ redirect_to("login.php");} ?>
<?php
	if(isset($_POST['submit']))
	{
            if(!empty($_POST['update_id']))
            {
                $project_data = Plan_type::find_by_id($_POST['update_id']);
            }
            else
            {
                $project_data = new Plan_type;
            }
        unset($_POST['update_id']);
		$project_data->plan_type_name = $_POST['plan_type_name'];
		if($project_data->save())
                {
                    $session->message("Entry Successfull");
                    redirect_to("plan_type.php");
                }
	}
        if(isset($_GET['id']))
        {
            $result = Plan_type::find_by_id($_GET['id']);
        }
        else
        {
            $result = Plan_type::setEmptyobjects();
        }
    if(isset($_GET['del_id']))
    {
        $project_detail = Plan_type::find_by_id($_GET['del_id']);
        if($project_detail->delete())
        {
            $session->message("Delete Successfull");
            redirect_to("plan_type.php");
        }
    }
$projects = Plan_type::find_all();
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
                                                <th>योजना किसिम राख्नुहोस</th>
                                                <td><input type="text" name="plan_type_name" value="<?=$result->plan_type_name?>"></td>
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
                                            <th>क्र.स.</th>
                                            <th>योजना किसिम</th>
                                            <th></th>
                                        </tr>
                                        <?php $i=1; foreach($projects as $data){?>
                                        <tr>
                                            <td><?= convertedcit($i)?></td>
                                            <td><?=$data->plan_type_name?></td>
                                            <td>
                                                <a href="plan_type.php?id=<?=$data->id?>" class="btn btn-primary">सच्याउनुहोस</a>
                                                <a href="plan_type.php?del_id=<?=$data->id?>" class="btn btn-danger">हटाउनुहोस</a>
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