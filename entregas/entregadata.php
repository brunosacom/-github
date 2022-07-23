<?php require $_SERVER['DOCUMENT_ROOT'].'/php/mysqli_connect.php'; //MySqlDB connect brunosacom ?>

<?php
  if(isset($_POST['submit'])) {
    $charset = $_POST['charset'];
    $emp_sigla = $_POST['emp_sigla'];
    $entregadata = $_POST['entregadata'];
  };

  $sql_empresa = "SELECT * FROM bembos_empresa WHERE empresa_sigla = '$emp_sigla'";
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
    $empresa_entregador = $row_empresa['empresa_entregador'];
  }
?>

<!DOCTYPE HTML>
<html lang="pt-BR">

  <head>
    <?php include_once $_SERVER['DOCUMENT_ROOT'].'/php/analyticstracking.php'; ?>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $empresa_nome; ?> - Entrega</title>
    <link rel="shortcut icon" href="<?php echo $empresa_favicon; ?>">
    <link href="https://fonts.googleapis.com/css?family=Didact Gothic" rel="stylesheet">
    <?php include_once $_SERVER['DOCUMENT_ROOT'].'/php/bootstrap_head.php'; ?>
  </head>

  <body style="font-family: Didact Gothic;">
    <div class="container">
      <!-- Content here -->
      <br>
      <div class="row justify-content-md-center">
        <div class="col"></div>
        <div class="col"><img src="<?php echo $empresa_logo; ?>" class="custom-logo" alt="<?php echo $empresa_nome; ?>" width="200"></div>
        <div class="col"></div>
      </div>
      <br><br>
      <h1>Entregas para o dia <?php echo $entregadata; ?></h1>
      <form action="enviar_action.php" method="post" name="bembos_entrega" enctype="multipart/form-data">
        <input name="charset" type="hidden" id="charset" value="utf-8">
        <input name="empresa_sigla" type="hidden" id="empresa_sigla" value="<?php echo $empresa_sigla; ?>">
        <input name="entrega_status" type="hidden" id="entrega_status" value="concluido">
        <div class="mb-3">
        <label for="entrega_entregador" class="form-label">1. Entregador *</label>
          <select class="form-select" name="entrega_entregador" id="entrega_entregador" required>
            <option value="<?php echo $empresa_entregador ?>" selected><?php echo $empresa_entregador ?></option>
          </select>
          <div id="entregaentregadorHelp" class="form-text">Escolha o nome do entregador.</div>
        </div>

        <div class="mb-3">
          <label for="entrega_numeropedido" class="form-label">2. Número do Pedido *</label>
          <select class="form-select" name="entrega_numeropedido" id="entrega_numeropedido" required>
            <option value="" SELECTED>Escolha...</option>
            <?php 
            // Fetch Department
            $sql_pedidonome = "SELECT * FROM bembos_entrega WHERE entrega_status = 'processando' AND entrega_data = '$entregadata' ORDER BY pedido_numero ASC";
            $pedidonome_data = mysqli_query($con,$sql_pedidonome);
              while($row = mysqli_fetch_assoc($pedidonome_data) ){
                $pedido_numero = $row['pedido_numero'];
                $cliente_nome = $row['cliente_nome'];
      
                // Option
                echo "<option value=\"".$pedido_numero."\" >".$pedido_numero." - ".$cliente_nome."</option>";
              }
            ?>
          </select>
          <div id="entreganumeropedidoHelp" class="form-text">Escolha o número do pedido e nome da/o cliente</div>
        </div>

        <div class="mb-3">
          <label for="entrega_comunicacao" class="form-label">3. Comunicação com o cliente? *</label>
          <select class="form-select" name="entrega_comunicacao" id="entrega_comunicacao" required>
            <option value="" selected>Escolha...</option>
            <option value="recebeu">Recebeu</option>
            <option value="ausente">Cliente Ausente</option>
            <option value="deixar_na_portaria">Cliente pediu para deixar na portaria</option>
            <option value="deixar_com_terceiros">Cliente pediu para deixar com terceiros</option>
          </select>
          <div id="entregacominicacaoHelp" class="form-text">Entre em contato com a/o cliente por interfone, coloque qual foi a resposta dela/e.</div>
        </div>
        <div class="mb-3">
          <label for="entrega_onde" class="form-label">4a. Onde entregou? *</label>
          <select class="form-select" name="entrega_onde" id="entrega_onde" required>
            <option value="" selected>Escolha...</option>
            <option value="o_cliente">Ao Próprio Cliente</option>
            <option value="outro_morador">A outro morador do local</option>
            <option value="a_portaria">Portaria do Prédio</option>
            <option value="outros">Outros</option>
          </select>
          <div id="entregaondeHelp" class="form-text">Diga onde foi feita a entrega</div>
          <label for="entrega_quemoutro" class="form-label">4b. Se não foi o cliente, qual o nome de quem recebeu?</label>
          <input type="text" class="form-control" name="entrega_quemoutro" id="entrega_quemoutro" size="50" maxlength="100">
          <label for="entrega_quemoutroid" class="form-label">4c. ID de quem recebeu?</label>
          <input type="text" class="form-control" name="entrega_quemoutroid" id="entrega_quemoutroid" size="50" maxlength="100">
          <div id="entregaentregadorHelp" class="form-text">preencha o nome e identidade de quem recebeu se não foi a/o cliente</div>
        </div>
        <div class="mb-3">
          <label for="entrega_imgrecibo" class="form-label">5. Foto do Recibo:</label>
          <input class="form-control" type="file" name="entrega_imgrecibo" id="entrega_imgrecibo">
        </div>
        <div class="mb-3">
          <input type="submit" class="btn btn-primary" name="submit" value="enviar">
          <input type="reset" class="btn btn-secondary" name="reset" value="apagar">
        </div>
      </form>
      <hr>
      <div class='d-flex justify-content-center'>
        <div><small><small>Desenvolvido por Bruno Sá - <a href='//www.bruno-sa.com' target='_blank'>www.bruno-sa.com</a></small></small></div>
      </div>
    </div>
    <?php include_once $_SERVER['DOCUMENT_ROOT'].'/php/bootstrap_body.php'; ?>
  </body>
</html>
<?php mysqli_close($con); ?>