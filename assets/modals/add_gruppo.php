<div class="modal fade" tabindex="-1" role="dialog" id="AddGruppo" aria-labelledby="AddGruppo">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Aggiungi gruppo</h4>
			</div>
			<div class="modal-body" id="body-gruppo">
				<div class="container"><!--
					Cognome
					--><div class="row">
						<div class="col-sm-12">
							<div class="input-group">
								<span class="input-group-addon">Nome</span>
								<input class="form-control" type="text" id="NomeGruppo" name="NomeGruppo" required />
							</div>
						</div>
					</div><!--
					Via
					--><div class="row">
						<div class="col-sm-12">
							<div class="input-group">
								<span class="input-group-addon">Descrizione</span>
								<input class="form-control" type="text" id="DescrizioneGruppo" name="DescrizioneGruppo" required />
							</div>
						</div>
					</div>
				</div>
			</div>
		<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		<button type="button" class="btn btn-primary" id="addGruppoBtn">Aggiungi</button>
		</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>
<script type="text/javascript">
	$(document).ready(function (){
		$("#addGruppoBtn").click(function(e) {
			console.log(e);
			var arguments = "nome=" + $("#NomeGruppo").val() + 
				"&des=" + $("#DescrizioneGruppo").val();
			$.ajax({
				type: "POST",
				url: "assets/php/add_gruppo_db.php",
				dataType: "json",
				data: arguments,
				success:function(result){
					if(result["result"] === true) {
						var success = "Elemento aggiunto correttamente. Ora puoi aggiungere un altro elemento oppure chiudere questa finestra.";
						$("#body-gruppo").append("<div class=\"row\"><div class=\"alert alert-success\">" + success + "</div></div>");
						console.log("Aggiunta riuscita.");
						console.log(result["content"]);
					} else if(result["result"] === false) {
						console.log(result["error"]);
						console.log("Fallimento");
					} else {
					  	var labelErrore = "Risultato inatteso. Codice errore: " + result["error"] + "<br />" + result["msg"];
						$("#body-gruppo").append("<div class=\"alert alert-danger\">" + labelErrore + "</div>");
						console.log("Risultato inatteso.");
					}
				},
				error:function(result){
					console.log("Errore aggiunta gruppo.");
					console.log(result);
				}
			});
		});
	})
</script>