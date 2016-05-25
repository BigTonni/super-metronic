<?php
/*
Uploadify
Copyright (c) 2012 Reactive Apps, Ronnie Garcia
Released under the MIT License <http://www.opensource.org/licenses/mit-license.php> 
*/

// Define a destination. Relative to the root
if (!empty($_FILES)) {    
    $res = false;
    $fileParts = pathinfo($_FILES['Filedata']['name']);
    if ( !in_array( $fileParts['extension'], array('img', 'png', 'jpeg', 'jpg', 'gif', 'bmp') ) ) {
        $error = 'Wrong file type. Only files as images allowed.';
    } else {    
        $targetFolder = '/wp-content/uploads/smf_portlets';
        $targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
        $tempFile = $_FILES['Filedata']['tmp_name'];
        $targetFile = rtrim($targetPath,'/') . '/' . $_FILES['Filedata']['name'];
        $res = move_uploaded_file($tempFile, $targetFile);
    }
    
}
?>