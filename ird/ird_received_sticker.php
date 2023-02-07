<?php
require_once("../includes/initialize.php");
?>
<?php if(!$session->is_logged_in()){ redirect_to("login.php");} ?>
<?php require_once "menuincludes/header.php"; ?>

							<!-- Banner -->
								<section id="banner">
									<div class="content">
										<header>
											<h1>Welcome to our Official website</h1>
											<p>IRD's Liquor Management System </p>
										</header>
										<p>Welcome to the information site of the Inland Revenue Department (IRD) of Government of Nepal. </p>
										<ul class="actions">
											<li><a href="#" class="button big">Learn More</a></li>
										</ul>
									</div>
									<span class="image object">
										<img src="images/pic10.jpg" alt="" />
									</span>
								</section>

							<!-- Section -->
								<section>
									<header class="major">
										<h2>Form Module</h2>
									</header>
                                    <div class="irdform">
                                    <form>
                                    	<table class="table">
                                          <tr>
                                            <td>Prapta Miti</td>
                                            <td><input type="text"></td>
                                          </tr>
                                          <tr>
                                            <td>Chalani No</td>
                                            <td><input type="text"></td>
                                          </tr>
                                          <tr>
                                            <td>Prapta Miti</td>
                                            <td><input type="text"></td>
                                          </tr>
                                          <tr>
                                            <td>Starting No.</td>
                                            <td><input type="text"></td>
                                          </tr>
                                          <tr>
                                            <td>Ending No.</td>
                                            <td><input type="text"></td>
                                          </tr>
                                          <tr>
                                            <td>Total Amount</td>
                                            <td><input type="text"></td>
                                          </tr>
                                          <tr>
                                            <td>Remarkss</td>
                                            <td><input type="text"></td>
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                            <td><input type="submit"></td>
                                          </tr>
                                        </table>

                                    </form>
                                    </div>
									
								</section>

							

						</div>
					</div>

				<!-- Sidebar -->
					<div id="sidebar">
						<div class="inner">

							<!-- Search -->
								<div id="irdlogo">
                                	<img src="images/logo_ird.PNG" alt="IRD Logo"><br>
									<h3>Inland Revenue Department <br>
									Morang</h3>
                                </div>
                                <section id="search" class="alt">
									<form method="post" action="#">
										<input type="text" name="query" id="query" placeholder="Search" />
									</form>
						  </section>

							<!-- Menu -->
							<?php require_once("menuincludes/menu.php"); ?>

							<!-- Section -->
								<section>
									<header class="major">
										<h2>Get in touch</h2>
									</header>
									<p>For any kind of inquiry please use any of the media listed below.</p>
									<ul class="contact">
										<li class="fa-envelope-o"><a href="#">info@irdmorang.gov.np</a></li>
										<li class="fa-phone">21-500000</li>
										<li class="fa-home">Traffic Chowk<br />
										Biratnagar, Neepal</li>
									</ul>
								</section>

							<!-- Footer -->
								<footer id="footer">
									<p class="copyright">&copy; 2017. IRD Morang. All rights reserved. Developed By: <a href="https://pdmt.com.np" title="Purwanchal Digital Media Technologies Pvt. Ltd." target="_blank">PDMT</a></p>
								</footer>

						</div>
					</div>

			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>