<?php
    include_once 'includes/db_connect.php';
    include_once 'includes/functions.php';

    sec_session_start();
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>LTI: Contact Us</title>
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
	<body class="contact">

		<!-- Header -->
			<?php include 'header.php';?>

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
                                
                                <?php

                                    if(isset($_POST['submit']))
                                    {
                                        //Email information
                                        $email_to = "contact-us@lakertech.com";

                                        function died($error) 
                                        {    
                                            echo "We are very sorry, but there were error(s) found with the form you submitted. ";
                                            echo "This was the error that occured:<br /><br />";
                                            echo $error."<br /><br />";
                                            echo "Please <a href='contact-us'>go back</a> and fix these errors.<br /><br />";
                                            die();
                                        }

                                        //Checks if there are values
                                        if(!isset($_POST['name']) || !isset($_POST['message']) || !isset($_POST['email']) || !isset($_POST['subject'])) 
                                        {
                                            died('We are sorry, but there appears to be a problem with the form you submitted.');       
                                        }

                                        $email_subject = $_POST['subject'];
                                        $email_from = $_POST['email'];
                                        $email_server = "website@lakertech.com";

                                        $message = $_POST['message'];
                                        $name = $_POST['name'];

                                        $error_message = "";
                                        $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

                                        if(!preg_match($email_exp,$email_from)) 
                                        {
                                            $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
                                        }

                                        $string_exp = "/^[A-Za-z .'-]+$/";

                                        if(strlen($message) < 2) 
                                        {
                                            $error_message .= 'The Comments you entered do not appear to be valid.<br />';
                                        }

                                        if(strlen($error_message) > 0) 
                                        {
                                            died($error_message);
                                        }

                                        $email_message = "Form details below.\n\n";

                                        function clean_string($string) 
                                        {
                                            $bad = array("content-type","bcc:","to:","cc:","href");
                                            return str_replace($bad,"",$string);
                                        }

                                        $email_message .= "Name: ".clean_string($name)."\n";
                                        $email_message .= "Email: ".clean_string($email_from)."\n";
                                        $email_message .= "Comments: ".clean_string($message)."\n";

                                        // create email headers

                                        $headers = 'From: '.$email_server."\r\n".
                                        'Reply-To: '.$email_from."\r\n" .
                                        'X-Mailer: PHP/' . phpversion();

                                        mail($email_to, $email_subject, $email_message, $headers);  

                                        echo "Thank you for contacting us! <a href='contact-us'>Go Back</a>";
                                    }
                                    else {
                                    ?>
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
                                    <?php
                                        }
                                    ?>
							</div>

					</section>

			</article>

		<!-- Footer -->
			<?php include 'footer.php';?>

	</body>
</html>
