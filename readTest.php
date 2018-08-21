<!DOCTYPE html>
<html>
<body>

<?php
$myfile = fopen("test.txt", "r") or die("Unable to open file!");
$data = fread($myfile,filesize("test.txt"));
$dataArray = explode('^', $data) ; 
print_r($dataArray);
echo $data;    
fclose($myfile);
?>

</body>
</html>