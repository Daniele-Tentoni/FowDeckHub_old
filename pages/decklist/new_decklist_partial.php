<!-- START BREADCRUMB -->
<ul class="breadcrumb">
	<li><a href="index.php">Home</a></li>
	<li class="active"><a href="decklists.php">Decklists</a></li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE TITLE -->
<div class="page-title">                    
	<h2><span class="fa fa-arrow-circle-o-left"></span> New Decklist!!!</h2>
</div>
<!-- END PAGE TITLE -->

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">

	<div class="row">
		<div class="col-md-12">
			<form class="form-horizontal">
				<div class="panel panel-default">
					<div class="panel-body">
						<p>Crea in questa pagina la tua decklist.</p>
					</div>
					<div class="panel-body">

						<div class="row">
							
							<div class="col-md-6">

								<!-- Visibility -->
								<div class="form-group">
									<label class="col-md-3 control-label" for="visibility">Visibility</label>
									<div class="col-md-9 col-xs-12">
										<label class="switch">
											<input type="checkbox" id="visibility" value="0"/>
											<span></span>
										</label>
									</div>
								</div>
							
								<!-- Name -->
								<div class="form-group">
									<label class="col-md-3 control-label" for="deckname">Decklist Name</label>
									<div class="col-md-9 col-xs-12">                                            
										<div class="input-group">
											<span class="input-group-addon"><span class="fa fa-pencil"></span></span>
											<input type="text" id="deckname" onchange="name_change(event);" class="form-control"/>
										</div>                                            
										<span class="help-block">Name of the decklist.</span>
									</div>
								</div>
							
								<!-- Gachalog Code -->
								<div class="form-group">
									<label class="col-md-3 control-label" for="gachaCode">Gachalog Decklist Code</label>
									<div class="col-md-9 col-xs-12">                                            
										<div class="input-group">
											<span class="input-group-addon"><span class="fa fa-pencil"></span></span>
											<input type="text" id="gachaCode" onchange="gachaCode_change(event);" class="form-control"/>
										</div>                                            
										<span class="help-block">Gachalog Decklist Code to implement the decklist image.</span>
									</div>
								</div>
								
							</div>
							
							<div class="col-md-6">
							
								<!-- Format -->
								<div class="form-group">
									<label class="col-md-3 control-label" for="format">Format select</label>
									<div class="col-md-9 col-xs-12">
										<select class="form-control select" id="format" onchange="format_change(event);">
											<?php
											// Essendo la prima query apro la connessione.
											$format_conn = new mysqli("localhost", "root", "", "my_fowdeckhub");
											if($format_conn->connect_error){
												echo "<option value=\"0\">-- Connection Error --</option>";
											} else {
												$query = "SELECT Code, Name FROM formats WHERE Tournament = 1 AND Visibility = 1";
												$stmt = $format_conn->prepare($query);
												$stmt->execute();
												$result = $stmt->get_result();
												if($result->num_rows > 0) {
													while($row = $result->fetch_assoc()) {
														echo "<option value=\"" . $row["Code"] . "\">" . $row["Name"] . "</option>";
													}
												} else {
													echo "<option value=\"0\">-- No Result --</option>";
												}
												if(isset($format_conn)) {
													$format_conn->close();
												}
											}
											?>
										</select>
										<span class="help-block">Select format legality.</span>
									</div>
								</div>
								
								<!-- Deck Style -->
								<div class="form-group">
									<label class="col-md-3 control-label" for="style">Style select</label>
									<div class="col-md-9 col-xs-12">
										<select class="form-control select" id="style" onchange="style_change(event);">
											<?php
											// Essendo la prima query apro la connessione.
											$format_conn = new mysqli("localhost", "root", "", "my_fowdeckhub");
											if($format_conn->connect_error){
												echo "<option value=\"0\">-- Connection Error --</option>";
											} else {
												$query = "SELECT Code, Name FROM formats WHERE Tournament = 1 AND Visibility = 1";
												$stmt = $format_conn->prepare($query);
												$stmt->execute();
												$result = $stmt->get_result();
												if($result->num_rows > 0) {
													while($row = $result->fetch_assoc()) {
														echo "<option value=\"" . $row["Code"] . "\">" . $row["Name"] . "</option>";
													}
												} else {
													echo "<option value=\"0\">-- No Result --</option>";
												}
												if(isset($format_conn)) {
													$format_conn->close();
												}
											}
											?>
										</select>
										<span class="help-block">Select play style.</span>
									</div>
								</div>
								
								<!-- Ruler -->
								<div class="form-group">
									<label class="col-md-3 control-label" for="ruler">Style select</label>
									<div class="col-md-9 col-xs-12">
										<select class="form-control select" id="ruler" onchange="style_change(event);">
											<?php
											// Essendo la prima query apro la connessione.
											$format_conn = new mysqli("localhost", "root", "", "my_fowdeckhub");
											if($format_conn->connect_error){
												echo "<option value=\"0\">-- Connection Error --</option>";
											} else {
												$query = "SELECT Code, Name FROM formats WHERE Tournament = 1 AND Visibility = 1";
												$stmt = $format_conn->prepare($query);
												$stmt->execute();
												$result = $stmt->get_result();
												if($result->num_rows > 0) {
													while($row = $result->fetch_assoc()) {
														echo "<option value=\"" . $row["Code"] . "\">" . $row["Name"] . "</option>";
													}
												} else {
													echo "<option value=\"0\">-- No Result --</option>";
												}
												if(isset($format_conn)) {
													$format_conn->close();
												}
											}
											?>
										</select>
										<span class="help-block">Select ruler.</span>
									</div>
								</div>
								
								<!-- Event -->
								<div class="form-group">
									<label class="col-md-3 control-label" for="event">Event select</label>
									<div class="col-md-9 col-xs-12">
										<select class="form-control select" id="event" onchange="style_change(event);">
											<?php
											// Essendo la prima query apro la connessione.
											$format_conn = new mysqli("localhost", "root", "", "my_fowdeckhub");
											if($format_conn->connect_error){
												echo "<option value=\"0\">-- Connection Error --</option>";
											} else {
												$query = "SELECT Code, Name FROM formats WHERE Tournament = 1 AND Visibility = 1";
												$stmt = $format_conn->prepare($query);
												$stmt->execute();
												$result = $stmt->get_result();
												if($result->num_rows > 0) {
													while($row = $result->fetch_assoc()) {
														echo "<option value=\"" . $row["Code"] . "\">" . $row["Name"] . "</option>";
													}
												} else {
													echo "<option value=\"0\">-- No Result --</option>";
												}
												if(isset($format_conn)) {
													$format_conn->close();
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
					<div class="panel-footer">
						<button class="btn btn-default">Clear </button>
						<button class="btn btn-primary pull-right">Create</button>
					</div>
				</div>
			</form>
		<!-- END PAGE CONTENT WRAPPER -->
		</div>
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
<script type="text/javascript" src='js/new_decklist.js'></script>
<!-- END THIS PAGE PLUGINS-->