<?php 
require "../../session.php";


$sqlUsuario = "SELECT * FROM tbl_producto WHERE id_producto =". $_REQUEST["idu"];

$queryUsuario = mysqli_query($conn, $sqlUsuario);
$fetchUsuario = mysqli_fetch_row($queryUsuario);

?>
<form name="editarProducto" id="editarProducto" method="POST" action="procesarProducto.php?accion=actualizar&id=<?= $_REQUEST["idu"] ?>" onsubmit="return enviarRegistroProductoEditar(event);">
	<h4 class="text-center mb-4"> Producto </h4>
	<div class="row">
		<div class="form-group col-md-4">
			<label for="message-text" class="form-control-label">Codigo <i style="color: darkorange">*</i></label>
			<input type="text" class="form-control" name="codigo" id="codigoEditar" required value="<?= $fetchUsuario[1] ?>"/>
		</div>
		<div class="form-group col-md-8">
			<label for="message-text" class="form-control-label">Nombre <i style="color: darkorange">*</i></label>
			<input type="text" class="form-control" name="nombre" id="nombreEditar" required value="<?= $fetchUsuario[2] ?>"/>
		</div>
		<div class="form-group col-md-12">
			<label for="message-text" class="form-control-label">Descripcion <i style="color: darkorange">*</i></label>
			<input type="text" class="form-control" name="descripcion" id="descripcionEditar" value="<?= $fetchUsuario[3] ?>"/>
		</div>
		<div class="form-group col-md-4">
			<label for="message-text" class="form-control-label">costo <i style="color: darkorange">*</i></label>
			<input type="number" class="form-control" name="costo" id="costoEditar" required value="<?= $fetchUsuario[4] ?>"/>
		</div>
		<div class="form-group col-md-4">
			<label for="recipient-name" class="form-control-label">Unidad de medida <i style="color: darkorange">*</i></label>
			<select class="form-control" name="unidadMedida" id="unidadMedidaEditar" >
				<option value="0">Selecciona una opción</option>
				<?php
				$queryUnidadMedida = mysqli_query($conn, "SELECT id_unidad_medida,nombre FROM tbl_unidad_medida;");
				while ($UnidadMedida = mysqli_fetch_row($queryUnidadMedida)) {
					if ($UnidadMedida[0] == $fetchUsuario[5]) {
						echo "<option selected value=" . $UnidadMedida[0] . ">" . $UnidadMedida[1] . "</option>";
					} else {
						echo "<option value=" . $UnidadMedida[0] . ">" . $UnidadMedida[1] . "</option>";
					}
				}
				?>
			</select>
		</div>
		<div class="form-group col-md-4">
			<label for="recipient-name" class="form-control-label">Categoria producto <i style="color: darkorange">*</i></label>
			<select class="form-control" name="categoriaProducto" id="categoriaProductoEditar" >
				<option value="0">Selecciona una opción</option>
				<?php
				$querycategoriaProducto = mysqli_query($conn, "SELECT id_categoria_producto,nombre FROM tbl_categoria_producto;");
				while ($categoriaProducto = mysqli_fetch_row($querycategoriaProducto)) {
					if ($categoriaProducto[0] == $fetchUsuario[6]) {
						echo "<option selected value=" . $categoriaProducto[0] . ">" . $categoriaProducto[1] . "</option>";
					} else {
						echo "<option value=" . $categoriaProducto[0] . ">" . $categoriaProducto[1] . "</option>";
					}
				}
				?>
			</select>
		</div>
	</div>
	<!-- End Row -->
	<!-- Modal Footer -->
	<div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">
			Cancelar
		</button>
		<button type="submit" class="btn btn-warning" name="Actualizar">
			Actualizar
		</button>
	</div>
</div>    