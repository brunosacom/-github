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


                <?php


                $sql = "SELECT * FROM bembos_manutencao WHERE manutencao_status='aberto' OR manutencao_status='emandamento' OR manutencao_status='aguardando' OR manutencao_status='concluido' ORDER BY manutencao_timestamp DESC";
                $result = mysqli_query($con, $sql);

                if (mysqli_num_rows($result) > 0) {

                    echo 
                    "<table class='table table-light'>
                        <thead>
                            <tr>
                                <th>DATA e HORA abertura</th>
                                <th>ID PEDIDO</th>
                                <th>URGÊNCIA</th>
                                <th>LOCAL</th>
                                <th>AREA</th>
                                <th>ITEM</th>
                                <th>TIPO</th>
                                <th>RELATO</th>
                                <th>STATUS</th>
                                <th>ANDAMENTO</th>
                                <th>DATA e HORA modificação</th>
                            </tr>
                        </thead>
                        <tbody>";
                    // output data of each row
                    while($row = mysqli_fetch_assoc($result)) {

                        $classtablecolor = classtablecolor($row["manutencao_urgencia"]);
                        $classtextcolor = classtextcolor($row["manutencao_status"]);
                        echo "  <tr class='$classtablecolor $classtextcolor'><small>";
                        echo "      <td>" . $row['manutencao_timestamp'] . "</td>";
                        echo "      <td><a href='https://www.bruno-sa.com/-github/manutencao/consultachamado_idchamado.php?id_manutencao=". $row['id_manutencao'] . "&emp_sigla='BMB''>" . $row['id_manutencao'] . "</a></td>";
                        echo "      <td><b>" . $row['manutencao_urgencia'] . "</b></td>";
                        echo "      <td>" . $row['manutencao_local'] . "</td>";
                        echo "      <td>" . $row['manutencao_area'] . "</td>";
                        echo "      <td>" . $row['manutencao_item'] . "</td>";
                        echo "      <td>" . $row['manutencao_tipo'] . "</td>";
                        echo "      <td>" . $row['manutencao_relateproblema'] . "</td>";
                        echo "      <td>" . $row['manutencao_status'] . "</td>";
                        echo "      <td>" . $row['manutencao_andamento'] . "</td>";
                        echo "      <td>" . $row['manutencao_updatetimestamp'] . "</td>";
                        echo "  </small></tr>";
                    }
                    echo 
                    "   </tbody>
                    </table>";
                } else {
                    echo "0 results";
                }

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