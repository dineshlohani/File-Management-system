<?php
require_once("includes/initialize.php");
?>
<?php if(!$session->is_logged_in()){ redirect_to("login.php");} ?>
<?php
    $reg_no= $file_type =$file_inside=$project=$remarks="";
    if(isset($_GET['submit']))
    {
        $datas = Filefile::find_by_params(1, $_GET['project'], $_GET['reg_no'], $_GET['file_type'], $_GET['file_inside'],$_GET['remarks']);
        $reg_no = setornot($_GET['reg_no']);
        $file_inside = setornot($_GET['file_inside']);
        $file_type = setornot($_GET['file_type']);
        $project = $_GET['project'];
        $remarks = $_GET['remarks'];

    }
$fiscals = Fiscalyear::find_all();
$parent_topics = Topic::find_all();
$projects = Project::find_all();
$file_types = array(1=>"Index",2=>"Turing",3=>"Paperfile");
$file_insides = FileInside::find_all();
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
                                                  <th>दर्ता न०</th>
                                              <td><input type="text" name="reg_no" value='<?=$reg_no?>' /></td>
                                            </tr>
                                             <tr>
                                                    <th>फायलको प्रकार </th>
                                                    <td>
                                                        <select name="file_type"  >
                                                            <option value=''>--छान्नुहोस्--</option>
                                                            <?php foreach ($file_types as $key => $value) {?>
                                                            <option value='<?=$key?>'<?php if($key==$file_type){echo 'selected="selected"';}?>><?=$value?></option>
                                                            <?php }?>

                                                        </select>
                                                     </td>
                                            </tr>
                                            <tr>
                                          	<th>फायल भित्र</th>
                                                <td>
                                                    <select name="file_inside">
                                                        <option value="">--छान्नुहोस--</option>
                                                        <?php foreach ($file_insides as $data) {?>
                                                            <option value='<?=$data->id?>'<?php if($data->id==$file_inside){echo 'selected="selected"';}?>><?=$data->name?></option>
                                                            <?php }?>
                                                    </select>
                                                </td>
                                          </tr>
                                          <tr>
                                          	<th>कैफियत</th>
                                                <td>
                                                    <input type="text" name="remarks" value="<?=$remarks?>"/>
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
                                            <th>दर्ता न०</th>
                                            <th>प्रयोजनाको नाम</th>
                                            <th>फायलको प्रकार</th>
                                            <th>फायलको भित्र</th>
                                            <th>कोठा नं</th>
                                            <th>र्याक नं</th>
                                            <th>र्याकको खण्ड नं</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                        <?php foreach($datas as $data): ?>
                                        <?php
                                            $fiscal_selected    = Fiscalyear::find_by_id($data->fiscal_id);
                                            $project            = Project::find_by_id($data->project);
                                            $room               = Room::find_by_id($data->room_no);
                                            $rack               = Rack::find_by_id($data->rack_no);
                                            $rack_part          = RackPart::find_by_id($data->rack_part_no);
                                            $selected_file_inside = FileInside::find_by_id($data->file_inside);
					?>

                                        <tr>
                                            <td><?=$fiscal_selected->year?></td>
                                            <td><?=$data->reg_no?></td>
                                            <td><?=$project->name?></td>
                                            <td><?=$file_types[$data->file_type]?></td>
                                            <td><?=$selected_file_inside->name?></td>
                                            <td><?=$room->name?></td>
                                            <td><?=$rack->name?></td>
                                            <td><?=$rack_part->name?></td>
                                            <td>
                                                <a href="chalani.php?id=<?=$data->id?>&doc_id=1" class="btn btn-success">चलानी गर्नुहोस्</a>
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
