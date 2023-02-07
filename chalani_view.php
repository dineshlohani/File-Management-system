<?php
    require_once('includes/initialize.php');
    if(!$session->is_logged_in()){ redirect_to("login.php");} 
    $doc_ids = [1=>"फायल",2=>"रेजिस्टर",3=>"अन्य"];
    $counts = [];
    foreach($doc_ids as $key => $value)
    {
        $count = Chalani::count_by_doc_id($key);
        $counts[$key] = $count;
    }
    $projects = Project::find_all();
?>
<?php require_once "menuincludes/header.php"; ?>
<section>
        <header class="major">
                </header>
                        <div class="irdform">
                        <h4><?=$message?></h4>
                        <center><h3>चलानी भएको फायलहरु</h3><center>
                        <h4>कागजातको प्रकारको आधारमा</h4>
                        <table class="table table-responsive table-bordered">
                            <tr>
                                <th>क्र.स.</th>
                                <th>कागजातको प्रकार</th>
                                <th>जम्मा</th>
                            </tr>
                            <?php $i=1; foreach($doc_ids as $key=>$value): ?>
                            <tr>
                                <td><?= convertedcit($i)?></td>
                                <td><?= $value?></td>
                                <td><?= convertedcit($counts[$key]) ?></td>
                            </tr>
                        <?php $i++; endforeach;?>

                        </table>
                        <br/>
                        <hr style="border:1px solid #000"/>
                        <h4>परियोजनाको आधारमा</h4>
                        <table class="table table-responsive table-bordered" >
                            <tr>
                                <th>क्र.स.</th>
                                <th>परियोजना</th>
                                <th>जम्मा</th>
                            </tr>
                        <?php
                            $i = 1;
                            foreach($projects as $project):
                                $count = Chalani::count_by_project($project->id);
                        ?>
                            <tr>
                                <td><?= convertedcit($i)?></td>
                                <td><?= $project->name ?></td>
                                <td><?= convertedcit($count)?></td>
                            </tr>
                        <?php $i++; endforeach;?>
                        </table>


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
