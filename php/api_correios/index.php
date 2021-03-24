<html>
    <head>
    <title>ViaCEP Webservice</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

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
    </head>

    <body>
    <!-- Inicio do formulario -->
      <form method="get" action=".">
        <label>Cep:
        <input name="cep" type="text" id="cep" value="" size="10" maxlength="9"
               onblur="pesquisacep(this.value);" /></label><br />
        <label>logradouro:
        <input name="logradouro" type="text" id="logradouro" size="60" /></label><br />
		<label>numero:
        <input name="numero" type="text" id="numero" size="60" /></label><br />
		<label>complemento:
        <input name="complemento" type="text" id="complemento" size="60" /></label><br />
        <label>Bairro:
        <input name="bairro" type="text" id="bairro" size="40" /></label><br />
        <label>Cidade:
        <input name="cidade" type="text" id="cidade" size="40" /></label><br />
        <label>Estado:
        <input name="uf" type="text" id="uf" size="2" /></label><br />
		<label>unidade:
        <input name="unidade" type="text" id="unidade" size="60" /></label><br />
        <label>IBGE:
        <input name="ibge" type="text" id="ibge" size="8" /></label><br />
		<label>GIA:
        <input name="gia" type="text" id="gia" size="60" /></label><br />
      </form>
    </body>

    </html>