<!DOCTYPE html>
<html>
<?php require '../../session.php'; ?>
<?php require '../../head.php'; ?>
<?php require '../../estilosPropios.php' ?>
<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    <?php require '../../menu.php'; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="background-color: white">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark"></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?= $base_url ?>index.php">Home</a></li>
                <li class="breadcrumb-item active">Inicio</li>
              </ol>
            </div><!-- /.col -->
            <div class="col-sm-12 text-center">
              <h1>LISTADO DE PROYECTOS</h1>
            </div>
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->
      <!-- Main content -->
      <section class="content">
       <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header" style="margin-bottom: 63px;">
              <div class="row">
                <h5 class="box-title" style="margin-left: 15px">Proyectos hasta la fecha</h5>
                <div class="col-sm-2 col-sm-offset-10 ml-auto float-right" style="margin-right: 15px">
                  <a href="JavaScript:void(0)" class="btn btn-warning btn-block mb-4" data-toggle="modal" data-target="#modalNuevoProyecto" >
                    <i class="fa fa-fw fa-plus" style="margin-right:15px;"></i><b>Nuevo</b>
                  </a>
                </div>
              </div>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <div id="cards_landscape_wrap-2" class="border-top" style="margin-top: -70px;">
                    <div class="container">
                      <div class="row">
                        <?php 
                        $sqlObras = "SELECT id_obra,nombre,fecha_inicio,fecha_fin,presupuesto_obra FROM tbl_obra ";
                        $queryObras = $db->query($sqlObras);
                        $fetchObras = $queryObras->fetchAll(PDO::FETCH_OBJ);
                        foreach ($fetchObras as $fetch) {
                          echo '<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">';
                          echo '<a href="">';
                          echo '<div class="card-flyer" style="border: 2px solid #FFC107;">';
                          echo '<div class="text-box">';
                          echo '<div class="image-box">';
                          echo '<img src="'.$base_url.'images/estadosObras/casa.jpg" alt="" />';
                          echo '</div>';
                          echo '<div class="text-container">';
                          echo '<h4 style="color: #FFC107;">'.$fetch->nombre.'</h4>';
                          echo '<p>fecha de Inicio:'.$fetch->fecha_inicio.'</p>';
                          echo '<p>Fin de fin :'.$fetch->fecha_fin.'</p>';
                          echo '<p>Presupuesto :'.$fetch->presupuesto_obra.'</p>';
                          echo '</div>';
                          echo '<div class="col-md-1 col-md-offset-2">';
                          echo '<a href="'.$base_url.'pages/proyectos/procesarProyecto.php?accion=eliminar&idObra='.$fetch->id_obra.'" class="btn btn-danger m-1"><i class="fas fa-trash-alt"></i></a>';
                          echo '</div>';
                          echo '</div>';
                          echo '</div>';
                          echo '</a>';
                          echo '</div>';
                        }
                        ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- Modal Registrar Nuevo Usuario -->
  <div id="modalNuevoProyecto" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header header-modal-sany" style="background-color: #ffc107">
          <div class="container-fluid">
            <h4 class="modal-title " style="text-align: center; color: black">REGISTRAR UN NUEVO PROYECTO</h4>
          </div>
        </div>

        <div class="modal-body modal-xl">
          <div class="content">
            <form method="POST" name="registrarObra" id="registrarObra"  onsubmit="return enviarRegistroObra(event);" action="procesarProyecto.php?accion=crear" enctype="multipart/form-data" >
              <div class="row">
                <div class="form-group col-md-6">
                  <label for="recipient-name" class="form-control-label">Nombre de la obra <i style="color: darkorange">*</i></label>
                  <input  type="text" class="form-control" name="nombreObra" id="nombreObra" required minlength="4" maxlength="30" autocomplete="off"/>
                </div>
                <div class="form-group col-md-3">
                  <label for="message-text" class="form-control-label">Fecha de inicio <i style="color: darkorange">*</i></label>
                  <input id="fecha_inicio" name="fecha_inicio" type="date" class="form-control"  required  />
                </div>

                <div class="form-group col-md-3">
                  <label for="message-text" class="form-control-label">Fecha de fin </label>
                  <input id="fecha_fin" name="fecha_fin" type="date" class="form-control"  required  />
                </div>

                <div class="form-group col-md-4">
                  <label for="message-text" class="form-control-label">Cantidad de pisos <i style="color: darkorange">*</i></label>
                  <input type="number" class="form-control" name="cantidadPisos" id="cantidadPisos" required  min="1" max="100" />
                </div>

                <div class="form-group col-md-4">
                  <label for="message-text" class="form-control-label">Presupuesto de la obra </label>
                  <input type="number" class="form-control" name="presupuestoObra" id="presupuestoObra" required />
                </div>

                <div class="form-group col-md-4">
                  <label for="recipient-name" class="form-control-label">Estado de la obra <i style="color: darkorange">*</i></label>
                  <select class="form-control" name="estadoObra" id="estadoObra" required>
                    <option value="0">Selecciona una opción</option>
                    <?php 
                    $sqlEstadoObra = "SELECT * FROM tbl_estado_obra;";
                    $queryEstadoObra = $db->query($sqlEstadoObra);
                    $fetchEstadoObra = $queryEstadoObra->fetchAll(PDO::FETCH_OBJ);
                    foreach ($fetchEstadoObra as $fetch) {
                      echo '<option value="'.$fetch->id_estado_obra.'">'.$fetch->nombre.'</option>';
                    }
                    ?>
                  </select>
                </div>

                <div class="form-group col-md-12">
                  <h4 class="modal-title " style="text-align: center; color: black">DOCUMENTACION IMPORTANTE</h4>
                </div>
                <div class="row">
                 <div class="form-group col-md-4">
                  <label for="message-text" class="form-control-label">Planos <i style="color: darkorange">*</i></label>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="planos" lang="es" disabled title="Ingreso de planos, documentos e imagines no funcional">
                    <label class="custom-file-label" for="planos" >Seleccionar Archivo</label>
                  </div>
                </div>
                <div class="form-group col-md-4">
                  <label for="message-text" class="form-control-label">Documentos <i style="color: darkorange">*</i></label>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="documentos" lang="es" disabled title="Ingreso de planos, documentos e imagines no funcional">
                    <label class="custom-file-label" for="documentos" >Seleccionar Archivo</label>
                  </div>
                </div>
                <div class="form-group col-md-4">
                  <label for="message-text" class="form-control-label">Imagenes <i style="color: darkorange">*</i></label>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="imagenes" lang="es" accept="image/jpeg,image/jpg,image/png" disabled title="Ingreso de planos, documentos e imagines no funcional">
                    <label class="custom-file-label" for="imagenes" >Seleccionar Archivo</label>
                  </div>
                </div>
              </div>
              <div class="form-group col-md-12">
                <h4 class="modal-title " style="text-align: center; color: black">DATOS DE LA OBRA</h4>
              </div>
              <div class="form-group col-md-4">
                <label for="recipient-name" class="form-control-label">Pais <i style="color: darkorange">*</i></label>
                <select class="form-control" name="pais" id="pais" onchange="validarPais();">
                  <option value="0">Selecciona una opción</option>
                  <?php 
                  $sqlPais = "SELECT * FROM tbl_pais;";
                  $queryPais = $db->query($sqlPais);
                  $fetchPais = $queryPais->fetchAll(PDO::FETCH_OBJ);
                  foreach ($fetchPais as $fetch) {
                    echo '<option value="'.$fetch->id_pais.'">'.$fetch->nombre.'</option>';
                  }
                  ?>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="recipient-name" class="form-control-label">Departamento <i style="color: darkorange">*</i></label>
                <select class="form-control" name="departamento" id="departamentoSelect" onchange="validarCiudad();" disabled required> 
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="recipient-name" class="form-control-label">Ciudad <i style="color: darkorange">*</i></label>
                <select class="form-control" name="ciudad" id="ciudadSelect" disabled required>
                </select>
              </div>

              <div class="form-group col-md-6">
                <label for="message-text" class="form-control-label">Direccion <i style="color: darkorange">*</i></label>
                <input type="text" class="form-control" name="direccion" required autocomplete="off"/>
              </div>
              <div class="form-group col-md-6">
                <label for="message-text" class="form-control-label">Barrio <i style="color: darkorange">*</i></label>
                <input type="text" class="form-control" name="barrio" id="barrio" required autocomplete="off"/>
              </div>
              <div class="form-group col-md-6">
                <label for="recipient-name" class="form-control-label">Cliente a quien se le hara la obra <i style="color: darkorange">*</i></label>
                <select class="form-control" name="cliente" id="clienteObra"  required>
                  <option value="0">Selecciona una opción</option>
                  <?php 
                  $sqlCliente = 'SELECT id_cliente, UPPER(CONCAT(primer_nombre," ",segundo_nombre," ",primer_apellido," ",segundo_apellido)) nombre_completo FROM tbl_cliente;';
                  $queryCliente = $db->query($sqlCliente);
                  $fetchCliente = $queryCliente->fetchAll(PDO::FETCH_OBJ);
                  foreach ($fetchCliente as $fetch) {
                    echo '<option value="'.$fetch->id_cliente.'">'.$fetch->nombre_completo.'</option>';
                  }
                  ?>
                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="recipient-name" class="form-control-label">Tipo de obra <i style="color: darkorange">*</i></label>
                <select class="form-control" name="tipoObra" id="tipoObra"  required>
                  <option value="0">Selecciona una opción</option>
                  <?php 
                  $sqlTipoObra = 'SELECT * FROM tbl_tipo_obra;';
                  $queryTipoObra = $db->query($sqlTipoObra);
                  $fetchTipoObra = $queryTipoObra->fetchAll(PDO::FETCH_OBJ);
                  foreach ($fetchTipoObra as $fetch) {
                    echo '<option value="'.$fetch->id_tipo_obra.'">'.$fetch->nombre.'</option>';
                  }
                  ?>
                </select>
              </div>
              <div class="form-group col-md-12">
                <h4 class="modal-title " style="text-align: center; color: black">DETALLE DE LA OBRA</h4>
              </div>
              <div class="form-group col-md-12">
                <div class="col-sm-1 col-sm-offset-10 ml-auto float-right" style="margin-right: 15px">
                  <a class="btn btn-success btn-block" onclick="agregarDetalle()"><i class="fas fa-plus"></i></a>
                </div>
              </div>
              <div class="form-group col-md-12">
                <div class="row" id="detalle">
                  <div class="form-group col-md-6" id="divSubObra1">
                    <label for="recipient-name" class="form-control-label">Sub-Obra <i style="color: darkorange">*</i></label>
                    <select class="form-control" name="subObra[]" id="subObra1" required="true">
                      <option value="">Selecciona una opción</option>
                      <?php 
                      $sqlSubObra = "SELECT codigo,nombre FROM tbl_sub_obra;";
                      $querySubObra = $db->query($sqlSubObra);
                      $fetchSubObra = $querySubObra->fetchAll(PDO::FETCH_OBJ);
                      foreach ($fetchSubObra as $fetch) {
                        echo '<option value="'.$fetch->codigo.'">'.$fetch->codigo.' - '.$fetch->nombre.'</option>';
                      }
                      ?>
                    </select>
                  </div>
                  <div class="form-group col-md-5" id="divCantidad1">
                    <label for="recipient-name" class="form-control-label">Cantidad <i style="color: darkorange">*</i></label>
                    <input  type="number" class="form-control" name="cantidad[]" id="cantidad1" required="true"  maxlength="20" autocomplete="off"/>
                  </div>
                  <div class="form-group col-md-1" id="divEliminar1">
                    <label for="recipient-name" class="form-control-label" id="lblCantidad">Eliminar</label>
                    <a class="btn btn-danger" id="eliminar1" onclick="eliminarDetalle(1)"><i class="fas fa-trash-alt"></i></a>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">
                Cancelar
              </button>
              <button type="submit" class="btn btn-warning" name="Guardar" id="registrarButton">
                Registrar
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>



