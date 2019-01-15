<table class="table <?php echo !isset($simple_table) || $simple_table ? "datatable" : "datatable_simple"; ?>">
    <thead>
        <tr>
			<?php
			echo !isset($show_name) || $show_name ? "<th>Decklist Name</th>" : "";
			echo !isset($show_ruler) || $show_ruler ? "<th width=\"125\">Ruler</th>" : "";
			echo !isset($show_player) || $show_player ? "<th width=\"145\">Player</th>" : "";
			echo !isset($show_type) || $show_type ? "<th width=\"130\">Type</th>" : "";
            echo !isset($show_style) || $show_style ? "<th width=\"70\">Style</th>" : "";
            echo !isset($show_event) || $show_event ? "<th width=\"230\">Event</th>" : "";
            echo !isset($show_position) || $show_position ? "<th width=\"70\">Position</th>" : "";
            echo !isset($show_visibility) || $show_visibility ? "<th width=\"70\">Vis.</th>" : "";
            echo !isset($show_deck_up) || $show_deck_up ? "<th width=\"70\">Deck</th>" : "";
			echo !isset($show_actions) || $show_actions ? "<th width=\"115\">Actions</th>" : "";
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
                echo !isset($show_event) || $show_event ? "    <td>" . $value["Event"] . "</td>" : "";
                $classToAdd = "";
                switch($value["Position"]) {
                    case 1:
                        $classToAdd = "danger";
                        break;
                    case 2:
                        $classToAdd = "warning";
                        break;
                    case 3:
                        $classToAdd = "success";
                        break;
                    default:
                        $classToAdd = "info";
                        break;
                }
                echo !isset($show_position) || $show_position ? "    <td><span class=\"label label-" . $classToAdd . "\">" . $value["Position"] . "</span></td>" : "";
                echo !isset($show_visibility) || $show_visibility ? "    <td>" . $value["Visibility"] . "</td>" : "";
                if(!isset($show_deck_up) || $show_deck_up) {
                    echo "<td>";
                    if($value["DeckUp"] == 1) {
                        echo "<span class=\"label label-success\" ><i class=\"fa fa-arrow-up\" aria-hidden=\"true\"></i> Up</span>";
                    } else if($value["DeckUp"] == 0) {
                        echo "<span class=\"label label-danger\" ><i class=\"fa fa-times\" aria-hidden=\"true\"></i> Dw</span>";
                    } else {
                        echo "<span class=\"label label-warning\" > " . $value["DeckUp"] . "</span>";
                    }
                    echo "</td>";
                }
                echo !isset($show_actions) || $show_actions ? "    <td>" : "";
                echo !isset($show_actions) || $show_actions ? "        <a href=\"decklists.php?edit_decklist=" . $value["Id"] . "\" class=\"btn btn-xs btn-default btn-rounded\"><span class=\"fa fa-pencil\"></span></a>" : "";
                //echo !isset($show_actions) || $show_actions ? "        <button class=\"btn btn-xs btn-danger btn-rounded\" onClick=\"delete_row('trow_" . $value["Id"] . "');\"><span class=\"fa fa-times\"></span></button>" : "";
                echo !isset($show_actions) || $show_actions ? "    </td>" : "";
                echo "</tr>";
            }
        } else {
            echo $decklists["msg"];
        }
        ?>
    </tbody>
</table>