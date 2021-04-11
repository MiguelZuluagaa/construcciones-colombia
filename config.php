<?php 
#################### URL BASE ###############################
$arrServer = filter_input_array(INPUT_SERVER);
$currentPath = $arrServer['PHP_SELF'];
$pathInfo = pathinfo($currentPath);
$hostName = $arrServer['HTTP_HOST'];
$protocol = strtolower(substr($arrServer['SERVER_PROTOCOL'], 0, 5)) == 'https://' ? 'https://' : 'http://';
$arrDirname = explode('/', $pathInfo['dirname']);
$project = $arrDirname[1];

$base_url = $protocol . $hostName . '/' . $project . '/';
if(getenv('ENTORNO')!='LOCAL'){
    $base_url = $protocol . $hostName . '/ppi-508/';        
}

#################### FIN URL BASE #############################


################### CONEXION BASE DE DATOS LOCAL ###################
$dbServer = 'localhost';
$dbUser = 'root';
$dbPassword = '';
$dbSchema = 'db_construcciones_colombia';


try {
    $db = new PDO('mysql:host=' . $dbServer . ';dbname=' . $dbSchema . ';chasrset=utf8', $dbUser, $dbPassword);
    $conn = mysqli_connect($dbServer, $dbUser, $dbPassword, $dbSchema) or die("Connection failed: " . mysqli_connect_error());
} catch (PDOException  $e) {
    echo "ERROR: " . $e->getMessage();
}
################### FIN CONEXION BASE DE DATOS ###################

 ?>
