<!-- START BREADCRUMB -->
<ul class="breadcrumb">
	<li><a href="index.php">Home</a></li>
	<li><a href="events.php">Events</a></li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE TITLE -->
<div class="page-title">                    
	<h2><a href="events.php" class="link"><span class="fa fa-arrow-circle-o-left"></span></a> Add New Event</h2>
</div>
<!-- END PAGE TITLE -->

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">
	<div class="row">
		<div class="col-md-12">
			<form class="form-horizontal" action="adders/add_event.php" method="post" id="new-event">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="row">
						<p style="margin-top:20px">Add a new event. But, pay Attenction! This is the core of the site, so it's ever under maintance, all contents can change without any advice during the Alpha tests.</p>
						<p style="margin-top:20px">Note that September, October, November and Dicember of an year after the WGP are under the new season beginning, so select the next year when you put him.</p>
							<div class="col-md-1"></div>
							<div class="col-md-5"><!--
								Name
								--><div class="form-group">
									<label for="Name" class="col-md-3 control-label">Name</label>
									<div class="col-md-9">
										<input id="Name" name="Name" type="text" class="form-control add-item" placeholder="Name"/>
									</div>
								</div><!--
								Year
								--><div class="form-group">
									<label for="Year" class="col-md-3 control-label">Year</label>
									<div class="col-md-9">
										<input id="Year" type="number" class="form-control add-item" placeholder="Year"/>
									</div>
								</div><!--
								Date
								--><div class="form-group">
									<label for="Date" class="col-md-3 control-label">Date</label>
									<div class="col-md-9">
										<div class="input-group">
											<input id="Date" class="form-control datepicker add-item" data-date-format="dd-mm-yyyy" data-date-viewmode="years" type="text" placeholder="Date"/>
											<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-5"><!--
								Nation
								--><div class="form-group">
									<label for="Nation" class="col-md-3 control-label">Nation</label>
									<div class="col-md-9">
										<select class="form-control add-item" id="Nation" name="Nation" placeholder="Nation">
											<?php
											// Essendo la prima query apro la connessione.
											if($mysqli->connect_error){
												echo "<option value=\"0\">-- Connection Error --</option>";
											} else {
												$query = "SELECT s.Id, s.Name
														FROM nations s
														ORDER BY s.Name";
												$stmt = $mysqli->prepare($query);
												$stmt->execute();
												$result = $stmt->get_result();
												if($result->num_rows > 0) {
													while($row = $result->fetch_assoc()) {
														echo "<option value=\"" . $row["Id"] . "\">" . $row["Name"] . "</option>";
													}
												} else {
													echo "<option value=\"0\">-- No Result --</option>";
												}
											}
											?>
										</select>
									</div>
								</div><!--
								Attendance
								--><div class="form-group">
									<label for="Attendance" class="col-md-3 control-label">Attendance</label>
									<div class="col-md-9">
										<input id="Attendance" type="number" class="form-control add-item" placeholder="Attendance"/>
									</div>
								</div>
							</div>
							<div class="col-md-1"></div>
						</div>
						<div class="row">
							<p style="margin-top:20px">Here you can insert rulers breakdowns.</p>
							<div class="col-md-1"></div>
							<div class="col-md-10"><!--
								Breakdown
								--><div class="form-group">
									<label class="col-md-2 control-label">Rulers Breakdown</label>
									<div class="col-md-10">
										<table class="table datatable_search">
											<thead>
												<tr>
													<th width="150">Id</th>
													<th>Name</th>
													<th width="200">Quantity</th>
												</tr>
											</thead>
											<tbody id="cards-table-body">
											<?php
												if($mysqli->connect_error){
													echo "-- Connection Error --";
												} else {
													$query = 'select c.Id, c.Name
																from cards c
																join card_types ct on c.Id = ct.Card
																join types t on ct.Type = t.Id
																where t.Name = "Ruler / J-Ruler"';
													$stmt = $mysqli->prepare($query);
													$stmt->execute();
													$result = $stmt->get_result();
													if($result->num_rows > 0) {
														while($row = $result->fetch_assoc()) {
															echo "<tr id=\"trow_" . $row["Id"] . "\">";
															echo "<td>" . $row["Id"] . "</td>";
															echo "<td>" . $row["Name"] . "</td>";
															echo "<td><input id=\"" . $row["Id"] . "\" name=\"" . $row["Id"] . "\" type=\"text\" class=\"form-control breakdown\" placeholder=\"Quantity\"/></td>";
															echo "</tr>";
														}
													} else {
														echo "-- No Result --";
													}
												}
											?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<div class="col-md-1"></div>
						</div>
						<div class="row">
							<p style="margin-top:20px">Write here about many sections of the event page!</p>
							<div class="col-md-1"></div>
							<div class="col-md-10"><!--
								CommunityReports
								--><div class="form-group">
									<label for="CommunityReports" class="col-md-2 control-label">Community Reports</label>
									<div class="col-md-10">
										<textarea id="CommunityReports" name="CommunityReports" class="form-control add-item" >There is no community reports. Contact the admin if you have one!</textarea>
									</div>
								</div><!--
								OtherLinks
								--><div class="form-group">
									<label for="OtherLinks" class="col-md-2 control-label">Other Links</label>
									<div class="col-md-10">
										<textarea id="OtherLinks" name="OtherLinks" class="form-control add-item" >There is no other links. Contact the admin if you have one!</textarea>
									</div>
								</div>
							</div>
							<div class="col-md-1"></div>
						</div>
					</div>
					<div class="panel-footer">
						<!-- Pannello degli errori non visibile -->
						<div class="e-panel panel" style="display:none">
							<div class="e-body panel-body">
							</div>
						</div>
						<input type="reset" class="btn btn-default" />
						<button class="btn btn-primary pull-right" onclick="new_row('true')">Create </button>
					</div>
				</div>
			</form>
		</div>
		<!-- END PAGE CONTENT WRAPPER -->
	</div>
	<!-- END PAGE CONTENT -->
