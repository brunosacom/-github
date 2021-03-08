<?php require $_SERVER['DOCUMENT_ROOT'].'/php/mysqli_connect.php'; ?> <!-- MySqlDB connect brunosacom -->

<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
		<?php include_once $_SERVER['DOCUMENT_ROOT'].'/php/analyticstracking.php'; ?>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Envio Inscrição Festival de Cinema</title>
		<link rel="shortcut icon" href="<?php echo $empresa_favicon; ?>">
		<link href="https://fonts.googleapis.com/css?family=Didact Gothic" rel="stylesheet">

		<!-- Bootstrap CSS -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
	</head>

	<body style="font-family:Didact Gothic; color:#FFF; background-color:#333;">
    <div class="container">
    	<!-- Content here -->
      <div class="row justify-content-md-center">
        <div class="col"></div>
        <div class="col"><img src="<?php echo $empresa_logo; ?>" class="custom-logo" alt="<?php echo $empresa_nome; ?>" width="200"></div>
        <div class="col"></div>
      </div>

<?php 
// inclui as classes do PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if(isset($_POST['submit'])) {

$inscricao_charset = $_POST['inscricao_charset'];
$inscricao = $_POST['inscricao'];
$titulo_original = $_POST['titulo_original'];
$titulo_ingles = $_POST['titulo_ingles'];
$diretor = $_POST['diretor'];
$pais1_alpha3 = $_POST['pais1_alpha3'];
$pais2_alpha3 = $_POST['pais2_alpha3'];
$pais3_alpha3 = $_POST['pais3_alpha3'];
$pais4_alpha3 = $_POST['pais4_alpha3'];
$pais5_alpha3 = $_POST['pais5_alpha3'];
$ano = $_POST['ano'];
$duracao = $_POST['duracao'];
$filme_website = $_POST['filme_website'];
$premios = $_POST['premios'];
$classificacao = $_POST['classificacao'];
$categoria = $_POST['categoria'];
$bitola_inscricao = $_POST['bitola_inscricao'];
$definicaodigital = $_POST['definicaodigital'];
$janela = $_POST['janela'];
$cor = $_POST['cor'];
$som = $_POST['som'];
$idioma1_dci = $_POST['idioma1_dci'];
$idioma2 = $_POST['idioma2'];
$leg_copia_dci = $_POST['leg_copia_dci'];
$leg_copiaselecao_dci = $_POST['leg_copiaselecao_dci'];
$acessibilidade_ad = $_POST['acessibilidade_ad'];
$acessibilidade_ccap = $_POST['acessibilidade_ccap'];
$acessibilidade_libras = $_POST['acessibilidade_libras'];
$rolos = $_POST['rolos'];
$copia_selecao = $_POST['copia_selecao'];
$link_selecao = $_POST['link_selecao'];
$link_password = $_POST['link_password'];
$distribuidora_empresa = $_POST['distribuidora_empresa'];
$distribuidora_contatonome = $_POST['distribuidora_contatonome'];
$distribuidora_telefone = $_POST['distribuidora_telefone'];
$distribuidora_celular = $_POST['distribuidora_celular'];
$distribuidora_fax = $_POST['distribuidora_fax'];
$distribuidora_email = $_POST['distribuidora_email'];
$distribuidora_cep = $_POST['distribuidora_cep'];
$distribuidora_logradouro = $_POST['distribuidora_logradouro'];
$distribuidora_numero = $_POST['distribuidora_numero'];
$distribuidora_complemento = $_POST['distribuidora_complemento'];
$distribuidora_bairro = $_POST['distribuidora_bairro'];
$distribuidora_cidade = $_POST['distribuidora_cidade'];
$distribuidora_uf = $_POST['distribuidora_uf'];
$distribuidora_website = $_POST['distribuidora_website'];
$produtora_empresa = $_POST['produtora_empresa'];
$produtora_contatonome = $_POST['produtora_contatonome'];
$produtora_telefone = $_POST['produtora_telefone'];
$produtora_celular = $_POST['produtora_celular'];
$produtora_fax = $_POST['produtora_fax'];
$produtora_email = $_POST['produtora_email'];
$produtora_cep = $_POST['produtora_cep'];
$produtora_logradouro = $_POST['produtora_logradouro'];
$produtora_numero = $_POST['produtora_numero'];
$produtora_complemento = $_POST['produtora_complemento'];
$produtora_bairro = $_POST['produtora_bairro'];
$produtora_cidade = $_POST['produtora_cidade'];
$produtora_uf = $_POST['produtora_uf'];
$produtora_website = $_POST['produtora_website'];
$produtora_curriculo = $_POST['produtora_curriculo'];
$material_divulgacao = $_POST['material_divulgacao'];
$fotos_papel = $_POST['fotos_papel'];
$cartazete = $_POST['cartazete'];
$banner = $_POST['banner'];
$press_kit = $_POST['press_kit'];
$trailer = $_POST['trailer'];
$showcase = $_POST['showcase'];
$diretor_telefone = $_POST['diretor_telefone'];
$diretor_celular = $_POST['diretor_celular'];
$diretor_fax = $_POST['diretor_fax'];
$diretor_email = $_POST['diretor_email'];
$diretor_website = $_POST['diretor_website'];
$diretor_disponivel = $_POST['diretor_disponivel'];
$roteiro = $_POST['roteiro'];
$producao = $_POST['producao'];
$coproducao = $_POST['coproducao'];
$fotografia = $_POST['fotografia'];
$montagem = $_POST['montagem'];
$arte = $_POST['arte'];
$somedicao = $_POST['somedicao'];
$musica = $_POST['musica'];
$figurino = $_POST['figurino'];
$elenco = $_POST['elenco'];
$sinopse_br = $_POST['sinopse_br'];
$diretor_biografia_br = $_POST['diretor_biografia_br'];
$diretor_filmografia = $_POST['diretor_filmografia'];
$destino_contato = $_POST['destino_contato'];
$destino_cep = $_POST['destino_cep'];
$destino_logradouro = $_POST['destino_logradouro'];
$destino_numero = $_POST['destino_numero'];
$destino_complemento = $_POST['destino_complemento'];
$destino_bairro = $_POST['destino_bairro'];
$destino_cidade = $_POST['destino_cidade'];
$destino_uf = $_POST['destino_uf'];
$destino_telefone = $_POST['destino_telefone'];
$destino_celular = $_POST['destino_celular'];
$destino_fax = $_POST['destino_fax'];
$destino_email = $_POST['destino_email'];
$destino_shippinginstruction = $_POST['destino_shippinginstruction'];
$observacoes = $_POST['observacoes'];
$regulamento = $_POST['regulamento'];

