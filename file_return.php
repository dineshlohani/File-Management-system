<?php
    require_once('includes/initialize.php');
    if(!$session->is_logged_in()){ redirect_to("login.php");}
    if(isset($_GET['id']))
    {
        $chalani = Chalani::find_by_id($_GET['id']);
        if(empty($chalani))
        {
            $session->message('समस्या आयो |');
            redirect_to('chalani_book');
        }
        if($chalani->doc_id == 1)
        {
            $file = Filefile::find_by_id($chalani->file_id);
            $kagjat = "फायल";
        }
        else if($chalani->doc_id == 2)
        {
            $file = Fileregister::find_by_id($chalani->file_id);
            $kagjat = "रेजिस्टर";
        }
        else if($chalani->doc_id == 3)
        {
            $file = Fileother::find_by_id($chalani->file_id);
            $kagjat = "फायल";
        }

        $project    = Project::find_by_id($file->project);
    }
    if(isset($_POST['submit']))
    {
        if($_POST['doc_id'] == 1)
        {
            $file = Filefile::find_by_id($_POST['file_id']);
        }
        else if($_POST['doc_id'] == 2)
        {
            $file = Fileregister::find_by_id($_POST['file_id']);
        }
        else if($_POST['doc_id'] == 3)
        {
            $file = Fileother::find_by_id($_POST['file_id']);
        }
        $file->room_no = $_POST['room_no'];
        $file->rack_no = $_POST['rack_no'];
        $file->rack_part_no = $_POST['rack_part_no'];
        if($file->save())
        {
            $chalani  = Chalani::find_by_id($_POST['chalani_id']);
            $chalani->firta_miti = $_POST['nepali_date'];
            $chalani->firta_date = DateNeptoEng($_POST['nepali_date']);
            $chalani->save();
            $code = generatecode($_POST['room_no'], $_POST['project'], $_POST['rack_no'], $_POST['rack_part_no'], $_POST['reg_no']);
            redirect_to("generate_code.php?code=$code&doc_id=".$_POST['doc_id']);
        }


    }
    $rooms      = Room::find_all();
    $racks      = Rack::find_all();
    $rack_parts = RackPart::find_all();
?>
<?php require_once "menuincludes/header.php"; ?>
<section>
        <header class="major">
                </header>
                        <div class="irdform">
                        <h4><?=$message?></h4>
                        <center><h3>चलानी भएको फायल फिर्ता</h3><center>
                            <h5>फायल राखेको पुरानो ठाउँ</h5>
                    <form method="post">
                        <table class="table table-responsive table-bordered">
                            <tr>
                                <th>कागजातको प्रकार</th>
                                <td><?=$kagjat?></td>
                            </tr>
                            <tr>
                                <th>परियोजन</th>
                                <td><?= $project->name ?></td>
                            </tr>
                            <tr>
                                <th>कोठा नं</th>
                                <td>
                                    <select name="room_no" required>
                                        <option value="">छान्नुहोस्</option>
                                    <?php foreach($rooms as $room): ?>
                                        <option value="<?= $room->id?>"
                                            <?php
                                                if($file->room_no == $room->id)
                                                {
                                                    echo 'selected = "selected"';
                                                }
                                            ?>
                                        ><?= $room->name ?></option>
                                    <?php endforeach;?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>रायक नं</th>
                                <td>
                                    <select name="rack_no" required>
                                        <option value="">छान्नुहोस्</option>
                                    <?php foreach($racks as $rack): ?>
                                        <option value="<?= $rack->id?>"
                                            <?php
                                                if($file->rack_no == $rack->id)
                                                {
                                                    echo 'selected = "selected"';
                                                }
                                            ?>
                                        ><?= $rack->name ?></option>
                                    <?php endforeach;?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>रायक खण्ड नं</th>
                                <td>
                                    <select name="rack_part_no" required>
                                        <option value="">छान्नुहोस्</option>
                                    <?php foreach($rack_parts as $rack): ?>
                                        <option value="<?= $rack->id?>"
                                            <?php
                                                if($file->rack_part_no == $rack->id)
                                                {
                                                    echo 'selected = "selected"';
                                                }
                                            ?>
                                        ><?= $rack->name ?></option>
                                    <?php endforeach;?>
                                </td>
                            </tr>
                            <tr>
                                <th>फिर्ता गरिएको मिति</th>
                                <td>
                                    <input type="text" name="nepali_date" id="nepaliDate3" required>
                                </td>
                            </tr>
                        </table>
                        <input type="hidden" name="project" value="<?= $file->project?>">
                        <input type="hidden" name="chalani_id" value="<?= $_GET['id']?>">
                        <input type="hidden" name="file_id" value="<?= $chalani->file_id ?>">
                        <input type="hidden" name="doc_id" value="<?= $file->doc_id ?>">
                        <input type="hidden" name="reg_no" value="<?= $file->reg_no ?>">
                        <input type='submit' name="submit" value="Generate Code">
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
