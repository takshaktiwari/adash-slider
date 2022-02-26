<x-admin.layout>
	<x-admin.breadcrumb
		title='Sliders'
		:links="[
			['text' => 'Dashboard', 'url' => route('admin.dashboard') ],
            ['text' => 'Sliders']
		]"
        :actions="[
            ['text' => 'Create New', 'icon' => 'fas fa-plus', 'url' => route('admin.sliders.create') ],
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
                                <div class="text-secondary mt-1">
                                    <b class="mr-2">Status:</b>
                                    {{ $slide->status ? 'Active' : 'In-Active' }}

                                    <br>
                                    <b class="mr-2">Set Order:</b> {{ $slide->set_order }}
                                </div>
                            </td>
                            <td class="font-size-20">
                                <a href="{{ route('admin.sliders.edit', [$slide]) }}" class="btn btn-sm btn-success" title="Edit this">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('admin.sliders.destroy', [$slide]) }}" method="POST" class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" title="Delete this" onclick="return confirm('Are you sure to delete ?')">
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