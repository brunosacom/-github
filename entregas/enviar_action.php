<?php require $_SERVER['DOCUMENT_ROOT'].'/php/mysqli_connect.php'; //MySqlDB connect brunosacom ?>

<!DOCTYPE HTML>
    <html lang="pt-br">
      <head>
        <?php include_once $_SERVER['DOCUMENT_ROOT'].'/php/analyticstracking.php'; ?>
        <!-- Required meta tags -->
        <meta charset="utf-8">

        <?php

          // inclui as classes do PHPMailer
          use PHPMailer\PHPMailer\PHPMailer;
          use PHPMailer\PHPMailer\Exception;

          if(isset($_POST['submit'])) {
            $charset = $_POST['charset'];
            $entrega_status = $_POST['entrega_status'];
            $empresa_sigla = $_POST['empresa_sigla'];
            $entrega_entregador = $_POST['entrega_entregador'];
            $entrega_numeropedido = $_POST['entrega_numeropedido'];
            $entrega_onde = $_POST['entrega_onde'];
            $entrega_quemoutro = $_POST['entrega_quemoutro'];
            $entrega_comunicacao = $_POST['entrega_comunicacao'];
            $entrega_imgrecibo = $_FILES['entrega_imgrecibo']['name'];
            $cliente_celular = $_POST['cliente_celular'];


            $sql_cliente = "SELECT * FROM bembos_entrega WHERE pedido_numero = $entrega_numeropedido ORDER BY pedido_numero ASC";
            $cliente_data = mysqli_query($con,$sql_cliente);
            while($row = mysqli_fetch_assoc($cliente_data) ){
              $cliente_celular = $row['cliente_celular'];
            }


            $clientecelular_numeros = preg_replace('/[^0-9]/', '', $cliente_celular);

            $quemoutro_convert = preg_replace('/[" "]/', '%20', $entrega_quemoutro);

            $whatsapp_entregue = "https://wa.me/55".$clientecelular_numeros."?text=Seu%20pedido%20".$entrega_numeropedido."%20foi%20entregue.";
            $whatsapp_recebimento = "https://wa.me/55".$clientecelular_numeros."?text=Foi%20deixado%20com%20".$entrega_onde.",%20recebido%20por%20".$quemoutro_convert.".";

            // pegar infos do banco de dados
            $sql_empresa = "SELECT * FROM bembos_empresa WHERE empresa_sigla = '$empresa_sigla'";
            $result_empresa = mysqli_query($con, $sql_empresa);
            while( $row_empresa = mysqli_fetch_array($result_empresa) ) {
              $empresa_logo = $row_empresa['empresa_logo'];
              $empresa_favicon = $row_empresa['empresa_favicon'];
              $empresa_nome = $row_empresa['empresa_nome'];
              $empresa_whatsapp = $row_empresa['empresa_whatsapp'];
              $empresa_emailto = $row_empresa['empresa_emailto'];
              $empresa_emailtonome = $row_empresa['empresa_emailtonome'];
              $empresa_smtp = $row_empresa['empresa_smtp'];
              $empresa_username = $row_empresa['empresa_username'];
              $empresa_password = $row_empresa['empresa_password'];
              $empresa_emailfrom = $row_empresa['empresa_emailfrom'];
              $empresa_emailfromnome = $row_empresa['empresa_emailfromnome'];
            };
    
            //campos novos
            $current_timestamp = date('Y-m-d H:i:s');

            //montar campos do email
            $assunto = "[".$empresa_sigla."]: Entrega #".$entrega_numeropedido."";
      
            $corpo = "Entregador: <b>".$entrega_entregador."</b><br/>Numero do Pedido: <b>".$entrega_numeropedido."</b><br/>Comunicacao: <b>".$entrega_comunicacao."</b><br/>Onde entregou: <b>".$entrega_onde."</b><br/>Outro: <b>".$entrega_quemoutro."</b><br/>Recibo Imagem: <b>".$entrega_imgrecibo."</b><br/>TimeStamp envio: <b>".$current_timestamp."</b><br/>WhatsApp Entregue: <b>".$whatsapp_entregue."</b><br/>Whatsapp recebimento: <b>".$whatsapp_recebimento."</b><br/>";

      


            // inclui os arquivos
            require $_SERVER['DOCUMENT_ROOT'].'/_PHPMailer-master/src/PHPMailer.php';
            require $_SERVER['DOCUMENT_ROOT'].'/_PHPMailer-master/src/SMTP.php';
            require $_SERVER['DOCUMENT_ROOT'].'/_PHPMailer-master/src/Exception.php';

            // inicia a classe PHPMailer habilitando o disparo de exceções
            $mail = new PHPMailer(true);
            try {
              // habilita o debug
              // 0 = em mensagens de debug
              // 1 = mensagens do cliente SMTP
              // 2 = mensagens do cliente e do servidor SMTP
              // 3 = igual o 2, incluindo detalhes da conexão
              // 4 = igual o 3, inlcuindo mensagens de debug baixo-nível
              $mail->SMTPDebug = 0;
        
              // utilizar SMTP
              $mail->isSMTP();

              // habilita autenticação SMTP
              $mail->SMTPAuth = true;

              // servidor SMTP
              $mail->Host = $empresa_smtp; 

              // usuário, senha e porta do SMTP
              $mail->Username = $empresa_username;
              $mail->Password = $empresa_password;
              $mail->Port = 587;
              
              // tipo de criptografia: "tls" ou "ssl"
              //$mail->SMTPSecure = 'tls';
              
              // email e nome do remetente
              $mail->setFrom($empresa_emailfrom, $empresa_emailfromnome);
              
              // Email e nome do(s) destinatário(s)
              // você pode chamar addAddress quantas vezes quiser, para
              // incluir diversos destinatários
              $mail->addAddress($empresa_emailto, $empresa_emailtonome);
              
              // endereço que receberá as respostas
              //$mail->addReplyTo($email, $nome); 
              
              // com cópia (CC) e com cópia oculta (BCC)
              //$mail->addCC('copia@site.com');
              //$mail->addBCC('copia_oculta@site.com');
              
              // anexa um arquivo
              //$mail->addAttachment($arquivo, $arquivo);
              if (!empty($entrega_imgrecibo)) {
              $mail->AddAttachment($_FILES['entrega_imgrecibo']['tmp_name'], $_FILES['entrega_imgrecibo']['name']);
              }

              // define o formato como HTML
              $mail->isHTML(true);
              
              // codificação UTF-8
              $mail->CharSet = $charset;
              
              // assunto do email
              $mail->Subject = $assunto;
              
              // corpo do email em HTML
              $mail->Body    = $corpo;
              
              // corpo do email em texto
              $mail->AltBody = $corpo;
              
              // envia o email
              $mail->send();

              echo '@' . PHP_EOL;
            }

            catch (Exception $e) {
              echo 'Falha ao enviar email.' . PHP_EOL;
              echo 'Erro: ' . $mail->ErrorInfo . PHP_EOL;
            }

            //update MySQL database
            $sql="UPDATE bembos_entrega SET charset = '$charset', entrega_status = '$entrega_status', entrega_entregador = '$entrega_entregador', entrega_onde = '$entrega_onde', entrega_quemoutro = '$entrega_quemoutro', entrega_comunicacao = '$entrega_comunicacao', entrega_imgrecibo = '$entrega_imgrecibo', entrega_timestamp = '$current_timestamp' WHERE pedido_numero = '$entrega_numeropedido' AND empresa_sigla = '$empresa_sigla'";

            if (!mysqli_query($con, $sql)) {
              die('Error: ' . mysqli_error($con));
            }
          }
        ?>
      
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $empresa_nome ?> - Entrega</title>
        <link rel="shortcut icon" href="<?php echo $empresa_favicon; ?>">
        <link href="https://fonts.googleapis.com/css?family=Didact Gothic" rel="stylesheet">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
      </head>
    
      <body style="font-family: Didact Gothic;">
        <div class="container">
          <!-- Content here -->
          <br>
          <div class="row justify-content-md-center">
            <div class="col"></div>
            <div class="col"><img src="<?php echo $empresa_logo ?>" class="custom-logo" alt="<?php echo $empresa_nome ?>" width="200"></div>
            <div class="col"></div>
          </div>
          <br><br>
    
          <h3>Mensagem enviada, entrega <b>#<?php echo $entrega_numeropedido ?></b> registrada com sucesso!</h3>
          <br>
          <p>Entregador: <b><?php echo $entrega_entregador ?></b><br/>
            Numero do Pedido: <b><?php echo $entrega_numeropedido ?></b><br/>
            Comunicação com cliente: <b><?php echo $entrega_comunicacao ?></b><br/>
            Onde entregou: <b><?php echo $entrega_onde ?></b><br/>
            Outro: <b><?php echo $entrega_quemoutro ?></b><br/>
            Recibo Imagem: <b><?php echo $entrega_imgrecibo ?></b><br/>
            TimeStamp envio: <b><?php echo $current_timestamp ?></b>
          </p>
          <div class="row justify-content-center">
            <div><small><small>Desenvolvido por Bruno Sá - <a href="//www.bruno-sa.com" target="_blank">www.bruno-sa.com</a></small></small></div>
          </div>
        </div>

        <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 2: Separate Popper and Bootstrap JS -->
        <script src="https://unpkg.com/@popperjs/core@2"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
      </body>
    </html>
<?php mysqli_close($con); ?>