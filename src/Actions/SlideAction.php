<?php

namespace Takshak\Aslider\Actions;

use App\Models\Slider;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Takshak\Imager\Facades\Imager;

class SlideAction
{
    public function save($request, $slide)
    {
        $slide->slider_id =  $request->get('slider_id');
        $slide->set_order =  $request->post('set_order');
        $slide->status    =  $request->post('status');
        $slide->title       =  $request->post('title');
        $slide->subtitle    =  $request->post('subtitle');
        $slide->url_link    =  $request->post('url_link');
        $slide->display_size  =  Str::of($request->post('display_size'))->after('size_');

        if ($request->file('slide')) {
            $slider = Slider::findOrFail($request->get('slider_id'));
            $display_size = $request->post('display_size');

            $fileName = Str::of(microtime())->slug() . '.jpg';
            $slide->image_lg = 'sliders/' . $fileName;
            $slide->image_md = 'sliders/md/' . $fileName;
            $slide->image_sm = 'sliders/sm/' . $fileName;

            $imgWidth = (int)$slider->$display_size['width'] ?: config('site.slider.width');

            Imager::init($request->file('slide'))
                ->basePath(Storage::disk('public')->path('/'))
                ->save($slide->image_lg)
                ->save($slide->image_md, $imgWidth / 2)
                ->save($slide->image_sm, $imgWidth / 3);
        }

        $slide->save();

        return $slide;
    }
}
