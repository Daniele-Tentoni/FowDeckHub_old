// Creo la chiamata ajax per creare un nuovo bug.
function new_bug(string_data, dialog){
    var method = "POST";
	var action = "adders/add_bug_report.php?new_bug";
    var success = function(msg) {
        // Modifico la mb per il successo o comunico il fallimento.
        if(msg["result"] == true) {
            $("#log_bug_report").removeClass().html("<p class=\"alert alert-" + msg["class"] + "\">" + msg["content"] + "</p>");
            $("#log_bug_report_buttons").html("<button class=\"btn btn-default btn-lg mb-control-close\">Close</button>");
            $(".mb-control-close").on("click",function(){
               $(this).parents(".message-box").removeClass("open");
               return false;
            });  
        } else {
            $("#log_bug_report").append("riprova");
        }
        
        // Performo la chiusura della finestra.
        //$(".mb-control-close").click();
    };
    var error = function (msg) {
        // Comunico l'errore.
        console.log(msg);
		console.log("error");
    };
	
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
        var updated_state = result["update_state"];
        switch(update_state) {
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
            case "1":
                classToAdd = "lb_green";
                htmlToAdd = "Open";
                break;
            default:
                classToAdd = "lb_default";
                htmlToAdd = "Default";
                break;
        }
        $("#trow_" + id + " span").addClass("label").addClass(classToAdd).html(htmlToAdd);
		$("#trow_" + id + " state").fadeIn();
		$("#state_" + id + "_" + result["update_state"]).fadeOut();
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