$uf = $_POST['produtora_uf'];

$distribuidora_endereco = $distribuidora_logradouro.", ".$distribuidora_numero." / ".$distribuidora_complemento." - ".$distribuidora_bairro." - ".$distribuidora_cidade." - ".$distribuidora_uf." | ".$distribuidora_cep;

$produtora_endereco = $produtora_logradouro.", ".$produtora_numero." / ".$produtora_complemento." - ".$produtora_bairro." - ".$produtora_cidade." - ".$produtora_uf." | ".$produtora_cep;

$destino_endereco = $destino_logradouro.", ".$destino_numero." / ".$destino_complemento." - ".$destino_bairro." - ".$destino_cidade." - ".$destino_uf." | ".$destino_cep;


$remetente = "formulario@bruno-sa.com"; // INSIRA AQUI UM EMAIL CRIADO EM SUA HOSPEDAGEM PARA QUE A MENSAGEM SEJA ENVIADA CORRETAMENTE.
$nomeRemetente = "Form Festival do Rio"; // INSIRA AQUI O NOME PARA APARECER NO CAMPO FROM.
$destinatario = "inscricao_".$inscricao."@bruno-sa.com"; // INSIRA AQUI O ENDEREÇO DO DESTINATÁRIO DO E-MAIL.
$assunto = "[INSCRICAO ". $inscricao." ] ".$titulo_original.", de ".$diretor."\r\n";

