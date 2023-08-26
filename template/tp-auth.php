<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title><?=siteTitleLogin?></title>
  <link rel="stylesheet" href=<?=siteUrl("assets/css/styleAuth.css")?>>


</head>
<body>
<!-- partial:index.partial.html -->
<div id="background">
	<div id="panel-box">
		<div class="panel">
			<div class="auth-form on" id="login">
				<div id="form-title">Log In</div>
				<form action="<?=siteUrl("auth.php?action=login")?>" method="POST">
					<input name="email" type="text" required="required" placeholder="Email"/>
					<input name="pass" type="password" required="required" placeholder="Password"/>
					<button type="Submit">Log In</button>
				</form>
			</div>
			<div class="auth-form" id="signup" >
				<div id="form-title">Register</div>
				<form action="<?=siteUrl("auth.php?action=register")?>" method="POST">
					<input name="username" type="text" required="required" placeholder="Username"/>
					<input name="pass" type="password" required="required" placeholder="Password"/>
					<input name="email" type="text" required="required" placeholder="Email"/>
					<button type="Submit">Sign Up</button>
				</form>
			</div>
		</div>
		<div class="panel">
			<div id="switch">Sign Up</div>
			<div id="image-overlay"></div>
			<div id="image-side"></div>
		</div>
	</div>
</div>
<!-- partial -->
  <script src='https://code.jquery.com/jquery-3.3.1.min.js'></script><script  src=<?=baseUrl."assets/js/scriptAuth.js"?>></script>

</body>
</html>
