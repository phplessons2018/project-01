<?php
require 'vendor/autoload.php';
use Intervention\Image\ImageManagerStatic as Image;

$image = Image::make('a.jpg');
$image->rotate(45);
$image->text('WaterMark', $image->width()/2, $image->height()/2, function ($font){
    $font->file('FiraSans.ttf');
    $font->size(84);
    $font->color('FF8000');
    $font->align('center');
    $font->valign('center');
})->save('new.jpg');