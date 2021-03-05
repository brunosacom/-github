<?php 
require $_SERVER['DOCUMENT_ROOT']."/php/mysqli_connect.php";
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>DropDown using Ajax JS</title>
</head>
<body>

<h1>The XMLHttpRequest Object</h1>

<form action=""> 
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
    <div id="txtHint">Unidades Federativas</div>
    <select id="sel_uf">
        <option value="0">- Select -</option>
    </select>
</form>
<br>
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

  xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
                var data = JSON.parse(this.responseText);
                console.log(data);

                var html = "";
                for(var a = 0; a < data.length; a++) {
                    var uf_id = data[a].uf_id;
                    var uf_alpha2 = data[a].uf_alpha2;
                    var uf_nome = data[a].uf_nome;
    
                    html += "<option value='" + uf_id + "'>" + uf_nome + "</option>";
                }
                document.getElementById("sel_uf").innerHTML += html;

            }
        }



}
</script>

</body>
</html>
