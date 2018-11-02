<table class="table datatable_simple">
	<thead>
		<tr>
			<th>Event Name</th>
			<th width="100">Nation</th>
			<th width="100">Date</th>
			<th width="80">Year</th>
			<th width="80">Attendance</th>
			<th width="150">Actions</th>
		</tr>
	</thead>
	<tbody> 
		<?php
        require_once $_SERVER['DOCUMENT_ROOT'] . '/loaders/load_events.php';
		$year = date("Y");
		if(isset($_GET) && isset($_GET["year"]) && $_GET["year"] < $year) {
			$year = $_GET["year"];
		}
        $events = getEvents($year, 0);
        if(isset($events) && $events["result"] == true) {
            foreach ($events["content"] as $value) {
                echo "<tr id=\"trow_" . $value["Id"] . "\">";
				echo "	<td><strong>" . $value["Name"] . "</strong></td>";
				echo "	<td>" . $value["Nation"] . "</td>";
				$pieces = explode(" ", $value["Date"]);
				echo "	<td>" . $pieces[0] . "</td>";
				echo "	<td><span class=\"label label-success\">" . $value["Year"] . "</span></td>";
				echo "	<td>" . $value["Attendance"] . "</td>";
				echo "	<td>";
				echo "		<button class=\"btn btn-default btn-rounded btn-sm\"><span class=\"fa fa-pencil\"></span></button>";
				echo "		<button class=\"btn btn-danger btn-rounded btn-sm\" onClick=\"delete_row('trow_" . $value["Id"] . "');\"><span class=\"fa fa-times\"></span></button>";
				echo "	</td>";
				echo "</tr>";
            }
        } else {
            echo $events["msg"];
        }
        ?>
	</tbody>
</table>