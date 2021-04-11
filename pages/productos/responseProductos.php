<?php

//include connection file 
require "../../session.php";

//$id_matricula_dato = $_POST['id'];
//$params = $columns = $totalRecords = $data = array();

$params = filter_input_array(INPUT_POST);

//var_dump($params);

//define index of column
$columns = array(
	0 => 'id_producto',
	1 => 'codigo',
    2 => 'producto',
    3 => 'costo',
    4 => 'unidadMedida',
    5 => 'categoria'
);

$sqlTot = $sqlRec = "";

// check search value exist
$where = "";

if (isset($params['search']['value']) && $params['search']['value'] != '') {
    $where .= "
            AND 
                (prod.id_producto LIKE '%" . $params['search']['value'] . "%' 
                OR prod.codigo  LIKE '%" . $params['search']['value'] . "%' 
                OR UPPER(prod.nombre) LIKE '%" . $params['search']['value'] . "%'
                OR prod.costo  LIKE '%" . $params['search']['value'] . "%'
                OR um.nombre  LIKE '%" . $params['search']['value'] . "%'
                OR cp.nombre  LIKE '%" . $params['search']['value'] . "%')";
}


// getting total number records without any search
$sql = "SELECT 
        prod.id_producto, 
        prod.codigo codigo,
        UPPER(prod.nombre) producto,
        prod.costo costo,
        um.nombre unidadMedida,
        cp.nombre categoria
        FROM tbl_producto prod
        INNER JOIN tbl_unidad_medida um ON um.id_unidad_medida = prod.fk_id_unidad_medida
        INNER JOIN tbl_categoria_producto cp ON cp.id_categoria_producto = prod.fk_id_categoria_producto";


$sqlTot .= $sql;
$sqlRec .= $sql;



//concatenate search sql if value exist
if (isset($where) && $where != '') {
    $sqlTot .= $where;
    $sqlRec .= $where;
}

$sqlRec .= " ORDER BY " . $columns[$params['order'][0]['column']] . "  " . $params['order'][0]['dir'] . "  LIMIT " . $params['start'] . " ," . $params['length'] . " ";

$queryTot = mysqli_query($conn, $sqlTot) or die("database error:" . mysqli_error($conn));

$totalRecords = mysqli_num_rows($queryTot);

$queryRecords = mysqli_query($conn, $sqlRec) or die("error to fetch employees data");

$data = array();
//iterate on results row and create new index array of data
while ($row = mysqli_fetch_row($queryRecords)) {
    $data[] = $row;
}

foreach ($data as $key => $val) {

    /*if (!in_array("82", $_SESSION["RESTRICCIONES"])) {*/
        $data[$key][6] = '
        &nbsp;
        <a href="#" style="color:#000;" data-toggle="modal" data-target="#modalModificarUsuario" onClick="fnEditarProducto(\'' . $val[0] . '\');">
        <span data-toggle="tooltip" title="Editar usuario" class="fas fa-pencil-alt"></span>
        </a>
        ';
        $data[$key][6] .= '
        &nbsp;
        <a href="#" style="color:#000;" data-toggle="modal" data-target="#modalEliminarUsuario" onClick="fnEliminarProducto(\'' . $val[0] . '\');">
        <span data-toggle="tooltip" title="Eliminar usuario" class="fa fa-times"></span>
        </a>';

}

$json_data = array(
    "draw" => intval($params['draw']),
    "recordsTotal" => intval($totalRecords),
    "recordsFiltered" => intval($totalRecords),
    "data" => $data   // total data array
);

echo json_encode($json_data);  // send data as json format