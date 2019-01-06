<table class="table <?php echo !isset($simple_card_table) || $simple_card_table ? "datatable_simple" : "datatable"; ?>">
    <thead>
        <tr>
			<?php
			echo !isset($show_id) || $show_id ? "<th width=\"50\">Id</th>" : "";
			echo !isset($show_quantity) || $show_quantity ? "<th width=\"100\">Quantity</th>" : "";
			echo !isset($show_name) || $show_name ? "<th>Name</th>" : "";
			echo !isset($show_code) || $show_code ? "<th width=\"110\">Code</th>" : "";
			echo !isset($show_type) || $show_type ? "<th width=\"100\">Type</th>" : "";
            echo !isset($show_cost) || $show_cost ? "<th width=\"135\">Cost</th>" : "";
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
				echo !isset($show_id) || $show_id ? "<td><span class=\"elem\"  data-elem=\"Id\" data-value=\"" . $value["Id"] . "\"></span>" . $value["Id"] . "</td>" : "";
                echo !isset($show_quantity) || $show_quantity ? "<td><span class=\"elem\"  data-elem=\"Quantity\" data-value=\"" . $value["Quantity"] . "\"></span>" . $value["Quantity"] . "</td>" : "";
                echo !isset($show_name) || $show_name ? "<td><span onclick=\"modal_filler(" . $value["Id"] . ")\" data-toggle=\"modal\" data-target=\"#single_card_modal\" ><i class=\"fa fa-search\"> </i> </span> <span class=\"elem\"  data-elem=\"cardname\" data-value=\"" . $value["Name"] . "\"></span>" . $value["Name"] . "</td>" : "";
                echo !isset($show_code) || $show_code ? "<td><span class=\"elem\"  data-elem=\"Set\" data-value=\"" . $value["Set"] . "\"></span>" . $value["Set"] . "-<span class=\"elem\"  data-elem=\"Number\" data-value=\"" . $value["Number"] . "\"></span>" . sprintf("%03s\n",   $value["Number"]) . " <span class=\"elem\"  data-elem=\"Rarity\" data-value=\"" . $value["Rarity_Id"] . "\"></span>" . $value["Rarity"] . "</td>" : "";
                echo !isset($show_type) || $show_type ? "<td><span class=\"label label-warning\"><span class=\"elem\"  data-elem=\"Type\" data-value=\"" . $value["Type"] . "\"></span>" . $value["Type"] . "</td>" : "";
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
                echo !isset($show_cost) || $show_cost ? "<td><span class=\"elem\"  data-elem=\"Cost\" data-value=\"" . $value["Cost"] . "\"></span>" . $cost . "</td>" : "";
                $deckstring = "";
                if((!isset($show_deck) || $show_deck) && isset($value["DeckLabel"])) {
                    $deckstring = "<td><span class=\"label " . $value["DeckLabel"] . "\"> " . $value["Decktype"] . "</span></td>";
                }
                echo $deckstring;
                echo !isset($show_attributes) || $show_attributes ? "<td><span class=\"label label-success\"><span class=\"elem\"  data-elem=\"Attribute\" data-value=\"" . $value["Attribute"] . "\"></span>" . $value["Attribute"] . "</span></td>" : "";
                echo !isset($show_actions) || $show_actions ? "<td>" : "";
                echo !isset($show_actions) || $show_actions ? "<button class=\"btn btn-default btn-rounded btn-xs\" onclick=\"edit_row('trow_" . $value["Id"] . "');\"><span class=\"fa fa-pencil\"></span></button>" : "";
                //echo !isset($show_actions) || $show_actions ? "<button class=\"btn btn-danger btn-rounded btn-xs\" onClick=\"delete_row('trow_" . $value["Id"] . "');\"><span class=\"fa fa-times\"></span> </button>" : "";
                echo !isset($show_actions) || $show_actions ? "</td>" : "";
                echo "</tr>";
           }
        } else {
            echo $cards["message"];
        }
    ?>
    </tbody>
</table>