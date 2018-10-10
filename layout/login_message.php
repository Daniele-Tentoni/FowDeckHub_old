<div class="message-box animated fadeIn" data-sound="alert" id="mb-signin">
	<div class="mb-container">
		<div class="mb-middle">
			<div class="mb-title"><span class="fa fa-sign-in"></span><strong>Log In</strong> to your account</div>
			<div class="mb-content">
				<form action="#" class="form-horizontal" method="post">
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="text" id="username" class="form-control" placeholder="Username"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="password" id="password" class="form-control" placeholder="Password"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <a href="#" class="btn btn-link btn-block">Forgot your password?</a>
                        </div>
                        <div class="col-md-6">
                            <button id="login_button" class="btn btn-info btn-block">Log In</button>
                        </div>
                    </div>
				</form>
				<script type="text/javascript">
					$("#login_button").click(function (e) {
						e.preventDefault();
						$.ajax({
							method: "POST",
							url: "process_login.php",
							data: "u=" + $("#username").val() + "&p=" + $("#password").val(),
							datatype: "json",
							success: function(msg){
								console.log("Sono successata.");
								if(msg.result === "done") {
									console.log("Ti sei loggato.");
									$("#errors").append("Ti sei loggato.");
								} else if(msg.result === "fail" && msg.error="credentials") {
									console.log("Hai inserito delle credenziali errate.");
									$("#errors").append("Hai inserito delle credenziali errate.");
								}
							},
							error: function(msg){
								console.log("Login error:");
								$("#errors").append("C'è stato un gravissimo errore.");
								console.log(msg);
							}
						})
					});
				</script>
				<div class="errors">
				</div>
			</div>
			<div class="mb-footer">
				<div class="pull-right">
					<a href="pages-login.html" class="btn btn-success btn-lg">Yes</a>
					<button class="btn btn-default btn-lg mb-control-close">No</button>
				</div>
			</div>
		</div>
	</div>
</div>