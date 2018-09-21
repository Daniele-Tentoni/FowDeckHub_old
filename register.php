<!DOCTYPE html>
<html lang="en" class="body-full-height">
    <head>        
        <!-- META SECTION -->
        <title>Register - Fow Deck Hub</title>            
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        
        <link rel="icon" href="favicon.ico" type="image/x-icon" />
        <!-- END META SECTION -->
        
        <!-- CSS INCLUDE -->        
        <link rel="stylesheet" type="text/css" id="theme" href="css/theme-default.css"/>
        <!-- EOF CSS INCLUDE -->                                    
    </head>
    <body>
        
        <div class="login-container">
        
            <div class="login-box animated fadeInDown">
                <div class="login-logo"></div>
                <div class="login-body">
                    <div class="login-title"><strong>Register</strong> a new account!</div>
                    <form id="register-form" class="form-horizontal">
						<div class="form-group">
							<div class="col-md-12">
								<input id="username" type="text" class="form-control" placeholder="Username"/>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-12">
								<input id="mail" type="email" class="form-control" placeholder="E-mail"/>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-12">
								<input id="password" type="password" class="form-control" placeholder="Password"/>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-12">
								<input id="confirm-password" type="password" class="form-control" placeholder="Confirm Password"/>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-6">
								<!--<a href="#" class="btn btn-link btn-block btn-disabled">Forgot your password?</a>-->
							</div>
							<div class="col-md-6">
								<button type="submit" id="login-button" class="btn btn-info btn-block">Log In</button>
							</div>
						</div>
						<div id="errors">
						</div><!--
						<div class="login-or">OR</div>
						<div class="form-group">
							<div class="col-md-4">
								<button class="btn btn-info btn-block btn-twitter btn-disabled"><span class="fa fa-twitter"></span> Twitterr</button>
							</div>
							<div class="col-md-4">
								<button class="btn btn-info btn-block btn-facebook btn-disabled"><span class="fa fa-facebook"></span> Facebook</button>
							</div>
							<div class="col-md-4">                            
								<button class="btn btn-info btn-block btn-google btn-disabled"><span class="fa fa-google-plus"></span> Google</button>
							</div>
						</div>
						<div class="login-subtitle">
							Don't have an account yet? <a href="#">Create an account</a>
						</div>-->
                    </form>
                </div>
                <div class="login-footer">
                    <div class="pull-left">
                        &copy; 2014 AppName
                    </div>
                    <div class="pull-right">
                        <a href="#">About</a> |
                        <a href="#">Privacy</a> |
                        <a href="#">Contact Us</a>
                    </div>
                </div>
            </div>
            
        </div>
        <script type="text/javascript" src="js/plugins/jquery/jquery.min.js"></script>
		<script type="text/javascript">
			$("#register-form").submit(function (e) {
				console.log(e);
				e.preventDefault();
				var password = $("#password").val(), cpassword = $("#confirm-password").val();
				if(password === cpassword) {
					$.ajax({
						method: "POST",
						url: "process_register.php",
						data: "u=" + $("#username").val() + "&p=" + $("#password").val() + "&e=" + $("#mail").val(),
						datatype: "json",
						success: function(msg){
							console.log("Sono successata.");
							if(msg.result === "done") {
								window.location = "index.php";
							} else if(msg.result === "fail" && msg.error === "credentials") {
								$("#errors").append('<div class="alert alert-warning"> E-mail o password errata. Si prega di riprovare. </div>');
							} else {
								$("#errors").append('<div class="alert alert-warning"> Non è stato possibile collegarsi al database e verificare le credenziali. Si prega di riprovare più tardi. </div>');
							}
						},
						error: function(msg){
							console.log("Login error:");
							$("#errors").append('<div class="alert alert-warning"> C\'è stato un gravissimo errore.</div>');
						}
					});
				} else {
					$("#errors").append('<div class="alert alert-warning"> Le password non corrispondono.</div>');
				}
			});
		</script>
    </body>
</html>