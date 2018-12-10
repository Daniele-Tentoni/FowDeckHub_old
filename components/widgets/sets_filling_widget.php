<div class="panel panel-default">
	<div class="panel-heading">
		<div class="panel-title-box">
			<h3>Sets Filling</h3>
			<span>Sets Loading Activity</span>
		</div>
		<ul class="panel-controls panel-controls-title">
			<li>
				<select id="Date" class="form-control">
				<?php
					if($mysqli->connect_error){
						echo "<option value=\"0\">-- Lost Connection Error --</option>";
					} else {
						$query ="select distinct Year from card_sets order by Year desc";
						$stmt = $mysqli->prepare($query);
						$stmt->execute();
						$result = $stmt->get_result();
						if($result->num_rows > 0) {
							while($row = $result->fetch_assoc()) {
								$year = $row["Year"];
								echo "<option value=\"$year\">$year</option>";
							}
						} else {
							echo "<option value=\"0\">-- No Result --</option>";
						}
					}
				?>
				</select>
			</li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-cog"></span></a>
				<ul class="dropdown-menu">
					<li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span>Expand</a></li>
					<li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span>Refresh</a></li>
					<li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span> Collapse</a></li>
					<li><a href="#" class="panel-remove"><span class="fa fa-times"></span> Remove</a></li>
				</ul>                                        
			</li>                                        
		</ul>
	</div>
	
	<div class="panel-body panel-body-table">
		<div class="table-responsive">
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th width="30%">Set</th>
						<th width="20%">Status</th>
						<th width="20%">Numbers</th>
						<th width="30%">Progress</th>
					</tr>
				</thead>
				<tbody id="sets-filling-table-body">
				</tbody>
				<script type="text/javascript">
					function load_sets(year) {
						$("#sets-filling-table-body").html("");
						var ajax_data = "";
						if(year != null) {
							ajax_data = "year="+year;
						}
						$.ajax({
							type: "GET",
							url: "loaders/load_sets_filling.php",
							dataType: "json",
							data: ajax_data,
							success:function(result){
								if(result["result"] === true) {
									result["content"].forEach(function (item) {
										var riga = "<tr id=\"" + item['code'] + "\">";
										riga += "<td><strong>" + item["code"] + "</strong></td>";
										riga += "<td><span class=\"label label-" + item["class"] + "\">" + item["text"] + "</span></td>";
										riga += "<td>" + item["db_cards"] + "/" + item["num_cards"] + " (" + item["perc"] + "%)</td>";
										riga += "<td><div class=\"progress progress-small progress-striped active\"><div class=\"progress-bar progress-bar-" + item["class"] + "\" role=\"progressbar\" aria-valuenow=\"" + item["perc"] + "\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: " + item["perc"] + "%;\">" + item["perc"] + "%</div></div></td>";
										riga += "</tr>";
										$("#sets-filling-table-body").append(riga);
									});
								} else if(result["result"] === false) {
									console.log("Fallimento");
									$("#sets-filling-table-body").append(result["Errore"]);
								}
							},
							error:function(result){
								console.log(result);
								$(result).appendTo($("#sets-filling-table-body"));
							}
						});
					}
					
					$(document).ready(function () {
						$("#Date").change(function () {
							load_sets($("#Date").val());
						});
						load_sets(2018);
					});
				</script>
			</table>
		</div>
	</div>
</div>