                <div class="row" style="padding: 1em 0;">
                    <div class="col-md-3"></div>
                    <div class="col-md-3">
                        <ul>
                            <li>Help us to improve!</li>
                            <li><a href="#" target="_blank">Report a bug!</a></li>
                        </ul>
                        
                    </div>
                    <div class="col-md-3">
                        <ul>
                            <li>Thank for templates to <a href="https://github.com/sbilly" target="_blank">Sbilly</a></li>
                            <li>Fow Deck Hub: <span class="copyright">@ Daniele Tentoni, 2019 </span></li>
                        </ul>
                        
                    </div>
                    <div class="col-md-3"></div>
                </div>
			</div>           
            <!-- END PAGE CONTENT -->
		</div>
        <!-- END PAGE CONTAINER -->
		<!-- LOGOUT MESSAGE BOX-->
        <?php
        if(isset($login_checked) && $login_checked) {
            ?>
            <div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
                <div class="mb-container">
                    <div class="mb-middle">
                        <div class="mb-title"><span class="fa fa-sign-out"></span> Log <strong>Out</strong> ?</div>
                        <div class="mb-content">
                            <p>Are you sure you want to log out?</p>                    
                            <p>Press No if youwant to continue work. Press Yes to logout current user.</p>
                        </div>
                        <div class="mb-footer">
                            <div class="pull-right">
                                <a href="process_logout.php" class="btn btn-success btn-lg">Yes</a>
                                <button class="btn btn-default btn-lg mb-control-close">No</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
        <!-- END LOGOUT MESSAGE BOX-->
        
    <!-- START SCRIPTS -->

        <script type='text/javascript' src='js/plugins/bootstrap/bootstrap-datepicker.js'></script>
        <script type="text/javascript" src="js/plugins/daterangepicker/daterangepicker.js"></script>

        <!-- START TEMPLATE -->
		<script type="text/javascript" src="js/plugins.js"></script>        
		<script type="text/javascript" src="js/actions.js"></script>
        <script type="text/javascript" src="js/plugins/datatables/jquery.dataTables.min.js"></script>
        <!-- END TEMPLATE -->
    <!-- END SCRIPTS -->         
    </body>
</html>