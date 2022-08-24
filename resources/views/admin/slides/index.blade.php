<x-admin.layout>
	<x-admin.breadcrumb
		title='Slides'
		:links="[
			['text' => 'Dashboard', 'url' => route('admin.dashboard') ],
            ['text' => 'Sliders', 'url' => route('admin.sliders.index')],
            ['text' => 'Slides']
		]"
        :actions="[
            ['text' => 'Create New', 'icon' => 'fas fa-plus', 'url' => route('admin.slides.create', request()->all()) ],
        ]" />


    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Details</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($slides as $key => $slide)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>
                                <img src="{{ $slide->image_sm() }}" alt="" style="max-height: 80px;">
                            </td>
                            <td>
                                <b>Size: </b>{{ ucfirst($slide->display_size) }}
                                <div class="text-info mt-1">
                                    <b class="mr-2">Status:</b>
                                    {{ $slide->status ? 'Active' : 'In-Active' }}

                                    <br>
                                    <b class="mr-2">Set Order:</b> {{ $slide->set_order }}
                                </div>
                            </td>
                            <td class="font-size-20">
                                <a href="{{ route('admin.slides.edit', [$slide, 'slider_id' => $slide->slider_id]) }}" class="btn btn-sm btn-success btn-loader" title="Edit this">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('admin.slides.destroy', [$slide, 'slider_id' => $slide->slider_id]) }}" method="POST" class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger btn-loader" title="Delete this" onclick="return confirm('Are you sure to delete ?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

</x-admin.layout>
