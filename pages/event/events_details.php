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
						<div class="panel-heading">
							<h3 class="panel-title">Event Details</h3>
							<?php
							// Se l'utente ha il permesso di modificare gli eventi allora glielo permetto.
							if(isset($_SESSION['can_edit_events']) && $_SESSION['can_edit_events'] == 1) {
								?>
								<a href="events.php?event_edit=<?php echo $event_id; ?>" class="btn btn-primary btn-rounded pull-right"><i class="fa fa-pencil"></i>Edit</a>
								<?php
							}
							?>
						</div>
						<div class="panel-body">                            
							<div class="tocify-content">
								<h2><?php echo $event["Name"]; ?>&nbsp; <?php echo $event["Year"]; ?></h2>
                                <h3>
                                    <?php 
                                    $pieces = explode(" ", $event["Date"]);
                                    echo $pieces[0]; 
                                    ?> in <?php echo $event["Nation"]; ?>
                                </h3>
                                <p><?php echo $event["Attendance"]; ?> players</p>
								<div class="row">
									<?php
									$event_hide = true;
									$action_hide = true;
									require_once ROOT_PATH . '/components/tables/decklists_table.php'; 
									?>
								</div>
								<div class="row"><!--
                                	Top8RulerBreakdown
									--><div class="col-md-6">
										<!-- START STACKED CHART -->
										<div class="panel panel-default">
											<div class="panel-heading">
												<h3 class="panel-title">Top 8 Rulers Breakdown</h3>
											</div>
											<div class="panel-body">
												<div id="top8_ruler_breakdown" style="height: 300px;"><svg></svg></div>
											</div>
										</div>
										<!-- END STACKED CHART -->
									</div>
									<!--
									EventRulerBreakdown
									--><div class="col-md-6">
										<!-- START STACKED CHART -->
										<div class="panel panel-default">
											<div class="panel-heading">
												<h3 class="panel-title">Rulers Breakdown</h3>
											</div>
											<div class="panel-body">
												<div id="event_ruler_breakdown" style="height: 300px;"><svg></svg></div>
											</div>
										</div>
										<!-- END STACKED CHART -->
									</div><!--
									Card percentage in top8
									--><div class="col-md-12">
										<!-- START STACKED CHART -->
										<div class="panel panel-default">
											<div class="panel-heading">
												<h3 class="panel-title">Card copies in main decks in top 8</h3>
											</div>
											<div class="panel-body">
												<div id="main_most_used_cards" style="height: 500px;"><svg></svg></div>
											</div>
										</div>
										<!-- END STACKED CHART -->
									</div><!--
									Rune Deck percentage in top8
									--><div class="col-md-12">
										<!-- START STACKED CHART -->
										<div class="panel panel-default">
											<div class="panel-heading">
												<h3 class="panel-title">Card copies in rune decks in top 8</h3>
											</div>
											<div class="panel-body">
												<div id="rune_most_used_cards" style="height: 400px;"><svg></svg></div>
											</div>
										</div>
										<!-- END STACKED CHART -->
									</div><!--
									Side Deck percentage in top8
									--><div class="col-md-12">
										<!-- START STACKED CHART -->
										<div class="panel panel-default">
											<div class="panel-heading">
												<h3 class="panel-title">Card copies in side decks in top 8</h3>
											</div>
											<div class="panel-body">
												<div id="side_most_used_cards" style="height: 400px;"><svg></svg></div>
											</div>
										</div>
										<!-- END STACKED CHART -->
									</div><!--
									Stone Deck percentage in top8
									--><div class="col-md-12">
										<!-- START STACKED CHART -->
										<div class="panel panel-default">
											<div class="panel-heading">
												<h3 class="panel-title">Card copies in stone decks in top 8</h3>
											</div>
											<div class="panel-body">
												<div id="stone_most_used_cards" style="height: 400px;"><svg></svg></div>
											</div>
										</div>
										<!-- END STACKED CHART -->
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

