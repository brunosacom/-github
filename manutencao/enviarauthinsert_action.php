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

    <body style="font-family: Didact Gothic;">
        <div class="container">
        <!-- Content here -->
    
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

echo '<p><b> Erro ao enviar formul�rio: '. print($mail->ErrorInfo);

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