$corpo = $titulo_original."<br /><br />".$diretor."<br />".$duracao." min<br />".$bitola_inscricao."\r\n";

$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=".$inscricao_charset."\r\n";
$headers .= "Reply-To: ".$produtora_email."\r\n";
//$headers .= "Cc: copia@seudominio\r\n"; //CAMPO COPIA OPCIONAL
//$headers .= "Bcc: copiaoculta@seudominio\r\n"; //CAMPO COPIA OCULTA OPCIONAL
$headers .= "From: ".$remetente."\r\n";

echo '<p class="txt_corrido"><img src="../../festivaldorioint_pb.png" width="213" height="107" alt="Festival do Rio" /></p>
<p class="txt_corrido">FICHA DE INSCRIÇÃO PREMIÈRE BRASIL</p>';

//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
//date_default_timezone_set('Etc/UTC');

require $_SERVER['DOCUMENT_ROOT'].'/_PHPMailer-master/src/PHPMailer.php';
require $_SERVER['DOCUMENT_ROOT'].'/_PHPMailer-master/src/SMTP.php';
require $_SERVER['DOCUMENT_ROOT'].'/_PHPMailer-master/src/Exception.php';

//Create a new PHPMailer instance
$mail = new PHPMailer();

//Define Charset
$mail->CharSet = 'UTF-8';

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 0;

//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';

//Set the hostname of the mail server
$mail->Host = 'smtp.bruno-sa.com';

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;

//Set the encryption system to use - ssl (deprecated) or tls
//$mail->SMTPSecure = 'tls';

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "formulario@bruno-sa.com";

//Password to use for SMTP authentication
$mail->Password = "Bb852963";

//Set who the message is to be sent from
$mail->setFrom($remetente, $nomeRemetente);

//Set an alternative reply-to address
$mail->addReplyTo($produtora_email, $produtora_contatonome);

//Set who the message is to be sent to
$mail->addAddress($destinatario, $inscricao);

//Set the subject line
$mail->Subject = $assunto;

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML($corpo);

//Replace the plain text body with one created manually
$mail->AltBody = $corpo;

//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');

//send the message, check for errors
if (!$mail->send()) {
//    echo "x" . $mail->ErrorInfo;
} else {
    echo "@";
}

//if(mail($destinatario, $assunto, $corpo, $headers)) {
//echo '<p class="txt_corrido"><b>' . $diretor . '</b>, Sua ficha foi enviada. Obrigado.';
//}
//else {
//echo '<p class="txt_corrido"><b>' . $diretor . '</b>, ocorreu um erro.<br />Tente novamente, por favor.</p>';
//}
//}
//else {
//echo '<p class="txt_corrido">we have an error..<br />Tente novamente, por favor.</p>';
}




/*
$con = mysqli_connect("dbmy0102.whservidor.com","filmesdoes_1","Fr3d3r1c0-DB","filmesdoes_1");
if (!$con)
  {
  die('Could not connect: ' . mysqli_error());
  }
*/

$sql_pais1 = "SELECT pais_ptbr, pais_alpha3 FROM _pais WHERE pais_alpha3 = '".$pais1_alpha3."'" ;
$result_pais1 = mysqli_query($con, $sql_pais1);
while( $row_pais1 = mysqli_fetch_array($result_pais1) ){
    $pais1 = $row_pais1['pais_ptbr'];
}

$sql_pais2 = "SELECT pais_ptbr, pais_alpha3 FROM _pais WHERE pais_alpha3 = '".$pais2_alpha3."'" ;
$result_pais2 = mysqli_query($con, $sql_pais2);
while( $row_pais2 = mysqli_fetch_array($result_pais2) ){
    $pais2 = $row_pais2['pais_ptbr'];
}

