<?php require $_SERVER['DOCUMENT_ROOT'].'/php/mysqli_connect.php'; ?> <!-- MySqlDB connect brunosacom -->

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
<html lang="pt-br">
  <head>
    <?php include_once $_SERVER['DOCUMENT_ROOT'].'/php/analyticstracking.php' ?> <!-- Google Analytics Track brunosacom -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inscrição Festival de Cinema</title>
    <link rel="shortcut icon" href="<?php echo $empresa_favicon; ?>">
    <link href="https://fonts.googleapis.com/css?family=Didact Gothic" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

  </head>

  <body style="font-family:Didact Gothic; color:#FFF; background-color:#333;">
    <div class="container">
    	<!-- Content here -->
      <div class="row justify-content-md-center">
        <div class="col"></div>
        <div class="col"><img src="<?php echo $empresa_logo; ?>" class="custom-logo" alt="<?php echo $empresa_nome; ?>" width="200"></div>
        <div class="col"></div>
      </div>
			<h1>Formulário de Inscrição - pt-br</h1>
      <div class="text-danger">Em vermelho os campos obrigatórios</div>
      <form action="../../php/enviarauthinsertcheck_action.php?emp_sigla='<?php echo $empresa_sigla; ?>'" method="post" name="festival_inscricao" id="festival_inscricao">
        <input name="inscricao_charset" type="hidden" id="inscricao_charset" value="utf-8">
        <input name="inscricao" type="hidden"  value="pt-br">
        <h6>1 - FILME</h6>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text text-danger">1.01 - Título Original</label>
          <input type="text" class="form-control" name="titulo_original" id="titulo_original" required>
        </div>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text text-danger">1.02 - Título Inglês</label>
          <input type="text" class="form-control" name="titulo_ingles" id="titulo_ingles" required>
        </div>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text text-danger">1.03 - Direção</label>
          <input type="text" class="form-control" name="diretor" id="diretor" required>
        </div>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text text-danger">1.04 - País de produção</label>
          <input type="text" class="form-control" placeholder="Brasil" disabled>
          <input name="pais1_alpha3" type="hidden" id="pais1_alpha3"  value="BRA">
        </div>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text">1.05 - Países de Co-Produção</label>
          <select class="form-select" name="pais2_alpha3" id="pais2_alpha3">
            <option value="" selected="selected">selecione</option>
            <?php include '../../../../php/mysql2form/option_pais_ptbr.php'; ?> <!-- DB paises e codigos em QBP -->
          </select>
          <select class="form-select" name="pais3_alpha3" id="pais3_alpha3">
            <option value="" selected="selected">selecione</option>
            <?php include '../../../../php/mysql2form/option_pais_ptbr.php'; ?> <!-- DB paises e codigos em QBP -->
          </select>
          <select class="form-select" name="pais4_alpha3" id="pais4_alpha3">
            <option value="" selected="selected">selecione</option>
            <?php include '../../../../php/mysql2form/option_pais_ptbr.php'; ?> <!-- DB paises e codigos em QBP -->
          </select>
          <select class="form-select" name="pais5_alpha3" id="pais5_alpha3">
            <option value="" selected="selected">selecione</option>
            <?php include '../../../../php/mysql2form/option_pais_ptbr.php'; ?> <!-- DB paises e codigos em QBP -->
          </select>
        </div>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text text-danger">1.06 - Ano</label>
          <select class="form-select" name="ano" id="ano" required>
            <option value=""selected="selected">Selecione</option>
              <!-- Calculo para ano atual e anterior -->
              <option value="<?php echo date("Y"); ?>"><?php echo date("Y"); ?></option>
              <option value="<?php $y=strtotime("-1 year"); echo date("Y", $y) ?>">
                <?php $y=strtotime("-1 year"); echo date("Y", $y) ?>
              </option>
          </select>
        </div>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text text-danger">1.07 - Duração</label>
          <input type="number" class="form-control" name="duracao" id="duracao"  size="3" max="999" required>
        </div>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text">1.08 - Website do filme</label>
          <input type="text" class="form-control" name="filme_website" id="filme_website">
        </div>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text">1.09 - Festivais e Prêmios</label>
          <textarea class="form-control" name="premios" id="premios" rows="5" placeholder="(limitado a 500 caracteres com espaço)"></textarea>
        </div>

        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text text-danger">1.10 - Categoria</label>
          <div class="form-control">
            <input name="categoria" type="radio" value="pb lg70 - fic" required> Longa-Metragem (acima de 70 min.) - Ficção<br>
            <input name="categoria" type="radio" value="pb lg70 - doc"  required> Longa-Metragem (acima de 70 min.) - Documentário<br>
            <input name="categoria" type="radio" value="pb lg60 - fic"  required> Longa-Metragem (entre 60 e 70 min.) - Ficção<br>
            <input name="categoria" type="radio" value="pb lg60 - doc" required> Longa-Metragem (entre 60 e 70 min.) - Documentário<br>
            <input name="categoria" type="radio" value="pb ct15 - fic" required> Curta-Metragem (até 15 min.) - Ficção<br>
            <input name="categoria" type="radio" value="pb ct15 - doc" required> Curta-Metragem (até 15 min.) - Documentário <br>
            <input name="categoria" type="radio" value="pb ct30 - fic"  required> Curta-Metragem (entre 15 e 30 min.) - Ficção<br>
            <input name="categoria" type="radio" value="pb ct30 - doc"  required> Curta-Metragem (entre 15 e 30 min.) - Documentário
          </div>
        </div>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text text-danger">1.11 - Classificação Indicativa</label>
          <div class="form-control">
            <input name="classificacao" type="radio" value="ER" required> Especialmente Recomendado<br>
            <input name="classificacao" type="radio" value="L" required> Livre<br>
            <input name="classificacao" type="radio" value="10" required> 10 anos<br>
            <input name="classificacao" type="radio" value="12" required> 12 anos<br>
            <input name="classificacao" type="radio" value="14" required> 14 anos<br>
            <input name="classificacao" type="radio" value="16" required> 16 anos<br>
            <input name="classificacao" type="radio" value="18" required> 18 anos
          </div>
        </div>
        <hr style="height:5px;">
        <h6>2 - INFORMAÇÃO TÉCNICA</h6>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text text-danger">2.01 - Bitola de exibição final</label>
          <div class="form-control">
            <input name="bitola_inscricao" type="radio" value="DCP-aberto" required> DCP aberto <br>
            <input name="bitola_inscricao" type="radio" value="DCP-3Daberto" required> DCP-3D aberto <br>
            <input name="bitola_inscricao" type="radio" value="DCP-encriptado" required> DCP encriptado <br>
            <input name="bitola_inscricao" type="radio" value="DCP-3Dencriptado" required> DCP-3D encriptado <br>
            <input name="bitola_inscricao" type="radio" value="DCP-+chave" required> DCP + chave <br>
            <input name="bitola_inscricao" type="radio" value="DCP-3D+chave" required> DCP-3D + chave <br>
            <input name="bitola_inscricao" type="radio" value="DCP naodefinido" required> DCP não definido
          </div>
        </div>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text text-danger">2.02 - Definição Digital de exibição final</label>
          <div class="form-control">
            <input name="definicaodigital" type="radio" value="4K" required> 4K (4096x2160)<br>
            <input name="definicaodigital" type="radio" value="2K" required> 2K (2048x1080)<br>
            <input name="definicaodigital" type="radio" value="FullHD" required> FullHD (1920x1080)<br>
            <input name="definicaodigital" type="radio" value="HD" required> HD (1280x720)<br>
            <input name="definicaodigital" type="radio" value="SD" required> SD (720x480)
          </div>
        </div>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text text-danger">2.03 - Janela de exibição final</label>
          <div class="form-control">
            <input name="janela" type="radio" value="1.78 (scopeinflat)" required>1.78 (Digital HD - Scope dentro do Flat/16:9)<br>
            <input name="janela" type="radio" value="2.39 (DCP_scope)" required> 2.39 (DCP scope)<br>
            <input name="janela" type="radio" value="1.85 (DCP_flat)" required> 1.85 (DCP flat)<br>
            <input name="janela" type="radio" value="1.90 (DCP_full)" required> 1.90 (DCP full)<br>
            <input name="janela" type="radio" value="1.33 (35_planoantigo)" required> 1.33 (35mm antigo)<br>
            <input name="janela" type="radio" value="1.66 (35_plano)" required> 1.66 (35mm)<br>
            <input name="janela" type="radio" value="1.85 (35_panoramico)" required> 1.85 (35mm)<br>
            <input name="janela" type="radio" value="2.35 (35_scope)" required> 2.35 (35mm scope)<br>
            <input name="janela" type="radio" value="1.33 (DIG_sd - 4:3)" required> 1.33 (Digital SD - 4:3)<br>
            <input name="janela" type="radio" value="1.78 (DIG_hd - 16:9)" required> 1.78 (Digital HD - 16:9)
          </div>
        </div>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text text-danger">2.04 - Cor  de exibição final</label>
          <div class="form-control">
            <input name="cor" type="radio" value="Cor" required> Cor<br>
            <input name="cor" type="radio" value="P&B" required> P&B <br>
            <input name="cor" type="radio" value="Cor e P&B" required> Cor / P&B
          </div>
        </div>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text text-danger">2.05 - Som  de exibição final</label>
          <div class="form-control">
            <input name="som" type="radio" value="Dolby Atmos" required> Dolby Atmos<br>
            <input name="som" type="radio" value="Barco Auro3D 11.1" required> Barco Auro3D 11.1<br>
            <input name="som" type="radio" value="Dolby Digital EX 7.1" required> Dolby Digital EX 7.1<br>
            <input name="som" type="radio" value="Dolby Digital EX 6.1" required> Dolby Digital EX 6.1<br>
            <input name="som" type="radio" value="Digital 5.1" required> Digital 5.1<br>
            <input name="som" type="radio" value="Digital 5.0" required> Digital 5.0 <br>
            <input name="som" type="radio" value="Dolby SR 5.1" required> Dolby SR 5.1<br>
            <input name="som" type="radio" value="Stereo 2.0" required> Stereo 2.0 <br>
            <input name="som" type="radio" value="Mono 1.0" required> Mono 1.0<br>
            <input name="som" type="radio" value="Mudo" required> Mudo
          </div>
        </div>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text text-danger">2.06 - Idioma  de exibição final</label>
          <select class="form-select" name="idioma1_dci" id="idioma1_dci" required>
            <option value="" selected="selected">selecione</option>
            <?php include '../../../../php/mysql2form/option_idioma_natdci.php'; ?> <!-- DB idioma e codigos nativo -->
          </select>
          <input name="idioma2" id="idioma2" type="text" size="30" maxlength="100" placeholder="mais de um idioma? especifique">
        </div>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text text-danger">2.07 - Idioma da legenda na cópia de exibição</label>
          <select class="form-select" name="leg_copia_dci" id="leg_copia_dci" required>
            <option value="" selected="selected">selecione</option>
            <?php include '../../../../php/mysql2form/option_idioma_natdci.php'; ?> <!-- DB idioma e codigos nativo -->
          </select>
        </div>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text text-danger">2.08 - Idioma da legenda na cópia de seleção</label>
          <select class="form-select" name="leg_copiaselecao_dci" id="leg_copiaselecao_dci" required>
            <option value="" selected="selected">selecione</option>
            <?php include '../../../../php/mysql2form/option_idioma_natdci.php'; ?> <!-- DB idioma e codigos nativo -->
          </select>
        </div>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text">2.09 - Acessibilidade</label>
          <div class="form-control">
            <input class="form-check-input" name="acessibilidade_ad" type="checkbox" value="AD"> audio descrição<br>
            <input class="form-check-input" name="acessibilidade_ccap" type="checkbox" value="CCAP"> leg. descritiva<br>
            <input class="form-check-input" name="acessibilidade_libras" type="checkbox" value="LIBRAS"> libras
          </div>
        </div>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text text-danger">2.10 - Cópia para Seleção</label>
          <input name="copia_selecao" type="hidden"  required value="link"> 
          <input class="input-text" name="link_selecao" type="text" id="link_selecao" size="30" maxlength="100" placeholder="link - url?" required>
          <input class="form-control" name="link_password" type="password" id="link_password" size="30" maxlength="100" placeholder="password">
        </div>
        <hr style="height:5px;">
        <h6>3 - CONTATOS</h6>
        <h7>3.1 - Contatos Distribuidora</h7>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text">3.1.01 - Empresa Distribuidora</label>
          <input type="text" class="form-control" name="distribuidora_empresa" id="distribuidora_empresa">
        </div>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text">3.1.02 - Nome do Contato</label>
          <input type="text" class="form-control" name="distribuidora_contatonome" id="distribuidora_contatonome">
        </div>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text">3.1.03 - Telefone</label>
          <input type="text" class="form-control" name="distribuidora_telefone" id="distribuidora_telefone">
        </div>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text">3.1.04 - Celular</label>
          <input type="text" class="form-control" name="distribuidora_celular" id="distribuidora_celular">
        </div>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text">3.1.05 - Fax</label>
          <input type="text" class="form-control" name="distribuidora_fax" id="distribuidora_fax">
        </div>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text">3.1.06 - Email</label>
          <input type="email" class="form-control" name="distribuidora_email" id="distribuidora_email">
        </div>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text">3.1.07 - CEP</label>
          <input type="number" class="form-control" name="distribuidora_cep" id="distribuidora_cep">
        </div>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text">3.1.07.1 - Logradouro</label>
          <input type="text" class="form-control" name="distribuidora_logradouro" id="distribuidora_logradouro">
        </div>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text">3.1.07.2 - Número</label>
          <input type="text" class="form-control" name="distribuidora_numero" id="distribuidora_numero">
        </div>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text">3.1.07.3 - Complemento</label>
          <input type="text" class="form-control" name="distribuidora_complemento" id="distribuidora_complemento">
        </div>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text">3.1.07.4 - Bairro</label>
          <input type="text" class="form-control" name="distribuidora_bairro" id="distribuidora_bairro">
        </div>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text">3.1.07.5 - Cidade</label>
          <input type="text" class="form-control" name="distribuidora_cidade" id="distribuidora_cidade">
        </div>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text">3.1.07.6 - UF</label>
          <input type="text" class="form-control" name="distribuidora_uf" id="distribuidora_uf">
        </div>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text">3.1.08 - Website</label>
          <input type="text" class="form-control" name="distribuidora_website" id="distribuidora_website">
        </div>
        <hr>
        <h7>3.2 - Contatos Produtora</h7>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text text-danger">3.2.01 - Empresa Produtora</label>
          <input type="text" class="form-control" name="produtora_empresa" id="produtora_empresa">
        </div>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text text-danger">3.2.02 - Nome do Contato</label>
          <input type="text" class="form-control" name="produtora_contatonome" id="produtora_contatonome">
        </div>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text text-danger">3.2.03 - Telefone</label>
          <input type="text" class="form-control" name="produtora_telefone" id="produtora_telefone">
        </div>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text text-danger">3.2.04 - Celular</label>
          <input type="text" class="form-control" name="produtora_celular" id="produtora_celular">
        </div>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text">3.2.05 - Fax</label>
          <input type="text" class="form-control" name="produtora_fax" id="produtora_fax">
        </div>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text text-danger">3.2.06 - Email</label>
          <input type="email" class="form-control" name="produtora_email" id="produtora_email">
        </div>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text text-danger">3.2.07 - CEP</label>
          <input type="number" class="form-control" name="produtora_cep" id="produtora_cep">
        </div>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text text-danger">3.2.07.1 - Logradouro</label>
          <input type="text" class="form-control" name="produtora_logradouro" id="produtora_logradouro">
        </div>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text text-danger">3.2.07.2 - Número</label>
          <input type="text" class="form-control" name="produtora_numero" id="produtora_numero">
        </div>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text">3.2.07.3 - Complemento</label>
          <input type="text" class="form-control" name="produtora_complemento" id="produtora_complemento">
        </div>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text text-danger">3.2.07.4 - Bairro</label>
          <input type="text" class="form-control" name="produtora_bairro" id="produtora_bairro">
        </div>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text text-danger">3.2.07.5 - Cidade</label>
          <input type="text" class="form-control" name="produtora_cidade" id="produtora_cidade">
        </div>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text text-danger">3.2.07.6 - UF</label>
          <input type="text" class="form-control" name="produtora_uf" id="produtora_uf">
        </div>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text">3.2.08 - Website</label>
          <input type="text" class="form-control" name="produtora_website" id="produtora_website">
        </div>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text">3.2.09 - Currículo da empresa produtora</label>
          <textarea class="form-control" name="produtora_curriculo" id="produtora_curriculo" rows="5" placeholder="(limitado a 500 caracteres com espaço)"></textarea>
        </div>
        <hr>
        <h7>3.3 - Contato Direção</h7>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text">3.3.01 - Telefone</label>
          <input type="text" class="form-control" name="diretor_telefone" id="diretor_telefone">
        </div>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text">3.3.02 - Celular</label>
          <input type="text" class="form-control" name="diretor_celular" id="diretor_celular">
        </div>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text">3.3.03 - Fax</label>
          <input type="text" class="form-control" name="diretor_fax" id="diretor_fax">
        </div>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text text-danger">3.3.04 - Email</label>
          <input type="email" class="form-control" name="diretor_email" id="diretor_email" required>
        </div>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text">3.3.05 - Website</label>
          <input type="text" class="form-control" name="diretor_website" id="diretor_website">
        </div>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text">3.3.06 - Estará disponível para entrevistas por telefone ou email?</label>
          <div class="form-control">
            <input name="diretor_disponivel" type="radio" value="sim"> Sim<br>
            <input name="diretor_disponivel" type="radio" value="não"> Não
          </div>
        </div>
        <hr style="height:5px;">
        <h6>4 - CRÉDITOS</h6>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text text-danger">4.01 - Roteiro</label>
          <input type="text" class="form-control" name="roteiro" id="roteiro" required>
        </div>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text text-danger">4.02 - Empresa Co-Produtora</label>
          <input type="text" class="form-control" name="coproducao" id="coproducao" placeholder="(caso o filme não tenha empresas co-produtoras colocar: NÃO HÁ)" required>
        </div>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text text-danger">4.03 - Produção</label>
          <input type="text" class="form-control" name="producao" id="producao" placeholder="(pessoa física responsável pelo filme)" required>
        </div>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text text-danger">4.04 - Fotografia</label>
          <input type="text" class="form-control" name="fotografia" id="fotografia" required>
        </div>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text text-danger">4.05 - Montagem</label>
          <input type="text" class="form-control" name="montagem" id="montagem" required>
        </div>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text text-danger">4.06 - Direção de Arte</label>
          <input type="text" class="form-control" name="arte" id="arte" placeholder="(caso o filme não tenha trabalho de arte colocar: NÃO HÁ)" required>
        </div>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text text-danger">4.07 - Edição de Som</label>
          <input type="text" class="form-control" name="somedicao" id="somedicao" required>
        </div>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text text-danger">4.08 - Música</label>
          <input type="text" class="form-control" name="musica" id="musica" placeholder="(caso o filme não músicas colocar: NÃO HÁ)" required>
        </div>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text text-danger">4.09 - Figurino</label>
          <input type="text" class="form-control" name="figurino" id="figurino" placeholder="(caso o filme não tenha trabalho de figurino colocar: NÃO HÁ)" required>
        </div>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text text-danger">4.10 - Elenco (máx. 5 atores)</label>
          <textarea class="form-control" name="elenco" id="elenco" rows="5" placeholder="(caso documentário, preencha: documentário)"></textarea>
        </div>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text text-danger">4.11 - Sinopse</label>
          <textarea class="form-control" name="sinopse_br" id="sinopse_br" rows="5" placeholder="(limitado a 580 [longa] ou 210 [curta] caracteres com espaços)"></textarea>
        </div>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text text-danger">4.12 - Direção Biografia</label>
          <textarea class="form-control" name="diretor_biografia_br" id="diretor_biografia_br" rows="5" placeholder="(limitado a 430 [longa] ou 180 [curta] caracteres com espaços)"></textarea>
        </div>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text text-danger">4.13 - Direção Filmografia</label>
          <textarea class="form-control" name="diretor_filmografia_br" id="diretor_filmografia_br" rows="5" placeholder="(limitado a 500 caracteres com espaço)"></textarea>
        </div>
        <hr style="height:5px;">
        <h6>5 - TRÁFEGO DE CÓPIAS</h6>
        <h7>5.1 - Devolução de Cópias</h7>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text text-danger">5.1.01 - Contato</label>
          <input type="text" class="form-control" name="destino_contato" id="destino_contato" placeholder="(caso o filme não músicas colocar: NÃO HÁ)" required>
        </div>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text text-danger">5.1.02 - CEP</label>
          <input type="number" class="form-control" name="destino_cep" id="destino_cep">
        </div>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text text-danger">5.1.03.1 - Logradouro</label>
          <input type="text" class="form-control" name="destino_logradouro" id="destino_logradouro">
        </div>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text text-danger">5.1.03.2 - Número</label>
          <input type="text" class="form-control" name="destino_numero" id="destino_numero">
        </div>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text">5.1.03.3 - Complemento</label>
          <input type="text" class="form-control" name="destino_complemento" id="destino_complemento">
        </div>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text text-danger">5.1.03.4 - Bairro</label>
          <input type="text" class="form-control" name="destino_bairro" id="destino_bairro">
        </div>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text text-danger">5.1.03.5 - Cidade</label>
          <input type="text" class="form-control" name="destino_cidade" id="destino_cidade">
        </div>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text text-danger">5.1.03.6 - UF</label>
          <input type="text" class="form-control" name="destino_uf" id="destino_uf">
        </div>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text text-danger">5.1.04 - Telefone</label>
          <input type="text" class="form-control" name="destinotelefone" id="destino_telefone" required>
        </div>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text">5.1.05 - Celular</label>
          <input type="text" class="form-control" name="destino_celular" id="destino_celular">
        </div>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text">5.1.06 - Fax</label>
          <input type="text" class="form-control" name="destino_fax" id="destino_fax">
        </div>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text text-danger">5.1.07 - Email</label>
          <input type="email" class="form-control" name="destino_email" id="destino_email" required>
        </div>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text">5.1.08 - Observações Específicas</label>
          <textarea class="form-control" name="destino_shippinginstruction" id="destino_shippinginstruction" rows="5"></textarea>
        </div>
        <hr style="height:5px;">
        <h6>6 - OBSERVAÇÕES</h6>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text">6.1 - Observações</label>
          <textarea class="form-control" name="observacoes" id="observacoes" rows="5"></textarea>
        </div>

        <hr style="height:5px;">
        <h6>7 - REGULAMENTO</h6>
        <h7>7.1 - Regulamento</h7>
        <div class="form-control">
          <a href="regulamento_ptbr.php?emp_sigla='<?php echo $empresa_sigla; ?>'" target="_blank">ver regulamento</a> | <a href="../../regrasDCP_01.pdf">regras técnicas para DCP (pdf)</a>
        </div>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text text-danger">7.1.1 - Aprovação</label>
          <div class="form-control text-danger">
            <input class="form-check-input" name="regulamento" type="checkbox" value="concordo" required> li e concordo com o regulamento
          </div>
        </div>
        <hr style="height:5px;">
        <div class="btn-group" role="group" aria-label="Basic example">
          <button type="submit" class="btn btn-primary btn-sm" name="submit" id="submit" value="Enviar">enviar</button>
          <button type="reset" class="btn btn-outline-secondary btn-sm" name="reset" id="reset" value="Limpar">limpar</button>
        </div>
      </form>
      <hr>
      <div class="d-flex justify-content-center fixed-bottom">
        <small>
          <small>Desenvolvido por Bruno Sá - <a href='//www.bruno-sa.com' target='_blank'>www.bruno-sa.com</a></small>
        </small>
      </div>
    </div>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src='https://code.jquery.com/jquery-3.6.0.js' integrity='sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=' crossorigin='anonymous'></script>
    <script type="text/javascript">

            $("#distribuidora_cep").focusout(function(){
          //Início do Comando AJAX
          $.ajax({
            //O campo URL diz o caminho de onde virá os dados
            //É importante concatenar o valor digitado no CEP
            url: 'https://viacep.com.br/ws/'+$(this).val()+'/json/unicode/',
            //Aqui você deve preencher o tipo de dados que será lido,
            //no caso, estamos lendo JSON.
            dataType: 'json',
            //SUCESS é referente a função que será executada caso
            //ele consiga ler a fonte de dados com sucesso.
            //O parâmetro dentro da função se refere ao nome da variável
            //que você vai dar para ler esse objeto.
            success: function(resposta){
              //Agora basta definir os valores que você deseja preencher
              //automaticamente nos campos acima.
              $("#distribuidora_logradouro").val(resposta.logradouro);
              $("#distribuidora_complemento").val(resposta.complemento);
              $("#distribuidora_bairro").val(resposta.bairro);
              $("#distribuidora_cidade").val(resposta.localidade);
              $("#distribuidora_uf").val(resposta.uf);
              //Vamos incluir para que o Número seja focado automaticamente
              //melhorando a experiência do usuário
              $("#distribuidora_numero").focus();
            }
          });
        });

            $("#produtora_cep").focusout(function(){
          //Início do Comando AJAX
          $.ajax({
            //O campo URL diz o caminho de onde virá os dados
            //É importante concatenar o valor digitado no CEP
            url: 'https://viacep.com.br/ws/'+$(this).val()+'/json/unicode/',
            //Aqui você deve preencher o tipo de dados que será lido,
            //no caso, estamos lendo JSON.
            dataType: 'json',
            //SUCESS é referente a função que será executada caso
            //ele consiga ler a fonte de dados com sucesso.
            //O parâmetro dentro da função se refere ao nome da variável
            //que você vai dar para ler esse objeto.
            success: function(resposta){
              //Agora basta definir os valores que você deseja preencher
              //automaticamente nos campos acima.
              $("#produtora_logradouro").val(resposta.logradouro);
              $("#produtora_complemento").val(resposta.complemento);
              $("#produtora_bairro").val(resposta.bairro);
              $("#produtora_cidade").val(resposta.localidade);
              $("#produtora_uf").val(resposta.uf);
              //Vamos incluir para que o Número seja focado automaticamente
              //melhorando a experiência do usuário
              $("#produtora_numero").focus();
            }
          });
        });

        $("#destino_cep").focusout(function(){
          //Início do Comando AJAX
          $.ajax({
            //O campo URL diz o caminho de onde virá os dados
            //É importante concatenar o valor digitado no CEP
            url: 'https://viacep.com.br/ws/'+$(this).val()+'/json/unicode/',
            //Aqui você deve preencher o tipo de dados que será lido,
            //no caso, estamos lendo JSON.
            dataType: 'json',
            //SUCESS é referente a função que será executada caso
            //ele consiga ler a fonte de dados com sucesso.
            //O parâmetro dentro da função se refere ao nome da variável
            //que você vai dar para ler esse objeto.
            success: function(resposta){
              //Agora basta definir os valores que você deseja preencher
              //automaticamente nos campos acima.
              $("#destino_logradouro").val(resposta.logradouro);
              $("#destino_complemento").val(resposta.complemento);
              $("#destino_bairro").val(resposta.bairro);
              $("#destino_cidade").val(resposta.localidade);
              $("#destino_uf").val(resposta.uf);
              //Vamos incluir para que o Número seja focado automaticamente
              //melhorando a experiência do usuário
              $("#destino_numero").focus();
            }
          });
        });
    </script>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
  </body>
</html>
<?php mysqli_close($con); ?>