var save_base_data = function(panel, id) {
	$(".e-panel").hide();
	$(".e-body").html("");
	var entities = [];
	var values = [];
	$(panel + " .add_item").each(function(e) {
        var val = 0;
        if($(this).attr("type") == "checkbox") {
            val = $(this).prop("checked") == true ? 1 : 0;
        } else {
            val = $(this).val();
        }
		values.push(val);
		entities.push($(this).attr('id'));
	});
    
    var string_data = "Id=" + id;
	for(var i = 0; i < entities.length; i++) {
		string_data += "&" + entities[i] + '=' + values[i];
	}
    console.log(string_data);

    var form = $(panel);
	var action = form.attr("action");
	var method = form.attr("method");
    if(form.length > 0) {
	   console.log(action);
	   console.log(method);
    }
    
    $.ajax({
		type: method,
		url: action,
		dataType: "json",
		data: string_data,
		success:function(msg) {
			$(panel + " .e-panel").show();
			if(msg["result"] === true) {
				$(panel + " .e-body").html("<span class=\"alert alert-success\">" + msg["message"] + "</span>");
			} else {
				$(panel + " .e-body").html("<span class=\"alert alert-warning\">" + msg["message"] + "</span>");
                console.log(msg.error);
                console.log(msg["number"]);
                console.log(msg["message"]);
			}
		},
		error:function(msg) {
			console.log(msg);
			console.log("error");
			$(panel + " .e-panel").show();
			$(panel + " .e-body").html("<span class=\"alert alert-danger\">" + msg["message"] + "</span>");
		}
	});
};

var save_ruler_breakdown = function(panel, id) {
    $(".e-panel").hide();
	$(".e-body").html("");
	var entities = [];
	var values = [];
	$(".breakdown").each(function(e) {
		values.push($(this).val());
		entities.push($(this).attr('id'));
	});
    
    var string_data = "Id=" + id;
	for(var i = 0; i < entities.length; i++) {
		string_data += "&" + entities[i] + '=' + values[i];
	}
    console.log(string_data);

    var form = $(panel);
	var action = form.attr("action");
	var method = form.attr("method");
    if(form.length > 0) {
	   console.log(action);
	   console.log(method);
    }
    
    $.ajax({
		type: method,
		url: action,
		dataType: "json",
		data: string_data,
		success:function(msg) {
			$(panel + " .e-panel").show();
			if(msg["result"] === true) {
				$(panel + " .e-body").html("<span class=\"alert alert-success\">" + msg["message"] + "</span>");
			} else {
				$(panel + " .e-body").html("<span class=\"alert alert-warning\">" + msg["message"] + "</span>");
                console.log(msg.error);
                console.log(msg["number"]);
                console.log(msg["message"]);
			}
		},
		error:function(msg) {
			console.log(msg);
			console.log("error");
			$(panel + " .e-panel").show();
			$(panel + " .e-body").html("<span class=\"alert alert-danger\">" + msg["message"] + "</span>");
		}
	});
};

$(document).ready(function(){
   $("form").submit(function (e) {
       e.preventDefault();
   }) 
});