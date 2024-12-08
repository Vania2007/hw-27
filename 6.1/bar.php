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
    $converted_marks = array_map(function ($mark) {
        return ($mark / 100) * 12;
    }, $marks);

    $averages[$student] = array_sum($converted_marks) / count($converted_marks);
}

$columns = count($averages);

$width = 400;
$height = 300;

$padding = 5;

$column_width = ($width - ($padding * ($columns - 1))) / $columns;

$canvas = imagecreate($width, $height);
$white = imagecolorallocate($canvas, 255, 255, 255);
$colors = [
    imagecolorallocate($canvas, 255, 99, 71),
    imagecolorallocate($canvas, 60, 179, 113),
    imagecolorallocate($canvas, 30, 144, 255),
    imagecolorallocate($canvas, 255, 215, 0),
    imagecolorallocate($canvas, 255, 105, 180),
];

imagefilledrectangle($canvas, 0, 0, $width, $height, $white);

$maxv = max($averages);

$i = 0;
foreach ($averages as $student => $average) {
    $column_height = ($height / 1.5) * $average;
    $x1 = $i * ($column_width + $padding);
    $y1 = $height - $column_height;
    $x2 = $x1 + $column_width;
    $y2 = $height;
    imagefilledrectangle($canvas, $x1, $y1, $x2, $y2, $colors[$i % count($colors)]);
    $i++;
}

header("Content-type: image/png");
imagepng($canvas);
imagedestroy($canvas);
