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

<?php
    // URL EXEMPLO
    //https://www.bruno-sa.com/-github/manutencao/consultachamado_idchamado.php?emp_sigla='BMB'&id_manutencao=15

    $id_manutencao = $_GET['id_manutencao'];

    $sql_idmanutencao = "SELECT * FROM bembos_manutencao WHERE id_manutencao = $id_manutencao";
    $result_idmanutencao = mysqli_query($con, $sql_idmanutencao);
    while ($row_idmanutencao = mysqli_fetch_array($result_idmanutencao)) {

        $manutencao_timestamp = $row_idmanutencao['manutencao_timestamp'];
        $manutencao_status = $row_idmanutencao['manutencao_status'];
        $manutencao_responsavel = $row_idmanutencao['manutencao_responsavel'];
        $manutencao_email = $row_idmanutencao['manutencao_email'];
        $manutencao_local = $row_idmanutencao['manutencao_local'];
        $manutencao_area = $row_idmanutencao['manutencao_area'];
        $manutencao_tipo = $row_idmanutencao['manutencao_tipo'];
        $manutencao_item = $row_idmanutencao['manutencao_item'];
        $manutencao_urgencia = $row_idmanutencao['manutencao_urgencia'];
        $manutencao_relateproblema = $row_idmanutencao['manutencao_relateproblema'];
        $manutencao_andamento = $row_idmanutencao['manutencao_andamento'];
        $manutencao_updatetimestamp = $row_idmanutencao['manutencao_updatetimestamp'];
        
    }

    $classtablecolor = classtablecolor($row["manutencao_urgencia"]);
    $classtextcolor = classtextcolor($row["manutencao_status"]);
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

    <body style="font-family: Didact Gothic; color:#FFF; background-color:#333;">
        <div class="container">
            <!-- Content here -->
            <br>
            <div>
                <div class="col"></div>
                <div class="col"><img src="<?php echo $empresa_logo; ?>" class="custom-logo" alt="<?php echo $empresa_nome; ?>" width="200"></div>
                <div class="col"></div>
            </div>
            <div class="mb-3">
                <h1>Manutenção</h1>
                <h3>Chamado # <?php echo $id_manutencao ?> <span class="<?php echo $classtablecolor . ";" . $classtextcolor ?>"><small><?php echo $manutencao_urgencia ?></small></span></h3>
                <div>
                    <small>Legenda Status
                        <small>
                            <div>
                                FUNDO: <span class="bg-light text-body">BRANCO - NORMAL</span> |
                                <span class="bg-warning text-body">AMARELO - URGENTE</span> |
                                <span class="bg-danger text-body">VERMELHO - URGENCIA MAXIMA</span> |
                                <span class="bg-success text-body">VERDE - ADIAVEL</span>
                            </div>
                            <div>
                                TEXTO: <span class="bg-light text-body">PRETO - ABERTO</span> |
                                <span class="bg-light text-success">VERDE - EM ANDAMENTO</span> |
                                <span class="bg-light text-danger">VERMELHO - AGUARDANDO MATERIAL, PEÇA OU ORÇAMENTO</span> |
                                <span class="bg-light text-secondary">CINZA - CONCLUIDO</span>
                            </div>
                        </small>
                    </small>
                    <hr>
                </div>
                <div><small>ID PEDIDO: </small><?php echo $id_manutencao ?> <span class="<?php echo $classtablecolor . ";" . $classtextcolor ?>"><small><?php echo $manutencao_urgencia ?></small></span></div>
                <div><small>DATA e HORA abertura / modificação: </small><?php echo $manutencao_timestamp ?> / <?php echo $manutencao_updatetimestamp ?><br></div>
                <div><small>ANDAMENTO: </small><?php echo $manutencao_andamento ?></div>
                <div>AREA</div>
                <div><?php echo $manutencao_area ?><br></div>
                <div>ITEM</div>
                <div><?php echo $manutencao_item ?><br></div>
                <div>TIPO</div>
                <div><?php echo $manutencao_tipo ?><br></div>
                <div>RELATO</div>
                <div><?php echo $manutencao_relateproblema ?><br></div>
                
                



                <?php

                function classtablecolor($cod) {

                    switch ($cod) {
                        default:
                            $classtablecolor = "table-light";
                            break;

                        case 'URGENTE':
                            $classtablecolor = "table-warning";
                            break;

                        case 'NORMAL':
                            $classtablecolor = "table-light";
                            break;

                        case 'MAXIMA':
                            $classtablecolor = "table-danger";
                            break;

                        case 'ADIAVEL':
                            $classtablecolor = "table-success";
                            break;
                    }

                    return $classtablecolor;
                }
                
                function classtextcolor($cod) {

                    switch ($cod) {
                        default:
                            $classtextcolor = "text-body";
                            break;

                        case 'aberto':
                            $classtextcolor = "text-body";
                            break;

                        case 'emandamento':
                            $classtextcolor = "text-success";
                            break;

                        case 'aguardando':
                            $classtextcolor = "text-danger";
                            break;

                        case 'concluido':
                            $classtextcolor = "text-secondary";
                            break;
                    }

                    return $classtextcolor;
                }

                ?>
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