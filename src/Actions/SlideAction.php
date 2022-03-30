<?php

namespace Takshak\Aslider\Actions;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Takshak\Imager\Facades\Imager;

class SlideAction
{
    public function save($request, $slide)
    {
        $slide->set_order =  $request->post('set_order');
        $slide->status    =  $request->post('status');
        $slide->url_link  =  $request->post('url_link');
        $slide->display_size  =  $request->post('display_size');

        if ($request->file('slide')) {
            $fileName = Str::of(microtime())->slug() . '.jpg';
            $slide->image_lg = 'sliders/' . $fileName;
            $slide->image_md = 'sliders/md/' . $fileName;
            $slide->image_sm = 'sliders/sm/' . $fileName;

            $imgWidth = config('site.slider.width');
            if ($request->post('display_size')) {
                $imgWidth = config('site.slider.sizes.' . $request->post('display_size') . '.width');
            }

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
