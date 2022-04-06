<?php

namespace Takshak\Aslider\Traits\Controllers\Admin;

use App\Models\Slide;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Takshak\Aslider\Actions\SlideAction;

trait SlideTrait
{
    public function index(Request $request)
    {
        $slides = Slide::when($request->get('slider_id'), fn ($q) => $q->where('slider_id', $request->get('slider_id')))->get();
        return View::first(
            ['admin.slides.index', 'aslider::admin.slides.index'],
            compact('slides')
        );
    }

    public function create(Request $request)
    {

        $slider = Slider::find($request->get('slider_id'));
        if (!$slider) {
            return redirect()->route('admin.sliders.index')->withErrors('Please select a slider first.');
        }
        return View::first(
            ['admin.slides.create', 'aslider::admin.slides.create'],
            compact('slider')
        );
    }

    public function store(Request $request, SlideAction $action)
    {

        //return $request->all();
        $request->validate([
            'slide'     =>  'required|image',
            'set_order' =>  'required|numeric',
            'status'    =>  'required|numeric',
            'display_size'  =>  'required',
            'slider_id'     =>  'required|numeric'
        ]);

        $slide = new Slide;
        $slide = $action->save($request, $slide);

        return redirect()->route('admin.slides.index', ['slider_id' => $request->get('slider_id')])->withSuccess('SUCCESS !! New Slide is successfully generated.');
    }

    public function edit(Slide $slide, Request $request)
    {
        $slider = Slider::find($request->get('slider_id'));
        if (!$slider) {
            return redirect()->route('admin.sliders.index')->withErrors('Please select a slider first.');
        }
        return View::first(
            ['admin.slides.edit', 'aslider::admin.slides.edit'],
            compact('slide', 'slider')
        );
    }

    public function update(Request $request, Slide $slide, SlideAction $action)
    {

        //return $request->all();
        $action->save($request, $slide);
        return redirect()->route('admin.slides.index', ['slider_id' => $request->get('slider_id')])->withSuccess('SUCCESS !! Slide is successfully updated.');
    }

    public function destroy(Slide $slide, Request $request)
    {
        Storage::disk('public')->delete([
            $slide->image_lg,
            $slide->image_md,
            $slide->image_sm,
        ]);
        $slide->delete();
        return redirect()->route('admin.slides.index', ['slider_id' => $request->get('slider_id')])->withSuccess('SUCCESS !! Slide is successfully deleted.');
    }
}
