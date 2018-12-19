<!-- START BREADCRUMB -->
<ul class="breadcrumb">
	<li><a href="index.php">Home</a></li>
	<li><a href="events.php">Events</a></li>
	<li class="active">Event Edit</li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE TITLE -->
<div class="page-title">                    
	<h2><a onclick="history.back();" class="link"><span class="fa fa-arrow-circle-o-left"></span></a> Edit Event</h2>
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
						<p style="margin: 1rem 0">Edit the event with id: <?php echo $event["Id"]; ?>. But, pay Attenction! This is the core of the site, so it's ever under maintance, all contents can change without any advice during the Alpha tests.</p>
						<p style="margin: 1rem 0">Note that September, October, November and Dicember of an year after the WGP are under the new season beginning, so select the year when the season is started (put the year of the newest cluster. Es: WGP 2018 in Tokyo was played when NDR was already release, so put 2018) .</p>
						<p style="margin: 1rem 0">Change the visibility state permit to all users to see the event details</p>
					</div>
				</div>
				<div class="panel-footer">
				</div>
			</div>
		</div>
		<div class="col-md-6">
            <div class="panel panel-default">
                <form autocomplete="false" class="save_base_data_panel" method="post" action="ajax/event_ajax.php?event_save_base_data">
                    <div class="panel-heading">
                        <h3 class="panel-title">Base Data</h3>
                        <button onClick="save_base_data('.save_base_data_panel', <?php echo $event_id; ?>)" class="btn btn-primary btn-rounded pull-right" ><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12"><!--
                                Name
                                --><div class="form-group">
                                    <label for="Name" class="col-md-3 control-label">Name</label>
                                    <div class="col-md-9">
                                        <input id="Name" name="Name" type="text" class="form-control add_item" placeholder="Name"
                                               <?php
                                                if(isset($event["Name"])) {
                                                    echo "value=\"" . $event["Name"] . "\"";
                                                }
                                               ?>
                                               />
                                    </div>
                                </div>
                            </div><!--
                                Year
                            --><div class="col-md-12">
                                <div class="form-group">
                                    <label for="Year" class="col-md-3 control-label">Year</label>
                                    <div class="col-md-9">
                                        <input id="Year" type="number" class="form-control add_item" placeholder="Year"
                                               <?php
                                                if(isset($event["Year"])) {
                                                    echo "value=\"" . $event["Year"] . "\"";
                                                }
                                               ?>
                                               />
                                    </div>
                                </div>
                            </div><!--
                                Date
                            --><div class="col-md-12">
                                <div class="form-group">
                                    <label for="Date" class="col-md-3 control-label">Date</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <input id="Date" class="form-control datepicker add_item" data-date-format="dd-mm-yyyy" data-date-viewmode="years" type="text" placeholder="Date"
                                               <?php
                                                if(isset($event["Date"])) {
                                                    echo "value=\"" . $event["Date"] . "\"";
                                                }
                                               ?>
                                               />
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                        </div>
                                    </div>
                                </div>
                            </div><!--
                                Nation
                            --><div class="col-md-12">
                                <div class="form-group">
                                    <label for="Nation" class="col-md-3 control-label">Nation</label>
                                    <div class="col-md-9">
                                        <select class="form-control add_item" id="Nation" name="Nation" placeholder="Nation">
                                            <?php
                                            // Essendo la prima query apro la connessione.
                                            if($mysqli->connect_error){
                                                echo "<option value=\"0\">-- Connection Error --</option>";
                                            } else {
                                                $query = "SELECT s.Id, s.Name
                                                        FROM nations s
                                                        ORDER BY s.Name";
                                                $stmt = $mysqli->prepare($query);
                                                $stmt->execute();
                                                $result = $stmt->get_result();
                                                if($result->num_rows > 0) {
                                                    while($row = $result->fetch_assoc()) {
                                                        echo "<option value=\"" . $row["Id"] . "\" ";
                                                        echo isset($event["Nation"]) && $event["Nation"] == $row["Name"] ? "selected" : " ";
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
                                Attendance
                            --><div class="col-md-12">
                                <div class="form-group">
                                    <label for="Attendance" class="col-md-3 control-label">Attendance</label>
                                    <div class="col-md-9">
                                        <input id="Attendance" type="number" class="form-control add_item" placeholder="Attendance"
                                               <?php
                                                if(isset($event["Attendance"])) {
                                                    echo "value=\"" . $event["Attendance"] . "\"";
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
                                            if(isset($event["Visibility"])) {
                                            	echo "checked=\"" . $event["Visibility"] == 1 ? "true" : "false" . "\"";
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
                        <button class="btn btn-primary btn-rounded pull-right" onclick="save_base_data('.save_base_data_panel', <?php echo $event["Id"]; ?>);"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <form autocomplete="false" class="save_ruler_breakdown_panel" method="post" action="ajax/event_ajax.php?event_save_ruler_breakdown">
                    <div class="panel-heading">
                        <h3 class="panel-title">Ruler Breakdown</h3>
                        <button onclick="save_ruler_breakdown('.save_ruler_breakdown_panel', <?php echo $event_id; ?>);" class="btn btn-primary btn-rounded pull-right" ><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <p style="margin:20px 0">Here you can insert rulers breakdowns.</p>
                            <div class="col-md-12"><!--
                                Breakdown
                                --><div class="col-md-12">
                                    <table class="table datatable_simple">
                                        <thead>
                                            <tr>
                                                <th width="50">Id</th>
                                                <th>Name</th>
                                                <th width="100">Quantity</th>
                                            </tr>
                                        </thead>
                                        <tbody id="cards-table-body">
                                        <?php
                                            if($mysqli->connect_error){
                                                echo "-- Connection Error --";
                                            } else {
                                                $query = 'select c.Id, c.Name
                                                            from cards c
                                                            join card_types ct on c.Id = ct.Card
                                                            join types t on ct.Type = t.Id
                                                            where t.Name = "Ruler / J-Ruler"';
                                                $stmt = $mysqli->prepare($query);
                                                $stmt->execute();
                                                $result = $stmt->get_result();
                                                if($result->num_rows > 0) {
                                                    while($row = $result->fetch_assoc()) {
                                                        echo "<tr id=\"trow_" . $row["Id"] . "\">";
                                                        echo "<td>" . $row["Id"] . "</td>";
                                                        echo "<td>" . $row["Name"] . "</td>";
                                                        echo "<td>";
														echo "<input id=\"" . $row["Id"] . "\" name=\"" . $row["Id"] . "\" type=\"text\" class=\"form-control breakdown\" placeholder=\"Quantity\"";
                                                        echo isset($breakdown[$row["Id"]]) ? "  value=\"" . $breakdown[$row["Id"]]["Quantity"] . "\"" : "";
														echo "/></td>";
                                                        echo "</tr>";
                                                    }
                                                } else {
                                                    echo "-- No Result --";
                                                }
                                            }
                                        ?>
                                        </tbody>
                                    </table>
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
                        <button class="btn btn-default btn-rounded pull-right"  onclick="reset_base_data();"><i class="fa fa-trash-o" aria-hidden="true"></i> Reset</button>
                        <button class="btn btn-primary btn-rounded pull-right" onclick="save_ruler_breakdown('.save_ruler_breakdown_panel', <?php echo $event_id; ?>);"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <form autocomplete="false" class="save_community_reports_panel" method="post" action="ajax/event_ajax.php?event_save_community_reports">
                    <div class="panel-heading">
                        <h3 class="panel-title">Community Reports</h3>
                        <button onClick="save_base_data('.save_community_reports_panel', <?php echo $event["Id"]; ?>)" class="btn btn-primary btn-rounded pull-right" ><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <p style="margin:20px 0">Write here about many sections of the event page!</p>
                            <div class="col-md-12"><!--
                                CommunityReports
                                --><div class="col-md-12">
                                    <textarea id="CommunityReports" name="CommunityReports" class="form-control add_item" ><?php
                                                if(isset($event["CommunityReports"])) {
                                                    echo $event["CommunityReports"];
                                                } else {
                                                    echo "There is no community reports. Contact the admin if you have one!";
                                                }
                                               ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <!-- Pannello degli errori non visibile -->
                        <div class="e-panel panel" style="display:none">
                            <div class="e-body panel-body">
                            </div>
                        </div>
                        <button class="btn btn-default btn-rounded pull-right"  onclick="reset_base_data();"><i class="fa fa-trash-o" aria-hidden="true"></i> Reset</button>
                        <button class="btn btn-primary btn-rounded pull-right" onclick="save_base_data('.save_community_reports_panel', <?php echo $event["Id"]; ?>)"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <form autocomplete="false" class="save_other_links_panel" method="post" action="ajax/event_ajax.php?event_save_other_links">
                    <div class="panel-heading">
                        <h3 class="panel-title">OtherLinks</h3>
                        <button onClick="save_base_data('.save_other_links_panel', <?php echo $event["Id"]; ?>);" class="btn btn-primary btn-rounded pull-right" ><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <p style="margin:20px 0">Write here about many sections of the event page!</p>
                            <div class="col-md-12"><!--
                                OtherLinks
                                --><div class="col-md-12">
                                    <textarea id="OtherLinks" name="OtherLinks" class="form-control add_item" ><?php
                                                if(isset($event["OtherLinks"])) {
                                                    echo $event["OtherLinks"];
                                                } else {
                                                    echo "There is no community reports. Contact the admin if you have one!";
                                                }
                                               ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <!-- Pannello degli errori non visibile -->
                        <div class="e-panel panel" style="display:none">
                            <div class="e-body panel-body">
                            </div>
                        </div>
                        <button class="btn btn-default btn-rounded pull-right"  onclick="reset_base_data();"><i class="fa fa-trash-o" aria-hidden="true"></i> Reset</button>
                        <button class="btn btn-primary btn-rounded pull-right" onclick="save_base_data('.save_other_links_panel', <?php echo $event["Id"]; ?>);"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
		<!-- END PAGE CONTENT WRAPPER -->
	</div>
	<!-- END PAGE CONTENT -->
</div>
<!-- END PAGE CONTAINER -->
<script type="text/javascript" src="js/event_builder.js"></script>