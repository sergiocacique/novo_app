

<?php
$file = fopen("PORTAL.csv","r");

while(! feof($file))
{
    echo '<pre>';
    print_r(fgetcsv($file));
    echo '<pre>';
}

fclose($file);
?>