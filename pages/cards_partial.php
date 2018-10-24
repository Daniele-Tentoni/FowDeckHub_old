<!-- START BREADCRUMB -->
<ul class="breadcrumb">
	<li><a href="#">Home</a></li>
	<li><a href="#">Cards</a></li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE TITLE -->
<div class="page-title">                    
	<h2><span class="fa fa-arrow-circle-o-left"></span> Card List</h2>
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
							<h3 class="panel-title">Cards</h3>
							<button type="button" class="btn btn-primary btn-rounded pull-right" data-toggle="modal" data-target="#add_card_modal"><i class="fa fa-plus"></i>New</button>
						</div>

						<div class="panel-body panel-body-table">

							<div class="table-responsive">
								<table class="table table-bordered table-striped table-actions">
									<thead>
										<tr>
											<th>Card Name</th>
											<th width="120">Code</th>
											<th width="90">Type</th>
											<th width="80">Cost</th>
											<th width="90">Attributes</th>
											<th width="150">Actions</th>
										</tr>
									</thead>
									<tbody id="cards-table-body">
									</tbody>
									<script type="text/javascript">
									$(document).ready(function () {
										$.ajax({
											type: "GET",
											url: "loaders/load_cards.php",
											dataType: "json",
											data: "",
											success:function(result){
												if(result["result"] === true) {
													result["content"].forEach(function (item) {
														var riga = "<tr id=\"trow_" + item["Id"] + "\">";
														riga += "<td><span onclick=\"modal_filler(" + item["Id"] + ")\" data-toggle=\"modal\" data-target=\"#single_card_modal\" ><i class=\"fa fa-search\"></i>New</span> " + item["Name"] + "</td>";
														riga += "<td>" + item["Set"] + "-" + item["Number"] + " " + item["Rarity"] + "</td>";
														riga += "<td><span class=\"label label-warning\">" + item["Type"] + "</td>";
														riga += "<td>" + item["Cost"] + "</td>";
														riga += "<td><span class=\"label label-success\">" + item["Attribute"] + "</span></td>";
														riga += "<td><button class=\"btn btn-default btn-rounded btn-sm\"><span class=\"fa fa-pencil\"></span></button> <button class=\"btn btn-danger btn-rounded btn-sm\" onClick=\"delete_row('trow_" + item["Id"] + "');\"><span class=\"fa fa-times\"></span> </button></td>";
														riga += "</tr>";
														$("#cards-table-body").append(riga);
													});
												} else if(result["result"] === false) {
													console.log("Fallimento");
													$("#cards-table-body").append(result["Errore"]);
												}
											},
											error:function(result){
												console.log(result);
												$(result).appendTo($("#cards-table-body"));
											}
										});
									});
									</script>
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

<!-- REMOVE MESSAGE BOX-->
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

<!-- START ADD CARD MODAL -->
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/modals/add_card_modal.php'; ?>
<!-- END ADD CARD MODAL -->

<!-- START SINGLE CARD MODAL -->
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/modals/single_card_modal.php'; ?>
<!-- END SINGLE CARD MODAL -->

<!-- START THIS PAGE PLUGINS-->        
<script type='text/javascript' src='js/plugins/icheck/icheck.min.js'></script>
<script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>

<script type="text/javascript" src="js/demo_tables.js"></script>
<script type="text/javascript" src="js/plugins/bootstrap/bootstrap-select.js"></script>
<!-- END THIS PAGE PLUGINS-->  