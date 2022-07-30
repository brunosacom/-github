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
                                FUNDO: BRANCO - NORMAL |
                                <span style="background-color: #ffbb99;">LARANJA - URGENTE</span> |
                                <span style="background-color: #ff9999;">VERMELHO - URGENCIA MAXIMA</span> |
                                <span style="background-color: #ccffcc;">VERDE - ADIAVEL</span>
                            </div>
                            <div>
                                TEXTO: <span style="color: #000000;">PRETO - ABERTO</span> |
                                <span style="color: #009900;">VERDE - EM ANDAMENTO</span> |
                                <span style="color: #990000;">VERMELHO - AGUARDANDO MATERIAL, PEÇA OU ORÇAMENTO</span> |
                                <span style="color: #999999;">CINZA - CONCLUIDO</span>
                            </div>
                        </small>
                    </small>
                    <hr>
                </div>


                <?php


                $sql = "SELECT * FROM bembos_manutencao WHERE manutencao_status='aberto' OR manutencao_status='emandamento' OR manutencao_status='aguardando' OR manutencao_status='concluido' ORDER BY manutencao_timestamp DESC";
                $result = $con->query($sql);

                if ($result->num_rows > 0) {

                    echo 
                    "<table class='table table-light table-striped'>
                        <thead>
                            <tr>
                                <th>DATA e HORA abertura</th>
                                <th>ID PEDIDO</th>
                                <th>URGENCIA</th>
                                <th>CINEMA / CAFE</th>
                                <th>AREA</th>
                                <th>LOCALIZACAO</th>
                                <th>TIPO SOLICITACAO</th>
                                <th>RELATO</th>
                                <th>STATUS</th>
                                <th>ANDAMENTO</th>
                                <th>DATA e HORA conclusao</th>
                            </tr>
                        </thead>
                        <tbody>";
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {

                        $classtablecolor = classtablecolor($row["manutencao_urgencia"]);
                        $classtextcolor = classtextcolor($row["manutencao_status"]);
                        $color = trbackground($row["manutencao_urgencia"]);
                        $fontcolor = trfontcolor($row["manutencao_status"]);
                        echo "  <tr class='$classtablecolor $classtextcolor' style='background: {$color}; color: {$fontcolor}; font-size: 70%; '>";
                        echo "      <td>" . $row['manutencao_timestamp'] . "</td>";
                        echo "      <td>" . $row['id_manutencao'] . "</td>";
                        echo "      <td><b>" . $row['manutencao_urgencia'] . "</b></td>";
                        echo "      <td>" . $row['manutencao_cinema'] . "</td>";
                        echo "      <td>" . $row['manutencao_area'] . "</td>";
                        echo "      <td>" . $row['manutencao_localizacao'] . "</td>";
                        echo "      <td>" . $row['manutencao_tiposolicitacao'] . "</td>";
                        echo "      <td>" . $row['manutencao_relateproblema'] . "</td>";
                        echo "      <td>" . $row['manutencao_status'] . "</td>";
                        echo "      <td>" . $row['manutencao_andamento'] . "</td>";
                        echo "      <td>" . $row['manutencao_updatetimestamp'] . "</td>";
                        echo "  </tr>";
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
                            $classtextcolor = "text-danger";
                            break;

                        case 'emandamento':
                            $classtextcolor = "text-success";
                            break;

                        case 'aguardando':
                            $classtextcolor = "text-warning";
                            break;

                        case 'concluido':
                            $classtextcolor = "text-secondary";
                            break;
                    }

                    return $classtextcolor;
                }

                function trbackground($cod) {

                    switch ($cod) {
                        default:
                            $color = "#ffffff";
                            break;

                        case 'URGENTE':
                            $color = "#ffbb99";
                            break;

                        case 'NORMAL':
                            $color = "#ffffff";
                            break;

                        case 'MAXIMA':
                            $color = "#ff9999";
                            break;

                        case 'ADIAVEL':
                            $color = "#ccffcc";
                            break;
                    }

                    return $color;
                }

                function trfontcolor($fontcod) {

                    switch ($fontcod) {
                        default:
                            $fontcolor = "#ffffff";
                            break;

                        case 'aberto':
                            $fontcolor = "#000000";
                            break;

                        case 'emandamento':
                            $fontcolor = "#009900";
                            break;

                        case 'aguardando':
                            $fontcolor = "#990000";
                            break;

                        case 'concluido':
                            $fontcolor = "#999999";
                            break;
                    }

                    return $fontcolor;
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