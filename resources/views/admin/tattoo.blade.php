@include('admin.header')

<div class="page-content" style="padding-bottom: 70px;">
    <div class="page-header">
        <div class="container-fluid">
            <h2 class="h5 no-margin-bottom">Dashboard</h2>
        </div>
    </div>
    <div style="padding-left:2%">
        <a href="{{ url('add_tattoo') }}" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-50"></span>
            <span class="text">Add Tattoo</span>
        </a>
    </div>  
    <div class="table-responsive p-3">
        <h1>Tattoo List</h1>
        <table class="table align-items-center table-flush dataTable" id="dataTable" role="grid" aria-describedby="dataTable_info">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Images</th>
                    <th>Thumbnail</th>
                    <th>Category Name</th>
                    <th>Popular</th>
                    <th>Featured</th>
                    <th>ACTION</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tattoos as $tattoo)
                {{-- @php
                    echo '<pre>';
                        print_r($tattoo->tattoo_image);
                        exit();
                @endphp --}}
                    <tr>
                        <td>{{ $tattoo->id }}</td>
                        <td>
                            @foreach(explode(',', $tattoo->tattoo_image) as $image)
                                <img src="{{ asset('images/' . $image) }}" alt="tattoo_images" style="width: 100px; height: auto;">
                            @endforeach
                            {{-- <img src="{{ asset('images/' . $tattoo->tattoo_image) }}" alt="image" style="width: 100px; height: auto;"> --}}
                        </td>
                        <td>
                            <img src="{{ asset('images/thumbnails/' . $tattoo->thumbnail) }}" alt="{{ $tattoo->thumbnail }}" style="width: 50px; height: auto;">
                        </td>
                        <td>
                            @if($tattoo->category)
                                {{ $tattoo->category->name }}
                            @else
                                No Category
                            @endif
                        </td>
                        <td>
                            <div class="col text-success" id="status-success-{{ $tattoo->id }}" style="display: none;">
                                <span class="font-weight-bold">Status Changed!</span>
                            </div>
                            <label class="switch">
                                <input type="checkbox" id="status-{{ $tattoo->id }}" name="status" onchange="status_change_popular({{ $tattoo->id }}, this);">
                                <span class="slider"></span>
                            </label>
                        </td>
                        <td>{{ $tattoo->is_featured ? 'Yes' : 'No' }}</td>
                        <td>
                            <button class="btn btn-primary btn-lg"><a href="{{ url('t_edit/'.$tattoo->id) }}"><span class="text-white">Edit</span></a></button>
                            <button class="btn btn-primary btn-lg" onclick="confirmDelete('{{ url('delete_tattoo/'.$tattoo->id) }}')"><span class="text-white">Delete</span></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@include('admin.footer')

<script>
    function confirmDelete(url) {
        if (confirm('Are you sure you want to delete this tattoo?')) {
            window.location.href = url;
        }
    }
</script>
