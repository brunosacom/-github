<?php 
require $_SERVER['DOCUMENT_ROOT']."/php/mysqli_connect.php";
?>
<!DOCTYPE HTML>
<html lang="pt-br">
  <head>
    <?php include_once $_SERVER['DOCUMENT_ROOT'].'/php/analyticstracking.php'; ?>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="author" content="Bruno Sá - www.bruno-sa.com">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Didact Gothic" rel="stylesheet">
    <?php include_once $_SERVER['DOCUMENT_ROOT'].'/php/bootstrap_head.php'; ?>
    <title>DropDown using Ajax JS</title>
  </head>

  <body style="font-family:Didact Gothic; color:#FFF; background-color:#333;">
    <div class="container">
    <h1>DropDown Ajax JS</h1>
      <form action="">
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text">1. País</label>
          <select class="form-select" name="sel_pais" id="sel_pais" onchange="showUF(this.value)">
          <option value="0" SELECTED>- Select -</option>
            <?php 
            // Fetch Department
            $sql_pais = "SELECT * FROM _pais ORDER BY pais_ptbr ASC";
            $pais_data = mysqli_query($con,$sql_pais);
            while($row = mysqli_fetch_assoc($pais_data) ){
                $paisid = $row['pais_numero'];
                $pais_ptbr = $row['pais_ptbr'];
                
                // Option
                echo "<option value=\"".$paisid."\" >".$pais_ptbr."</option>";
            }
            ?>
          </select>
        </div>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text">2. UF</label>
          <select class="form-select" name="sel_uf" id="sel_uf" onchange="showMunicipio(this.value)">
            <option value="0">- Select -</option>
          </select>
        </div>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text">3. Município</label>
          <select class="form-select" name="sel_municipio" id="sel_municipio">
            <option value="0">- Select -</option>
          </select>
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
    <script>
      function showUF(str) {
        var xhttp;
        if (str == "") {
          document.getElementById("sel_uf").innerHTML = "";
          return;
        }
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
          document.getElementById("sel_uf").innerHTML = this.responseText;
          }
        };
        xhttp.open("GET", "getuf.php?ps=" + str, true);
        xhttp.send();
      };
      function showMunicipio(str) {
        var xhttp;
        if (str == "") {
          document.getElementById("sel_municipio").innerHTML = "";
          return;
        }
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
          document.getElementById("sel_municipio").innerHTML = this.responseText;
          }
        };
        xhttp.open("GET", "getmunicipio.php?uf=" + str, true);
        xhttp.send();
      };
    </script>
    <?php include_once $_SERVER['DOCUMENT_ROOT'].'/php/bootstrap_body.php'; ?>
  </body>
</html>