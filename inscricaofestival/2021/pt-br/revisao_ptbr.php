<?php require $_SERVER['DOCUMENT_ROOT'].'/php/mysqli_connect.php'; ?> <!-- MySqlDB connect brunosacom -->

<!DOCTYPE HTML>
<html lang="pt-br">
<head>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/php/analyticstracking.php'; ?> <!-- Google Analytics Track brunosacom -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Revisão Festival de Cinema</title>
<link rel="shortcut icon" href="../../favicon.png">

<link href="https://fonts.googleapis.com/css?family=Didact Gothic" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

<link href="../../festatual.css" rel="stylesheet" type="text/css">
<style type="text/css">
body {
	background-image: url(../FR18_l_header4.jpg);
	background-repeat: no-repeat;
    background-position: 50% 0%;
}
</style>
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
</head>

<body style="font-family:Didact Gothic; color:#FFF; background-color:#333;">
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<?php

// URL EXEMPLO
//http://www.bruno-sa.com/negocios/festivaldorio/2020/premierebrasil/revisao_pbrasil.php?idmysql_inscricao=2020130088

mysqli_select_db($con, "brunosacom");

$idmysql_inscricao = $_GET['idmysql_inscricao'];


$sql_inscricao = "SELECT * FROM festrio_inscricao WHERE idmysql_inscricao = $idmysql_inscricao ORDER BY idmysql_inscricao DESC LIMIT 1" ;
$result_inscricao = mysqli_query($con, $sql_inscricao);
while( $row_inscricao = mysqli_fetch_array($result_inscricao) ){
	
	$titulo_original = $row_inscricao['titulo_original'];
	$diretor = $row_inscricao['diretor'];
	$titulo_ingles = $row_inscricao['titulo_ingles'];
	$ano = $row_inscricao['ano'];
	$duracao = $row_inscricao['duracao'];
	$classificacao = $row_inscricao['classificacao'];
	$bitola_inscricao = $row_inscricao['bitola_inscricao'];
	$definicaodigital = $row_inscricao['definicaodigital'];
	$janela = $row_inscricao['janela'];
	$cor = $row_inscricao['cor'];
	$som = $row_inscricao['som'];
	$idioma1 = $row_inscricao['idioma1'];
	$idioma2 = $row_inscricao['idioma2'];
	$leg_copia = $row_inscricao['leg_copia'];
	$roteiro = $row_inscricao['roteiro'];
	$produtora_empresa = $row_inscricao['produtora_empresa'];
	$producao = $row_inscricao['producao'];
	$coproducao = $row_inscricao['coproducao'];
	$fotografia = $row_inscricao['fotografia'];
	$montagem = $row_inscricao['montagem'];
	$musica = $row_inscricao['musica'];
	$elenco = $row_inscricao['elenco'];
	$sinopse_br = $row_inscricao['sinopse_br'];
	$diretor_biografia_br = $row_inscricao['diretor_biografia_br'];
	$filmografia = $row_inscricao['filmografia'];
	$selos = $row_inscricao['selos'];
	
}
?>


</br>
</br>
<p class="txt_corrido"><strong>Premiére Brasil - inscrição número: <?php echo $idmysql_inscricao; ?></br>
confira seus dados previamente enviados e corrija o que achar necessário. ATENÇÃO: REVISAR O QUE JÁ ESTÁ PREENCHIDO, CASO HAJA ALGUMA ALTERAÇÃO, FAVOR ESCREVER NO CAMPO AO LADO. O PREENCHIMENTO DO CAMPO É OBRIGATÓRIO (campos com fundo rosa).  CASO NÃO EXISTA, ESCREVA NÃO HÁ.</strong></br>
</br>

<form action="../../php/revisaoenviarauthinsertcheck_action.php" method="post" name="festrio_inscricao" class="txt_corrido" id="festrio_inscricao" onSubmit="return formvalidation(this)">
  <input name="inscricao_charset" type="hidden" id="inscricao_charset" value="utf-8" />
  <input name="inscricao" type="hidden"  value="revpbrasil" />
  <input name="titulo_originalrev" type="hidden"  value="<?php echo $titulo_original; ?>" />
  <input name="diretorrev" type="hidden"  value="<?php echo $diretor; ?>" />
  <input name="seq_pelicularev" type="hidden"  value="<?php echo $idmysql_inscricao; ?>" />
