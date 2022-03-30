<x-admin.layout>
	<x-admin.breadcrumb
			title='Edit Slide'
			:links="[
				['text' => 'Dashboard', 'url' => route('admin.dashboard') ],
                ['text' => 'Slides', 'url' => route('admin.slides.index')],
                ['text' => 'Edit']
			]"
            :actions="[
                ['text' => 'Create New', 'permission' => 'slide_create', 'icon' => 'fas fa-plus', 'class' => 'btn-success', 'url' => route('admin.slides.create') ],
                ['text' => 'Slides', 'icon' => 'fas fa-list', 'url' => route('admin.slides.index') ]
            ]"
		/>

    <div class="row">
        <div class="col-md-7">
            <form action="{{ route('admin.slides.update', [$slide]) }}" method="POST" enctype="multipart/form-data" class="card">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="d-flex">
                    	<div class="mr-2" id="preview-img">
                        	<img src="{{ $slide->image_sm() }}" alt="" class="img-thumbnail" style="max-height: 70px;">
                    	</div>
                        <div class="form-group flex-fill">
                            <label for="">Select Image <span class="text-danger">*</span></label>
                            <input type="file" name="slide" class="form-control" id="crop-image">
                            <div class="small text-secondary">
                                <div><b>*</b> Image format should be 'jpg' or 'png'</div>
                                <div>
                                    <b>*</b> Image should be:
                                    @foreach(config('site.slider.sizes') as $key => $dimentions)
                                        <span class="ml-2">
                                            <b>{{ $key }}: </b>
                                            {{ $dimentions['width'].' x '.$dimentions['height'] }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">Set Order </label>
                                <input type="number" name="set_order" class="form-control" value="{{ $slide->set_order }}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">Status</label>
                                <select name="status" required class="form-control">
                                    <option value="1" {{ ($slide->status == '1') ? 'selected' : '' }} >Active</option>
                                    <option value="0" {{ ($slide->status == '0') ? 'selected' : '' }} >In-Active</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">Display Size <span class="text-danger">*</span></label>
                                <select name="display_size" required class="form-control">
                                    <option value="">-- Select --</option>
                                    @foreach(config('site.slider.sizes') as $key => $dimentions)
                                        <option value="{{ $key }}" {{ ($key == $slide->display_size) ? 'selected' : '' }} >
                                            {{ ucfirst($key).' ('. $dimentions['width'].' x '.$dimentions['height'].')' }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">URL Link </label>
                        <input type="url" name="url_link" class="form-control" placeholder="https://webpage.con/page-url" value="{{ $slide->url_link }}">
                    </div>
                </div>
                <div class="card-footer">
                    <input type="submit" class="btn btn-primary px-5">
                </div>
            </form>
        </div>
    </div>

    <x-slot name="script">
        <script>
            var imageRatio = {{ config('shopze.images.sliders.width').'/'.config('shopze.images.sliders.height') }};
            var previewImg = {
            	targetId: 'preview-img',
            	width: '50px',
            	rounded: '4px'
            };
            imageCropper('crop-image', imageRatio, previewImg);
        </script>
    </x-slot>
</x-admin.layout>
