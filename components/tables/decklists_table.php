<table class="table datatable">
    <thead>
        <tr>
			<?php
			echo !isset($show_name) || $show_name ? "<th>Decklist Name</th>" : "";
			echo !isset($show_ruler) || $show_ruler ? "<th width=\"150\">Ruler</th>" : "";
			echo !isset($show_player) || $show_player ? "<th width=\"150\">Player</th>" : "";
			echo !isset($show_type) || $show_type ? "<th width=\"100\">Type</th>" : "";
            echo !isset($show_style) || $show_style ? "<th width=\"80\">Style</th>" : "";
            echo !isset($show_position) || $show_position ? "<th width=\"80\">Position</th>" : "";
            echo !isset($show_event) || $show_event ? "<th width=\"120\">Event</th>" : "";
			echo !isset($show_actions) || $show_actions ? "<th width=\"140\">Actions</th>" : "";
			?>
        </tr>
    </thead>
    <tbody>
        <?php
        if(isset($decklists) && $decklists["result"] == true) {
            foreach ($decklists["content"] as $value) {
                echo "<tr id=\"trow_" . $value["Id"] . "\">";
                echo !isset($show_name) || $show_name ? "    <td class=\"text-center\"><a href=\"https://www.gachalog.com/list/" . $value["GachaCode"] . "\" target=\"_blank\">" . $value["Name"] . "</a></td>" : "";
                echo !isset($show_ruler) || $show_ruler ? "    <td><strong>" . $value["Ruler"] . "</strong></td>" : "";
                echo !isset($show_player) || $show_player ? "    <td>" . $value["Player"] . "</td>" : "";
                echo !isset($show_type) || $show_type ? "    <td>" . $value["Type"] . "</td>" : "";
                echo !isset($show_style) || $show_style ? "    <td>" . $value["Style"] . "</td>" : "";
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
                echo !isset($show_position) || $show_position ? "    <td><span class=\"label label-" . $classToAdd . "\">" . $value["Position"] . "</span></td>" : "";
                echo !isset($show_event) || $show_event ? "    <td>" . $value["Event"] . "</td>" : "";
                echo !isset($show_actions) || $show_actions ? "    <td>" : "";
                echo !isset($show_actions) || $show_actions ? "        <button class=\"btn btn-default btn-rounded btn-sm\"><span class=\"fa fa-pencil\"></span></button>" : "";
                echo !isset($show_actions) || $show_actions ? "        <button class=\"btn btn-danger btn-rounded btn-sm\" onClick=\"delete_row('trow_" . $value["Id"] . "');\"><span class=\"fa fa-times\"></span></button>" : "";
                echo !isset($show_actions) || $show_actions ? "    </td>" : "";
                echo "</tr>";
            }
        } else {
            echo $decklists["msg"];
        }
        ?>
    </tbody>
</table>