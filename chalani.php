<?php
    require_once('includes/initialize.php');
     if(!$session->is_logged_in()){ redirect_to("login.php");} 
    if(!isset($_GET['id']) && !isset($_GET['doc_id']))
    {
        $session->message('समस्या आयो |');
        redirect_to('filesearch.php');
    }

        $id     = $_GET['id'];
        $doc_id = $_GET['doc_id'];
        if($doc_id == 1)
        {
            $file = Filefile::find_by_id($id);

        }
        elseif($doc_id == 2)
        {
            $file = Fileregister::find_by_id($id);

        }
        elseif($doc_id == 3)
        {
            $file = Fileother::find_by_id($id);

        }
        if(empty($file))
        {
            $session->message('समस्या आयो |');
            redirect_to('filesearch.php');
        }

    if(isset($_POST['submit']))
    {
        $chalani_detail = Chalani::find_by_file_id($_POST['file_id']);
        if($chalani_detail)
        {
            $session->message('चलानी भइसकेको छ |');
            redirect_to('file_search.php');
        }
        $chalani    = new Chalani;
        $path       = "documents/chalani";
        $temp_path  = $_FILES['document']['tmp_name'];
        $source = $_FILES['document']['name'];
        $ext = pathinfo($source, PATHINFO_EXTENSION);
        $file_name      = md5(uniqid().time()).".".$ext;
        $destination    = $path.$file_name;
        move_uploaded_file($temp_path,$destination);
        compress($destination,$destination,70);
        $_POST['document']       = $file_name;
        $_POST['date']           = DateNeptoEng($_POST['nepali_date']) ;

        if($chalani->savePostData($_POST,create))
        {
            $session->message('चलानी गर्न सफल');
            redirect_to('filesearch.php');
        }
        else
        {
            $session->message('समस्या आयो');
            redirect_to('chalani.php?id='.$_POST['id'].'&doc_id='.$_POST['doc_id']);
        }

    }

    $project        = Project::find_by_id($file->project);
    $departments    = Department::find_all();
    $room           = Room::find_by_id($file->room_no);
    $rack           = Rack::find_by_id($file->rack_no);
    $rack_part      = RackPart::find_by_id($file->rack_part_no);
?>
<?php require_once "menuincludes/header.php"; ?>

							<!-- Banner -->


							<!-- Section -->
<section>
        <header class="major">
                </header>
                        <div class="irdform">
                        <h4 class="text-success"><?=$message?></h4>
                        <center><h3>फायल चलानी गर्नुहोस</h3><center>
                        <form method="post" enctype="multipart/form-data">
                            <table class="table table-responsive table-bordered">
                                <tr>
                                    <th>परियोजनको नाम</th>
                                    <td><?= $project->name ?></td>
                                </tr>
                                <tr>
                                    <th>कोठा नं</th>
                                    <td><?= $room->name ?></td>
                                </tr>
                                <tr>
                                    <th>रायक नं</th>
                                    <td><?= $rack->name ?></td>
                                </tr>
                                <tr>
                                    <th>रायकको खण्ड नं</th>
                                    <td><?= $rack_part->name ?></td>
                                </tr>
                                <tr>
                                    <th>चलानी गर्नुपर्ने फाँट</th>
                                    <td>
                                        <select name="department" class="form-control">
                                            <option value="">छान्नुहोस्</option>
                                        <?php foreach($departments as $department) :?>
                                            <option value="<?= $department->id?>"><?= $department->name?></option>
                                        <?php endforeach;?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>बुझिलिनेको नाम</th>
                                    <td>
                                        <input type="text" name="reciever_name" class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <th>सिलिप</th>
                                    <td><input type="file" name="document" class="form-control"></td>
                                </tr>
                                <tr>
                                    <th>मिति</th>
                                    <td><input type="text" name="nepali_date" id="nepaliDate3"></td>
                                </tr>
                            </table>
                            <input type="hidden" name="project" value="<?= $file->project?>">
                            <input type="hidden" name="file_id" value="<?= $id ?>">
                            <input type="hidden" name="doc_id" value="<?= $doc_id ?>">
                            <input type="submit" name="submit" value="चलानी गर्नुहोस्">
                        </form>



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
