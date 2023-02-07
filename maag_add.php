<?php
require_once("includes/initialize.php");
?>
<?php if(!$session->is_logged_in()){ redirect_to("login.php");} ?>
<?php
	if(isset($_POST['submit']))
	{
		$kitab = new MaagKitab();
		$ka_ni_date_english = DateNepToEng($_POST['ka_ni_date']);
		$_POST['ka_ni_date_english'] = $ka_ni_date_english;
		$kitab->savePostData($_POST,"create");
		$session->message("Data Added");
	}
	
/*	if(isset($_POST['upload']))
	{
			set_time_limit(5000);
			ini_set('memory_limit','512M');
			set_include_path(get_include_path() . PATH_SEPARATOR . 'Classes/');
			include 'PHPExcel/IOFactory.php';
			$filename=$_FILES["file"]["tmp_name"];
	    	move_uploaded_file($filename, "uploads/".$_FILES['file']['name']);
	    	$inputFileName = "uploads/".$_FILES['file']['name'];
	        $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
	        $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
			$arrayCount = count($allDataInSheet);  // Here get total count of row in that Excel sheet
			
			for($i=2;$i<=$arrayCount;$i++){
			$maag_entry = new MaagKitab();	
			//$maag_entry->maag_no = trim($allDataInSheet[$i]["A"]);
			$maag_entry->maag_no = trim($allDataInSheet[$i]["B"]);
			$maag_entry->taxpayer_company = trim($allDataInSheet[$i]["C"]);
			$maag_entry->taxpayer_name = trim($allDataInSheet[$i]["D"]);
			$maag_entry->taxpayer_panno = trim($allDataInSheet[$i]["E"]);
			$maag_entry->bakyouta_no = trim($allDataInSheet[$i]["F"]);
			$maag_entry->tel = trim($allDataInSheet[$i]["G"]);
			$maag_entry->eff_reg = trim($allDataInSheet[$i]["H"]);
			$maag_entry->save();
			}
	    
	    
	        
	    
	}*/
$fiscals = Fiscalyear::find_all();
$parent_topics = Topic::find_parent_topic(); 
?>

<?php require_once "menuincludes/header.php"; ?>

							<!-- Banner -->
					

							<!-- Section -->
								<section>
									<header class="major">
										</header>
                                    <div class="irdform">
                                    <h4><?=$message?></h4>
                                     <form method="post">
                                    	<table class="table">
                                         
                                          </tr>
                                           <tr>
                                            <td>आ व</td>
                                            <td>
                                            	<select name="fiscal_id" required>
                                            		<option>--छान्नुहोस्--</option>
                                                    <?php foreach($fiscals as $fiscal): ?>
                                                    	<option value="<?=$fiscal->id?>"><?=$fiscal->year?></option>
                                                    <?php endforeach; ?>
                                           		 </select>
                                            </td>
                                          </tr>

                                          <tr>
                                            <td>शिर्षकको नाम</td>
                                            <td><select name="parent_topic_id" id="parent_topic_id" required>
                                            		<option value="0">--छान्नुहोस्--</option>
                                            		<?php foreach($parent_topics as $parent): ?>
                                                    	<option value="<?=$parent->id?>"><?=$parent->topic_name?></option>
                                                    <?php endforeach; ?>	
                                            </select>
                                            </td>
                                          </tr>
                                          <tr id="second_topic">
                                            
                                          </tr>
                                          <tr>
                                          	<td>माग न०</td>
                                            <td><input type="text" name="maag_no" required /></td>
                                          </tr>
                                          <tr>
                                          	<td>करदाता / फर्मको नाम</td>
                                            <td><input type="text" name="taxpayer_company" id="taxpayer_company" required /></td>
                                          </tr>
                                          <tr>
                                          	<td>संचालकको नाम</td>
                                            <td><input type="text" name="taxpayer_name" id="taxpayer_name" /></td>
                                          </tr>
                                          <tr>
                                          	<td>स्थायी ले न०</td>
                                            <td><input type="text" name="taxpayer_panno" id="taxpayer_panno"  /> <span id="findpan" class="button">Find</span></td>
                                          </tr>
                                          <tr>
                                          	<td>बक्यौता न०</td>
                                            <td><input type="text" name="bakyouta_no"  /></td>
                                          </tr>
                                          <tr>
                                          	<td>क नि मिति</td>
                                            <td><input type="text" name="ka_ni_date" id="nepaliDate5" required /></td>
                                          </tr>
                                           <tr>
                                          	<td>कर</td>
                                            <td><input type="text" name="tax_amount"  required/></td>
                                          </tr>
                                           <tr>
                                          	<td>शुल्क / ब्याज</td>
                                            <td><input type="text" name="tax_interest" required /></td>
                                          </tr>
                                           <tr>
                                          	<td>जम्मा</td>
                                            <td><input type="text" name="total" required /></td>
                                          </tr>
                                           <tr>
                                          	<td>कैफियत</td>
                                            <td><input type="text" name="remarks" /></td>
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                            <td><input type="submit" name="submit" value="सेभ गर्नुहोस"></td>
                                          </tr>
                                        </table>

                                    </form>
                                    </div>
						<div style="display:none;">
                        	<form method="post" enctype="multipart/form-data">
                            <table class="table">
                                         
                                          </tr>
                                           <tr>
                                            <td>आ व</td>
                                            <td>
                                            	<select name="fiscal_id" required>
                                            		<option>--छान्नुहोस्--</option>
                                                    <?php foreach($fiscals as $fiscal): ?>
                                                    	<option value="<?=$fiscal->id?>"><?=$fiscal->year?></option>
                                                    <?php endforeach; ?>
                                           		 </select>
                                            </td>
                                          </tr>

                                          <tr>
                                            <td>शिर्षकको नाम</td>
                                            <td><select name="parent_topic_id" id="parent_topic_id" required>
                                            		<option value="0">--छान्नुहोस्--</option>
                                            		<?php foreach($parent_topics as $parent): ?>
                                                    	<option value="<?=$parent->id?>"><?=$parent->topic_name?></option>
                                                    <?php endforeach; ?>	
                                            </select>
                                            </td>
                                          </tr>
                                          <tr id="second_topic">
                                            
                                          </tr>
                                        <tr>	
                                        	<td>&nbsp;</td>
                                            <td><input type="file" name="file"></td>
                                        </tr>
                                        <tr>	
                                        	<td>&nbsp;</td>
                                            <td><input type="submit" name="upload"></td>
                                        </tr>
                            	</table>
                            	
                            </form>

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