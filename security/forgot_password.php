<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/register.css">
	<title>Forgot password</title>
</head>

<body>

	<div id="particles-js"></div>

	<section class="register">
		<div class="container">
			<div class="register-container-wrapper clearfix">
				<div class="welcome"><strong>Forgot your password ?</strong></div>

				<form class="form-horizontal register-form">
					<div class="form-group relative email">
						<input id="email" class="form-control input-lg" type="email" placeholder="Email">
					</div>
					<br>
                    <div class="form-group relative email">
						<input id="email" class="form-control input-lg" type="email" placeholder="Confirm Email">
					</div>
					<br>
					<div class="forgot-group">
						<label> <a class="forgot" href="../security/login.php" title="forgot">Get your password reset link</a> </label>
					</div>
				</form>
			</div>
		</div>

	</sec>
</body>
</html>

<?php require_once '../inc/footer.php' ?>
