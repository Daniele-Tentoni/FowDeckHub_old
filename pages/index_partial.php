<!-- START BREADCRUMB -->
<ul class="breadcrumb">
	<li><a href="#">Home</a></li>                    
	<li class="active">Dashboard</li>
</ul>
<!-- END BREADCRUMB -->  

<!-- START WIDGETS -->                    
<div class="row">
    <!-- UTILITY WIDGETS -->
	<div class="col-md-3">
		<?php require_once ROOT_PATH . '/components/widgets/visitors_widget.php'; ?>
	</div>
	<div class="col-md-3">
		<?php require_once ROOT_PATH . '/components/widgets/users_widget.php'; ?>
    </div>
    <div class="col-md-3">
        <?php require_once ROOT_PATH . '/components/widgets/bug_reports_widget.php'; ?>
    </div>
    <div class="col-md-6">
        <script>
            google_color_border = "#003399";
            google_color_bg = "#FFFFFF";
            google_color_link = "#0033CC";
            google_color_url = "#008000";
            google_color_text = "#000000";
            google_ui_features = "rc:0";
            !function(d,l,e,s,c) {
                e=d.createElement("script");
                e.src="//ad.altervista.org/js.ad/size=300X250/?ref="+encodeURIComponent(l.hostname+l.pathname)+"&r="+Date.now();
                s=d.scripts;
                c=s[s.length-1];
                c.parentNode.insertBefore(e,c)
            }(document,location)
        </script>
    </div>
    
    <!-- END UTILITY WIDGETS -->
    
    <!-- START EVENTS WIDGET -->
	<div class="col-md-6">
		<?php require_once ROOT_PATH . '/components/widgets/events_widget.php'; ?>
	</div>
    <!-- END EVENTS WIDGET -->
	
    <!-- START SETS WIDGET -->
	<div class="col-md-6">
		<?php require_once ROOT_PATH . '/components/widgets/sets_filling_widget.php'; ?>
	</div>
    <!-- END SETS WIDGET -->
    
	<div class="col-md-12">
		<?php require_once ROOT_PATH . '/components/world_map.php'; ?>
	</div>
</div>

<!-- START THIS PAGE PLUGINS-->
<script type="text/javascript" src="js/demo_dashboard.js"></script>
<!-- END THIS PAGE PLUGINS-->