
<?php


session_start();
session_regenerate_id();


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
function Centric_Select($Centric_Query)
{

    $Centric_Result = Centric_Query($Centric_Query);

    // If query failed, return `false`
    if($Centric_Result === false)
    {
        return false;
    }

    // If query was successful, retrieve all the rows into an array
    while ($row = mysqli_fetch_assoc($Centric_Result)) {
       echo "<p>{$row['User_Email']} <br> ".
           " </p";
        echo "test";
    }
    return $rows;
}
function Centric_Curr_Users()
{
    $Centric_Result = Centric_Select("SELECT * FROM Centric_Users");
    if($Centric_Result === false)
    {
        return false;
    }

}
function Centric_Signin()
{
    $Centric_User_Email = filter_var($_POST['Centric_User_Email'], FILTER_SANITIZE_STRING);
    $Centric_User_Password_Post = filter_var($_POST['Centric_User_Password'], FILTER_SANITIZE_STRING);

    $Centric_User_Password = sha1( $Centric_User_Password_Post );
    $Centric_Form_Token = md5( uniqid('auth', true) );

    $Centric_Result = Centric_Query("SELECT * FROM Centric_Users WHERE User_Email='$Centric_User_Email' AND User_Password='$Centric_User_Password'");

    $Centric_Get_Rows = mysqli_fetch_assoc($Centric_Result);

    $Centric_User_Org_ID = $Centric_Get_Rows['Org_ID'];
    $Centric_User_ID = $Centric_Get_Rows['User_ID'];
    $Centric_Group_ID = $Centric_Get_Rows['Group_ID'];
    $Centric_User_Password_Change = $Centric_Get_Rows['User_Password_Change'];

    $Centric_User_Exists = mysqli_num_rows($Centric_Result);
    if($Centric_User_Exists > 0 )
    {

        if ($Centric_Group_ID == "1")
        {
            $Centric_is_Admin = 1;
        }
        else
        {
            $Centric_is_Admin = 0;
        }

        if ($Centric_Group_ID == "2")
        {
            $Centric_is_Org_Admin = 1;
        }
        else
        {
            $Centric_is_Org_Admin = 0;
        }

        if($Centric_User_Password_Change == "1")
        {
           echo " <script> window.open('lti_reset.php','_self') </script> ";

        }

        $_SESSION['Centric_Org_Admin'] = $Centric_is_Org_Admin;
        $_SESSION['Centric_Admin'] = $Centric_is_Admin;
        $_SESSION['Centric_User_Email'] = $Centric_User_Email;
        $_SESSION['Centric_Secure_Token'] = $Centric_Form_Token;
        $_SESSION['Centric_Org_ID'] = $Centric_User_Org_ID;


        if($_SESSION['Centric_Admin'] == "1")
        {
            echo " <script> window.open('lti_org_admin.php','_self') </script> ";
        }
        elseif($_SESSION['Centric_Org_Admin'] == "1")
        {
            echo " <script> window.open('lti_org_admin.php','_self') </script> ";
        }
        else
        {
            echo " <script> window.open('Centric.php','_self') </script> ";
        }
    }
    else
    {
        echo "<script>alert('Email or password is not correct, try again!')</script>";

    }

    exit;

}

//Form submitted
if(isset($_POST['signin']))
{
    //Error checking
    if(!$_POST['Centric_User_Email'])
    {
        $error['Centric_User_Email'] = "<p>Please supply your email.</p>\n";
    }
    if(!$_POST['Centric_User_Password'])
    {
        $error['Centric_User_Password'] = "<p>Please supply your password.</p>\n";
    }
    //No errors, process
    if(!is_array($error))
    {
           Centric_Signin();
    }
}

?>



<!DOCTYPE HTML>
<html>
	<head>
		<title>Sign In</title>
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
				<h1 id="logo"><a href="index.php">Welcome To <span>LTI</span></a></h1>
			<div class="menu">
                <?php include 'lti_menu.php';?>
                </div>
			</header>

		<!-- Main -->
			<article id="main">

				<header class="special container">
					<span class="icon fa-laptop"></span>
					<h2>User Login</h2>
					<p>Please log in to view your Centric</p>
				</header>

				<!-- One -->
					<section class="wrapper style4 container">

						<div class="row 150%">

							<div class="8u 12u(narrower) important(narrower)">

								<!-- Content -->
									<div class="content">
										<section>
											<header>
												<h2>Sign In</h2>
											</header>

                                            <form method="post" action="<?=$_SERVER['PHP_SELF']?>">
                                                <fieldset>
                                                    <?=$error['Centric_User_Email']?>
                                                    <p>
                                                        <label for="Centric_User_Email">Email Address:</label>
                                                        <input type="email" id="Centric_User_Email" name="Centric_User_Email" value="" maxlength="40" required />
                                                    </p>
                                                    <?=$error['Centric_User_Password']?>
                                                    <p>
                                                        <label for="Centric_User_Password">Password</label>
                                                        <input type="password" id="Centric_User_Password" name="Centric_User_Password" value="" maxlength="75" required />
                                                    </p>
                                                    <p>
                                                        <input type="hidden" name="Centric_Form_Token" value="<?php echo $Centric_Form_Token; ?>" />
                                                        <input type="submit" name="signin" value="Sign In" />


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
