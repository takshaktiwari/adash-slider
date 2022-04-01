<x-admin.layout>
    <x-admin.breadcrumb title='Sliders' :links="[
            ['text' => 'Dashboard', 'url' => route('admin.dashboard') ],
            ['text' => 'Sliders', 'url' => route('admin.sliders.index')],
            ['text' => 'Edit']
        ]"
        :actions="[
            ['text' => 'Add New', 'icon' => 'fas fa-plus', 'url' => route('admin.sliders.create') ],
            ['text' => 'All Sliders', 'icon' => 'fas fa-list', 'url' => route('admin.sliders.index') ],
        ]" />


    <div class="row">
        <div class="col-md-6">
            <form action="{{ route('admin.sliders.update', [$slider]) }}" method="POST" class="card shadow">
                @csrf
                @method('PUT')
                <div class="card-body table-responsive">
                    <div class="form-group">
                        <label for="">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" value="{{ $slider->name }}" placeholder="eg. Slider name" required>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Width: <span class="small">(Small)</span><span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="number" name="size_small[width]" value="{{ $slider->size_small['width'] ?? null }}" class="form-control" required
                                        placeholder="eg. 1500">
                                    <span class="input-group-text">px</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Height: <span class="small">(Small)</span><span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="number" name="size_small[height]" value="{{ $slider->size_small['height'] ?? null }}" class="form-control" required
                                        placeholder="eg. 1500">
                                    <span class="input-group-text">px</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Width: <span class="small">(Medium)</span><span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="number" name="size_medium[width]" value="{{ $slider->size_medium['width'] ?? null }}" class="form-control" required
                                        placeholder="eg. 1500">
                                    <span class="input-group-text">px</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Height: <span class="small">(Medium)</span><span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="number" name="size_medium[height]" value="{{ $slider->size_medium['height'] ?? null }}" class="form-control" required
                                        placeholder="eg. 1500">
                                    <span class="input-group-text">px</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Width: <span class="small">(Large)</span><span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="number" name="size_large[width]" value="{{ $slider->size_large['width'] ?? null }}" class="form-control" required
                                        placeholder="eg. 1500">
                                    <span class="input-group-text">px</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Height: <span class="small">(Large)</span><span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="number" name="size_large[height]" value="{{ $slider->size_large['height'] ?? null }}" class="form-control" required
                                        placeholder="eg. 1500">
                                    <span class="input-group-text">px</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Status <span class="text-danger">*</span></label>
                                <select name="status" class="form-control" required>
                                    <option value="">-- Select --</option>
                                    <option value="1" {{ $slider->status ? 'selected' : '' }} >Active</option>
                                    <option value="0" {{ !$slider->status ? 'selected' : '' }} >In-active</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Default Bg Color</label>
                                <input type="color" name="bg_color" class="form-control" value="{{ $slider->bg_color }}" style="height: 38px; padding: 4px;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-dark px-4">
                        <i class="fas fa-save"></i> Submit
                    </button>
                </div>
            </form>
        </div>
    </div>

</x-admin.layout>