<table width="80%"  border="3" cellpadding="0" cellspacing="0" bordercolor="#cccccc">
    <tr bgcolor="#cccccc">
      <td width="50%">Informações previamente preenchidas</span></td>
      <td width="50%"><span class="form_required">correção (apenas em caso de mudança)</span></td>
    </tr>
    <tr>
      <td><strong>Título Original:</strong><br><?php echo $titulo_original; ?></br></td>
      <td>
      <input name="titulo_original" type="text" id="titulo_original" size="50" maxlength="100" />
      </td>
    </tr>
	<tr>
      <td><strong>Título Inglês:</strong><br><?php echo $titulo_ingles; ?></br></td>
      <td><input name="titulo_ingles" type="text" id="titulo_ingles" size="50" maxlength="100" placeholder="<?php echo $titulo_ingles; ?>"/>
      </td>
    </tr>
	<tr>
      <td><strong>Direção:</strong><br><?php echo $diretor; ?></br></td>
      <td><input name="diretor" type="text" id="diretor" size="50" maxlength="100" /></td>
    </tr>
	<tr class="form_required" bgcolor="#FFCCCC">
      <td><strong>Ano:</strong><br><?php echo $ano; ?></br></td>
      <td><select name="ano" required>
          <option value=""></option>
		  <!-- Calculo para ano atual e anterior -->
          <option value="<?php echo date("Y"); ?>"><?php echo date("Y"); ?></option>
          <option value="<?php $y=strtotime("-1 year");
                         echo date("Y", $y) ?>">
						 <?php $y=strtotime("-1 year");
                         echo date("Y", $y) ?></option>
        </select></td>
    </tr>
	<tr class="form_required" bgcolor="#FFCCCC">
      <td><strong>Duração:</strong><br><?php echo $duracao; ?></br></td>
      <td>
      <input name="duracao" type="text" id="duracao" size="3" maxlength="3" placeholder="<?php echo $duracao; ?>" required />
      </td>
    </tr>
	<tr>
      <td><strong>Classificação:</strong><br><?php echo $classificacao; ?></br></td>
      <td><p>
        <input name="classificacao" type="radio" value="ER" />Especialmente Recomendado<br />
        <input name="classificacao" type="radio" value="L" />Livre<br />
        <input name="classificacao" type="radio" value="10" />10 anos<br />
        <input name="classificacao" type="radio" value="12" />12 anos<br />
        <input name="classificacao" type="radio" value="14" />14 anos<br />
        <input name="classificacao" type="radio" value="16" />16 anos<br />
        <input name="classificacao" type="radio" value="18" />18 anos</p></td>
    </tr>
	<tr>
      <td><strong>Bitola:</strong><br><?php echo $bitola_inscricao; ?></br></td>
      <td bordercolor="#CCCCCC">
        <input name="bitola_inscricao" type="radio" value="DCP-aberto" />DCP aberto <br />
        <input name="bitola_inscricao" type="radio" value="DCP-3Daberto" />DCP-3D aberto <br />
        <input name="bitola_inscricao" type="radio" value="DCP-encriptado" />DCP encriptado <br />
        <input name="bitola_inscricao" type="radio" value="DCP-3Dencriptado" />DCP-3D encriptado <br />
        <input name="bitola_inscricao" type="radio" value="DCP-+chave" />DCP + chave <br />
        <input name="bitola_inscricao" type="radio" value="DCP-3D+chave" />DCP-3D + chave <br />
        <input name="bitola_inscricao" type="radio" value="DCP naodefinido" />DCP n&atilde;o definido </span></td>
    </tr>
	<tr>
      <td><strong>Definição Digital de exibição final:</strong><br><?php echo $definicaodigital; ?></br></td>
      <td bordercolor="#CCCCCC">
        <input name="definicaodigital" type="radio" value="4K" />4K (4096x2160)<br />
        <input name="definicaodigital" type="radio" value="2K" />2K (2048x1080)<br />
        <input name="definicaodigital" type="radio" value="FullHD" />FullHD (1920x1080)<br />
        <input name="definicaodigital" type="radio" value="HD" />HD (1280x720)<br />
        <input name="definicaodigital" type="radio" value="SD" />SD (720x480)
        </td>
    </tr>
	<tr>
      <td><strong>Janela:</strong><br><?php echo $janela; ?></br></td>
      <td>
        <input name="janela" type="radio" value="1.33 (35_planoantigo)" />1.33 (35mm antigo) <br />
        <input name="janela" type="radio" value="1.33 (35mm_plano)" />1.66 (35mm) <br />
        <input name="janela" type="radio" value="1.85 (35_panoramico)" />1.85 (35mm) <br />
        <input name="janela" type="radio" value="2.35 (35_scope)" />2.35 (35mm scope) <br />
        <input name="janela" type="radio" value="1.33 (DIG_sd - 4:3)" />1.33 (Digital SD - 4:3) <br />
        <input name="janela" type="radio" value="1.78 (DIG_hd - 16:9)" />1.78 (Digital HD - 16:9) <br />
        <input name="janela" type="radio" value="1.78 (scopeinflat)" />1.78 (Digital HD - Scope dentro do Flat/16:9) <br />
        <input name="janela" type="radio" value="2.39 (DCP_scope)" />2.39 (DCP scope) <br />
        <input name="janela" type="radio" value="1.85 (DCP_flat)" />1.85 (DCP flat) <br />
        <input name="janela" type="radio" value="1.90 (DCP_full)" />1.90 (DCP full)
       </td>
    </tr>
	<tr>
      <td><strong>Cor:</strong><br><?php echo $cor; ?></br></td>
      <td>
        <input name="cor" type="radio" value="Cor" />Cor<br />
        <input name="cor" type="radio" value="P&B" />P&B <br />
        <input name="cor" type="radio" value="Cor e P&B" />Cor / P&B </td>
    </tr>
	<tr>
      <td><strong>Som:</strong><br><?php echo $som; ?></br></td>
      <td>
        <input name="som" type="radio" value="Dolby Atmos" />Dolby Atmos<br />
        <input name="som" type="radio" value="Barco Auro3D 11.1" />Barco Auro3D 11.1<br />
        <input name="som" type="radio" value="Dolby Digital EX 7.1" />Dolby Digital EX 7.1<br />
        <input name="som" type="radio" value="Dolby Digital EX 6.1" />Dolby Digital EX 6.1<br />
        <input name="som" type="radio" value="Digital 5.1" />Digital 5.1<br />
        <input name="som" type="radio" value="Digital 5.0" />Digital 5.0 <br />
        <input name="som" type="radio" value="Dolby SR 5.1" />Dolby SR 5.1<br />
        <input name="som" type="radio" value="Stereo 2.0" />Stereo 2.0 <br />
        <input name="som" type="radio" value="Mono 1.0" />Mono 1.0<br />
        <input name="som" type="radio" value="Mudo" />Mudo </span></td>
    </tr>
	<tr>
      <td><strong>Idioma:</strong><br><?php echo $idioma1; ?>, <?php echo $idioma2; ?></br></td>
      <td>
        <select name="idioma1" size="1" >
          <option value=""></option>
          <?php include '../../../../php/mysql2form/option_idioma_natdci.php'; ?> <!-- DB idioma e codigos nativo -->
        </select><br />
      mais de um idioma? <br />
      especifique todos
      <input name="idioma2" type="text" id="idioma2" size="30" maxlength="100" />
      </td>
    </tr>
	<tr>
      <td><strong>Idioma da legenda na cópia de exibição:</strong><br><?php echo $leg_copia; ?></br></td>
      <td>
        <select name="leg_copia" >
          <option value=""></option>
          <?php include '../../../../php/mysql2form/option_idioma_natdci.php'; ?> <!-- DB idioma e codigos nativo -->
        </select>
      </td>
    </tr>
	<tr>
      <td><strong>Roteiro:</strong><br><?php echo $roteiro; ?></br></td>
      <td><input name="roteiro" type="text" id="roteiro" size="50" maxlength="100" /></td>
    </tr>
	<tr>
      <td><strong>Empresa Produtora:</strong><br><?php echo $produtora_empresa; ?></br></td>
      <td><input name="produtora_empresa" type="text" id="produtora_empresa" size="50" maxlength="100" /></td>
    </tr>
	<tr>
      <td><strong>Produção:</strong><br><?php echo $producao; ?></br></td>
      <td><input name="producao" type="text" id="producao" size="50" maxlength="100" /></td>
    </tr>
	<tr>
      <td><strong>Co-Produção:</strong><br><?php echo $coproducao; ?></br></td>
      <td><input name="coproducao" type="text" id="coproducao" size="50" maxlength="100" /></td>
    </tr>
	<tr>
      <td><strong>Fotografia:</strong><br><?php echo $fotografia; ?></br></td>
      <td><input name="fotografia" type="text" id="fotografia" size="50" maxlength="100" /></td>
    </tr>
	<tr>
      <td><strong>Montagem:</strong><br><?php echo $montagem; ?></br></td>
      <td><input name="montagem" type="text" id="montagem" size="50" maxlength="100" /></td>
    </tr>
	<tr>
      <td><strong>Música:</strong><br><?php echo $musica; ?></br></td>
      <td><input name="musica" type="text" id="musica" size="50" maxlength="100" /></td>
    </tr>
	<tr>
      <td><strong>Elenco: (máximo de 5 nomes)</strong><br><?php echo $elenco; ?></br></td>
      <td><textarea name="elenco" cols="50" rows="5" id="elenco" ></textarea></td>
    </tr>
	<!--<tr bgcolor="#FFCCCC">
      <td><span class="txt_corrido"><strong>Indicação aos Prêmios: [PREENCHIMENTO OBRIGATÓRIO]</strong> </br>
	  Direção: </br>
      Fotografia: </br>
      Roteiro: </br>     
      Montagem: </br>   
      Melhor atriz (apenas 1 nome): </br>     
      Melhor ator (apenas 1 nome): </br>     
      Melhor atriz coadjuvante (apenas 1 nome): </br>     
      Melhor ator coadjuvante (apenas 1 nome): <br></td>
      <td><span class="form_required"><textarea name="indicados" id="indicados" rows="8" cols="50" /></textarea></span></td>
    </tr>-->
	<tr>
      <td><strong>Sinopse: (limitado a 580 [longa] ou 210 [curta] caracteres com espaço)</strong><br><?php echo $sinopse_br; ?></br></td>
      <td><textarea name="sinopse_br" cols="50" rows="5" id="sinopse_br"  maxlength="580" ></textarea></td>
    </tr>
	<tr>
      <td><strong>Biografia: (limitado a 430 [longa] ou 180 [curta] caracteres com espaço)</strong><br><?php echo $diretor_biografia_br; ?>'</br></td>
      <td><textarea name="diretor_biografia_br" cols="50" rows="5" id="diretor_biografia_br"  maxlength="430" ></textarea></td>
    </tr>
	<tr>
      <td><strong>Filmografia: (limitado a 500 caracteres com espaço) </strong><br><?php echo $filmografia; ?></br></td>
      <td><textarea name="diretor_filmografia" cols="50" rows="5" id="diretor_filmografia" ></textarea></td>
    </tr>
	<tr class="form_required" bgcolor="#FFCCCC">
      <td><strong>Contato/ Print Source (Contato da Empresa  Produtora/Distribuidora): [PREENCHIMENTO OBRIGATÓRIO]</strong></br><span class="resumo_regulamento">EX: EMPRESA XXXX, EMAIL, TELEFONE</span></td>
      <td><input name="printsource_completo" type="text" id="printsource_completo" size="50" maxlength="100" /></td>
    </tr>
	<tr>
      <td><strong>CPB:</strong></br></td>
      <td><input name="cpb" type="text" id="cpb" size="50" maxlength="100" /></td>
    </tr>
	<tr class="form_required" bgcolor="#FFCCCC">
      <td><strong>Première: [PREENCHIMENTO OBRIGATÓRIO]</strong><br><?php echo $selos; ?></br></td>
      <td>
        <select name="selos" size="1" >
          <option value=""></option>
          <option value="World Premiere">World Première</option>
          <option value="Latin Premiere">Latin Première</option>
        </select></td>
    </tr>
	<tr>
      <td width="50%">&nbsp;</td>
      <td width="50%"><input type="submit" name="submit" id="submit" value="Enviar" />
        <input type="reset" name="Reset" value="Limpar" /></td>
    </tr>
	
</table>
</form>
<?php mysqli_close($con) ?>

</body>
</html>