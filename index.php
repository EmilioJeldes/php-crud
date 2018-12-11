<?php
include 'server.php';

// Obtener parametro id
if (isset($_GET["edit"])) {
	$edit_state = true;
	
	$id = $_GET["edit"];
	$rec = $connection->query("SELECT nombre, apellido, id FROM users WHERE id=$id");
	$record = mysqli_fetch_array($rec);
	$nombre = $record["nombre"];
	$apellido = $record["apellido"];
	$id = $record["id"];
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="./css/styles.css">
	<title>Testing form</title>
</head>
<body>
	<?php if (isset($_SESSION["msg"])): ?>
		<div class="msg">
			<?php
				echo $_SESSION["msg"];
				unset($_SESSION["msg"])
			?>
		</div>
	<?php endif?>

	<!-- Form -->
	<form action="server.php" method="post" id="form1">
		<input type="hidden" name="id" value="<?php echo $id ?>">
		<!-- nombre -->
		<div class="form-group">
			<label for="nombre">Nombre</label>
			<input class="form-control" type="text" name="nombre" id="nombre" value="<?php echo $nombre ?>">
			<span class="error" id="nombreError"></span>
		</div>
		<!-- end nombre -->

		<!-- apellido -->
		<div class="form-group">
			<label for="apellido">Apellido</label>
			<input class="form-control" type="text" name="apellido" id="apellido" value="<?php echo $apellido ?>">
			<span class="error" id="apellidoError"></span>
		</div>
		<!-- end apellido -->

		<!-- submit && reset -->
		<div class="form-group">
			<?php if ($edit_state == false): ?>
				<input type="submit" value="Submit" name="save">
			<?php else: ?>
				<input type="submit" value="Update" name="update">
			<?php endif ?>
			<input type="reset" value="Reset">
		</div>

	</form>
	<!-- end form -->

	<br>
	<div class="container">
		<!-- list table -->
		<table>
			<!-- cabezeras table -->
			<thead>
				<tr>
					<th>id</th>
					<th>Nombre </th>
					<th>Apellido</th>
					<th>modificar</th>
				</tr>

			</thead>
			<!-- end cabezeras -->

			<!-- cuerpo tabla -->
			<tbody>
				<?php while ($row = mysqli_fetch_array($results)) {?>
					<tr>
						<td><?php echo $row["id"] ?></td>
						<td><?php echo $row["nombre"] ?></td>
						<td><?php echo $row["apellido"] ?></td>
						<td><a href=".?edit=<?php echo $row["id"] ?>">Modificar</a></td>
					</tr>
				<?php }?>
			</tbody>
			<!-- end cuerpo tabla -->
		</table>
		<!-- end list table -->
</body>
</html>
