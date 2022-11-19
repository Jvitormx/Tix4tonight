<html>
<head>
	<meta charset="utf-8">
	<title>Redijir emails</title>
	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- Font-->
	<link rel="stylesheet" type="text/css" href="css/opensans-font.css">
	<link rel="stylesheet" type="text/css" href="fonts/line-awesome/css/line-awesome.min.css">
	<!-- Jquery -->
	<link rel="stylesheet" href="https://jqueryvalidation.org/files/demo/site-demos.css">
	<!-- Main Style Css -->
    <link rel="stylesheet" href="css/enviaremails.css"/>
</head>
<body class="form">
	<div class="page-content">
		<div class="form-v4-content">
			<div class="form-left">
			<form class="form-detail"  action="javamail.jsp" method="post">
				<h2>Redija emails promocionais</h2>
				<div class="form-group">
					<div class="form-row form-row-1">
						<label for="first_name">Assunto...</label>
						<input type="text" name="assunto" size="45" class="input-text">
					</div>
          					
				</div>
				<div class="form-group">
					<div class="form-row form-row-1 ">
					<label for="your_email">Texto do email...</label>
					<textarea name="comenta" class="input-text" cols="50" rows="10"> </textarea>
				</div>
				

				</div>
				<div class="form-row-last">
					<input type="submit" name="Submit" class="register" value="Enviar emails">
				</div>
			 </form>
		</div>
	</div>
	
	</div>
</body>
</html>

