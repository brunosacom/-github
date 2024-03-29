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
        <h1>Consulta Status Manutenção</h1>
        <form method="post" action="db_selectwhere_action.php?emp_sigla='<?php echo $empresa_sigla; ?>'">
          <input name="charset" type="hidden" value="utf-8">
          <input name="empresa_sigla" type="hidden" id="empresa_sigla" value="<?php echo $empresa_sigla; ?>">

          <div class="input-group input-group-sm mb-3">
            <label class="input-group-text">RESPONSAVEL</label>
            <select class="form-select" name="manutencao_email" id="manutencao_email" required>
              <option value="" selected>selecione...</option>
              <?php
                //selecao de dados
                $sql_local = "SELECT DISTINCT manutencao_email, manutencao_responsavel FROM bembos_manutencao ORDER BY manutencao_responsavel ASC";
                $result_local = mysqli_query($con, $sql_local);

                while($row_local = mysqli_fetch_array($result_local)) { 
              ?>
                <option value="<?php echo $row_local['manutencao_email'] ?>"><?php echo $row_local['manutencao_responsavel'].' - '.$row_local['manutencao_email'] ?></option>
              <?php } 
              ?>
            </select>
          </div>
          <div class="input-group input-group-sm mb-3">
            <label class="input-group-text">STATUS</label>
            <select class="form-select" name="manutencao_status" id="manutencao_status" required>
              <option value="" selected>selecione...</option>
              <option value="aberto">aberto</option>
              <option value="emandamento">em andamento</option>
              <option value="aguardando">aguardando</option>
              <option value="concluido">concluído</option>
            </select>
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