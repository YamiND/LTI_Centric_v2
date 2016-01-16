<?php
include_once 'includes/register.inc.php';
include_once 'includes/functions.php';
include_once 'includes/db_connect.php';
 
sec_session_start();
?>

<!DOCTYPE html>
<html>
    <head>
		<title>Register</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
        
        <!-- Favicon-->
            <?php include 'favicon.php';?>
		
        <!--[if lte IE 8]><script src="/css/ie/html5shiv.js"></script><![endif]-->
		<script src="/js/jquery.min.js"></script>
		<script src="/js/jquery.dropotron.min.js"></script>
		<script src="/js/jquery.scrolly.min.js"></script>
		<script src="/js/jquery.scrollgress.min.js"></script>
		<script src="/js/skel.min.js"></script>
		<script src="/js/skel-layers.min.js"></script>
		<script src="/js/init.js"></script>
        <script src="/js/validation.js"></script>
        <script type="text/JavaScript" src="/js/sha512.js"></script> 
        <script type="text/JavaScript" src="/js/forms.js"></script> 
        
		<!-- Stylesheets -->
            <?php include 'css.php';?>
        
	</head>
    <body class="left-sidebar">
        <!-- Header -->
			<?php include 'header.php';?>
         
        <?php if (login_check($mysqli) == true) : ?>
            <p>Welcome <?php echo htmlentities($_SESSION['username']); ?>!</p>
        
        <?php
        if (!empty($error_msg)) 
        {
            echo $error_msg;
        }
        ?>
        
        <!-- Main -->
			<article id="main">
				<header class="special container">
					<span class="icon fa-user"></span>
					<h2>Register a new User</h2>
				</header>
				<!-- One -->
					<section class="wrapper style4 container">
						<div class="row 150%">
							<div class="8u 12u(narrower) important(narrower)">
								<!-- Content -->
								<div class="content">
                                    <section>
                                        <header>
                                            <ul class="buttons vertical">
                                                <li>Usernames may contain only digits, upper and lowercase letters and underscores</li>
                                                <li>Emails must have a valid email format</li>
                                                <li>Passwords must be at least 6 characters long</li>
                                                <li>Passwords must contain
                                                    <ul class="buttons vertical">
                                                        <li>At least one uppercase letter (A..Z)</li>
                                                        <li>At least one lowercase letter (a..z)</li>
                                                        <li>At least one number (0..9)</li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </header>
                                            <form action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" 
                                            method="post" 
                                            name="registration_form">
                                        Username: <input type='text' 
                                            name='username' 
                                            id='username' /><br>
                                        Email: <input type="text" name="email" id="email" /><br>
                                        Password: <input type="password"
                                                         name="password" 
                                                         id="password"/><br>
                                        Confirm password: <input type="password" 
                                                                 name="confirmpwd" 
                                                                 id="confirmpwd" /><br>
                                        <input type="button" 
                                               value="Register" 
                                               onclick="return regformhash(this.form,
                                                               this.form.username,
                                                               this.form.email,
                                                               this.form.password,
                                                               this.form.confirmpwd);" /> 
                                    </form>
                                    <p>Return to the <a href="index">Index Page</a>.</p>
                                        
                                    </section>
								</div>
							</div>
						</div>
					</section>
			</article>
        
        <?php else : ?>
            <p>
                <span class="error">You are not authorized to access this page.</span> Please <a href="login">login</a>.
            </p>
        <?php endif; ?>
    </body>
</html>