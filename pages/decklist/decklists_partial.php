<!-- START BREADCRUMB -->
<ul class="breadcrumb">
	<li><a href="index.php">Home</a></li>
	<li class="active">Decklists</li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE TITLE -->
<div class="page-title">                    
	<h2><span class="fa fa-arrow-circle-o-left"></span> Decklist List</h2>
</div>
<!-- END PAGE TITLE -->

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">
	<div class="row">
		<div class="col-md-12">
			<!-- START RESPONSIVE TABLES -->
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">Decklists</h3>
                            <!-- event -->
                            <!--<div class="col-md-3 col-xs-9 pull-right">
                                <select class="form-control select add-item" id="event">
                                    <option value="0">-- Filter by event --</option>
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
                            </div>-->
							<a href="decklists.php?newDecklist" class="btn btn-primary btn-rounded pull-right"><i class="fa fa-plus"></i>New List</a>
						</div>

						<div class="panel-body">
							<div class="table-responsive">
								<?php require_once ROOT_PATH . '/components/tables/decklists_table.php'; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- END RESPONSIVE TABLES -->
			
		<!-- END PAGE CONTENT WRAPPER -->                                    
		</div>         
	</div>            
	<!-- END PAGE CONTENT -->
</div>
<!-- END PAGE CONTAINER -->    

<!-- MESSAGE BOX-->
<div class="message-box animated fadeIn" data-sound="alert" id="mb-remove-row">
	<div class="mb-container">
		<div class="mb-middle">
			<div class="mb-title"><span class="fa fa-times"></span> Remove <strong>Data</strong> ?</div>
			<div class="mb-content">
				<p>Are you sure you want to remove this row?</p>                    
				<p>Press Yes if you sure.</p>
			</div>
			<div class="mb-footer">
				<div class="pull-right">
					<button class="btn btn-success btn-lg mb-control-yes">Yes</button>
					<button class="btn btn-default btn-lg mb-control-close">No</button>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END MESSAGE BOX-->

<!-- START THIS PAGE PLUGINS-->        
<script type='text/javascript' src='js/plugins/icheck/icheck.min.js'></script>

<script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
<script type="text/javascript" src="js/demo_tables.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#event").on('change', function (){
            console.log($(this));
        });
    });
</script>
<!-- END THIS PAGE PLUGINS-->  