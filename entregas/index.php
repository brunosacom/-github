<?php require $_SERVER['DOCUMENT_ROOT'].'/php/mysqli_connect.php'; //MySqlDB connect brunosacom ?>

<?php

// URL EXEMPLO
//https://www.bruno-sa.com/bembos/entregas/entregadata.php?emp_sigla='BMB'

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
      <h1>Data da Entrega</h1>
      <form action="entregadata.php" method="post" name="bembos_entregadata" enctype="multipart/form-data">
        <input name="charset" type="hidden" id="charset" value="utf-8">
        <input name="emp_sigla" type="hidden" id="emp_sigla" value="<?php echo $empresa_sigla; ?>">

        <div class="mb-3">
          <label for="entregadata" class="form-label">1. Data da entrega *</label>
          <select class="form-select" name="entregadata" id="entregadata" required>
            <option value="<?php echo $today; ?>" SELECTED>HOJE (<?php echo $today; ?>)</option>
            <?php 
            // Fetch Department
            $sql_entregadata = "SELECT DISTINCT entrega_data FROM bembos_entrega ORDER BY entrega_data DESC";
            $entregadata_data = mysqli_query($con,$sql_entregadata);
              while($row = mysqli_fetch_assoc($entregadata_data) ){
                $entrega_data = $row['entrega_data'];
      
                // Option
                echo "<option value=\"".$entrega_data."\" >".$entrega_data."</option>";
              }
            ?>
          </select>
          <div id="entregadataHelp" class="form-text">Escolha a data prevista de entrega.</div>
        </div>

        <div class="mb-3">
          <input type="submit" class="btn btn-primary" name="submit" value="enviar">
          <input type="reset" class="btn btn-secondary" name="reset" value="apagar">
        </div>
      </form>
      <hr>
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