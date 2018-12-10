class card {
	constructor(id, name) {
		this.id = id;
		this.name = name;
	}
	
	get id() {
		return this.id;
	}
	set id(value) {
		this.id = value;
	}
}

class deck {
	constructor(id, name) {
		this.id = id;
		this.name = name;
		this.cards = [];
	}
	
	get id() {
		return this.id;
	}
	set id(value) {
		this.id = value;
	}
	
	add_card(card){
		this.cards.push(card);
	}
	remove_card(card){
		this.cards.slice(card);
	}
}

var deckname = "";
var format = "";
var visible = "";
var cardName = "";
var rl = [];
var md = [];
var st = [];
var sd = [];
var rn = [];

$(document).ready(function (){
	// Al caricamento della pagina imposto le variabili base.
	// Poi carico anche le prime carte nell datatable.
	deckname = $("#deckname").val();
	formatId = $("#format").val();
	visible = $("#visibility").val();
	cardname = $("#cardname").val();
	load_cards("");
});

function name_change(event) {
	var target = $(event.currentTarget);
	deckname = $(target).val();
	console.log(deckname);
}
/*
function format_change(event) {
	var target = $(event.currentTarget);
	format = $(target).val();
	load_cards(format);
	console.log(format);
}
*/
function visibility_change(event) {
	var target = $(event.currentTarget);
	visible = $(target).val();
	console.log(visible);
}

function add_rl_card(id, name) {
	var tmp = new card(id, name);
	rl.push(tmp);
	var riga = "<tr id=\"trow_" + item["Id"] + "\">";
	riga += "<td>" + item["Name"] + "</td>";
	riga += "<td><span class=\"label label-warning\">" + item["Type"] + "</td>";
	riga += "<td><span class=\"label label-success\">" + item["Attribute"] + "</span></td>";
	riga += "<td>";
	riga += "<span class=\"btn btn-primary btn-rounded pull-right\" onclick=\"add_rl_card(" + item["Id"] + "\"><i class=\"fa fa-minus\"></i></span>";
	riga += "</td>";
	riga += "</tr>";
	$("#dl-datatable").append(riga);
}

function add_md_card(id, name) {
	var tmp = new card(id, name);
	md.push(tmp);
	var riga = "<tr id=\"trow_" + item["Id"] + "\">";
	riga += "<td>" + item["Name"] + "</td>";
	riga += "<td><span class=\"label label-warning\">" + item["Type"] + "</td>";
	riga += "<td><span class=\"label label-success\">" + item["Attribute"] + "</span></td>";
	riga += "<td>";
	riga += "<span class=\"btn btn-primary btn-rounded pull-right\" onclick=\"add_rl_card(" + item["Id"] + "\"><i class=\"fa fa-minus\"></i></span>";
	riga += "</td>";
	riga += "</tr>";
	$("#dl-datatable").append(riga);
}

function add_st_card(id, name) {
	var tmp = new card(id, name);
	st.push(tmp);
	var riga = "<tr id=\"trow_" + item["Id"] + "\">";
	riga += "<td>" + item["Name"] + "</td>";
	riga += "<td><span class=\"label label-warning\">" + item["Type"] + "</td>";
	riga += "<td><span class=\"label label-success\">" + item["Attribute"] + "</span></td>";
	riga += "<td>";
	riga += "<span class=\"btn btn-primary btn-rounded pull-right\" onclick=\"add_rl_card(" + item["Id"] + "\"><i class=\"fa fa-minus\"></i></span>";
	riga += "</td>";
	riga += "</tr>";
	$("#dl-datatable").append(riga);
}

function add_sd_card(id, name) {
	var tmp = new card(id, name);
	sd.push(tmp);
	var riga = "<tr id=\"trow_" + item["Id"] + "\">";
	riga += "<td>" + item["Name"] + "</td>";
	riga += "<td><span class=\"label label-warning\">" + item["Type"] + "</td>";
	riga += "<td><span class=\"label label-success\">" + item["Attribute"] + "</span></td>";
	riga += "<td>";
	riga += "<span class=\"btn btn-primary btn-rounded pull-right\" onclick=\"add_rl_card(" + item["Id"] + "\"><i class=\"fa fa-minus\"></i></span>";
	riga += "</td>";
	riga += "</tr>";
	$("#dl-datatable").append(riga);
}

function add_rn_card(id, name) {
	var tmp = new card(id, name);
	rn.push(tmp);
	var riga = "<tr id=\"trow_" + item["Id"] + "\">";
	riga += "<td>" + item["Name"] + "</td>";
	riga += "<td><span class=\"label label-warning\">" + item["Type"] + "</td>";
	riga += "<td><span class=\"label label-success\">" + item["Attribute"] + "</span></td>";
	riga += "<td>";
	riga += "<span class=\"btn btn-primary btn-rounded pull-right\" onclick=\"add_rl_card(" + item["Id"] + "\"><i class=\"fa fa-minus\"></i></span>";
	riga += "</td>";
	riga += "</tr>";
	$("#dl-datatable").append(riga);
}

function load_cards(formatId) {
	// Se il formato è null allora carico tutte le carte.
	var datas = formatId != "" ? "format=" + formatId : "";
	$.ajax({
		method: "POST",
		url: "loaders/load_cards.php",
		dataType: "json",
		data: datas,
		success: function (result) {
			if(result["result"] === true) {
				result["content"].forEach(function (item) {
					var riga = "<tr id=\"trow_" + item["Id"] + "\">";
					riga += "<td>" + item["Name"] + "</td>";
					riga += "<td><span class=\"label label-warning\">" + item["Type"] + "</td>";
					riga += "<td><span class=\"label label-success\">" + item["Attribute"] + "</span></td>";
					riga += "<td>";
					riga += "<span class=\"btn btn-primary btn-rounded pull-right\" onclick=\"add_rl_card(" + item["Id"] + "\"><i class=\"fa fa-plus\"></i> RL</span>";
					riga += "<span class=\"btn btn-primary btn-rounded pull-right\" onclick=\"add_md_card(" + item["Id"] + "\"><i class=\"fa fa-plus\"></i> MD</span>";
					riga += "<span class=\"btn btn-primary btn-rounded pull-right\" onclick=\"add_st_card(" + item["Id"] + "\"><i class=\"fa fa-plus\"></i> ST</span>";
					riga += "<span class=\"btn btn-primary btn-rounded pull-right\" onclick=\"add_sd_card(" + item["Id"] + "\"><i class=\"fa fa-plus\"></i> SD</span>";
					riga += "<span class=\"btn btn-primary btn-rounded pull-right\" onclick=\"add_rn_card(" + item["Id"] + "\"><i class=\"fa fa-plus\"></i> RN</span>";
					riga += "</td>";
					riga += "</tr>";
					$("#dl-datatable").append(riga);
				});
				
				// Finito il loading procedo alla generazione della datatable.
				if($(".datatable").length > 0){
					$(".datatable").dataTable();
					$(".datatable").on('page.dt',function () {
						onresize(100);
					});
				}
			} else if(result["result"] === false) {
				console.log("Fallimento");
				$("#dl-datatable").append(result["Errore"]);
			}
		},
		error: function (msg) {
			debugger;
			console.log(msg);
			$("#dl-datatable").append("Errore nella chiamata al server.");
		}
	});
}