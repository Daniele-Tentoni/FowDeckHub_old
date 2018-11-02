<div class="modal" data-sound="alert" id="single_card_modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
				<h4 class="modal-title card-title" id="defModalHead">Vista carta</h4>
			</div>
			<div class="modal-body">
				<div class="e-panel panel" style="display:none">
					<div class="e-body panel-body">
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-body posts">

						<div class="post-item">
							<div class="post-title">
								Outer space
							</div>
							<div class="post-date"> <span class="card-number"></span> / <span class="card-cost"></span> / <span class="card-visibility"></span></div>
							<div class="post-text">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<div class="pull-right">
					<button class="btn btn-success btn-lg" onclick="new_row('true')">Add</button>
					<button class="btn btn-default btn-lg" data-dismiss="modal">Exit</button>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	function modal_filler(id) {
		$.ajax({
			type: "POST",
			url: "loaders/load_cards.php",
			dataType: "json",
			data: "id=" + id,
			success:function(msg) {
				if(msg["result"] === true) {
					console.log(msg["content"]);
					var card = msg["content"];
					$(".post-title").html(card["Name"]);
					$(".card-number").html(card["Number"] + "-" + card["Set"]);
					$(".card-cost").html(card["Cost"]);
					$(".card-visibility").html(card["Visibility"]);
					if(msg["result"] === true) {
						$(".e-body").html("<span class=\"alert alert-success\">" + msg["content"] + "</span>");
					}
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
	}
</script>