$sql_pais3 = "SELECT pais_ptbr, pais_alpha3 FROM _pais WHERE pais_alpha3 = '".$pais3_alpha3."'" ;
$result_pais3 = mysqli_query($con, $sql_pais3);
while( $row_pais3 = mysqli_fetch_array($result_pais3) ){
    $pais3 = $row_pais3['pais_ptbr'];
}

$sql_pais4 = "SELECT pais_ptbr, pais_alpha3 FROM _pais WHERE pais_alpha3 = '".$pais4_alpha3."'" ;
$result_pais4 = mysqli_query($con, $sql_pais4);
while( $row_pais4 = mysqli_fetch_array($result_pais4) ){
    $pais4 = $row_pais4['pais_ptbr'];
}

$sql_pais5 = "SELECT pais_ptbr, pais_alpha3 FROM _pais WHERE pais_alpha3 = '".$pais5_alpha3."'" ;
$result_pais5 = mysqli_query($con, $sql_pais5);
while( $row_pais5 = mysqli_fetch_array($result_pais5) ){
    $pais5 = $row_pais5['pais_ptbr'];
}

$sql_idioma1 = "SELECT idioma_pt, idioma_dci FROM _idioma WHERE idioma_dci = '".$idioma1_dci."'" ;
$result_idioma1 = mysqli_query($con, $sql_idioma1);
while( $row_idioma1 = mysqli_fetch_array($result_idioma1) ){
    $idioma1 = $row_idioma1['idioma_pt'];
}

$sql_leg_copia = "SELECT idioma_pt, idioma_dci FROM _idioma WHERE idioma_dci = '".$leg_copia_dci."'" ;
$result_leg_copia = mysqli_query($con, $sql_leg_copia);
while( $row_leg_copia = mysqli_fetch_array($result_leg_copia) ){
    $leg_copia = $row_leg_copia['idioma_pt'];
}

$sql_leg_copiaselecao = "SELECT idioma_pt, idioma_dci FROM _idioma WHERE idioma_dci = '".$leg_copiaselecao_dci."'" ;
$result_leg_copiaselecao = mysqli_query($con, $sql_leg_copiaselecao);
while( $row_leg_copiaselecao = mysqli_fetch_array($result_leg_copiaselecao) ){
    $leg_copiaselecao = $row_leg_copiaselecao['idioma_pt'];
}

$sql="INSERT INTO festrio_inscricao (
inscricao_charset,
inscricao, 
titulo_original, 
titulo_ingles, 
diretor, 
uf, 
pais1, 
pais2,
pais3,
pais4,
pais5,
pais1_alpha3, 
pais2_alpha3, 
pais3_alpha3, 
pais4_alpha3, 
pais5_alpha3, 
ano, 
duracao, 
filme_website, 
premios, 
classificacao,
categoria, 
bitola_inscricao, 
definicaodigital, 
janela, 
cor, 
som, 
idioma1, 
idioma2, 
leg_copia, 
leg_copiaselecao, 
idioma1_dci, 
leg_copia_dci, 
leg_copiaselecao_dci,
acessibilidade_ad, 
acessibilidade_ccap, 
acessibilidade_libras, 
rolos, 
copia_selecao, 
link_selecao, 
link_password, 
distribuidora_empresa, 
distribuidora_contatonome, 
distribuidora_telefone, 
distribuidora_celular, 
distribuidora_fax, 
distribuidora_email, 
distribuidora_cep, 
distribuidora_endereco, 
distribuidora_website, 
produtora_empresa, 
produtora_contatonome, 
produtora_telefone, 
produtora_celular, 
produtora_fax, 
produtora_email, 
produtora_endereco, 
produtora_cidade, 
produtora_cep, 
produtora_website, 
produtora_curriculo, 
material_divulgacao, 
fotos_papel, 
cartazete, 
banner, 
press_kit, 
trailer, 
showcase, 
diretor_telefone, 
diretor_celular, 
diretor_fax, 
diretor_email, 
diretor_website, 
diretor_disponivel, 
roteiro, 
producao, 
coproducao, 
fotografia, 
montagem, 
arte, 
somedicao, 
musica, 
figurino, 
elenco, 
sinopse_br, 
diretor_biografia_br, 
diretor_filmografia, 
destino_cidade, 
destino_contato, 
destino_endereco, 
destino_cep, 
destino_telefone, 
destino_celular, 
destino_fax, 
destino_email, 
destino_shippinginstruction, 
observacoes, 
regulamento)

