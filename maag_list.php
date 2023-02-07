<?php
require_once("includes/initialize.php");
?>
<?php if(!$session->is_logged_in()){ redirect_to("login.php");} ?>
<?php
if(isset($_GET['submit']))
{

	$maag_list = MaagKitab::find_by_params($_GET['fiscal_id'],$_GET['parent_topic_id'],$_GET['sub_topic_id'],$_GET['maag_no']);
	$sub_topic_profile = Topic::find_by_id($_GET['sub_topic_id']);
	$parent_topic_profile = Topic::find_by_id($_GET['parent_topic_id']);
}
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
                                     <form method="get">
                                    	<table class="table">
                                         <tr>
                                         	<th></th>
                                            <th></th>
                                            <th></th>
                                         </tr>
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
                                            <td><input type="text" name="maag_no" /></td>
	                                      </tr>
                                           <tr>
                                          	<td>&nbsp;</td>
                                            <td><input type="submit" name="submit" value="हेर्नुहोस"/></td>
	                                      </tr>
                                          </table>

                                    </form>
                                    
                                    </div>
                       <?php if(isset($maag_list) && !empty($maag_list)): ?>
					<!-- list starts -->
                    <div>
                    	<h3 align="center"><?=$parent_topic_profile->topic_name?></h3>
                    	<h3 align="center"><?=$sub_topic_profile->topic_name?>( <?=$sub_topic_profile->topic_no?> )</h3>
                        <table>
                        	<tr>
                            	<th>क्र स.</th>
                                <th>माग न०</th>
                                <th>करदाता / फर्मको नाम </th>
                                <th>संचालकको नाम</th>
                                <th>स्थायी ले  न०</th>
                                <th>बक्यौता न०</th>
                                <th>क नि मिति</th>
                                <th>कर</th>
                                <th>शुल्क / ब्याज</th>
                                <th>जम्मा</th>
                                <th>कैफियत</th>
                            </tr>
                            <?php $i=1; foreach($maag_list as $maag): ?>
                            	<tr>
                                	<td><?=convertedcit($i)?></td>
                                    <td><?=convertedcit($maag->maag_no)?></td>
                                    <td><?=$maag->taxpayer_company?></td>
                                    <td><?=$maag->taxpayer_name?></td>
                                    <td><?=convertedcit($maag->taxpayer_panno)?></td>
                                    <td><?=convertedcit($maag->bakyouta_no)?></td>
                                    <td><?=convertedcit($maag->ka_ni_date)?></td>
                                    <td><?=convertedcit($maag->tax_amount)?></td>
                                    <td><?=convertedcit($maag->tax_interest)?></td>
                                    <td><?=convertedcit($maag->total)?></td>
                                    <td><?=$maag->remarks?></td>
                                </tr>
                            <?php $i++; endforeach; ?>
                        </table>
                    </div>
                    <!-- list ends -->
					<?php endif; ?>
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