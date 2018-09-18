<!-- START BREADCRUMB -->
<ul class="breadcrumb">
	<li><a href="#">Home</a></li>
	<li><a href="#">Users</a></li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE TITLE -->
<div class="page-title">                    
	<h2><span class="fa fa-arrow-circle-o-left"></span> Users Tables</h2>
</div>
<!-- END PAGE TITLE -->

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">

	<div class="row">
		<div class="col-md-12">
			<!-- START RESPONSIVE TABLES -->
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-default">

						<div class="panel-heading">
							<h3 class="panel-title">Users tables</h3>
							<button type="button" class="btn btn-primary btn-rounded pull-right"><i class="fa fa-plus"></i>New</button>
						</div>

						<div class="panel-body panel-body-table">

							<div class="table-responsive">
								<table class="table table-bordered table-striped table-actions">
									<thead>
										<tr>
											<th width="50">Id</th>
											<th>User Name</th>
											<th>First Name</th>
											<th>Last Name</th>
											<th width="90">Status</th>
											<th width="90">Decklists</th>
											<th width="90">Last Access</th>
											<th width="150">Actions</th>
										</tr>
									</thead>
									<tbody>                                            
										<tr id="trow_1">
											<td class="text-center">1</td>
											<td><strong>AntonioParolisi</strong></td>
											<td>Daniele</td>
											<td>Tentoni</td>
											<td><span class="label label-success">Active</span></td>
											<td>0</td>
											<td>16/09/2018</td>
											<td>
												<button class="btn btn-default btn-rounded btn-sm"><span class="fa fa-pencil"></span></button>
												<button class="btn btn-danger btn-rounded btn-sm" onClick="delete_row('trow_1');"><span class="fa fa-times"></span></button>
											</td>
										</tr>
									</tbody>
								</table>
							</div>                                

						</div>
					</div>                                                

				</div>
			</div>
			<!-- END RESPONSIVE TABLES -->
			<?php echo $error; ?>
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

<!-- START THIS PAGE PLUGINS-->        
<script type='text/javascript' src='js/plugins/icheck/icheck.min.js'></script>
<script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>

<script type="text/javascript" src="js/demo_tables.js"></script>     
<!-- END THIS PAGE PLUGINS-->  