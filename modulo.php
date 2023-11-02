<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<form action="modulo.php" method="post" class="form-inline">
		<div class="row">
			<div class="form-group">
				<label for="inputCurso">Nome do Curso:</label>
				<input type="text" class="form-control" id="inputCurso" name="cadcurso">
				<button type="submit" class="btn btn-primary">OK</button>
			</div>
		</div>
	</form>

	<?php 
		include("conexao.php");
	
		if ($_POST['cadcurso']!=null) {
			$var = $_POST['cadcurso'];
			if (!$conexao){
				die('<strong>Problema de conexão.</strong> Desculpe, mas não foi possível conectar ao nosso servidor.
					</div>');
			}
			else{
				$inserirCurso = "insert into tab_modulo values ('','$var')";
				$insercaoCurso = mysqli_query($conexao,$inserirCurso);
				if(!$insercaoCurso){
					die('<strong>Problema ao inserir.</strong> Desculpe, mas não foi possível inserir no banco de dados');
				}
				else{
					mysqli_close($conexao);
				}
			}
		}

	?>
</body>
</html>