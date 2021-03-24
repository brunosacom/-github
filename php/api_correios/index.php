<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Teste</title>
<script src="https://code.jquery.com/jquery-3.5.1.js" type="text/javascript"></script>
</head>

<body>

	<!--Formulário-->
    <h1>Consulta ViaCEP JSON</h1>
	<form>
		<p>
		  <label for="cep">CEP</label>
		  <br>
          <input id="cep" type="text" required/>
	    </p>
		<p>
		  <label for="logradouro">Logradouro</label>
		  <br>
		  <input id="logradouro" type="text" required/></p>
		<p>
		  <label for="numero">Número</label>
		  <br>
		  <input id="numero" type="text" /></p>
		<p>
		  <label for="complemento">Complemento</label>
		  <br>
		  <input id="complemento" type="text"/>
	    </p>
		<p>
		  <label for="bairro">Bairro</label>
		  <br>
		  <input id="bairro" type="text" required/>
	    </p>
      	<p>
		  <label for="localidade">Localidade/Cidade</label>
		  <br>
		  <input id="localidade" type="text" required/>
	    </p>
		<p>
		  <label for="uf">Estado</label>
		  <br>
		  <select id="uf">
		    <option value="" selected></option>
		    <option value="AC">Acre</option>
		    <option value="AL">Alagoas</option>
		    <option value="AP">Amapá</option>
		    <option value="AM">Amazonas</option>
		    <option value="BA">Bahia</option>
		    <option value="CE">Ceará</option>
		    <option value="DF">Distrito Federal</option>
		    <option value="ES">Espírito Santo</option>
		    <option value="GO">Goiás</option>
		    <option value="MA">Maranhão</option>
		    <option value="MT">Mato Grosso</option>
		    <option value="MS">Mato Grosso do Sul</option>
		    <option value="MG">Minas Gerais</option>
		    <option value="PA">Pará</option>
		    <option value="PB">Paraíba</option>
		    <option value="PR">Paraná</option>
		    <option value="PE">Pernambuco</option>
		    <option value="PI">Piauí</option>
		    <option value="RJ">Rio de Janeiro</option>
		    <option value="RN">Rio Grande do Norte</option>
		    <option value="RS">Rio Grande do Sul</option>
		    <option value="RO">Rondônia</option>
		    <option value="RR">Roraima</option>
		    <option value="SC">Santa Catarina</option>
		    <option value="SP">São Paulo</option>
		    <option value="SE">Sergipe</option>
		    <option value="TO">Tocantins</option>
	      </select>
	    </p>
        <p>
		  <label for="unidade">Unidade</label>
		  <br>
		  <input id="unidade" type="text"/>
	    </p>
        <p>
		  <label for="ibge">IBGE - cod municipio</label>
		  <br>
		  <input id="ibge" type="text" required/>
	    </p>
        <p>
		  <label for="gia">GIA</label>
		  <br>
		  <input id="gia" type="text"/>
	    </p>
    </form>
	
	<script type="text/javascript">
		$("#cep").focusout(function(){
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
					$("#logradouro").val(resposta.logradouro);
					$("#complemento").val(resposta.complemento);
					$("#bairro").val(resposta.bairro);
					$("#localidade").val(resposta.localidade);
					$("#uf").val(resposta.uf);
					$("#unidade").val(resposta.unidade);
					$("#ibge").val(resposta.ibge);
					$("#gia").val(resposta.gia);
					//Vamos incluir para que o Número seja focado automaticamente
					//melhorando a experiência do usuário
					$("#numero").focus();
				}
			});
		});
	</script>
</body>
</html>