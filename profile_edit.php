<?php
    include 'includes/initialize.php';
    require_once 'menu/header_script.php';
    if(!$session->is_logged_in()){ redirect_to("logout.php");}
    $date= date("Y-m-d",time());

$user= getUser();
   	if(isset($_POST['submit']))
        {
            $user= User::find_by_id($user->id);
            if(md5($_POST['oldpassword']) != $user->password)
            {
            echo    alertBox("पुरानो पस्स्वोर्ड हालेको मिलेन", "profile_edit.php");
            exit;
            }
            if($_POST['password1'] != $_POST['password'])
            {
            echo    alertBox("नया पस्स्वोर्ड पुन हल्नुहोस", "profile_edit.php");
            exit;
            }
            $user->username=$_POST['username'];
            $user->password=md5($_POST['password']);
            if($user->save())
            {
                $session->message("सच्याउन सफल");	
                redirect_to("user_view.php");
            }
        
      }

?>
<?php require_once "menuincludes/header.php"; ?>

							<!-- Banner -->
            <section id="banner">
                    <div class="content">
                            <header>
                                    <h2>प्रयोगकर्ता थप्नुहोस</h2>
<!--                                    <p>Agro Enterprise Centre </p>-->
                            </header>
                        <form method="post">
                        <table class="table borderless table-responsive ">
                            <tr>
                                <td>नाम</td>
                                <td><?= $user->name ?></td>
                            </tr>
                            <tr>
                                <td>नम्बेर </td>
                                <td><?= convertedcit($user->phone) ?></td>
                            </tr>
                            <tr>
                                <td>वार्ड न</td>
                                <td><?= convertedcit($user->ward) ?></td>
                            </tr>
                             <tr>
                                <td>यूसरनेम </td>
                                <td><input class="form-control" type="text" name="username" required value="<?= $user->username ?>"></td>
                              </tr>
                              <tr>
                                <td>पुरानो पास्वोर्ड</td>
                                <td><input class="form-control" type="text" name="oldpassword" id="oldpassword" required ><span id="check"></span></td>
                              </tr>
                               <tr>
                                <td>नया पास्वोर्ड</td>
                                <td><input class="password form-control" type="password" name="password" required id="new_password"></td>
                              </tr>
                              <tr>
                                <td>नया पास्वोर्ड पुन हाल्नुहोस् </td>
                                <td><input class="form-control" type="password" name="password1" required id="confirm_password" oninput="myFunction()"   ><span id="demo"></span></td>
                              </tr>
                              <tr>
                                <td>&nbsp;</td>
                                <td><input type="submit" name="submit" value="Save" class="submithere btn save"></td>
                              </tr>
                            
                        </table>
                    </form>
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