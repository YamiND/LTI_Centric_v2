<?php

    include_once 'includes/db_connect.php';
    include_once 'includes/functions.php';

    sec_session_start();

    if (login_check($mysqli) == true) 
    {
        $logged = 'in';
    } 
    else 
    {
        $logged = 'out';
    }

?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Login</title>
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
        <script type="text/JavaScript" src="/js/sha512.js"></script> 
        <script type="text/JavaScript" src="/js/forms.js"></script> 
        
		<!-- Stylesheets -->
            <?php include 'css.php';?>
        
	</head>
    
	<body class="left-sidebar">

		<!-- Header -->
			<?php include 'header.php';?>

		<!-- Main -->
			<article id="main">
				<header class="special container">
					<span class="icon fa-laptop"></span>
					<h2>User Login</h2>
				</header>
                
				<!-- One -->
					<section class="wrapper style4 container">
						<div class="row 150%">
							<div class="8u 12u(narrower) important(narrower)">
								<!-- Content -->
								<div class="content">
                                    <section>
                                        <header>
                                            <h2>Login</h2>
                                        </header>

                                        <?php
                                            if (isset($_GET['error'])) 
                                            {
                                                echo '<p class="error">Error Logging In!</p>';
                                            }
                                        ?>
                                        
                                        <?php
                                            if (login_check($mysqli) == true) 
                                            {
                                                echo '<p>Currently logged ' . $logged . ' as ' . htmlentities($_SESSION['username']) . '.</p>';
                                                echo '<p>Do you want to change user? <a href="/includes/logout.php">Log out</a>.</p>';
                                            }
                                            else 
                                            {
                                        ?>
                                    
                                        <form action="/includes/process_login.php" method="post" name="login_form">                      
                                            Email: <input type="text" name="email" />
                                            Password: <input type="password" 
                                                             name="password" 
                                                             id="password"/>
                                            
                                            <input type="button" 
                                                   value="Login" 
                                                   onclick="formhash(this.form, this.form.password);" /> 
                                        </form>
                                        <?php
                                            }
                                        ?>
                                        
                                    </section>
								</div>
							</div>
						</div>
					</section>
			</article>
        
        <!-- Footer -->
			<?php include 'footer.php';?>
	
    </body>
</html>
