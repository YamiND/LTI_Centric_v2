<?php
    include_once '/includes/db_connect.php';
    include_once '/includes/functions.php';

    sec_session_start();
?>

<!DOCTYPE HTML>

<html>
	<head>
		<title>LTI: About</title>
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
	<body class="no-sidebar">

		<!-- Header -->
			<?php include 'header.php';?>

		<!-- Main -->
			<article id="main">

				<header class="special container">
					<span class="icon fa-mobile"></span>
					<h2>Laker Technology <strong>Innovations</strong></h2>
					<p>where technology meets business</p>
				</header>

				<!-- One -->
                <section class="wrapper style1 container special">
						<div class="row">
							<div class="4u 12u(narrower)">
								<section>
									<header>
										<h3>About the Founders</h3>
									</header>
									<p>LTI Members have very unique and diverse backgrounds.  To find out more, please click the link below:</p>
									<footer>
										<ul class="buttons vertical">
							             <li><a href="#lti_members" class="button fit scrolly">Tell Me More</a></li>
						                  </ul>
									</footer>
								</section>

							</div>
							<div class="4u 12u(narrower)">

								<section>
									<header>
										<h3>About Centric</h3>
									</header>
									<p>Centric is our very own backup and hosting service.  To find out more, please see the link below:</p>
									<footer>
										<ul class="buttons vertical">
							                 <li><a href="#lti_centric" class="button fit scrolly">Tell Me More</a></li>
						                  </ul>
									</footer>
								</section>

							</div>
							<div class="4u 12u(narrower)">

								<section>
									<header>
										<h3>About Server Hosting</h3>
									</header>
									<p>We allow businesses to host their servers at our facilities. To find out more, please click the link below:</p>
									<footer>
										<ul class="buttons vertical">
							                 <li><a href="#lti_collocation" class="button fit scrolly">Tell Me More</a></li>
                                        </ul>
									</footer>
								</section>

							</div>
						</div>
					</section>



					<section class="wrapper style4 container">

						<!-- Content -->


							<div class="content">
								<section>
                                    <article id="lti_members">

									<a href="#" class="image featured"><img src="/images/LTIgroup.jpg" alt="LTI members" /></a>
									<header>
										<h3>About our Members</h3>
									</header>
									<p>Laker Tech Innovations is a start-up in Sault Ste Marie, Michigan connecting businesses and technology together.  Beginning in 2014, LTI has created a strong infrastructure for businesses, large or small, to help promote technological growth in Northern Michigan by providing data centers, website design, and server hosting.  We love what we do and we are willing to go the extra mile to get the job done. Our main data center is located in Sault Ste Marie, Michigan at the <a href="http://www.ssmartzone.com/" target="_blank">SSMartzone Building</a>.  At LTI we focus on the customers and work with clients to create intelligent solutions.</p>
                                    </article>
								</section>
							</div>

                        <div class="content">
								<section>
                                     <article id="lti_centric">
                                    <h3>About Centric</h3>

									<p>Centric is a suite of software designed to allow an easy way to synchronize, backup, and restore data.  We offer both a web and desktop interface to allow quick access to Centric on multiple devices.  We have a variety of plans designed to fit any business's needs.</p>
                                    </article>
                                         </section>
							</div>

                        <div class="content">

								<section>
                                     <article id="lti_collocation">
									<header>
										<h3>Server Collocation</h3>
									</header>
									<p>Our services provide convenience and security.  LTI provides customers with 1u and 2u server hosting.  Single server hosting provides customers with the ability to control exactly the amount of space they require which cuts any excess cost.  This is a great option for start-ups and a way to micromanage bigger companies.  All servers will be placed in secured racks; the safety of data is our number-one priority. <br></p>


                                    </article>
								</section>
							</div>
					</section>
			</article>

		<!-- Footer -->
			<?php include 'footer.php';?>

	</body>
</html>
