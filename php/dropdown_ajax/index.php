<?php 
require $_SERVER['DOCUMENT_ROOT']."/php/mysqli_connect.php";
?>

<!DOCTYPE HTML>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="author" content="Bruno Sá - www.bruno-sa.com">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Didact Gothic" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

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
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    -->
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
  </body>
</html>
