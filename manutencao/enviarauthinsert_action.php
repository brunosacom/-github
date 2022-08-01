<?php require $_SERVER['DOCUMENT_ROOT'] . '/php/mysqli_connect.php'; ?> <!-- MySqlDB connect brunosacom -->

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

<!DOCTYPE HTML>
<html lang="pt-BR">

  <head>
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/php/analyticstracking.php'; ?>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $empresa_nome; ?> - Manutenção</title>
    <link href="https://fonts.googleapis.com/css?family=Didact Gothic" rel="stylesheet">
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/php/bootstrap_head.php'; ?>
  </head>

  <body style="font-family: Didact Gothic; color:#FFF; background-color:#333;">
    <div class="container">
    <!-- Content here -->

      <?php
      // inclui as classes do PHPMailer
      use PHPMailer\PHPMailer\PHPMailer;
      use PHPMailer\PHPMailer\Exception;

        if (isset($_POST['submit'])) {

          $manutencao_charset = $_POST['manutencao_charset'];
          $manutencao_status = addslashes($_POST['manutencao_status']);
          $manutencao_email = addslashes($_POST['manutencao_email']);
          $manutencao_cinema2 = addslashes($_POST['manutencao_cinema2']);
          $manutencao_cinema3 = addslashes($_POST['manutencao_cinema3']);
          $manutencao_area = addslashes($_POST['manutencao_area']);
          $manutencao_gerente = addslashes($_POST['manutencao_gerente']);
          $manutencao_tiposolicitacao = addslashes($_POST['manutencao_tiposolicitacao']);
          $manutencao_urgencia = addslashes($_POST['manutencao_urgencia']);
          $manutencao_relateproblema = addslashes($_POST['manutencao_relateproblema']);
          $manutencao_localizacao = addslashes($_POST['manutencao_localizacao']);

          $manutencao_cinema = 
          if ($manutencao_cinema2 = "") {
            $manutencao_cinema3
          } else {
            $manutencao_cinema2;
          }


          $remetente = "form@bruno-sa.com"; // INSIRA AQUI UM EMAIL CRIADO EM SUA HOSPEDAGEM PARA QUE A MENSAGEM SEJA ENVIADA CORRETAMENTE.
          $nomeRemetente = "Form BEMBOS Manutenção"; // INSIRA AQUI O NOME PARA APARECER NO CAMPO FROM.
          $destinatario = "bruno@bruno-sa.com"; // INSIRA AQUI O ENDEREÇO DO DESTINATÁRIO DO E-MAIL.
          $assunto = "[[" . $manutencao_cinema . " - " . $manutencao_area . " - " . $manutencao_tiposolicitacao . "]]" . "\r\n";

          $corpo =
            "LOCALIZACAO" . "<br/>" .
            "Cinema: " . $manutencao_cinema . "<br/>" .
            "Area: " . $manutencao_area . "<br/>" .
            "Localizacao: " . $manutencao_localizacao . "<br/>" .
            "Tipo: " . $manutencao_tiposolicitacao . "<br/><br/>" .

            "DESCRICAO" . "<br/>" .
            "Relato: " . $manutencao_relateproblema . "<br/><br/>" .

            "Status: " . $manutencao_status . "<br/><br/>" .

            "RESPONSAVEL" . "<br/>" .
            "Gerente: " . $manutencao_gerente . "<br/><br/>" . "\r\n";


          $headers = "MIME-Version: 1.0\r\n";
          $headers .= "Content-type: text/html; charset=" . $manutencao_charset . "\r\n";
          $headers .= "Reply-To: " . $manutencao_email . "\r\n";
          //$headers .= "Cc: copia@seudominio\r\n"; //CAMPO COPIA OPCIONAL
          //$headers .= "Bcc: copiaoculta@seudominio\r\n"; //CAMPO COPIA OCULTA OPCIONAL
          $headers .= "From: " . $remetente . "\r\n";

          //SMTP needs accurate times, and the PHP time zone MUST be set
          //This should be done in your php.ini, but this is how to do it if you don't have access to that
          //date_default_timezone_set('Etc/UTC');

          require $_SERVER['DOCUMENT_ROOT'] . '/_PHPMailer-master/src/PHPMailer.php';
          require $_SERVER['DOCUMENT_ROOT'] . '/_PHPMailer-master/src/SMTP.php';
          require $_SERVER['DOCUMENT_ROOT'] . '/_PHPMailer-master/src/Exception.php';



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

          // servidor SMTP
          $mail->Host = $empresa_smtp;

          // usuário, senha e porta do SMTP
          $mail->Username = $empresa_username;
          $mail->Password = $empresa_password;
          $mail->Port = 587;

          //Set the encryption system to use - ssl (deprecated) or tls
          //$mail->SMTPSecure = 'tls';

          //Whether to use SMTP authentication
          $mail->SMTPAuth = true;

          //Set who the message is to be sent from
          $mail->setFrom($remetente, $nomeRemetente);

          //Set an alternative reply-to address
          $mail->addReplyTo($manutencao_email, $manutencao_gerente);

          //Set who the message is to be sent to
          $mail->addAddress($destinatario, $emp_sigla);

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


        $sql = "INSERT INTO bembos_manutencao (manutencao_charset, manutencao_cinema, manutencao_urgencia, manutencao_area, manutencao_gerente, manutencao_tiposolicitacao, manutencao_relateproblema, manutencao_localizacao, manutencao_status, manutencao_email)
        VALUES
        ('$manutencao_charset','$manutencao_cinema','$manutencao_urgencia','$manutencao_area','$manutencao_gerente','$manutencao_tiposolicitacao','$manutencao_relateproblema','$manutencao_localizacao','$manutencao_status','$manutencao_email')";

        if (!mysqli_query($con, $sql)) {
          die('Error: ' . mysqli_error($con));
        }
        echo "<br>Obrigado por enviar a solicitacao/manutencao de " . $manutencao_cinema . ".<br>";
      ?>
    </div>
    <?php include_once $_SERVER['DOCUMENT_ROOT'].'/php/bootstrap_body.php'; ?>
  </body>
</html>
<?php mysqli_close($con); ?>