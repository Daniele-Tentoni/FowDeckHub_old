var deckname = "";
var format = "";
var visible = "";
var cardName = "";

$(document).ready(function (){
	deckname = $("#deckname").val();
	formatId = $("#format").val();
	visible = $("#visibility").val();
	cardname = $("#cardname").val();
});

function format_change(event) {
	var target = $(event.currentTarget);
	format = $(target).val();
	console.log(format);
}

function visibility_change(event) {
	var target = $(event.currentTarget);
	visible = $(target).val();
	console.log(visible);
}

function cardname_keyup(event) {
	var target = $(event.currentTarget);
	cardName = $(target).val();
	console.log(cardName);
}

function name_change(event) {
	var target = $(event.currentTarget);
	deckname = $(target).val();
	console.log(deckname);
}

function load_cards(formatId) {
	$.ajax({
		method: "POST",
		action: "loaders/load_cards.php",
		dataType: "JSON",
		data: "format="+formatId,
		success: function (msg) {
			if(result["result"] === true) {
				result["content"].forEach(function (item) {
					var riga = "<tr id=\"trow_" + item["Id"] + "\">";
					riga += "<td><span onclick=\"modal_filler(" + item["Id"] + ")\" data-toggle=\"modal\" data-target=\"#single_card_modal\" ><i class=\"fa fa-search\"></i>New</span> " + item["Name"] + "</td>";
					riga += "<td>" + item["Set"] + "-" + item["Number"] + " " + item["Rarity"] + "</td>";
					riga += "<td><span class=\"label label-warning\">" + item["Type"] + "</td>";
					riga += "<td>" + item["Cost"] + "</td>";
					riga += "<td><span class=\"label label-success\">" + item["Attribute"] + "</span></td>";
					
					riga += "</tr>";
					$("#cards-table-body").append(riga);
				});
			} else if(result["result"] === false) {
				console.log("Fallimento");
				$("#cards-table-body").append(result["Errore"]);
			}
		},
		error: function (msg) {
			
		}
	});
											
											dataType: "json",
											data: "",
											success:function(result){
												if(result["result"] === true) {
													result["content"].forEach(function (item) {
														var riga = "<tr id=\"trow_" + item["Id"] + "\">";
														riga += "<td><span onclick=\"modal_filler(" + item["Id"] + ")\" data-toggle=\"modal\" data-target=\"#single_card_modal\" ><i class=\"fa fa-search\"></i>New</span> " + item["Name"] + "</td>";
														riga += "<td>" + item["Set"] + "-" + item["Number"] + " " + item["Rarity"] + "</td>";
														riga += "<td><span class=\"label label-warning\">" + item["Type"] + "</td>";
														riga += "<td>" + item["Cost"] + "</td>";
														riga += "<td><span class=\"label label-success\">" + item["Attribute"] + "</span></td>";
														riga += "<td><button class=\"btn btn-default btn-rounded btn-sm\"><span class=\"fa fa-pencil\"></span></button> <button class=\"btn btn-danger btn-rounded btn-sm\" onClick=\"delete_row('trow_" + item["Id"] + "');\"><span class=\"fa fa-times\"></span> </button></td>";
														riga += "</tr>";
														$("#cards-table-body").append(riga);
													});
												} else if(result["result"] === false) {
													console.log("Fallimento");
													$("#cards-table-body").append(result["Errore"]);
												}
											},
											error:function(result){
												console.log(result);
												$(result).appendTo($("#cards-table-body"));
											}
										});
}