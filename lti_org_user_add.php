
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
function Centric_Insert($Centric_Query)
{
    $Centric_Result = Centric_Query($Centric_Query);

    if($Centric_Result === false)
    {
        return false;
    }

    return $Centric_Insert;
}
function Centric_Curr_Org_Emails()
{
    $Centric_Org_ID = $_SESSION['Centric_Org_ID'];
    $Centric_Result = Centric_Query("SELECT `User_Email` FROM `Centric_Users` WHERE Org_ID=$Centric_Org_ID");
    if($Centric_Result === false)
    {
        return false;
    }
    while ($row = mysqli_fetch_assoc($Centric_Result)) {
       echo "<p>{$row['User_Email']} <br> ".
           " </p";
    }
    return $rows;
}
function Centric_Org_Adduser()
{
    $Centric_First_Name = filter_var($_POST['Centric_First_Name'], FILTER_SANITIZE_STRING);
    $Centric_Last_Name = filter_var($_POST['Centric_Last_Name'], FILTER_SANITIZE_STRING);
    $Centric_User_Email = filter_var($_POST['Centric_User_Email'], FILTER_SANITIZE_STRING);
    $Centric_User_Email_Confirm = filter_var($_POST['Centric_User_Email_Confirm'], FILTER_SANITIZE_STRING);
    $Centric_User_Password = filter_var($_POST['Centric_User_Password'], FILTER_SANITIZE_STRING);
    $Centric_User_Password_Confirm = filter_var($_POST['Centric_User_Password_Confirm'], FILTER_SANITIZE_STRING);

    if(isset($_POST['Centric_User_Password_Change']))
    {
        $Centric_User_Password_Change = 1;

    }
    else
    {
        $Centric_User_Password_Change = 0;

    }


    if ($Centric_User_Password == $Centric_User_Password_Confirm)
    {
        if ($Centric_User_Email == $Centric_User_Email_Confirm)
        {

            $Centric_User_Password = sha1( $Centric_User_Password );

            $Centric_Result = Centric_Query("select User_Email from Centric_Users where User_Email='$Centric_User_Email' AND Org_ID='$Centric_Org_ID'");
            $Centric_Email_Exists = mysqli_num_rows($Centric_Result);
            $Centric_Org_ID = $_SESSION['Centric_Org_ID'];

            if($Centric_Email_Exists > 0 )
            {
                echo "Email already exists, please go back and fix your mistake";
            }
            else
            {
                //GRABBING Org_Group_ID from Centric_Org_Group
                $Centric_Result = Centric_Query("SELECT Org_Group_ID from Centric_Org_Group WHERE Org_Group_Name='Default'");
                $Centric_Fetch_Org_Group_ID = mysqli_fetch_row($Centric_Result);
                $Centric_Org_Group_ID = $Centric_Fetch_Org_Group_ID[0];

                //GRABBING File_Perm_ID from Centric_FilePerm
                $Centric_Result = Centric_Query("SELECT File_Perm_ID from Centric_Org_Group WHERE Org_Group_ID='$Centric_Org_Group_ID'");
                $Centric_Fetch_File_Perm_ID = mysqli_fetch_row($Centric_Result);
                $Centric_File_Perm_ID = $Centric_Fetch_File_Perm_ID[0];


                //GRABBING File_Perm_ID from Centric_FilePerm
                $Centric_Result = Centric_Query("SELECT Group_ID from Centric_Group WHERE Group_Name='Default'");
                $Centric_Fetch_Group_ID = mysqli_fetch_row($Centric_Result);
                $Centric_Group_ID = $Centric_Fetch_Group_ID[0];

                //INSERTING VALUES INTO Centric_Users
                Centric_Insert("INSERT INTO `Centric_Users` (`User_Email`, `User_Password`, `First_Name`, `Last_Name`,  `Org_ID`, `Group_ID`, `File_Perm_ID`, `Org_Group_ID`, `User_Password_Change`) VALUES('$Centric_User_Email', '$Centric_User_Password', '$Centric_First_Name', '$Centric_Last_Name', '$Centric_Org_ID', '$Centric_Group_ID', '$Centric_File_Perm_ID', '$Centric_Org_Group_ID', '$Centric_User_Password_Change')");

            }
        }
    }
    else
    {
        echo "Your password and/or email do not match. You will be returned to the previous page to fix your mistake";
    }
}

if(isset($_POST['submit']))
{

    //Error checking

    if(!$_POST['Centric_First_Name'])
    {
        $error['Centric_First_Name'] = "<p>Please supply the first name.</p>\n";
    }
    if(!$_POST['Centric_Last_Name'])
    {
        $error['Centric_Last_Name'] = "<p>Please supply the last name.</p>\n";
    }
    if(!$_POST['Centric_User_Email'])
    {
        $error['Centric_User_Email'] = "<p>Please supply the email.</p>\n";
    }
    if(!$_POST['Centric_User_Email_Confirm'])
    {
        $error['Centric_User_Email_Confirm'] = "<p>Please supply the email.</p>\n";
    }
    if(!$_POST['Centric_User_Password'])
    {
        $error['Centric_User_Password'] = "<p>Please supply the password.</p>\n";
    }
    if(!$_POST['Centric_User_Password_Confirm'])
    {
        $error['Centric_User_Password_Confirm'] = "<p>Please supply the confirmed password.</p>\n";
    }

    //No errors, process
    if(!is_array($error))
    {

        if ($_POST['Centric_Form_Token'] == $_SESSION['Centric_Secure_Token'])
        {
            Centric_Org_Adduser();
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
				<div class="menu">
                <?php include 'lti_menu.php';?>
                </div>
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

                                                Centric_Curr_Org_Emails();

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
                                                      <?=$error['Centric_User_Password_Change']?>
                                                     <p>
                                                        <label for="Centric_User_Password_Change">Require Password Change on Login?</label>
                                                        <input type="checkbox" id="Centric_User_Password_Change" name="Centric_User_Password_Change" value="" />
                                                    </p>
                                                    <p>
                                                        <input type="hidden" name="Centric_Form_Token" value="<?php echo $Centric_Form_Token; ?>" />
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
