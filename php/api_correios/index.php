<!doctype html>
<html lang="pt-br">
  <head>
    <?php include_once $_SERVER['DOCUMENT_ROOT'].'/php/analyticstracking.php'; ?>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="author" content="Bruno Sá - www.bruno-sa.com">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Didact Gothic" rel="stylesheet">
    <?php include_once $_SERVER['DOCUMENT_ROOT'].'/php/bootstrap_head.php'; ?>
    <title>API ViaCEP</title>
    </head>
    <body style="font-family:Didact Gothic; color:#FFF; background-color:#333;">
        <div class="container">
        <h1>API correios ViaCEP</h1>
            <!-- Inicio do formulario -->
            <form method="get" action=".">
                <div class="input-group input-group-sm mb-3">
                    <label class="input-group-text">01. CEP</label>
                    <input class="form-control" name="cep" type="text" id="cep" value="" maxlength="9" onchange="pesquisacep(this.value);" >
                </div>
                <div class="input-group input-group-sm mb-3">
                    <label class="input-group-text">02. logradouro</label>
                    <input class="form-control" name="logradouro" type="text" id="logradouro">
                </div>
                <div class="input-group input-group-sm mb-3">
                    <label class="input-group-text">03. número</label>
                    <input class="form-control" name="numero" type="number" id="numero">
                </div>
                <div class="input-group input-group-sm mb-3">
                    <label class="input-group-text">04. complemento</label>
                    <input class="form-control" name="complemento" type="text" id="complemento">
                </div>
                <div class="input-group input-group-sm mb-3">
                    <label class="input-group-text">05. bairro</label>
                    <input class="form-control" name="bairro" type="text" id="bairro">
                </div>
                <div class="input-group input-group-sm mb-3">
                    <label class="input-group-text">06. cidade</label>
                    <input class="form-control" name="cidade" type="text" id="cidade">
                </div>
                <div class="input-group input-group-sm mb-3">
                    <label class="input-group-text">07. uf</label>
                    <input class="form-control" name="uf" type="text" id="uf">
                </div>
                <div class="input-group input-group-sm mb-3">
                    <label class="input-group-text">08. unidade</label>
                    <input class="form-control" name="unidade" type="text" id="unidade">
                </div>
                <div class="input-group input-group-sm mb-3">
                    <label class="input-group-text">09. IBGE</label>
                    <input class="form-control" name="ibge" type="text" id="ibge">
                </div>
                <div class="input-group input-group-sm mb-3">
                    <label class="input-group-text">10. GIA</label>
                    <input class="form-control" name="gia" type="text" id="gia">
                </div>
            </form>
            <hr>
            <div class="d-flex justify-content-center">
                <div>
                <small>
                    <small>Desenvolvido por Bruno Sá - <a href='//www.bruno-sa.com' target='_blank'>www.bruno-sa.com</a></small>
                </small>
                </div>
            </div>
        </div>
        <!-- Adicionando Javascript -->
        <script>
        
            function limpa_formulário_cep() {
                    //Limpa valores do formulário de cep.
                    document.getElementById('logradouro').value=("");
                    document.getElementById('complemento').value=("");
                    document.getElementById('bairro').value=("");
                    document.getElementById('localidade').value=("");
                    document.getElementById('uf').value=("");
                    document.getElementById('unidade').value=("");
                    document.getElementById('ibge').value=("");
                    document.getElementById('gia').value=("");
            }

            function meu_callback(conteudo) {
                if (!("erro" in conteudo)) {
                    //Atualiza os campos com os valores.
                    document.getElementById('logradouro').value=(conteudo.logradouro);
                    document.getElementById('complemento').value=(conteudo.complemento);
                    document.getElementById('bairro').value=(conteudo.bairro);
                    document.getElementById('cidade').value=(conteudo.localidade);
                    document.getElementById('uf').value=(conteudo.uf);
                    document.getElementById('unidade').value=(conteudo.unidade);
                    document.getElementById('ibge').value=(conteudo.ibge);
                    document.getElementById('gia').value=(conteudo.gia);
                } //end if.
                else {
                    //CEP não Encontrado.
                    limpa_formulário_cep();
                    alert("CEP não encontrado.");
                }
            }
                
            function pesquisacep(valor) {

                //Nova variável "cep" somente com dígitos.
                var cep = valor.replace(/\D/g, '');

                //Verifica se campo cep possui valor informado.
                if (cep != "") {

                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;

                    //Valida o formato do CEP.
                    if(validacep.test(cep)) {

                        //Preenche os campos com "..." enquanto consulta webservice.
                        document.getElementById('logradouro').value="...";
                        document.getElementById('complemento').value="...";
                        document.getElementById('bairro').value="...";
                        document.getElementById('cidade').value="...";
                        document.getElementById('uf').value="...";
                        document.getElementById('unidade').value="...";
                        document.getElementById('ibge').value="...";
                        document.getElementById('gia').value="...";

                        //Cria um elemento javascript.
                        var script = document.createElement('script');

                        //Sincroniza com o callback.
                        script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

                        //Insere script no documento e carrega o conteúdo.
                        document.body.appendChild(script);

                    } //end if.
                    else {
                        //cep é inválido.
                        limpa_formulário_cep();
                        alert("Formato de CEP inválido.");
                    }
                } //end if.
                else {
                    //cep sem valor, limpa formulário.
                    limpa_formulário_cep();
                }
            };

        </script>
        <?php include_once $_SERVER['DOCUMENT_ROOT'].'/php/bootstrap_body.php'; ?>
    </body>

</html>