<?php
require_once("includes/initialize.php");
?>
<?php if(!$session->is_logged_in()){ redirect_to("login.php");} ?>
<?php
	
		if(isset($_GET['doc_id']) && $_GET['doc_id']==1)
		{
			redirect_to("view_filefile.php");
			
		}
		if(isset($_GET['doc_id']) && $_GET['doc_id']==2)
		{
			redirect_to("view_fileregister.php");
			
		}
		if(isset($_GET['doc_id']) && $_GET['doc_id']==3)
		{
			redirect_to("view_fileother.php");
		}
		
	
$fiscals = Fiscalyear::find_all();
$parent_topics = Topic::find_all(); 
$file_type = array(1=>"आय कर",2=>"बिक्री कर",3=>"मु. आ. कर",4=>"अन्त शुल्क",5=>"अन्य");
$file_condition = array(1=>"खुला",2=>"पोकामा");
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
                                            <td>कागजात प्रकार</td>
                                            <td><select name="doc_id" id="doc_id" onChange="form.submit()" required>
                                            		<option value="0">--छान्नुहोस्--</option>
                                            		<?php foreach($parent_topics as $parent): ?>
                                                    	<option value="<?=$parent->id?>" <?php if(isset($_GET['doc_id']) && $_GET['doc_id']==$parent->id) {?> selected <?php } ?>><?=$parent->name?></option>
                                                    <?php endforeach; ?>	
                                            </select>
                                            </td>
                                            </tr>
                                      </table>

                                    </form>
                                    <?php if(isset($datas)): ?>
                                    <table class="alt">
                                    	<tr>
                                        	<th>आ व</th>
                                            <th>दर्ता न०</th>
                                            <th>फर्म व्यवसायको नाम</th>
                                            <th>संचालकको नाम</th>
                                            <th>फायलको प्रकार</th>
                                            <th>फायलको अवस्था</th>
                                            <th>कोठा न०</th>
                                            <th>पोका न०</th>
                                            
                                        </tr>
                                        <?php foreach($datas as $data): ?>
                                        <?php $fiscal_selected = Fiscalyear::find_by_id($data->fiscal_id);
											 
											  
										?>		
										 
                                        <tr>
                                        	<td><?=$fiscal_selected->year?></td>
                                            <td><?=$data->reg_no?></td>
                                            <td><?=$data->company_name_nepali." ( ".$data->company_name_english." )"?></td>
                                            <td><?=$data->company_person?></td>
                                            <td><?=$file_type[$data->file_type]?></td>
                                            <td><?=$file_condition[$data->file_condition]?></td>
                                            <td><?=$data->room_no?></td>
                                            <td><?=$data->packet_no?></td>
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