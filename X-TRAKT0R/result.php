	<html>
	<head>
	<link rel="Stylesheet" type="text/css"
	href="style.css">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<script type="text/javascript" src="../jquery-1.9.1.min.js"></script>
	<script type="text/javascript">

	
	$(document).ready(function(){
	   $('title').attr('class','ptag');
        $('h1').attr('class','ptag');
        $('p').attr('class','ptag');
		$('table').attr('class','ptag');
		//$('tbody').attr('class','ptag');
		//$('tr').attr('class','ptag');
		//$('th').attr('class','ptag');
		$('.gautam').bind('click',function(e){
			e.preventDefault();
            var clk = $(this);
		   var gtm = $(this).prev('#hidenval').val();
           //var gtm =$(this).find('.ptag').text();
         {
		 alert("Done!");

}
		   var datastring  ='url='+gtm;
		   $.ajax({
                  type: "POST",
                   url: "../download.php",
                    data: datastring,
                      cache: false,
             //    success: function(html){
				 
               //          alert("Saved Successfully");

                //}
				
				});

				});
        $('.gautamtext').bind('click',function(e){
            e.preventDefault();
        //    var gtm = $(this).prev('.ptag').text();
            var gtext = $('#savetext').children().append('\n').text();
            //alert(gtext);
         //var r = confirm(gtm);
           //  if(r)
             //
                var datastring  ='text='+gtext+'';
                $.ajax({
                    type: "POST",
                    url: "../download.php",
                    data: datastring,
                    cache: false,
                    dataType:'text',
                    success: function(html){
                         alert("Saved Successfully!");

                    }

                });
             // }

//            else
  //            {
    //              alert("Content not Saved");
      //        }


        });

    })
	</script>
	</head>
<body id="savetext">


	
	<?php

	include('/simple_html_dom.php');

       $aContext = array(
    'http' => array(
        'proxy' => 'tcp://10.0.1.2:8090',
        'request_fulluri' => true,
    ),
);
  $cxContext = stream_context_create($aContext);

 // You can set the value however you like.

	$link_url = $_POST['link_url'];
	$link_type = $_POST['link_type'];

$html = file_get_html($link_url,FALSE,$cxContext);
   // $html = file_get_html($link_url);
	//phpinfo();

session_start();
$_SESSION['myValue']=$link_url;
$_SESSION['myType']=$link_type;


/*********************************************************************************************************************************/

