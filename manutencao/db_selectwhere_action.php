<?php require $_SERVER['DOCUMENT_ROOT'].'/php/mysqli_connect.php'; //MySqlDB connect brunosacom ?>

<?php

// URL EXEMPLO
//https://www.bruno-sa.com/-php/manutencao/index.php?emp_sigla='BMB'

$emp_sigla = $_GET['emp_sigla'];

$sql_empresa = "SELECT * FROM bembos_empresa WHERE empresa_sigla = $emp_sigla";
$result_empresa = mysqli_query($con, $sql_empresa);
while ($row_empresa = mysqli_fetch_array($result_empresa)) {

    $empresa_logo = $row_empresa['empresa_logo'];
    $empresa_nome = $row_empresa['empresa_nome'];
    $empresa_sigla = $row_empresa['empresa_sigla'];
    $empresa_whatsapp = $row_empresa['empresa_whatsapp'];
    $empresa_emailto = $row_empresa['empresa_emailto'];
    $empresa_emailtonome = $row_empresa['empresa_emailtonome'];
    $empresa_smtp = $row_empresa['empresa_smtp'];
    $empresa_username = $row_empresa['empresa_username'];
    $empresa_password = $row_empresa['empresa_password'];
    $empresa_emailfrom = $row_empresa['empresa_emailfrom'];
    $empresa_emailfromnome = $row_empresa['empresa_emailfromnome'];
}
?>

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

if (isset($_POST['submit'])) {

$manutencao_email=$_POST['manutencao_email'];
$manutencao_status=$_POST['manutencao_status'];

}

$sql = "SELECT * FROM bembos_manutencao WHERE manutencao_status = '$manutencao_status' AND manutencao_email = '$manutencao_email' ORDER BY manutencao_timestamp DESC";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
		
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
while($row = mysqli_fetch_assoc($result)) {

  echo "<tr>";
  echo "<td>" . $row['manutencao_timestamp'] . "</td>";
  echo "<td>" . $row['manutencao_cinema'] . "</td>";
  echo "<td>" . $row['manutencao_area'] . "</td>";
  echo "<td>" . $row['manutencao_localizacao'] . "</td>";
  echo "<td>" . $row['manutencao_tiposolicitacao'] . "</td>";
  echo "<td>" . $row['manutencao_relateproblema'] . "</td>";
  echo "<td>" . $row['manutencao_status'] . "</td>";
  echo "<td>" . $row['manutencao_andamento'] . "</td>";
  echo "</tr>";
		
    }
    echo "</table>";

} else {
    echo "0 results";
}



mysqli_close($con)
?>
</body>
</html>