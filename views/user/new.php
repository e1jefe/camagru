<?php
namespace controllers;
use lib\Db;
$connection = new Db;

$img = str_replace('data:image/png;base64,', '', $_POST['image']);
$img = str_replace(' ', '+', $img);
$img = base64_decode($img);
$sticker = $_POST['stick'];
$gd_photo = imagecreatefromstring($img);
$gd_filter = imagecreatefrompng($sticker);
imagecopy($gd_photo, $gd_filter, 0, 0, 0, 0, imagesx($gd_filter), imagesy($gd_filter));
ob_start();
imagepng($gd_photo);
$image_data = ob_get_contents();
ob_end_clean();
$myfile = fopen($uploadfile, 'x');
fwrite($myfile, $img);
$connection->query("INSERT INTO pics (source, user_id, likes, comments)VALUES ('$dir$apend',{$_SESSION['user_id']},'0','')");
fclose($myfile);
header("Location: http://localhost:8082");
echo "data:image/png;base64,".base64_encode($image_data);