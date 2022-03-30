<?php

namespace Takshak\Aslider\Traits\Controllers\Admin;

use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Takshak\Aslider\Actions\SlideAction;

trait SlideTrait
{
    public function index()
    {
        $slides = Slide::get();
        return View::first(
            ['admin.slides.index', 'aslider::admin.slides.index'],
            compact('slides')
        );
    }

    public function create()
    {
        return View::first(
            ['admin.slides.create', 'aslider::admin.slides.create']
        );
    }

    public function store(Request $request, SlideAction $action)
    {
        $request->validate([
            'slide'     =>  'required|image',
            'set_order' =>  'required|numeric',
            'status'    =>  'required|numeric',
            'display_size'  =>  'required'
        ]);

        $slide = new Slide;
        $slide = $action->save($request, $slide);

        return redirect()->route('admin.slides.index')->withSuccess('SUCCESS !! New Slide is successfully generated.');
    }

    public function edit(Slide $slide)
    {
        return View::first(
            ['admin.slides.edit', 'aslider::admin.slides.edit'],
            compact('slide')
        );
    }

    public function update(Request $request, Slide $slide, SlideAction $action)
    {
        $action->save($request, $slide);
        return redirect()->route('admin.slides.index')->withSuccess('SUCCESS !! Slide is successfully updated.');
    }

    public function destroy(Slide $slide)
    {
        Storage::disk('public')->delete([
            $slide->image_lg,
            $slide->image_md,
            $slide->image_sm,
        ]);
        $slide->delete();
        return redirect()->route('admin.slides.index')->withSuccess('SUCCESS !! Slide is successfully deleted.');
    }
}
