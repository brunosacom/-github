<?php 
require $_SERVER['DOCUMENT_ROOT']."/php/mysqli_connect.php";

$paisid = $_GET['ps'];   // pais id
$ufid = $_GET['uf'];   // uf id

$sql = "SELECT municipio_id, municipio_ibge, municipio_nome FROM _municipio WHERE uf_ibge = $ufid";

$result = mysqli_query($con,$sql);

while( $row = mysqli_fetch_array($result) ){
    $municipio_ibge = $row['municipio_ibge'];
    $municipio_nome = $row['municipio_nome'];

    echo "<option value=\"" . $municipio_ibge . "\">" . $municipio_nome . "</option>";
}

?>