
<?php

session_start();
session_regenerate_id();
$Centric_Form_Token = $_SESSION['Centric_Secure_Token'];

if(!isset($_SESSION['Centric_User_Email']))
{
    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/LTI_Centric_v2/lti_signin.php');
}
if($_SESSION['Centric_Org_Admin'] == "0" && $_SESSION['Centric_Admin'] == "0")
{
    echo "<script>alert('Please Log in with an Admin Account')</script>";
    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/LTI_Centric_v2/lti_signin.php');
}


function Centric_Connect()
{

    // Define connection as a static variable, to avoid connecting more than once
    static $Centric_Connection;
    // Try and connect to the database, if a connection has not been established yet
    if(!isset($Centric_Connection))
    {
        // Load configuration as an array. Use the actual location of your configuration file
        $Centric_Config = parse_ini_file('/Auth/AuthConfig.ini');
        $Centric_Connection = mysqli_connect('localhost',$Centric_Config['username'],$Centric_Config['password'],$Centric_Config['dbname']);
    }
    // If connection was not successful, handle the error
    if($Centric_Connection === false)
    {
        // Handle error - notify administrator, log to a file, show an error screen, etc.
        return mysqli_connect_error();
    }
    return $Centric_Connection;
}
function Centric_Query($Centric_Query)
{

    $Centric_Connection = Centric_Connect();
    $Centric_Result = mysqli_query($Centric_Connection,$Centric_Query);
    return $Centric_Result;

}

?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Administration Panel</title>
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
		<script src="js/init.js"></script>
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
				<h1 id="logo"><a href="index">Welcome To <span>LTI</span></a></h1>
			<div class="menu">
                <?php include 'lti_menu.php';?>
                </div>
			</header>

		<!-- Main -->
			<article id="main">

				<header class="special container">
					<span class="icon fa-laptop"></span>
					<h2>Admin Panel</h2>
					<p>Get access to all admin pages here</p>
				</header>

				<!-- One -->
					<section class="wrapper style4 container">

						<div class="row 150%">
							<div class="4u 12u(narrower)">

								<!-- Sidebar -->
									<div class="sidebar">
										<section>
											<header>
												<h3><?php

                                               echo $_SESSION['Centric_User_Email'];

                                            ?></h3>
											</header>

										</section>

									</div>

							</div>
							<div class="8u 12u(narrower) important(narrower)">

								<!-- Content -->
									<div class="content">
										<section>
											<header>
												<h2>Administration Options:</h2>
											</header>
                                            <ul>
						                          <li><a href="lti_org_user_add.php" class="button special">Register a New User</a></li>
                                                <br>
                                                  <li><a href="lti_org_remove_user.php" class="button special">Remove a User</a></li>
                                                <br>
                                                <li><a href="lti_org_add_group.php" class="button special">Add a group</a></li>
                                                <li><a href="lti_org_remove_group.php" class="button special">Remove a group</a></li>
                                                <li><a href="lti_org_edit_user.php" class="button special">Edit a User</a></li> <?php //this is where we're going to include assigning a user to a group, updating their first name, last name, email, or resetting their password. And yes I did just through in a php tag so I could use the double slashes ?>


                                                <li><a href="lti_centric.php" class="button special">View Your Centric</a></li>
					                        </ul>

										</section>
									</div>
							</div>
						</div>
					</section>
			</article>
	</body>
</html>
