<!-- START BREADCRUMB -->
<ul class="breadcrumb">
	<li><a href="index.php">Home</a></li>
	<li class="active"><a href="decklists.php">Decklists</a></li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE TITLE -->
<div class="page-title">                    
	<h2><a href="decklists.php" class="link"><span class="fa fa-arrow-circle-o-left"></span></a> New Decklist!!!</h2>
</div>
<!-- END PAGE TITLE -->

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">

	<div class="row">
		<div class="col-md-12">
			<form class="form-horizontal" action="adders/add_deck.php" method="post" id="new-item">
				<div class="panel panel-default">
					<div class="panel-body">
						<p>Aggiungi da questa pagina la tua decklist.</p>
						<div class="row">
							
							<div class="col-md-6">
                                
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <!-- visibility -->
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="visibility">Visibility</label>
                                            <div class="col-md-9 col-xs-12">
                                                <label class="switch">
                                                    <input type="checkbox" id="visibility" class="add-item" value="0"/>
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <!-- position -->
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="position">Position</label>
                                            <div class="col-md-9 col-xs-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                    <input type="number" id="position" class="form-control add-item"/>
                                                </div>                                            
                                                <span class="help-block">Position reached.</span>
                                            </div>
                                        </div>                                    
                                    </div>
                                </div>
							
								<!-- deckname -->
								<div class="form-group">
									<label class="col-md-3 control-label" for="deckname">Decklist Name</label>
									<div class="col-md-9 col-xs-12">                                            
										<div class="input-group">
											<span class="input-group-addon"><span class="fa fa-pencil"></span></span>
											<input type="text" id="deckname" class="form-control add-item"/>
										</div>                                            
										<span class="help-block">Name of the decklist.</span>
									</div>
								</div>
							
								<!-- player -->
								<div class="form-group">
									<label class="col-md-3 control-label" for="player">Player Name</label>
									<div class="col-md-9 col-xs-12">                                            
										<div class="input-group">
											<span class="input-group-addon"><span class="fa fa-pencil"></span></span>
											<input type="text" id="player" class="form-control add-item"/>
										</div>                                            
										<span class="help-block">Name of the player.</span>
									</div>
								</div>
							
								<!-- gachaCode -->
								<div class="form-group">
									<label class="col-md-3 control-label" for="gachaCode">Gachalog Decklist Code</label>
									<div class="col-md-9 col-xs-12">                                            
										<div class="input-group">
											<span class="input-group-addon"><span class="fa fa-pencil"></span></span>
											<input type="text" id="gachaCode" class="form-control add-item"/>
										</div>                                            
										<span class="help-block">Gachalog Decklist Code to implement the decklist image.</span>
									</div>
								</div>
								
							</div>
							
							<div class="col-md-6">
							
								<!-- format -->
								<div class="form-group">
									<label class="col-md-3 control-label" for="format">Format select</label>
									<div class="col-md-9 col-xs-12">
										<select class="form-control select add-item" id="format" >
											<?php
											if($mysqli->connect_error){
												echo "<option value=\"0\">-- Connection Error --</option>";
											} else {
												$query = "SELECT Code, Name FROM formats WHERE Tournament = 1 AND Visibility = 1";
												$stmt = $mysqli->prepare($query);
												$stmt->execute();
												$result = $stmt->get_result();
												if($result->num_rows > 0) {
													while($row = $result->fetch_assoc()) {
														echo "<option value=\"" . $row["Code"] . "\">" . $row["Name"] . "</option>";
													}
												} else {
													echo "<option value=\"0\">-- No Result --</option>";
												}
											}
											?>
										</select>
										<span class="help-block">Select format legality.</span>
									</div>
								</div>
								
								<!-- type -->
								<div class="form-group">
									<label class="col-md-3 control-label" for="type">Type select</label>
									<div class="col-md-9 col-xs-12">
										<select class="form-control select add-item" id="type" >
											<?php
											if($mysqli->connect_error){
												echo "<option value=\"0\">-- Connection Error --</option>";
											} else {
												$query = "SELECT d.Id, d.Name, p.Name as Style FROM decktypes d JOIN playstyles p ON d.Style = p.Id";
												$stmt = $mysqli->prepare($query);
												$stmt->execute();
												$result = $stmt->get_result();
												if($result->num_rows > 0) {
													while($row = $result->fetch_assoc()) {
														echo "<option value=\"" . $row["Id"] . "\">" . $row["Name"] . " / " . $row["Style"] . "</option>";
													}
												} else {
													echo "<option value=\"0\">-- No Result --</option>";
												}
											?>
										</select>
										<span class="help-block">Select play style.</span>
									</div>
								</div>
								
								<!-- ruler -->
								<div class="form-group">
									<label class="col-md-3 control-label" for="ruler">Ruler select</label>
									<div class="col-md-9 col-xs-12">
										<select class="form-control select add-item" id="ruler" >
											<?php
											if($mysqli->connect_error){
												echo "<option value=\"0\">-- Connection Error --</option>";
											} else {
												$query = "SELECT c.Id,
                                                                c.Name
                                                            FROM cards c
                                                            left join card_types ct on ct.Card = c.Id
                                                            left join types t on ct.Type = t.Id
                                                            where t.Id = 6";
												$stmt = $mysqli->prepare($query);
												$stmt->execute();
												$result = $stmt->get_result();
												if($result->num_rows > 0) {
													while($row = $result->fetch_assoc()) {
														echo "<option value=\"" . $row["Id"] . "\">" . $row["Name"] . "</option>";
													}
												} else {
													echo "<option value=\"0\">-- No Result --</option>";
												}
											}
											?>
										</select>
										<span class="help-block">Select ruler.</span>
									</div>
								</div>
								
								<!-- event -->
								<div class="form-group">
									<label class="col-md-3 control-label" for="event">Event select</label>
									<div class="col-md-9 col-xs-12">
										<select class="form-control select add-item" id="event" onchange="style_change(event);">
											<?php
											if($mysqli->connect_error){
												echo "<option value=\"0\">-- Connection Error --</option>";
											} else {
												$query = "SELECT Id, Name FROM events";
												$stmt = $mysqli->prepare($query);
												$stmt->execute();
												$result = $stmt->get_result();
												if($result->num_rows > 0) {
													while($row = $result->fetch_assoc()) {
														echo "<option value=\"" . $row["Id"] . "\">" . $row["Name"] . "</option>";
													}
												} else {
													echo "<option value=\"0\">-- No Result --</option>";
												}
											}
											?>
										</select>
										<span class="help-block">Select play style.</span>
									</div>
								</div>
				            </div>
								
                        </div>

                    </div>
						
				</div>
                <div class="panel-footer">
                    <div class="e-panel">
                        <div class="e-body">
                        </div>
                    </div>
                    <button class="btn btn-default">Clear </button>
                    <button class="btn btn-primary pull-right">Create </button>
                </div>
            </form>
		</div>
		<!-- END PAGE CONTENT WRAPPER -->
	</div>
	<!-- END PAGE CONTENT -->
</div>
<!-- END PAGE CONTAINER -->

<!-- START THIS PAGE PLUGINS-->
<script type='text/javascript' src='js/plugins/icheck/icheck.min.js'></script>
<script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
<script type="text/javascript" src="js/plugins/bootstrap/bootstrap-datepicker.js"></script>                
<script type="text/javascript" src="js/plugins/bootstrap/bootstrap-file-input.js"></script>
<script type="text/javascript" src="js/plugins/bootstrap/bootstrap-select.js"></script>
<script type="text/javascript" src="js/plugins/tagsinput/jquery.tagsinput.min.js"></script>
<script type="text/javascript" src="js/plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src='js/demo_tables.js'></script>
<script type="text/javascript">
    $("#new-item").submit(function(e){
        e.preventDefault();
        new_row(false);
    });
</script>
<!-- END THIS PAGE PLUGINS-->