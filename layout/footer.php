                <div class="row" style="padding: 1em 0;">
                    <div class="col-md-3"></div>
                    <div class="col-md-3">
                        <ul>
                            <li><a href="faq.php"><i class="fa fa-question" aria-hidden="true"></i> F.A.Q.</a></li>
                            <li><a href="#" class="mb-control" data-box="#mb-bugreport"><i class="fa fa-bug" aria-hidden="true"></i> Report a bug!</a></li>
                        </ul>
                        
                    </div>
                    <div class="col-md-3">
                        <ul>
                            <li>Thank for templates to <a href="https://github.com/sbilly" target="_blank">Sbilly</a></li>
                            <li>Fow Deck Hub: <span class="copyright">&copy; Daniele Tentoni, 2018 </span></li>
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
            require_once ROOT_PATH . '/components/modals/logout_modal.php';
        }
        ?>
        <!-- END LOGOUT MESSAGE BOX-->

        <!-- BUG REPORT MESSAGE BOX-->
        <?php require_once ROOT_PATH . '/components/modals/bug_report_modal.php'; ?>
        <!-- BUG REPORT MESSAGE BOX-->
        
    <!-- START SCRIPTS -->
        <script type='text/javascript' src='js/plugins/icheck/icheck.min.js'></script>        
        <script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
        <script type="text/javascript" src="js/plugins/scrolltotop/scrolltopcontrol.js"></script>

        <script type="text/javascript" src="js/plugins/morris/raphael-min.js"></script>
        <script type="text/javascript" src="js/plugins/morris/morris.min.js"></script>       
        <script type="text/javascript" src="js/plugins/rickshaw/d3.v3.js"></script>
        <!--<script type="text/javascript" src="js/plugins/rickshaw/rickshaw.min.js"></script>-->
        <script type='text/javascript' src='js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'></script>
        <script type='text/javascript' src='js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js'></script>                
        <script type='text/javascript' src='js/plugins/bootstrap/bootstrap-datepicker.js'></script>
        <script type="text/javascript" src="js/plugins/bootstrap/bootstrap-select.js"></script>
        <script type="text/javascript" src="js/plugins/owl/owl.carousel.min.js"></script>

        <script type="text/javascript" src="js/plugins/moment.min.js"></script>
        <script type="text/javascript" src="js/plugins/daterangepicker/daterangepicker.js"></script>
        <script type="text/javascript" src="js/plugins/datatables/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="js/bug_report.js"></script>

        <!-- START TEMPLATE -->
		<script type="text/javascript" src="js/plugins.js"></script>        
		<script type="text/javascript" src="js/actions.js"></script>
        <?php 
        if(isset($add_script)) {
            echo $add_script;
        }
        ?>
        <!-- END TEMPLATE -->
    <!-- END SCRIPTS -->         
    </body>
</html>