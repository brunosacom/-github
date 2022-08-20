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

    $classbgcolor = classbgcolor($manutencao_urgencia);
    $classtextcolor = classtextcolor($manutencao_status);
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
                <h3>Chamado # <?php echo $id_manutencao ?> <small><small><small><span class="<?php echo $classbgcolor . " " . $classtextcolor ?>"><?php echo $manutencao_urgencia ?></span></small></small></small></h3>
                <div><small><small>DATA e HORA abertura / modificação: </small></small><?php echo $manutencao_timestamp ?> / <?php echo $manutencao_updatetimestamp ?><br></div>
                <div><small><small>AREA:</small></small></div>
                <div><?php echo $manutencao_area ?><br><br></div>
                <div><small><small>ITEM:</small></small></div>
                <div><?php echo $manutencao_item ?><br><br></div>
                <div><small><small>TIPO:</small></small></div>
                <div><?php echo $manutencao_tipo ?><br><br></div>
                <div><small><small>RELATO:</small></small></div>
                <div><?php echo $manutencao_relateproblema ?><br><br></div>
                <div><small><small>ANDAMENTO: </small></small></div>
                <div><?php echo $manutencao_andamento ?><br><br></div>
                <hr>

                <form action="update_action.php?emp_sigla='<?php echo $empresa_sigla; ?>'" method="post" name="bembos_manutencao" id="bembos_manutencao">
                    <div class="input-group input-group-sm mb-3">
                        <label class="input-group-text">ÁREA</label>
                        <select class="form-select" name="manutencao_urgencia" id="manutencao_urgencia">
                        <option value="<?php echo $manutencao_urgencia ?>" selected><?php echo $manutencao_urgencia ?></option>
                        <option value="NORMAL">NORMAL</option>
                        <option value="URGENTE">URGENTE</option>
                        <option value="URGENCIA MAXIMA">URGENCIA MAXIMA</option>
                        <option value="ADIAVEL">ADIAVEL</option>
                        </select>
                    </div>

                    <div class="input-group input-group-sm mb-3">
                        <label class="input-group-text">ANDAMENTO</label>
                        <textarea class="form-control" name="manutencao_andamento" id="manutencao_andamento" rows="5" placeholder="<?php echo $manutencao_andamento ?>"></textarea>
                    </div>
                    <hr style="height:5px;">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="submit" class="btn btn-primary btn-sm" name="submit" id="submit" value="Enviar">enviar</button>
                        <button type="reset" class="btn btn-outline-secondary btn-sm" name="reset" id="reset" value="Limpar">limpar</button>
                    </div>
                </form>



                <?php

                function classbgcolor($cod) {

                    switch ($cod) {
                        default:
                            $classbgcolor = "bg-light";
                            break;

                        case 'URGENTE':
                            $classbgcolor = "bg-warning";
                            break;

                        case 'NORMAL':
                            $classbgcolor = "bg-light";
                            break;

                        case 'MAXIMA':
                            $classbgcolor = "bg-danger";
                            break;

                        case 'ADIAVEL':
                            $classbgcolor = "bg-success";
                            break;
                    }

                    return $classbgcolor;
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