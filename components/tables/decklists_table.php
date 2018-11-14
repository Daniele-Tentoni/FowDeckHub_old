<table class="table datatable_search">
    <thead>
        <tr>
            <th>Decklist Name</th>
            <th>Ruler</th>
            <th width="150">Player</th>
            <th width="100">Type</th>
            <th width="80">Style</th>
			<?php
			if(!isset($event_hide)) {
				echo "<th width=\"120\">Event</th>";
			}
			?>
            <th width="40">Rank</th>
			<?php
			if(!isset($action_hide)) {
				echo "<th width=\"140\">Actions</th>";
			}
			?>
        </tr>
    </thead>
    <tbody>
        <?php
        if(isset($decklists) && $decklists["result"] == true) {
            foreach ($decklists["content"] as $value) {
                echo "<tr id=\"trow_" . $value["Id"] . "\">";
                echo "    <td class=\"text-center\"><a href=\"https://www.gachalog.com/list/" . $value["GachaCode"] . "\" target=\"_blank\">" . $value["Name"] . "</a></td>";
                echo "    <td><strong>" . $value["Ruler"] . "</strong></td>";
                echo "    <td>" . $value["Player"] . "</td>";
                echo "    <td>" . $value["Type"] . "</td>";
                echo "    <td>" . $value["Style"] . "</td>";
				if(!isset($event_hide)) {
                	echo "    <td>" . $value["Event"] . "</td>";
				}
                $classToAdd = "";
                switch($value["Position"]) {
                    case 1:
                        $classToAdd = "success";
                        break;
                    case 2:
                        $classToAdd = "warning";
                        break;
                    case 3:
                        $classToAdd = "primary";
                        break;
                    default:
                        $classToAdd = "danger";
                        break;
                }
                echo "    <td><span class=\"label label-" . $classToAdd . "\">" . $value["Position"] . "</span></td>";
				if(!isset($action_hide)) {
					echo "    <td>";
					echo "        <button class=\"btn btn-default btn-rounded btn-sm\"><span class=\"fa fa-pencil\"></span></button>";
					echo "        <button class=\"btn btn-danger btn-rounded btn-sm\" onClick=\"delete_row('trow_" . $value["Id"] . "');\"><span class=\"fa fa-times\"></span></button>";
					echo "    </td>";
				}
                echo "</tr>";
            }
        } else {
            echo $decklists["msg"];
        }
        ?>
    </tbody>
</table>