</div>
<!-- END PAGE CONTAINER -->

<!-- START THIS PAGE PLUGINS-->
<script type='text/javascript' src='js/plugins/icheck/icheck.min.js'></script>
<script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
<script type="text/javascript" src="js/plugins/bootstrap/bootstrap-datepicker.js"></script>                
<script type="text/javascript" src="js/plugins/bootstrap/bootstrap-file-input.js"></script>
<script type="text/javascript" src="js/plugins/bootstrap/bootstrap-select.js"></script>
<script type="text/javascript" src="js/plugins/tagsinput/jquery.tagsinput.min.js"></script>
<script type="text/javascript" src="js/plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src='js/demo_tables.js'></script>
<script type="text/javascript">
    $("#new-event").submit(function(e){
        e.preventDefault();
		// Recupero i valori dal form.
		$(".e-panel").hide();
		$(".e-body").html("");
		var entities = [];
		var values = [];
		$(".add-item").each(function(e) {
			var val = $(this).val();
			values.push(val);
			entities.push($(this).attr('id'));
		});
		
		var breakdown = [];
		$(".breakdown").each(function(e) {
			var val = $(this).val();
			breakdown.push(val);
		});
		values.push(breakdown);
		entities.push('Breakdown');

		var form = $("#new-event");
		var action = form.attr("action");
		var method = form.attr("method");

		var string_data = "";
		for(var i = 0; i < entities.length; i++) {
			string_data += "&" + entities[i] + "=" + values[i];
		}
		
		$.ajax({
			type: method,
			url: action,
			dataType: "json",
			data: string_data,
			success:function(msg) {
				$(".e-panel").show();
				if(msg["result"] === true) {
					$(".e-body").html("<span class=\"alert alert-success\">" + msg["content"] + "</span>");
				} else {
					$(".e-body").html("<span class=\"alert alert-danger\">" + msg["content"] + "</span>");
					console.log(msg["data"]);
				}
			},
			error:function(msg) {
				console.log(msg);
				console.log("error");
				$(".e-panel").show();
				$(".e-body").html("<span class=\"alert alert-danger\">" + msg["content"] + "</span>");
			}
		});
    });
</script>