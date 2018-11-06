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

    public static function link($options = [])
    {
        $options += [
            'name' => 'file_src',
            'link_attributes' => 'target="_blank"',
        ];

        return new HtmlString(
            view('easyupload::link')
                ->with($options)
                ->render()
        );
    }

    public static function image($options = [])
    {
        $options += [
            'name' => 'file_src',
        ];

        return new HtmlString(
            view('easyupload::image')
                ->with($options)
                ->render()
        );
    }
}
