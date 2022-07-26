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
        <h1>Abrir Chamado Manutenção</h1>
        <form action="enviarauthinsert_action.php" method="post" name="manutencao" id="manutencao">
        <input name="charset" type="hidden" value="utf-8">
        <input name="empresa_sigla" type="hidden" id="empresa_sigla" value="<?php echo $empresa_sigla; ?>">
          <p>
            <strong>Registre o pedido de manutenção</strong> </p>
          <p>CINEMA / CAFE:<br>
            <select name="cinema_manutencao_grupoestacao" id="cinema_manutencao_grupoestacao">
              <option value="" selected="selected">Selecione...</option>
              <option value="BOTcafe">BOTcafe</option>
              <option value="BOTcinema">BOTcinema</option>
              <option value="GAVcafe">GAVcafe</option>
              <option value="GAVcinema">GAVcinema</option>
              <option value="IPAcafe">IPAcafe</option>
              <option value="IPAcinema">IPAcinema</option>
              <option value="RIOcafe">RIOcafe</option>
              <option value="RIOcinema">RIOcinema</option>
            </select>

            <br>

            <p>LOCAL:<br>
              <select name="local_manutencao_grupoestacao" id="local_manutencao_grupoestacao">
                <option value="" selected="selected">Selecione...</option>
                <option value="salacinema">Salas de Cinema</option>
                <option value="estoque">Estoque</option>
                <option value="halldocafe">Hall do Café</option>
                <option value="banheiros">Banheiros</option>
                <option value="areaexterna">Área Externa</option>
              </select>

              <br>

              <p>GERENTE:<br>
                <input name="gerente_manutencao_grupoestacao" type="text" id="gerente_manutencao_grupoestacao" size="55" required="required">
                <br>


                <p>TIPO DE SOLICITAÇÃO:<br>
                  <select name="tiposolicitacao_manutencao_grupoestacao" id="tiposolicitacao_manutencao_grupoestacao">
                    <option value="" selected="selected">Selecione...</option>
                    <option value="poltrona">Poltronas de Cinema</option>
                    <option value="estoque">Estoque</option>
                    <option value="halldocafe">Hall do Café</option>
                    <option value="banheiros">Banheiros</option>
                    <option value="areaexterna">Área Externa</option>
                  </select>
                </p>
                <p>RELATE O PROBLEMA:<br>
                  <textarea name="relateproblema_manutencao_grupoestacao" cols="55" rows="4" required id="relateproblema_manutencao_grupoestacao"></textarea>
                  <br>

                  <p>LOCALIZAÇÃO:<br>
                    <select name="localizacao_manutencao_grupoestacao" id="localizacao_manutencao_grupoestacao">
                      <option value="" selected="selected">Selecione...</option>
                      <option value="poltrona">Poltronas de Cinema</option>
                      <option value="estoque">Estoque</option>
                      <option value="halldocafe">Hall do Café</option>
                      <option value="banheiros">Banheiros</option>
                      <option value="areaexterna">Área Externa</option>
                    </select>
                  </p>

                  <p>
                    <br>
                    <input type="submit" name="submit" id="submit" value="enviar">
                    <input type="reset" name="reset" id="reset" value="cancelar">
                    <br>

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