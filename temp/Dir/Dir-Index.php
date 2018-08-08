<html>
    
<head>
  <link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
    
<body>
    
    
<?php

$dir    = './';
$allFiles = scandir($dir);
$files = array_diff($allFiles, array('.', '..'));
//$files2 = scandir($dir, 1);

//print_r($files);

$num = 2;   
while (($num) <= (count($files)+1)){
    $filename = $files[$num];
    $path = $dir . '/' . $filename;
    
    if (strpos($filename, ".")) { // If its a file
        
        //echo $path;
    
        echo "<a href='".$path."'>".$filename."<a/>";
    
        echo "<br>";
        
    } else { // else if its a folder
        
        echo "<a href='/".$filename."'>".$filename."<a/>";
    
        echo "<br>";
    }
    
    $num++;
}    
    

?>
    
    
</body>

</html>