<?php
$grades = array(
    "Bob" => [11, 12, 11, 11],
    "John" => [10, 9, 9, 12],
    "Max" => [5, 8, 6, 6],
    "Lord" => [11, 11, 10, 10],
    "Nick" => [11, 7, 10, 11],
);

$averages = [];
foreach ($grades as $student => $marks) {
    $averages[$student] = array_sum($marks) / count($marks);
}

$width = 400;
$height = 400;
$canvas = imagecreatetruecolor($width, $height);

$white = imagecolorallocate($canvas, 255, 255, 255);
$colors = [
    imagecolorallocate($canvas, 255, 99, 71),
    imagecolorallocate($canvas, 60, 179, 113),
    imagecolorallocate($canvas, 30, 144, 255),
    imagecolorallocate($canvas, 255, 215, 0),
    imagecolorallocate($canvas, 255, 105, 180),
];

imagefilledrectangle($canvas, 0, 0, $width, $height, $white);

$total = array_sum($averages);
$start_angle = 0;

foreach ($averages as $student => $average) {
    $end_angle = $start_angle + ($average / $total) * 360;
    
    imagefilledarc($canvas, $width / 2, $height / 2, 300, 300, $start_angle, $end_angle, $colors[array_search($student, array_keys($averages)) % count($colors)], IMG_ARC_PIE);
    
    $start_angle = $end_angle;
}

header('Content-type: image/png');
imagepng($canvas);
imagedestroy($canvas);