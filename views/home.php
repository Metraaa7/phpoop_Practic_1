<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <style>
            .formUpload {
                margin-top: 10px;
                margin-bottom: 20px;
            }
        </style>
    </head>
    <body>
    <form method = "post" action="" enctype="multipart/form-data" class="formUpload">
        <input type = "file" name="file[]" multiple="multiple" value="Upload">
        <input type = "submit" name = "submit" value="Загрузить">
    </form>
    </body>
</html>

<?php
    for ($i=0; $i < @count((array)$_FILES['file']['name']); $i++) { 
        if (isset($_POST['submit']) && $_FILES) {
            $tmpFilePath = $_FILES['file']['tmp_name'][$i];
           
            if ($tmpFilePath != "") {
                $target_path = FILES_PATH . $_FILES["file"]["name"][$i];
            }
            @move_uploaded_file($tmpFilePath, $target_path);
        }
    }

    //^For adding single file 
    // if (isset($_POST['submit']) && $_FILES) {
    //     $destination_path = FILES_PATH . DIRECTORY_SEPARATOR;
    //     $target_path = $destination_path . basename( $_FILES["file"]["name"]);
    //     @move_uploaded_file($_FILES['file']['tmp_name'], $target_path);
    // }
?>