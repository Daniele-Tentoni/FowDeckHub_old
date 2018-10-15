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

function new_row() {
	var box = $("#mb-new-row");
	box.addClass("open");

	box.find(".mb-control-yes").on("click",function(){
		box.removeClass("open");
		// Recupero i valori dal form.
		var values = [];
		$(".add-item").each(function(e) {
			values.push($(this).val());
			console.log($(this).val());
		});
		console.log(values);
		
		var form = $("#new-item");
		var action = form.attr("action");
		var method = form.attr("method");
		
		$.ajax({
			type: method,
			url: action,
			dataType: "json",
			data: "data=" + values,
			success:function(msg) {
				console.log(msg);
				console.log("success");
			},
			error:function(msg) {
				console.log(msg);
				console.log("error");
			}
		});
	});
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