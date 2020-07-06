<?php
$path = "Note/";
$type = ".txt";
date_default_timezone_set('Europe/London');
if(!empty($_POST['Title'])){

    if($_POST['Dcreate']=="")
    {
        //echo "gdfdsfdssd";
        $Date = date("F d Y H:i:s \r\n");
        $x = $Date.$_POST["Note"];
        $filename = $path.$_POST["Title"].$type;
        $fp = fopen($filename,"wb");
        fwrite($fp,$x);
        fclose($fp);
        header("Location: index.php");
    }
    elseif($_POST["Dcreate"]!="")
    {
        $Date = $_POST["Dcreate"].=" \r\n";
        $x = $Date.$_POST["Note"];
        $filename = $path.$_POST["Title"].$type;
        $fp = fopen($filename,"wb");
        fwrite($fp,$x);
        fclose($fp);
        header("Location: index.php");
    }

//echo $x;

//echo $_POST["Note"];
//header("Location: Cnote.php");
}




if(!empty($_POST["F2O"]))
{
    $path = "Note/";
    $file = $path.$_POST["F2O"];
    $myFile = fopen($file,"r")or die("Unable to open file");
    $read= fread($myFile,filesize($file));
    echo $read;
}


?>