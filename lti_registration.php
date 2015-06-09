
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
function Centric_Curr_Emails()
{
    $Centric_Result = Centric_Query("SELECT `User_Email` FROM `Centric_Users`");
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
function Centric_adduser()
{
    $Centric_Org_Name = filter_var($_POST['Centric_Org_Name'], FILTER_SANITIZE_STRING);
    $Centric_Org_Storage = filter_var($_POST['Centric_Org_Storage'], FILTER_SANITIZE_STRING);
    $Centric_First_Name = filter_var($_POST['Centric_First_Name'], FILTER_SANITIZE_STRING);
    $Centric_Last_Name = filter_var($_POST['Centric_Last_Name'], FILTER_SANITIZE_STRING);
    $Centric_User_Password = filter_var($_POST['Centric_User_Password'], FILTER_SANITIZE_STRING);
    $Centric_User_Password_Confirm = filter_var($_POST['Centric_User_Password_Confirm'], FILTER_SANITIZE_STRING);
    $Centric_User_Email = filter_var($_POST['Centric_User_Email'], FILTER_SANITIZE_STRING);
    $Centric_User_Email_Confirm = filter_var($_POST['Centric_User_Email_Confirm'], FILTER_SANITIZE_STRING);
    $Centric_CC_Num = filter_var($_POST['Centric_CC_Num'], FILTER_SANITIZE_STRING);
    $Centric_CC_Date = filter_var($_POST['Centric_CC_Date'], FILTER_SANITIZE_STRING);
    $Centric_CC_Vnum = filter_var($_POST['Centric_CC_Vnum'], FILTER_SANITIZE_STRING);
    $Centric_Bill_Addr = filter_var($_POST['Centric_Bill_Addr'], FILTER_SANITIZE_STRING);
    $Centric_Bill_City = filter_var($_POST['Centric_Bill_City'], FILTER_SANITIZE_STRING);
    $Centric_Bill_State = filter_var($_POST['Centric_Bill_State'], FILTER_SANITIZE_STRING);
    $Centric_Bill_Zip = filter_var($_POST['Centric_Bill_Zip'], FILTER_SANITIZE_STRING);
    $Centric_Con_Phone = filter_var($_POST['Centric_Con_Phone'], FILTER_SANITIZE_STRING);
    $Centric_Tier_ID = filter_var($_POST['Centric_Tier_ID'], FILTER_SANITIZE_STRING);



    if ($Centric_User_Password == $Centric_User_Password_Confirm)
    {
        if ($Centric_User_Email == $Centric_User_Email_Confirm)
        {
            $Centric_Con_Addr = $Centric_Bill_Addr;
            $Centric_Con_City = $Centric_Bill_City;
            $Centric_Con_State = $Centric_Bill_State;
            $Centric_Con_Zip = $Centric_Bill_Zip;
            $Centric_Con_Email = $Centric_User_Email;
            $Centric_Org_Admin = $Centric_User_Email;

            $Centric_User_Password = sha1( $Centric_User_Password );

            $Centric_Result = Centric_Query("select User_Email from Centric_Users where User_Email='$Centric_User_Email'");
            $Centric_Email_Exists = mysqli_num_rows($Centric_Result);
            if($Centric_Email_Exists > 0 )
            {
                echo "Email already exists, please go back and fix your mistake";
            }
            else
            {
                //INSERTING VALUES INTO Centric_CreditCard
                Centric_Insert("INSERT INTO `Centric_CreditCard` (`CC_Num`, `CC_Date`, `CC_Vnum`, `Bill_First_Name`, `Bill_Last_Name`, `Bill_Addr`, `Bill_City`, `Bill_State`, `Bill_Zip` ) VALUES('$Centric_CC_Num', '$Centric_CC_Date', '$Centric_CC_Vnum', '$Centric_First_Name', '$Centric_Last_Name', '$Centric_Bill_Addr', '$Centric_Bill_City', '$Centric_Bill_State', '$Centric_Bill_Zip')");

                //INSERTING VALUES INTO Centric_Contact
                Centric_Insert("INSERT INTO `Centric_Contact` (`Con_First_Name`, `Con_Last_Name`, `Con_Addr`, `Con_City`, `Con_State`, `Con_Zip`, `Con_Phone`, `Con_Email`) VALUES('$Centric_First_Name', '$Centric_Last_Name', '$Centric_Con_Addr', '$Centric_Con_City', '$Centric_Con_State', '$Centric_Con_Zip', '$Centric_Con_Phone', '$Centric_Con_Email')");

                //GRABBING CC_ID from Centric_CreditCard
                $Centric_Result = Centric_Query("SELECT CC_ID from Centric_CreditCard WHERE CC_Num='$Centric_CC_Num'");
                $Centric_Fetch_CC_ID = mysqli_fetch_row($Centric_Result);
                $Centric_CC_ID = $Centric_Fetch_CC_ID[0];

                //GRABBING Con_ID from Centric_Contact
                $Centric_Result = Centric_Query("SELECT Con_ID from Centric_Contact WHERE Con_Email='$Centric_User_Email'");
                $Centric_Fetch_Con_ID = mysqli_fetch_row($Centric_Result);
                $Centric_Con_ID = $Centric_Fetch_Con_ID[0];

                //Got CC_ID, Tier_ID, and Con_ID
                //INSERTING VALUES INTO Centric_Organization
                Centric_Insert("INSERT INTO `Centric_Organization` (`Org_Name`, `Org_Storage`, `Org_Admin_Email`, `Tier_ID`, `CC_ID`, `Con_ID` ) VALUES('$Centric_Org_Name', '$Centric_Org_Storage', '$Centric_User_Email', '$Centric_Tier_ID', '$Centric_CC_ID', '$Centric_Con_ID')");

                //GRABBING Org_ID from Centric_Organization
                $Centric_Result = Centric_Query("SELECT Org_ID from Centric_Organization WHERE Org_Admin_Email='$Centric_User_Email' AND Org_Name = '$Centric_Org_Name' AND CC_ID='$Centric_CC_ID'");
                $Centric_Fetch_Org_ID = mysqli_fetch_row($Centric_Result);
                $Centric_Org_ID = $Centric_Fetch_Org_ID[0];

                //GRABBING Group_ID from Centric_Group
                $Centric_Result = Centric_Query("SELECT Group_ID from Centric_Group WHERE Group_Name='Org_Admin'");
                $Centric_Fetch_Group_ID = mysqli_fetch_row($Centric_Result);
                $Centric_Group_ID = $Centric_Fetch_Group_ID[0];

                //GRABBING File_Perm_ID from Centric_FilePerm
                $Centric_Result = Centric_Query("SELECT File_Perm_ID from Centric_FilePerm WHERE Can_Upload='1' AND Can_Download='1' AND Can_Delete='1'");
                $Centric_Fetch_File_Perm_ID = mysqli_fetch_row($Centric_Result);
                $Centric_File_Perm_ID = $Centric_Fetch_File_Perm_ID[0];

                //INSERTING VALUES INTO Centric_Users
                Centric_Insert("INSERT INTO `Centric_Users` (`User_Email`, `User_Password`, `First_Name`, `Last_Name`,  `Org_ID`, `Group_ID`, `File_Perm_ID`) VALUES('$Centric_User_Email', '$Centric_User_Password', '$Centric_First_Name', '$Centric_Last_Name', '$Centric_Org_ID', '$Centric_Group_ID', '$Centric_File_Perm_ID')");

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
    if(!$_POST['Centric_Org_Name'])
    {
        $error['Centric_Org_Name'] = "<p>Please supply the Organization name.</p>\n";
    }
    if(!$_POST['Centric_Org_Storage'])
    {
        $error['Centric_Org_Storage'] = "<p>Please supply the size limit.</p>\n";
    }
    if(!$_POST['Centric_First_Name'])
    {
        $error['Centric_First_Name'] = "<p>Please supply the first name.</p>\n";
    }
    if(!$_POST['Centric_Last_Name'])
    {
        $error['Centric_Last_Name'] = "<p>Please supply the last name.</p>\n";
    }
    if(!$_POST['Centric_User_Password'])
    {
        $error['Centric_User_Password'] = "<p>Please supply the password.</p>\n";
    }
    if(!$_POST['Centric_User_Password_Confirm'])
    {
        $error['Centric_User_Password_Confirm'] = "<p>Please supply the confirmed password.</p>\n";
    }

    if(!$_POST['Centric_User_Email'])
    {
        $error['Centric_User_Email'] = "<p>Please supply the email.</p>\n";
    }
    if(!$_POST['Centric_User_Email_Confirm'])
    {
        $error['Centric_User_Email_Confirm'] = "<p>Please supply the email.</p>\n";
    }
    if(!$_POST['Centric_CC_Num'])
    {
        $error['Centric_CC_Num'] = "<p>Please supply a Credit Card number.</p>\n";
    }
    if(!$_POST['Centric_CC_Date'])
    {
        $error['Centric_CC_Date'] = "<p>Please supply a Credit Card Exp Date.</p>\n";
    }
    if(!$_POST['Centric_CC_Vnum'])
    {
        $error['Centric_CC_Vnum'] = "<p>Please supply the verification number.</p>\n";
    }
    if(!$_POST['Centric_Bill_Addr'])
    {
        $error['Centric_Bill_Addr'] = "<p>Please supply the address.</p>\n";
    }
    if(!$_POST['Centric_Bill_City'])
    {
        $error['Centric_Bill_City'] = "<p>Please supply the city.</p>\n";
    }
    if(!$_POST['Centric_Bill_State'])
    {
        $error['Centric_Bill_State'] = "<p>Please supply the state.</p>\n";
    }
    if(!$_POST['Centric_Bill_Zip'])
    {
        $error['Centric_Bill_Zip'] = "<p>Please supply the zip.</p>\n";
    }
    if(!$_POST['Centric_Con_Phone'])
    {
        $error['Centric_Con_Phone'] = "<p>Please supply a phone number.</p>\n";
    }
    if(!$_POST['Centric_Tier_ID'])
    {
        $error['Centric_Tier_ID'] = "<p>Please supply the Tier ID.</p>\n";
    }

    //No errors, process
    if(!is_array($error))
    {

        if ($_POST['Centric_Form_Token'] == $_SESSION['Centric_Secure_Token'])
        {
            Centric_adduser();
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

                                                Centric_Curr_Emails();

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
                                                    <?=$error['Centric_Org_Name']?>
                                                    <p>
                                                        <label for="Centric_Org_Name">Organization Name</label>
                                                        <input type="text" id="Centric_Org_Name" name="Centric_Org_Name" value="" maxlength="75" required />
                                                    </p>
                                                     <?=$error['Centric_Org_Storage']?>
                                                    <p>
                                                        <label for="Centric_Org_Storage">Amount of space (GB):</label>
                                                        <input type="number" id="Centric_Org_Storage" name="Centric_Org_Storage" value="" maxlength="5" required />
                                                    </p>
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
                                                     <?=$error['Centric_CC_Num']?>
                                                    <p>
                                                        <label for="Centric_CC_Num">Credit Card Number:</label>
                                                        <input type="number" id="Centric_CC_Num" name="Centric_CC_Num" value="" maxlength="20" required />
                                                    </p>
                                                     <?=$error['Centric_CC_Date']?>
                                                    <p>
                                                        <label for="Centric_CC_Date">Credit Card Exp Date:</label>
                                                        <input type="number" id="Centric_CC_Date" name="Centric_CC_Date" value="" maxlength="4" required />
                                                    </p>
                                                     <?=$error['Centric_CC_Vnum']?>
                                                    <p>
                                                        <label for="Centric_CC_Vnum">Credit Card Verification Number:</label>
                                                        <input type="number" id="Centric_CC_Vnum" name="Centric_CC_Vnum" value="" maxlength="3" required />
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
                                                    <?=$error['Centric_Con_Phone']?>
                                                     <p>
                                                        <label for="Centric_Con_Phone">Phone Number</label>
                                                        <input type="num" id="Centric_Con_Phone" name="Centric_Con_Phone" value="" maxlength="10" required />
                                                    </p>
                                                    <?=$error['Centric_Tier_ID']?>
                                                    <p>
                                                        <label for="Centric_Tier_ID">Choose a Tier:</label>
                                                        <input type="number" id="Centric_Tier_ID" name="Centric_Tier_ID" value="" maxlength="2" required />
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
