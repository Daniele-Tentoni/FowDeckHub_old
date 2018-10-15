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
											<th>Card Name</th>
											<th width="120">Number</th>
											<th width="90">Type</th>
											<th width="80">Cost</th>
											<th width="90">Attribute</th>
											<th width="150">Actions</th>
										</tr>
									</thead>
									<tbody id="cards-table-body">                                            
										<tr id="trow_0">
											<td><strong>Carta di prova</strong></td>
											<td>ASAP-002 R</td>
											<td><span class="label label-success">Ruler / J-Ruler</span></td>
											<td>1BB</td>
											<td>Darkness</td>
											<td>
												<button class="btn btn-default btn-rounded btn-sm"><span class="fa fa-pencil"></span></button>
												<button class="btn btn-danger btn-rounded btn-sm" onClick="delete_row('trow_0');"><span class="fa fa-times"></span></button>
											</td>
										</tr>
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
<div class="message-box animated fadeIn" data-sound="alert" id="mb-new-row">
	<div class="mb-container">
		<div class="mb-middle">
			<div class="mb-title"><span class="fa fa-plus"></span> New <strong>Card</strong> ?</div>
			<div class="mb-content">
				<form id="new-item" action="adders/add_card.php" method="post" autocomplete="false">
					<div class="form-group">
						<div class="col-md-12">
							<input id="CardName" type="text" class="form-control add-item" placeholder="Card Name"/>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-12">
							<select class="form-control add-item" id="Set" name="Set" placeholder="Set">
								<option value="0" selected>-- Set --</option>
							</select>
						</div>
					</div>
					
					<script type="text/javascript">
						$(document).ready(function (){
							$.ajax({
								/*
								 * Carico i set disponibili nel sito.
								 */
								type: "GET",
								url: "loaders/load_sets.php",
								dataType: "json",
								data: "",
								success:function(result){
									if(result["result"] === true) {
										result["content"].forEach(function (item) {
											var riga = "<option value=\"" + item["Code"] + "\">" + item["Code"] + " - " + item["Name"] + "</option>";
											$(riga).appendTo($("#Set"));
										});
									} else if(result["result"] === false) {
										console.log("Fallimento");
									}
								},
								error:function(result){
									console.log("Errore set.");
									console.log(result);
								}
							});
						});
					</script>
					<div class="form-group">
						<div class="col-md-12">
							<input id="Number" type="text" class="form-control add-item" placeholder="Number"/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-12 control-label">Type</label>
						<div class="col-md-9">
							<select multiple id="Type" class="form-control select add-item" data-style="btn-success">
								<option value="0">-- Type --</option>
							</select>
						</div>
					</div>  
					
					<script type="text/javascript">
						$(document).ready(function (){
							$.ajax({
								/*
								 * Carico i tipi disponibili nel sito.
								 */
								type: "GET",
								url: "loaders/load_types.php",
								dataType: "json",
								data: "",
								success:function(result){
									if(result["result"] === true) {
										result["content"].forEach(function (item) {
											var riga = "<option value=\"" + item["Id"] + "\">" + item["Name"] + "</option>";
											$(riga).appendTo($("#Type"));
										});
									} else if(result["result"] === false) {
										console.log("Fallimento");
									}
								},
								error:function(result){
									console.log("Errore tipi.");
									console.log(result);
								}
							});
						});
					</script>
					<div class="form-group">
						<div class="col-md-12">
							<input id="Cost" type="text" class="form-control add-item" placeholder="Cost"/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-12 control-label">Attribute</label>
						<div class="col-md-9">
							<select multiple id="Attribute" class="form-control select add-item" data-style="btn-success">
								<option value="0">-- Attribute --</option>
							</select>
						</div>
					</div> 
					
					<script type="text/javascript">
						$(document).ready(function (){
							$.ajax({
								/*
								 * Carico gli attributi disponibili nel sito.
								 */
								type: "GET",
								url: "loaders/load_attributes.php",
								dataType: "json",
								data: "",
								success:function(result){
									if(result["result"] === true) {
										result["content"].forEach(function (item) {
											var riga = "<option value=\"" + item["Id"] + "\">" + item["Name"] + "</option>";
											$(riga).appendTo($("#Attribute"));
										});
									} else if(result["result"] === false) {
										console.log("Fallimento");
									}
								},
								error:function(result){
									console.log("Errore attributi.");
									console.log(result);
								}
							});
						});
					</script>
					<div class="form-group">
						<label class="col-md-12 control-label">Rarity</label>
						<div class="col-md-9">
							<select multiple id="Rarity" class="form-control select add-item" data-style="btn-success">
								<option value="0">-- Rarity --</option>
							</select>
						</div>
					</div>
					
					<script type="text/javascript">
						$(document).ready(function (){
							$.ajax({
								/*
								 * Carico i tipi disponibili nel sito.
								 */
								type: "GET",
								url: "loaders/load_rarity.php",
								dataType: "json",
								data: "",
								success:function(result){
									if(result["result"] === true) {
										result["content"].forEach(function (item) {
											var riga = "<option value=\"" + item["Id"] + "\">" + item["Name"] + "</option>";
											$(riga).appendTo($("#Rarity"));
										});
									} else if(result["result"] === false) {
										console.log("Fallimento");
									}
								},
								error:function(result){
									console.log("Errore rarità.");
									console.log(result);
								}
							});
						});
					</script>
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
<script type="text/javascript" src="js/plugins/bootstrap/bootstrap-select.js"></script>
<!-- END THIS PAGE PLUGINS-->  