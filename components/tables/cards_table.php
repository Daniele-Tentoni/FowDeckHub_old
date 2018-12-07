<table class="table datatable">
    <thead>
        <tr>
			<th width="60">Id</th>
            <th>Name</th>
            <th width="120">Code</th>
            <th width="90">Type</th>
            <th width="100">Cost</th>
            <th width="90">Attributes</th>
            <th width="150">Actions</th>
        </tr>
    </thead>
    <tbody id="cards-table-body">
    <?php
        if(isset($cards) && $cards["result"] == true) {
            foreach ($cards["content"] as $value) {
                echo "<tr id=\"trow_" . $value["Id"] . "\">";
				echo "<td>" . $value["Id"] . "</td>";
                echo "<td><span onclick=\"modal_filler(" . $value["Id"] . ")\" data-toggle=\"modal\" data-target=\"#single_card_modal\" ><i class=\"fa fa-search\"> </i> </span> " . $value["Name"] . "</td>";
                echo "<td>" . $value["Set"] . "-" . $value["Number"] . " " . $value["Rarity"] . "</td>";
                echo "<td><span class=\"label label-warning\">" . $value["Type"] . "</td>";
                $cost = "";
                $chars = str_split($value["Cost"]);
                foreach($chars as $char){
                    switch($char) {
                        case 'W':
                            $cost .= "<span class=\"label label-success\" style=\"background-color:yellow;\">" . $char . "</span> ";
                            break;
                        case 'R':
                            $cost .= "<span class=\"label label-success\" style=\"background-color:red;\">" . $char . "</span> ";
                            break;
                        case 'U':
                            $cost .= "<span class=\"label label-success\" style=\"background-color:blue;\">" . $char . "</span> ";
                            break;
                        case 'G':
                            $cost .= "<span class=\"label label-success\" style=\"background-color:green;\">" . $char . "</span> ";
                            break;
                        case 'B':
                            $cost .= "<span class=\"label label-success\" style=\"background-color:purple;\">" . $char . "</span> ";
                            break;
                        default:
                            $cost .= "<span class=\"label label-primary\" style=\"background-color:grey;\">" . $char . "</span> ";
                            break;
                    }
                }
                echo "<td>" . $cost . "</td>";
                echo "<td><span class=\"label label-success\">" . $value["Attribute"] . "</span></td>";
                echo "<td><button class=\"btn btn-default btn-rounded btn-sm\"><span class=\"fa fa-pencil\"></span></button> <button class=\"btn btn-danger btn-rounded btn-sm\" onClick=\"delete_row('trow_" . $value["Id"] . "');\"><span class=\"fa fa-times\"></span> </button></td>";
                echo "</tr>";
            }
        } else {
            echo $decklists["msg"];
        }
    ?>
    </tbody>
</table>