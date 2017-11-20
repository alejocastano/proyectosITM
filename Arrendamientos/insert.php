<?php include 'header.php'; ?>
<?php

$mysqli=new mysqli("Localhost","root","123","arrendamientos");
	if($mysqli->connect_error){

		printf("No es posible conectar con la base de datos %s\n",$mysqli->connect_error);
		exit();
	}


if(isset($_POST['submit'])){
try {


	$nombre=$_POST['nombre'];
	$valorMensual=$_POST['valorMensual'];
	$direccion=$_POST['direccion'];
	$acceso=$_POST['acceso'];
	$piso=$_POST['piso'];
	$utilidad=$_POST['utilidad'];
	$descripcion=mysqli_real_escape_string($mysqli ,$_POST['descripcion']);

	$target_dir="uploads/";
	$target_file= $target_dir . basename($_FILES["images"]["name"]);
	echo $temp_file;
	echo "<  >";
	$temp_file=$_FILES["images"]["name"];
	echo $temp_file;
	move_uploaded_file($_FILES["images"]["tmp_name"], $target_file);


	$query="INSERT INTO propiedad (nombre,valorMensual,direccion,acceso,piso,utilidad,descripcion,imagen) VALUES ('$nombre','$valorMensual','$direccion','$acceso','$piso','$utilidad','$descripcion','$temp_file')";
	$insert=$mysqli->query($query);
	$last_id = $mysqli->insert_id;
	$c=count($_FILES['img']['nombre']);

	if($insert){

		if($c < 10){

			for ($i=0; $i <$c; $i++) {
				$img_name=$_FILES['img']['name'][$i];
				move_uploaded_file($_FILES['img']['tmp_name'][$i] , "uploads/" .$img_name);
				$query_multi="INSERT INTO detalles(imagen,idProp) VALUES ('$img_name','$last_id')";
				$ins=$mysqli->query($query_multi);
			}
			// else{
			// 	echo "MAX LIMIT EXCEED";
			// }

		}

	}

}

catch (Exception $e) {
	 echo 'Message: ' .$e->getMessage();
}
}


?>

<div class="container">

<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
  <fieldset>
    <legend>Agregar una nueva propiedad</legend>
    <div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Nombre de la propiedad</label>
      <div class="col-lg-10">
        <input type="text" name="nombre" class="form-control"  placeholder="Nombre de la propiedad">
      </div>
    </div>
    <div class="form-group">
      <label for="inputPassword" class="col-lg-2 control-label">Arriendo mensual</label>
      <div class="col-lg-10">
        <input type="text" name="valorMensual" class="form-control"  placeholder="Arriendo mensual">
      </div>
    </div>
    <div class="form-group">
      <label for="textArea" class="col-lg-2 control-label">Dirección</label>
      <div class="col-lg-10">
        <textarea class="form-control" name="direccion" rows="3" id="textArea"></textarea>
      </div>
    </div>
    <div class="form-group">
      <label for="inputPassword" class="col-lg-2 control-label">Accesos</label>
      <div class="col-lg-10">
        <input type="text" name="acceso" class="form-control"  placeholder="Acceso">
      </div>
    </div>
    <div class="form-group">
      <label for="inputPassword" class="col-lg-2 control-label">Espacio en m2</label>
      <div class="col-lg-10">
        <input type="text" name="piso" class="form-control"  placeholder="Espacio en m2">
      </div>
    </div>
    <div class="form-group">
      <label for="inputPassword" class="col-lg-2 control-label">Utilidad</label>
      <div class="col-lg-10">
        <input type="text" name="utilidad" class="form-control"  placeholder="Utilidad">
      </div>
    </div>

    <div class="form-group">
      <label for="textArea" class="col-lg-2 control-label">Descripción</label>
      <div class="col-lg-10">
        <textarea class="form-control" name="descripcion" rows="3" id="textArea"></textarea>
      </div>
    </div>
    <div class="form-group">
      <label for="textArea" class="col-lg-2 control-label">Imagen de la propiedad</label>
      <div class="col-lg-10">
        <input type="file" name="images">
      </div>
    </div>
    <div class="form-group">
      <label for="textArea" class="col-lg-2 control-label">Imagenes de las alcobas</label>
      <div class="col-lg-10">
        <input type="file" name="img[]" multiple>
      </div>
    </div>

    <div class="form-group">
      <div class="col-lg-10 col-lg-offset-2">
        <button type="reset" class="btn btn-danger">Cancelar</button>
        <button type="submit" name="submit" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </fieldset>
</form>

</div>


<?php  include 'footer.php' ; ?>
