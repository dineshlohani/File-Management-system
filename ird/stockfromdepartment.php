<?php
	require_once('../includes/initialize.php');
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Liquor Management System :: IRD Morang</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="../assets/css/main.css" />
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
        <link href="../images/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon" />
	</head>
	<body>

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->
					<div id="main">
						<div class="inner">

							<!-- Header -->
								<header id="header">
									<a href="../index.php" class="logo"><strong>Online</strong> Liquor Management System !</a>
									<ul class="icons">
										<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
										<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
										<li><a href="#" class="icon fa-snapchat-ghost"><span class="label">Snapchat</span></a></li>
										<li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
										<li><a href="#" class="icon fa-medium"><span class="label">Medium</span></a></li>
									</ul>
								</header>

							<!-- Banner -->
								<section id="banner">
									<div class="content">
										<header>
											<h1>Stock Assigned to </h1>
											
										</header>
									
									</div>
									
								</section>

							<!-- Section -->
								<section>
									<header class="major">
										<h2>Form Module for stock assigned</h2>
									</header>
                                    <div class="irdform">
                                    <form>
                                    	<table class="table">
                                          <tr>
                                            <td>प्राप्ता निकाय</td>
                                            <td><input type="text"></td>
                                          </tr>
                                          <tr>
                                            <td>चलानी न :</td>
                                            <td><input type="text"></td>
                                          </tr>
                                          <tr>
                                            <td>प्राप्त मिति</td>
                                            <td><input type="text"></td>
                                          </tr>
                                          <tr>
                                            <td>देखि</td>
                                            <td><input type="text"></td>
                                          </tr>
                                          <tr>
                                            <td>सम्म</td>
                                            <td><input type="text"></td>
                                          </tr>
                                          <tr>
                                            <td>थान</td>
                                            <td><input type="text"></td>
                                          </tr>
                                          <tr>
                                            <td>कैफियत</td>
                                            <td><input type="text"></td>
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                            <td><input type="submit" value="सेभ गर्नुहोस"></td>
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
							<?php require_once("../menuincludes/menu.php"); ?>
							

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