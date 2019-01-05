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
    <div class="col-md-3">
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