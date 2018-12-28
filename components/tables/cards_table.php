<table class="table <?php echo !isset($simple_card_table) || $simple_card_table ? "datatable_simple" : "datatable"; ?>">
    <thead>
        <tr>
			<?php
			echo !isset($show_id) || $show_id ? "<th width=\"50\">Id</th>" : "";
			echo !isset($show_quantity) || $show_quantity ? "<th width=\"100\">Quantity</th>" : "";
			echo !isset($show_name) || $show_name ? "<th>Name</th>" : "";
			echo !isset($show_code) || $show_code ? "<th width=\"110\">Code</th>" : "";
			echo !isset($show_type) || $show_type ? "<th width=\"100\">Type</th>" : "";
            echo !isset($show_cost) || $show_cost ? "<th width=\"120\">Cost</th>" : "";
            echo !isset($show_attributes) || $show_attributes ? "<th width=\"100\">Attributes</th>" : "";
			echo !isset($show_deck) || $show_deck ? "<th width=\"100\">Deck</th>" : "";
            echo !isset($show_actions) || $show_actions ? "<th width=\"110\">Actions</th>" : "";
			?>
        </tr>
    </thead>
    <tbody id="cards-table-body">
    <?php
        if(isset($cards) && $cards["result"] == true) {
            foreach ($cards["content"] as $value) {
                echo "<tr id=\"trow_" . $value["Id"] . "\">";
				echo !isset($show_id) || $show_id ? "<td>" . $value["Id"] . "</td>" : "";
                echo !isset($show_quantity) || $show_quantity ? "<td>" . $value["Quantity"] . "</td>" : "";
                echo !isset($show_name) || $show_name ? "<td><span onclick=\"modal_filler(" . $value["Id"] . ")\" data-toggle=\"modal\" data-target=\"#single_card_modal\" ><i class=\"fa fa-search\"> </i> </span> " . $value["Name"] . "</td>" : "";
                echo !isset($show_code) || $show_code ? "<td>" . $value["Set"] . "-" . sprintf("%03s\n",   $value["Number"]) . " " . $value["Rarity"] . "</td>" : "";
                echo !isset($show_type) || $show_type ? "<td><span class=\"label label-warning\">" . $value["Type"] . "</td>" : "";
                if(!isset($show_cost) || $show_cost) {
                    $cost = "";
                    $chars = str_split($value["Cost"]);
                    foreach($chars as $char) {
                        switch($char) {
                            case 'W':
                                $cost .= "<span class=\"label label-warning\" > " . $char . "</span> ";
                                break;
                            case 'R':
                                $cost .= "<span class=\"label label-danger\" > " . $char . "</span> ";
                                break;
                            case 'U':
                                $cost .= "<span class=\"label label-info\" > " . $char . "</span> ";
                                break;
                            case 'G':
                                $cost .= "<span class=\"label label-success\" > " . $char . "</span> ";
                                break;
                            case 'B':
                                $cost .= "<span class=\"label label-primary\" > " . $char . "</span> ";
                                break;
                            default:
                                $cost .= "<span class=\"label label-default\" > " . $char . "</span> ";
                                break;
                        }
                    }
                }
                echo !isset($show_cost) || $show_cost ? "<td>" . $cost . "</td>" : "";
                $deckstring = "";
                if((!isset($show_deck) || $show_deck) && isset($value["DeckLabel"])) {
                    $deckstring = "<td><span class=\"label " . $value["DeckLabel"] . "\"> " . $value["Decktype"] . "</span></td>";
                }
                echo $deckstring;
                echo !isset($show_attributes) || $show_attributes ? "<td><span class=\"label label-success\">" . $value["Attribute"] . "</span></td>" : "";
                echo !isset($show_actions) || $show_actions ? "<td><button class=\"btn btn-default btn-rounded btn-sm\"><span class=\"fa fa-pencil\"></span></button> <button class=\"btn btn-danger btn-rounded btn-sm\" onClick=\"delete_row('trow_" . $value["Id"] . "');\"><span class=\"fa fa-times\"></span> </button></td>" : "";
                echo "</tr>";
           }
        } else {
            echo $cards["message"];
        }
    ?>
    </tbody>
</table>