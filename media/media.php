<html>
    
<head>
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
</head>
    
<body>

    <?php 
    // connect to database. Will have to move to external file?
    $hn = 'http://localhost';
    $db = 'giles_docs';
    $un = 'giles';
    $pw = '!$iGnIN!';
    $conn = mysqli_connect($hn, $un, $pw, $db);
    
    echo "<h1>" . ucwords(strtolower(basename($_SERVER['PHP_SELF'], ".php"))) . "</h1>"; // title of page
    // title is dynamic from the folder name. Camel-case is applied
    
    $dir = str_replace('html', 'docs', getcwd()); 
    $templateDir = substr(getcwd(), 0, 14) . "templates";
    $currentWorkingDir = substr(getcwd(), 19, 90);
    
    if (!file_exists($templateDir . "\\" . $currentWorkingDir)){ // create folder in www/html/ if it doens't exists
            mkdir($templateDir . "\\" . $currentWorkingDir, 0700);
        }
    
    $parDir = (substr_count($dir, '\\')) - 2; // variable to find out how to get back to baseIndex.php 
    $basePath = str_repeat('../', $parDir) . 'baseIndex.php'; 
    $baseSheet = str_repeat('../', $parDir) . 'baseStylesheet.css';
    $baseSearch = str_repeat('../', $parDir) . 'search.php';
    echo "<link rel='stylesheet' type='text/css' href=" . $baseSheet . ">"; // dynamic link to baseStylesheet.css
    $logoPath = str_repeat('../', $parDir) . '/media/';
    
    echo "<img class='giles-logo' src=".$logoPath."giles-white.png>"; // giles corner logo
    echo "<img class='premag-logo' src=".$logoPath."premag-white.png>"; // premag corner logo
    echo "<img class='redline' src=".$logoPath."line-red.png>"; // red line graphic
    echo "<img class='isLogo' src=".$logoPath."isLogo.png>"; // IS corner logo
    
    
    echo "<div class='buttons'>";
    echo "<div class='button-container'>";
        echo "<a class='button' href='http://localhost/index.php'>Home</a>"; // home button

        // dynamic back button
        $tmp = explode('\\', dirname(__DIR__));
        $backPage = '\\' . end($tmp) . '.php';
    
    // if backPage would send you to html/html.php, instead send to the home page
    if ($backPage == '\html.php'){
        
        $backButton = 'http://localhost/index.php'; // path generation
        echo "<a class='button' href='".$backButton."'>Back</a>"; // back button
        
    } else {
        
        $backButton = str_replace('C:\wamp64\www', 'http://localhost', dirname(__DIR__)) . $backPage; // path generation
        echo "<a class='button' href='".$backButton."'>Back</a>"; // back button
    } // else
    
    // search form
    echo "<form  method='post' action='" . $baseSearch . "'  id='searchform'> 
               <input  class='searchBar' type='text' name='name'> 
               <input  class='searchButton' type='submit' name='submit' value='Search'> 
          </form>";
    
    
    echo "</div>";
    echo "</div>"; // div.buttons
    echo "<br>";
    
if(!function_exists('sort_dir_files')) { // will get function already exists error without this
    function sortDirFiles($dir) { // $file is array of all files in the dir
        $sortedData = array();
        $files = array();
        $folders = array();
        foreach(scandir($dir) as $file) {
                if(is_file($dir.'/'.$file))
                        array_push($files, $file);
                else
                        array_unshift($folders, $file);
        }
        return $files;
    }
}
    
if(!function_exists('sort_dir_files')) { // will get function already exists error without this
    function sortDirFolders($dir) { // $folders is an array of all folders in the dir
        $sortedData = array();
        $files = array();
        $folders = array();
        foreach(scandir($dir) as $file) {
                if(is_file($dir.'/'.$file))
                        array_push($files, $file);
                else
                        array_push($folders, $file);
        }
        return $folders;
    }
}    
    $dirFiles = sortDirFiles($dir); // array of files in the dir
    
    $dirFolders = sortDirFolders($dir); // array of folders in the dir 
    unset($dirFolders[0]); // remove the '.' system dir
    unset($dirFolders[1]); // remove the '..' system dir
    $dirFolders = array_values($dirFolders);  // reindex the array

    echo "<div class='file-container'>";
    echo "<div class='files-folders'>";
    
    echo "<div class='folders'>";
    
$num = 0;   // displaying folders in alphabetical order
while (($num) <= (count($dirFolders)-1)){ // else (if its a folder) do the follwoing
        $filename = $dirFolders[$num];
        if (!file_exists("./" . $filename)){ // create folder in www/html/ if it doens't exists
            mkdir("./" . $filename, 0700);
        }
        
        $fileCreate = "./".$filename. "/" . $filename . ".php"; // create base file 
        $fileHandle = fopen($fileCreate, 'w') or die("can't open file");
        $baseFile = file_get_contents($basePath); // file to be created in the directory
        fwrite($fileHandle, $baseFile);
        
        echo "<a class='folder' href='./".$filename."/".$filename.".php'><div class='folder'></div>".ucwords($filename)."<a/>"; // make a link to another page (camelcase)
      $num++;  
    } // end folders while
    
    echo "</div>"; // end div.folders div
    
    echo "<div class='files'>";
        
    $flag = false;
    if (count($dirFiles) == 0) { // if there are no files, don't display the table
            echo "<h1>There are no files in this directory</h1>";
            $flag = true;
    };
    
    if (!$flag) {
    echo "<table>
      <tr class='fixedHeader'>
        <th>Document #</th>
        <th>Revision</th>
        <th>Description</th>
        <th>Effective</th>
      </tr>";
    
$num = 0; // displaying files in alphabetical order 
        
while (($num) <= (count($dirFiles)-1)){
    $filename = $dirFiles[$num];
    $fileData = explode('^', $filename); // get the data based on the % delimiter in the filename
    $path = str_replace('C:\wamp64\www', 'http://localhost', $dir . '/' . $filename); // generate the path to the file
    
    if (isset($fileData[1]) == false) {
        echo "<h1>Some files here seem to be mis-formatted. Please follow the guide</h1>";
        break;
    } else {
    
    $fileDate = $fileData[3];
    $fileDate = substr($fileDate, 0, 10); // return the date without the file exention on the end. Date MUST be XX-XX-XXXX format
    
    echo "<tr class='files'>";
    echo    "<td class='docNum'><a class='file' href='".$path."' rel='noopener noreferrer' target='_blank''><div class='file'></div>" . $fileData[0] . "</a></td>";
    echo    "<td class='revNum'>" . $fileData[1] . "</td>";
    echo    "<td class='description'>" . $fileData[2] . "</td>";
    echo    "<td class='effDate'>" . $fileDate . "</td>
           </tr>";
    
    // build SQL statement to add data into the database
    $sql = "INSERT INTO docs (document_number, revision, description, effective_date, path) VALUES ('". $fileData[0] ."', '". $fileData[1] ."', '". $fileData[2] ."', '". $fileDate ."', '" . $path . "')";
    $conn->query($sql);
        
    $num++;
        
    } // files while end
} // end of if flag
} // else
    echo "</div>"; // end div.files
    echo "</div>"; // end of div.files-folders
    echo "</div>"; // end of div.files-container
    
?>
  
    
    
</body>

</html>