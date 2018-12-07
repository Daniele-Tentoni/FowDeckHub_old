<!-- START BREADCRUMB -->
<ul class="breadcrumb">
	<li><a href="index.php">Home</a></li>
	<li><a href="events.php">Events</a></li>
	<li>Event Details</li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE TITLE -->
<div class="page-title">                    
	<h2 onclick="history.back();"><span class="fa fa-arrow-circle-o-left"></span> Event Details</h2>
	<span class="right-align"></span>
</div>
<!-- END PAGE TITLE -->

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">

	<div class="row">
		<div class="col-md-12">
			<div class="row">                        
				<div class="col-md-12">
					<div class="panel panel-default">
                        <?php
                        // Se l'utente ha il permesso di modificare gli eventi allora glielo permetto.
                        if(isset($_SESSION['can_edit_events']) && $_SESSION['can_edit_events'] == 1) {
                            ?>
                            <div class="panel-heading">
                                <h3 class="panel-title">Event Details</h3>
                                <a href="events.php?event_edit=<?php echo $event_id; ?>" class="btn btn-primary btn-rounded pull-right"><i class="fa fa-pencil"></i>Edit</a>
                            </div>
                            <?php
                        }
                        ?>
						<div class="panel-body">                            
							<div class="tocify-content">
								<h2><?php echo $event["Name"]; ?>&nbsp; <?php echo $event["Year"]; ?></h2>
                                <h3><?php echo $event["Date"]; ?> in <?php echo $event["Nation"]; ?></h3>
                                <p><?php echo $event["Attendance"]; ?> players</p>
								<p>
									<?php
									$event_hide = true;
									$action_hide = true;
									require_once ROOT_PATH . '/components/tables/decklists_table.php'; 
									?>
								</p>
                                <!--
                                RulerBreakdown
                                --><div class="col-md-6">
                                    <h2>Rulers Breakdown</h2>
                                    <!-- START DOUNT CHART -->
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <div id="ruler_breakdown" style="height: 300px;"><svg></svg></div>
                                        </div>
                                    </div>
                                    <!-- END DOUNT CHART -->
                                </div><!--
                                Card percentage in top8
                                --><div class="col-md-6">
                                    <h2>Card Percentage in top 8</h2>                                    
                                    <p>I'm working on it. It's really hard to implement.</p>
                                </div><!--
                                Rune Deck percentage in top8
                                --><div class="col-md-6">
                                    <h2>Rune deck Percentage in top 8</h2>
                                    <p>I'm working on it. It's really hard to implement.</p>
                                </div><!--
                                Tournament reports
                                --><div class="col-md-12">
                                    <h2>Tournament reports from comunity</h2>
                                    <p><?php echo $event["CommunityReports"]; ?></p>
                                </div><!--
                                Other Links
                                --><div class="col-md-12">
                                    <h2>Other Links</h2>
                                    <p><?php echo $event["OtherLinks"]; ?></p>
                                </div>
                            </div>
								
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
<script type="text/javascript" src="js/plugins/nvd3/lib/d3.v3.js"></script>        
<script type="text/javascript" src="js/plugins/nvd3/nv.d3.min.js"></script>
<script type="text/javascript">
	$(function() {
		/*
		 * Da reinserire quando troverò come sistemare il bug.
        */
         var toc = $("#tocify").tocify({
			context: ".tocify-content", 
			showEffect: "fadeIn",
			extendPage:false,
			selectors: "h2" 
		});
        
        var arrev = <?php
                    if(TEST && isset($chart)) {
                        echo $chart;
                    } else {
                        echo "Nessun grafico.";
                    }
                    ?>;
        console.log(arrev);
        
	});

	var startChart9 = function() {
		/*
		 * Donut chart example.
		 */
		nv.addGraph(function() {
			var chart = nv.models.pieChart().x(function(d) {
				return d.label;
			}).y(function(d) {
				return d.value;
			}).showLabels(true)//Display pie labels
			.labelThreshold(.05)//Configure the minimum slice size for labels to show up
			.labelType("percent")//Configure what type of data to show in the label. Can be "key", "value" or "percent"
			.donut(true)//Turn on Donut mode. Makes pie chart look tasty!
			.donutRatio(0.35)//Configure how big you want the donut hole size to be.
			;;

			d3.select("#ruler_breakdown svg").datum(exampleData()).transition().duration(350).call(chart);
            console.log(exampleData());
			return chart;
		});

		/*
		 * Pie chart example data. Note how there is only a single array of key-value pairs.
		 */
		function exampleData() {
			return <?php echo $chart; ?>;
		}
	};

	startChart9();
</script>
<!-- END THIS PAGE PLUGINS-->  