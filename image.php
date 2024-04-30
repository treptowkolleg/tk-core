<?php
header("Content-type: image/png");
$t = $_GET['t'] ?? 'n/a';
$im = @imagecreate(512, 22) or die("Cannot Initialize new GD image stream");
$bc = imagecolorallocate($im, 0, 0, 0);
$tc = imagecolorallocate($im, 0, 255, 255);
imagestring($im, 2, 4, 4,  $t, $tc);
imagepng($im,null,0,PNG_FILTER_AVG);
imagedestroy($im);
