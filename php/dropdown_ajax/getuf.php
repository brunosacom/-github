<?php 
require $_SERVER['DOCUMENT_ROOT']."/php/mysqli_connect.php";

$paisid = $_GET['ps'];   // pais id

$sql = "SELECT uf_id, uf_alpha2, uf_nome, uf_ibge FROM _uf WHERE pais_numero = $paisid";

$result = mysqli_query($con,$sql);

while( $row = mysqli_fetch_array($result) ){
    $uf_ibge = $row['uf_ibge'];
    $uf_nome = $row['uf_nome'];

    echo "<option value=\"" . $uf_ibge . "\">" . $uf_nome . "</option>";
}

?>