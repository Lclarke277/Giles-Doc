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
    $rootPath = '.\docs'; // variable for location of root
    $headers = scandir($rootPath); // get array of files in the docs dir
    unset($headers[0]); // remove first value of scandir '.'
    unset($headers[1]); // rmeove second value of scandir '..'
    $headers = array_values($headers); // reinitialize the array
    
    echo "<div id=table>
          <table>
          <tr>";
    
    // the following creates a table header for each folder in the docs directory
    $num = 0;   
    while (($num) <= (count($headers))-1){
        echo "<th>" . $headers[$num] . "</th>";
        $num++;
    }
    
    echo "</tr>";
    
    // Max Dir Alg: algorithim to find the max count of all the header subdirectories
    $num = 0;
    while ($num < count($num)) {
        $maxDir = count(scandir($rootPath . '\\' . $headers[$num]));
        $nextDir = count(scandir($rootPath . '\\' . $headers[$num + 1]));
        
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
    
    
    // the make a link to each sub director under the respective header
    echo "<tr>";
    $num = 0;
    while (($num) <= (count($headers))-1){
        $subdir = scandir($rootPath . '\\' . $headers[$num]);
        unset($subdir[0]);
        unset($subdir[1]);
        $subdir = array_values($subdir);

            if (empty($subdir[0])) { // if the value is empty, make it null to avoid error
                $subdir[0] = "";
            }
        
        echo "<td>" . $subdir[0] . "</td>";
        $num++;
    };
    echo "</tr>";
    
    
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