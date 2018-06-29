<html>
<head>
	<title>Trabalho PAA - Henrique Leal</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>

<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<h1>Subsequência Comum Máxima</h1>
		</div>
		<div class="col-lg-12">
			<h2>Formulário de itens</h2>
			<form class="form">
				<div class="form-group">
					<label for="SubsequenciaX">Subsequência X</label>
					<input type="text" class="form-control" id="subsequenceX" placeholder="Subsequência X">
				</div> <br />
				<div class="form-group">
					<label for="SubsequenciaY">Subsequência Y</label>
					<input type="text" class="form-control" id="subsequenceY" placeholder="Subsequência Y">
				</div>
			  <button type="button" class="btn btn-default" id="calculate">Gerar Resultado</button>
			  <BR /> <br />
			    <button type="button" class="btn btn-danger" id="reset">Resetar Tudo</button>
			</form>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-lg-12" id="result-div"></div>
	</div>
</div>

<footer>
	<div class="container">
		 <div class="imagem">
      <img src="assets/img/unesp-logo.png"> <br />
   Henrique Leal Tavares 
   </div>
	</div>
</footer>

<script type="text/javascript" src="assets/js/jquery-1.12.0.min.js"></script>
<script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>

<script type="text/javascript">
	var block = 0;

	$('#reset').click(function(event) {
		location.reload();
	});

	$('#calculate').click(function(event) {
		$.post('subsequence-ajax.php', {x: $('#subsequenceX').val(), y: $('#subsequenceY').val()}, function(data, textStatus, xhr) {
			$('#result-div').html(data);
		}, "html");
	});


</script>
</body>
</html>