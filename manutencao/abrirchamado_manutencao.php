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
<html lang="pt-BR" data-bs-theme="dark">
  <head>
    <?php include_once $_SERVER['DOCUMENT_ROOT'].'/php/analyticstracking.php'; ?>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $empresa_nome; ?> - Manutenção</title>
    <link rel="shortcut icon" href="<?php echo $empresa_favicon; ?>">
    <link href="https://fonts.googleapis.com/css?family=Didact Gothic" rel="stylesheet">
    <?php include_once $_SERVER['DOCUMENT_ROOT'].'/php/bootstrap_head.php'; ?>
  </head>

  <body style="font-family: Didact Gothic;">
    <div class="container">
      <!-- Content here -->
      <br>
      <div>
        <div class="col"></div>
        <div class="col"><img src="<?php echo $empresa_logo; ?>" class="custom-logo" alt="<?php echo $empresa_nome; ?>" width="200"></div>
        <div class="col"></div>
      </div>
      <div class="mb-3">
        <h1>Abrir Chamado Manutenção</h1>
        <p><strong>Registre o pedido de manutenção</strong></p>
        <form action="enviarauthinsert_action.php?emp_sigla='<?php echo $empresa_sigla; ?>'" method="post" name="bembos_manutencao" id="bembos_manutencao">
          <input name="manutencao_charset" type="hidden" value="utf-8">
          <input name="empresa_sigla" type="hidden" id="empresa_sigla" value="<?php echo $empresa_sigla; ?>">
          <input name="manutencao_status" type="hidden" value="aberto">
            
          <div class="input-group input-group-sm mb-3">
            <label class="input-group-text text-danger">RESPONSAVEL</label>
            <input type="text" class="form-control" name="manutencao_responsavel" id="manutencao_responsavel" required>
          </div>
          <div class="input-group input-group-sm mb-3">
            <label class="input-group-text text-danger">E-MAIL</label>
            <input type="email" class="form-control" name="manutencao_email" id="manutencao_email" required>
          </div>
          <div class="input-group input-group-sm mb-3">
            <label class="input-group-text text-danger">LOCAL</label>
            <select class="form-select" name="manutencao_locallista" id="manutencao_locallista" required>
              <option value="" selected>selecione...</option>
              <?php
                //selecao de dados
                $sql_local = "SELECT DISTINCT manutencao_local FROM bembos_manutencao ORDER BY manutencao_local ASC";
                $result_local = mysqli_query($con, $sql_local);

                while($row_local = mysqli_fetch_array($result_local)) { 
              ?>
                <option value="<?php echo $row_local['manutencao_local'] ?>"><?php echo $row_local['manutencao_local'] ?></option>
              <?php } 
              ?>
              <option value="-novo-">novo...</option>
            </select>
          
            <label class="input-group-text">Qual?</label>
            <input type="text" class="form-control" name="manutencao_localqual" id="manutencao_localqual">
          </div>
          <div class="input-group input-group-sm mb-3">
            <label class="input-group-text">ÁREA</label>
            <select class="form-select" name="manutencao_arealista" id="manutencao_arealista">
            <option value="" selected>selecione...</option>
              <?php
                //selecao de dados
                $sql_area = "SELECT DISTINCT manutencao_area FROM bembos_manutencao ORDER BY manutencao_area ASC";
                $result_area = mysqli_query($con, $sql_area);

                while($row_area = mysqli_fetch_array($result_area)) { 
              ?>
                <option value="<?php echo $row_area['manutencao_area'] ?>"><?php echo $row_area['manutencao_area'] ?></option>
              <?php } 
              ?>
              <option value="-novo-">novo...</option>
            </select>
          
            <label class="input-group-text">Qual?</label>
            <input type="text" class="form-control" name="manutencao_areaqual" id="manutencao_areaqual">
          </div>   
          <div class="input-group input-group-sm mb-3">
            <label class="input-group-text text-danger">TIPO</label>
            <input type="text" class="form-control" name="manutencao_tipo" id="manutencao_tipo" required>
          </div> 
          <div class="input-group input-group-sm mb-3">
            <label class="input-group-text text-danger">ITEM</label>
            <input type="text" class="form-control" name="manutencao_item" id="manutencao_item" required>
          </div>
          <div class="input-group input-group-sm mb-3">
            <label class="input-group-text">RELATE O PROBLEMA</label>
            <textarea class="form-control" name="manutencao_relateproblema" id="manutencao_relateproblema" rows="5"></textarea>
          </div>
          <div class="input-group input-group-sm mb-3">
            <label class="input-group-text">URGENTE?</label> 
            <div class="form-control">
              <input class="form-check-input" name="manutencao_urgencia" id="manutencao_urgencia"  type="checkbox" value="URGENTE"> sim
            </div>
          </div>
          <hr style="height:5px;">
          <div class="btn-group" role="group" aria-label="Basic example">
            <button type="submit" class="btn btn-primary btn-sm" name="submit" id="submit" value="Enviar">enviar</button>
            <button type="reset" class="btn btn-outline-secondary btn-sm" name="reset" id="reset" value="Limpar">limpar</button>
          </div>
        </form>
      </div>
      <div class='row justify-content-center'>
        <div>
          <small>
            <small>Desenvolvido por Bruno Sá - <a href='//www.bruno-sa.com' target='_blank'>www.bruno-sa.com</a></small>
          </small>
        </div>
      </div>
    </div>
    <?php include_once $_SERVER['DOCUMENT_ROOT'].'/php/bootstrap_body.php'; ?>
  </body>
</html>
<?php mysqli_close($con); ?>