<?php

namespace Takshak\Aslider\Actions;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Takshak\Imager\Facades\Imager;

class SliderAction
{
    public function save($request, $slider)
    {
        $slider->set_order =  $request->post('set_order');
        $slider->status    =  $request->post('status');
        $slider->url_link  =  $request->post('url_link');
        $slider->display_size  =  $request->post('display_size');

        if ($request->file('slide')) {
            $fileName = Str::of(microtime())->slug() . '.jpg';
            $slider->image_lg = 'sliders/' . $fileName;
            $slider->image_md = 'sliders/md/' . $fileName;
            $slider->image_sm = 'sliders/sm/' . $fileName;

            $imgWidth = config('site.slider.width');
            if ($request->post('display_size')) {
                $imgWidth = config('site.slider.sizes.' . $request->post('display_size') . '.width');
            }

            Imager::init($request->file('slide'))
                ->basePath(Storage::disk('public')->path('/'))
                ->save($slider->image_lg)
                ->save($slider->image_md, $imgWidth / 2)
                ->save($slider->image_sm, $imgWidth / 3);
        }

        $slider->save();

        return $slider;
    }
}
