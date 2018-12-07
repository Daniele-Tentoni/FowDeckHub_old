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
    
    <!-- START EVENTS BLOCK -->
	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="panel-title-box">
					<h3>Events Filling</h3>
					<span>Decklists Loading Activity</span>
				</div>                                    
				<ul class="panel-controls" style="margin-top: 2px;">
					<li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
					<li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-cog"></span></a>                                        
						<ul class="dropdown-menu">
							<li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span> Collapse</a></li>
							<li><a href="#" class="panel-remove"><span class="fa fa-times"></span> Remove</a></li>
						</ul>                                        
					</li>                                        
				</ul>
			</div>
			<div class="panel-body panel-body-table">

				<div class="table-responsive">
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th width="40%">Event</th>
								<th width="30%">Status</th>
								<th width="30%">Progress</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><strong>GP Venezia</strong></td>
								<td><span class="label label-danger">Developing</span></td>
								<td>
									<div class="progress progress-small progress-striped active">
										<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">0%</div>
									</div>
								</td>
							</tr>
							<tr>
								<td><strong>GP Padova</strong></td>
								<td><span class="label label-danger">Developing</span></td>
								<td>
									<div class="progress progress-small progress-striped active">
										<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">0%</div>
									</div>
								</td>
							</tr>                                                
							<tr>
								<td><strong>GP Roma</strong></td>
								<td><span class="label label-danger">Developing</span></td>
								<td>
									<div class="progress progress-small progress-striped active">
										<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">0%</div>
									</div>
								</td>
							</tr>
							<tr>
								<td><strong>Gp Bologna</strong></td>
								<td><span class="label label-danger">Developing</span></td>
								<td>
									<div class="progress progress-small progress-striped active">
										<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">0%</div>
									</div>
								</td>
							</tr>                                              

						</tbody>
					</table>
				</div>

			</div>
		</div>
	</div>
    <!-- END EVENTS BLOCK -->
	
    <!-- START SETS BLOCK -->
	<div class="col-md-6">
		<?php require_once ROOT_PATH . '/components/widgets/sets_filling_widget.php'; ?>
	</div>
    <!-- END SETS BLOCK -->
    
	<div class="col-md-12">

		<!-- START SALES BLOCK -->
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="panel-title-box">
					<h3>Decklists around the world</h3>
					<span>Show decklists around the world.</span>
				</div>                                     
				<ul class="panel-controls panel-controls-title">
					<li>
						<div id="reportrange" class="dtrange">
							<span></span><b class="caret"></b>
						</div>                                     
					</li>                                
					<li><a href="#" class="panel-fullscreen rounded"><span class="fa fa-expand"></span></a></li>
				</ul>                                    

			</div>
			<div class="panel-body">
				<div class="row stacked">
					<div class="col-md-4">
						<div class="progress-list">
							<div class="pull-left"><strong>In Queue</strong></div>
							<div class="pull-right">75%</div>
							<div class="progress progress-small progress-striped active">
								<div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 75%;">75%</div>
							</div>
						</div>
						<div class="progress-list">
							<div class="pull-left"><strong>Shipped Products</strong></div>
							<div class="pull-right">450/500</div>
							<div class="progress progress-small progress-striped active">
								<div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 90%;">90%</div>
							</div>
						</div>
						<div class="progress-list">
							<div class="pull-left"><strong class="text-danger">Returned Products</strong></div>
							<div class="pull-right">25/500</div>
							<div class="progress progress-small progress-striped active">
								<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 5%;">5%</div>
							</div>
						</div>
						<div class="progress-list">
							<div class="pull-left"><strong class="text-warning">Progress Today</strong></div>
							<div class="pull-right">75/150</div>
							<div class="progress progress-small progress-striped active">
								<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%;">50%</div>
							</div>
						</div>
						<p><span class="fa fa-warning"></span> Data update weekly or monthly. It depends on my freetime ;).</p>
					</div>
					<div class="col-md-8">
						<div id="dashboard-map-seles" style="width: 100%; height: 200px"></div>
					</div>
				</div>                                    
			</div>
		</div>
		<!-- END SALES BLOCK -->

	</div>
</div>

<!-- START THIS PAGE PLUGINS-->        
<script type='text/javascript' src='js/plugins/icheck/icheck.min.js'></script>
<script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
<script type="text/javascript" src="js/plugins/scrolltotop/scrolltopcontrol.js"></script>

<script type="text/javascript" src="js/plugins/morris/raphael-min.js"></script>
<script type="text/javascript" src="js/plugins/morris/morris.min.js"></script>
<script type="text/javascript" src="js/plugins/rickshaw/d3.v3.js"></script>
<script type="text/javascript" src="js/plugins/rickshaw/rickshaw.min.js"></script>
<script type='text/javascript' src='js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'></script>
<script type='text/javascript' src='js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js'></script>
<script type='text/javascript' src='js/plugins/bootstrap/bootstrap-datepicker.js'></script>
<script type="text/javascript" src="js/plugins/owl/owl.carousel.min.js"></script>

<script type="text/javascript" src="js/plugins/moment.min.js"></script>
<script type="text/javascript" src="js/plugins/daterangepicker/daterangepicker.js"></script>
        
<script type="text/javascript" src="js/demo_dashboard.js"></script>
<!-- END THIS PAGE PLUGINS--> "<br />
<b>Fatal error</b>:  require_once(): Failed opening required 'ROOT_PATH/config/functions.php' (include_path='.:') in <b>/membri/fowdeckhub/loaders/load_sets_filling.php</b> on line <b>2</b><br />
"