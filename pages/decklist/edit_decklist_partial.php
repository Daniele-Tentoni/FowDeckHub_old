<!-- START BREADCRUMB -->
<ul class="breadcrumb">
	<li><a href="index.php">Home</a></li>
	<li><a href="events.php">Events</a></li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE TITLE -->
<div class="page-title">                    
	<h2><a href="events.php" class="link"><span class="fa fa-arrow-circle-o-left"></span></a> Add New Event</h2>
</div>
<!-- END PAGE TITLE -->

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">
	<div class="row">
		<div class="col-md-12">
			<form id="decklist_importer" action="ajax/decklists_ajax.php?import_decklist" method="post" class="form-horizontal">
				<div class="form-group">
					<label for="gacha_text" class="col-md-3 control-label">Gachalog Text List</label>
					<div class="col-md-9">
						<input id="gacha_text" name="gacha_text" type="number" class="form-control" placeholder="Gachalog Text List"/>
					</div>
				</div>
				<div class="deck_container">
				</div>
				<input type="reset">
				<button class="btn btn-primary btn-rounded" onclick="decklist_import(<?php echo $decklist["Id"]; ?>)" > Importa</button>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript" src="js/decklists_builder.js"></script>