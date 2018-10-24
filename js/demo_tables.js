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
		values.push($(this).val());
		entities.push($(this).attr('id'));
		console.log($(this).val());
	});
	console.log(values);

	var form = $("#new-item");
	var action = form.attr("action");
	var method = form.attr("method");
	
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
			} else {
				$(".e-body").html("<span class=\"alert alert-danger\">" + msg["content"] + "</span>");
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