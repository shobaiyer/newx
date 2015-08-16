<html>
<head>
    <link rel="Stylesheet" type="text/css"
          href="X-TRAKT0R/style.css">
</head>
<body>

<h2/>
    <?php

$invertSlash = true;

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

$directoryList = array("./multimedia/$xyz8/text/");

$xmlFileName = 'text.xml';

// name of the root tag
$rootTagName = 'text';

// name of the file tag
$childTagName  = 'txt';

$childTagList = array('name'         => '{pathname}',
    'caption'     => '{input}',
    'filesize'     => '{callback:filesize}',
    'creationdate' =>'{callback:creationDate}'
);

// detect if it's being run through cli
    $cliMode = (php_sapi_name() == 'cli');

// if cliMode catch the directories from the cmd line
    if($cliMode && $argc > 1){

        array_shift($argv);

        foreach ($argv as $dir){
            array_push($directoryList, $dir);
        }
    }

// for HTML display purposes
    if(!$cliMode) echo "<pre>\n";



// loop through the directories list
foreach ($directoryList as $directory) {
?> 
&nbsp;&nbsp;&nbsp;<img src="icon.png" align="middle">
<hr>
<?php
    // informative display
    echo "<br>";
    echo "&nbsp;&nbsp;Creating XML file for '$directory'...\n";

    // start XML formation
    $xml  = '<?xml version="1.0" ?>'."\n";

    $xml .= "<$rootTagName>\n";

    try {
        // create a new DirectoryIterator for the current directory
        $dir = new DirectoryIterator($directory);
    } catch (Exception $e){
        echo "&nbsp;&nbsp;Couldn't open the directory '$directory'.\n";
        continue;
    }

    // flag to be used as the file id
    $fileId = 1;

    // loop through the entries of the directory
    foreach($dir as $file){

        // if it's a file
        if($file->isFile()){

            // open child tag
            $xml .= "  <$childTagName>\n";

            // loop through each tag in the list

            foreach ($childTagList as $tagName => $tagValue) {

                // format the info variables according to $invertSlash boolean
                $filename  = $invertSlash ? str_replace('\\', '/', $file->getFilename()) : $file->getFilename();
                $directory = $invertSlash ? str_replace('\\', '/', $directory) : $directory;
                $pathname  = $invertSlash ? str_replace('\\', '/', $file->getPathname()): $file->getPathname();
                //	$extension = $invertslash ? str_replace('\\', '/', $file->getExtension()): $file->getExtension();

                // check for {input} placeholder
                if(strpos($tagValue, '{input}') !== false){

                    // if cliMode ask for input otherwise leave blank
                    if($cliMode){
                        echo "Enter the '$tagName' of '$filename': ";
                        $line = trim(fgets(STDIN));
                        $tagValue = str_replace('{input}', $line, $tagValue);
                    } else {
                        $tagValue = '';
                    }

                }
                // check for {callback} placeholder
                else if (strpos($tagValue, '{callback') !== false){

                    // get the function name
                    if(preg_match('/{callback:(\w+)}/', $tagValue, $match)){
                        $callback = $match[1];

                        try{
                            // call the function
                            $tagValue = $callback($pathname);
                        } catch (Exception $e){
                            echo "Couldn't call '$callback' function!\n";
                        }
                    }

                }
                // try other placeholders
                else {
                    $tagValue = str_replace('{filename}', $filename, $tagValue);
                    $tagValue = str_replace('{dirname}', $directory, $tagValue);
                    $tagValue = str_replace('{pathname}', $pathname, $tagValue);
                    $tagValue = str_replace('{id}', $fileId, $tagValue);
                }

                // create the tag pair
                $xml .= "    <$tagName>$tagValue</$tagName>\n";
            }

            // closes child tag
            $xml .= "  </$childTagName>\n";

            // increments the file id number
            $fileId++;
        }
    }

    // closes the root tag
    $xml .= "</$rootTagName>\n";

    try {
        // creates the XML file
        $fp = fopen($directory.'/'.$xmlFileName,'w');
        fwrite($fp, $xml);
        fclose($fp);

        echo "&nbsp;&nbsp;XML file created!\n";
    } catch (Exception $e){
        echo "&nbsp;&nbsp;Error creating the XML file.\n";
    }
}

// informative display
echo "&nbsp;&nbsp;Done!\n";
if(!$cliMode) echo '</pre>';

function discoverOrientation($path){

    try {

        $info = getimagesize($path);
    }
    catch (Exception $e)
    {
        return 'unknown';
    }

    // compare height and width values
}


function creationDate($path){

    try{

        date_default_timezone_set('Asia/Kolkata');
        $date= date("F d Y H:i:s.", fileatime($path));
        return $date;
    } catch(Exception $e){
        return 'unknown';}
}
?>

<div style="position: absolute; top:5px; right: 0; width: 100px;"><A HREF="./X-TRAKT0R/Demo.php"><B>&nbsp;&nbsp;Home</B></A></div>

</body>
</html>