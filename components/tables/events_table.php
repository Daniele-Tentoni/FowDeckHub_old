<table class="table datatable">
	<thead>
		<tr>
            <?php
			echo !isset($show_name) || $show_name ? "<th>Event Name</th>" : "";
			echo !isset($show_nation) || $show_nation ? "<th width=\"100\">Nation</th>" : "";
			echo !isset($show_date) || $show_date ? "<th width=\"100\">Date</th>" : "";
			echo !isset($show_year) || $show_year ? "<th width=\"80\">Year</th>" : "";
            echo !isset($show_attendance) || $show_attendance ? "<th width=\"80\">Attendance</th>" : "";
            echo !isset($show_visibility) || $show_visibility ? "<th width=\"80\">Visibility</th>" : "";
			echo !isset($show_actions) || $show_actions ? "<th width=\"150\">Actions</th>" : "";
            ?>
		</tr>
	</thead>
	<tbody> 
		<?php
        if(isset($events) && $events["result"] == true) {
            foreach ($events["content"] as $value) {
                echo "<tr id=\"trow_" . $value["Id"] . "\">";
				echo "	<td><a href=\"events.php?event_id=" . $value["Id"] . "\"><strong>" . $value["Name"] . "</strong></a></td>";
				echo "	<td>" . $value["Nation"] . "</td>";
				$pieces = explode(" ", $value["Date"]);
				echo "	<td>" . $pieces[0] . "</td>";
				echo "	<td><span class=\"label label-success\">" . $value["Year"] . "</span></td>";
				echo "	<td>" . $value["Attendance"] . "</td>";
				echo !isset($show_visibility) || $show_visibility ? "	<td>" . $value["Visibility"] . "</td>" : "";
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