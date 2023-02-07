<?php
require_once("includes/initialize.php");
?>
<?php if(!$session->is_logged_in()){ redirect_to("login.php");} ?>
<?php
	if(isset($_POST['submit']))
        {
            if(!empty($_POST['update_id']))
            {
                $room_data = Room::find_by_id($_POST['update_id']);
            }
            else
            {
                $room_data = new Room;
            }
            $room_data->name = $_POST['name'];
            if($room_data->save())
            {
                if(!empty($_POST['update_id']))
                {
                    $session->message('परिमार्जन गर्न सफल');
                }
                else
                {
                    $session->message('हाल्न सफल');
                }
                redirect_to("settings_room_view.php");
            }
            
        }
        if(isset($_GET['update_id']))
        {
            $result = Room::find_by_id($_GET['update_id']);
        }
        else
        {
            $result = Room::setEmptyobject();
        }

        if(isset($_GET['del_id']))
        {
           $room_data = Room::find_by_id($_GET['del_id']);
           if($room_data->delete())
           {
               $session->message('हटाउन सफल');
               redirect_to('settings_room_view.php');
            }
        }
        
    $room_details = Room::find_all();  
?>

<?php require_once "menuincludes/header.php"; ?>

							<!-- Banner -->
					

							<!-- Section -->
<section>
        <header class="major">
                </header>
                                    <div class="irdform">
                                    <h4><?=$message?></h4>
                                    <form method="post" >
                                <table class="table-responsive">
                                    <tr>
                                        <td>कोठा नं &nbsp;</td>
                                        <td><input class="form-control" type="text" name="name" value="<?=$result->name?>" required></td>
                                        <td> <input type="submit" name="submit" class="btn save submithere" value="सेभ गर्नुहोस"> </td>
                                    </tr>
                                    <tr>
                                        <input type="hidden" name="update_id" value="<?=$result->id?>" hidden>

                                    </tr>

                                </table>
                        
                            </form>   
                    
                            <?php 
                                if(!empty($room_details))
                                {
                            ?>
                                    <h4>कोठा नं हरु</h4>
                             <table class="table table-bordered table-responsive">
                                        <tr>
                                            <th>क्र.सं.</th>
                                            <th>कोठा नं</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                     <?php 
                                        $i=1;
                                        foreach($room_details as $data):


                                         ?>
                                        <tr> 
                                            <td><?php echo convertedcit($i);?></td>
                                            <td><?= $data->name ?></td>
                                            <td><a href="settings_room_view.php?update_id=<?= $data->id ?>" class="btn btn-primary">सच्याउनु होस्</a>&nbsp;<a href="settings_room_view.php?del_id=<?= $data->id ?>" class="btn btn-danger">हटाउनु होस्</a></td>
                                        </tr>
                                     <?php
                                        $i++;
                                        endforeach;
                                     ?>
                                    </table>
                            <?php 
                                }
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