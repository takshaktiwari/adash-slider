<x-admin.layout>
	<x-admin.breadcrumb
			title='Create Slide'
			:links="[
				['text' => 'Dashboard', 'url' => route('admin.dashboard') ],
                ['text' => 'Sliders', 'url' => route('admin.slides.index')],
                ['text' => 'Create']
			]"
            :actions="[
                ['text' => 'Sliders', 'icon' => 'fas fa-list', 'url' => route('admin.slides.index') ]
            ]"
		/>


    <div class="row">
        <div class="col-md-7">
            <form action="{{ route('admin.slides.store') }}" method="POST" enctype="multipart/form-data" class="card shadow-sm">
                @csrf
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
                                    @foreach(config('site.slider.sizes') as $key => $dimentions)
                                        <option value="{{ $key }}">
                                            {{ ucfirst($key).' ('. $dimentions['width'].' x '.$dimentions['height'].')' }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Select Image <span class="text-danger">*</span></label>
                        <input type="file" name="slide" class="form-control" required id="crop-image">
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
