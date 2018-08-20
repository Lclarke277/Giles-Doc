<?php

    $hn = 'localhost';
    $db = 'giles_docs';
    $un = 'giles';
    $pw = '!$iGnIN!';
    $conn = mysqli_connect($hn, $un, $pw, $db); 

if(isset($_POST['submit'])) {
   $document_name= "%" . $_POST['name'] . "%"; 
       
$search_stmt = $conn->prepare("SELECT document_number, revision, description, effective_date, path FROM docs WHERE (document_number LIKE ?)");
$search_stmt->bind_param('s', $document_name);
$search_stmt->execute();
$search_stmt->store_result();

// bind results to these variables
$search_stmt->bind_result($search_document_name, $search_revision, $search_description, $search_effective_date, $search_path);   

    
while($search_stmt->fetch()) {
    //execute
    
    
}
    

} else {
    echo "<p>Please enter a document name in the search bar</p>";
}


?>


<html>
    
<head>
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
</head>
    
<body>

    <?php 
    
    echo "<h1>Search Results</h1>"; // title of page
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
        echo "<a class='button' href='http://clarke-server/index.php'>Home</a>"; // home button
    
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
    
    echo "<div class='files'>";
        
    $flag = false;
    if (count($dirFiles) == 0) { // if there are no files, don't display the table
            echo "<h1>There are no document numbers containing that info</h1>";
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
    
    echo "<tr class='files'>";
    echo    "<td class='docNum'><a class='file' href='".$search_path."' rel='noopener noreferrer' target='_blank''><div class='file'></div>" . $search_document_name . "</a></td>";
    echo    "<td class='revNum'>" . $search_revision . "</td>";
    echo    "<td class='description'>" . $search_description . "</td>";
    echo    "<td class='effDate'>" . $search_effective_date . "</td>
           </tr>";
        
    $num++;
        
} // end of if flag
    
    echo "</div>"; // end div.files
    echo "</div>"; // end of div.files-folders
    echo "</div>"; // end of div.files-container
    
?>
  
    
    
</body>

</html>