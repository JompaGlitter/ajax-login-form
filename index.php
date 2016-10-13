<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Login with Ajax</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
</head>
<body>
	<div class="container">
		<div class="jumbotron">
			<h2 class="text-center">Ajax login</h2>

			<form id="form" method="POST">
				<div class="form-group">
					<label for="name">Name: </label>
					<input id="name" type="text" name="name" class="form-control">
				</div>
				<div class="form-group">
					<label for="password">Password: </label>
					<input id="password" type="password" name="password" class="form-control">
				</div>
				<div class="form-group">
					<button id="login" class="btn btn-primary">Login</button>
					<button id="logout" class="btn btn-warning">Logout</button>
					<button id="status" class="btn btn-info">Status</button>
				</div>
			</form>

			<div id="output"></div>
		</div>
	</div>
	
	<!-- Load scripts -->
	<script src="js/main.js"></script>

</body>
</html>