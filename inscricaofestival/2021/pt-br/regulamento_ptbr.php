<?php require $_SERVER['DOCUMENT_ROOT'].'/php/mysqli_connect.php'; //MySqlDB connect brunosacom ?>

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
<html lang="pt-br" data-bs-theme="dark">
  <head>
    <?php include_once $_SERVER['DOCUMENT_ROOT'].'/php/analyticstracking.php' ?> <!-- Google Analytics Track brunosacom -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Regulamento Festival de Cinema</title>
    <link rel="shortcut icon" href="<?php echo $empresa_favicon; ?>">
    <link href="https://fonts.googleapis.com/css?family=Didact Gothic" rel="stylesheet">
    <?php include_once $_SERVER['DOCUMENT_ROOT'].'/php/bootstrap_head.php'; ?>
  </head>

  <body style="font-family:Didact Gothic;">
    <div class="container">
    	<!-- Content here -->
      <div class="row justify-content-md-center">
        <div class="col"></div>
        <div class="col"><img src="<?php echo $empresa_logo; ?>" class="custom-logo" alt="<?php echo $empresa_nome; ?>" width="200"></div>
        <div class="col"></div>
      </div>
			<h1>Regulamento</h1>
      <div class='row justify-content-center'>
			  <div>Texto do regulamento</div>
        <div><a href="formulario_ptbr.php?emp_sigla='<?php echo $empresa_sigla; ?>'">INSCREVA-SE</a></div>
      </div>
      <hr>
      <div class="d-flex justify-content-center">
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