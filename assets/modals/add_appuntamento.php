<div class="modal fade" tabindex="-1" role="dialog" id="AddAppuntamento" aria-labelledby="AddAppuntamento">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Aggiungi appuntamento</h4>
			</div>
			<div class="modal-body" id="body-appuntamento">
				<div class="container"><!--
					Nome
					--><div class="row">
						<div class="col-sm-12">
							<div class="input-group">
								<span class="input-group-addon">Nome</span>
								<input class="form-control" type="text" id="NomeAppuntamento" name="NomeAppuntamento" required />
							</div>
						</div>
					</div><!--
					Descrizione
					--><div class="row">
						<div class="col-sm-12">
							<div class="input-group">
								<span class="input-group-addon">Descrizione</span>
								<input class="form-control" type="text" id="DescrizioneAppuntamento" name="DescrizioneAppuntamento" required />
							</div>
						</div>
					</div><!--
					Data Appuntamento
					--><div class="row">
						<div class="col-sm-12">
							<div class="input-group">
								<span class="input-group-addon">Data Appuntamento</span>
								<input class="form-control" type="date" id="DataAppuntamento" name="DataAppuntamento" required />
							</div>
						</div>
					</div><!--
					Ora Appuntamento
					--><div class="row">
						<div class="col-sm-12">
							<div class="input-group">
								<span class="input-group-addon">Ora Appuntamento</span>
								<input class="form-control" type="date" id="OraAppuntamento" name="OraAppuntamento" required />
							</div>
						</div>
					</div><!--
					Attività
					--><div class="row">
						<div class="col-sm-12">
							<div class="input-group">
								<span class="input-group-addon">Attività</span>
								<select class="form-control" id="attivita-sel" name="AttivitaAppuntamento"><!--
									Da riempire con il js
								--></select>
							</div>
						</div>
						<script type="text/javascript">
							function loadAttivita() {
								
							}
							
							$(document).ready(function(){
								loadAttivita();
								$.ajax({
									type: "GET",
									url: "assets/getters/get_attivita.php",
									dataType: "json",
									data: "",
									success: function(result){
										if(result["result"] === true) {
											console.log(result);
											result["content"].forEach(function (item) {
												var riga = "<option value=\"" + item["Codice"] + "\">";
												riga += item["Nome"] + "; " + item["Nome"] + " da " + item["Gruppo"];
												riga += "</option>";
												$(riga).appendTo($("#attivita-sel"));
											});
										} else if(result["result"] === false) {
											console.log("Fallimento");
											console.log(result);
										}
									},
									error: function(result){
										console.log("Errore");
										console.log(result);
									}
								});
							})
						</script>
					</div><!--
					Luogo
					--><div class="row">
						<div class="col-sm-12">
							<div class="input-group">
								<span class="input-group-addon">Luogo</span>
								<select class="form-control" id="luogo-sel" name="LuogoAttivita"><!--
									Da riempire con il js
								--></select>
							</div>
						</div>
						<script type="text/javascript">
							function loadLuoghi(){
								$.ajax({
									type: "GET",
									url: "assets/getters/get_luoghi.php",
									dataType: "json",
									data: "",
									success:function(result){
										if(result["result"] === true) {
											console.log(result);
											result["content"].forEach(function (item) {
												var riga = "<option value=\"" + item["Codice"] + "\">";
												riga += item["Nome"] + "</option>";
												$(riga).appendTo($("#luogo-sel"));
											});
										} else if(result["result"] === false) {
											console.log("Fallimento");
											console.log(result);
										}
									},
									error:function(result){
										console.log("Errore");
										console.log(result);
									}
								});
							}
							$(document).ready(function(){
								loadLuoghi();
							})
						</script>
					</div>
				</div>
			</div>
		<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		<button type="button" class="btn btn-primary" id="addAppuntamentoBtn">Aggiungi</button>
		</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>
<script type="text/javascript">
	$(document).ready(function (){
		$("#addAppuntamentoBtn").click(function(e) {
			console.log(e);
			var arguments = "nome=" + $("#NomeAppuntamento").val() + 
				"&descrizione=" + $("#DescrizioneAppuntamento").val() +
				"&data=" + $("#DataAppuntamento").val() + 
				"&ora=" + $("#OraAppuntamento").val() + 
				"&attivita=" + $("#AttivitaAppuntamento").val() + 
				"&luogo="+$("#LuogoAttivita").val();
			$.ajax({
				type: "POST",
				url: "assets/php/add_appuntamento_db.php",
				dataType: "json",
				data: arguments,
				success:function(result){
					if(result["result"] === true) {
						var success = "Elemento aggiunto correttamente. Ora puoi aggiungere un altro elemento oppure chiudere questa finestra.";
						$("#body-appuntamento").append("<div class=\"row\"><div class=\"alert alert-success\">" + success + "</div></div>");
						console.log("Aggiunta riuscita.");
						console.log(result["content"]);
					} else if(result["result"] === false) {
						console.log(result);
						console.log("Fallimento");
					} else {
					  	var labelErrore = "Risultato inatteso. Codice errore: " + result["error"] + "<br />" + result["msg"];
						$("#body-appuntamento").append("<div class=\"alert alert-danger\">" + labelErrore + "</div>");
						console.log("Risultato inatteso.");
					}
				},
				error:function(result){
					console.log("Errore aggiunta appuntamento.");
					console.log(result);
				}
			});
		});
	})
</script>