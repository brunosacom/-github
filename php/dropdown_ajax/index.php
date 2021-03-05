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
    <select id="sel_uf">
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
  xhttp.open("GET", "data.php, true);
  xhttp.send();
}
</script>
</html>
