<html>
    
<head>
  <link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
    
<body>

    <?php 
    echo "<h1>" . ucwords(strtolower(basename($_SERVER['PHP_SELF'], ".php"))) . "</h1>"; // title of page
    // title is dynamic from the folder name. Camel-case is applied
    
    $dir = str_replace('html', 'docs', getcwd()); 
    $parDir = (substr_count($dir, '\\')) - 2; // variable to find out how to get back to baseIndex.php 
    $basePath = str_repeat('../', $parDir) . 'baseIndex.php';  
    
    echo "<a href='http://lclarkeserver.ddns.net/index.php'>Home</a><br><br>"; // home button

    // dynamic back button
    $tmp = explode('\\', dirname(__DIR__));
    $backPage = '\\' . end($tmp) . '.php';
    $backButton = str_replace('C:\wamp64\www', 'http://lclarkeserver.ddns.net', dirname(__DIR__)) . $backPage; // path generation
    echo "<a href='".$backButton."'>Back</a>"; // back button
    echo "<br>";
    
    
 // the following php will read the contents of the directory and display it

$allFiles = scandir($dir);
$files = array_diff($allFiles, array('.', '..', '.git'));
//$files2 = scandir($dir, 1);

//print_r($files);

$num = 2;   
while (($num) <= (count($files)+1)){
    $filename = $files[$num];
    $path = str_replace('C:\wamp64\www', 'http://lclarkeserver.ddns.net', $dir . '/' . $filename); //

    if (strpos($filename, ".")) { // If its a file
        
        // echo "Dir: " . $dir . "<br>"; // Show $dir 
        // echo "Path: " . $path . "<br>"; // show $path
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
     <h2>This was copied from baseIndex</h2>
       
</body>

</html>