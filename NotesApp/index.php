<!DOCTYPE html>
<title>Create Notes</title>
<html>
  <link href="css.css" rel="stylesheet" type="text/css">
  <?php
include_once('header.php');

$read = "";
$Title = "";
$dir = "Note";
$path = "Note/";
$selected = "";
date_default_timezone_set('Europe/London');
$files = scandir($dir,1);
$filecount = count($files);
$aTime = [];
$fLines = [];
$Titles = [];
$Date = "";
$fLine = "";
for($i=0;$i<$filecount-2;$i++)
{
  $Titles[$i] = str_replace(".txt","",$files[$i]);
  $aTime[$i] = date("F d Y H:i:s",filemtime($path.$files[$i]));
  $currFile = fopen($path.$files[$i],"r")or die ("Unable to open file");
  $y = fgets($currFile);
  $fLines[$i] = fgets($currFile);
  fclose($currFile);
}
if(!empty($_POST["F2O"]))
{
    $selected = $_POST["F2O"];
    $file = $path.$_POST["F2O"];
    $myFile = fopen($file,"r")or die("Unable to open file");
    $fLine = fgets($myFile);
    $read= fread($myFile,filesize($file));
    $Title = str_replace(".txt","",$_POST["F2O"]);
    $Date = date("F d Y H:i:s",filemtime($file));
    fclose($myFile);

   // echo $read;
}

?>

<head>
<title>Notes</title>
</head>
<body>
 <div class="row">
    <div class="column left" id="noteFile">
    
     
       
      </div>
  

  <div class="column right">
    
    <form action="Controller.php" method="post" id="SaveNote">
      <h5 class="card-title">Title<h5><input type="text" name="Title" id="Title"placeholder="Title" required value="<?php echo $Title?>">
      <h6>Date Created <?php echo $fLine ?></h5>
      <h6>Date modified <?php echo $Date ?></h5>
      <h5 class="card-title">Enter your text here</h5>
      <textarea id="Note" name="Note" style="max-width: 100%; width:1200px; height: 500px; resize: none;white-space: pre-wrap;" form="SaveNote" placeholder="Write here"><?php echo $read ?></textarea>
      <br>
      <br>
      <input type="text" hidden value="<?php echo $fLine ?>" name="Dcreate" id="Dcreate">
      <input type="submit" class="btn btn-primary" value="Save Note">
    </form>
    </div>
 </div>
 


</body>

<script type="text/javascript">
let time = new Array(<?php echo $filecount?>);
var selected = "<?php echo $selected ?>";

var w = <?php echo json_encode($Titles);?>;
var x = <?php echo json_encode($files);?>;
var y = <?php echo json_encode($aTime);?>;
var z = <?php echo json_encode($fLines);?>;
for(var i=0;i<<?php echo $filecount?>-2;i++)
{
  var leftcol = document.getElementById("noteFile").innerHTML +='<div class="card" id='+x[i]+'><div class="card-body"><h5 class="card-title">'+w[i]+'</h5><h6>Date Modified: '+y[i]+'</h6><h6>'+z[i].substring(0,56)+'</h6><br><br><form action="Cnote.php" method="post" id="Open"><input type="text" hidden value="'+x[i]+'" id="F2O" name="F2O"><input type="submit" class="btn btn-primary" value="Open Note"></div></div>'; 
}
if(selected!="")
{
  document.getElementById(selected).style.backgroundColor="grey";
}

  
  </script>