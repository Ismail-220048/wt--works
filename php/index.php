<?php
$dir = 'hello';
if(file_exists($dir)){
    if(rmdir($dir)){
        echo "Directory 'hello' created successfully.";}
    else{
        echo "Failed to create directory 'hello'.";}
}
else{
    echo "Directory 'hello' already exists.";
}
?>
