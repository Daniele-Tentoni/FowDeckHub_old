<div class="modal fade" tabindex="-1" role="dialog" id="AddParrocchiano" aria-labelledby="AddParrocchiano">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Aggiungi parrocchiano</h4>
			</div>
			<div class="modal-body" id="body-parrocchiano">
				<div class="container"><!--
					CF
					--><div class="row">
						<div class="col-sm-12">
							<div class="input-group">
								<span class="input-group-addon">Codice Fiscale</span>
								<input class="form-control" type="text" id="CFParrocchiano" name="CFParrocchiano" required />
							</div>
						</div>
					</div><!--
					Nome
					--><div class="row">
						<div class="col-sm-12">
							<div class="input-group">
								<span class="input-group-addon">Nome</span>
								<input class="form-control" type="text" id="NomeParrocchiano" name="NomeParrocchiano" required />
							</div>
						</div>
					</div><!--
					Cognome
					--><div class="row">
						<div class="col-sm-12">
							<div class="input-group">
								<span class="input-group-addon">Cognome</span>
								<input class="form-control" type="text" id="CognomeParrocchiano" name="CognomeParrocchiano" required />
							</div>
						</div>
					</div><!--
					Sesso
					--><div class="row">
						<div class="col-sm-12">
							<div class="input-group">
								<span class="input-group-addon">Sesso</span>
								<select class="form-control" id="sesso-sel" name="Sesso">
									<option value="M">Maschio</option>
									<option value="F">Femmina</option>
									<option value="A">Altro</option>
								</select>
							</div>
						</div>
					</div><!--
					Famiglia
					--><div class="row">
						<div class="col-sm-12">
							<div class="input-group">
								<span class="input-group-addon">Famiglia</span>
								<select class="form-control" id="famiglia-sel" name="Sesso"><!--
									Da riempire con il js
								--></select>
							</div>
						</div>
						<script type="text/javascript">
							function loadFamiglie(){
								$.ajax({
									type: "GET",
									url: "show_parrocchiani.php?filter=famiglie",
									dataType: "json",
									data: "",
									success:function(result){
										if(result["result"] === true) {
											console.log(result);
											result["content"].forEach(function (item) {
												var riga = "<option value=\"" + item["Codice"] + "\">";
												riga += item["Cognome"] + " in " + item["Indirizzo"];
												riga += "</option>";
												$(riga).appendTo($("#famiglia-sel"));
											});
										} else if(result["result"] === false) {
											console.log("Fallimento");
										}
									},
									error:function(result){
										console.log("Errore");
										console.log(result);
									}
								});
							}
							$(document).ready(function(){
								loadFamiglie();
							})
						</script>
					</div><!--
					Ruolo
					--><div class="row">
						<div class="col-sm-12">
							<div class="input-group">
								<span class="input-group-addon">Ruolo Famigliare</span>
								<input class="form-control" type="text" id="RuoloParrocchiano" name="RuoloParrocchiano" required />
							</div>
						</div>
					</div>
				</div>
			</div>
		<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		<button type="button" class="btn btn-primary" id="addParrocchianoBtn">Aggiungi</button>
		</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>
<script type="text/javascript">
	$(document).ready(function (){
		$("#addParrocchianoBtn").click(function(e) {
			console.log(e);
			var arguments = "cf=" + $("#CFParrocchiano").val() + 
				"&nome=" + $("#NomeParrocchiano").val() +
				"&cognome=" + $("#CognomeParrocchiano").val() + 
				"&sesso=" + $("#sesso-sel").val() + 
				"&famiglia=" + $("#famiglia-sel").val() + 
				"&ruolo="+$("#RuoloParrocchiano").val();
			$.ajax({
				type: "POST",
				url: "assets/php/add_parrocchiano_db.php",
				dataType: "json",
				data: arguments,
				success:function(result){
					if(result["result"] === true) {
						var success = "Elemento aggiunto correttamente. Ora puoi aggiungere un altro elemento oppure chiudere questa finestra.";
						$("#body-parrocchiano").append("<div class=\"row\"><div class=\"alert alert-success\">" + success + "</div></div>");
						console.log("Aggiunta riuscita.");
						console.log(result["content"]);
					} else if(result["result"] === false) {
						console.log(result);
						console.log("Fallimento");
					} else {
					  	var labelErrore = "Risultato inatteso. Codice errore: " + result["error"] + "<br />" + result["msg"];
						$("#body-parrocchiano").append("<div class=\"alert alert-danger\">" + labelErrore + "</div>");
						console.log("Risultato inatteso.");
					}
				},
				error:function(result){
					console.log("Errore aggiunta parrocchiano.");
					console.log(result);
				}
			});
		});
	})
</script>