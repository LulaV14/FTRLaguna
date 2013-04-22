<?php include('header.php'); ?>

      <div class="container">

        <div class="well ntop">

          <div class="row-fluid">

              <div class="span8">

<script type="text/javascript">
  function sendPost(){
    var element = document.getElementById("opciones");
    var strIcon = element.options[element.selectedIndex].value;
    var msj = document.getElementById('message').value;

    alert('Icon:'+strIcon+'\nMsj:'+msj);

        if (strIcon=="" || msj==""){
         document.getElementById("txtAlerta").innerHTML='agrega un mensaje';
         return;
        } if (window.XMLHttpRequest){
          // code for IE7+, Firefox, Chrome, Opera, Safari
          xmlhttp=new XMLHttpRequest();
        } else {
          // code for IE6, IE5
          xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }

      xmlhttp.onreadystatechange=function(){
        if (xmlhttp.readyState==4 && xmlhttp.status==200){
            document.getElementById("txtAlerta").innerHTML=xmlhttp.responseText;
        }
      }

      xmlhttp.open("GET","php/saveMsg.php?m="+msj+"&i="+strIcon,true);
      xmlhttp.send();
    } 
  </script>

            <div id="txtAlerta"></div>

                <div class="page-header">
                    <h2>Share Your NASA Experience</h2>
                </div>
                <!--<form>-->
                <div class="row-fluid">
                <textarea id="message" type="text" name="message" placeholder="Mensaje . . ." class="span12" rows="6"></textarea>
                </div>

                <p class="pull-left">   <select id="opciones" name="icon[]">
      <option value="">Selecciona un icono:</option>
      <?php
        $result=mysql_query("SELECT ID_Icon, Name FROM Icon");
        while($line = mysql_fetch_array($result, MYSQL_ASSOC)){
          echo "<option value='$line[ID_Icon]'>$line[Name]</option>";
        }
      ?>
    </select> </p>
                <button class="btn btn-large btn-danger pull-right" type="submit" name="submit" value="Post" onclick="sendPost();">Share</button>
              <!--</form>-->
              </div>

              <div class="span4">
                <h3>Experience</h3>

                           <?php
              $mquery = "SELECT `Message`, `Link` FROM `Feeling` join `Icon` on Icon.ID_Icon = Feeling.ID_Icon ORDER BY `Dates` LIMIT 6 ";
              $result = mysql_query($mquery);
              $regs = mysql_num_rows($result);
              for($i = 0;$i<$regs ; $i++)
              {
                $row = mysql_fetch_row($result);
                $link = $row[1];
                $message = $row[0];
                echo "<div class='alert alert-info'>
                            <button type='button' class='close' data-dismiss='alert'>×</button>
                            <img src='".$link."'> $message
                          </div>" ;
              }
              ?>
              
          </div>

        </div>

      
      </div>

      <div id="push"></div>
    </div>

<?php include 'footer.php'; ?>