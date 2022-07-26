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
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="Keywords" content="Grupo Esta&ccedil;&atilde;o, Circuito Esta&ccedil;&atilde;o, Programa&ccedil;&atilde;o, Esta&ccedil;&atilde;o, Esta&ccedil;&atilde;o Virtual, esta&ccedil;&atilde;o virtual, estacao virtual, filmes, cinema" />
<meta name="Description" content="Grupo Esta&ccedil;&atilde;o" />
<meta name="Author" content="Grupo Esta&ccedil;&atilde;o" />
<link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet"> 
<style>
body {
font-family: 'Muli', sans-serif;}</style>
<title>Grupo Estação</title>
<style type="text/css">
<!--
-->
</style>
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

<body style="font-family: 'Muli', serif;">
    
<?php

if(isset($_POST['submit'])) {

$charset = $_POST['charset'];
$cinema_manutencao_grupoestacao = addslashes($_POST['cinema_manutencao_grupoestacao']);
$urgencia_manutencao_grupoestacao = addslashes($_POST['urgencia_manutencao_grupoestacao']);
$area_manutencao_grupoestacao = addslashes($_POST['area_manutencao_grupoestacao']);
$gerente_manutencao_grupoestacao = addslashes($_POST['gerente_manutencao_grupoestacao']);
$tiposolicitacao_manutencao_grupoestacao = addslashes($_POST['tiposolicitacao_manutencao_grupoestacao']);
$relateproblema_manutencao_grupoestacao = addslashes($_POST['relateproblema_manutencao_grupoestacao']);
$localizacao_manutencao_grupoestacao = addslashes($_POST['localizacao_manutencao_grupoestacao']);
$status_manutencao_grupoestacao = addslashes($_POST['status_manutencao_grupoestacao']);
$email_manutencao_grupoestacao = addslashes($_POST['email_manutencao_grupoestacao']);


$caixaPostalServidorNome = "".$cinema_manutencao_grupoestacao." Manutencao";
$caixaPostalServidorEmail = 'formulario@grupoestacao.com.br';
$caixaPostalServidorSenha = 'Estacao12345';

$assunto = "[[".$urgencia_manutencao_grupoestacao." - ".$cinema_manutencao_grupoestacao." - ".$area_manutencao_grupoestacao." - ".$tiposolicitacao_manutencao_grupoestacao."]]";

$mensagemConcatenada = 'LOCALIZACAO'.'<br/>'; 
$mensagemConcatenada .= 'Cinema: '.$cinema_manutencao_grupoestacao.'<br/>';
$mensagemConcatenada .= 'Area: '.$area_manutencao_grupoestacao.'<br/>';
$mensagemConcatenada .= 'Localizacao: '.$localizacao_manutencao_grupoestacao.'<br/>';
$mensagemConcatenada .= 'Tipo: '.$tiposolicitacao_manutencao_grupoestacao.'<br/><br/>';

$mensagemConcatenada .= 'DESCRICAO'.'<br/>';
$mensagemConcatenada .= 'Relato: '.$relateproblema_manutencao_grupoestacao.'<br/><br/>';
$mensagemConcatenada .= 'Status: '.$status_manutencao_grupoestacao.'<br/><br/>';

$mensagemConcatenada .= 'RESPONSAVEL'.'<br/>';
$mensagemConcatenada .= 'Gerente: '.$gerente_manutencao_grupoestacao.'<br/><br/>';


/*********************************** A PARTIR DAQUI NAO ALTERAR ************************************/

 

require_once('../PHPMailer-master/PHPMailerAutoload.php');

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth  = true;
$mail->Charset   = 'utf8';
$mail->Host  = 'smtp.'.substr(strstr($caixaPostalServidorEmail, '@'), 1);
$mail->Port  = '587';
$mail->Username  = $caixaPostalServidorEmail;
$mail->Password  = $caixaPostalServidorSenha;
$mail->From  = $caixaPostalServidorEmail;
$mail->FromName  = $caixaPostalServidorNome;
$mail->IsHTML(true);
$mail->Subject  = $assunto;
$mail->Body  = $mensagemConcatenada;

/*********************************** EMAILS QUE RECEBEM O FORM ************************************/


$mail->AddAddress('manutencao.rj@ebcine.com.br', 'Manutencao RJ');

$mail->AddReplyTo($email_manutencao_grupoestacao, $cinema_manutencao_grupoestacao);


if(!$mail->Send()){

echo '<p><b> Erro ao enviar formulário: '. print($mail->ErrorInfo);

}else{

echo 'Mail enviado com sucesso!<br/>';

} 



}


$sql="INSERT INTO manutencao_grupoestacao (charset, cinema_manutencao_grupoestacao, urgencia_manutencao_grupoestacao, area_manutencao_grupoestacao, gerente_manutencao_grupoestacao, tiposolicitacao_manutencao_grupoestacao, relateproblema_manutencao_grupoestacao, localizacao_manutencao_grupoestacao, status_manutencao_grupoestacao, email_manutencao_grupoestacao)
VALUES
('$charset','$cinema_manutencao_grupoestacao','$urgencia_manutencao_grupoestacao','$area_manutencao_grupoestacao','$gerente_manutencao_grupoestacao','$tiposolicitacao_manutencao_grupoestacao','$relateproblema_manutencao_grupoestacao','$localizacao_manutencao_grupoestacao','$status_manutencao_grupoestacao','$email_manutencao_grupoestacao')";

if (!mysqli_query($con, $sql))
  {
  die('Error: ' . mysqli_error($con));
  }
echo "<br>Obrigado por enviar a solicitacao/manutencao de ".$cinema_manutencao_grupoestacao.".<br>";



mysqli_close($con)
?>


</body>
</html>