<?php session_start();
require_once("php/conexion.php");
$cnn = new Connection();
$cnn->connectDB();
function Options($query)
{
  $result = mysql_query($query);
  $regs = mysql_num_rows($result);
  for($i = 0;$i<$regs ; $i++)
  {
    $row = mysql_fetch_row($result);
    echo "<option> $row[0]";  
  }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>NASA Education feedback</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- CSS -->
    <link href="css/ninja.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
    <![endif]-->

    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>

</head>
 <body onload="initMap()" style="margin:0px; border:0px; padding:0px;">

    <div id="wrap">
    <div id="topn">
      <div class="container">
 
        <div class="row-fluid">
            <div class="span9"><p class="nlogo"><img src="http://s3.amazonaws.com/ninjacode/images/icon-nasa2.png"> NASA Education feedback</p></div>
            <div class="span3">
                <p class="user">
                  <?php
                      if (!isset($_SESSION["status"]))
                      {
                          echo "<a href='#signin' role='button' class='btn btn-success pull-right'  data-toggle='modal'>Sign In</a>";
                          if(isset($response)) echo "<h4>".$response."</h4>"; 
                      }
                      else
                      {
                        $usr = $_SESSION["userid"];
                        $name = mysql_query("SELECT `Name` FROM `Users` WHERE `ID_User` = $usr");
                        while($line = mysql_fetch_array($name, MYSQL_ASSOC)){
                          foreach ($line as $nameu) {
                            echo "<img src='http://cdn1.iconfinder.com/data/icons/nuvola2/32x32/apps/personal.png'> 
                          $nameu 
                        <a href='/php/login.php?status=loggedout' role='button' class='btn btn-success pull-right'  data-toggle='modal'>Logout</a>";
                        }
                        /*echo "<img src='http://cdn1.iconfinder.com/data/icons/nuvola2/32x32/apps/personal.png'> 
                          $name 
                        <a href='/php/login.php?status=loggedout' role='button' class='btn btn-success pull-right'  data-toggle='modal'>Logout</a>'";*/
                      }
                    }
                   ?>
              </p>
           </div>
        </div>
        
      </div>

<!-- Sign in -->
<div id="signin" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Please sign in</h3>
  </div>
  <div class="modal-body">
     <form class="form-signin" method="post" action="http://spaceapps.ninjas.mx/php/login.php">
        <input type="email" class="input-block-level" name="email" placeholder="Email . . ."/>
        <input type="password"  class="input-block-level" name="password" placeholder="Password . . ."/>
        <label class="checkbox">
          <input type="checkbox" value="remember-me"> Remember me
        </label>    
  </div>

  <div class="modal-footer">
    <button class="btn btn-primary" type="submit">Sign in</button>
  </div>
  </form>
</div>
    </div>