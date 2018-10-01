<html>
    
<head>
  <meta name="viewport" content="width=device-width,initial-scale=1">    
  <link rel='stylesheet' type='text/css' href="./searchStylesheet.css">
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
</head>
    
<body>

<?php

    $hn = 'localhost';
    $db = 'giles_docs';
    $un = 'giles';
    $pw = '!$iGnIN!';
    $conn = mysqli_connect($hn, $un, $pw, $db); 

<<<<<<< HEAD
if(empty($_POST['name'])) {
    echo "<h1>Search Results</h1>"; // title of page
    // title is dynamic from the folder name. Camel-case is applied
    
    $dir = str_replace('html', 'docs', getcwd()); 
    $templateDir = substr(getcwd(), 0, 14) . "templates";
    $currentWorkingDir = substr(getcwd(), 19, 90);
    
    $parDir = (substr_count($dir, '\\')) - 2; // variable to find out how to get back to baseIndex.php 
    $basePath = str_repeat('../', $parDir) . 'baseIndex.php'; 
    $baseSearch = str_repeat('../', $parDir) . 'search.php';
    $logoPath = str_repeat('../', $parDir) . '/media/';
    
    echo "<img class='giles-logo' src=".$logoPath."giles-white.png>"; // giles corner logo
    echo "<img class='premag-logo' src=".$logoPath."premag-white.png>"; // premag corner logo
    echo "<img class='redline' src=".$logoPath."line-red.png>"; // red line graphic
    echo "<img class='isLogo' src=".$logoPath."isLogo.png>"; // IS corner logo
    
    
    echo "<div class='buttons'>";
    echo "<div class='button-container'>";
        echo "<a class='button' href='localhost/index.php'>Home</a>"; // home button
    
    // search form
    echo "<form  method='post' action='" . $baseSearch . "'  id='searchform'> 
               <input  class='searchBar' type='text' name='name' placeholder='Doc Number'> 
               <input  class='searchButton' type='submit' name='submit' value='Search'> 
          </form>";
    
    
    echo "</div>
          </div>
          <br>
          <div class='file-container'>
          <div class='files-folders'>
    
        <div class='files'>";
    
    echo "<p id='error'>A minimun of 1 character is required for search results</p>
    

   
</body>

</html>";

   
} else {
       
    
=======
>>>>>>> parent of acbb8d2... Stopped White 'Flickering' on Transitions
if(isset($_POST['submit'])) {
   $document_name= "%" . $_POST['name'] . "%"; 
       
$search_stmt = $conn->prepare("SELECT document_number, revision, description, effective_date, path FROM docs WHERE (document_number LIKE ?) ORDER BY document_number");
$search_stmt->bind_param('s', $document_name);
$search_stmt->execute();
$search_stmt->store_result();

// bind results to these variables
$search_stmt->bind_result($search_document_name, $search_revision, $search_description, $search_effective_date, $search_path);   
    
echo "<h1>Search Results</h1>"; // title of page
    // title is dynamic from the folder name. Camel-case is applied
    
    $dir = str_replace('html', 'docs', getcwd()); 
    $templateDir = substr(getcwd(), 0, 14) . "templates";
    $currentWorkingDir = substr(getcwd(), 19, 90);
    
    $parDir = (substr_count($dir, '\\')) - 2; // variable to find out how to get back to baseIndex.php 
    $basePath = str_repeat('../', $parDir) . 'baseIndex.php'; 
    $baseSearch = str_repeat('../', $parDir) . 'search.php';
    $logoPath = str_repeat('../', $parDir) . '/media/';
    
    echo "<img class='giles-logo' src=".$logoPath."giles-white.png>"; // giles corner logo
    echo "<img class='premag-logo' src=".$logoPath."premag-white.png>"; // premag corner logo
    echo "<img class='redline' src=".$logoPath."line-red.png>"; // red line graphic
    echo "<img class='isLogo' src=".$logoPath."isLogo.png>"; // IS corner logo
    
    
    echo "<div class='buttons'>";
    echo "<div class='button-container'>";
        echo "<a class='button' href='localhost/index.php'>Home</a>"; // home button
    
    // search form
    echo "<form  method='post' action='" . $baseSearch . "'  id='searchform'> 
               <input  class='searchBar' type='text' name='name' placeholder='Doc Number'> 
               <input  class='searchButton' type='submit' name='submit' value='Search'> 
          </form>";
    
    
    echo "</div>
          </div>
          <br>
          <div class='file-container'>
          <div class='files-folders'>
    
        <div class='files'>
    
        <table>
      <tr class='fixedHeader'>
        <th>Document #</th>
        <th>Revision</th>
        <th>Description</th>
        <th>Effective</th>
      </tr>";  
    
while($search_stmt->fetch()) {
    
    
    
    
    echo "<tr class='files'>";
    echo    "<td class='docNum'><a class='file' href='".$search_path."' rel='noopener noreferrer' target='_blank''><div class='file'></div>" . $search_document_name . "</a></td>";
    echo    "<td class='revNum'>" . $search_revision . "</td>";
    echo    "<td class='description'>" . $search_description . "</td>";
    echo    "<td class='effDate'>" . $search_effective_date . "</td>
           </tr>";
  
} // end of if flag
    
    echo "</div>"; // end div.files
    echo "</div>"; // end of div.files-folders
    echo "</div>
   
</body>

</html>";

    

} else {
    echo "<p>Please enter a document name in the search bar</p>";
}
?>

