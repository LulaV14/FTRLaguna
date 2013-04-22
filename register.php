<?php 
include 'header.php';
 ?>
<script language="javascript">
//Enable the list of States depending on the selected Country
function enableCity(countryId)
{
    var strURL="php/findState.php?country="+countryId;
    if (window.XMLHttpRequest){
    // code for IE7+, Firefox, Chrome, Opera, Safari
         req=new XMLHttpRequest();
    } else {
    // code for IE6, IE5
         req=new ActiveXObject("Microsoft.XMLHTTP");
    }
    if (req)
    {
        req.onreadystatechange = function()
        {
             if (req.readyState == 4)
             {
              // only if "OK"
                 if (req.status == 200)
                {
                    document.getElementById('state').innerHTML=req.responseText;
                } else {
                     alert("There was a problem while using XMLHTTP:\n" + req.statusText);
                }
              }
          }
       req.open("GET", strURL, true);
       req.send(null);
   }
}
function formValidation()
{
  var reName =  /^[a-zA-Z ]{1,20}$/;
  var name = document.getElementById("name").value;
  var lastname = document.getElementById("lastname").value;
  var email = document.getElementById("email").value;
  var pass = document.getElementById("pass").value;
  var pass2 = document.getElementById("repass").value;
  var birthday = document.getElementById("birthday").value;
  var career = document.getElementById("career").value;
  if (!reName.test(name) || !reName.test(lastname)) {
    window.alert("Incorrect Name Format");}
  else if (!reName.test(career)){
    window.alert("Incorrect Career Format");}
  else if (pass != pass2){
    window.alert("Check Password");}
  else{
    document.registerForm.submit();}
}
</script>

            <div class="container">

        <div class="row-fluid ntop">
          <div class="span8">

<div class="well">


            <div class="page-header">
            <h1>Register</h1>
          </div>
          <p>Welcome to the NASA Education feedback webpage! Using the form below, you can register a new account for use on NASA Education feedback. With your account, you can:</a>.</p>

          <ul>
            <li>Share your NASA Education experience.</li>

<li>Like or dislike other peoples post.</li>

<li>Contribute to NASA Education improvement.</li>

          </ul>

          <br />

  <form name="registerForm" action="php/insert.php" method="POST">
  <fieldset>

    <div class="row-fluid ntop">
      <div class="span6">
    <label>Name</label>
    <input type="text" class="span10" name="name" id="name">

    <label>Last Name:</label>
    <input type="text" class="span10" name="lastname" id = "lastname">

    <label>E-Mail</label>
    <input type="text" class="span10" name="email" id="email">

    <label>Password</label>
    <input type="password" class="span10" name="password" id="pass">

    <label>Re-Password</label>
    <input type="password" class="span10" name="repass" id="repass">

    <label>Country</label>
    <select name="country" class="span10" id="country" onChange="enableCity(this.value)"> 
    <?php Options("SELECT  `Name` FROM `Country` order by `Name` ") ?> </Select>
  </div>
  <div class="span6">

    <label>State</label>
 <select name="state" class="span10" id="state"><?php Options("SELECT distinct`District` FROM `City` where `CountryCode` = 'USA' order by `District`") ?> </Select>


<label>Date of birth</label>
<input type="text" placeholder="YYMMDD" class="span10" name="birthday" id="birthday" maxlength="6">

<label>Gender</label>
<input type="radio" NAME="sex" VALUE="M" CHECKED> Male <br>
<input type="radio" NAME="sex" VALUE="F"> Female <br>

<br />
 <label>Career</label>
 <input type="text" class="span10" name="career" id="career">

<label>Academic Degree</label>
<select name="degree" class="span10">
<?php Options("SELECT `Name` FROM `Degree` order by `Name`") ?> </Select> 

<label>NASA Education Program</label>
<select name="nasaprog" class="span10">
<?php Options("SELECT `Name` FROM `NASAProg` order by `Name`") ?> </Select>
</div>
</div>

<br /><br />
    <button type="button" class="btn" onClick="formValidation()">Submit</button>
  </fieldset>
</form>

</div>

          </div>

          <div class="span4">
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


<a class="twitter-timeline" href="https://twitter.com/NASAedu" data-widget-id="325886738687983616">Tweets por @NASAedu</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>


          </div>
        </div>

        <div id="push"></div>
    </div>

    </div>

<?php include 'footer.php'; ?>