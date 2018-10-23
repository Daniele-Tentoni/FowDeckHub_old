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

$(document).ready(function () {
	$.ajax({
		type: "GET",
		url: "loaders/load_users.php",
		dataType: "json",
		data: "",
		success:function(result){
			if(result["result"] === true) {
				result["content"].forEach(function (item) {
					console.log(item);
					var riga = "<tr>";
					riga += "<td>" + item["Id"] + "</td>";
					riga += "<td>" + item["Username"] + "</td>";
					riga += "<td>" + item["FirstName"] + "</td>";
					riga += "<td>" + item["LastName"] + "</td>";
					riga += "<td>" + item["RegisterDate"] + "</td>";
					riga += "<td>" + item["LastAccess"] + "</td>";
					var classToAdd = "";
					if(item["Role"] === "Administator") {
						classToAdd = "admin";
					} else {
						classToAdd = "user";
					}
					riga += "<td class=\"" + classToAdd + "\">" + item["Role"] + "</td>";
					riga += "</tr>";
					$("#users_table_body").append(riga);
				});
			} else if(result["result"] === false) {
				console.log("Fallimento");
				$("#users_panel_body").append(result["Errore"]);
			}
		},
		error:function(result){
			console.log(result);
			$(result).appendTo($("#users_panel_body"));
		}
	});
});