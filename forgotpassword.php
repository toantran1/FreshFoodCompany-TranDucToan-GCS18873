
<!DOCTYPE html>
<html>
<head>
<base href="http://localhost:81/website_mvc/"/>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="css/login.css">

	<title>Reset Password</title>
</head>
<body>
	<div class="container">
		
	
		<form action="passwordresettoken.php" method="POST" class="login-email">
			<p class="login-text" style="font-size: 1.5rem; font-weight: 600;">Enter your e-mail to reset password</p>
			<div class="input-group">
				<input type="email" name="email"  placeholder="Enter your email..." required>
			</div>

			<div class="input-group">
				<button name="login" class="btn">Continute</button>
			</div>
            <center><p class="login-register-text"><a href="login.html">Back to login.</a></p></center>
	
		</form>
	
	</div>
</body>
</html>