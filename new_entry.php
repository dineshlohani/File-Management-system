<?php
require_once("includes/initialize.php");
error_reporting(-1);
?>
<?php if(!$session->is_logged_in()){ redirect_to("login.php");} ?>
<?php
	if(isset($_POST['generate']))
  {
      // print_r($_POST['file_inside']);
      // exit;
      $file_inside = $_POST['file_inside'];
      $new_file_inside = implode(',', $file_inside);
      $v_number = $_POST['v_number'];
      $new_v_number = implode(',', $v_number);
          // print_r($_POST);exit;
            if($_GET['doc_id']==1)
            {
                    $data = new Filefile();
                    $max = Filefile::find_max_code();
					$path = "documents/filefile/";
					if (!file_exists($path))
	                {
	                    mkdir($path, 0777, true);
	                }
            }
            if($_GET['doc_id']==2)
            {
                    $data = new Fileregister();
                    $max = Fileregister::find_max_code();
					$path = "documents/fileregister/";
					if (!file_exists($path))
	                {
	                    mkdir($path, 0777, true);
	                }
            }
            if($_GET['doc_id']==3)
            {
                    $data = new Fileother();
                    $max = Fileother::find_max_code();
					$path = "documents/fileother/";
					if (!file_exists($path))
	                {
	                    mkdir($path, 0777, true);
	                }
            }
            $reg_obj = Regno::find_by_id(1);
            $reg_no  = $reg_obj->reg_no;
            $reg_no++;
                $_POST['reg_no'] = $reg_no;
                
			if(!empty($_FILES['documents']['name'][0]))
			{
				$documents = [];
				$i= 0;
				foreach($_FILES['documents']['name'] as $name)
				{
					          $temp_path      = $_FILES['documents']['tmp_name'][$i];
                    $source = $_FILES['documents']['name'][$i];
                    $ext = pathinfo($source, PATHINFO_EXTENSION);
                    $file_name      = md5(uniqid().time()).".".$ext;
                    $destination    = $path.$file_name;
                    move_uploaded_file($temp_path,$destination);
					compress($destination,$destination,75);
					array_push($documents,$file_name);
					$i++;
				}
				$_POST['documents'] = serialize($documents);
			}
      $_POST['file_inside'] = $new_file_inside;
      $_POST['v_number'] = $new_v_number;
      
            $data->savePostData($_POST, "create");
            $reg_obj->reg_no = $reg_no;
            $reg_obj->save();
            $code = generatecode($_POST['room_no'], $_POST['project'], $_POST['rack_no'], $_POST['rack_part_no'], $_POST['reg_no']);
            redirect_to("generate_code.php?code=$code&doc_id=".$_GET['doc_id']);
        }
