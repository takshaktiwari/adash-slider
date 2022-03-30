<x-admin.layout>
    <x-admin.breadcrumb title='Sliders' :links="[
			['text' => 'Dashboard', 'url' => route('admin.dashboard') ],
            ['text' => 'Sliders']
		]" :actions="[
            ['text' => 'Create New', 'icon' => 'fas fa-plus', 'url' => route('admin.sliders.create') ],
        ]" />


    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Sizes</th>
                        <th>Slides</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sliders as $key => $slider)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $slider->name }}</td>
                        <td>
                            <span><b>S: </b>{{ $slider->size_small['width'].' X '.$slider->size_small['height'] }}</span>
                            <span class="text-dark px-1">|</span>
                            <span><b>M: </b>{{ $slider->size_medium['width'].' X '.$slider->size_medium['height'] }}</span>
                            <span class="text-dark px-1">|</span>
                            <span><b>L: </b>{{ $slider->size_large['width'].' X '.$slider->size_large['height'] }}</span>
                        </td>
                        <td>{{ $slider->slides_count }} Slides</td>
                        <td class="font-size-20">
                            <a href="{{ route('admin.sliders.edit', [$slider]) }}" class="btn btn-sm btn-success" title="Edit this">
                                <i class="fas fa-edit"></i>
                            </a>

                            <form action="{{ route('admin.sliders.destroy', [$slider]) }}" method="POST" class="d-inline-block">
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
