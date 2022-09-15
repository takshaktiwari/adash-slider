<?php

namespace Takshak\Aslider\Traits\Controllers\Admin;

use Takshak\Aslider\Models\Slider;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Takshak\Aslider\Models\Slide;

trait SliderTrait
{
    public function index()
    {
        $sliders = Slider::withCount('slides')->get();
        return View::first(
            ['admin.sliders.index', 'aslider::admin.sliders.index'],
            compact('sliders')
        );
    }

    public function create()
    {
        return View::first(
            ['admin.sliders.create', 'aslider::admin.sliders.create']
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'                  =>  'required',
            'size_small'            =>  'required|array',
            'size_small.width'      =>  'required|numeric',
            'size_small.height'     =>  'required|numeric',
            'size_medium'           =>  'required|array',
            'size_medium.width'     =>  'required|numeric',
            'size_medium.height'    =>  'required|numeric',
            'size_large'            =>  'required|array',
            'size_large.width'      =>  'required|numeric',
            'size_large.height'     =>  'required|numeric',
            'status'                =>  'nullable|boolean',
            'bg_color'              =>  'required',
            'in_background'         =>  'nullable|boolean',
        ]);

        $validated['slug']  = Str::of($validated['name'])->slug('-');
        Slider::create($validated);

        return redirect()->route('admin.sliders.index')->withSuccess('SUCCESS !! New slider has been added. Add some slides to it.');
    }

    public function edit(Slider $slider)
    {
        return View::first(
            ['admin.sliders.edit', 'aslider::admin.sliders.edit'],
            compact('slider')
        );
    }

    public function update(Slider $slider, Request $request)
    {
        $validated = $request->validate([
            'name'                  =>  'required',
            'size_small'            =>  'required|array',
            'size_small.width'      =>  'required|numeric',
            'size_small.height'     =>  'required|numeric',
            'size_medium'           =>  'required|array',
            'size_medium.width'     =>  'required|numeric',
            'size_medium.height'    =>  'required|numeric',
            'size_large'            =>  'required|array',
            'size_large.width'      =>  'required|numeric',
            'size_large.height'     =>  'required|numeric',
            'status'                =>  'nullable|boolean',
            'bg_color'              =>  'required',
            'in_background'         =>  'nullable|boolean',
        ]);
        $slider->update($validated);
        return redirect()->route('admin.sliders.index')->withSuccess('SUCCESS !! Slider has been updated.');
    }

    public function destroy(Slider $slider)
    {
        $slider->load('slides');

        $images = $slider->slides->pluck('image_sm')
            ->merge($slider->slides->pluck('image_md'))
            ->merge($slider->slides->pluck('image_lg'))
            ->toArray();

        Storage::delete($images);

        Slide::where('slider_id', $slider->id)->delete();
        $slider->delete();

        return back()->withSuccess('Slider has been successfully deleted.');
    }
}
