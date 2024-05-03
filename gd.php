<?php

const PROJECT_ROOT = __DIR__ . DIRECTORY_SEPARATOR;

// Schriften
$fonts = [
    PROJECT_ROOT . 'fonts/VeraMono.ttf',
];

// Unser Text
$text = $_GET['text'] ?? 'Beispieltext';

// Länge des Strings ermitteln
$textLength = strlen($text);
$initial = 15;
$letterSpace = 25;
// Bildbreite ermitteln
$imageWidth = 2*$initial + $letterSpace * $textLength;

// Grafik erstellen
$image = imagecreatetruecolor($imageWidth, 50);

// Antialias (ja oder nein)
imageantialias($image, true);

// Die Farbpalette erstellen (je Bild bis zu 255 Farben)
$textColor = imagecolorallocate($image, 128,0,189);
$frameColor = imagecolorallocate($image, 64,0,64);
$background = imagecolorallocate($image, 32,32,58);

// Hintergrund füllen
imagefill($image, 0, 0, $background);

// Strichstärke einstellen
//imagesetthickness($image, rand(2, 10));
// Rahmen zeichnen
//imagerectangle($image, 10, 10, 90, 30, $frameColor);

// Ellipse ignoriert Strichstärke
imageellipse($image,$imageWidth/2,25,40,40,$frameColor);

// Text schreiben
for($i = 0; $i < $textLength; $i++) {
    imagettftext($image, 20, rand(-15, 15), $initial + $i*$letterSpace, rand(30, 40), $textColor, $fonts[0], $text[$i]);
}

// Bild abschließen und zurückgeben
header('Content-type: image/png');
imagepng($image);
imagedestroy($image);