<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<?php require_once('../../footer.php') ?>
<!-- Scripts -->
<?php require_once('../../scripts.php') ?>
<script type="text/javascript" src="../../js/javascriptIndexProyecto.js" defer></script>
<script type="text/javascript">
  let resquest = "<?php echo $_GET['r']; ?>";
  if(resquest == "success"){
    swal("Excelente!", "Proyecto almacenado correctamente!", "success");
  }else if(resquest == "eliminado"){
    swal("Excelente!", "Proyecto eliminado correctamente!", "success");
  }
  var contadorDetalle = 1; 

  var copiaSelect = document.getElementById("subObra1");
  var divCantidad = document.getElementById("cantidad1");
  var btnEliminarBase = document.getElementById("eliminar1");

  var copiadivSelectSubObra = copiaSelect.cloneNode(true);
  var copiadivInputCantidad = divCantidad.cloneNode(true);
  var copiadivButtonEliminar = btnEliminarBase.cloneNode(true);

  function agregarDetalle(){
    contadorDetalle++;

    let divPadre = document.getElementById("detalle");

    let divSubObra = document.createElement("div");
    divSubObra.className = "form-group col-md-6";
    divSubObra.setAttribute("id", "divSubObra"+contadorDetalle);

    let divCantidad = document.createElement("div");
    divCantidad.className = "form-group col-md-5";
    divCantidad.setAttribute("id", "divCantidad"+contadorDetalle);

    let divEliminar = document.createElement("div");
    divEliminar.className = "form-group col-md-1";
    divEliminar.setAttribute("id", "divEliminar"+contadorDetalle);

    
    let selectProductoCrear = copiadivSelectSubObra.cloneNode(true);
    selectProductoCrear.setAttribute("id", "subObra"+contadorDetalle);
    selectProductoCrear.setAttribute("name", "subObra[]");

    
    let inputCantidadCrear = copiadivInputCantidad.cloneNode(true);
    inputCantidadCrear.setAttribute("id", "cantidad"+contadorDetalle);
    inputCantidadCrear.setAttribute("name", "cantidad[]");

    
    let btnEliminarCrear = copiadivButtonEliminar.cloneNode(true);
    btnEliminarCrear.setAttribute("id", "btncantidad"+contadorDetalle);
    btnEliminarCrear.setAttribute("name", "btncantidad");
    btnEliminarCrear.setAttribute("onclick", "eliminarDetalle("+contadorDetalle+")");

    divPadre.appendChild(divSubObra);
    divSubObra.appendChild(selectProductoCrear);

    divPadre.appendChild(divCantidad);
    divCantidad.appendChild(inputCantidadCrear);

    divPadre.appendChild(divEliminar);
    divEliminar.appendChild(btnEliminarCrear);
  }
  function eliminarDetalle(posicion){

    let divPadre = document.getElementById("detalle");
    let divSubObra = document.getElementById('divSubObra'+posicion);
    let divCantidad = document.getElementById('divCantidad'+posicion);
    let divEliminar = document.getElementById('divEliminar'+posicion);

    divPadre.removeChild(divSubObra);
    divPadre.removeChild(divCantidad);
    divPadre.removeChild(divEliminar);
  }
  function fnEliminarSubObra(idUsuario){
    swal({
      title: "Estas seguro que deseas eliminar esta Obra?",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        swal("Procesando informacion!", {
          timer: 3000,
        });
        window.location="<?= $base_url ?>pages/proyectos/procesarObra.php?accion=eliminar&idObra="+idUsuario;
      } 
    });
  }
</script>
</body>
</html>


