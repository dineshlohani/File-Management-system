<?php
    require_once("includes/initialize.php");
    if(!$session->is_logged_in()){ redirect_to("logout.php");}
    if(!$session->is_logged_in()){ redirect_to("logout.php");}
    $user= getUser();
    if($user->mode!="administrator")
    {
        die("Permission Denied");
    }

$users= User::find_all();  

?>
<?php require_once "menuincludes/header.php"; ?>

							<!-- Banner -->
            <section id="banner">
                    <div class="content">
                            <header>
                                    <h2>प्रयोगकर्ता हेर्नुहोस</h2>
<!--                                    <p>Agro Enterprise Centre </p>-->
                            </header>
                        <a class="pull-right btn btn-primary" href="user_add.php">प्रयोगकर्ता थप्नुहोस</a><br/><br/>
                            <?php echo $message;?>
                             <table class="table table-bordered table-responsive">
                                        <tr>
                                            <th>नाम</th>
                                            <th>नम्बेर </th>
                                            <th>यूसरनेम   </th>
                                            <th>वार्ड</th>
                                            <th>ई-मेल</th>
                                            <th>अवस्था</th>
                                            <th>मोड</th>
                                            
                                            <th>&nbsp</th>
                                        </tr>
                                        <?php foreach($users as $data):
                                             
                                             
                                            switch($data->status)
                                            {
                                                case 1:
                                                    $status="Active";
                                                    break;
                                                case 0:
                                                    $status="Inactive";
                                                    break;
                                            }
                                            if(!empty($data->mode))
                                            {
                                               $mode= $data->mode;     
                                            }
                                            
                                          ?>
                                        <tr>
                                            <td><?php echo $data->name;?></td>
                                            <td><?php echo convertedcit($data->phone);?></td>
                                            <td><?php echo $data->username;?></td>
                                            <td><?= convertedcit($data->ward) ?></td>
                                            <td><?php echo $data->email;?></td>
                                            <td><?php echo $status;?></td>
                                            <td><?php echo $mode;?></td>
                                            <td><a class="btn edit" href="user_edit.php?id=<?= $data->id ?>" >Edit</a></td>

                                        </tr>
                                        <?php endforeach; ?>
                        </table> 
									</div>
									
								</section>
								<!-- banner ends -->


							

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