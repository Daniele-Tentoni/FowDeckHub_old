function delete_row(row){
	var box = $("#mb-remove-row");
	box.addClass("open");

	box.find(".mb-control-yes").on("click",function(){
		box.removeClass("open");
		$("#"+row).hide("slow",function(){
			$(this).remove();
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
											<th width="90">Status</th>
											<th width="90">Role</th>
											<th width="150">Actions</th>
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