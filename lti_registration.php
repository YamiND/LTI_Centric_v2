
<?php

?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Register a User</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
        <!-- favicon-->
        <link href="/LTI-Centric/images/favicontest4.png" rel="icon" type="image/x-icon" />
		<!--[if lte IE 8]><script src="css/ie/html5shiv.js"></script><![endif]-->
		<script src="js/jquery.min.js"></script>
		<script src="js/jquery.dropotron.min.js"></script>
		<script src="js/jquery.scrolly.min.js"></script>
		<script src="js/jquery.scrollgress.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-layers.min.js"></script>
		<script src="js/init.js"></script> required
        <script src="js/validation.js"></script>

		<noscript>
			<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-wide.css" />
			<link rel="stylesheet" href="css/style-noscript.css" />
		</noscript>
		<!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="css/ie/v9.css" /><![endif]-->
	</head>
	<body class="left-sidebar">

		<!-- Header -->
			<header id="header" class="skel-layers-fixed">
				<h1 id="logo"><a href="index.html">Laker Technology <span>Innovations</span></a></h1>
				<nav id="nav">
					<ul>
						<li><a href="Centric_admin_panel.php">Admin Panel</a></li>
						<li class="submenu">
							<a href="">Pages</a>
							<ul>
								<li><a href="about-LTI.html">About LTI</a></li>
								<li><a href="services.html">Services</a></li>
								<li><a href="contact.html">Contact Us</a></li>
							</ul>
						</li>
						<li><a href="Centric_signout.php" class="button special">Sign Out</a></li>
					</ul>
				</nav>
			</header>

		<!-- Main -->
			<article id="main">

				<header class="special container">
					<span class="icon fa-laptop"></span>
					<h2>User Registration</h2>
					<p>Add a new user account</p>
				</header>

				<!-- One -->
					<section class="wrapper style4 container">

						<div class="row 150%">
							<div class="4u 12u(narrower)">

								<!-- Sidebar -->
									<div class="sidebar">
										<section>
											<header>
												<h3>Current List of Users:</h3>
											</header>
											 <?php
                                                db_get_Curr_Users();
                                            ?>
										</section>

									</div>

							</div>
							<div class="8u 12u(narrower) important(narrower)">

								<!-- Content -->
									<div class="content">
										<section>
											<header>
												<h2>Add user</h2>
											</header>

                                            <form method="post" action="<?=$_SERVER['PHP_SELF']?>">
                                                <fieldset>
                                                    <?=$error['Centric_First_Name']?>
                                                    <p>
                                                        <label for="Centric_First_Name">First Name</label>
                                                        <input type="text" id="Centric_First_Name" name="Centric_First_Name" value="" maxlength="20" required />
                                                    </p>
                                                    <?=$error['Centric_Last_Name']?>
                                                    <p>
                                                        <label for="Centric_Last_Name">Last Name</label>
                                                        <input type="text" id="Centric_Last_Name" name="Centric_Last_Name" value="" maxlength="20" required />
                                                    </p>
                                                    <?=$error['Centric_User_Password']?>
                                                    <p>
                                                        <label for="Centric_User_Password">Password</label>
                                                        <input type="password" id="Centric_User_Password" name="Centric_User_Password" value="" maxlength="75" required />
                                                    </p>
                                                    <?=$error['Centric_User_Password_Confirm']?>
                                                     <p>
                                                        <label for="Centric_User_Password_Confirm">Confirm Password</label>
                                                        <input type="password" id="Centric_User_Password_Confirm" name="Centric_User_Password_Confirm" value="" onkeyup="checkPass(); return false;" maxlength="75" required />
                                                        <span id="confirmMessage" class="confirmMessage"></span>
                                                    </p>
                                                    <?=$error['Centric_Organization_Storage']?>
                                                    <p>
                                                        <label for="Centric_Organization_Storage">Amount of space for Organization (GB)</label>
                                                        <input type="text" id="Centric_Organization Storage" name="Centric_Organization_Storage" value="" maxlength="20" required />
                                                    </p>
                                                    <?=$error['Centric_User_Email']?>
                                                    <p>
                                                        <label for="Centric_User_Email">Email Address (This will be the username)</label>
                                                        <input type="email" id="Centric_User_Email" name="Centric_User_Email" value="" maxlength="40" required />
                                                    </p>
                                                    <?=$error['Centric_User_Email_Confirm']?>
                                                    <p>
                                                        <label for="Centric_User_Email_Confirm">Confirm Email Address</label>
                                                        <input type="email" id="Centric_User_Email_Confirm" name="Centric_User_Email_Confirm" value="" onkeyup="checkEmail(); return false;" maxlength="45" required />
                                         <span id="confirmEmail" class="confirmEmail"></span>
                                                    </p>
                                                    <?=$error['Centric_Bill_Addr']?>
                                                      <p>
                                                        <label for="Centric_Bill_Addr">Billing Address</label>
                                                        <input type="text" id="Centric_Bill_Addr" name="Centric_Bill_Addr" value="" maxlength="60" />
                                                    </p>
                                                    <?=$error['Centric_Bill_City']?>
                                                    <p>
                                                        <label for="Centric_Bill_City">City</label>
                                                        <input type="text" id="Centric_Bill_City" name="Centric_Bill_City" value="" maxlength="100" required />
                                                    </p>
                                                    <?=$error['Centric_Bill_State']?>
                                                    <p>
                                                        <label for="Centric_Bill_State">State</label>
                                                        <select required name="Centric_Bill_State">
                                                            <option value="AL">Alabama</option>
                                                            <option value="AK">Alaska</option>
                                                            <option value="AZ">Arizona</option>
                                                            <option value="AR">Arkansas</option>
                                                            <option value="CA">California</option>
                                                            <option value="CO">Colorado</option>
                                                            <option value="CT">Connecticut</option>
                                                            <option value="DE">Delaware</option>
                                                            <option value="DC">District Of Columbia</option>
                                                            <option value="FL">Florida</option>
                                                            <option value="GA">Georgia</option>
                                                            <option value="HI">Hawaii</option>
                                                            <option value="ID">Idaho</option>
                                                            <option value="IL">Illinois</option>
                                                            <option value="IN">Indiana</option>
                                                            <option value="IA">Iowa</option>
                                                            <option value="KS">Kansas</option>
                                                            <option value="KY">Kentucky</option>
                                                            <option value="LA">Louisiana</option>
                                                            <option value="ME">Maine</option>
                                                            <option value="MD">Maryland</option>
                                                            <option value="MA">Massachusetts</option>
                                                            <option value="MI">Michigan</option>
                                                            <option value="MN">Minnesota</option>
                                                            <option value="MS">Mississippi</option>
                                                            <option value="MO">Missouri</option>
                                                            <option value="MT">Montana</option>
                                                            <option value="NE">Nebraska</option>
                                                            <option value="NV">Nevada</option>
                                                            <option value="NH">New Hampshire</option>
                                                            <option value="NJ">New Jersey</option>
                                                            <option value="NM">New Mexico</option>
                                                            <option value="NY">New York</option>
                                                            <option value="NC">North Carolina</option>
                                                            <option value="ND">North Dakota</option>
                                                            <option value="OH">Ohio</option>
                                                            <option value="OK">Oklahoma</option>
                                                            <option value="OR">Oregon</option>
                                                            <option value="PA">Pennsylvania</option>
                                                            <option value="RI">Rhode Island</option>
                                                            <option value="SC">South Carolina</option>
                                                            <option value="SD">South Dakota</option>
                                                            <option value="TN">Tennessee</option>
                                                            <option value="TX">Texas</option>
                                                            <option value="UT">Utah</option>
                                                            <option value="VT">Vermont</option>
                                                            <option value="VA">Virginia</option>
                                                            <option value="WA">Washington</option>
                                                            <option value="WV">West Virginia</option>
                                                            <option value="WI">Wisconsin</option>
                                                            <option value="WY">Wyoming</option>
                                                    </select>
                                                    </p>
                                                    <?=$error['Centric_Bill_Zip']?>
                                                     <p>
                                                        <label for="Centric_Bill_Zip">Zip Code</label>
                                                        <input type="number" id="Centric_Bill_Zip" name="Centric_Bill_Zip" value="" maxlength="5" required />
                                                    </p>
                                                     <p>
                                                        <label for="Centric_admin">Make an Administrator?</label>
                                                        <input type="checkbox" id="Centric_admin" name="Centric_admin" />
                                                    </p>
                                                    <p>
                                                        <input type="hidden" name="form_token" value="<?php echo $form_token; ?>" />
                                                        <input type="submit" name="submit" value="Register the User" />

                                                    </p>
                                                </fieldset>
                                            </form>
										</section>
									</div>
							</div>
						</div>
					</section>
			</article>
	</body>
</html>
