<div class="modal fade" tabindex="-1" role="dialog" id="AddAttivita" aria-labelledby="AddAttivita">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Aggiungi attività</h4>
			</div>
			<div class="modal-body" id="body-attivita">
				<div class="container"><!--
					Cognome
					--><div class="row">
						<div class="col-sm-12">
							<div class="input-group">
								<span class="input-group-addon">Nome</span>
								<input class="form-control" type="text" id="NomeAttivita" name="NomeAttivita" required />
							</div>
						</div>
					</div><!--
					Via
					--><div class="row">
						<div class="col-sm-12">
							<div class="input-group">
								<span class="input-group-addon">Descrizione</span>
								<input class="form-control" type="text" id="DescrizioneAttivita" name="DescrizioneAttivita" required />
							</div>
						</div>
					</div><!--
					Anno
					--><div class="row">
						<div class="col-sm-12">
							<div class="input-group">
								<span class="input-group-addon">Anno</span>
								<input class="form-control" type="text" id="AnnoAttivita" name="AnnoAttivita" required />
							</div>
						</div>
					</div><!--
					Edizione
					--><div class="row">
						<div class="col-sm-12">
							<div class="input-group">
								<span class="input-group-addon">Edizione</span>
								<input class="form-control" type="text" id="EdizioneAttivita" name="EdizioneAttivita" required />
							</div>
						</div>
					</div>
				</div>
			</div>
		<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		<button type="button" class="btn btn-primary" id="addAttivitaBtn">Aggiungi</button>
		</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>
<script type="text/javascript">
	$(document).ready(function (){
		$("#addAttivitaBtn").click(function(e) {
			console.log(e);
			var arguments = "nome=" + $("#NomeAttivita").val() + 
				"&des=" + $("#DescrizioneAttivita").val() + 
				"&anno=" + $("#AnnoAttivita").val() + 
				"&edizione=" + $("#EdizioneAttivita").val();
			$.ajax({
				type: "POST",
				url: "assets/php/add_attivita_db.php",
				dataType: "json",
				data: arguments,
				success:function(result){
					if(result["result"] === true) {
						var success = "Elemento aggiunto correttamente. Ora puoi aggiungere un altro elemento oppure chiudere questa finestra.";
						$("#body-attivita").append("<div class=\"row\"><div class=\"alert alert-success\">" + success + "</div></div>");
						console.log("Aggiunta riuscita.");
						console.log(result["content"]);
					} else if(result["result"] === false) {
						console.log(result["error"]);
						console.log("Fallimento");
					} else {
					  	var labelErrore = "Risultato inatteso. Codice errore: " + result["error"] + "<br />" + result["msg"];
						$("#body-attivita").append("<div class=\"alert alert-danger\">" + labelErrore + "</div>");
						console.log("Risultato inatteso.");
					}
				},
				error:function(result){
					console.log("Errore aggiunta attività.");
					console.log(result);
				}
			});
		});
	})
</script>