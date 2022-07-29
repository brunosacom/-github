<?php require $_SERVER['DOCUMENT_ROOT'].'/php/mysqli_connect.php'; //MySqlDB connect brunosacom ?>

<!DOCTYPE HTML>
<html lang="pt-BR">
<head>
        <?php include_once $_SERVER['DOCUMENT_ROOT'].'/php/analyticstracking.php'; ?>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $empresa_nome; ?> - Manutenção</title>
        <link href="https://fonts.googleapis.com/css?family=Didact Gothic" rel="stylesheet">
        <?php include_once $_SERVER['DOCUMENT_ROOT'].'/php/bootstrap_head.php'; ?>
    </head>

    <body style="font-family: Didact Gothic; color:#FFF; background-color:#333;">
        <div class="container">
        <!-- Content here -->

<?php

$complexo_manutencao=$_POST[email_manutencao_grupoestacao];
$status_manutencao=$_POST[status_manutencao_grupoestacao];


$sql = "SELECT * FROM bembos_manutencao WHERE manutencao_status='$status_manutencao' AND manutencao_email='$complexo_manutencao' ORDER BY manutencao_timestamp DESC";
$result = $con->query($sql);

if ($result->num_rows > 0) {
		
	echo "<table border='1'>
<tr>
<th>DATA e HORA</th>
<th>CINEMA / CAFE</th>
<th>AREA</th>
<th>LOCALIZACAO</th>
<th>TIPO SOLICITACAO</th>
<th>RELATO</th>
<th>STATUS</th>
<th>ANDAMENTO</th>
</tr>";
    // output data of each row
while($row = $result->fetch_assoc()) {

  echo "<tr>";
  echo "<td>" . $row['timestamp_manutencao_grupoestacao'] . "</td>";
  echo "<td>" . $row['cinema_manutencao_grupoestacao'] . "</td>";
  echo "<td>" . $row['area_manutencao_grupoestacao'] . "</td>";
  echo "<td>" . $row['localizacao_manutencao_grupoestacao'] . "</td>";
  echo "<td>" . $row['tiposolicitacao_manutencao_grupoestacao'] . "</td>";
  echo "<td>" . $row['relateproblema_manutencao_grupoestacao'] . "</td>";
  echo "<td>" . $row['status_manutencao_grupoestacao'] . "</td>";
  echo "<td>" . $row['andamento_manutencao_grupoestacao'] . "</td>";
  echo "</tr>";
		
		
    }
} else {
    echo "0 results";
}



mysqli_close($con)
?>
</body>
</html>