<?php
function create_image($img)
{
    $im = @imagecreatefrompng($img) or die("Cannot Initialize new GD image stream");
    $rotate = imagerotate($im, 180, 0);
    imagepng($rotate);
    imagedestroy($rotate);
    imagedestroy($im);
}

header('Content-Type: image/png');
$image = "a.jpg";
create_image($image);
