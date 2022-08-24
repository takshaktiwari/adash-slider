<x-admin.layout>
	<x-admin.breadcrumb
			title='Create Slide'
			:links="[
				['text' => 'Dashboard', 'url' => route('admin.dashboard') ],
                ['text' => 'Sliders', 'url' => route('admin.slides.index')],
                ['text' => 'Create']
			]"
            :actions="[
                ['text' => 'Slides', 'icon' => 'fas fa-list', 'url' => route('admin.slides.index', ['slider_id' => request()->get('slider_id')]) ]
            ]"
		/>


    <div class="row">
        <div class="col-md-7">
            <form action="{{ route('admin.slides.store', ['slider_id' => request()->get('slider_id')]) }}" method="POST" enctype="multipart/form-data" class="card shadow-sm">
                @csrf
                <div class="card-header">
                    <h5 class="my-auto">Slider: {{ $slider->name }}</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">Set Order </label>
                                <input type="number" name="set_order" class="form-control" value="0" value="{{ old('set_order') }}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">Status</label>
                                <select name="status" required class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">In-Active</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">Display Size <span class="text-danger">*</span></label>
                                <select name="display_size" required class="form-control">
                                    <option value="">-- Select --</option>
                                    <option value="size_small">Small: {{ $slider->size_small['width'].' x '.$slider->size_small['height'] }}</option>
                                    <option value="size_medium">Medium: {{ $slider->size_medium['width'].' x '.$slider->size_medium['height'] }}</option>
                                    <option value="size_large">Large: {{ $slider->size_large['width'].' x '.$slider->size_large['height'] }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Select Image <span class="text-danger">*</span></label>
                        <input type="file" name="slide" class="form-control" required id="crop-image">
                        <div class="small text-info">
                            <div><b>*</b> Image format should be 'jpg' or 'png'</div>
                            <div>
                                <b>*</b> Image should be:
                                <span class="ml-2">
                                    <b>Small: </b> {{ $slider->size_small['width'].' x '.$slider->size_small['height'] }}
                                </span>
                                <span class="ml-2">
                                    <b>Medium: </b> {{ $slider->size_medium['width'].' x '.$slider->size_medium['height'] }}
                                </span>
                                <span class="ml-2">
                                    <b>Large: </b> {{ $slider->size_large['width'].' x '.$slider->size_large['height'] }}
                                </span>
                            </div>
                        </div>
                    </div>

                    @if($slider->in_background)
                        <div class="form-group">
                            <label for="">Title</label>
                            <input type="text" name="title" class="form-control" value="{{ old('title') }}">
                        </div>

                        <div class="form-group">
                            <label for="">Sub Title </label>
                            <input type="text" name="subtitle" class="form-control"  value="{{ old('subtitle') }}">
                        </div>
                    @endif
                
                    <div class="form-group">
                        <label for="">URL Link </label>
                        <input type="url" name="url_link" class="form-control" placeholder="https://webpage.con/page-url" value="{{ old('url_link') }}">
                    </div>
                </div>
                <div class="card-footer">
                    <input type="submit" class="btn btn-primary px-5">
                </div>
            </form>
        </div>
    </div>

</x-admin.layout>
