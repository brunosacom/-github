<?php
$con = mysqli_connect("dbmy0046.whservidor.com","ebcinesa_4","3gd8h3wqEG","ebcinesa_4");
if (!$con)
  {
  die('Could not connect: ' . mysqli_error());
  }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Grupo Estação</title>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-9870195-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>

<body>
<?php

$complexo_manutencao=$_POST[email_manutencao_grupoestacao];
$status_manutencao=$_POST[status_manutencao_grupoestacao];


$sql = "SELECT * FROM manutencao_grupoestacao WHERE status_manutencao_grupoestacao='$status_manutencao' AND email_manutencao_grupoestacao='$complexo_manutencao' ORDER BY timestamp_manutencao_grupoestacao DESC";
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