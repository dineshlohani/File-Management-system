<?php
    require_once("includes/initialize.php");
    if(!$session->is_logged_in()){ redirect_to("logout.php");}
    $user_result= getUser();
    if($user_result->mode!="administrator")
    {
        die("Permission Denied");
    }
    $ward_array= array(0,1,2,3,4,5,6,7,8,9,10,11);
    $user_id= $_GET['id'];
    $user1= User::find_by_id($user_id);
    if(isset($_POST['submit']))
      {
          if($_POST['password'] != $_POST['password1'])
        {
           echo  alertBox("नया पस्स्वोर्ड पुन हाल्नुहोस् ","user_edit.php?id=".$user_id);
            exit;
        }
        $user= User::find_by_id($user_id);
        $user->name=$_POST['name'];
        $user->phone=$_POST['phone'];
        $user->email=$_POST['email'];
        $user->username=$_POST['username'];
        $user->status=$_POST['status'];
        $user->mode=$_POST['mode'];
        $user->ward=$_POST['ward'];
        $user->password=md5($_POST['password']);
        if($user->save())
        {
            $session->message("प्रयोगकर्ता सच्याउन सफल");	
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
                        <a class="pull-right btn btn-primary" href="user_view.php">प्रयोगकर्ता हेर्नुहोस</a><br/><br/>
                            <form method="post" class="form-horizontal">
                               
                                <div class="form-group">
                                  <label class="control-label col-sm-3" for="forusername">प्रयोगकर्ताको नाम : </label>
                                  <div class="col-sm-6">
                                    <input type="text" class="form-control"  name="name" required>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-sm-3" for="formGroupExampleInput">सम्पर्क न. :</label>
                                  <div class="col-sm-6">          
                                    <input type="text" class="form-control"  name="phone" required>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-sm-3" for="formGroupExampleInput">वार्ड न. :</label>
                                  <div class="col-sm-6">
                                    <select name="ward" class="form-control">
                                                    <option value="">छान्नुहोस् </option>
                                                    <option value="0">०</option>
                                                    <option value="1">१  </option>
                                                    <option value="2">२  </option>
                                                    <option value="3">३  </option>
                                                    <option value="4">४   </option>
                                                    <option value="5">५  </option>
                                                    <option value="6">६  </option>
                                                    <option value="7">७  </option>
                                                    <option value="8">८   </option>
                                                    <option value="9">९  </option>
                                                    <option value="10">१०  </option>
                                                    <option value="11">११  </option>
                                                    
                                             </select>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-sm-3" for="email">इमेल ठेगाना: </label>
                                  <div class="col-sm-6">          
                                    <input type="email" class="form-control"  name="email" required>
                                  </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">कार्यरत अवस्था : </label>
                                    <div class="col-sm-6">
                                        <label class="radio-inline"> <input type="radio" name="status" value="1"> Active </label>
                                        <label class="radio-inline"> <input type="radio" name="status" id="Cloudy" value="0"> Inactive </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-sm-3" for="moda">मोड : </label>
                                  <div class="col-sm-6">          
                                    <select name="mode" class="form-control">
                                            <option value="">छान्नुहोस्</option>
                                            <option value="superadmin">सुपर एडमिन</option>
                                                <option value="administrator">एडमिन</option>
                                            <option value="user">प्रयोगकर्ता </option>
                                        </select>
                                  </div>
                                </div>
                                <div class="form-group">
                                    <label for="username" class="control-label col-sm-3">युजरनेम : </label>
                                    <div class="col-sm-6">
                                        <input class="form-control" type="text" name="username" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="control-label col-sm-3">पास्स्वोर् : </label>
                                    <div class="col-sm-6">
                                        <input class="form-control" type="password" name="password" required id="new_password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="username" class="control-label col-sm-3">पास्स्वोर्ड पुनः हाल्नुहोस : </label>
                                    <div class="col-sm-6">
                                        <input class="form-control" type="password" name="password1" required id="confirm_password" oninput="myFunction()"><span id="demo"></span>
                                    </div>
                                </div>
                                <div class="form-group">        
                                  <div class="col-sm-offset-3 col-sm-10">
                                    <button type="submit" name="submit" class="btn save submithere">इन्ट्री गर्नुहोस</button>
                                  </div>
                                </div>
                          
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