$fiscals        = Fiscalyear::find_by_sql("select * from fiscal_year order by id desc");
$parent_topics  = Topic::find_all();
$projects       = Project::find_all();
$rooms          = Room::find_all();
$racks          = Rack::find_all();
$rack_parts     = RackPart::find_all();
$file_insides   = FileInside::find_all();
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
                                            <td>कागजात प्रकार</td>
                                            <td><select name="doc_id" id="doc_id" onchange="form.submit();" required>
                                            		<option value="0">--छान्नुहोस्--</option>
                                            		<?php foreach($parent_topics as $parent): ?>
                                                    	<option value="<?=$parent->id?>" <?php if(isset($_GET['doc_id']) && $_GET['doc_id']==$parent->id) {?> selected <?php } ?>><?=$parent->name?></option>
                                                    <?php endforeach; ?>
                                            </select>
                                            </td>
                                            </tr>
                                         </table>
                                    </form>
                          		</div>
						<?php if(isset($_GET['doc_id']) && $_GET['doc_id']==1): // first type ?>
                        <div>
                        	<form method="post" enctype="multipart/form-data">
                        	<table>
                                           <tr>
                                            <th>आ व</th>
                                            <td>
                                            	<select name="fiscal_id" >
                                            		<option>--छान्नुहोस्--</option>
                                                    <?php foreach($fiscals as $fiscal): ?>
                                                    	<option value="<?=$fiscal->id?>"><?=$fiscal->year?></option>
                                                    <?php endforeach; ?>
                                           		 </select>
                                            </td>
                                          </tr>
                                           <tr>
                                          	<th>परियोजनाको नाम</th>
                                            <td>
                                                <select name="project" id="project" required>
                                                    <option value="">छान्नुहोस</option>
                                                    <?php foreach($projects as $project){?>
                                                    <option value="<?=$project->id?>"><?=$project->name?></option>
                                                    <?php }?>
                                                </select>
                                                <hr>
                                              <div class="row">
                                                <div class="newInput" style="color: red;">योजना किसिम :- </div>
                                                <div class="name_project" style="color: green;"></div>
                                                <div class="newInput" style="color: red;">बजेट श्रोत :- </div>
                                                <div class="name_project1" style="color: green;"></div>
                                              </div>
                                            </td>
                                          </tr>
                                          <tr>
                                          	<th>फायलको प्रकार</th>
                                            <td><select name="file_type" required >
                                            		<option>--छान्नुहोस्--</option>
                                                    <option value="1">Index</option>
                                                    <option value="2">Turing</option>
                                                    <option value="3">Paperfile</option>
                                            	</select>
                                            	 </td>
                                          </tr>
                                          <tr>
                                          	<th>फायल भित्र</th>
                                            <td>
                                                 <select name="file_inside[]" required>
                                                        <label><option value="">--छान्नुहोस्</option>
                                                        <?php foreach($file_insides as $file){?>
                                                        <option value="<?=$file->id?>"><?=$file->name?></option></label>
                                                        <?php }?>
                                                        <span><input type="text" name="v_number[]" size="4" placeholder="भौचर नं"></span>
                                                    </select>
                                                    <div class="file_inside_new" id="file_inside_new" class="v_number"></div>
                                                    <hr>
                                                    <input type="button" class="button" id="file_more" value="थप्नुहोस"><span>
                                                    <input type="button" class="button" id="remove_file" value="हटाउनुहोस"></span>    
                                            </td>
                                          </tr>
                                          <tr>
                                          	<th>कोठा न०</th>
                                                <td>
                                                    <select name="room_no" required>
                                                        <option value="">--छान्नुहोस्</option>
                                                        <?php foreach($rooms as $room){?>
                                                        <option value="<?=$room->id?>"><?=$room->name?></option>
                                                        <?php }?>
                                                    </select>
                                                </td>
                                          </tr>
                                          <tr>
                                          	<th>रयाक न०</th>
                                            <td>
                                                <select name="rack_no" required>
                                                        <option value="">--छान्नुहोस्</option>
                                                        <?php foreach($racks as $rack){?>
                                                        <option value="<?=$rack->id?>"><?=$rack->name?></option>
                                                        <?php }?>
                                                </select>
                                            </td>
                                          </tr>
                                          <tr>
                                          	<th>रयाकको खण्ड  न०</th>
                                            <td>
                                                <select name="rack_part_no" required>
                                                        <option value="">--छान्नुहोस्</option>
                                                        <?php foreach($rack_parts as $part){?>
                                                        <option value="<?=$part->id?>"><?=$part->name?></option>
                                                        <?php }?>
                                                </select>
                                            </td>
                                          </tr>
                                            <tr>
                                          	<th>कैफियत</th>
                                            <td><input type="text" name="remarks" /></td>
                                          </tr>

                             </table>
								 <div class="row">
									 <label>कागजात:</label><br/>
									 <input name='documents[]' id="documents" type="file" class="form-control documents" >
								</div>
								 <div class="row" id="document_div"> </div>
								 <br/>
								 <div class="row">
									 <button type="button" id="add" class="btn" >थप्नुहोस </button>
									 <button type="button" id="remove" class="btn">हटाउनुहोस</button>
									 <input type="submit" name="generate" class="pull-right" value="सेभ गर्नुहोस"/>
									 <input type="hidden" name="doc_id" value="<?php echo $_GET['doc_id']; ?>" />
							 	</div>
                             </form>
                        </div>
                        <?php endif; ?>
                        <?php if(isset($_GET['doc_id']) && $_GET['doc_id']==2): // first type ?>
                        <div>
                        	<form method="post" enctype="multipart/form-data">
                        	<table>
                                           <tr>
                                            <th>आ व</th>
                                            <td>
                                            	<select name="fiscal_id">
                                            		<option>--छान्नुहोस्--</option>
                                                    <?php foreach($fiscals as $fiscal): ?>
                                                    	<option value="<?=$fiscal->id?>"><?=$fiscal->year?></option>
                                                    <?php endforeach; ?>
                                           		 </select>
                                            </td>
                                          </tr>
                                          <tr>
                                          	<th>परियोजनाको नाम</th>
                                            <td>
                                                <select name="project">
                                                    <option value="">छान्नुहोस</option>
                                                    <?php foreach($projects as $project){?>
                                                    <option value="<?=$project->id?>"><?=$project->name?></option>
                                                    <?php }?>
                                                </select>
                                            </td>
                                          </tr>

                                           <tr>
                                          	<th>कोठा न०</th>
                                                <td>
                                                    <select name="room_no" required>
                                                        <option value="">--छान्नुहोस्</option>
                                                        <?php foreach($rooms as $room){?>
                                                        <option value="<?=$room->id?>"><?=$room->name?></option>
                                                        <?php }?>
                                                    </select>
                                                </td>
                                          </tr>
                                          <tr>
                                          	<th>रयाक न०</th>
                                            <td>
                                                <select name="rack_no" required>
                                                        <option value="">--छान्नुहोस्</option>
                                                        <?php foreach($racks as $rack){?>
                                                        <option value="<?=$rack->id?>"><?=$rack->name?></option>
                                                        <?php }?>
                                                </select>
                                            </td>
                                          </tr>
                                          <tr>
                                          	<th>रयाकको खण्ड  न०</th>
                                            <td>
                                                <select name="rack_part_no" required>
                                                        <option value="">--छान्नुहोस्</option>
                                                        <?php foreach($rack_parts as $part){?>
                                                        <option value="<?=$part->id?>"><?=$part->name?></option>
                                                        <?php }?>
                                                </select>
                                            </td>
                                          </tr>
                                           <tr>
                                          	<th>कैफियत</th>
                                            <td><input type="text" name="remarks" /></td>
                                          </tr>

                             </table>
								 <div class="row">
									 <label>कागजात:</label>
									 <input name='documents[]' type="file" class="form-control documents">

								 </div>
								 <div class="row" id="document_div"> </div>
								 <br/>
								 <div class="row">
									 <button type="button" id="add" class="btn" >थप्नुहोस </button>
									 <button type="button" id="remove" class="btn">हटाउनुहोस</button>
									 <input type="submit" name="generate" class="pull-right" value="सेभ गर्नुहोस"/>
									 <input type="hidden" name="doc_id" value="<?php echo $_GET['doc_id']; ?>" />
								</div>
                             </form>
                        </div>
                        <?php endif; ?>
                        <?php if(isset($_GET['doc_id']) && $_GET['doc_id']==3): // first type ?>
                        <div>
                        	<form method="post" enctype="multipart/form-data">
                        	<table>
                                           <tr>
                                            <th>आ व</th>
                                            <td>
                                            	<select name="fiscal_id">
                                            		<option>--छान्नुहोस्--</option>
                                                    <?php foreach($fiscals as $fiscal): ?>
                                                    	<option value="<?=$fiscal->id?>"><?=$fiscal->year?></option>
                                                    <?php endforeach; ?>
                                           		 </select>
                                            </td>
                                          </tr>

                                          <tr>
                                          	<th>परियोजनाको नाम</th>
                                            <td>
                                                <select name="project">
                                                    <option value="">छान्नुहोस</option>
                                                    <?php foreach($projects as $project){?>
                                                    <option value="<?=$project->id?>"><?=$project->name?></option>
                                                    <?php }?>
                                                </select>
                                            </td>
                                          </tr>
                                           <tr>
                                          	<th>कोठा न०</th>
                                                <td>
                                                    <select name="room_no" required>
                                                        <option value="">--छान्नुहोस्</option>
                                                        <?php foreach($rooms as $room){?>
                                                        <option value="<?=$room->id?>"><?=$room->name?></option>
                                                        <?php }?>
                                                    </select>
                                                </td>
                                          </tr>
                                          <tr>
                                          	<th>रयाक न०</th>
                                            <td>
                                                <select name="rack_no" required>
                                                        <option value="">--छान्नुहोस्</option>
                                                        <?php foreach($racks as $rack){?>
                                                        <option value="<?=$rack->id?>"><?=$rack->name?></option>
                                                        <?php }?>
                                                </select>
                                            </td>
                                          </tr>
                                          <tr>
                                          	<th>रयाकको खण्ड  न०</th>
                                            <td>
                                                <select name="rack_part_no" required>
                                                        <option value="">--छान्नुहोस्</option>
                                                        <?php foreach($rack_parts as $part){?>
                                                        <option value="<?=$part->id?>"><?=$part->name?></option>
                                                        <?php }?>
                                                </select>
                                            </td>
                                          </tr>
                                           <tr>
	                                          	<th>कैफियत</th>
	                                            <td><input type="text" name="remarks" /></td>
                                          </tr>

                             </table>
								 <div class="row">
	 								<label>कागजात:</label>
	 								<input name='documents[]' type="file" class="form-control documents">

	 							</div>
	 							<div class="row" id="document_div"> </div>
	 							<br/>
	 							<div class="row">
	 								<button type="button" id="add" class="btn" >थप्नुहोस </button>
									<button type="button" id="remove" class="btn">हटाउनुहोस</button>
	 								<input type="submit" name="generate" class="pull-right" value="सेभ गर्नुहोस"/>
	 								<input type="hidden" name="doc_id" value="<?php echo $_GET['doc_id']; ?>" />
	 						   </div>
                             </form>
                        </div>
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
			<script>
				var JQ = jQuery.noConflict();
				JQ(document).ready(function(){
					JQ(document).on("click","#add",function(){
						param = {};
						JQ.post('get_document_div.php',param,function(res){
							var obj = JSON.parse(res);
							JQ("#document_div").append(obj.html);
	                    });
					});
					JQ(document).on("click","#remove",function(){
						JQ(".documents").last().remove();
					});
          JQ(document).on('change','#project', function() {
                var obj = JQ(this).val();
                param = {};
                param.name = obj;
                JQ.post('get_plan_name.php', param, function (res) {
                    var obj1 = JSON.parse(res);
                     JQ(".name_project").empty().append(obj1.project_type);
                     JQ(".name_project1").empty().append(obj1.project_budget_name);
                   
                });
            });
            JQ(document).on("click","#file_more",function(){
              param = {};
              JQ.post('add_more_file.php', param, function (res){
                  var obj = JSON.parse(res);
                  console.log(obj);
                  JQ(".file_inside_new").append(obj.html);
              });
            });
            JQ(document).on("click","#remove_file",function(){
              JQ(".file_inside").last().remove();
              JQ(".v_number").last().remove();
					});
				});
			</script>
	</body>
</html>
