<?php 
require $_SERVER['DOCUMENT_ROOT']."/php/mysqli_connect.php";

$paisid = $_GET['p'];   // pais id

$sql = "SELECT uf_id, uf_alpha2, uf_nome FROM _uf WHERE pais_numero = ?";

$result = mysqli_query($con,$sql);

/*
$stmt = $con->prepare($sql);
$stmt->bind_param("s", $_GET['p']);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($uf_id, $uf_alpha2, $uf_nome);
$stmt->fetch();
$stmt->close();

*/

//$uf_arr = array();

while( $row = mysqli_fetch_array($stmt) ){
    $ufid = $row['uf_id'];
    $uf_nome = $row['uf_nome'];

    //$uf_arr[] = array("<option value='".$ufid."'>".$uf_nome."</option>");
    echo "<option value=\"" . "teste " . $ufid . "\">" . $uf_nome . "</option>";
}

//echo "<option value=\"" . "teste " . $ufid . "\">" . $uf_nome . "</option>";
// encoding array to json format
//echo json_encode($uf_arr);

//echo $uf_arr;

?>