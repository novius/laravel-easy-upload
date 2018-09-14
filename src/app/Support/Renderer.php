<?php

namespace Novius\EasyUpload\Support;

use Illuminate\Support\HtmlString;

class Renderer
{
    public static function input($options = [])
    {
        $options += [
            'name' => 'file_src',
        ];

        return new HtmlString(
        	view('easyupload::input')
	            ->with($options)
	            ->render()
        );
    }
}
