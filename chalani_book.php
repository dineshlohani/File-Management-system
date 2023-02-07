<?php
    require_once('includes/initialize.php');
if(!$session->is_logged_in()){ redirect_to("login.php");}
    $chalani = Chalani::find_all();
?>
<?php require_once "menuincludes/header.php"; ?>
<section>
        <header class="major">
                </header>
                        <div class="irdform">
                        <h4><?=$message?></h4>
                        <center><h3>चलानी किताब</h3><center>
                        <?php
                            if(!empty($chalani)) :
                        ?>
                                <table class="table table-responsive table-bordered table1">
                                    <thead>
                                        <th>क्र.स.</th>
                                        <th>कागजातको प्रकार</th>
                                        <th>परियोजन</th>
                                        <th>कोठा नं</th>
                                        <th>रायक नं</th>
                                        <th>रायकको खण्ड नं</th>
                                        <th>बुझिलिनेको नाम</th>
                                        <th>चलानी गरेको मिति</th>
                                        <th>फिर्ता गरेको मिति</th>
                                        <th>&nbsp;</th>
                                    </thead>
                                    <tbody>
                        <?php
                                $i = 1;
                                foreach($chalani as $data) :
                                    if($data->doc_id == 1)
                                    {
                                        $file = Filefile::find_by_id($data->file_id);
                                        $kagjat = "फायल";
                                    }
                                    elseif($data->doc_id == 2)
                                    {
                                        $file = Fileregister::find_by_id($data->file_id);
                                        $kagjat = "रेजिस्टर";
                                    }
                                    else if($data->doc_id == 3)
                                    {
                                        $file = Fileother::find_by_id($data->file_id);
                                        $kagjat = "अन्य";
                                    }
                                    $room       = Room::find_by_id($file->room_no);
                                    $rack       = Rack::find_by_id($file->rack_no);
                                    $rack_part  = RackPart::find_by_id($file->rack_part_no);
                                    $department = Department::find_by_id($data->department);
                                    $project    = Project::find_by_id($data->project);
                                    $firta_miti = "-";
                                    if(!empty($data->firta_miti))
                                    {
                                        $firta_miti = $data->firta_miti;
                                    }

                        ?>
                                    <tr>
                                        <td><?= convertedcit($i)?></td>
                                        <td><?= $kagjat ?></td>
                                        <td><?= $project->name ?></td>
                                        <td><?= $room->name ?></td>
                                        <td><?= $rack->name ?></td>
                                        <td><?= $rack_part->name ?></td>
                                        <td><?= $data->reciever_name?></td>
                                        <td><?= convertedcit($data->nepali_date) ?></td>
                                        <td><?= convertedcit($data->firta_miti) ?></td>
                                        <td>
                                            <?php if(empty($data->firta_miti)):?>

                                            <a href="file_return.php?id=<?=$data->id?>" class="btn btn-primary">फायल फिर्ता</a>
                                        <?php endif; ?>
                                        </td>
                                    </tr>
                            <?php $i++; endforeach;?>
                                </tbody>
                            </table>
                        <?php

                            else:
                                echo "<center><h4>डेटा खाली छ |</h4></center>";
                            endif;
                        ?>


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