VALUES

('$inscricao_charset','$inscricao','$titulo_original','$titulo_ingles','$diretor','$uf','$pais1','$pais2','$pais3','$pais4','$pais5','$pais1_alpha3','$pais2_alpha3','$pais3_alpha3','$pais4_alpha3','$pais5_alpha3','$ano','$duracao','$filme_website','$premios','$classificacao','$categoria','$bitola_inscricao','$definicaodigital','$janela','$cor','$som','$idioma1','$idioma2','$leg_copia','$leg_copiaselecao','$idioma1_dci','$leg_copia_dci','$leg_copiaselecao_dci','$acessibilidade_ad','$acessibilidade_ccap','$acessibilidade_libras','$rolos','$copia_selecao','$link_selecao','$link_password','$distribuidora_empresa','$distribuidora_contatonome','$distribuidora_telefone','$distribuidora_celular','$distribuidora_fax','$distribuidora_email','$distribuidora_cep','$distribuidora_endereco','$distribuidora_website','$produtora_empresa','$produtora_contatonome','$produtora_telefone','$produtora_celular','$produtora_fax','$produtora_email','$produtora_endereco','$produtora_cidade','$produtora_cep','$produtora_website','$produtora_curriculo','$material_divulgacao','$fotos_papel','$cartazete','$banner','$press_kit','$trailer','$showcase','$diretor_telefone','$diretor_celular','$diretor_fax','$diretor_email','$diretor_website','$diretor_disponivel','$roteiro','$producao','$coproducao','$fotografia','$montagem','$arte','$somedicao','$musica','$figurino','$elenco','$sinopse_br','$diretor_biografia_br','$diretor_filmografia','$destino_cidade','$destino_contato','$destino_endereco','$destino_cep','$destino_telefone','$destino_celular','$destino_fax','$destino_email','$destino_shippinginstruction','$observacoes','$regulamento')";

if (!mysqli_query($con, $sql))
  {
  die('Error: ' . mysqli_error($con));
  }


$sql_inscricao = "SELECT * FROM festrio_inscricao ORDER BY idmysql_inscricao DESC LIMIT 1";
$result_inscricao = mysqli_query($con, $sql_inscricao);
while($row_inscricao = mysqli_fetch_array($result_inscricao))
{
    $seq_pelicularev = $row_inscricao['seq_pelicularev'];
	$idmysql_inscricao = $row_inscricao['idmysql_inscricao'];
	$titulo_original = $row_inscricao['titulo_original'];
	$diretor = $row_inscricao['diretor'];
	$titulo_ingles = $row_inscricao['titulo_ingles'];
	$duracao = $row_inscricao['duracao'];
	$classificacao = $row_inscricao['classificacao'];
	$bitola_inscricao = $row_inscricao['bitola_inscricao'];
	$definicaodigital = $row_inscricao['definicaodigital'];
	$janela = $row_inscricao['janela'];
	$cor = $row_inscricao['cor'];
	$som = $row_inscricao['som'];
	$idioma1 = $row_inscricao['idioma1'];
	$idioma2 = $row_inscricao['idioma2'];
	$leg_copia = $row_inscricao['leg_copia'];
	$roteiro = $row_inscricao['roteiro'];
	$produtora_empresa = $row_inscricao['produtora_empresa'];
	$producao = $row_inscricao['producao'];
	$coproducao = $row_inscricao['coproducao'];
	$fotografia = $row_inscricao['fotografia'];
	$montagem = $row_inscricao['montagem'];
	$musica = $row_inscricao['musica'];
	$elenco = $row_inscricao['elenco'];
	$sinopse_br = $row_inscricao['sinopse_br'];
	$diretor_biografia_br = $row_inscricao['diretor_biografia_br'];
	$filmografia = $row_inscricao['filmografia'];
	$selos = $row_inscricao['selos'];
	$timestamp = $row_inscricao['timestamp'];
	} 
