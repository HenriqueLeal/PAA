<html>
<head>
	<title>Trabalho Algoritmos Gulosos e Programação Dinâmica</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<h1>Problema de Associação de Tarefas</h1>
		</div>
		<div class="col-lg-12">
			<form class="form-inline">
				<div class="form-group">
					<input type="number" class="form-control" id="numPerson" placeholder="Quantidade de Pessoas">
				</div>
				<div class="form-group">
					<input type="number" class="form-control" id="numJobs" placeholder="Quantidade de Tarefas">
				</div>
			  <button type="button" class="btn btn-primary" id="generateForm">Definir Informações</button>  
			  <button type="button" class="btn btn-danger" id="reset">Redefinir Informações</button>
			</form>
		</div>
	</div>
</div>

<div class="container">
	<div class="row" id="appendForm">

	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-lg-12" id="result-div"></div>
	</div>
</div>

<script type="text/javascript" src="assets/js/jquery-1.12.0.min.js"></script>
<script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>

<script type="text/javascript">
	var block = 0;

	$('#reset').click(function(event) {
		location.reload();
	});
	$('#generateForm').click(function(event) {
		var numJobs, numPerson;
		numJobs 	= $('#numJobs').val();
		numPerson 	= $('#numPerson').val();

		if(numPerson != numJobs){
			alert('Os valores devem ser iguais');
			return;
		}

		if(block == 0){
			if(numJobs != '' || numPerson != ''){
				for(var i=0; i<numPerson; i++){
					var col = $('<div class="col-lg-2">').appendTo('#appendForm');
					col.append('<h4>Funcionário '+(i + 1)+'</h4>');
					for(var j=0; j<numJobs; j++){
						var x = document.createElement("input");
						x.setAttribute("type", "text");
						x.setAttribute("class", "form-control");
						x.setAttribute("id", "job"+i+j);
						x.setAttribute("placeholder", "Custo da Tarefa - "+(j + 1));
						col.append('<div class="form-group">');
						col.append('<label for="Tarefa">Custo da Tarefa '+(j+ 1) +'</label>');
						col.append(x);
						col.append('</div>');
					}
					$('#appendForm').append('</div>');
				}
				var col = $('<div class="col-lg-12">').appendTo('#appendForm');
				col.append('<br><br>');
				var result = document.createElement("button");
				result.setAttribute("type", "button");
				result.setAttribute("class", "btn btn-default");
				result.setAttribute("id", "result");
				result.onclick = function() {
					var works = [];
					for(var i=0; i<numPerson; i++)
					{
						works.push([]);

						for(var j=0; j<numJobs; j++)
						{
							works[i].push($('#job'+i+j).val());
						}
					}
					console.log(works);
					$.post('assignment-ajax.php', {works: works, numJobs:numJobs, numPerson:numPerson}, function(data, textStatus, xhr) {
						$('#result-div').html(data);
					}, "html");
				};
				var t = document.createTextNode("Calcular Resultado");
				result.appendChild(t);
				col.append(result);
				col.append('</div>');
				block = 1;
			}
		}else{
			alert("É necessário redefinir o formulário para gerar outro.");
		}
	});
</script>

<footer>
	<div class="container">
		 <div class="imagem">
      <img src="assets/img/unesp-logo.png"> <br />
   Henrique Leal Tavares 
   </div>
	</div>
</footer>

</body>
</html>