<?php 
require $_SERVER['DOCUMENT_ROOT']."/php/mysqli_connect.php";

$paisid = $_GET['ps'];   // pais id
$ufid = $_GET['uf'];   // uf id

$sql = "SELECT municipio_id, municipio_ibge, municipio_nome FROM _municipio WHERE pais_numero = $paisid AND uf_ibge = $ufid";

$result = mysqli_query($con,$sql);

while( $row = mysqli_fetch_array($result) ){
    $ufid = $row['uf_id'];
    $uf_nome = $row['uf_nome'];

    echo "<option value=\"" . $ufid . "\">" . $uf_nome . "</option>";
}

?>