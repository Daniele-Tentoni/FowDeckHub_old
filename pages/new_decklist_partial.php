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

						<!-- Name -->
						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label">Decklist Name</label>
							<div class="col-md-6 col-xs-12">                                            
								<div class="input-group">
									<span class="input-group-addon"><span class="fa fa-pencil"></span></span>
									<input type="text" id="deckname" onchange="name_change(event);" class="form-control"/>
								</div>                                            
								<span class="help-block">Name of the decklist.</span>
							</div>
						</div>

						<!-- Format -->
						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label">Format select</label>
							<div class="col-md-6 col-xs-12">
								<?php require $_SERVER['DOCUMENT_ROOT'] . '/components/select/format_select.php'; ?>
								<span class="help-block">Select format legality.</span>
							</div>
						</div>

						<!-- Visibility -->
						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label">Visibility</label>
							<div class="col-md-6 col-xs-12">
								<?php require $_SERVER['DOCUMENT_ROOT'] . '/components/select/visibility_select.php'; ?>
								<span class="help-block">You can hide this decklist from users.</span>
							</div>
						</div>

						<!-- CardName -->
						<div class="form-group">
							<label class="col-md-3 col-xs-12 control-label">Decklist Name</label>
							<div class="col-md-6 col-xs-12">                                            
								<div class="input-group">
									<span class="input-group-addon"><span class="fa fa-pencil"></span></span>
									<input type="text" id="cardname" onkeyup="cardname_keyup(event);" class="form-control"/>
								</div>                                            
								<span class="help-block">Name of the decklist.</span>
							</div>
						</div>
						
						<div class="form-group">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th>id</th>
										<th>First Name</th>
										<th>Last Name</th>
										<th>Username</th>
									</tr>
								</thead>
								<tbody>
									<tr class="active">
										<td>1</td>
										<td>Mark</td>
										<td>Otto</td>
										<td>@mdo</td>
									</tr>
									<tr class="success">
										<td>2</td>
										<td>Jacob</td>
										<td>Thornton</td>
										<td>@fat</td>
									</tr>
									<tr class="info">
										<td>3</td>
										<td>Larry</td>
										<td>the Bird</td>
										<td>@twitter</td>
									</tr>
									<tr class="warning">
										<td>3</td>
										<td>Larry</td>
										<td>the Bird</td>
										<td>@twitter</td>
									</tr>
									<tr class="danger">
										<td>3</td>
										<td>Larry</td>
										<td>the Bird</td>
										<td>@twitter</td>
									</tr>
								</tbody>
							</table>
						</div>

					</div>
					<div class="panel-footer">
						<button class="btn btn-default">Clear Form</button>                                    
						<button class="btn btn-primary pull-right">Submit</button>
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
<script type="text/javascript" src='js/new_decklist.js'></script>
<!-- END THIS PAGE PLUGINS-->  