<!-- START BREADCRUMB -->
<ul class="breadcrumb">
	<li><a href="#">Home</a></li>                    
	<li class="active">Dashboard</li>
</ul>
<!-- END BREADCRUMB -->  

<!-- START WIDGETS -->                    
<div class="row">
    <!-- Advertisment -->
    <div class="col-md-3">
    </div>
    
    <div class="col-md-12">
        <h3>Select a region and explore all big Events!</h3>
        <p>Colored nations have inserted events, while the blackened ones do not have events inserted yet.</p>
    </div>

    <div class="col-md-12">
        <h3>Last 3 events uploaded.</h3>
        <p>Here there's a collection of the last 3 events uploaded. What the latest news only on FowDeckHub!</p>
		<div class="table-responsive">
            <?php require_once ROOT_PATH . '/components/decklists_table.php'; ?>
        </div>
    </div>
    
	<div class="col-md-12">
        <?php require_once ROOT_PATH . '/components/world_map.php'; ?>
	</div>
</div>

<!-- START THIS PAGE PLUGINS-->
<script type="text/javascript" src="js/demo_dashboard.js"></script>
<!-- END THIS PAGE PLUGINS-->