<div class="panel panel-default">
	<div class="panel-heading">
		<div class="panel-title-box">
			<h3>Events Filling</h3>
			<span>Decklists Loading Activity</span>
		</div>                                    
		<ul class="panel-controls panel-controls-title" style="margin-top: 2px;">
			<li>
				<select id="date_event_filling_widget" class="form-control">
				<?php
					if($mysqli->connect_error){
						echo "<option value=\"0\">-- Lost Connection Error --</option>";
					} else {
						$query ="select distinct Year from events order by Year desc";
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
			<table class="table">
				<thead>
					<tr>
						<th>Event Name</th>
						<th width="100">Nation</th>
						<th width="100">Date</th>
						<th width="150">Progress</th>
					</tr>
				</thead>
				<tbody id="events-filling-table-body">
                <?php
                if(isset($events) && $events["result"] == true) {
                    foreach ($events["content"] as $value) {
                        echo "<tr id=\"trow_" . $value["Id"] . "\">";
                        echo "	<td><a href=\"events.php?event_id=" . $value["Id"] . "\"><strong>" . $value["Name"] . "</strong></a></td>";
                        echo "	<td>" . $value["Nation"] . "</td>";
                        $pieces = explode(" ", $value["Date"]);
                        echo "	<td>" . $pieces[0] . "</td>";
                        $perc = $value["Cont"] / 8 * 100;
                        $classToAdd = "";
                        if($value["Cont"] == 8) {
                            $classToAdd = "success";
                        } else if($value["Cont"] == 0) {
                            $classToAdd = "danger";
                        } else {
                            $classToAdd = "warning";
                        }
                        echo "	<td>";
                        echo "		<div class=\"progress progress-small progress-striped active\">";
                        echo "			<div class=\"progress-bar progress-bar-" . $classToAdd . "\" role=\"progressbar\" aria-valuenow=\"" . $value["Cont"] . "\" aria-valuemin=\"0\" aria-valuemax=\"8\" style=\"width: " . $perc . "%;\">" . $perc . "%</div>";
                        echo "		</div>";
                        echo "	</td>";
                        echo "</tr>";
                    }
                } else {
                    echo $events["msg"];
                }
                ?>
                    
				</tbody>
				<script type="text/javascript">
					function load_events(year) {
						$("#events-filling-table-body").html("");
						var ajax_data = "";
						if(year != null) {
							ajax_data = "year=" + year;
						} else {
							ajax_data = "year=2018";
						}
						$.ajax({
							type: "POST",
							url: "ajax/event_ajax.php?events_widget",
							dataType: "json",
							data: ajax_data,
							success:function(result){
								if(result["result"] === true) {
                                    var riga = "";
									result["content"].forEach(function (item) {
										riga += "<tr id=\"trow_" + item["Id"] + "\">";
										riga += "	<td><a href=\"events.php?event_id=" + item["Id"] + "\"><strong>" + item["Name"] + "</strong></a></td>";
										riga += "	<td>" + item["Nation"] + "</td>";
										var pieces = item["Date"].split(" ");
										riga += "	<td>" + pieces[0] + "</td>";
										var perc = item["Cont"] / 8 * 100;
                                        var classToAdd = "";
                                        if(item["Cont"] == 8) {
                                            classToAdd = "success";
                                        } else if(item["Cont"] == 0) {
                                            classToAdd = "danger";
                                        } else {
                                            classToAdd = "warning";
                                        }
										riga += "	<td>";
										riga += "		<div class=\"progress progress-small progress-striped active\">";
										riga += "			<div class=\"progress-bar progress-bar-" + classToAdd + "\" role=\"progressbar\" aria-valuenow=\"" + item["Cont"] + "\" aria-valuemin=\"0\" aria-valuemax=\"8\" style=\"width: " + perc + "%;\">" + perc + "%/div>";
										riga += "		</div>";
										riga += "	</td>";
										riga += "</tr>";
									});
                                    $("#events-filling-table-body").html(riga);
								} else if(result["result"] === false) {
									console.log("Fallimento");
									$("#events-filling-table-body").append(result["Errore"]);
								}
							},
							error:function(result){
								console.log(result);
								$(result).appendTo($("#events-filling-table-body"));
							}
						});
					}
                    
					$(document).ready(function () {
						$("#date_event_filling_widget").change(function () {
							load_events($("#date_event_filling_widget").val());
						});
					});
				</script>
			</table>
		</div>
	</div>
</div>