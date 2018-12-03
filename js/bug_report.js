// Creo la chiamata ajax per creare un nuovo bug.
function new_bug(string_data){
    var success = new function() {
        $(".e-panel").show();
		if(msg["result"] === true) {
			$(".e-body").html("<span class=\"alert alert-success\">" + msg["content"] + "</span>");
			if(ret != null) {
				window.location = ret + "?" + func + "=" + msg["id"];
			}
		} else {
			$(".e-body").html("<span class=\"alert alert-danger\">" + msg["content"] + "</span>");
			console.log(msg["data"]);
		}
    };
    var error = function () {
        console.log(msg);
		console.log("error");
		$(".e-panel").show();
		$(".e-body").html("<span class=\"alert alert-danger\">" + msg["content"] + "</span>");
    };
	
	var action = "bug_report.php?new_bug";
	
	// Eseguo una chiamata ajax al bug report.
	ajax_call(method, action, string_data, success, error);
}

// Eseguo schietto la chiamata ajax.
function ajax_call(method, action, string_data, success, error){
    $.ajax({
		type: method,
		url: action,
		dataType: "json",
		data: string_data,
		success: succes,
		error: error
	});
}

// Prova di una funzione.
function ajax_try(number){
    console.log(11);
}

// Creo la chiamata ajax per cambiare lo stato al bug.
function change_state(id, state) {
	var method = "POST";
	var action = "adders/add_bug_report.php?change_state";
	var string_data = "id=" + id + "&state=" + state;
	var success = new function() {
		// Qui ci andrà per bene il codice per cambiare lo stato anche nella view.
		console.log("Cambiato correttamente lo stato.");
	};
	var error = new function() {
		// Qui ci andrà per bene il codice per capire dov'è l'errore.
		console.log("Un errore è stato riscontrato nel sistema.");
	}
	
	ajax_call(method, action, string_data, success, error);
	console.log("Eseguita la chiamata ajax.");
}