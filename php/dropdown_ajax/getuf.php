<?php 
require $_SERVER['DOCUMENT_ROOT']."/php/mysqli_connect.php";

$paisid = $_POST['ps'];   // pais id

$sql = "SELECT uf_id, uf_alpha2, uf_nome FROM _uf WHERE pais_numero = $paisid";

$result = mysqli_query($con,$sql);

$uf_arr = array();

while( $row = mysqli_fetch_array($result) ){
    $ufid = $row['uf_id'];
    $uf_nome = $row['uf_nome'];

    $uf_arr[] = array("uf_id" => $ufid, "uf_nome" => $uf_nome);
}

// encoding array to json format
echo json_encode($uf_arr);

?>