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
		success: success,
		error: error
	});
}

// Creo la chiamata ajax per cambiare lo stato al bug.
function change_state(id, state) {
	var method = "POST";
	var action = "adders/add_bug_report.php?change_state";
	var string_data = "id=" + id + "&state=" + state;
	var success = function(result) {
        $("#trow_" + id + " span").removeClass();
        var classToAdd = "";
        var htmlToAdd = "";
		// Qui ci andrà per bene il codice per cambiare lo stato anche nella view.
        switch(result["update_state"]) {
            case "4":
                classToAdd = "lb_red";
                htmlToAdd = "Resolved";
                break;
            case "3":
                classToAdd = "lb_orange";
                htmlToAdd = "Assigned";
                break;
            case "2":
                classToAdd = "lb_yellow";
                htmlToAdd = "Open";
                break;
            default:
                classToAdd = "lb_default";
                htmlToAdd = "Default";
                break;
        }
        $("#trow_" + id + " span").addClass("label").addClass(classToAdd).html(htmlToAdd);
        console.log(result);
	};
	var error = function(error) {
		// Qui ci andrà per bene il codice per capire dov'è l'errore.
		console.log("Un errore è stato riscontrato nel sistema.");
        console.log(error);
	}
	
	ajax_call(method, action, string_data, success, error);
	console.log("Eseguita la chiamata ajax.");
}
