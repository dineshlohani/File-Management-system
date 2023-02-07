<?php
    require_once('includes/initialize.php');
     if(!$session->is_logged_in()){ redirect_to("login.php");} 
    $filefile       = Filefile::find_all();
    // $filefile       = Filefile::find_by_sql("SELECT * FROM filefile WHERE file_inside IN (7,8,9);");
    // print_r($filefile);
    $fileregister   = Fileregister::find_all();
    $fileother      = Fileother::find_all();
?>
<?php require_once "menuincludes/header.php"; ?>

							<!-- Banner -->


							<!-- Section -->
<section>
        <header class="major">
                </header>
                        <div class="irdform">
                        <h4 class="text-success"><?=$message?></h4>
                        <center><h3 style="text-success">फायल हेर्नुहोस</h3><center>
                            <center><u><h4>फायल</h4></u></center>
                        <table id="table1" class="table table-bordered table-responsive table-striped table1">
                        <thead>
                            <tr>
                            	<th>आ व</th>
                                <th>दर्ता न०</th>
                                <th>प्रयोजनाको नाम</th>
                                <th>फायलको प्रकार</th>
                                <th>फायलको भित्र</th>
                                <!-- <th>भौचर नं</th> -->
                                <th>कोठा नं</th>
                                <th>र्याक नं</th>
                                <th>र्याकको खण्ड नं</th>
                               <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($filefile as $data):
                            // echo "<pre>";
                            // print_r($data);
                              
                                            $fiscal_selected    = Fiscalyear::find_by_id($data->fiscal_id);
                                            $project            = Project::find_by_id($data->project);
                                            // print_r($project);
                                            $room               = Room::find_by_id($data->room_no);
                                            $rack               = Rack::find_by_id($data->rack_no);
                                            $rack_part          = RackPart::find_by_id($data->rack_part_no);
                                            $selected_file_inside = FileInside::find_by_sql("SELECT * FROM settings_file_inside WHERE id IN ($data->file_inside)");
                                            // $selected_file_inside1 = Filefile::find_by_sql("SELECT v_number FROM filefile WHERE v_number IN ($data->file_inside)");
                                            // echo "<pre>";
                                            // print_r($selected_file_inside1);

					        ?>
					        
                            <?php if($data->file_type==1){
                                $file_type_name = 'Index';
                            }elseif($data->file_type==2){
                                $file_type_name = 'Turing';
                            }else{
                                $file_type_name = 'Paperfile';
                            }
                            ?>
					        <tr>
                                <td><?=convertedcit($fiscal_selected->year)?></td>
                                <td><?=convertedcit($data->reg_no)?></td>
                                <td><?=$project->name?></td>
                                <td><?=$file_type_name?></td>
                                <td>
                                <?php foreach($selected_file_inside as $sfi){  
                                    echo '-'.' '.$sfi->name.' '.'<br>'.' ';
                                } ?>
                                </td>
                                <!-- <td> -->
                                <?php //foreach($selected_file_inside1 as $sfi){  
                                    //echo '-'.' '.$sfi->v_number.' '.'<br>'.' ';
                                //} ?>
                                <!-- </td> -->
                                <td><?=$room->name?></td>
                                <td><?=$rack->name?></td>
                                <td><?=$rack_part->name?></td>
                                <td>
                                    <a href="chalani.php?id=<?=$data->id?>&doc_id=1" class="btn btn-success">चलानी गर्नुहोस्</a>
                                </td>
                            </tr>
                            <?php endforeach;?>
                            </tbody>
                        </table>
                        <hr/> 
                        <center><u><h4>रेजिस्टर</h4></u></center>
                        <table class="table table-bordered table-responsive table-striped table1">
                            <thead>
                                <tr>
                                	<th>आ व</th>
                                   <th>प्रयोजनाको नाम </th>
                                    <th>कोठा न०</th>
                                    <th>रयाक न०</th>
                                    <th>रयाकको खण्ड  न०</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($fileregister as $data): ?>
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
                                        <a href="chalani.php?id=<?=$data->id?>&doc_id=2" class="btn btn-success">चलानी गर्नुहोस्</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                         <hr/> 
                        <center><u><h4>अन्य</h4></u></center>

                         <table class="table table-bordered table-responsive table-striped table1">
                             <thead>
                            	<tr>
                                	<th>आ व</th>
                                   <th>प्रयोजनाको नाम </th>
                                    <th>कोठा न०</th>
                                    <th>रयाक न०</th>
                                    <th>रयाकको खण्ड  न०</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($fileother as $data): ?>
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
                            </tbody>
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
