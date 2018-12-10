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
				echo "<td class=\"status\"><span class=\"label " . $value["Color"] . "\"><i class='fa fa-" . $value["Icon"] . "'></i>" . $value["State"] . "</span></td>";
                echo "<td>";
                if($value["State"] != "Resolved") {
                    foreach($states["content"] as $state) {
						echo "<button ";
						echo "id=\"state_" . $value["Id"] . "_" . $state["Id"] . "\" ";
						echo "class=\"btn btn-default btn-rounded btn-sm state " . $state["Color"] . "\" ";
						echo "onClick=\"change_state(" . $value["Id"] . ", " . $state["Id"] . ");\" ";
						if($value["State"] == $state["Name"]) {
							echo "style=\"display:none;\" ";
						}
						echo ">";
						echo 	"<i class=\"fa fa-" . $state["Icon"] . "\"></i>";
						echo "</button>";
                    }
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