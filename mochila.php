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
			<h1>Mochila Booleana</h1>
		</div>
		<div class="col-lg-6">
			<h2>Formulário de itens</h2>
			<form>
				<div class="form-group">
					<label for="Nome">Nome</label>
					<input type="text" class="form-control" id="name" placeholder="Nome do Item">
				</div>
				<div class="form-group">
					<label for="Peso">Peso</label>
					<input type="text" class="form-control" id="weight" placeholder="Peso do Item">
				</div>
				<div class="form-group">
					<label for="Valor">Valor</label>
					<input type="text" class="form-control" id="value" placeholder="Valor">
				</div>
				<button type="button" class="btn btn-default" id="add">Adicionar Item</button>
				<button type="button" class="btn btn-danger" id="reset">Resetar Tudo</button>
			</form>
		</div>
		<div class="col-lg-6">
			<h2>Tabela de Itens</h2>
			<table class="table table-hover">
				<thead>
					<th>#</th>
					<th>Nome</th>
					<th>Peso</th>
					<th>Valor</th>
				</thead>
				<tbody id="items"></tbody>
			</table>
		</div>

		<div class="col-lg-12">
			<h2>Resultado</h2>
			<form class="form-inline">
				<div class="form-group">
					<label for="PesoMochila">Mochila</label>
					<input type="text" class="form-control" id="weightBag" placeholder="Peso da Mochila">
				</div>
				<button type="button" class="btn btn-success" id="calculate">Calcular</button>
			</form>
			<div id="result"></div>
		</div>
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
	var name, weight, value, i=1, items = [], weights = [], values = [], weightBag;

	$('#add').click(function(event) {
		name 	= $('#name').val();
		weight 	= $('#weight').val();
		value 	= $('#value').val();
		$('#items').append(
					'<tr>\
						<td>'+i+'</td>\
						<td>'+name+'</td>\
						<td>'+weight+'</td>\
						<td>'+value+'</td>\
					</tr>');

		items.push(name);
		weights.push(weight);
		values.push(value);
		i++;
	});

	$('#calculate').click(function(event) {
		weightBag = $('#weightBag').val();
		$.post('mochilaAjax.php', {items: items, weights:weights, values:values, weightBag: weightBag}, function(data, textStatus, xhr) {
			$('#result').html(data);
		}, "html");
	});

	$('#reset').click(function(event) {
		location.reload();
	});

</script>
</body>
</html>