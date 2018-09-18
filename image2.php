<?php
namespace App;

require 'vendor/autoload.php';

use Intervention\Image\ImageManagerStatic as IImage;

class Image
{
    protected $origin = 'a.jpg';
    protected $result = 'a-new.jpg';

    protected $view;

    public function __construct()
    {
        $this->view = new View();
    }

    public function index()
    {
        $this->view->render('imageIndex', []);
    }

    public function resize()
    {
        IImage::make($this->origin)
            ->resize(500, null, function ($image) {
                $image->aspectRatio();
            })
            ->rotate(90)
            ->blur(1)
            ->save($this->result, 80);
        echo 'success';
    }

    public function watermark()
    {
        putenv('GDFONTPATH=' . realpath(PUBLIC_PATH));
        $image = IImage::make('musya_origin.jpg');
        $image->text(
            'sadasd',
            $image->width() / 2,
            $image->height() / 2,
            function ($font) {
                $font->file('arial.ttf')
                    ->size('224');
                $font->size('224');
                $font->color(array(255, 0, 0, 0.5));
                $font->align('center');
                $font->valign('center');
            });
        $image->save('musya.jpg');
        echo 'watermarked';
    }




}