<?php   
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 
sec_session_start();

    if (login_check($mysqli) == true):
        
echo '
            <header id="header" class="skel-layers-fixed">
				<h1 id="logo"><a href="index">Welcome to <span>LTI</span></a></h1>
                <div class="menu">
                <nav id="nav">
					<ul>
						<li class="current"><a href="index">Home</a></li>
						<li class="submenu">
							<a href="">Pages</a>
							<ul>
								<li><a href="about">About LTI</a></li>
								<li><a href="services">Services</a></li>
								<li><a href="contact-us">Contact Us</a></li>
							</ul>
						</li>
						<li><a href="includes/logout" class="button special">Logout</a></li>
					</ul>
				</nav>
                </div>
			</header>';
    
    else:
echo '
            <header id="header" class="skel-layers-fixed">
                <h1 id="logo"><a href="index">Welcome to <span>LTI</span></a></h1>
                <div class="menu">
                <nav id="nav">
                    <ul>
                        <li class="current"><a href="index">Home</a></li>
                        <li class="submenu">
                            <a href="">Pages</a>
                            <ul>
                                <li><a href="about">About LTI</a></li>
                                <li><a href="services">Services</a></li>
                                <li><a href="contact-us">Contact Us</a></li>
                            </ul>
                        </li>
                        <li><a href="login" class="button special">Login</a></li>
                    </ul>
                </nav>
                </div>
            </header>';
    endif;
    
?>
