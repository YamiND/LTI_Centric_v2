
<?php
session_start();
session_regenerate_id();
$Centric_Form_Token = $_SESSION['Centric_Secure_Token'];

if(!isset($_SESSION['Centric_User_Email']))
{
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
function Centric_Update($Centric_Query)
{
    $Centric_Result = Centric_Query($Centric_Query);

    if($Centric_Result === false)
    {
        return false;
    }

    return $Centric_Update;
}
function Centric_Reset_Password()
{

    $Centric_User_Password_Reset = filter_var($_POST['Centric_User_Password_Reset'], FILTER_SANITIZE_STRING);
    $Centric_User_Password_Reset_Confirm = filter_var($_POST['Centric_User_Password_Reset_Confirm'], FILTER_SANITIZE_STRING);


    if ($Centric_User_Password_Reset == $Centric_User_Password_Reset_Confirm)
    {
            $Centric_User_Email = $_SESSION['Centric_User_Email'];
            $Centric_User_Password = sha1( $Centric_User_Password_Reset );
            $Centric_Org_ID = $_SESSION['Centric_Org_ID'];
            $Centric_Result = Centric_Query("select User_Email from Centric_Users where User_Email='$Centric_User_Email'");


            echo "$Centric_User_Email";
            echo "$Centric_User_Password";
            echo "$Centric_Org_ID";




                Centric_Update("UPDATE `Centric_Users` SET User_Password = '$Centric_User_Password', User_Password_Change = '0' WHERE User_Email='$Centric_User_Email' AND Org_ID = '$Centric_Org_ID'");


        }
    }

if(isset($_POST['submit']))
{
    //Error checking
    if(!$_POST['Centric_User_Password_Reset'])
    {
        $error['Centric_User_Password_Reset'] = "<p>Please supply the password.</p>\n";
    }
    if(!$_POST['Centric_User_Password_Reset_Confirm'])
    {
        $error['Centric_User_Password_Reset_Confirm'] = "<p>Please supply the confirmed password.</p>\n";
    }



    //No errors, process
    if(!is_array($error))
    {

        if ($_POST['Centric_Form_Token'] == $_SESSION['Centric_Secure_Token'])
        {
            Centric_Reset_Password();
        }
        else
        {
            echo "I'm going to flip out if you're trying a CSS attack on me";
        }
    }
}

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
				<h1 id="logo"><a href="index.html">Laker Technology <span>Innovations</span></a></h1>
				<nav id="nav">
					<ul>
						<li><a href="lti_admin_panel.php">Admin Panel</a></li>
						<li class="submenu">
							<a href="">Pages</a>
							<ul>
								<li><a href="about-LTI.html">About LTI</a></li>
								<li><a href="services.html">Services</a></li>
								<li><a href="contact.html">Contact Us</a></li>
							</ul>
						</li>
						<li><a href="lti_signout.php" class="button special">Sign Out</a></li>
					</ul>
				</nav>
			</header>

		<!-- Main -->
			<article id="main">

				<header class="special container">
					<span class="icon fa-laptop"></span>
					<h2>Reset User Password</h2>
					<p>Reset your password</p>
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

                                               // Centric_Curr_Emails();

                                            ?>
										</section>

									</div>

							</div>
							<div class="8u 12u(narrower) important(narrower)">

								<!-- Content -->
									<div class="content">
										<section>
											<header>
												<h2>Reset User Password</h2>
											</header>

                                            <form method="post" action="<?=$_SERVER['PHP_SELF']?>">
                                                <fieldset>
                                                    <?=$error['Centric_User_Password_Reset']?>
                                                    <p>
                                                        <label for="Centric_User_Password_Reset">Reset Password</label>
                                                        <input type="password" id="Centric_User_Password_Reset" name="Centric_User_Password_Reset" value="" maxlength="75" required />
                                                    </p>
                                                    <?=$error['Centric_User_Password_Reset_Confirm']?>
                                                     <p>
                                                        <label for="Centric_User_Password_Reset_Confirm">Confirm Password Reset</label>
                                                        <input type="password" id="Centric_User_Password_Reset_Confirm" name="Centric_User_Password_Reset_Confirm" value="" onkeyup="checkPass(); return false;" maxlength="75" required />
                                                        <span id="confirmMessage" class="confirmMessage"></span>
                                                    </p>

                                                    <p>
                                                        <input type="hidden" name="Centric_Form_Token" value="<?php echo $Centric_Form_Token; ?>" />
                                                        <input type="submit" name="submit" value="Change the Password" />

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
