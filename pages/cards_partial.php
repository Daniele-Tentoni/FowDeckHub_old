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
							<button type="button" class="btn btn-primary btn-rounded pull-right" onClick="new_row();"><i class="fa fa-plus"></i>New</button>
						</div>

						<div class="panel-body panel-body-table">

							<div class="table-responsive">
								<table class="table table-bordered table-striped table-actions">
									<thead>
										<tr>
											<th width="50">Id</th>
											<th>Card Name</th>
											<th width="120">Set</th>
											<th width="80">Number</th>
											<th width="90">Type</th>
											<th width="80">Cost</th>
											<th width="90">Attribute</th>
											<th width="100">Rarity</th>
											<th width="150">Actions</th>
										</tr>
									</thead>
									<tbody id="cards-table-body">                                            
										<tr id="trow_1">
											<td class="text-center">1</td>
											<td><strong>Alleato della Luna Nera / Mikage Sejuro, l'Eterno Vampiro</strong></td>
											<td>Structure Decks Lapis 5</td>
											<td>002</td>
											<td><span class="label label-success">Ruler / J-Ruler</span></td>
											<td>1BB</td>
											<td>Darkness</td>
											<td>Rare</td>
											<td>
												<button class="btn btn-default btn-rounded btn-sm"><span class="fa fa-pencil"></span></button>
												<button class="btn btn-danger btn-rounded btn-sm" onClick="delete_row('trow_1');"><span class="fa fa-times"></span></button>
											</td>
										</tr>
									</tbody>
									<script type="text/javascript">
									$(document).ready(function () {
										var actionText = "<button class=\"btn btn-default btn-rounded btn-sm\"><span class=\"fa fa-pencil\"></span></button> <button class=\"btn btn-danger btn-rounded btn-sm\" onClick=\"delete_row('trow_1');\"><span class=\"fa fa-times\"></span> </button>";
										$.ajax({
											type: "GET",
											url: "loaders/load_cards.php",
											dataType: "json",
											data: "",
											success:function(result){
												if(result["result"] === true) {
													result["content"].forEach(function (item) {
														console.log(item);
														var riga = "<tr>";
														riga += "<td>" + item["Id"] + "</td>";
														riga += "<td>" + item["Name"] + "</td>";
														riga += "<td>" + item["Set"] + "</td>";
														riga += "<td>" + item["Number"] + "</td>";
														riga += "<td>" + item["Type"] + "</td>";
														riga += "<td>" + item["Cost"] + "</td>";
														var classToAdd = "";
														if(item["Attribute"] === "1") {
															classToAdd = "label label-warning";
														} else {
															classToAdd = "label label-success";
														}
														riga += "<td><span class=\"" + classToAdd + "\">" + item["Attribute"] + "</span></td>";
														riga += "<td>" + item["Rarity"] + "</td>";
														riga += "<td>" + actionText + "</td>";
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

<!-- NEW MESSAGE BOX-->
<div class="message-box animated fadeIn" data-sound="alert" id="mb-new-row">
	<div class="mb-container">
		<div class="mb-middle">
			<div class="mb-title"><span class="fa fa-plus"></span> New <strong>Card</strong> ?</div>
			<div class="mb-content">
				<form id="new-item" action="loaders/new_card.php" method="post" autocomplete="false">
					<div class="form-group">
						<div class="col-md-12">
							<input id="CardName" type="text" class="form-control add-item" placeholder="Card Name"/>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-12">
							<input id="Set" type="text" class="form-control add-item" placeholder="Set"/>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-12">
							<input id="Number" type="text" class="form-control add-item" placeholder="Number"/>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-12">
							<input id="Type" type="text" class="form-control add-item" placeholder="Type"/>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-12">
							<input id="Cost" type="text" class="form-control add-item" placeholder="Cost"/>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-12">
							<input id="Attribute" type="text" class="form-control add-item" placeholder="Attribute"/>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-12">
							<input id="Rarity" type="text" class="form-control add-item" placeholder="Rarity"/>
						</div>
					</div>
				</form>
			</div>
			<div class="mb-footer">
				<div class="pull-right">
					<button class="btn btn-success btn-lg mb-control-yes">Add</button>
					<button class="btn btn-default btn-lg mb-control-close">Exit</button>
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