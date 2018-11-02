<div class="modal" data-sound="alert" id="add_event_modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
				<h4 class="modal-title" id="defModalHead">Add new event</h4></div>
			<div class="modal-body">
				<form class="form-horizontal" id="new-item" action="adders/add_event.php" method="POST" autocomplete=false role="form"><!--
					Name
					--><div class="form-group">
						<label for="Name" class="col-md-3 control-label">Name</label>
						<div class="col-md-9">
							<input id="Name" name="Name" type="text" class="form-control add-item" placeholder="Name"/>
						</div>
					</div><!--
					Nation
					--><div class="form-group">
						<label for="Nation" class="col-md-3 control-label">Nation</label>
						<div class="col-md-9">
							<select class="form-control add-item" id="Nation" name="Nation" placeholder="Nation">
								<?php
								// Essendo la prima query apro la connessione.
								$conn = new mysqli("localhost", "root", "", "my_fowdeckhub");
								if($conn->connect_error){
									echo "<option value=\"0\">-- Connection Error --</option>";
								} else {
									$query = "SELECT s.Id, s.Name
											FROM nations s";
									$stmt = $conn->prepare($query);
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
					Year
					--><div class="form-group">
						<label for="Year" class="col-md-3 control-label">Year</label>
						<div class="col-md-9">
							<input id="Year" type="number" class="form-control add-item" placeholder="Year"/>
						</div>
					</div><!--
					Attendance
					--><div class="form-group">
						<label for="Attendance" class="col-md-3 control-label">Attendance</label>
						<div class="col-md-9">
							<input id="Attendance" type="number" class="form-control add-item" placeholder="Attendance"/>
						</div>
					</div><!--
					Date
					--><div class="form-group">
						<label for="Date" class="col-md-3 control-label">Date</label>
						<div class="col-md-9">
							<input id="Date" type="date" class="form-control add-item" placeholder="Date"/>
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