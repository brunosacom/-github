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
$manutencao_status = addslashes($_POST['manutencao_status']);
$manutencao_email = addslashes($_POST['manutencao_email']);
$manutencao_cinema = addslashes($_POST['manutencao_cinema']);
$manutencao_area = addslashes($_POST['manutencao_area']);
$manutencao_gerente = addslashes($_POST['manutencao_gerente']);
$manutencao_tiposolicitacao = addslashes($_POST['manutencao_tiposolicitacao']);
$manutencao_urgencia = addslashes($_POST['manutencao_urgencia']);
$manutencao_relateproblema = addslashes($_POST['manutencao_relateproblema']);
$manutencao_localizacao = addslashes($_POST['manutencao_localizacao']);



$caixaPostalServidorNome = "".$manutencao_cinema." Manutencao";
$caixaPostalServidorEmail = 'formulario@grupoestacao.com.br';
$caixaPostalServidorSenha = 'Estacao12345';

$assunto = "[[".$manutencao_cinema." - ".$manutencao_area." - ".$manutencao_tiposolicitacao."]]";

$mensagemConcatenada = 'LOCALIZACAO'.'<br/>'; 
$mensagemConcatenada .= 'Cinema: '.$manutencao_cinema.'<br/>';
$mensagemConcatenada .= 'Area: '.$manutencao_area.'<br/>';
$mensagemConcatenada .= 'Localizacao: '.$manutencao_localizacao.'<br/>';
$mensagemConcatenada .= 'Tipo: '.$manutencao_tiposolicitacao.'<br/><br/>';

$mensagemConcatenada .= 'DESCRICAO'.'<br/>';
$mensagemConcatenada .= 'Relato: '.$manutencao_relateproblema.'<br/><br/>';
$mensagemConcatenada .= 'Status: '.$manutencao_status.'<br/><br/>';

$mensagemConcatenada .= 'RESPONSAVEL'.'<br/>';
$mensagemConcatenada .= 'Gerente: '.$manutencao_gerente.'<br/><br/>';


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


$mail->AddAddress('bruno@bruno-sa.com', 'Manutencao RJ');

$mail->AddReplyTo($manutencao_email, $manutencao_cinema);


if(!$mail->Send()){

echo '<p><b> Erro ao enviar formulário: '. print($mail->ErrorInfo);

}else{

echo 'Mail enviado com sucesso!<br/>';

} 



}


$sql="INSERT INTO bembos_manutencao (charset, manutencao_cinema, manutencao_urgencia, manutencao_area, manutencao_gerente, manutencao_tiposolicitacao, manutencao_relateproblema, manutencao_localizacao, manutencao_status, manutencao_email)
VALUES
('$charset','$manutencao_cinema','$manutencao_urgencia','$manutencao_area','$manutencao_gerente','$manutencao_tiposolicitacao','$manutencao_relateproblema','$manutencao_localizacao','$manutencao_status','$manutencao_email')";

if (!mysqli_query($con, $sql))
  {
  die('Error: ' . mysqli_error($con));
  }
echo "<br>Obrigado por enviar a solicitacao/manutencao de ".$manutencao_cinema.".<br>";



mysqli_close($con)
?>


</body>
</html>