if($link_type == "img")
{
    $imcount =0;

    echo '<br><fieldset class="title"><h1>Images</h1></fieldset><br>';
	echo '<p align="center">Please note:There may be chances of some images not getting extracted or saved due to some security constraints or error. In such case please right click and save image into the folder in the path given below:</p>';

	$abc=str_replace(":","",$link_url);

        $abc1=str_replace("http","",$abc);

        $abc2=str_replace("/","",$abc1);

        $abc3=str_replace("*","",$abc2);

        $abc4=str_replace("?","",$abc3);

        $abc5=str_replace(">","",$abc4);
        $abc6=str_replace("<","",$abc5);
        $abc7=str_replace("|","",$abc6);
        $abc8=str_replace("https","",$abc7);
	echo '<p align=center>multimedia/'.$abc8.'/image</p>';
	echo '<br>';
	echo '<p align=center>Click the button below to create the path folders anyway.</p>';
echo '<p align=center>PLEASE NOTE: Broken image symbols are a bug. Please see Read Me.</p>';	
	echo '<hr>';
	echo '<center><button><a href="#" class="gautam"><h3>Create folder</h3></a></button></center>';
echo '<hr>'.'<br>';	


    
        foreach($html->find($link_type) as $e)
        {
	
	 
	 if (strpos($e->src, $link_url) == false )
{

/*
if(filter_var($e->src, FILTER_VALIDATE_URL) === FALSE)
{
        echo "&nbsp;&nbsp;&nbsp;&nbsp;<img src=\"$link_url/$e->src\" title=\"$link_url$e->src\" alt=\"Forbidden!\" />";
}else{
        echo "&nbsp;&nbsp;&nbsp;&nbsp;<img src=\"$e->src\" title=\"$e->src\" alt=\"Forbidden!\" />";
}
*/

{

 echo "&nbsp;&nbsp;&nbsp;&nbsp;<img src=\"$e->src\" title=\"$e->src\" alt=\"Forbidden!\" />";
	
echo "&nbsp;&nbsp;&nbsp;&nbsp;<img src=\"$link_url/$e->src\" title=\"$link_url$e->src\" alt=\"Forbidden!\" />";

 $imcount++;

}
echo "&nbsp;&nbsp;".'<input type="hidden" value="'.$e->src.'" id="hidenval"/><a href="#" class="gautam"><h3 style="display:inline">&nbsp;&nbsp;&nbsp;&nbsp;Save<br><br></h3></a>';
echo '<br><br><br>';
} 
 
	
	
	
        elseif (strpos($e->src, $link_url) !== false)
		 {
	  
            echo "&nbsp;&nbsp;&nbsp;&nbsp;<img src=\"$e->src\" title=\"$e->src\" alt=\"Forbidden!\" />".'<br>'.'<input type="hidden" value="'.$e->src.'" id="hidenval"/><a href="#" class="gautam"><h3 style="display:inline">&nbsp;&nbsp;&nbsp;&nbsp;Save<br><br></h3></a>
	 ';

        echo "<br/>";
		$imcount++;
		}
		
	}	
	

       echo '<h2>'."&nbsp;&nbsp;TOTAL IMAGE(S) = ".$imcount.'<h2>'.'<div>';
   
	

  
     ?>
    <fieldset class="normal">
    <form action="../xml.php" method="POST" id="formX" name="formX">
    <p align="center">
    <input class="sub" type="submit" id="submit" name="submit" value="Create XML Config File"/>
    </p>
    </form>
    </fieldset>
	<?php
    }

