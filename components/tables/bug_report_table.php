<table class="table datatable">
    <thead>
        <tr>
			<th width="60">Id</th>
            <th width="150">Name</th>
            <th width="150">Mail</th>
            <th>Bug</th>
			<th width="150">Creation Date</th>
			<th width="150">Last Operation</th>
            <th width="100">State</th>
            <th width="200">Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php
        if(isset($bugs) && $bugs["result"] == true) {
            foreach ($bugs["content"] as $value) {
                echo "<tr id=\"trow_" . $value["Id"] . "\">";
				echo "<td>" . $value["Id"] . "</td>";
				echo "<td>" . $value["Name"] . "</td>";
				echo "<td>" . $value["EMail"] . "</td>";
				echo "<td>" . $value["Bug"] . "</td>";
				echo "<td>" . $value["CreationDate"] . "</td>";
				echo "<td>" . $value["LastOperation"] . "</td>";
                $state = "";
				switch($value["State"]) {
					case 'Resolved':
						$state .= "<span class=\"label lb_red\"><i class='fa fa-check'></i> " . $value["State"] . "</span> ";
						break;
					case 'Assigned':
						$state .= "<span class=\"label lb_orange\"><i class='fa fa-wrench'></i> " . $value["State"] . "</span> ";
						break;
					case 'Open':
						$state .= "<span class=\"label lb_yellow\"><i class='fa fa-question'></i> " . $value["State"] . "</span> ";
						break;
					case 'New':
						$state .= "<span class=\"label lb_green\"><i class='fa fa-phone'></i> " . $value["State"] . "</span> ";
						break;
					default:
						$state .= "<span class=\"label lb_default\" style=\"\">" . $value["State"] . "</span> ";
						break;
				}
				echo "<td class=\"status\">" . $state . "</td>";
                echo "<td>";
				if($value["State"] != "Resolved") {
					echo "<button class=\"btn btn-default btn-rounded btn-sm\" style=\"background-color:red;\" onClick=\"change_state(" . $value["Id"] . ", 4);\"><i class=\"fa fa-check\"></i></button>
						  <button class=\"btn btn-default btn-rounded btn-sm\" style=\"background-color:orange;\" onClick=\"change_state(" . $value["Id"] . ", 3);\"><i class=\"fa fa-wrench\"></i></button>
						  <button class=\"btn btn-default btn-rounded btn-sm\" style=\"background-color:yellow;\"  onClick=\"change_state(" . $value["Id"] . ", 2);\"><i class=\"fa fa-question\"></i></button>";
				} else {
					echo "The bug is resolved.";
				}
				echo "</td>";
                echo "</tr>";
            }
        } else {
            echo $bugs["result"] . "|" . $bugs["error"] . "|" . $bugs["msg"];
        }
    ?>
    </tbody>
</table>