<html>
    
<head>
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
</head>
    
<body>

    <?php 
    echo "<h1>" . ucwords(strtolower(basename($_SERVER['PHP_SELF'], ".php"))) . "</h1>"; // title of page
    // title is dynamic from the folder name. Camel-case is applied
    
    $dir = str_replace('html', 'docs', getcwd()); 
    $parDir = (substr_count($dir, '\\')) - 2; // variable to find out how to get back to baseIndex.php 
    $basePath = str_repeat('../', $parDir) . 'baseIndex.php'; 
    $baseSheet = str_repeat('../', $parDir) . 'baseStylesheet.css';
    
    echo "<div class='buttons'>";
    echo "<div class='button-container'>";
        echo "<a class='button' href='http://clarke-server/index.php'>Home</a>"; // home button

        // dynamic back button
        $tmp = explode('\\', dirname(__DIR__));
        $backPage = '\\' . end($tmp) . '.php';
        $backButton = str_replace('C:\wamp64\www', 'http://clarke-server', dirname(__DIR__)) . $backPage; // path generation
        echo "<a class='button' href='".$backButton."'>Back</a>"; // back button
    echo "</div>";
    echo "</div>"; // div.buttons
    
    echo "<br><br>";
    
    
 // the following php will read the contents of the directory and display it

$allFiles = scandir($dir);
$files = array_diff($allFiles, array('.', '..', '.git'));
    
    echo "<div class='file-container'>";
    echo "<div class='files-folders'>";
        
$num = 2;   
while (($num) <= (count($files)+1)){
    $filename = $files[$num];
    $path = str_replace('C:\wamp64\www', 'http://clarke-server', $dir . '/' . $filename); //

    if (strpos($filename, ".")) { // If its a file do the following
        
        // echo "Dir: " . $dir . "<br>"; // Show $dir 
        // echo "Path: " . $path . "<br>"; // show $path
        echo "<a class='file' href='".$path."'><div class='file'></div>". ucwords($filename)."<a/>"; // Make a link to the file
       
        echo date ("F d Y H:i:s.", filemtime($path));
    
        
    } else { // else (if its a folder) do the follwoing
        if (!file_exists("./" . $filename)){ // create folder in www/html/ if it doens't exists
            mkdir("./" . $filename, 0700);
        }
        
        $fileCreate = "./".$filename. "/" . $filename . ".php"; // create base file 
        $fileHandle = fopen($fileCreate, 'w') or die("can't open file");
        $baseFile = file_get_contents($basePath); // file to be created in the directory
        fwrite($fileHandle, $baseFile);
        
        echo "<a class='folder' href='./".$filename."/".$filename.".php'><div class='folder'></div>".ucwords($filename)."<a/>"; // make a link to another page (camelcase)
        
    } // end else
    $num++;
}  // end while  
    echo "</div>"; // end of div.files-folders
    echo "</div>"; // end of div.files-container
    echo "<link rel='stylesheet' type='text/css' href=" . $baseSheet . ">"; // dynamic link to baseStylesheet.css
?>
       
</body>

</html>