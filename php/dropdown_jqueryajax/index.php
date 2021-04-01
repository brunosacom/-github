<?php 
require $_SERVER['DOCUMENT_ROOT']."/php/mysqli_connect.php";
?>

<!DOCTYPE HTML>
<html>
    <head>
    <?php include_once $_SERVER['DOCUMENT_ROOT'].'/php/analyticstracking.php'; ?>
    <meta charset="utf-8">
    <title>DropDown using JQuery Ajax</title>
    <script src="https://code.jquery.com/jquery-3.6.0.js" type="text/javascript"></script>

        <script type="text/javascript">  
        $(document).ready(function(){

            $("#sel_pais").change(function(){
                var psid = $(this).val();

                $.ajax({
                    url: 'postuf.php',
                    type: 'post',
                    data: {ps:psid},
                    dataType: 'json',
                    success:function(response){

                        var len = response.length;

                        $("#sel_uf").empty();
                        for( var i = 0; i<len; i++){
                            var uf_id = response[i]['uf_id'];
                            var uf_nome = response[i]['uf_nome'];
                            
                            $("#sel_uf").append("<option value='"+uf_id+"'>"+uf_nome+"</option>");

                        }
                    }
                });
            });

        });
        </script>
    </head>

    <body>

        <div>paises</div>
        <select id="sel_pais">
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

