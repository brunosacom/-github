<?php 
require $_SERVER['DOCUMENT_ROOT']."/php/mysqli_connect.php";
?>

<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>DropDown using Ajax JS</title>
</head>

<body>
    <form action="">
    <div>paises</div>
    <select id="sel_pais" onchange="showUF(this.value)">
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
    <div class="clear"></div>

    <div>unidades federativas</div>
    <select id="sel_uf" onchange="showMunicipio(this.value)">
        <option value="0">- Select -</option>
    </select>
    <div class="clear"></div>

    <div>municipios</div>
    <select id="sel_municipio">
        <option value="0">- Select -</option>
    </select>
    </form>
</body>

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
</html>
