<!-- START BREADCRUMB -->
<ul class="breadcrumb">
	<li><a href="index.php">Home</a></li>
	<li><a href="decklists.php">Decklists</a></li>
	<li class="active">Decklist Edit</li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE TITLE -->
<div class="page-title">                    
	<h2><a onclick="history.back();" class="link"><span class="fa fa-arrow-circle-o-left"></span></a> Edit Decklist</h2>
</div>
<!-- END PAGE TITLE -->

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">
	<div class="row">
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-info" aria-hidden="true"></i> Base Informations</h3>
				</div>
				<div class="panel-body">
					<div class="row">
						<p style="margin: 1rem 0">Edit the decklist with id: <?php echo $elem["Id"]; ?>. But, pay Attenction! This is the core of the site, so it's ever under maintance, all contents can change without any advice during the Alpha tests. If you find a bug, please notify to the administrator or report a bug with the utility link at the bottom of the page.</p>
						<p style="margin: 1rem 0">Change the visibility state permit to all users to see the decklist.</p>
					</div>
				</div>
				<div class="panel-footer">
				</div>
			</div>
		</div>
		<div class="col-md-6">
            <div class="panel panel-default">
                <form autocomplete="false" class="save_base_data_panel" method="post" action="ajax/decklist_ajax.php?save_decklist_base_data">
                    <div class="panel-heading">
                        <h3 class="panel-title">Base Data</h3>
                        <button onClick="save_base_data('.save_base_data_panel', <?php echo $elem["Id"]; ?>)" class="btn btn-primary btn-rounded pull-right" ><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
                    </div>
                    <div class="panel-body">
                        <div class="row"><!--
                                Name
                            --><div class="col-md-12">
                                <div class="form-group">
                                    <label for="Name" class="col-md-3 control-label">Name</label>
                                    <div class="col-md-9">
                                        <input id="Name" name="Name" type="text" class="form-control add_item" placeholder="Name"
                                               <?php
                                                if(isset($elem["Name"])) {
                                                    echo "value=\"" . $elem["Name"] . "\"";
                                                }
                                               ?>
                                               />
                                    </div>
                                </div>
                            </div><!--
                                Player
                            --><div class="col-md-12">
                                <div class="form-group">
                                    <label for="Player" class="col-md-3 control-label">Player</label>
                                    <div class="col-md-9">
                                        <input id="Player" name="Player" type="text" class="form-control add_item" placeholder="Player"
                                               <?php
                                                if(isset($elem["Player"])) {
                                                    echo "value=\"" . $elem["Player"] . "\"";
                                                }
                                               ?>
                                               />
                                    </div>
                                </div>
                            </div><!--
                                Event
                            --><div class="col-md-12">
                                <div class="form-group">
                                    <label for="Event" class="col-md-3 control-label">Event</label>
                                    <div class="col-md-9">
                                        <select class="form-control add_item" id="Event" name="Event" placeholder="Event">
                                            <?php
                                            // Essendo la prima query apro la connessione.
                                            if($mysqli->connect_error){
                                                echo "<option value=\"0\">-- Connection Error --</option>";
                                            } else {
                                                $query = "SELECT s.Id, s.Name
                                                        FROM events s
                                                        ORDER BY s.Name";
                                                $stmt = $mysqli->prepare($query);
                                                $stmt->execute();
                                                $result = $stmt->get_result();
                                                if($result->num_rows > 0) {
                                                    while($row = $result->fetch_assoc()) {
                                                        echo "<option value=\"" . $row["Id"] . "\" ";
                                                        echo isset($elem["Event"]) && $elem["Event"] == $row["Name"] ? "selected" : " ";
                                                        echo ">" . $row["Name"];
                                                        echo "</option>";
                                                    }
                                                } else {
                                                    echo "<option value=\"0\">-- No Result --</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div><!--
                                Type
                            --><div class="col-md-12">
                                <div class="form-group">
                                    <label for="Type" class="col-md-3 control-label">Type</label>
                                    <div class="col-md-9">
                                        <select class="form-control add_item" id="Type" name="Type" placeholder="Type">
                                            <?php
                                            // Essendo la prima query apro la connessione.
                                            if($mysqli->connect_error){
                                                echo "<option value=\"0\">-- Connection Error --</option>";
                                            } else {
                                                $query = "SELECT d.Id, d.Name 
                                                          FROM decktypes d
                                                          ORDER BY d.Name";
                                                $stmt = $mysqli->prepare($query);
                                                $stmt->execute();
                                                $result = $stmt->get_result();
                                                if($result->num_rows > 0) {
                                                    while($row = $result->fetch_assoc()) {
                                                        echo "<option value=\"" . $row["Id"] . "\" ";
                                                        echo isset($elem["Type"]) && $elem["Type"] == $row["Name"] ? "selected" : " ";
                                                        echo ">" . $row["Name"];
                                                        echo "</option>";
                                                    }
                                                } else {
                                                    echo "<option value=\"0\">-- No Result --</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div><!--
                                Position
                            --><div class="col-md-12">
                                <div class="form-group">
                                    <label for="Position" class="col-md-3 control-label">Position</label>
                                    <div class="col-md-9">
                                        <input id="Position" type="number" class="form-control add_item" placeholder="Position"
                                               <?php
                                                if(isset($elem["Position"])) {
                                                    echo "value=\"" . $elem["Position"] . "\"";
                                                }
                                               ?>
                                               />
                                    </div>
                                </div>
                            </div><!--
                                GachaCode
                            --><div class="col-md-12">
                                <div class="form-group">
                                    <label for="GachaCode" class="col-md-3 control-label">GachaCode</label>
                                    <div class="col-md-9">
                                        <input id="GachaCode" type="number" class="form-control add_item" placeholder="GachaCode"
                                               <?php
                                                if(isset($elem["GachaCode"])) {
                                                    echo "value=\"" . $elem["GachaCode"] . "\"";
                                                }
                                               ?>
                                               />
                                    </div>
                                </div>
                            </div><!--
                                Visibility
                            --><div class="col-md-12">
                                <div class="form-group">
                                    <label for="Visibility" class="col-md-3 control-label">Visibility</label>
                                    <div class="col-md-9">
                                       <label class="switch switch-small">
                                            <input type="checkbox" id="Visibility" class="form-control add_item" 
                                            <?php 
                                            if(isset($elem["Visibility"])) {
                                            	echo "checked=\"" . ($elem["Visibility"] == 1 ? "true" : "false") . "\"";
                                        	} else {
                                                var_dump($elem);
                                            }
                                       		?> />
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <!-- Pannello degli errori non visibile -->
                        <div class="e-panel panel" style="display:none">
                            <div class="e-body panel-body">
                            </div>
                        </div>
                        <button type="reset" class="btn btn-default btn-rounded pull-right" ><i class="fa fa-trash-o" aria-hidden="true"></i> Reset</button>
                        <button class="btn btn-primary btn-rounded pull-right" onclick="save_base_data('.save_base_data_panel', <?php echo $elem["Id"]; ?>);"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <form autocomplete="false" class="import_decklist_panel" method="post" action="ajax/decklist_ajax.php?save_decklist">
                    <div class="panel-heading">
                        <h3 class="panel-title">Decklist Import</h3>
                        <button class="btn btn-primary btn-rounded pull-right decklist_importer" data-decklist="<?php echo $elem["Id"]; ?>"><i class="fa fa-floppy-o" aria-hidden="true"></i> Import</button>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <p style="margin: 1rem 0">Paste here the texted list from gachalog and click on Verify button! Once verified, click on Import button!</p>
                            <p style="margin: 1rem 0">After an import, you have to reload and save the base data if the recipe name or Gachalog Code are changed.</p>
                            <div class="col-md-12"><!--
                                GachaText
                                --><div class="col-md-12">
                                    <textarea id="GachaText" name="GachaText" class="form-control add_item" ></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <!-- Pannello degli errori non visibile -->
                        <div class="e-panel panel" style="display:none">
                            <div class="e-body panel-body">
                            </div>
                        </div>
                        <button class="btn btn-default btn-rounded pull-right"  onclick="reset_base_data();">
                        	<i class="fa fa-trash-o" aria-hidden="true"></i> Reset
                        </button>
                        <button class="btn btn-primary btn-rounded pull-right decklist_importer" data-decklist="<?php echo $elem["Id"]; ?>" >
                        	<i class="fa fa-floppy-o" aria-hidden="true"></i> Import
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <!--<form autocomplete="false" class="import_decklist_panel" method="post" action="ajax/decklist_ajax.php?save_decklist">-->
                    <div class="panel-heading">
                        <h3 class="panel-title">Actual Decklist</h3>
                        <!--<button class="btn btn-primary btn-rounded pull-right decklist_importer" data-decklist="<?php echo $elem["Id"]; ?>"><i class="fa fa-floppy-o" aria-hidden="true"></i> Import</button>-->
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <p style="margin: 1rem 0">Here there is the actual decklist uploaded from the importer system. Check if is correct, and if no, then re-import the decklist.</p>
                            <p style="margin: 1rem 0">I'm working on the possibility of hot-fix of the decklist.</p>
                            <div class="col-md-12"><!--
                                GachaText
                                -->
                                <?php require_once ROOT_PATH . "/components/tables/cards_table.php"; ?>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <!-- Pannello degli errori non visibile -->
                        <div class="e-panel panel" style="display:none">
                            <div class="e-body panel-body">
                            </div>
                        </div>
                        <!--<button class="btn btn-default btn-rounded pull-right"  onclick="reset_base_data();">
                        	<i class="fa fa-trash-o" aria-hidden="true"></i> Reset
                        </button>
                        <button class="btn btn-primary btn-rounded pull-right decklist_importer" data-decklist="<?php echo $elem["Id"]; ?>" >
                        	<i class="fa fa-floppy-o" aria-hidden="true"></i> Import
                        </button>-->
                    </div>
                <!--</form>-->
            </div>
        </div>
	</div>
</div>

<script type="text/javascript" src="js/decklists_builder.js"></script>