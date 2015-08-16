<html>
<head><link rel="Stylesheet" type="text/css"
            href="X-TRAKT0R/style.css"></head>
<body>
<br>
&nbsp;&nbsp;&nbsp;&nbsp;<img src="icon.png" align="middle">
<hr>
<h3><div style="position: absolute; top:10px; right: 0; width: 59px;"><a href="retrieval.php"><b>Home</b></a></div>
<?php
$path = "./multimedia/";
$results = scandir($path);
echo '<br>';
foreach ($results as $result) {
    if ($result === '.' or $result === '..') continue;

    if (is_dir($path . '/' . $result)) {
        echo '<h3>'.'<center>'.'<a href="./multimedia/'.$result.'">'.$result.'<a>'.'</center>'.'<h3>';
    }
}
?>
</body>
</html>