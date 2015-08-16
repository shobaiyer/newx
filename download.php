<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php


  $aContext = array(
    'http' => array(
        'proxy' => 'tcp://10.0.1.2:8090',
        'request_fulluri' => true,
    ),
);

$cxContext = stream_context_create($aContext);

$val = $_POST['url'];
$text = $_POST['text'];

//session_start();
//$fol2 = $_SESSION['myValue'];
//echo $fol2;
//mkdir($link,0777,False);
$finalurl=null;
$filext=null;





if(isset($val))
{


    session_start();
    $fo2 = $_SESSION['myValue'];
	$type = $_SESSION['myType'];


    $xy=str_replace(":","",$fo2);
    $xy1=str_replace("http","",$xy);
    $xy2=str_replace("/","",$xy1);
    $xy3=str_replace("*","",$xy2);

    $xy4=str_replace("?","",$xy3);

    $xy5=str_replace(">","",$xy4);
    $xy6=str_replace("<","",$xy5);
    $xy7=str_replace("|","",$xy6);
    $xy8=str_replace("https","",$xy7);



    //$npath="./img/".$fol;
     //mkdir($npath,0777,false);
/*
    session_start();
    $xyz = $_SESSION['myValue'];
    $npath="./img/".$xyz;
    mkdir($npath,0777,false);
*/

    $pathinfo=pathinfo($val);
   $filename =$pathinfo['filename'];
   $filext = $pathinfo['extension'];

if($filext=='jpg' || $filext=='gif' || $filext=='JPG' || $filext=='png' || $filext=='php')
{

    $finalurl = "./multimedia/$xy8/image/".$filename.".".$filext;
   mkdir("./multimedia/$xy8/",0777,false);
    mkdir("./multimedia/$xy8/image/",0777,false);

}
/*
elseif($filext=='mp3' || $filext=='avi' || $filext=='wav')
{
    $finalurl = "./multimedia/$xy8/audio".$filename.".".$filext;
    mkdir("./multimedia/$xy8/",0777,false);
    mkdir("./multimedia/$xy8/audio/",0777,false);
   
}
*/
else
{
   
	if($type == 'audio')
	{
	$finalurl = "./multimedia/$xy8/audio/";
    mkdir("./multimedia/$xy8/",0777,false);
    mkdir("./multimedia/$xy8/audio/",0777,false);
	}
	elseif($type == 'video')
	{
	$finalurl = "./multimedia/$xy8/video/";
	 mkdir("./multimedia/$xy8/",0777,false);
    mkdir("./multimedia/$xy8/video/",0777,false);
	}
	elseif($type == 'img')
	{
	//$finalurl = "./multimedia/$xy8/image/";
	 mkdir("./multimedia/$xy8/",0777,false);
    mkdir("./multimedia/$xy8/image/",0777,false);
	}
	$filext='-';
}
 //  $de =file_get_contents($val,false,$cxContext);

  file_put_contents($finalurl, file_get_contents($val,false,$cxContext));
//file_put_contents($finalurl, file_get_contents($val));

}

elseif(isset($text))
{
    session_start();
    $fol2 = $_SESSION['myValue'];

  $xyz=str_replace(":","",$fol2);

    $xyz1=str_replace("http","",$xyz);

    $xyz2=str_replace("/","",$xyz1);

    $xyz3=str_replace("*","",$xyz2);

    $xyz4=str_replace("?","",$xyz3);

    $xyz5=str_replace(">","",$xyz4);
    $xyz6=str_replace("<","",$xyz5);
    $xyz7=str_replace("|","",$xyz6);
    $xyz8=str_replace("https","",$xyz7);

    //echo "this is it".$fol2."fyy";

    //session_start();
    //$fol2 = $_SESSION['myValue'];

    /*
    $parse = parse_url($text);
    $fol2 = $parse['host'];
*/

//    mkdir($fol2,0777,false);


    //session_start();
  //  $dirurl="./text/".$final;

    //mkdir($dirurl,0777,False);

    //$counter = 0;





   $finalurl = "./multimedia/$xyz8/text/testFile.txt";
    mkdir("./multimedia/$xyz8/",0777,false);
    mkdir("./multimedia/$xyz8/text/",0777,false);
    $filext='txt';




    //static $var = 1;
      //$_SESSION["x"] =$var;
        $fh = fopen($finalurl, 'a+') or die("can't open file");

    //$var+=1;

        $stringData = $text."\r\n\r\n";
        fwrite($fh, $stringData);

        fclose($fh);
//$counter++;

/*
    $status = session_status();
    if($status == PHP_SESSION_NONE){
        //There is no active session
        session_start();
    }else
        if($status == PHP_SESSION_DISABLED){
            //Sessions are not available
        }else
            if($status == PHP_SESSION_ACTIVE){
                //Destroy current and start new one
                session_destroy();
                //session_start();
            }
*/

}

date_default_timezone_set('Asia/Kolkata');
$year=date("Y");

$month=date("m");

$day=date("d");

$hrs=date("H");

$min=date("i");

$sec=date("s");

$final =$year.".".$month.".".$day.".".$hrs.".".$min.".".$sec;


session_start();
$_SESSION['delete']=$finalurl;


$size = filesize($finalurl); 
$imgstr = base64_encode(fread(fopen($finalurl, "r"), filesize($finalurl)));
$con=mysql_connect("localhost","root","");
mysql_select_db("test1");
if(isset($text))
{
$sql="Insert into data values('','".$finalurl."','".$xyz8."','text','".$final."','".$size."','".$imgstr."')";
}
elseif(isset($val))
{
$sql="Insert into data values('','".$finalurl."','".$xy8."','".$type."','".$final."','".$size."','".$imgstr."')";
}

mysql_query($sql,$con);

session_start();
$_SESSION['delete']=$finalurl;


?>
</body>
</html>
