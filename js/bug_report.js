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

function ajax_try(number){
    console.log(11);
}