<!-- START THIS PAGE PLUGINS-->        
<script type='text/javascript' src='js/plugins/icheck/icheck.min.js'></script>
<script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
<script type="text/javascript" src="js/plugins/tocify/jquery.tocify.min.js"></script>  
<script type="text/javascript" src="js/plugins/nvd3/lib/d3.v3.js"></script>        
<script type="text/javascript" src="js/plugins/nvd3/nv.d3.min.js"></script>
<script type="text/javascript">

	var startChart = function() {

		// Grafici a torta
		nv.addGraph(function() {
			var chart = nv.models.pieChart().x(function(d) {
				return d.label;
			}).y(function(d) {
				return d.value;
			}).showLabels(true)//Display pie labels
			.labelThreshold(.05)//Configure the minimum slice size for labels to show up
			.labelType("percent")//Configure what type of data to show in the label. Can be "key", "value" or "percent"
			.donut(true)//Turn on Donut mode. Makes pie chart look tasty!
			.donutRatio(0.35);;

			d3.select("#top8_ruler_breakdown svg").datum(top8_ruler_breakdown_data()).transition().duration(350).call(chart);

			return chart;
		});
		
		nv.addGraph(function() {
			var chart = nv.models.pieChart().x(function(d) {
				return d.label;
			}).y(function(d) {
				return d.value;
			}).showLabels(true)//Display pie labels
			.labelThreshold(.05)//Configure the minimum slice size for labels to show up
			.labelType("percent")//Configure what type of data to show in the label. Can be "key", "value" or "percent"
			.donut(true)//Turn on Donut mode. Makes pie chart look tasty!
			.donutRatio(0.35);;

			d3.select("#event_ruler_breakdown svg").datum(event_ruler_breakdown_data()).transition().duration(350).call(chart);

			return chart;
		});

		// Grafici a barre.
		nv.addGraph(function() {
			var chart = nv.models.multiBarHorizontalChart().x(function(d) {
				return d.label;
			}).y(function(d) {
				return d.value;
			}).margin({
				top : 30,
				right : 20,
				bottom : 50,
				left : 275
			}).showValues(true)//Show bar value next to each bar.
			.tooltips(true)//Show tooltips on hover.
			.transitionDuration(350)
							.showControls(true);
			//Allow user to switch between "Grouped" and "Stacked" mode.

			chart.yAxis.tickFormat(d3.format(',.2f'));

			d3.select('#main_most_used_cards svg').datum(main_most_used()).call(chart);

			nv.utils.windowResize(chart.update);

			return chart;
		});

		nv.addGraph(function() {
			var chart = nv.models.multiBarHorizontalChart().x(function(d) {
				return d.label;
			}).y(function(d) {
				return d.value;
			}).margin({
				top : 30,
				right : 20,
				bottom : 50,
				left : 275
			}).showValues(true)//Show bar value next to each bar.
			.tooltips(true)//Show tooltips on hover.
			.transitionDuration(350)
							.showControls(false);
			//Allow user to switch between "Grouped" and "Stacked" mode.

			chart.yAxis.tickFormat(d3.format(',.2f'));

			d3.select('#rune_most_used_cards svg').datum(rune_most_used()).call(chart);

			nv.utils.windowResize(chart.update);

			return chart;
		}); 

		nv.addGraph(function() {
			var chart = nv.models.multiBarHorizontalChart().x(function(d) {
				return d.label;
			}).y(function(d) {
				return d.value;
			}).margin({
				top : 30,
				right : 20,
				bottom : 50,
				left : 275
			}).showValues(true)//Show bar value next to each bar.
			.tooltips(true)//Show tooltips on hover.
			.transitionDuration(350)
							.showControls(true);
			//Allow user to switch between "Grouped" and "Stacked" mode.

			chart.yAxis.tickFormat(d3.format(',.2f'));

			d3.select('#stone_most_used_cards svg').datum(stone_most_used()).call(chart);

			nv.utils.windowResize(chart.update);

			return chart;
		}); 

		nv.addGraph(function() {
			var chart = nv.models.multiBarHorizontalChart().x(function(d) {
				return d.label;
			}).y(function(d) {
				return d.value;
			}).margin({
				top : 30,
				right : 20,
				bottom : 50,
				left : 275
			}).showValues(true)//Show bar value next to each bar.
			.tooltips(true)//Show tooltips on hover.
			.transitionDuration(350)
							.showControls(true);
			//Allow user to switch between "Grouped" and "Stacked" mode.

			chart.yAxis.tickFormat(d3.format(',.2f'));

			d3.select('#side_most_used_cards svg').datum(side_most_used()).call(chart);

			nv.utils.windowResize(chart.update);

			return chart;
		});

		/*
		 * Pie chart top8_ruler_breakdown data. Note how there is only a single array of key-value pairs.
		 */
		function top8_ruler_breakdown_data() {
			return <?php echo $chart_ruler_breakdown_top8; ?>;
		}

		/*
		 * Pie chart event_ruler_breakdown data. Note how there is only a single array of key-value pairs.
		 */
		function event_ruler_breakdown_data() {
			return <?php echo $chart_ruler_breakdown; ?>;
		}

		/*
		 * MultiBarHorizontal chart most_used_cards data. Note how there is only a single array of key-value pairs.
		 */
		function main_most_used() {
			return <?php echo $chart_main_most_used; ?>;
		}

		/*
		 * MultiBarHorizontal chart most_used_cards data. Note how there is only a single array of key-value pairs.
		 */
		function rune_most_used() {
			return <?php echo $chart_rune_most_used; ?>;
		}

		/*
		 * MultiBarHorizontal chart most_used_cards data. Note how there is only a single array of key-value pairs.
		 */
		function side_most_used() {
			return <?php echo $chart_side_most_used; ?>;
		}

		/*
		 * MultiBarHorizontal chart most_used_cards data. Note how there is only a single array of key-value pairs.
		 */
		function stone_most_used() {
			return <?php echo $chart_stone_most_used; ?>;
		}

	};
	
	startChart();
</script>
<!-- END THIS PAGE PLUGINS-->  