?>

<h1>Formulário de Inscrição - pt-br</h1>
</br>
</br>
<p><strong>Premiére Brasil</br>
sugerimos que salve esta página (com print screen, ou copie e salve em documento de word) para seu conforto e segurança.</br>Número de inscrição: </strong><?php echo $idmysql_inscricao; ?></br>
</br>
<strong>Título Original: </strong><?php echo $titulo_original; ?></br>
</br>
<strong>Título Inglês: </strong><?php echo $titulo_ingles; ?></br>
</br>
<strong>Direção: </strong><?php echo $diretor; ?></br>
</br>
<strong>País1: </strong><?php echo $pais1; ?> (<?php echo $pais1_alpha3; ?>)</br>
</br>
<strong>País2: </strong><?php echo $pais2; ?> (<?php echo $pais2_alpha3; ?>)</br>
</br>
<strong>País3: </strong><?php echo $pais3; ?> (<?php echo $pais3_alpha3; ?>)</br>
</br>
<strong>País4: </strong><?php echo $pais4; ?> (<?php echo $pais4_alpha3; ?>)</br>
</br>
<strong>País5: </strong><?php echo $pais5; ?> (<?php echo $pais5_alpha3; ?>)</br>
</br>
<strong>Ano: </strong><?php echo $ano; ?></br>
</br>
<strong>Duração: </strong><?php echo $duracao; ?></br>
</br>
<strong>Classificação: </strong><?php echo $classificacao; ?></br>
</br>
<strong>Bitola: </strong><?php echo $bitola_inscricao; ?></br>
</br>
<strong>Janela: </strong><?php echo $janela; ?></br>
</br>
<strong>Cor: </strong><?php echo $cor; ?></br>
</br>
<strong>Som: </strong><?php echo $som; ?></br>
</br>
<strong>Roteiro: </strong><?php echo $roteiro; ?></br>
</br>
<strong>Produção: </strong><?php echo $producao; ?></br>
</br>
<strong>Co-Produção: </strong><?php echo $coproducao; ?></br>
</br>
<strong>Fotografia: </strong><?php echo $fotografia; ?></br>
</br>
<strong>Montagem: </strong><?php echo $montagem; ?></br>
</br>
<strong>Direção de Arte: </strong><?php echo $arte; ?></br>
</br>
<strong>Edição de som: </strong><?php echo $somedicao; ?></br>
</br>
<strong>Música:</strong><?php echo $musica; ?></br>
</br>
<strong>Elenco: </strong><?php echo nl2br($elenco); ?></br>
</br>
<strong>Sinopse: </strong><?php echo nl2br($sinopse_br); ?></br>
</br>
<strong>Biografia: </strong><?php echo nl2br($diretor_biografia_br); ?></br>
</br>
</br>

<strong>Data e hora da inscrição: </strong><?php echo $timestamp; ?></p>

<p class="resumo_regulamento"><strong>Dúvidas: </strong> <a href="mailto:bruno@bruno-sa.com">bruno@bruno-sa.com</a></p>

		<hr>
		<div class="d-flex justify-content-center">
			<small>
			<small>Desenvolvido por Bruno Sá - <a href='//www.bruno-sa.com' target='_blank'>www.bruno-sa.com</a></small>
			</small>
		</div>
		<!-- Optional JavaScript; choose one of the two! -->

		<!-- Option 2: Separate Popper and Bootstrap JS -->
		<script src="https://unpkg.com/@popperjs/core@2"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
	</body>
</html>
<?php mysqli_close($con) ?>