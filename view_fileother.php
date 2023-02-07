<?php
require_once("includes/initialize.php");
?>
<?php if(!$session->is_logged_in()){ redirect_to("login.php");} ?>
<?php
    $reg_no=$project=$remarks="";
    if(isset($_GET['submit']))
    {
        $datas = Fileother::find_by_params(3, $_GET['project'],$_GET['remarks']);
        $project = $_GET['project'];
        $remarks = $_GET['remarks'];

    }
$fiscals = Fiscalyear::find_all();
$parent_topics = Topic::find_all();
$projects = Project::find_all();

?>

<?php require_once "menuincludes/header.php"; ?>

							<!-- Banner -->


							<!-- Section -->
								<section>
									<header class="major">
										</header>
                                    <div class="irdform">
                                    <h4><?=$message?></h4>
                                    <form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                    	<table class="table">


                                            <tr>
                                          	<th>परियोजनाको नाम:</th>
                                                <td>
                                                    <select name='project' required>
                                                        <option value=''>---छान्नुहोस---</option>
                                                        <?php foreach($projects as $detail){?>
                                                            <option value='<?=$detail->id?>'<?php if($detail->id==$project){echo 'selected="selected"';}?>><?=$detail->name?></option>
                                                        <?php }?>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                          	<th>कैफियत</th>
                                                <td>
                                                    <input type='text' name="remarks" value="<?=$remarks?>"/>
                                                </td>
                                            </tr>
                                            <tr>
                                                  <th></th>
                                              <td><input type="submit" name="submit" value="खोज्नुहोस" /></td>
                                            </tr>

                                         </table>

                                    </form>
                                    <?php if(isset($datas)): ?>
                                    <table class="alt">
                                    	<tr>
                                        	<th>आ व</th>
                                           <th>प्रयोजनाको नाम </th>
                                            <th>कोठा न०</th>
                                            <th>रयाक न०</th>
                                            <th>रयाकको खण्ड  न०</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                        <?php foreach($datas as $data): ?>
                                        <?php
                                            $fiscal_selected = Fiscalyear::find_by_id($data->fiscal_id);
                                            $project = Project::find_by_id($data->project);
                                            $room               = Room::find_by_id($data->room_no);
                                            $rack               = Rack::find_by_id($data->rack_no);
                                            $rack_part          = RackPart::find_by_id($data->rack_part_no);
					?>

                                        <tr>
                                            <td><?=$fiscal_selected->year?></td>
                                            <td><?=$project->name?></td>
                                            <td><?=$room->name?></td>
                                            <td><?=$rack->name?></td>
                                            <td><?=$rack_part->name?></td>
                                            <td>
                                                <a href="chalani.php?id=<?=$data->id?>&doc_id=3" class="btn btn-success">चलानी गर्नुहोस्</a>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </table>
                                    <?php endif; ?>
                          		</div>

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
