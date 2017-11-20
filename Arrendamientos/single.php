<?php include 'header.php'; ?>

<?php

$mysqli=new mysqli("Localhost","root","123","arrendamientos");
	if($mysqli->connect_error){

		printf("No es posible conectar con la base de datos %s\n",$mysqli->connect_error);
		exit();
	}

if(isset($_GET['posts'])){

	$id=$_GET['posts'];
	$query2= "SELECT * FROM propiedad where id='$id'";
	$readd=$mysqli->query($query2);

}

?>

<style type="text/css">

.rooms img{
	width: 50px;
	height: 50px;
}

</style>
<div class="container">
	<table class="table table-striped table-hover ">
  <thead>
    <tr>
      <th>Direccion</th>
      <th>Acceso</th>
      <th>Espacio del piso</th>
      <th>Utilidad</th>
      <th>Descripcion</th>
      <th>Habitaciones</th>
    </tr>
  </thead>
  <tbody>
  <?php while ($row= $readd->fetch_assoc()) { ?>

    <tr>
      <td> <?php echo $row['direccion'];  ?></td>
      <td><?php echo $row['acceso'];  ?></td>
      <td><?php echo $row['piso'];  ?></td>
      <td><?php echo $row['utilidad'];  ?></td>
      <td><?php echo $row['descripcion'];  ?></td>
      <td class="rooms">

      		<?php  $image_name="SELECT * FROM propiedad as p join detalles as d
      					on p.id =d.idProp where d.idProp =".$row['id'];
      					$read1=$mysqli->query($image_name);

      					foreach ($read1 as $value) { ?>

      						<img src="uploads/<?php echo $value['imagen']; ?>" />

      					<?php  } ?>
      					</td>
    </tr>
<?php   } ?>
  </tbody>
</table>

</div>




<?php  include 'footer.php' ; ?>
