<html>
    
<head>
  <link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
    
<body>
 
        <?php echo "<h1>" . basename($_SERVER['PHP_SELF'], ".php") . "</h1>";
        $dir = str_replace('html', 'docs', getcwd()); 
    
        //echo $dir;
    
        $basePath = 'http://clarke-server/baseindex.php'; // path to baseIndex.html (golded page);
    echo "<p>basePath = " . $basePath;
    echo "<br>";
    
    echo "<a href='http://clarke-server/index.php'>Home</ya><br><br>";
    
 // the following php will read the contents of the directory and display it
    
 //   echo $dir;

$allFiles = scandir($dir);
$files = array_diff($allFiles, array('.', '..'));
//$files2 = scandir($dir, 1);

//print_r($files);

$num = 2;   
while (($num) <= (count($files)+1)){
    $filename = $files[$num];
    $path = $dir . '/' . $filename; //
    
    if (strpos($filename, ".")) { // If its a file
        
        //echo $path;
    
        echo "<a href='".$path."'>".$filename."<a/>"; // Make a link to the file
    
        echo "<br>";
        
    } else { // else if its a folder
        if (!file_exists("./" . $filename)){ // create html folder if it doens't exists
            mkdir("./" . $filename, 0700);
        }
        
        $fileCreate = "./".$filename. "/" . $filename . ".php"; // create base file 
        $fileHandle = fopen($fileCreate, 'w') or die("can't open file");
        $baseFile = file_get_contents($basePath); // file to be created in the directory
        fwrite($fileHandle, $baseFile);
        
        echo "<a href='./".$filename."/".$filename.".php'>".$filename."<a/>"; // make a link to another page
    
        echo "<br>";
    } // else
    $num++;
}  // while  
    

?>
       
</body>

</html>