<html>
     
<head>
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
        echo "<th>" . $headers[$num] . "</th>";
        
        if (!file_exists(".\html\\" . $headers[$num])){ // create folder in www/html/ for the <th> if it doens't exists
            mkdir(".\html\\" . $headers[$num], 0700);
        }
        
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
    
    $num2 = 0;
    while ($num2 < $maxDir) {
    // the make a link to each sub director under the respective header
    echo "<tr>";
    $num = 0;
    while (($num) <= (count($headers))-1){
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
    
    echo "</table>
          </div>";
    ?>
    
    
<!--
    <div id=table>
    <table>
        <tr>
            <th>Administration</th>
            <th>Facilities</th>
            <th>Service</th>
        </tr>
        <tr>
            <td><a href="html/customer%20service/customer%20service.php">Customer Service</a></td>
            <td><a href="">Manufacturing</a></td>
            <td><a href="">Maintenance</a></td>
        </tr>
        <tr>
            <td><a href="">IT Support</a></td>
            <td><a href="">Repackaging</a></td>
            <td><a href="">Engineering</a></td>
        </tr>
        <tr>
            <td><a href="">Supply Chain</a></td>
            <td><a href="">Greendale</a></td>
            <td><a href="">Quality Assurance</a></td>
        </tr>
        <tr>
            <td></td>
            <td><a href="">CPG</a></td>
            <td><a href="">Laboratory</a></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td><a href="">Safety</a></td>
        </tr>
    
    </table>
    </div>
 -->   
    <img id=isLogo src="media/isLogo.png">
    
    <video autoplay loop plays-inline muted>
        <source src="media/videoBack.webm" type="video/webm">
    </video>
    
    
</body>

</html>