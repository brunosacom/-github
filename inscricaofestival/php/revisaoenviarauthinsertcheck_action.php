<?php require $_SERVER['DOCUMENT_ROOT'].'/php/mysqli_connect.php'; ?> <!-- MySqlDB connect brunosacom -->

<?php

// URL EXEMPLO
//https://www.bruno-sa.com/bembos/festivalinscricao/index.php?emp_sigla='BMB'

$emp_sigla = $_GET['emp_sigla'];

$today = date('Y-m-d');


$sql_empresa = "SELECT * FROM bembos_empresa WHERE empresa_sigla = $emp_sigla";
$result_empresa = mysqli_query($con, $sql_empresa);
while ($row_empresa = mysqli_fetch_array($result_empresa)) {
  $empresa_logo = $row_empresa['empresa_logo'];
  $empresa_favicon = $row_empresa['empresa_favicon'];
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

<html lang="pt-br">

	<head>
		<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/php/analyticstracking.php'; ?>
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
				$seq_pelicularev = $_POST['seq_pelicularev'];
				$titulo_original = $_POST['titulo_original'];
				$titulo_ingles = $_POST['titulo_ingles'];
				$diretor = $_POST['diretor'];
				$ano = $_POST['ano'];
				$duracao = $_POST['duracao'];
				$classificacao = $_POST['classificacao'];
				$bitola_inscricao = $_POST['bitola_inscricao'];
				$definicaodigital = $_POST['definicaodigital'];
				$janela = $_POST['janela'];
				$cor = $_POST['cor'];
				$som = $_POST['som'];
				$idioma1 = $_POST['idioma1'];
				$idioma2 = $_POST['idioma2'];
				$leg_copia = $_POST['leg_copia'];
				$roteiro = $_POST['roteiro'];
				$produtora_empresa = $_POST['produtora_empresa'];
				$producao = $_POST['producao'];
				$coproducao = $_POST['coproducao'];
				$fotografia = $_POST['fotografia'];
				$montagem = $_POST['montagem'];
				$arte = $_POST['arte'];
				$somedicao = $_POST['somedicao'];
				$musica = $_POST['musica'];
				$elenco = $_POST['elenco'];
				$sinopse_br = $_POST['sinopse_br'];
				$diretor_biografia_br = $_POST['diretor_biografia_br'];
				$diretor_filmografia = $_POST['diretor_filmografia'];
				$printsource_completo = $_POST['printsource_completo'];
				$cpb = addslashes($_POST['cpb']);
				$apresentacaoconvite = $_POST['apresentacaoconvite'];
				$selos = addslashes($_POST['selos']);



				$remetente = "formulario@bruno-sa.com"; // INSIRA AQUI UM EMAIL CRIADO EM SUA HOSPEDAGEM PARA QUE A MENSAGEM SEJA ENVIADA CORRETAMENTE.
				$nomeRemetente = "Form BEMBOS Revisão Festival"; // INSIRA AQUI O NOME PARA APARECER NO CAMPO FROM.
				$destinatario = "inscricao_".$inscricao."@bruno-sa.com"; // INSIRA AQUI O ENDEREÇO DO DESTINATÁRIO DO E-MAIL.
				$assunto = "[REVISAO ".$inscricao." ] ".$titulo_original.", de ".$diretor."\r\n";

				$corpo = $titulo_original."<br /><br />".$diretor."<br />".$duracao." min<br />".$bitola_inscricao."\r\n";

				$headers = "MIME-Version: 1.0\r\n";
				$headers .= "Content-type: text/html; charset=".$inscricao_charset."\r\n";
				//$headers .= "Reply-To: " . $produtora_email . "\r\n";
				//$headers .= "Cc: copia@seudominio\r\n"; //CAMPO COPIA OPCIONAL
				//$headers .= "Bcc: copiaoculta@seudominio\r\n"; //CAMPO COPIA OCULTA OPCIONAL
				$headers .= "From: ".$remetente."\r\n";

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
			}

			$sql_idioma1 = "SELECT idioma_pt, idioma_dci FROM _idioma WHERE idioma_dci = '".$idioma1_dci."'" ;
			$result_idioma1 = mysqli_query($con, $sql_idioma1);
			while( $row_idioma1 = mysqli_fetch_array($result_idioma1) ){
				$idioma1 = $row_idioma1['idioma_pt'];
			}

			$sql_idioma2 = "SELECT idioma_pt, idioma_dci FROM _idioma WHERE idioma_dci = '".$idioma2_dci."'" ;
			$result_idioma2 = mysqli_query($con, $sql_idioma2);
			while( $row_idioma2 = mysqli_fetch_array($result_idioma2) ){
				$idioma2 = $row_idioma2['idioma_pt'];
			}

			$sql="INSERT INTO festrio_inscricao (
			inscricao_charset,
			inscricao, 
			seq_pelicularev, 
			titulo_original, 
			titulo_ingles, 
			diretor, 
			ano, 
			duracao, 
			classificacao,
			bitola_inscricao, 
			definicaodigital, 
			janela, 
			cor, 
			som, 
			idioma1, 
			idioma2, 
			leg_copia, 
			roteiro, 
			produtora_empresa, 
			producao, 
			coproducao, 
			fotografia, 
			montagem, 
			arte, 
			somedicao, 
			musica, 
			elenco, 
			sinopse_br, 
			diretor_biografia_br, 
			diretor_filmografia, 
			printsource_completo, 
			cpb, 
			apresentacaoconvite, 
			selos)

			VALUES

			('$inscricao_charset','$inscricao','$seq_pelicularev','$titulo_original','$titulo_ingles','$diretor','$ano','$duracao','$classificacao','$bitola_inscricao','$definicaodigital','$janela','$cor','$som','$idioma1','$idioma2','$leg_copia','$roteiro','$produtora_empresa','$producao','$coproducao','$fotografia','$montagem','$arte','$somedicao','$musica','$elenco','$sinopse_br','$diretor_biografia_br','$diretor_filmografia','$printsource_completo','$cpb','$apresentacaoconvite','$selos')";

			if (!mysqli_query($con, $sql)) {
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
				$ano = $row_inscricao['ano'];
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

			<h1>Formulário de Revisão - pt-br</h1>
			</br>
			</br>
			<p>
				<strong>sugerimos que salve esta página (com print screen, ou copie e salve em documento de word) para seu conforto e segurança.</strong></br>
				</br>
				OBS: somente os campos revisados são preenchidos</br>
				<strong>Número de inscrição: </strong><?php echo $seq_pelicularev; ?></br>
				</br>
				<strong>Número de revisão: </strong><?php echo $idmysql_inscricao; ?></br>
				</br>
				<strong>Título Original: </strong><?php echo $titulo_original; ?></br>
				</br>
				<strong>Título Inglês: </strong><?php echo $titulo_ingles; ?></br>
				</br>
				<strong>Direção: </strong><?php echo $diretor; ?></br>
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
				<strong>Música: </strong><?php echo $musica; ?></br>
				</br>
				<strong>Elenco: </strong><?php echo nl2br($elenco); ?></br>
				</br>
				<strong>Sinopse: </strong><?php echo nl2br($sinopse_br); ?></br>
				</br>
				<strong>Biografia: </strong><?php echo nl2br($diretor_biografia_br); ?></br>
				</br>
				</br>

				<strong>Data e hora da revisão: </strong><?php echo $timestamp; ?>
			</p>

			<p><strong>Dúvidas: </strong><a href="mailto:bruno@bruno-sa.com">bruno@bruno-sa.com</a></p>

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
		</div>
	</body>
</html>
<?php mysqli_close($con) ?>