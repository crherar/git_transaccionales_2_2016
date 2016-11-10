<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Facebook SDK para Javascript</title>

	<!--<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>-->
	<script type="text/javascript" src="<?php echo base_url(); ?>Recursos/js/jquery-2.1.4.min.js"></script>
	<script src="<?php echo base_url(); ?>Recursos/js/mis_js/fbgit.js"></script>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">

	<link rel="stylesheet" href="<?php echo base_url(); ?>Recursos/css/mis_css/fbgitcss.css">
</head>
<body>
	<h1>Facebook SDK login con Javascript</h1>

	<a href="#" id="login" class="btn btn-primary">Iniciar sesión</a>
	
	<script>
	// Load the SDK asynchronously
	  (function(d, s, id) {
	    var js, fjs = d.getElementsByTagName(s)[0];
	    if (d.getElementById(id)) return;
	    js = d.createElement(s); js.id = id;
	    js.src = "//connect.facebook.net/en_US/sdk.js";
	    fjs.parentNode.insertBefore(js, fjs);
	  }(document, 'script', 'facebook-jssdk'));
	 </script>
</body>
</html>