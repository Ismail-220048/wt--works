<?php


$uploadDir = "uploads/";


if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}


if (isset($_FILES['file'])) {
    $fileName = basename($_FILES['file']['name']); 
    $targetFile = $uploadDir . $fileName;

   
    if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFile)) {
        echo "File uploaded successfully!<br>";
        echo "You can download it here: <a href='$targetFile' download>$fileName</a>";
    } else {
        echo "Failed to upload file!";
    }
} else {
    echo "No file selected!";
}
?>

?>