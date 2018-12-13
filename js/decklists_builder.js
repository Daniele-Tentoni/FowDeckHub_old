$(document).ready(function (){
	$("form").submit(function (e) {
		e.preventDefault();
	});
});

var ruler = [];
var rune_deck = [];
var main_deck = [];
var stone_deck = [];
var side_deck = [];

var decklist_import = function(code) {
	var text = $("#gacha_text").val();
	var elems = split("\n", text);
}

var decklist_import = function(code) {
	var form = $("#decklist_importer");

	$.ajax({
		method: form.method,
		url: form.action,
		datatype: "JSON",
		data: "code=" + code,
		success: function(result) {
			$($("#gachalog_html table tbody").children).each(function () {
				if(this != null && this.children != null) {
					console.log(this.children);
			    }
			});
		},
		error: function(error) {

		}
	});
}

<iframe id="gachalog_frame" width="95%" height="1000" marginwidth="0" marginheight="0" frameborder="0" scrolling="no" src="https://www.gachalog.com/share/47854097?with_image=1&amp;with_price=0&amp;with_text=1" style="height: 1236px;"></iframe>