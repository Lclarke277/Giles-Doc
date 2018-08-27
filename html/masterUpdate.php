<?php        
    
   $currentDir = scandir('.\\');
   unset($currentDir[0]);
   unset($currentDir[1]);
   $currentDir = array_values($currentDir);
    
   print_r($currentDir);
    
echo
"<iframe style='display:none;' name='target'></iframe>
<a href='.\service\Engineering\Engineering.php' target='target'>...</a>
<a href='.\service\Maintenance\Maintenance.php' target='target'>...</a>";
?>