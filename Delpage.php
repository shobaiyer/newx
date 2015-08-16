<html>
<head><link rel="Stylesheet" type="text/css"
            href="X-TRAKT0R/style.css">
    <title></title>

    <script type="text/javascript" src="../jquery-1.9.1.min.js"></script>
    <script>
	function store(str)
	{
	document.getElementById('check').value=str;
	document.getElementById('form').submit();
	}
    </script>
</head>
<body>
<form id="form" name="form" action="Delete.php" method="post" >
&nbsp;
<br>
&nbsp;&nbsp;<img src="icon.png" align="middle">
<hr>
<h3/>
<div style="position: absolute; top:10px; right: 0; width: 59px;"><a href="retrieval.php"><b>Home</b></a></div>

<?php
$searchval = $_POST['link_search'];
//$con=mysql_connect("localhost","root","");
$con = mysqli_connect("localhost","root","","test1");



 $result = mysqli_query($con,"Select * From data WHERE Folder_Name LIKE '%".$searchval."%' ");
  $result2 = mysqli_num_rows($result);
echo "&nbsp;&nbsp;Related data contents found = ".($result2);
echo '<hr>';
echo "<br>";

//$result2 = mysql_query("Select * From data WHERE Folder_Name LIKE '%".$searchval."%'",$con);
//$number_of_results = mysqli_num_rows($result,$con);
//echo"<h3>Total results are".$number_of_results."</h3>";
//$doccount = 0;
//$images=0;
$flname="";
while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
{

  // $filext = $row["File_Extension"];

/*
    if($fileext=="jpg" || $fileext=="png" || $fileext=="gif" || $fileext=="JPG")
    {
       $images++;
    }

    elseif($fileext=="doc" || $fileext =="txt")
    {
       $doccount++;
    }
*/

    $abc=$row['Filename_with_Path'];
$abc2=$row['Folder_Name'];
    

echo '<a href="./multimedia/'.$abc.'">'."&nbsp;&nbsp;".$abc.'</a>'."&nbsp;&nbsp;&nbsp;&nbsp;";
?>
<input type="button" class="sub2" value="Delete" onclick="store('<?php echo $abc;?>')">
<?php
    echo "<br><br>";
    $flname = $row["Folder_Name"];

}
/*
echo "Total Documents are ".($doccount);
echo "Total images are ".($images);
*/
echo '<p style=" position: absolute; bottom: 15px; width: 100%; text-align: center;">&nbsp;&nbsp;<a href="g.php">If file not found check index</a></p>';
?>
<input type="hidden" name="check" id="check" />
</form>
</body>
</html>