#!/usr/local/bin/php

<html>
<head>
	<title>Web Print</title>
	<!-- Bootstrap-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
	<div class="container">
		<div class="row">
			<div class="col-xs-4 col-xs-offset-4">
				<div class="page-header">
					<h1>Print Files</h1>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-xs-9 col-xs-offset-1">
				<form action="./do_print.php" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label for="username_input">CISE Login</label>
						<input name="username" type="username" class="form-control" id="username_input" placeholder="Username">
					</div>

					<div class="form-group">
						<label for="password_input">Password</label>
						<input name="password" type="password" class="form-control" id="password_input" placeholder="Password">
					</div>

					<div class="row">
						<div class="col-sm-3 col-sm-offset-0 col-xs-3 col-xs-offset-2">
							<div class="form-group">
								<label for="printer">Printer</label><br />
								<input name="printer" type="radio" id="ps114" value="ps114" checked="checked"> ps114
								<br />
								<input name="printer" type="radio" id="ps309" value="ps309"> ps309
							</div>
						</div>
						<div class="col-sm-5 col-sm-offset-1 col-xs-6">
							<div class="form-group">
								<label for="upload">File</label>
								<input name="upload" type="file" id="input_file">
							</div>
						</div>
						<div class="col-sm-2 col-sm-offset-1 col-xs-6">
							Number of copies:
							<input type="number" name="quantity" min="1" max="100" value="1">
						</div>

					</div>
					<br />
					<div class="row">
						<button type="submit" class="btn btn-block btn-primary">Submit</button>
					</div>
				</form>
			</div>

		</div>
	</div>


	<!-- Bootstrap JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>

</html>
