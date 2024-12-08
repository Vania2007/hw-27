<?php
$sourceDir = './images';
$destinationDir = './result';

if (!is_dir($destinationDir)) {
    mkdir($destinationDir, 0755, true);
}

$watermarkText = 'Developed by Ivan Momot';
$fontPath = './fonts/Lavishly_Yours/LavishlyYours-Regular.ttf';
$fontSize = 100;
$opacity = 50;

$images = glob($sourceDir . '/*.{jpg,jpeg,png,gif}', GLOB_BRACE);

foreach ($images as $image) {
    list($width, $height) = getimagesize($image);

    $img = imagecreatefromstring(file_get_contents($image));

    $textColor = imagecolorallocatealpha($img, 255, 255, 255, $opacity);

    $textX = $width + 1100 - ($fontSize * strlen($watermarkText));
    $textY = $height - 350;

    imagettftext($img, $fontSize, 0, $textX, $textY, $textColor, $fontPath, $watermarkText);

    $outputPath = $destinationDir . '/' . basename($image);
    imagepng($img, $outputPath);

    imagedestroy($img);
}

echo "Водяні знаки успішно додані до зображень!";
