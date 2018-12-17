function delete_row(row) {
	var box = $("#mb-remove-row");
	box.addClass("open");

	box.find(".mb-control-yes").on("click",function(){
		box.removeClass("open");
		$("#"+row).hide("slow",function(){
			$(this).remove();
		});
	});
}

function new_row(clear) {
	// Recupero i valori dal form.
	$(".e-panel").hide();
	$(".e-body").html("");
	var entities = [];
	var values = [];
	$(".add-item").each(function(e) {
        var val = 0;
        if($(this).attr("type") == "checkbox") {
            val = $(this).prop("checked") == true ? 1 : 0;
        } else {
            val = $(this).val();
        }
		values.push(val);
		entities.push($(this).attr('id'));
	});

	var form = $("#new-item");
	var action = form.attr("action");
	var method = form.attr("method");
	var ret = form.attr("data-return");
	var func = form.attr("data-function");
    if(!clear) {
	   console.log(action);
	   console.log(method);
    }
	
	var string_data = "";
	for(var i = 0; i < entities.length; i++) {
		string_data += "&" + entities[i] + "=" + values[i];
	}
	
	$.ajax({
		type: method,
		url: action,
		dataType: "json",
		data: string_data,
		success:function(msg) {
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
		},
		error:function(msg) {
			console.log(msg);
			console.log("error");
			$(".e-panel").show();
			$(".e-body").html("<span class=\"alert alert-danger\">" + msg["content"] + "</span>");
		}
	});

	if(clear == true) {
		$(".add-item").val("");
	}
}

function base_new_row(clear, success, error) {
    // Recupero i valori dal form.
	$(".e-panel").hide();
	$(".e-body").html("");
	var entities = [];
	var values = [];
	$(".add-item").each(function(e) {
        var val = 0;
        if($(this).attr("type") == "checkbox") {
            val = $(this).prop("checked") == true ? 1 : 0;
        } else {
            val = $(this).val();
        }
		values.push(val);
		entities.push($(this).attr('id'));
	});

	var form = $("#new-item");
	var action = form.attr("action");
	var method = form.attr("method");
	var ret = form.attr("data-return");
	var func = form.attr("data-function");
    if(!clear) {
	   console.log(action);
	   console.log(method);
    }
	
	var string_data = "";
	for(var i = 0; i < entities.length; i++) {
		string_data += "&" + entities[i] + "=" + values[i];
	}
	
	$.ajax({
		type: method,
		url: action,
		dataType: "json",
		data: string_data,
		success:function(msg) {
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
		},
		error:function(msg) {
			console.log(msg);
			console.log("error");
			$(".e-panel").show();
			$(".e-body").html("<span class=\"alert alert-danger\">" + msg["content"] + "</span>");
		}
	});

	if(clear == true) {
		$(".add-item").val("");
	}
}