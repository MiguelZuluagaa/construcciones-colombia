<?php

//include connection file 
require "../../session.php";

//$id_matricula_dato = $_POST['id'];
//$params = $columns = $totalRecords = $data = array();

$params = filter_input_array(INPUT_POST);

//var_dump($params);

//define index of column
$columns = array(
	0 => 'id_sub_obra',
	1 => 'codigo',
    2 => 'subObra',
    3 => 'costo',
    4 => 'unidadMedida'
);

$sqlTot = $sqlRec = "";

// check search value exist
$where = "";

if (isset($params['search']['value']) && $params['search']['value'] != '') {
    $where .= "
            AND 
                (subO.id_sub_obra LIKE '%" . $params['search']['value'] . "%' 
                OR subO.codigo  LIKE '%" . $params['search']['value'] . "%' 
                OR UPPER(subO.nombre) LIKE '%" . $params['search']['value'] . "%'
                OR subO.costo  LIKE '%" . $params['search']['value'] . "%'
                OR um.nombre  LIKE '%" . $params['search']['value'] . "%')";
}


// getting total number records without any search
$sql = "SELECT 
        subO.id_sub_obra, 
        subO.codigo,
        UPPER(subO.nombre) subObra,
        subO.costo,
        um.nombre unidadMedida
        FROM tbl_sub_obra subO
        INNER JOIN tbl_unidad_medida um ON um.id_unidad_medida = subO.fk_id_unidad_medida";


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
        $data[$key][5] = '
        &nbsp;
        <a href="#" style="color:#000;" data-toggle="modal" data-target="#modalModificarUsuario" onClick="fnEditarSubObra(\'' . $val[1] . '\');">
        <span data-toggle="tooltip" title="Editar usuario" class="fas fa-pencil-alt"></span>
        </a>
        ';
        $data[$key][5] .= '
        &nbsp;
        <a href="#" style="color:#000;" data-toggle="modal" data-target="#modalEliminarUsuario" onClick="fnEliminarSubObra(\'' . $val[1] . '\');">
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