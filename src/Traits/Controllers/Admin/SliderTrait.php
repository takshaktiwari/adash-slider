<?php

namespace Takshak\Aslider\Traits\Controllers\Admin;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Takshak\Aslider\Actions\SliderAction;

trait SliderTrait
{
    public function index()
    {
        $slides = Slider::get();
        return View::first(
            ['admin.sliders.index', 'aslider::admin.sliders.index'],
            compact('slides')
        );
    }

    public function create()
    {
        return View::first(
            ['admin.sliders.create', 'aslider::admin.sliders.create']
        );
    }

    public function store(Request $request, SliderAction $action)
    {
        $request->validate([
            'slide'     =>  'required|image',
            'set_order' =>  'required|numeric',
            'status'    =>  'required|numeric',
            'display_size'  =>  'required'
        ]);

        $slider = new Slider;
        $slider = $action->save($request, $slider);

        return redirect()->route('admin.sliders.index')->withSuccess('SUCCESS !! New Slider is successfully generated.');
    }

    public function edit(Slider $slider)
    {
        return View::first(
            ['admin.sliders.edit', 'aslider::admin.sliders.edit'],
            compact('slider')
        );
    }

    public function update(Request $request, Slider $slider, SliderAction $action)
    {
        $action->save($request, $slider);
        return redirect()->route('admin.sliders.index')->withSuccess('SUCCESS !! Slider is successfully updated.');
    }

    public function destroy(Slider $slider)
    {
        Storage::disk('public')->delete([
            $slider->image_lg,
            $slider->image_md,
            $slider->image_sm,
        ]);
        $slider->delete();
        return redirect()->route('admin.sliders.index')->withSuccess('SUCCESS !! Slider is successfully deleted.');
    }

}