/**********************************************************************************************************************************/

    elseif ($link_type=="video")
	{
		 echo '<br><fieldset class="title"><h1>HTML5 Videos</h1></fieldset><br>';
		  echo '<h3>'.'<center>'."Right-click & save link into the folder in the path given below:".'</center>'.'<br>';
        $ab=str_replace(":","",$link_url);

        $ab1=str_replace("http","",$ab);

        $ab2=str_replace("/","",$ab1);

        $ab3=str_replace("*","",$ab2);

        $ab4=str_replace("?","",$ab3);

        $ab5=str_replace(">","",$ab4);
        $ab6=str_replace("<","",$ab5);
        $ab7=str_replace("|","",$ab6);
        $ab8=str_replace("https","",$ab7);
        echo '<center>'."multimedia/".$ab8."/video/".'<br>'.'<br>'.'</center>'.'</h3>';	
		echo '<center>'.'<h3>'."Click the button below to create the path folders anyway.".'</h3>'.'</center>';
		
	//$vcount=0;
echo '<hr>';
	echo '<center><button class="sub2"><a href="#" class="gautam"><h3>Create folder</h3></a></button></center>';
echo '<hr>';
	{

        foreach($html->find("source") as $e)

	    echo "&nbsp;&nbsp;&nbsp;&nbsp;<video style=\"margin:10p\" src=\"$e->src\" title=\"$e->src\" alt=\"Forbidden!\"controls=\"true\" /></video>".'<br>';
		
//$vcount++;
	}
	 // echo '<h2>'."&nbsp;&nbsp;TOTAL VIDEO(S) = ".$vcount.'<h2>';
	

 
        ?>
    <fieldset class="normal">
    <form action="../xmlav.php" method="POST" id="formX" name="formX">
    <p align="center">
    <input class="sub" type="submit" id="submit" name="submit" value="Create XML Config File"/>
    </p>
    </form>
    </fieldset>
    <?php
    }

	/******************************************************************************************************************************/
	
	elseif ($link_type=="audio")
	{
		 echo '<br><fieldset class="title"><h1>Audio</h1></fieldset><br>';
        echo '<h3>'.'<center>'."Right-click & save link into the folder in the path given below:".'</center>'.'<br>';
		
        $a=str_replace(":","",$link_url);

        $a1=str_replace("http","",$a);

        $a2=str_replace("/","",$a1);

        $a3=str_replace("*","",$a2);

        $a4=str_replace("?","",$a3);

        $a5=str_replace(">","",$a4);
        $a6=str_replace("<","",$a5);
        $a7=str_replace("|","",$a6);
        $a8=str_replace("https","",$a7);
        echo '<center>'."multimedia/".$a8."/audio/".'<br>'.'<br>'.'</center>'.'</h3>';
echo '<center>'.'<h3>'."Click the button below to create the path folders anyway.".'</h3>'.'</center>';
    $acount=0;	
	//$acountp= $acount+1;
echo '<hr>';
echo '<center><button><input type="hidden" id="hidenval"/><a href="#" class="gautam"><h3>Create folder</h3></a></button></center>';
echo '<hr>';
/*******************************************************************/
{
	$link = "a";
	$ext=array(".mp3",".wav",".avi",".ogg");
	$n=count($ext);
	foreach($html->find($link) as $e)
	{
	$mp3_link = $e->href;
	for($x=0;$x<$n;$x++)
	{
	$pos = strpos($mp3_link, $ext[$x]);
	
	if($pos == true)
	{
	$acountp= $acount+1;
	echo "&nbsp;&nbsp;$acountp.&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"$e->href\" title=\"$e->href\" controls=\"true\"target=\"_blank\" />".$e->href."</a>".'<br>';
        echo "<br><br>";
        //'<input type="hidden" value="'.$e->href.'" id="hidenval"/><a href="#" class="gautammp3"><h3 style="display:inline">..<br><br></h3></a>'.'<br/>'.'<br/>';

		$acount++;
		}
}
}
}

/*****************************************************************/

        echo '<h2>'."&nbsp;&nbsp;TOTAL AUDIO(S) = ".$acount.'<h2>';

        ?>
    <fieldset class="normal">
        <form action="../xmlav.php" method="POST" id="formX" name="formX">
            <p align="center">
                <input class="sub" type="submit" id="submit" name="submit" value="Create XML Config File"/>
            </p>
        </form>
    </fieldset>

        <?php
	}

/*******************************************************************************************************************************/

	 elseif($link_type=="text")
	{
	 echo '<br><fieldset class="title"><h1>Text</h1></fieldset><br>';
		{

           //session_start();
            //$_SESSION['myValue']=$link_url;

echo '<a href="#" class="gautamtext"><center><button><a href="#" class="gautamtext"><h2 style="display:inline">Save all text</h2></a></button></center>';
echo '<hr><hr>';

	foreach($html->find('title') as $element)
	echo $element.'<br>';

	foreach($html->find('h1') as $element)
	echo $element .'<br>';

	foreach($html->find('p') as $element)
	echo '<p style="margin-left:60px;">'.$element.'</p><br>';
	echo "<br/>";
echo "<br><br><br>";


	echo "<h1>Table(s)</h1>";
	echo "<center><h2>There may be data tables on a webpage. Save tables manually if required. If there are no tables ignore this.</h2></center><br><br>";
foreach($html->find('table') as $element)
	echo $element .'<br>';
	echo "<br/>";
	
/*
foreach($html->find('tbody') as $element)
	echo $element .'<br>';
	echo "<br/>";

foreach($html->find('tr') as $element)
	echo $element .'<br>';
	echo "<br/>";

foreach($html->find('th') as $element)
	echo $element .'<br>';
	echo "<br/>";
*/
?>
</p>
<?php
	}
        ?>
		
        <fieldset class="normal">
    <form action="../xml2.php" method="POST" id="formX" name="formX">
<p align="center">
        <input class="sub" type="submit" id="submit" name="submit" value="Create XML Config File"/>
   </p>
    </form>
    </fieldset>

            <?php
	}
	

    

	?>

	</body>
	</html>