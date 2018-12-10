<div class="modal fade" tabindex="-1" role="dialog" id="AddFamiglia" aria-labelledby="AddFamiglia">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Aggiungi famiglia</h4>
			</div>
			<div class="modal-body" id="body-famiglia">
				<div class="container"><!--
					Cognome
					--><div class="row">
						<div class="col-sm-12">
							<div class="input-group">
								<span class="input-group-addon">Cognome</span>
								<input class="form-control" type="text" id="CognomeFamiglia" name="CognomeFamiglia" required />
							</div>
						</div>
					</div><!--
					Via
					--><div class="row">
						<div class="col-sm-12">
							<div class="input-group">
								<span class="input-group-addon">Via</span>
								<input class="form-control" type="text" id="Via" name="Via" required />
							</div>
						</div>
					</div><!--
					Numero
					--><div class="row">
						<div class="col-sm-12">
							<div class="input-group">
								<span class="input-group-addon">Numero</span>
								<input class="form-control" type="num" id="Numero" name="Numero" required />
							</div>
						</div>
					</div><!--
					CAP
					--><div class="row">
						<div class="col-sm-12">
							<div class="input-group">
								<span class="input-group-addon">CAP</span>
								<input class="form-control" type="num" id="CAP" name="CAP" required />
							</div>
						</div>
					</div>
				</div>
			</div>
		<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		<button type="button" class="btn btn-primary" id="addFamigliaBtn">Aggiungi</button>
		</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>
<script type="text/javascript">
	$(document).ready(function (){
		$("#addFamigliaBtn").click(function(e) {
			console.log(e);
			var arguments = "cognome=" + $("#CognomeFamiglia").val() + 
				"&via=" + $("#Via").val() + 
				"&numero=" + $("#Numero").val() + 
				"&cap=" + $("#CAP").val();
			$.ajax({
				type: "POST",
				url: "assets/php/add_famiglia_db.php",
				dataType: "json",
				data: arguments,
				success:function(result){
					if(result["result"] === true) {
						var success = "Elemento aggiunto correttamente. Ora puoi aggiungere un altro elemento oppure chiudere questa finestra.";
						$("#body-famiglia").append("<div class=\"row\"><div class=\"alert alert-success\">" + success + "</div></div>");
						console.log("Aggiunta riuscita.");
						console.log(result["content"]);
					} else if(result["result"] === false) {
						console.log(result["error"]);
						console.log("Fallimento");
					} else {
					  	var labelErrore = "Risultato inatteso. Codice errore: " + result["error"] + "<br />" + result["msg"];
						$("#body-famiglia").append("<div class=\"alert alert-danger\">" + labelErrore + "</div>");
						console.log("Risultato inatteso.");
					}
				},
				error:function(result){
					console.log("Errore aggiunta famiglia.");
					console.log(result);
				}
			});
		});
	})
</script>