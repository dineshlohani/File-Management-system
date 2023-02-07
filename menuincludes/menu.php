<!-- Menu -->
			<?php if($session->is_logged_in()) : ?>
			<?php 
            $u_type = getUserMode();
            // print_r($u_type);
			?>
								<div id="accordion1">
									<ul>
										<li>
											<div >विवरण</div>
									  		<ul>
                                                <li><a href="projects_view.php">योजना</a></li>
												<li><a href="new_entry.php">नया इन्ट्री़</a></li>
												<li><a href="all_files.php">फायल़ हेर्नुहोस</a></li>
                                                <li><a href="filesearch.php">फायल़ खोज्नुहोस</a></li>
                                                <li><a href="view_count.php">जम्मा </a></li>
												<li><a href="chalani_view.php">चलानी भएको कागजात </a></li>
												<li><a href="chalani_book.php">चलानी किताब </a></li>
                                            </ul>
										</li>
                                            <li>
											<?php if($u_type=='administrator'){?>
											<div >सेटिंग</div>
									  		<ul>
                                                                                            <li><a href="settings_fiscal_year_view.php">आर्थिक वर्ष</a></li>
                                                                                            <li><a href="settings_file_inside_view.php">फायल भित्र</a></li>
                                                                                            <li><a href="settings_room_view.php">कोठा नं</a></li>
                                                                                            <li><a href="settings_rack_view.php">रायक नं</a></li>
                                                                                            <li><a href="settings_rack_part_view.php">रयाकको खण्ड नं </a></li>
																							<li><a href="settings_department_view.php">फाँट</a></li>
																							<li><a href="budget_title.php">बजेट शिर्षक</a></li>
																							<li><a href="plan_type.php">योजना किसिम</a></li>
                                            </ul>
											<?php }else{}?>
											</li>
                                            <li>
											<div><a href="logout.php">Log out</a></div>
											</li>
								</div>
<?php endif; ?>


							<!-- Section -->
