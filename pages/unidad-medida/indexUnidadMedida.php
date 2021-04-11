<!DOCTYPE html>
<html>
<?php require_once dirname(__FILE__) . '/../../session.php'; ?>
<?php require_once dirname(__FILE__) . '/../../head.php'; ?>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    <?php require_once dirname(__FILE__) . '/../../menu.php'; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="background-color: white">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Inicio</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?= $base_url ?>index.php">Home</a></li>
                <li class="breadcrumb-item active">Inicio</li>
              </ol>
            </div><!-- /.col -->
            <div class="col-sm-12 text-center">
              <h1>Unidades de medidas</b></span></h1>
            </div>

          </div><!-- /.row -->

        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->
      <section class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="box">
              <div class="box-header" style="margin-bottom: 63px;">
                <div class="row">

                  <div class="col-sm-2 col-sm-offset-10 ml-auto float-right" style="margin-right: 15px">
                    <a href="JavaScript:void(0)" class="btn btn-warning btn-block mb-4" data-toggle="modal" data-target="#modalNuevoUnidadMedida">
                      <i class="fa fa-fw fa-plus" style="margin-right:15px;"></i><b>Nuevo</b>
                    </a>
                  </div>
                </div>
              </div>
              <div class="box-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="box">
                      <div class="box-header">
                      </div>
                      <div class="box-body">
                        <div class="container-fluid">
                          <table id="listUnidadMedida" class="table-light table-bordered table-striped table-hover" width="98%" cellspacing="0">
                            <thead>
                              <tr>
                                <th>ID UNIDAD DE MEDIDA</th>
                                <th>NOMBRE</th>
                                <th>DESCRIPCION</th>
                              </tr>
                            </thead>
                          </table>
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


      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-xs-12">

            </div>
          </div>


        </div>
        <!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <!-- Modal Registrar Nuevo Usuario -->
    <div id="modalNuevoUnidadMedida" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header header-modal-sany" style="background-color: #ffc107">
            <div class="container-fluid">
              <h4 class="modal-title " style="text-align: center; color: black">REGISTRAR UNA NUEVA UNIDAD DE MEDIDA</h4>
            </div>
          </div>

          <div class="modal-body modal-xl">
            <div class="content">
              <form method="POST" name="registrarProducto" id="registrarProducto" onsubmit="" action="procesarProducto.php?accion=crear">
                <div class="row">
                  <div class="form-group col-md-12">
                    <label for="recipient-name" class="form-control-label">Nombre <i style="color: darkorange">*</i></label>
                    <input type="text" class="form-control" name="codigo" id="nombre" required minlength="1" maxlength="30" autocomplete="off" />
                  </div>
                  <div class="form-group col-md-12">
                    <label for="recipient-name" class="form-control-label">Descripcion <i style="color: darkorange">*</i></label>
                    <input type="text" class="form-control" name="descripcion" id="descripcion" minlength="1" maxlength="30" autocomplete="off" />
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


    <?php require_once('../../footer.php') ?>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- Scripts -->
  <?php require_once('../../scripts.php') ?>
</body>

</html>
