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
						<div class="panel-body panel-body-table" id="users_panel_body">
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
									<tbody id="users_table_body">
									</tbody>
								</table>
							</div>                                

						</div>
					</div>                                                

				</div>
			</div>
			<!-- END RESPONSIVE TABLES -->
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
<script type="text/javascript">
	$.ajax({
		type: "GET",
		url: "loaders/load_users.php",
		dataType: "json",
		data: "",
		success:function(result){
			if(result["result"] === true) {
				result["content"].forEach(function (item) {
					console.log(item);
					var riga = "<tr>";
					riga += "<td>" + item["Id"] + "</td>";
					riga += "<td>" + item["Username"] + "</td>";
					riga += "<td>" + item["FirstName"] + "</td>";
					riga += "<td>" + item["LastName"] + "</td>";
					riga += "<td>" + item["RegisterDate"] + "</td>";
					riga += "<td>" + item["Role"] + "</td>";
					riga += "</tr>";
					$("#users_table_body").append(riga);
				});
			} else if(result["result"] === false) {
				console.log("Fallimento");
				$("#users_panel_body").append(result["Errore"]);
			}
		},
		error:function(result){
			console.log(result);
			$(result).appendTo($("#users_panel_body"));
		}
	});
</script>
<!-- END THIS PAGE PLUGINS-->  