<html>
    
<head>
  <link rel="stylesheet" type="text/css" href="baseStylesheet.css">
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
</head>
    
<body>

    <?php 
    echo "<h1>" . ucwords(strtolower(basename($_SERVER['PHP_SELF'], ".php"))) . "</h1>"; // title of page
    // title is dynamic from the folder name. Camel-case is applied
    
    $dir = str_replace('html', 'docs', getcwd()); 
    $parDir = (substr_count($dir, '\\')) - 2; // variable to find out how to get back to baseIndex.php 
    $basePath = str_repeat('../', $parDir) . 'baseIndex.php';  
    
    echo "<a href='http://clarke-server/index.php'>Home</a><br>"; // home button

    // dynamic back button
    $tmp = explode('\\', dirname(__DIR__));
    $backPage = '\\' . end($tmp) . '.php';
    $backButton = str_replace('C:\wamp64\www', 'http://clarke-server', dirname(__DIR__)) . $backPage; // path generation
    echo "<a href='".$backButton."'>Back</a>"; // back button
    echo "<br><br>";
    
    
 // the following php will read the contents of the directory and display it

$allFiles = scandir($dir);
$files = array_diff($allFiles, array('.', '..', '.git'));

    echo "<div class=files>";

$num = 2;   
while (($num) <= (count($files)+1)){
    $filename = $files[$num];
    $path = str_replace('C:\wamp64\www', 'http://clarke-server', $dir . '/' . $filename); //

    if (strpos($filename, ".")) { // If its a file do the following
        
        // echo "Dir: " . $dir . "<br>"; // Show $dir 
        // echo "Path: " . $path . "<br>"; // show $path
        echo "<a href='".$path."'>".$filename."<a/>"; // Make a link to the file
    
        echo "<br>";
        
    } else { // else (if its a folder) do the follwoing
        if (!file_exists("./" . $filename)){ // create folder in www/html/ if it doens't exists
            mkdir("./" . $filename, 0700);
        }
        
        $fileCreate = "./".$filename. "/" . $filename . ".php"; // create base file 
        $fileHandle = fopen($fileCreate, 'w') or die("can't open file");
        $baseFile = file_get_contents($basePath); // file to be created in the directory
        fwrite($fileHandle, $baseFile);
        
        echo "<a href='./".$filename."/".$filename.".php'>".$filename."<a/>"; // make a link to another page
        
         echo "<p>WHAT: " . $fileCreate . "</p>";
    
        echo "<br>";
    } // end else
    $num++;
}  // end while  
    
    echo "</div>"; // end files div
    
?>
       
</body>

</html>