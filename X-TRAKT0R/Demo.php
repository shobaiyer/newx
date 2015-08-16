<?php

//STEP 1 Connect To Database
$connect = mysql_connect("localhost","root","");
if (!$connect)
{
die("MySQL could not connect!");
}

$DB = mysql_select_db('Register');

if(!$DB)
{
die("MySQL could not select Database!");
}

//STEP 2 Declare Variables
if(isset($_POST['submit'])!="")
            {
$Name = $_POST['username'];
$Pass = $_POST['password'];
$Query = mysql_query("SELECT * FROM Users WHERE Username='$Name' AND Password='$Pass'");
$NumRows = mysql_num_rows($Query);
$_SESSION['username'] = $Name;
$_SESSION['password'] = $Pass;

//STEP 3 Check to See If User Entered All Of The Information

if(empty($_SESSION['username']) || empty($_SESSION['password']))
{
echo "<script>alert('Go back and login before you visit this page!');</script>";
}





//STEP 4 Check Username And Password With The MySQL Database

if($NumRows != 0)
{
while($Row = mysql_fetch_assoc($Query))
{
$Database_Name = $Row['username'];
$Database_Pass = $Row['password'];
}
}
else
{
echo "<script>alert('Incorrect Username or Password!');
window.location = 'login.php';</script>";
}
}
if($Name == $Database_Name && $Pass == $Database_Pass)
{

// If The User Makes It Here Then That Means He Logged In Successfully
echo '<h3 style="position: absolute; top:-5px; left: 4px; ">'."&nbsp;&nbsp;&nbsp;Hello " . $_SESSION['username'] . "!".'</h3><br><br>';
}


?>



<html>
<head>
<link rel="Stylesheet" type="text/css"
href="style.css">
<link href="themes/js-image-slider.css" rel="stylesheet" type="text/css" />
    <script src="themes/js-image-slider.js" type="text/javascript"></script>
    <link href="generic.css" rel="stylesheet" type="text/css" />
    <title></title>
</head>
<body>
<div style="position: absolute; top:-5px; right: 4px; width: 59px;"><a href="logout.php"><h3><b>Logout</b></h3></a></div>

<?php
/*
session_start();
 $name = $_SESSION['username'];

echo "<h2>&nbsp;Welcome ".$name."!!!</h2>";
*/
?>

<fieldset class="menubar">
<h3>&nbsp;&nbsp;<a href="note.php" class="x">Read Me</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="../retrieval.php" class="x">Retriever</a></h3>
</fieldset>
<h2>&nbsp;&nbsp;<img src="icon.png" align="middle"> &nbsp;SOZO-X</h2>
<hr>
<form action="result.php" method="POST" id="form1" name="form1">
  <fieldset class="normal">
   <p align="center">
   <b/> Enter URL: <input name="link_url" placeholder="http://" id="link_url" type="url" style="width: 260px;" autofocus required autocomplete="on">
    <br>
  Enter type of data: 
  
   <select name="link_type" id="link_type">
   <option selected="selected">Select a data type</option>
  <option value="text">Text</option>
  <option value="img">Image</option>
  <option value="audio">Audio</option>
  <option value="video">HTML5 Video</option>
</select>
<br><br>
    <input type="submit" class="sub2" id="submit" name="submit" value="GO">
	</p>
	
</fieldset>
<br>
  <div id="sliderFrame">
        <div id="slider">
            <img src="images/text.jpg" alt="TEXT" />
            <img src="images/image.jpg" alt="IMAGE" />
<img src="images/audio.jpg" alt="AUDIO" />
            <img src="images/video.jpg" alt="VIDEO" />
        </div>
		 <div id="thumbs">
            <!--Each thumb-->
            <div class="thumb"><img src="images/thumb-3.gif" /></div>
            <div class="thumb"><img src="images/thumb-4.gif" /></div>
            <div class="thumb"><img src="images/thumb-2.gif" /></div>
            <div class="thumb"><img src="images/thumb-1.gif" /></div>
        </div>
       </div>
</form>
</body>
</html>