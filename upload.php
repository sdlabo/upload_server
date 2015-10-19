<?php

$dirname = dirname(__FILE__);
$filename = basename($_FILES['userfile']['name']);
sscanf($filename, "%04d%02d%02d%s", $year, $month, $day, $footer);
$datedir = date("/Y/m/d/");
//$datedir = sprintf("/%04d/%02d/%02d/", $year, $month, $day);
$uploaddir = $dirname . $datedir;

echo $uploaddir . "\n";
mkdir($uploaddir, 0777, TRUE);

$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

echo '<pre>';
if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
    echo "File is valid, and was successfully uploaded.\n";
} else {
    echo "Possible file upload attack!\n";
}

echo "filename = $filename\n";
$filename = escapeshellcmd($filename);
$fromfile = basename($filename, ".gz");
$tofile = $fromfile;
exec("cd ${uploaddir}; gunzip ${filename}");

print_r($_FILES);

print "</pre>";

?>