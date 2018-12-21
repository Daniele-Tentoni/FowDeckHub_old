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
				echo !isset($show_name) || $show_name ? "	<td><a href=\"events.php?event_id=" . $value["Id"] . "\"><strong>" . $value["Name"] . "</strong></a></td>" : "";
				echo !isset($show_nation) || $show_nation ? "	<td>" . $value["Nation"] . "</td>" : "";
				$pieces = explode(" ", $value["Date"]);
				echo !isset($show_date) || $show_date ? "	<td>" . $pieces[0] . "</td>" : "";
				echo !isset($show_year) || $show_year ? "	<td><span class=\"label label-success\">" . $value["Year"] . "</span></td>" : "";
				echo !isset($show_attendance) || $show_attendance ? "	<td>" . $value["Attendance"] . "</td>" : "";
				echo !isset($show_visibility) || $show_visibility ? "	<td>" . $value["Visibility"] . "</td>" : "";
				echo !isset($show_actions) || $show_actions ? "	<td>" : "";
				echo !isset($show_actions) || $show_actions ? "		<a href=\"events.php?event_edit=" . $value["Id"] . "\" class=\"btn btn-default btn-rounded btn-sm\"><span class=\"fa fa-pencil\"></span></button>" : "";
				echo !isset($show_actions) || $show_actions ? "	</td>" : "";
				echo "</tr>";
            }
        } else {
            echo $events["msg"];
        }
        ?>
	</tbody>
</table>