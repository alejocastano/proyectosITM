<?php include 'header.php'; ?>
<?php
$mysqli=new mysqli("Localhost","root","123","arrendamientos");
	if($mysqli->connect_error){

		printf("No es posible conectar con la base de datos %s\n",$mysqli->connect_error);
		exit();
	}

	$query="SELECT * FROM propiedad";
	$read=$mysqli->query($query);




?>

<div class="container-fluid">
	<div class="banner">
		<img src="images/banner.jpg">
	</div>

</div>

<div class="container">

<h2>  Listado de propiedades  </h2>
<hr>
<div class="row">
	<div class="col-sm-12">
		<a href="insert.php" class="btn btn-primary">Ingresar nueva propiedad</a>
	</div>
</div>

<div class="row">
	<div class="col-sm-12">
	</br>
	</hr>
	</div>
	</div>

<div class="row">
	<div class="col-sm-12">
<table class="table table-striped table-hover ">
  <thead>
    <tr>

      <th>Nombre de la propiedad</th>
      <th>Arriendo mensual</th>
      <th>Dirección</th>
      <th>Vista</th>
      <th>Detalles</th>
    </tr>
  </thead>
  <tbody>
  <?php while ($row=$read->fetch_assoc()) { ?>

    <tr class="info">
      <td><?php echo  $row['nombre'];   ?></td>
      <td><?php echo  $row['valorMensual'];   ?></td>
      <td><?php echo  $row['direccion'];   ?></td>
      <td><img src="uploads/<?php echo  $row['imagen']; ?>"</td>
      <td><a href="single.php?posts=<?php echo  $row['id'];  ?>">Detalles</a></td>
    </tr>

    <?php } ?>
  </tbody>
</table>
</div>
</div>

</div>

<?php  include 'footer.php' ; ?>
