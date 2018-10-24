<div class="input-group">
	<span class="input-group-addon"><span class="fa fa-pencil"></span></span>
	<select class="form-control select" id="format" onchange="format_change(event);">
		<option value="-1">-- Select a format --</option>
		<?php
		// Essendo la prima query apro la connessione.
		$format_conn = new mysqli("localhost", "root", "", "my_fowdeckhub");
		if($format_conn->connect_error){
			echo "<option value=\"0\">-- Connection Error --</option>";
		} else {
			$query = "SELECT Code, Name FROM formats WHERE Tournament = 1 AND Visibility = 1";
			$stmt = $format_conn->prepare($query);
			$stmt->execute();
			$result = $stmt->get_result();
			if($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					echo "<option value=\"" . $row["Code"] . "\">" . $row["Name"] . "</option>";
				}
			} else {
				echo "<option value=\"0\">-- No Result --</option>";
			}
			if(isset($format_conn)) {
				$format_conn->close();
			}
		}
		?>
	</select>
</div>