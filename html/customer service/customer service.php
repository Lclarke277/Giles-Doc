<html>
    
<head>
  <link rel="stylesheet" type="text/css" href="stylesheet.css">
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
    echo "<a href='../../index.php'>Back</a>"; // back button
    echo "<br><br>";
    
    
 // the following php will read the contents of the directory and display it

$allFiles = scandir($dir);
$files = array_diff($allFiles, array('.', '..'));
//$files2 = scandir($dir, 1);

echo "<div id='foldersFiles'>";
$num = 2;   
while (($num) <= (count($files)+1)){
    $filename = $files[$num];
    $path = str_replace('C:\wamp64\www', 'http://clarke-server', $dir . '/' . $filename); //

    if (strpos($filename, ".")) { // If its a file
        
        // echo "Dir: " . $dir . "<br>"; show $dir
        // echo "Path: " . $path . "<br>"; show $path
        echo "<a href='".$path."'>".$filename."<a/>"; // Make a link to the file
        
        //echo "<br><a href='http://clarke-server/docs/customer%20service/Signed%20NAFTA%202018.pdf'>testing</a>";
    
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
echo "</div>"; // foldersFiles Div    

?>
       
</body>

</html>