@include('admin.header')

<div class="page-content" style="padding-bottom: 70px;">
    <div class="page-header">
        <div class="container-fluid">
            <h2 class="h5 no-margin-bottom">Dashboard</h2>
        </div>
    </div>
    <div style="padding-left:2%">
        <a href="{{ url('add_categeroy') }}" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-50"></span>
            <span class="text">Add Category</span>
        </a>
    </div>
    <div class="table-responsive p-3">
        <h1>Category List</h1>
        <table class="table align-items-center table-flush dataTable" id="dataTable" role="grid" aria-describedby="dataTable_info">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Order No</th>
                    <th>Images</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categeroy as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->orde_no }}</td>
                    <td>
                        <!-- Assuming 'images' is a comma-separated string of filenames -->
                        @foreach(explode(',', $category->images) as $image)
                        <img src="{{ asset('images/' . $image) }}" alt="{{ $image }}" style="width: 100px; height: auto;">
                        @endforeach
                    </td>
                    <td>
                        <button class="btn btn-primary btn-lg">
                            <a href="{{ url('c_edit/'.$category->id) }}">
                                <span class="text-white">Edit</span>
                            </a>
                        </button>
                        <button class="btn btn-primary btn-lg" onclick="confirmDelete({{ $category->id }})">
                            <span class="text-white">Delete</span>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@include('admin.footer')

<script>
    function confirmDelete(id) {
        if (confirm('Are you sure you want to delete this category?')) {
            window.location.href = "{{ url('delete_categeroy') }}/" + id;
        } else {
            // Do nothing if cancel is clicked
        }
    }
</script>
