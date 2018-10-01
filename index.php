<html>
     
<head>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="stylesheet" type="text/css" href="stylesheet.css">
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
</head>
    
<body>
    
    
    <div>
        
        <img id='giles-logo' src="media/giles-white.png">
        <h1 id='title'>Document System <br>And Intranet Site</h1>
        <img class="redline" src="media/line-red.png">
        
    </div>
    
<?php 
    
    require_once('connection.php');
    
    $docPath = '.\docs'; // variable for location of document files
    $htmlPath = '.\html'; // variable for location of html files
    $headers = scandir($docPath); // get array of files in the docs dir
    unset($headers[0]); // remove first value of scandir '.'
    unset($headers[1]); // rmeove second value of scandir '..'
    // scandir picks up 2 'directories' a '.' and a '..'. These are dropped
    $headers = array_values($headers); // reinitialize the array; unset makes the values null. array_vaules removes null objects from the array
    
    echo "<div id=table>
          <table>
          <tr>";
    
    // the following creates a table header for each folder in the docs directory
    $num = 0;   
    while (($num) <= (count($headers))-1){
        echo "<th><a href='.\html\\" . $headers[$num] . "\\" . $headers[$num] . ".php'>" . $headers[$num] . "</a></th>";
        
        if (!file_exists(".\html\\" . $headers[$num])){ // create folder in www/html/ for the <th> if it doens't exists
            mkdir(".\html\\" . $headers[$num], 0700);
            
        $fileCreate = '.\html\\' . $headers[$num] . '\\' . $headers[$num] . '.php'; 
        $fileHandle = fopen($fileCreate, 'w') or die("can't open file");
        $baseFile = file_get_contents('.\\baseIndex.php'); 
        fwrite($fileHandle, $baseFile);   
        
        }
        $fileCreate = '.\html\\' . $headers[$num] . '\\' . $headers[$num] . '.php'; 
        $fileHandle = fopen($fileCreate, 'w') or die("can't open file");
        $baseFile = file_get_contents('.\\baseIndex.php'); 
        fwrite($fileHandle, $baseFile);
        
        $num++;
    }
    
    echo "</tr>";
    
    // Max Dir Alg: algorithim to find the max count of all the header subdirectories
    $num = 0;
    while ($num < count($num)) {
        $maxDir = count(scandir($docPath . '\\' . $headers[$num]));
        $nextDir = count(scandir($docPath . '\\' . $headers[$num + 1]));
        
        if (empty($nextDir)) {
            break; } 
        
        else {        
    if ($nextDir > $maxDir) {
            $maxDir = $nextDir;
            $num++; } 
    else {
        $num++;
    }
             } // 1st else
                               } // while
    $maxDir = $maxDir - 2; // end of Max Dir Alg 
    
$sqlDelete = "DELETE FROM docs WHERE path LIKE 'localhost/docs/%' ";
    
    
    $num2 = 0;
    while ($num2 < $maxDir) {
    // make a link to each sub director under the respective header
    echo "<tr>";
    $num = 0;
    while (($num) <= (count($headers))-1){
        
        $sqlDelete .= "AND path NOT LIKE '%" . $headers[$num] . "%' ";
        
        $subdir = scandir($docPath . '\\' . $headers[$num]);
        unset($subdir[0]);
        unset($subdir[1]);
        $subdir = array_values($subdir);

            if (empty($subdir[$num2])) { // if the value is empty, make it null to avoid error
                $subdir[$num2] = "";
            }
        $htmlLink = $htmlPath . '\\' . $headers[$num] . '\\' . $subdir[$num2] . '\\' . $subdir[$num2] . '.php';
        echo "<td><a href='" . $htmlLink . "'>" . $subdir[$num2] . "</a></td>";
        
        if (!file_exists(".\html\\" . $headers[$num] . "\\" . $subdir[$num2])){ // create folder in www/html/ for the <th> if it doens't exists
            mkdir(".\html\\" . $headers[$num] . "\\" . $subdir[$num2], 0700);
        
        // the following creates a file based on baseIndex.php
        $fileCreate = $htmlLink; 
        $fileHandle = fopen($fileCreate, 'w') or die("can't open file");
        $baseFile = file_get_contents('.\\baseIndex.php'); 
        fwrite($fileHandle, $baseFile);
        $num++;
            
        } else {
        // the following creates a file based on baseIndex.php
        $fileCreate = $htmlLink; 
        $fileHandle = fopen($fileCreate, 'w') or die("can't open file");
        $baseFile = file_get_contents('.\\baseIndex.php'); 
        fwrite($fileHandle, $baseFile);    
        $num++;
        };
    };
    echo "</tr>";
    $num2++;
    } // while
    
    // execute command to delete any files from deleted root directories
    $conn->query($sqlDelete);
    
    echo "</table>
          </div>";
    
    
    
    $dir = str_replace('html', 'docs', getcwd());  
    $parDir = (substr_count($dir, '\\')) - 2; // variable to find out how to get back to baseIndex.php 
    $baseSearch = str_repeat('../', $parDir) . 'search.php';
    
    echo
    "<div class='searchDiv'>
     <h3>Document Search</h3>
        <form  method='post' action='" . $baseSearch . "'  id='searchform'> 
           <input  class='searchBar' type='text' name='name' placeholder=''> 
           <input  class='searchButton' type='submit' name='submit' value='Search'> 
        </form>
    </div>";
        
    ?>
    <img id=isLogo src="media/isLogo.png">
    
    <video autoplay loop plays-inline muted>
        <source src="media/backVideo.webm" type="video/webm">
    </video>
    
    
</body>

</html>