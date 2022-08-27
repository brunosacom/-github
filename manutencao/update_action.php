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
        if (isset($_POST['submit'])) {

          $id_manutencao = $_POST['id_manutencao'];
          $manutencao_urgencia = addslashes($_POST['manutencao_urgencia']);
          $manutencao_status = addslashes($_POST['manutencao_status']);
          $manutencao_andamento = addslashes($_POST['manutencao_andamento']);

        }


      ?>
      <p><?php echo $id_manutencao, $manutencao_andamento, $manutencao_status, $manutencao_urgencia ?></p>
      <?php  
        $sql = "UPDATE bembos_manutencao SET manutencao_urgencia = $manutencao_urgencia, manutencao_status = $manutencao_status, manutencao_andamento = $manutencao_andamento WHERE id_manutencao = $id_manutencao";

        if (!mysqli_query($con, $sql)) {
          die('Error: ' . mysqli_error($con));
        }
        echo "<br>Obrigado por atualizar a solicitacao/manutencao ID: " . $id_manutencao . ".<br>";
      ?>
      
    </div>
    <?php include_once $_SERVER['DOCUMENT_ROOT'].'/php/bootstrap_body.php'; ?>
  </body>
</html>
<?php mysqli_close($con); ?>