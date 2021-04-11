<?php 
require '../../session.php';

$accion = $_REQUEST['accion'];

$nombreObra = $_POST['nombreObra'];
$fechaInicio = $_POST['fecha_inicio'];
$fechaFin = $_POST['fecha_fin'];
$cantidadPisos = $_POST['cantidadPisos'];
$presupuestoObra = $_POST['presupuestoObra'];
$estadoObra = $_POST['estadoObra'];
$ciudad = $_POST['ciudad'];
$direccion = $_POST['direccion'];
$barrio = $_POST['barrio'];
$cliente = $_POST['cliente'];
$tipoObra = $_POST['tipoObra'];
$idUbicacion = 0;
$idObra = 0;
/** TEXTO JSON PARA ALMACENAR EN DB **/
$jsonDocumentos = "{id:}";
$jsonPdfs = "{id:}";
$jsonImagenes = "{id:}";
/*****************************************/

switch ($accion) {
	case 'crear':
		/**** INSERT ENCABEZADO DE LA OBRA ***/
		$insertUbicacion = $db->prepare("INSERT INTO tbl_ubicacion (direccion,barrio,fk_id_ciudad) VALUES(:direccion, :barrio, :fk_id_ciudad)");
		$insertUbicacion->bindParam(':direccion', $direccion);
		$insertUbicacion->bindParam(':barrio', $barrio);
		$insertUbicacion->bindParam(':fk_id_ciudad', $ciudad);
		$insertUbicacion->execute();

		/*select ultima ubicacion*/
		$sqlIdUbicacion = "SELECT MAX(id_ubicacion) id_ubicacion FROM tbl_ubicacion ORDER BY id_ubicacion DESC";
		$queryIdUbicacion = $db->query($sqlIdUbicacion);
		$fetchIdUbicacion = $queryIdUbicacion->fetchAll(PDO::FETCH_OBJ);
		foreach ($fetchIdUbicacion as $fetch) {
			$idUbicacion = $fetch->id_ubicacion;
		}

		/*Insert Obra*/
		$insertEncabezado = $db->prepare("INSERT INTO tbl_obra (nombre,fecha_inicio,fecha_fin,cantidad_pisos,presupuesto_obra,fk_id_estado_obra,fk_id_ubicacion,fk_id_cliente,fk_id_tipo_obra) 
			VALUES (:nombre, :fecha_inicio, :fecha_fin, :cantidad_pisos, :presupuesto_obra, :fk_id_estado_obra, :fk_id_ubicacion, :fk_id_cliente, :fk_id_tipo_obra)");
		$insertEncabezado->bindParam(':nombre', $nombreObra);
		$insertEncabezado->bindParam(':fecha_inicio', $fechaInicio);
		$insertEncabezado->bindParam(':fecha_fin', $fechaFin);
		$insertEncabezado->bindParam(':cantidad_pisos', $cantidadPisos);
		$insertEncabezado->bindParam(':presupuesto_obra', $presupuestoObra);
		$insertEncabezado->bindParam(':fk_id_estado_obra', $estadoObra);
		$insertEncabezado->bindParam(':fk_id_ubicacion', $idUbicacion);
		$insertEncabezado->bindParam(':fk_id_cliente', $cliente);
		$insertEncabezado->bindParam(':fk_id_tipo_obra', $tipoObra);
		$insertEncabezado->execute();

		/** TRAER ID DE LA OBRA**/
		$sqlIdObra = "SELECT MAX(id_obra) id_obra FROM tbl_obra ORDER BY id_obra DESC";
		$queryIdObra = $db->query($sqlIdObra);
		$fetchIdObra = $queryIdObra->fetchAll(PDO::FETCH_OBJ);
		foreach ($fetchIdObra as $fetch) {
			$idObra = $fetch->id_obra;
		}

		/**** INSERT DETALLE DE LA OBRA ***/
		$arraySubObra = array();
		$arraySubObra = $_POST["subObra"];
		$arraycantidad = array();
		$arraycantidad = $_POST["cantidad"];
		$sizeArray = sizeof($arraySubObra);
		$i = 0;
		while($i < $sizeArray){
			$crearObraDetalle = $db->prepare("INSERT INTO tbl_detalle_sub_obra (codigo_sub_obra,cantidad_sub_obra,fk_id_obra) VALUES(:codigo_sub_obra,:cantidad_sub_obra,:fk_id_obra);");
			$crearObraDetalle->bindParam(':codigo_sub_obra', $arraySubObra[$i]);
			$crearObraDetalle->bindParam(':cantidad_sub_obra', $arraycantidad[$i]);
			$crearObraDetalle->bindParam(':fk_id_obra', $idObra);
			$crearObraDetalle->execute();
			$i++;
		}
		header('location:'.$base_url.'pages/proyectos/index.php?r=success');
		break;
	case 'actualizar':



		break;
	case 'eliminar':
		$idObra = $_REQUEST['idObra'];
		/*** ELIMINAR DETALLE**/
		$eliminarObraDetalle = $db->prepare("DELETE FROM tbl_detalle_sub_obra WHERE fk_id_obra = :fk_id_obra;");
		$eliminarObraDetalle->bindParam(':fk_id_obra', $idObra);
		$eliminarObraDetalle->execute();

		/** ELIMINAR ENCABEZADO **/
		$eliminarObraEncabezado = $db->prepare("DELETE FROM tbl_obra WHERE id_obra = :id_obra;");
		$eliminarObraEncabezado->bindParam(':id_obra', $idObra);
		$eliminarObraEncabezado->execute();

		header('location:'.$base_url.'pages/proyectos/index.php?r=eliminado');
	break;
	default:
		# code...
	break;
}


?>

