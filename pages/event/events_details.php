<!-- START BREADCRUMB -->
<ul class="breadcrumb">
	<li><a href="index.php">Home</a></li>
	<li><a href="events.php">Events</a></li>
	<li><a href="#">Event Details</a></li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE TITLE -->
<div class="page-title">                    
	<h2><span class="fa fa-arrow-circle-o-left"></span> Event Details</h2>
</div>
<!-- END PAGE TITLE -->

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">

	<div class="row">
		<div class="col-md-12">
			<div class="row">                        
				<div class="col-md-9">
					<div class="panel panel-default">
						<div class="panel-body">                            
							<div class="tocify-content">
								
								<h2>Some information data.</h2>
								<p>I'm working on it.</p>

								<h2>Top 8 Rulers and Decks.</h2>
								<p>
									<?php
									require_once $_SERVER['DOCUMENT_ROOT'] . '/loaders/load_decklists.php';
									$decklists = get_event_decks($eventId);
									$event_hide = true;
									require_once $_SERVER['DOCUMENT_ROOT'] . '/components/tables/decklists_table.php'; 
									?>
								</p>

								<h2>Card Percentage in top 8</h2>                                    
								<p>I'm working on it.</p>
								
								<h2>Rune deck Percentage in top 8</h2>
								<p>I'm working on it.</p>
								
								<h2>Rulers Breakdown</h2>
								<p>I'm working on it.</p>

								<h2>Turnament reports from comunity</h2>
								<p>I'm working on it.</p>
								
								<h2>Other Links</h2>
								<p>I'm working on it.</p>
							</div> 
						</div>
					</div>
				</div>
				<div class="col-md-3" style="position: relative;">
					<div id="tocify"></div>
				</div>
			</div>
			
		<!-- END PAGE CONTENT WRAPPER -->                                    
		</div>         
	</div>            
	<!-- END PAGE CONTENT -->
</div>
<!-- END PAGE CONTAINER -->    

<!-- MESSAGE BOX-->
<div class="message-box animated fadeIn" data-sound="alert" id="mb-remove-row">
	<div class="mb-container">
		<div class="mb-middle">
			<div class="mb-title"><span class="fa fa-times"></span> Remove <strong>Data</strong> ?</div>
			<div class="mb-content">
				<p>Are you sure you want to remove this row?</p>                    
				<p>Press Yes if you sure.</p>
			</div>
			<div class="mb-footer">
				<div class="pull-right">
					<button class="btn btn-success btn-lg mb-control-yes">Yes</button>
					<button class="btn btn-default btn-lg mb-control-close">No</button>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END MESSAGE BOX-->

<!-- ADD EVENT MODAL -->
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/components/modals/add_event_modal.php'; ?>
<!-- END ADD EVENT MODAL -->

<!-- START THIS PAGE PLUGINS-->        
<script type='text/javascript' src='js/plugins/icheck/icheck.min.js'></script>
<script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
<script type="text/javascript" src="js/plugins/tocify/jquery.tocify.min.js"></script>
<script type="text/javascript">
	$(function() {
		var toc = $("#tocify").tocify({context: ".tocify-content", showEffect: "fadeIn",extendPage:false,selectors: "h2, h3, h4" });
	});
</script>
<!-- END THIS PAGE PLUGINS-->  