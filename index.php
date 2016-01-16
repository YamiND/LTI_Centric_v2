<?php
    include_once '/includes/db_connect.php';
    include_once '/includes/functions.php';

    sec_session_start();
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>LTI</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
        
        <!-- favicon-->
            <?php include 'favicon.php';?>
		
        <!--[if lte IE 8]><script src="/css/ie/html5shiv.js"></script><![endif]-->
		<script src="/js/jquery.min.js"></script>
		<script src="/js/jquery.dropotron.min.js"></script>
		<script src="/js/jquery.scrolly.min.js"></script>
		<script src="/js/jquery.scrollgress.min.js"></script>
		<script src="/js/skel.min.js"></script>
		<script src="/js/skel-layers.min.js"></script>
		<script src="/js/init.js"></script>
		
        <!-- Stylesheets -->
            <?php include 'css.php';?>
	
    </head>
	<body class="index">

		<!-- Header -->
			<?php include 'header.php';?>

		<!-- Banner -->
			<section id="banner">

				<!--
					".inner" is set up as an inline-block so it automatically expands
					in both directions to fit whatever's inside it. This means it won't
					automatically wrap lines, so be sure to use line breaks where
					appropriate (<br />).
				-->
				<div class="inner">

					<header>
						<h2>LTI</h2>
					</header>
					<p><strong>Laker Technology Innovations</strong>
					<br />
					Your number one source for Data Storage and Services</p>
					<footer>
						<ul class="buttons vertical">
							<li><a href="#main" class="button fit scrolly">Tell Me More</a></li>
						</ul>
					</footer>

				</div>

			</section>

		<!-- Main -->
			<article id="main">

				<header class="special container">
					<span class="icon fa-bar-chart-o"></span>
					<h2>World class technology, from the <strong>Upper Peninsula</strong>
					<br />
					We are here to change the world</h2>
				</header>

				<!-- One -->




				<!-- Two -->

					<section class="wrapper style1 container special">
						<div class="row">
							<div class="4u 12u(narrower)">

								<section>
									<span class="icon featured fa-check"></span>
									<header>
										<h3>A modern and secure location</h3>
									</header>
									<p>We are located in a <strong>modern</strong> building, that was                                          built with <strong>security</strong> in mind.</p>
								</section>

							</div>
							<div class="4u 12u(narrower)">

								<section>
									<span class="icon featured fa-check"></span>
									<header>
										<h3>Strong-Minded Staff</h3>
									</header>
									<p>Our employees were made for technology. We understand what                                       <strong>IT</strong> needs, and provide an easy off-site backup solution</p>
								</section>

							</div>
							<div class="4u 12u(narrower)">

								<section>
									<span class="icon featured fa-check"></span>
									<header>
										<h3>Web Design</h3>
									</header>
									<p>We design beautiful sites, that are extremely functional. Take a look around ours.</p>
								</section>

							</div>
						</div>
					</section>
        </article>

		<!-- Footer -->
			<?php include 'footer.php';?>

	</body>
</html>
