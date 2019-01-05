<!DOCTYPE html>
<html lang="en">
    <head>        
        <!-- META SECTION -->
        <title><?php echo $title; ?></title>            
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        
        <link rel="icon" href="favicon.ico" type="image/x-icon" />
        <!-- END META SECTION -->
        
        <!-- CSS INCLUDE -->
        <link rel="stylesheet" type="text/css" id="theme" href="css/theme-default.css"/>
        <link rel="stylesheet" type="text/css" id="theme" href="css/main.css"/>
        <!-- EOF CSS INCLUDE --> 

        <!-- START PRELOADS -->
        <audio id="audio-alert" src="audio/alert.mp3" preload="auto"></audio>
        <audio id="audio-fail" src="audio/fail.mp3" preload="auto"></audio>
        <!-- END PRELOADS --> 

        <!-- START PLUGINS -->
        <script type="text/javascript" src="js/plugins/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="js/plugins/jquery/jquery-ui.min.js"></script>
        <script type="text/javascript" src="js/plugins/bootstrap/bootstrap.min.js"></script>  
    </head>
    <body>
        <!-- START PAGE CONTAINER -->
        <div class="page-container page-navigation-top">            
            <!-- PAGE CONTENT -->
            <div class="page-content">
                
                <!-- START X-NAVIGATION VERTICAL -->
                <ul class="x-navigation x-navigation-horizontal">
                    <li class="xn-logo">
                        <a href="index.php">Fow Deck Hub<?php if(TEST) echo "*"; ?></a>
                        <a href="#" class="x-navigation-control"></a>
                    </li>
                    <li>
                        <a href="events.php"><i class="fa fa-users" aria-hidden="true"></i> Events</a>
                    </li>
                    <li>
                        <a href="decklists.php"><i class="fa fa-align-justify" aria-hidden="true"></i> Decklists</a>
                    </li>
                    <li>
                        <a href="faq.php"><i class="fa fa-question-circle"></i> F.A.Q.</a>
                    </li>
                    <!--<li class="xn-openable">
                        <a href="#"><span class="fa fa-pencil"></span> <span class="xn-text">Forms</span></a>
                        <ul class="animated zoomIn">
                            <li>
                                <a href="form-layouts-two-column.html"><span class="fa fa-tasks"></span> Form Layouts</a>
                                <div class="informer informer-danger">New</div>
                                <ul>
                                    <li><a href="form-layouts-one-column.html"><span class="fa fa-align-justify"></span> One Column</a></li>
                                    <li><a href="form-layouts-two-column.html"><span class="fa fa-th-large"></span> Two Column</a></li>
                                    <li><a href="form-layouts-tabbed.html"><span class="fa fa-table"></span> Tabbed</a></li>
                                    <li><a href="form-layouts-separated.html"><span class="fa fa-th-list"></span> Separated Rows</a></li>
                                </ul> 
                            </li>
                            <li><a href="form-elements.html"><span class="fa fa-file-text-o"></span> Elements</a></li>
                            <li><a href="form-validation.html"><span class="fa fa-list-alt"></span> Validation</a></li>
                            <li><a href="form-wizards.html"><span class="fa fa-arrow-right"></span> Wizards</a></li>
                            <li><a href="form-editors.html"><span class="fa fa-text-width"></span> WYSIWYG Editors</a></li>
                            <li><a href="form-file-handling.html"><span class="fa fa-floppy-o"></span> File Handling</a></li>
                        </ul>
                    </li>-->
                    <!-- SIGN IN/OUT -->
                    <?php
					if(isset($login_checked) && $login_checked){
						?>
						<li class="xn-icon-button pull-right">
							<a href="#" class="mb-control" data-box="#mb-signout"><span class="fa fa-sign-out"></span></a>
						</li> 
						<?php
					} else {
						?>
						<li class="xn-icon-button pull-right">
							<a href="login.php" class=""><span class="fa fa-sign-in"></span></a>
						</li>
						<li class="xn-icon-button pull-right">
							<a href="register.php" class=""><span class="fa fa-plus"></span></a>
						</li>
						<?php
					}
					?>
                    <!-- END SIGN OUT -->                                      
                </ul>
                <!-- END X-NAVIGATION VERTICAL -->