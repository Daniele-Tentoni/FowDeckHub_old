<form class="form-horizontal" id="new_item" action="ajax/card_ajax.php?add_card" method="POST" autocomplete=false role="form"><!--
	Id (for future images)
	--><div class="form-group">
		<label for="Id" class="col-md-3 control-label">Id</label>
		<div class="col-md-9">
			<input id="Id" name="Id" type="number" class="form-control add-item" placeholder="Id"/>
		</div>
	</div><!--
	CardName
	--><div class="form-group">
		<label for="CardName" class="col-md-3 control-label">Card Name</label>
		<div class="col-md-9">
			<input id="CardName" name="cardname" type="text" class="form-control add-item" placeholder="Card Name"/>
		</div>
	</div><!--
	Set
	--><div class="form-group">
		<label for="Set" class="col-md-3 control-label">Set</label>
		<div class="col-md-9">
			<select class="form-control add-item" id="Set" name="Set" placeholder="Set">
				<?php
				// Essendo la prima query apro la connessione.
				$conn = new mysqli(HOST, USER, PASSWORD, DATABASE);
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
		<label for="Number" class="col-md-3 control-label">Number</label>
		<div class="col-md-9">
			<input id="Number" name="Number" type="number" class="form-control add-item" placeholder="Number"/>
		</div>
	</div><!--
	Cost
	--><div class="form-group">
		<label for="Cost" class="col-md-3 control-label">Cost</label>
		<div class="col-md-9">
			<input id="Cost" name="Cost" type="text" class="form-control add-item" placeholder="Cost"/>
		</div>
	</div><!--
	Rarity
	--><div class="form-group">
		<label class="col-md-3 control-label">Rarity</label>
		<div class="col-md-9">
			<select id="Rarity" name="Rarity" class="form-control add-item" data-style="btn-success">
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