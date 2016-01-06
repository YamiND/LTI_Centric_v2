<?php

if(isset($_POST['submit']))
{
 //Email information
  $admin_email = "tpostma@lssu.edu";
  $email = $_POST['email'];
  $subject = $_POST['subject'];
  $message = $_POST['message'];
  $name = $_POST['name'];
  $comment = $name.$message;

  //send email
  mail($admin_email, "$subject", $comment, "From:" . $email);

  //Email response
  echo "Thank you for contacting us!";


}

?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>LTI: Contact Us</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
        <link href="/images/favicontest4.png" rel="icon" type="image/x-icon" />
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
	<body class="contact">

		<!-- Header -->
			<header id="header" class="skel-layers-fixed">
				<h1 id="logo"><a href="index">Welcome To <span>LTI</span></a></h1>
				<div class="menu">
                <?php include 'lti_menu.php';?>
                </div>
			</header>

		<!-- Main -->
			<article id="main">

				<header class="special container">
					<span class="icon fa-envelope"></span>
					<h2>Have a Question?</h2>
					<p>Use the form below to get in contact with us</p>
				</header>

				<!-- One -->
					<section class="wrapper style4 special container 75%">

						<!-- Content -->
							<div class="content">
							<form method="post" action="<?=$_SERVER['PHP_SELF']?>">
									<div class="row 50%">
										<div class="6u 12u(mobile)">
											<input type="text" name="name" placeholder="Name" />
										</div>
										<div class="6u 12u(mobile)">
											<input type="text" name="email" placeholder="Email" />
										</div>
									</div>
									<div class="row 50%">
										<div class="12u">
											<input type="text" name="subject" placeholder="Subject" />
										</div>
									</div>
									<div class="row 50%">
										<div class="12u">
											<textarea name="message" placeholder="Message" rows="7"></textarea>
										</div>
									</div>
									<div class="row">
										<div class="12u">
											<ul class="buttons">
												<li><input type="submit" class="special" name="submit" value="Send Message" /></li>
											</ul>
										</div>
									</div>
								</form>
							</div>

					</section>

			</article>

		<!-- Footer -->
			<footer id="footer">

				<ul class="icons">
				    <li><a href="https://www.facebook.com/lakertech" class="icon circle fa-facebook"><span class="label">Facebook</span></a></li>
					<li><a href="https://github.com/YamiND/LTI_Centric_v2" class="icon circle fa-github"><span class="label">Github</span></a></li>
				</ul>

				<ul class="copyright">
					<li>&copy; LTI</li>
				</ul>
			</footer>

	</body>
</html>
