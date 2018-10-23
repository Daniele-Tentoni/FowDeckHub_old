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
							<button type="button" class="btn btn-primary btn-rounded pull-right" data-toggle="modal" data-target="#modal_new_card"><i class="fa fa-plus"></i>New</button>
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
														riga += "<td>" + item["Name"] + "</td>";
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

<!-- NEW MESSAGE BOX-->
<div class="modal" data-sound="alert" id="modal_new_card">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
				<h4 class="modal-title" id="defModalHead">Add new card</h4></div>
			<div class="modal-body">
				<form class="form-horizontal" id="new-item" action="adders/add_card.php" method="POST" autocomplete=false role="form"><!--
					Id (for future images)
					--><div class="form-group">
						<label for="CardName" class="col-md-12 control-label">Id</label>
						<div class="col-md-12">
							<input id="Id" name="Id" type="number" class="form-control add-item" placeholder="Id"/>
						</div>
					</div><!--
					CardName
					--><div class="form-group">
						<label for="CardName" class="col-md-12 control-label">Card Name</label>
						<div class="col-md-12">
							<input id="CardName" name="cardname" type="text" class="form-control add-item" placeholder="Card Name"/>
						</div>
					</div><!--
					Set
					--><div class="form-group">
						<label for="Set" class="col-md-12 control-label">Set</label>
						<div class="col-md-12">
							<select class="form-control add-item" id="Set" name="Set" placeholder="Set">
								<?php
								// Essendo la prima query apro la connessione.
								$conn = new mysqli("localhost", "root", "", "my_fowdeckhub");
								if($conn->connect_error){
									echo "<option value=\"0\">-- Connection Error --</option>";
								} else {
									$query = "SELECT s.Code, s.Name
											FROM card_sets s";
									$stmt = $conn->prepare($query);
									$stmt->execute();
									$result = $stmt->get_result();
									if($result->num_rows > 0) {
										while($row = $result->fetch_assoc()) {
											echo "<option value=\"" . $row["Code"] . "\">" . $row["Name"] . "</option>";
										}
									} else {
										echo "<option value=\"0\">-- No Result --</option>";
									}
								}
								?>
							</select>
						</div>
					</div><!--
					Number
					--><div class="form-group">
						<div class="col-md-12">
							<input id="Number" type="number" class="form-control add-item" placeholder="Number"/>
						</div>
					</div><!--
					Cost
					--><div class="form-group">
						<label for="Cost" class="col-md-12 control-label">Cost</label>
						<div class="col-md-12">
							<input id="Cost" type="text" class="form-control add-item" placeholder="Cost"/>
						</div>
					</div><!--
					Rarity
					--><div class="form-group">
						<label class="col-md-12 control-label">Rarity</label>
						<div class="col-md-12">
							<select id="Rarity" class="form-control add-item" data-style="btn-success">
								<?php
								if($conn->connect_error){
									echo "<option value=\"0\">-- Connection Error --</option>";
								} else {
									$query ="SELECT r.Id, r.Name, r.Symbol
												FROM rarity r";
									$stmt = $conn->prepare($query);
									$stmt->execute();
									$result = $stmt->get_result();
									if($result->num_rows > 0) {
										while($row = $result->fetch_assoc()) {
											echo "<option value=\"" . $row["Id"] . "\">" . $row["Symbol"] . " - " . $row["Name"] . "</option>";
										}
									} else {
										echo "<option value=\"0\">-- No Result --</option>";
									}
								}
								// Essendo l'ultima query chiudo questa connessione.
								if(isset($conn)){
									$conn->close();
								}
								?>
							</select>
						</div>
					</div>
				</form>
			</div>
			<div class="e-panel panel" style="display:none">
				<div class="e-body panel-body">
				</div>
			</div>
			<div class="modal-footer">
				<div class="pull-right">
					<button class="btn btn-success btn-lg" onclick="new_row('true')">Add</button>
					<button class="btn btn-default btn-lg" data-dismiss="modal">Exit</button>
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
<script type="text/javascript" src="js/plugins/bootstrap/bootstrap-select.js"></script>
<!-- END THIS PAGE PLUGINS-->  