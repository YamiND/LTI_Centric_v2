<?php
    include_once 'includes/db_connect.php';
    include_once 'includes/functions.php';

    sec_session_start();
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>LTI: Services</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
        <!-- favicon-->
        <?php include 'favicon.php';?>
		<!--[if lte IE 8]><script src="css/ie/html5shiv.js"></script><![endif]-->
		<script src="js/jquery.min.js"></script>
		<script src="js/jquery.dropotron.min.js"></script>
		<script src="js/jquery.scrolly.min.js"></script>
		<script src="js/jquery.scrollgress.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-layers.min.js"></script>
		<script src="js/init.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-wide.css" />
			<link rel="stylesheet" href="css/style-noscript.css" />
		</noscript>
		<!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="css/ie/v9.css" /><![endif]-->
	</head>
	<body class="no-sidebar">

		<!-- Header -->
			<?php include 'header.php';?>

		<!-- Main -->
			<article id="main">

				<header class="special container">
					<span class="icon fa-mobile"></span>
					<h2>Laker Technology <strong>Innovations</strong></h2>
					<p>Services Provided For You</p>
				</header>

				<!-- One -->
					<section class="wrapper style4 container">

						<!-- Content -->
							<div class="content">
								<section>
									<a href="#" class="image featured"><img src="/images/services.jpg" alt="LTI members" /></a>
									<header>
										<h3>LTI</h3>
									</header>
									<p>Our services provide convenience and security for you. Laker Tech Innovations provides customers with 1u and 2u server hosting. Single server hosting provides customers with the ability to be able to control exactly the amount of space which cuts any excess cost. This is a great option for start ups and a way to micro manage bigger companies. All servers will be placed in secured racks under key cared secured doors. The safety of your data is our priority. <br>
Our packages include:<br>
                                    <section class="wrapper style1 container special">
						<div class="row">
							<div class="3u 11u(narrower)">

								<section>
									<header>
										<h3>1u server </h3>
									</header>
									<p>$50 per month which includes access by appointment</p>
									<footer>
										<ul class="buttons">
											<!--<li><a href="#" class="button small">Learn More</a></li>-->
										</ul>
									</footer>
								</section>

							</div>
							<div class="3u 11u(narrower)">

								<section>
									<header>
										<h3>2u server</h3>
									</header>
									<p>$80 per month which includes access by appointment</p>
									<footer>
										<ul class="buttons">
											<!--<li><a href="#" class="button small">Learn More</a></li>-->
										</ul>
									</footer>
								</section>

							</div>
							<div class="3u 11u(narrower)">

								<section>
									<header>
										<h3>Tower Server</h3>
									</header>
									<p>$90 per month which includes access by appointment</p>
									<footer>
										<ul class="buttons">
											<!--<li><a href="#" class="button small">Learn More</a></li>-->
										</ul>
									</footer>
								</section>

							</div>
						</div>
					</section>

			</article></p>


								</section>
							</div>

        </section>

		<!-- Footer -->
			<?php include 'footer.php';?>

	</body>
</html>
