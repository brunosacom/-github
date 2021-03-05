<?php 
require $_SERVER['DOCUMENT_ROOT']."/php/mysqli_connect.php";
?>

<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>DropDown using JQuery Ajax</title>
    <script type="text/javascript">
        function response() {
            var paisid = document.getElementById("sel_pais").value;
            var ps = "ps=" + paisid;

            var len = response.length;

            document.getElementById("sel_uf").empty();
                for( var i = 0; i<len; i++){
                    var uf_id = response[i]['uf_id'];
                    var uf_nome = response[i]['uf_nome'];
                    
                    document.getElementById("sel_uf").append("<option value='"+uf_id+"'>"+uf_nome+"</option>");

                }


            var ajx = new XMLHttpRequest();
            ajx.onreadystatechange = function () {
                if (ajx.readyState == 4 && ajx.status == 200) {
                    document.getElementById("sel_uf").innerHTML = ajx.responseText;
                }
            };
            ajx.open("POST", "data.php", true);
            ajx.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            ajx.send(ps);
            //document.getElementById("message").innerHTML = creds;
        }
    </script>
</head>

<body>

<div>paises</div>
<select id="sel_pais" onchange="response();">
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
</body>
</html>

