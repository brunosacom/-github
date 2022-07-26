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
      <br>
      <div>
        <div class="col"></div>
        <div class="col"><img src="<?php echo $empresa_logo; ?>" class="custom-logo" alt="<?php echo $empresa_nome; ?>" width="200"></div>
        <div class="col"></div>
      </div>
      <div class="mb-3">
        <h1>Consulta Status Manutenção</h1>
        <form method="post" action="db_selectwhere_action.php">
          <input name="charset" type="hidden" value="utf-8">
          <input name="empresa_sigla" type="hidden" id="empresa_sigla" value="<?php echo $empresa_sigla; ?>">
          <div class="mb-3">
            <label for="folhaponto_matricula" class="form-label">Matrícula do funcionário:</label>
            <select class="form-select" name="folhaponto_matricula" id="folhaponto_matricula" required>
              <option value="" selected="selected">Selecione...</option>

              <?php
              $sql = "SELECT funcionarios_nome, funcionarios_matricula, funcionarios_empresa, funcionarios_ativo FROM bembos_funcionarios WHERE funcionarios_ativo = 1 ORDER BY funcionarios_nome ASC";
              $result = $con->query($sql);

              if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                  echo "<option value=\"" . $row["funcionarios_matricula"] . "\">" . $row["funcionarios_matricula"] . " - " . $row["funcionarios_nome"] . " - " . $row["funcionarios_empresa"] . "</option>";
                }
              } else {
                echo "0 results";
              }
              ?>

            </select>
            <div id="folhaponto_matriculaHelpBlock" class="form-text" required>
              Escolha o funcionário.
            </div>
          </div>



          <table width="300" cellpadding="5" cellspacing="0" bordercolor="#000000">
            <tr>
              <td nowrap="nowrap">COMPLEXO</td>
              <td nowrap="nowrap">
                <select name="email_manutencao_grupoestacao" id="email_manutencao_grupoestacao">
                  <option value="" selected="selected">Selecione...</option>
                  <option value="estacaobotafogo@grupoestacao.com.br">BOTAFOGO</option>
                  <option value="estacaogavea@grupoestacao.com.br">GAVEA</option>
                  <option value="estacaoipanema@grupoestacao.com.br">IPANEMA</option>
                  <option value="estacaorio@grupoestacao.com.br">RIO</option>
                </select>
            </tr>
            <tr>
              <td nowrap="nowrap">STATUS</td>
              <td nowrap="nowrap">
                <select name="status_manutencao_grupoestacao" id="status_manutencao_grupoestacao">
                  <option value="" selected="selected">Selecione...</option>
                  <option value="aberto">aberto</option>
                  <option value="emandamento">em andamento</option>
                  <option value="aguardandopeca">aguardando peca</option>
                  <option value="concluido">concluido</option>
                </select>
            </tr>
          </table>
          <p>&nbsp;</p>
          <p>
            <input type="submit" name="submit" id="submit" value="enviar" />
            <input type="reset" name="reset" id="reset" value="limpar" />
          </p>
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